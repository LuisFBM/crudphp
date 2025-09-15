<?php
include_once "objetos/usuarioController.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $controller = new usuariosController();

    if(isset($_POST['cadastrar'])){
        $controller->cadastrarUsuario($_POST['usuario']);
    }
}
?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de produto</title>
</head>
<body>
    <h1>Cadastro de Usuários</h1>

    <form action="cadastroUsuario.php" method="post">
    <label for="nome">Nome</label>
    <input type="text" name="usuario[nome]" id="nome" required>

    <label for="email">E-mail</label>
    <input type="text" name="usuario[email]" id="descricao" required>

    <label for="senha">Senha</label>
    <input type="password" name="usuario[senha]" id="senha" required>

    <label for="telefone">Telefone</label>
    <input type="text" name="usuario[telefone]" id="telefone" required>

        <br>

        <label for="fileToUpload">Selecione imagem</label>
        <input type="file" name="aluno[fileToUpload]" id="fileToUpload">

        <br>

    <button name="cadastrar">Cadastrar</button>

    </form>
    
</body>
</html>