<?php 
//Encerrar a sessão
session_start();
session_unset();
session_destroy();
//Direcionar
header('Location: index.php');