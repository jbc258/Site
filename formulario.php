<?php
include('conexao.php');

if(isset($_POST['email'], $_POST['senha'])) {

    if(empty($_POST['email'])) {
        echo "Preencha seu e-mail";
    } else if(empty($_POST['senha'])) {
        echo "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: painel.php");
            exit();
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos";
        }

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<style>
    * {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}


body {
	font-family: Arial, sans-serif;
	background-color: #cdcaca;
	color: #333;
}

header {
	background-color: #333;
	padding: 20px;
}

nav ul {
	margin: 0;
	padding: 0;
	list-style: none;
	display: flex;
	justify-content: space-between;
	align-items: center;
}

nav li {
	margin: 0 10px;
}

nav a {
	color: #fff;
	text-decoration: none;
	font-size: 18px;
}

.social-logo {
	width: 30px;
	height: 30px;
}


main {
  display: flex;
  flex-direction: column;
  align-items: center;
  margin: 50px auto;
  max-width: 800px;
}

/* Style the main heading */
h1 {
  font-size: 2rem;
  text-align: center;
  margin-bottom: 20px;
}

/* Style the paragraph text */
p {
  font-size: 1.2rem;
  text-align: center;
  margin-top: -1%;
  position: absolute;
}

.pmain{
  font-size: 1.2rem;
    text-align: center;
    margin-top: 13%;
    position: relative;
}


.button1 {
  background-color: #4CAF50;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px;
    margin-top: 5%;
    position: relative;
}

.texto-2 {
  background-color: #008CBA;
  color: white;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 10px 0px;
  border-radius: 5px;
}

.texto-2:hover {
  background-color: #005f73;
}

#pokedex, #formulario {
  padding: 10px;
    background-color: #f5f5f500;
    margin-top: 10px;
}

#pokedex a, #formulario a {
  color: #333;
  text-decoration: none;
}

#pokedex a:hover, #formulario a:hover {
  text-decoration: underline;
}

button:hover {
	background-color: #000;
}


.boxlogin {
    margin-left: -34%;
    position: absolute;
    margin-top: -4%;
}

.box-email1{
	margin-top: 60px;
}

.box-senha1{
    margin-top: 120px;
}

.box-email {
    margin-top: 60px;
}

.box-senha {
    margin-top: 120px;
}

.boxcadastro {
    margin-left: 12%;
}

@media only screen and (max-width: 600px) {
    /* styles for small screens */
    body {
        font-size: 14px;
    }
    .Background {
        width: 100%;
        height: auto;
    }
}

@media only screen and (min-width: 601px) {
    /* styles for larger screens */
    body {
        font-size: 16px;
    }
    .Background {
        width: 50%;
        height: auto;
    }
}

/* Estilo para os rótulos */
label {
    display: block;
    margin-bottom: 5px;
}

/* Estilo para os campos de entrada */
input[type="text"],
input[type="password"] {
    padding: 5px;
    width: 200px;
    margin-bottom: 10px;
}

/* Estilos para os botões */
button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    margin-top: 190px;
    margin-left: 60px;
    position: absolute;
}

/* Estilos para os parágrafos */
p {
    margin: 0;
    margin-bottom: 15px;
}

/* Estilos para o bloco de login */
.login-block {
    text-align: center;
    margin: 0 auto;
}

</style>

<body>

    <header>
		<nav>
			<ul>
				<li><a href="http://localhost/Pokedex/index.php">Home</a></li>
				<li><a href="C:\Users\Júlio\Desktop\php-8.2.3\portfolio.html">Portfolio</a></li>
				<li><a href="https://www.instagram.com/julio_casablancas/" target="_blank"><img class="social-logo" src="imagens/instagram-social.png"></a></li>
				<li><a href="https://www.linkedin.com/in/julio-bonfatti-cremasco-4b0489114/" target="_blank"><img class="social-logo" src="imagens/linkedin.png"></a></li>
			</ul>
		</nav>
	</header>
	
	<main>

    <h1>Acesse sua conta</h1>
    <form action="" method="POST">
    
    <div class="boxlogin">
    <p class="box-email1">
        <label for="email">E-mail</label>
        <input type="text" id="email" name="email">
    </p>
    <p class="box-senha1">
        <label for="senha">Senha</label>
        <input type="password" id="senha" name="senha">
    </p>
    <p>
        <button class="login" type="submit">Login</button>
    </p> </div>
</form>

<form action="cadastro.php" method="POST">
    <div class="boxcadastro">
    <p class="box-email">
        <label for="email-cadastro">E-mail</label>
        <input type="text" id="email-cadastro" name="email">
    </p>
    <p class="box-senha">
        <label for="senha-cadastro">Senha</label>
        <input type="password" id="senha-cadastro" name="senha">
    </p>
    <p class="box-nome">
        <label for="nome">Nome</label>
        <input type="text" id="nome" name="nome">
    </p>
    <p>
        <button class="cadastro" type="submit">Cadastrar</button>
    </p>
    </div>
</form>
</main>
</body>
</html>