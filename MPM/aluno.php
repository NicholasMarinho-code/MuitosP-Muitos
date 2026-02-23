<?php
include 'conexão.php';

if(isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    if(empty($_POST['id'])){
        $stmt = $conn->prepare("INSERT INTO aluno (nome, email) VALUES (?, ?)");
        $stmt->bind_param("ss", $nome, $email);
    } else { 
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE aluno SET nome=?, email=? WHERE id=?");
        $stmt->bind_param("ssi", $nome, $email, $id);
    }

    $stmt->execute();
    header("Location: aluno.php");
}

if(isset($_GET['excluir'])){
    $id = $_GET['excluir'];
    $stmt = $conn->prepare("DELETE FROM aluno WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: aluno.php");
}

$editar = null;
if(isset($_GET['editar'])){
    $id = $_GET['editar'];
    $result = $conn->query("SELECT * FROM aluno WHERE id=$id");
    $editar = $result->fetch_assoc();
}

$result = $conn->query("SELECT * FROM aluno");
?>

<h2>Cadastro de Aluno</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $editar['id'] ?? '' ?>">
    Nome: <input type="text" name="nome" required value="<?= $editar['nome'] ?? '' ?>">
    Email: <input type="email" name="email" required value="<?= $editar['email'] ?? '' ?>">
    <button name="salvar">Salvar</button>
</form>

<h3>Lista</h3>
<?php while($row = $result->fetch_assoc()): ?>
    <?= $row['nome'] ?> - <?= $row['email'] ?>
    <a href="?editar=<?= $row['id'] ?>">Editar</a>
    <a href="?excluir=<?= $row['id'] ?>">Excluir</a>
    <br>
<?php endwhile; ?>

<br><br>

<a href="index.php" style="
    text-decoration:none;
    padding:8px 15px;
    background:#6c757d;
    color:white;
    border-radius:5px;">
    ⬅ Voltar para o Início
</a>