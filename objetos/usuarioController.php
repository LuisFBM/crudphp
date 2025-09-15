<?php

include_once 'configs/database.php';
include_once 'usuario.php';

class usuariosController {

    private $bd;
    private $usuarios;
 

    public function __construct() {
        $banco = new Database();
        $this->bd = $banco->conectar();
        $this->usuario = new Usuario($this->bd);
    }

    public function indexUsuario(){
        return $this->usuario->lerTodos();
    }

    public function pesquisarUsuario($nome){
        return $this->usuario->lerUsuario($nome);
    }

    public function localizarUsuario($id){
        return $this->usuario->pesquisaUsuario($id);
    }

    public function cadastrarUsuario($usuarios){
        $this->usuario->nome = $usuarios['nome']; 
        $this->usuario->email = $usuarios['email'];
        $this-> usuario->senha = password_hash($usuarios['senha'], PASSWORD_DEFAULT);
        $this->usuario->telefone = $usuarios['telefone'];

        if($this->usuario->cadastrar()){
            header("Location: index.php");
            exit();
        }
        return false;
    }

    public function atualizarUsuario($dados){
        $this->usuario->id = $dados['id'];
        $this->usuario->nome = $dados['nome'];
        $this->usuario->email = $dados['email'];
        $this->usuario->senha = $dados['senha'];
        $this->usuario->telefone = $dados['telefone'];

        if($this->usuario->atualizar()){
            header("Location: listaUsuario.php");
            exit();
        }
        return false;
    }

    public function excluirUsuario($id){
        $this->usuario->id = $id;

        if($this->usuario->excluir()){
            header("Location: login.php");
            exit();
        }
    }

    public function login($email, $senha){
        $this->usuario->email = $email;
        $this->usuario->senha = $senha;

        $this->usuario->login();
}
}

    

?>