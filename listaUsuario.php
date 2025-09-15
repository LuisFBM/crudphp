<?php

include_once 'configs/database.php';
include_once 'objetos/usuario.php';
include_once 'objetos/usuarioController.php';
include_once 'session.php';

$controller = new usuariosController();
$usuario = $controller->indexUsuario();
global $usuario;

$usuarios = null;

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pesquisa']) && trim($_POST['pesquisa']) !== '') {
    if (isset($_POST['pesquisa'])) {

        $usuarios = $controller->pesquisarUsuario($_POST['pesquisa']);

    } elseif ($_SERVER['REQUEST_METHOD'] === "GET") {
        if (isset($_GET['excluir'])) {
            $controller->excluirUsuario($_GET['excluir']);
        }
    }
}


?>

<!DOCTYPE html>
<html lang="pr-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
</head>
<body>
<?php include_once 'topo.php' ?>

    <h2>Lista de Usuários</h2>

    <table>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Telefone</td>
        </tr>

        <?php if($usuario) : ?>
            <?php foreach($usuario as $logados) : ?>
                
                <tr>
                    <td><?= $logados->id ?></td>
                    <td><?= $logados->nome ?></td>
                    <td><?= $logados->email ?></td>
                    <td><?= $logados->telefone ?></td>
                
                    <?php if($_SESSION['usuario']->id == $logados->id) : ?>

                        <td><a href="atualizarUsuario.php?alterar=<?= $logados->id ?>">Editar</a></td>
                        <td><a href="listaUsuario.php?excluir=<?= $logados->id ?>">Excluir</a></td>

                <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <form action="listaUsuario.php" method="post">
        <label for="">Pesquisa:</label>
        <input type="text" name="pesquisa">
        <button>Pesquisar</button>
    </form>


    <table>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>Email</td>
            <td>Telefone</td>
        </tr>

        <?php if($usuarios) : ?>
           
                <tr>
                    <td><?= $usuarios->id ?></td>
                    <td><?= $usuarios->nome ?></td>
                    <td><?= $usuarios->email ?></td>
                    <td><?= $usuarios->telefone ?></td>
                </tr>
           
        <?php endif ?>
    </table>
    
</body>
</html>