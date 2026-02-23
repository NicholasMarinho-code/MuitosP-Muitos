<?php
include 'conexão.php';

if(isset($_POST['salvar'])){
    $nome = $_POST['nome'];
    $carga = $_POST['carga'];

    if(empty($_POST['id'])){
        $stmt = $conn->prepare("INSERT INTO curso (nome, carga_horaria) VALUES (?, ?)");
        $stmt->bind_param("si", $nome, $carga);
    } else {
        $id = $_POST['id'];
        $stmt = $conn->prepare("UPDATE curso SET nome=?, carga_horaria=? WHERE id=?");
        $stmt->bind_param("sii", $nome, $carga, $id);
    }

    $stmt->execute();
    header("Location: curso.php");
}

if(isset($_GET['excluir'])){
    $id = $_GET['excluir'];
    $stmt = $conn->prepare("DELETE FROM curso WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: curso.php");
}

$editar = null;
if(isset($_GET['editar'])){
    $id = $_GET['editar'];
    $result = $conn->query("SELECT * FROM curso WHERE id=$id");
    $editar = $result->fetch_assoc();
}

$result = $conn->query("SELECT * FROM curso");
?>

<h2>Cadastro de Curso</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?= $editar['id'] ?? '' ?>">
    Nome: <input type="text" name="nome" required value="<?= $editar['nome'] ?? '' ?>">
    Carga Horária: <input type="number" name="carga" required value="<?= $editar['carga_horaria'] ?? '' ?>">
    <button name="salvar">Salvar</button>
</form>

<h3>Lista</h3>
<?php while($row = $result->fetch_assoc()): ?>
    <?= $row['nome'] ?> - <?= $row['carga_horaria'] ?>h
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