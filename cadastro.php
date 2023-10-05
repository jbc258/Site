<?php
include('conexao.php');

if(isset($_POST['email'], $_POST['senha'], $_POST['nome'])) {

    $email = $mysqli->real_escape_string($_POST['email']);
    $senha = $mysqli->real_escape_string($_POST['senha']);
    $nome = $mysqli->real_escape_string($_POST['nome']);

    // Execute o código SQL para inserir os dados na tabela de usuários
    $sql_code = "INSERT INTO usuarios (email, senha, nome) VALUES ('$email', '$senha', '$nome')";
    $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

    if($sql_query) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Falha ao cadastrar o usuário";
    }
}
?>
