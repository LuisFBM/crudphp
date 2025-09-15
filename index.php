<?php

include_once 'configs/database.php';
include_once 'objetos/aluno.php';
include_once 'objetos/alunoController.php';
include_once 'session.php';

$controller = new AlunoController();
$aluno = $controller->index();
global $alunos;

$a = null;

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['pesquisa']) && trim($_POST['pesquisa']) !== '' ) {   
            $a = $controller->pesquisarAluno($_POST['pesquisa']);

    } elseif($_SERVER['REQUEST_METHOD'] === "GET"){
        if(isset($_GET['excluir'])){
            $controller->excluirAluno($_GET['excluir']);
        }
    } 
}

?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Alunos</title>
</head>
<body>
    <?php include_once 'topo.php' ?>

    <a href="cadastro.php">Cadastrar Alunos</a>
    <br>
    <a href="listaUsuario.php">Lista de Usuários</a>

    <h1>Alunos Cadastrados</h1>

    <table>
        <tr>
            <td>RA</td>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Telefone</td>
        </tr>

        <?php if($alunos) : ?>
            <?php foreach($alunos as $a) : ?>

                <tr>
                    <td><?= $alunos->id?></td>
                    <td><?= $alunos->nome?></td>
                    <td><?= $alunos->descricao?></td>
                    <td><?= $alunos->qtd?></td>
                    <td><?= $alunos->preco?></td>
                    <td><a href="atualizar.php?alterar=<?= $alunos->id ?>">Atualizar</a></td>
                    <td><a href="index.php?excluir=<?= $alunos->id ?>">Excluir</a></td>

                </tr>
                <?php endforeach ?>
                <?php endif ?>
    </table>

    <form action="index.php" method="post">
        <label for="">Pesquisa</label>
        <input type="text" name="pesquisa">
        <button>Pesquisar</button>
    </form>

    <!-------------------------------------------------------------------->

    <table>
        <tr>
            <td>RA</td>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Telefone</td>
        </tr>
        <?php if($a) : ?>
            <?php foreach($a as $aluno) : ?>
                <tr>
                    <td><?= $aluno->ra?></td>
                    <td><?= $aluno->nome?></td>
                    <td><?= $aluno->email?></td>
                    <td><?= $aluno->telefone?></td>
                </tr>
            <?php endforeach ?>
        <?php endif ?>
    </table>


</body>
</html>