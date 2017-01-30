<?php 

/*$dbname = "lms";
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";*/

	$dbConnect = mysqli_connect("127.0.0.1", "root", "", "lms");
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }



?>