<?php
include('conexao.php');
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'login';

$mysqli = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

$mensagem = ''; // Variável para armazenar mensagens de erro ou sucesso

// Verifica se o formulário de cadastro foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['senha'])) {
    // Obtém os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta SQL para inserir os dados do formulário na tabela "usuarios"
    $sql = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    if ($mysqli->query($sql)) {
        $mensagem = "Cadastro realizado com sucesso!";
    } else {
        $mensagem = "Erro ao cadastrar: " . $mysqli->error;
    }
}

// Verifica se o formulário de login foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['usuario']) && isset($_POST['senha'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Consulta SQL para verificar as credenciais do usuário
    $sql = "SELECT * FROM usuarios WHERE email = '$usuario' AND senha = '$senha'"; // Alterado para verificar o campo 'email'
    $result = $mysqli->query($sql);

    if ($result->num_rows === 1) {
        // Inicia a sessão e redireciona para o painel após o login bem-sucedido
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: painel.php"); // Substitua "painel.php" pelo nome da página de painel
        exit();
    } else {
        $login_mensagem = "Usuário ou senha incorretos.";
    }
}

// Feche a conexão quando terminar
$mysqli->close();
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

footer {
  background-color: #fff;
    padding: 10px;
    box-shadow: 0px -2px 5px rgb(0 0 0 / 10%);
    margin-top: 11%;
    position: relative;
    width: 100%;
}

.boxlogin {
    margin-left: 45%;
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

/* Estilização do slider */
.slider {
  position: relative;
  width: 100%;
  height: 500px;
}

.slider-wrapper {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  display: flex;
}

.slide {
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 48px;
  color: #fff;
}

.slide:nth-child(1) {
  background-color: #f44336;
}

.slide:nth-child(2) {
  background-color: #e91e63;
}

.slide:nth-child(3) {
  background-color: #9c27b0;
}

.slide:nth-child(4) {
  background-color: #3f51b5;
}

.slider-dots {
  position: absolute;
  bottom: 20px;
  left: 50%;
  transform: translateX(-50%);
  display: flex;
}

.dot {
  width: 15px;
  height: 15px;
  margin: 0 10px;
  border-radius: 50%;
  background-color: #ddd;
  cursor: pointer;
}

.dot.active {
  background-color: #333;
}

#mensagem{
  margin-top: -3%;
}

.Login-word{
  margin-left: -77%;
    margin-top: 90%;
    position: absolute;
}

.Cadastro-word{
  margin-left: 5px;
}

.Login-form{
  margin-left: -90%;
    margin-top: 10%;
}


.Cadastro-form{
  margin-left: -90%;
    margin-top: 6%;
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
        
		<h1>Landing Page by Júlio Cremasco</h1>
		
		<div class="slider">
			<div class="slider-wrapper">
			  <div class="slide">
				<h1>Olá. Me chamo Júlio, tenho 27 anos, e nesta página você vai estar vendo um pouco do que sei fazer
					em programação e marcação, front e backend.</h1>
			  </div>
			  <div class="slide">
				<h1>Comecei a estudar programação no final do ano de 2021, naquela altura, estava recém
					graduado em psicologia, e não estava vendo futuro e nem me identificando com a graduação.</h1>
			  </div>
			  <div class="slide">
				<h1>O começo foi motivado por uma conversa com um amigo, sobre como nós, nascidos em 1995, pegamos
					o começo do computador em casa, o começo da internet, nós fomos a geração que desde criança, já tinhamos contato com a 
					máquina, mesmo que não fosse programando, já havia essa familiaridade.</h1>
			  </div>
			  <div class="slide">
				<h1>Após ingressar no mundo da programação, fiquei fascinado com o leque de possibilidades dentro dessa área, e desde então
					essa tem sido minha paixão.
				</h1>
			  </div>
			</div>
			<div class="slider-dots">
			  <span class="dot"></span>
			  <span class="dot"></span>
			  <span class="dot"></span>
			  <span class="dot"></span>
			</div>
		  </div>
		  

		<p class="pmain">Aqui, você poderá ter acesso a alguns projetos.</p>
		<button class="button1" onclick="showDivs()">Portfolio</button>
        <div id="pokedex" style="display:none;"><a class="texto-2" href="C:\Users\Júlio\Desktop\php-8.2.3\Pokedex.html">Projeto Pokedex</a></div>
        <div id="formulario" style="display:none;"><a class="texto-2" href="http://localhost/Pokedex/formulario.php">Formulário</a></div>
   
    <h2>Formulários</h2>

    <div id="formulario" style="display:none;">
    <a class="texto-2" href="http://localhost/Pokedex/formulario.php">Formulário</a>
</div>

<h2 class="Login-word">Login</h2>
    <?php if (isset($login_mensagem)) : ?>
        <p><?php echo $login_mensagem; ?></p>
    <?php endif; ?>

    <form class="Login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="usuario">Usuário:</label>
        <input type="text" id="usuario" name="usuario" required><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br>

        <input type="submit" name="login" value="Login">
    </form>

<h2 class="Cadastro-word">Cadastro</h2>
    <?php if (!empty($mensagem)) : ?>
            <p id="mensagem"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <form class="Cadastro-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required><br>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required><br>

            <input type="submit" value="Cadastrar">
        </form>
	
	</main>

<script>
  
        function showDivs() {
            var pokedexDiv = document.getElementById("pokedex");
            var formularioDiv = document.getElementById("formulario");
          
            if (pokedexDiv.style.display === "none") {
                pokedexDiv.style.display = "block";
            } else {
                pokedexDiv.style.display = "none";
            }
          
            if (formularioDiv.style.display === "none") {
                formularioDiv.style.display = "block";
            } else {
                formularioDiv.style.display = "none";
            }
        }

        const slides = document.querySelectorAll('.slide');
        const dots = document.querySelectorAll('.dot');
        let currentSlide = 0;

        // Código para restaurar todos os slides e pontos
        function reset() {
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = 'none';
                dots[i].classList.remove('active');
            }
        }

        // Mostra o slide e o ponto atual
        function showSlide(n) {
            reset();
            slides[n].style.display = 'flex';
            dots[n].classList.add('active');
        }

        // Mostra o próximo slide e ponto
        function nextSlide() {
            currentSlide++;
            if (currentSlide >= slides.length) {
                currentSlide = 0;
            }
            showSlide(currentSlide);
        }

        // Auto-play do slider
        let timer = setInterval(nextSlide, 13000);

        // Event listener para clicar em um ponto
        for (let i = 0; i < dots.length; i++) {
            dots[i].addEventListener('click', function() {
                currentSlide = i;
                showSlide(currentSlide);
                clearInterval(timer);
                timer = setInterval(nextSlide, 15000);
            });
        }

        // Mostra o primeiro slide
        showSlide(0);
    </script>

</body>
</html>