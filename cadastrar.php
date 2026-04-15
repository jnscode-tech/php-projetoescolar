<?php
session_start();

// Inicializa o array corretamente
if (!isset($_SESSION['alunos'])) {
    $_SESSION['alunos'] = [];
}

// Cadastro de aluno
if (isset($_POST['cadastrar'])) {

    $matricula = $_POST['matricula'];
    $nome = $_POST['nome'];
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $faltas = $_POST['faltas'];

    // Verificar se matrícula já existe
    $existe = false;

    foreach ($_SESSION['alunos'] as $a) {
        if ($a['matricula'] == $matricula) {
            $existe = true;
            break;
        }
    }

    if ($existe) {
        echo "<p style='color:red;'>Matrícula já cadastrada!</p>";
    } else {

        $aluno = [
            "matricula" => $matricula,
            "nome" => $nome,
            "nota1" => $nota1,
            "nota2" => $nota2,
            "faltas" => $faltas
        ];

        $_SESSION['alunos'][] = $aluno;

        echo "<p style='color:green;'>Aluno cadastrado com sucesso!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php include("menu.php"); ?>

<h3>Cadastrar Aluno</h3>

<form method="post" class="formularioAluno">
    <label>Matrícula:</label><br>
    <input type="text" name="matricula" required><br><br>

    <label>Nome:</label><br>
    <input type="text" name="nome" required><br><br>

    <label>Nota 1:</label><br>
    <input type="number" step="0.1" name="nota1" required><br><br>

    <label>Nota 2:</label><br>
    <input type="number" step="0.1" name="nota2" required><br><br>

    <label>Qtd de Faltas:</label><br>
    <input type="number" name="faltas" required><br><br>

    <button type="submit" name="cadastrar">Cadastrar</button>
</form>

</body>
</html>
