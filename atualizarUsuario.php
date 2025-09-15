<?php
include_once "objetos/usuarioController.php";
include_once "session.php";
include_once "topo.php";

$controller = new usuariosController();

if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['alterar'])){
    if($_SESSION['usuario']->id != $_GET['alterar']) {
        header("Location: listaUsuario.php");
        exit;
        
    }
    
    $a = $controller->localizarUsuario($_GET['alterar']);
} elseif($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['usuario'])){
    $controller->atualizarUsuario($_POST['usuario']);
} else {
    header("Location: listaUsuario.php");
}

?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
</head>
<body>
    <h1>Atualizar Usuário</h1>

    <form action="atualizarUsuario.php" method="post">
    <input type="number" name="usuario[id]" id="id" value="<?= $a->id ?>" hidden>
    <label for="nome">Nome</label>
    <input type="text" name="usuario[nome]" id="nome" value="<?= $a->nome ?>">

    <label for="descricao">Descrição</label>
    <input type="text" name="usuario[email]" id="email" value="<?= $a->email ?>">

    <label for="qtd">Quantidade</label>
    <input type="number" name="usuario[telefone]" id="telefone" value="<?= $a->telefone ?>">

    <button name="cadastrar ">Alterar</button>

    </form>
    
</body>
</html>