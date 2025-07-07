<?php

// Configurações do banco de dados
$host = 'localhost';
$user = 'root'; // usuário padrão do XAMPP
$password = ''; // senha padrão do XAMPP (vazia)
$database = 'login'; // substitua pelo nome do seu banco de dados

// Conectar ao banco de dados
$conn = new mysqli($host, $user, $password, $database);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Criptografia de senha (apenas para exemplo/criação de usuários)
// echo password_hash(123456, PASSWORD_DEFAULT);

// Receber dados do forms
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Acessar o IF quando o usuario clicar no botão de acesso do formulario
if (!empty($dados["SendHome"])) {
    header("Location: home.html");
    exit();
}

if (!empty($dados["Sendlogin"])) {
    // Preparar a consulta SQL
    $query_usuario = "SELECT id, senha FROM usuarios WHERE usuario = ? LIMIT 1";
    $stmt = $conn->prepare($query_usuario);
    $stmt->bind_param("s", $dados["usuario"]);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows == 1) {
        // Usuário encontrado, verificar senha
        $row_usuario = $resultado->fetch_assoc();
        if (md5($dados["senha_usuario"]) === $row_usuario['senha']) {
            // Senha correta - iniciar sessão e redirecionar
            session_start();
            $_SESSION['id'] = $row_usuario['id'];
            $_SESSION['usuario'] = $dados["usuario"];
            
            header("Location: dashboard.php"); // redireciona para página restrita
            exit();
        } else {
            echo "<p class='error'>Erro: Senha incorreta!</p>";
        }
    } else {
        echo "<p class='error'>Erro: Usuário não encontrado!</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }
        
        .login-logo {
            margin-bottom: 20px;
        }
        
        .login-logo img {
            width: 80px;
            height: 80px;
        }
        
        h2 {
            color: #333;
            margin-bottom: 25px;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }
        
        .btn {
            flex: 1;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        
        .btn-primary {
            background-color: #4CAF50;
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #45a049;
        }
        
        .btn-secondary {
            background-color: #2196F3;
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #0b7dda;
        }
        
        .error {
            color: #f44336;
            margin: 10px 0;
            padding: 10px;
            background-color: #ffebee;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="login-container">
       <h2>Login</h2>
        
        <?php if(isset($_GET['error'])): ?>
            <p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" id="usuario" name="usuario" placeholder="Digite seu usuário" required>
            </div>
            
            <div class="form-group">
                <label for="senha_usuario">Senha</label>
                <input type="password" id="senha_usuario" name="senha_usuario" placeholder="Digite sua senha" required>
            </div>
            
            <div class="button-group">
                <input type="submit" name="Sendlogin" value="Dashboard" class="btn btn-primary">
                <input type="submit" name="SendHome" value="Home" class="btn btn-secondary">
            </div>
        </form>
    </div>
</body>
</html>
