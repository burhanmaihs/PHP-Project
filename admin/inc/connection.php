<?php
  $db = mysqli_connect("localhost", "root", "", "library_management");
  if($db){
  	//echo "Database Connection Established!";
  }else{
  	die("Database Connection Error!".mysqli_error($db));
  }

?>