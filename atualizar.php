<?php
include_once "objetos/ProdutoController.php";
include_once "session.php";

$controller = new ProdutoController();

if($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['alterar'])){
    $a = $controller->localizarProduto($_GET['alterar']);
} elseif($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['produto'])){
    $controller->atualizarProduto($_POST['produto']);
} else {
    header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar produto</title>
</head>
<body>
    <h1>Atualizar Produto</h1>

    <form action="atualizar.php" method="post">
    <input type="number" name="produto[id]" id="id" value="<?= $a->id ?>" hidden>
    <label for="nome">Nome</label>
    <input type="text" name="produto[nome]" id="nome" value="<?= $a->nome ?>">

    <label for="descricao">Descrição</label>
    <input type="text" name="produto[descricao]" id="descricao" value="<?= $a->descricao ?>">

    <label for="qtd">Quantidade</label>
    <input type="number" name="produto[qtd]" id="qtd" value="<?= $a->qtd ?>">

    <label for="preco">Preço</label>
    <input type="text" name="produto[preco]" id="preco" value="<?= $a->preco ?>">

    <button name="cadastrar">Cadastrar</button>

    </form>
    
</body>
</html>