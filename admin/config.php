<?php

$servername = "localhost";
$username = "root";
$pass = "";
$db = "adblog";
try{
    $con = mysqli_connect($servername,$username,$pass,$db);

}catch (MySQLi_Sql_Exception $ex){
echo "error in connecting";
}
?>
