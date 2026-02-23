<?php
include 'conexão.php';

if(isset($_POST['matricular'])){
    $aluno = $_POST['aluno'];
    $curso = $_POST['curso'];
    $data = date("Y-m-d");

    $stmt = $conn->prepare("INSERT INTO matricula (id_aluno, id_curso, data_matricula) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $aluno, $curso, $data);
    $stmt->execute();

    header("Location: matricula.php");
}

if(isset($_GET['cancelar'])){
    $aluno = $_GET['aluno'];
    $curso = $_GET['curso'];

    $stmt = $conn->prepare("DELETE FROM matricula WHERE id_aluno=? AND id_curso=?");
    $stmt->bind_param("ii", $aluno, $curso);
    $stmt->execute();

    header("Location: matricula.php");
}

$alunos = $conn->query("SELECT * FROM aluno");
$cursos = $conn->query("SELECT * FROM curso");

$matriculas = $conn->query("
    SELECT a.nome AS aluno, c.nome AS curso, m.id_aluno, m.id_curso
    FROM matricula m
    JOIN aluno a ON m.id_aluno = a.id
    JOIN curso c ON m.id_curso = c.id
");
?>

<h2>Matricular Aluno</h2>
<form method="POST">
    Aluno:
    <select name="aluno">
        <?php while($a = $alunos->fetch_assoc()): ?>
            <option value="<?= $a['id'] ?>"><?= $a['nome'] ?></option>
        <?php endwhile; ?>
    </select>

    Curso:
    <select name="curso">
        <?php while($c = $cursos->fetch_assoc()): ?>
            <option value="<?= $c['id'] ?>"><?= $c['nome'] ?></option>
        <?php endwhile; ?>
    </select>

    <button name="matricular">Matricular</button>
</form>

<h3>Lista de Matrículas</h3>
<?php while($m = $matriculas->fetch_assoc()): ?>
    <?= $m['aluno'] ?> → <?= $m['curso'] ?>
    <a href="?cancelar=1&aluno=<?= $m['id_aluno'] ?>&curso=<?= $m['id_curso'] ?>">Cancelar</a>
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