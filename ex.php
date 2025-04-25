<?php
    echo readfile('ex.txt');
    fopen("webdictionary.txt", "r");
?>

// <?php
// $servername="localhost";
// $username="root";
// $password="";
// $database="employee";


// $conn=mysqli_connect($servername,$username,$password,$database);
// if(!$conn)
    // die("Sorry we failed to connect: ". mysqli_connect_error());
// else{
    // echo "connection successful";
// }


//creating DB
  
// $sql="CREATE DATABASE employee";
// mysqli_query($conn,$sql);
//to use a database we need to give database name to connection 

//creating a Table

// $insert="CREATE TABLE emp(sno int,empname varchar(20))";
// $result=mysqli_query($conn,$insert);
// if($result)
//     echo "table created successfully";
// else
//     echo "table was not created";
// ?>