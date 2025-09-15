<?php
include_once "objetos/AlunoController.php";
include_once "topo.php";

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $controller = new AlunoController();

    if(isset($_POST['cadastrar'])){
        $controller->cadastrarAluno($_POST['usuario'], $_FILES['aluno']);
    }
}
?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de aluno</title>
</head>
<body>
    <h1>Cadastro de Aluno</h1>

    <?php if(isset($_SESSION['Erro'])) :?>

        <h1><?= $_SESSION['Erro ao logar'] ?></h1>

    <?php endif ?>

    <form action="cadastro.php" method="post" enctype="multipart/form-data"> <?php // aqui eu cadastro e mostro que estou a trabalhar com arquivos ?>
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