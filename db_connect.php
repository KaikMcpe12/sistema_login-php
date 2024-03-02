<?php
//Conexão
$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "sistemalogin";

$conn = new mysqli($server_name, $username, $password, $db_name);

if($conn->connect_error){
    echo "Falha na conexão: ". $con->connect_error;
};