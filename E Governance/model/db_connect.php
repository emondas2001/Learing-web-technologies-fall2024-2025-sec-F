<?php
$db_server = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "public_service_portal";
$conn = "";
try{
    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
}
catch(my_sql_exception)
{
    echo"could not connect!";
}

if ($conn) {
   // echo" You are connected!";
}
?>

