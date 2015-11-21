<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
  if (!isset($_SESSION['usermain'])) {
    if (isset($_COOKIE['usermain'])) {
      $_SESSION['usermain'] = $_COOKIE['usermain'];
    }
  }
   if((!isset($_SESSION['usermain'])) && (!isset($_COOKIE['usermain'])))
  {
	  $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/login-main.php';
  header('Location: ' . $home_url);
  }
  if (isset($_SESSION['usermain'])) {
    echo '&#10084; <a href="logoutmain.php">Log Out (' . $_SESSION['usermain'] . ')</a><br/>';
  }
$id = $_GET['id'];
echo "<b>Patient ID: </b>".$id;
$dbc = mysqli_connect('localhost','root','','healthcare')
or
die('error connecting to MySql server');
$query = "SELECT * FROM patient_file WHERE p_id='$id'";
$result = mysqli_query($dbc,$query)
or
die('Error querying to mysql server');
while ($row = mysqli_fetch_array($result)) { 
echo '<br>';
echo "<b>Patient Name: </b>".$row['p_name'].'<br>';
 echo "<b>Patient Reports: </b>".'<a href="' . 'files/' . $row['p_file'] . '" target="_blank" />view file</a></p>'.'<br>';
echo "<b>Patient's Primary Hospital: </b>".$row['ph_name'].'<br>';
 if (isset($_POST['submit'])) {
	  $sreport = $_FILES['sreport']['name'];
    $sreport_type = $_FILES['sreport']['type'];
    $sreport_size = $_FILES['sreport']['size'];
	$comment=$_POST['comment'];
	 if (!empty($sreport)) {
     
        if ($_FILES['sreport']['error'] == 0) {
          // Move the file to the target upload folder
          $target = 'mfiles/' . $sreport;
          if (move_uploaded_file($_FILES['sreport']['tmp_name'], $target)) {
            // Connect to the database
           

            // Write the data to the database
            $query1 = "UPDATE patient_file SET sreport='$sreport',comment='$comment', status='Active', timestamp=NOW() WHERE p_id='$id'";
            mysqli_query($dbc, $query1);

            // Confirm success with the user
           echo "Your file is delivered to the required hospital <BR>";
            echo '<a href="' . 'mfiles/' . $sreport . '" target="_blank" />view your uploaded file</a></p>';
             

            // Clear the score data to clear the form
    
            $sreport = "";

          
          }
          else {
            echo '<p class="error">Sorry, there was a problem uploading your screen shot image.</p>';
          }
        }
      }


      // Try to delete the temporary screen shot image file
      @unlink($_FILES['sreport']['tmp_name']);
    }
    else {
      
    }
 ?>
 <head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="w3.css">

 </head>


<form   role=" form" enctype="multipart/form-data" method="post" action="">
 
 
</form>


<form   role=" form" enctype="multipart/form-data" method="post" action="">
<header class="w3-container w3-red">
<h1>Header</h1>
</header>



<div class="w3-container">

<table class="w3-table w3-bordered w3-striped">
<thead>
<tr>
  <th>Patient Name</th>
  <th>Patient Id</th>
  <th>Patient Report</th>
</tr>
</thead>
<tbody>
<tr>
  <td><?php echo $row['p_name'];?></td>
  <td>Smith</td>
  <td>50</td>
</tr>

</tr>
</tbody>
</table>

</div>

<div class="w3-row-padding w3-margin-top">

<div class=" col-md-12 col-xs-12 col-sm-12 w3-full">
 
   
    
<h4>Advice Patient:</h4> <center><textarea name="comment" rows="5" cols="80"><?php echo "Enter suggestions......";?></textarea></center>


</div>

<div class="w3-half">
  <div class="w3-card-2">

   
  </div>
</div>

</div>

<footer class="w3-container w3-red w3-margin-top">
 <div class="w3-container">

  <label for="sreport">UPLOAD:<input type="file" name="sreport" id="sreport"></label>


    </div>
    <button class="btn btn-sucess" name="submit" id="submit">Submit</button>

</footer>
<?php
}
mysqli_close($dbc);
?>
</form>
</body>
</html> 