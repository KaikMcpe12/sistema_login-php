<?php 
    //Conexão
    require_once 'db_connect.php';
    //Sessão
    session_start();
    //Enviar
    if(isset($_POST['btn-entrar'])){
        $erros = array();
        $login = mysqli_escape_string($conn, $_POST['login']);
        $senha = mysqli_escape_string($conn, $_POST['senha']);

        if(empty($senha) or empty($login)){
            $erros[] = "<li>O campo login/senha precisa ser preechido</li>";
        }else{
            $sql = "SELECT login FROM usuarios WHERE login = '$login'";
            $res = $conn->query($sql);

            if($res->num_rows > 0){
                $senha = md5($senha);
                $sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
                $res = $conn->query($sql);

                if($res->num_rows == 1){
                    $dados = $res->fetch_array();
                    $conn->close();
                    $_SESSION['logado'] = true;
                    $_SESSION['id_usuario'] = $dados['id'];

                    header("Location: home.php");
                }else{
                    $erros[] = "<li>Usuario e senha não conferem</li>";
                };
            }else{
                $erros[] = "<li>Usuário inexitente</li>";
            };
        };
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php 
        if(!empty($erros)){
            echo "<ul>";
            foreach($erros as $erro){
                echo $erro;
            };
            echo "</ul>";
        };
    ?>
    <hr>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
        <label for="login">Login</label>
        <input type="text" name="login"><br>
        <label for="login">Senha</label>
        <input type="text" name="senha"><br>
        <button type="submit" name="btn-entrar">Entrar</button>
    </form>
</body>
</html>