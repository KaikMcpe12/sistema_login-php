<?php 
    //Conexão
    require_once 'db_connect.php';
    //Sessão
    session_start();
    //Verficação
    if(!isset($_SESSION['logado'])){
        header('Location: index.php');
    };
    //Dados
    $id = $_SESSION['id_usuario'];
    $sql = "SELECT * FROM usuarios WHERE id = '$id'";
    $res = $conn->query($sql);
    $dados = $res->fetch_array();
    $conn->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página restrita</title>
</head>
<body>
    <h1>Olá <?php echo $dados['nome'];?></h1>
    <a href="logout.php">Sair</a>
</body>
</html>