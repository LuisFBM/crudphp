<?php

Class Aluno {
    public $ra;

    public $nome;
    public $email;

    public $senha;

    public $telefone;

    public $imagem;

    public $bd;
    
    public function __construct($bd){
        $this->bd = $bd; // vou passar para meu objeto uma conexão.
    }

    public function lerTodos(){

        $sql = "SELECT * FROM alunos";
        $resultados = $this->bd->query($sql);
        $resultados->execute();

        return $resultados->fetchAll(PDO::FETCH_OBJ); // retorna com os dados tratados como objeto.
    }

    public function lerAluno($nome){ // metodo que recebe a váriavel para fazer uma pesquisa
        $nome = "%" . $nome . "%"; // tratamento do valor
        $sql = "SELECT * FROM alunos WHERE nome LIKE :nome";
        $resultado = $this->bd->prepare($sql); // trata a consulta e garanti a segurança.
        $resultado->bindParam(':nome', $nome);
        $resultado->execute();
        
        return $resultado->fetchAll(PDO::FETCH_OBJ);
    }

    public function cadastrar(){
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT); // Gera um hash seguro da senha usando o algoritmo padrão do PHP, ideal para armazenar senhas de forma protegida no banco de dados.
        $sql = "INSERT INTO alunos (nome, email, senha, telefone, imagem) VALUES (:nome, :email, :senha, :telefone, :imagem)"; // quando fizer o banco do projeto e testar com insert que funciona.
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR); // associa a informação do meu sql, passando a posição do meu atributo nome usando a filtragem para que ela seja do tipo string.
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':imagem', $this->imagem, PDO::PARAM_STR);
            
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        }

        public function atualizar(){
        $senha_hash = password_hash($this->senha, PASSWORD_DEFAULT);
        $sql = "UPDATE alunos SET nome = :nome, email = :email, senha = :senha, telefone = :telefone WHERE ra = :ra";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR); 
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->bindParam(':senha', $senha_hash, PDO::PARAM_STR);
        $stmt->bindParam(':telefone', $this->telefone, PDO::PARAM_STR);
        $stmt->bindParam(':ra', $this->ra, PDO::PARAM_INT); 
            
        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        }

    public function excluir(){
        $sql = "DELETE FROM alunos WHERE ra = :ra";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':ra', $this->ra, PDO::PARAM_INT);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function pesquisaAluno($ra){ 
        $sql = "SELECT * FROM alunos WHERE ra LIKE :ra;";
        $resultado = $this->bd->prepare($sql); 
        $resultado->bindParam(':ra', $ra);
        $resultado->execute();
        
        return $resultado->fetch(PDO::FETCH_OBJ);
    }

    public function Login(){
        $sql = "SELECT * FROM alunos WHERE email = :email";
        $stmt = $this->bd->prepare($sql);
        $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);

        if($result){
            if(password_verify($this->senha, $result->senha)){ // verifica a senha apontada, buscando o hash
                session_start();
                $_SESSION['aluno'] = $result;
                header("Location: index.php");
                exit();
            } else {
                header("Location: login.php");
                exit();
            }
        }
    }

}
?>