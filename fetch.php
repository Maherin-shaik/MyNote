<?php
$servername="localhost";
$username="root";
$password="";
$database="mahi";
$conn=mysqli_connect($servername,$username,$password,$database);
if(!$conn)
    die("Sorry we failed to connect: ". mysqli_connect_error());
else{
    echo "connection successful";
}

$sql="SELECT * FROM `student`";
$result=mysqli_query($conn,$sql);
echo '<br> no of rows '.mysqli_num_rows($result);
echo '<br>';
// ferch data in db

$row=mysqli_fetch_assoc($result);
echo var_dump($row);
while($row=mysqli_fetch_assoc($result))
{   echo '<br>';
    echo $row['sno'].' Hello '.$row['name'].' your roll number is '.$row['roll'];
    echo '<br>';
}


?>