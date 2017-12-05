<?php
//setting db parameter
$hostname="localhost";
$username="root";
$password="";
$databasename="gallery";
//connecting to db 

$conn=new mysqli($hostname,$username,$password,$databasename);

//getting form values
$caption=$_POST['caption'];


//creating dir path
$target_dir = "upload/";
//setting file name
$target_file = $target_dir . basename($_FILES['photo']['name']);
//getting file type
//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//uploading temporary file to upload dir 
$status=move_uploaded_file($_FILES['photo']['tmp_name'], $target_file);

//query for insert 
$q="insert into gallerytable(caption,photo) values('$caption','$target_file')";
    
//getting result /response
if($conn->query($q))
{
echo " row inserted. {$status}<br>";
}
else{
    echo "not insert.{$status}<br>";
    echo $conn->error;
    echo $q;
}
?>


