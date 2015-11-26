<?php
ini_set('session.cache_limiter','public');
session_cache_limiter(false);
session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['username'])) {
    if (isset($_COOKIE['username'])) {
      $_SESSION['username'] = $_COOKIE['username'];
    }
  }
   if((!isset($_SESSION['username'])) && (!isset($_COOKIE['username'])))
  {
    $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '#/primary';
  }
  ?>

  <html>
  <head>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="w3.css">
  </head>
  <style>
body {
    background-color: #CCCCCC;
}
.sessioncolor{
  color: #009688;
  font-weight: bolder;
  padding: 2%;
  margin:2%;
}
.text{
  margin:2%;
  padding:2%;
}

a.pull-right {
    padding: 2%;
}

  </style>

  <body>
    <nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#">Page 1</a></li>
        <li><a href="#">Page 2</a></li> 
        <li><?php echo ' <a href="logout.php">Log Out</a><span class="sessioncolor">(' . $_SESSION['username'] . ')</span><br/>';
  ?></li> 
      </ul>
    </div>
  </div>
</nav>
<?php
  
    
$id = $_GET['id'];

$dbc = mysqli_connect('localhost','root','','healthcare')
or
die('error connecting to MySql server');
$query = "SELECT * FROM patient_file WHERE p_id='$id'";
$result = mysqli_query($dbc,$query)
or
die('Error querying to mysql server');
while ($row = mysqli_fetch_array($result)) { 
echo '<br>';

/*if($row['status']=='Active')
 {
	
	if($row['comment']!="")
	{
	
	}
 }
*/
?>

<div class="col-md-offset-3 col-md-6 text-center ">
  <header class="w3-container w3-teal">
<h3>Patient Details</h3>
</header>


<div class="w3-container">


<table class="w3-table w3-bordered w3-striped">
<thead>
<tr>
  <th>Patient Id</th>
  <th>Patient Name</th>
  <th>Patient Disease</th>
</tr>
</thead>
<tbody>
<tr>
  <td><?php echo $id;?></td>
  <td><?php echo $row['p_name'] ?></td>
  <td><?php echo $row['disease'] ?></td>
</tr>

</tbody>
</table>




<div class="w3-row-padding w3-margin-top">



<div class="text w3-full">
  <div class="w3-card-2">
    <div style="padding:1%"class="text-center w3-full">
     <h3>Doctor's Advice</h3>
     <hr>
    </div>
    <div class="w3-container">
<p><?php echo  $row['comment'].'<br>';?> </p>
   <p>--<?php echo  $row['d_name']."(". $row['ddept'].")";?></p>
    </div>

  </div>
</div>

</div>

<footer class="w3-container w3-teal w3-margin-top">
 
 <p><?php echo '<a  type="button" class="pull-right" href="' . 'mfiles/' . $row['sreport'] . '" target="_blank" /><h4>View File</h4></a></p>'.'<br>';?></hr ></p>
</footer><?php

?></div><?php
}
mysqli_close($dbc);
?>
</div>
</body>
</html>