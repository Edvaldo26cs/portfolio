<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$password = "";
$dbname = "portfolio"; // ← atualizaste isto!

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na ligação: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $assunto = $_POST['subject'] ?? '';
    $mensagem = $_POST['message'] ?? '';

    if ($nome && $email && $assunto && $mensagem) {
        $stmt = $conn->prepare("INSERT INTO mensagens (nome, email, assunto, mensagem) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nome, $email, $assunto, $mensagem);

        if ($stmt->execute()) {
            echo "Mensagem gravada com sucesso!";
        } else {
            echo "Erro ao gravar mensagem: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Todos os campos são obrigatórios!";
    }
}

$conn->close();
?>


$conn->close();
?>
