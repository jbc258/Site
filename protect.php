<?php
if (!isset($_SESSION)) {
    session_start();
}

// Inclua a conexão com o banco de dados
include('conexao.php');

if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Obtenha informações adicionais do usuário, se necessário
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
    $sql = "SELECT nome FROM usuarios WHERE nome = '$usuario'";
    $result = $mysqli->query($sql);
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $_SESSION['nome'] = $row['nome'];
    }
}
?>
