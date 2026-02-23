<?php
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema Escola</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            text-align: center;
            margin-top: 80px;
        }
        h1 {
            color: #333;
        }
        .menu {
            margin-top: 40px;
        }
        .menu a {
            display: inline-block;
            margin: 15px;
            padding: 15px 30px;
            text-decoration: none;
            background: #007bff;
            color: white;
            border-radius: 8px;
            font-size: 18px;
            transition: 0.3s;
        }
        .menu a:hover {
            background: #0056b3;
        }
        footer {
            margin-top: 80px;
            color: #777;
            font-size: 14px;
        }
    </style>
</head>
<body>

    <h1>📚 Sistema de Gestão Escolar</h1>
    <p>Bem-vindo! Escolha uma opção abaixo:</p>

    <div class="menu">
        <a href="aluno.php">👨‍🎓 Gerenciar Alunos</a>
        <a href="curso.php">📘 Gerenciar Cursos</a>
        <a href="matricula.php">📝 Gerenciar Matrículas</a>
    </div>

    <footer>
        © <?php echo date("Y"); ?> - Sistema Escola
    </footer>

</body>
</html>