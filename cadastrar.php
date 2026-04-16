<?php
session_start();
// Inicializa o array corretamente
if (!isset($_SESSION['alunos'])) {
    $_SESSION['alunos'] = [];
}
$msg = '';
$msgTipo = '';

// Pega todos os dados para o Cadastro de aluno
if (isset($_POST['cadastrar'])) {

    $matricula = trim($_POST['matricula']);
    $nome = trim($_POST['nome']);
    $nota1 = $_POST['nota1'];
    $nota2 = $_POST['nota2'];
    $faltas = $_POST['faltas'];

    // Tratamento dos campos e verificação se a matrícula já existe
    if (empty($matricula) || empty($nome) || empty($nota1) || empty($nota2)) {
        $msg = 'Todos os dados são obrigatórios.';
        $msgTipo = 'erro';
    } else {

        $existe = false;

        // Verifica se já existe a matrícula
        foreach ($_SESSION['alunos'] as $aluno) {
            if ($aluno['matricula'] == $matricula) {
                $existe = true;
                break;
            }
        }

        if ($existe) {
            $msg = 'Já existe um aluno com essa matrícula!';
            $msgTipo = 'erro';
        } else {
            $_SESSION['alunos'][] = [
                'matricula' => $matricula,
                'nome' => $nome,
                'nota1' => floatval($nota1),
                'nota2' => floatval($nota2),
                'faltas' => intval($faltas),
            ];
            $msg = 'Aluno cadastrado com sucesso!';
            $msgTipo = 'sucesso';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include("menu.php"); ?>

     <h1 class="h1_cadastrar">Cadastrar Alunos</h1>
   
    <div class="content">

       

        <form method="post" class="formularioAluno">

            <div>
                <label>Matrícula:</label>
                <input type="text" name="matricula" required>
            </div>

            <div class="campo completo">
                <label>Nome:</label>
                <input type="text" name="nome" maxlength="50" required>
            </div>
            <div class="campo">
                <label>Digite a 1ª Nota:</label>
                <input type="number" step="0.1" name="nota1" required>
            </div>
            <div class="campo">
                <label>Digite a 2ª Nota:</label>
                <input type="number" step="0.1" name="nota2" required>
            </div>
            <div class="campo completo">
                <label>Digite a qtd de aulas do bimestre:</label>
                <input type="number" name="faltas" required>
            </div>
            <button type="submit" name="cadastrar" class="completo">Cadastrar</button>
        </form>

        <!-- 👇 AQUI FICA FORA DO FORM -->
        <?php if (!empty($msg)): ?>
            <div class="mensagem <?php echo $msgTipo; ?>">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>


   
    </div>
 <?php include("footer.php"); ?>

</body>

</html>