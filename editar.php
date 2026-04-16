<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php
    session_start();
    include("menu.php");
    include("funcoes.php");

    // Garante array
    if (!isset($_SESSION['alunos'])) {
        $_SESSION['alunos'] = [];
    }

    $aluno = null;
    $msg = "";

    // ==========================
// 🔎 BUSCAR ALUNO PARA EDITAR
// ==========================
    if (isset($_GET['matricula'])) {

        foreach ($_SESSION['alunos'] as $a) {
            if ($a['matricula'] == $_GET['matricula']) {
                $aluno = $a;
                break;
            }
        }
    }

    // ==========================
// 💾 SALVAR ALTERAÇÕES
// ==========================
    if (isset($_POST['salvar'])) {

        foreach ($_SESSION['alunos'] as $key => $a) {

            if ($a['matricula'] == $_POST['matricula']) {

                // Atualiza os dados
                $_SESSION['alunos'][$key]['nome'] = $_POST['nome'];
                $_SESSION['alunos'][$key]['nota1'] = $_POST['nota1'];
                $_SESSION['alunos'][$key]['nota2'] = $_POST['nota2'];
                $_SESSION['alunos'][$key]['faltas'] = $_POST['faltas'];

                $msg = "Aluno atualizado com sucesso!";

                // Atualiza variável local também
                $aluno = $_SESSION['alunos'][$key];

                break;
            }
        }
    }
    ?>

    <h1 class="h1_buscar">Editar Aluno</h1>

    <div class="container-busca">

        <?php if ($aluno): ?>

            <form method="post" class="form-busca">

                <!-- Matrícula (não editável) -->
                <label>Matrícula</label>
                <input type="text" name="matricula" value="<?= $aluno['matricula'] ?>" readonly>

                <label>Nome</label>
                <input type="text" name="nome" value="<?= $aluno['nome'] ?>" required>

                <label>Nota 1</label>
                <input type="number" step="0.1" name="nota1" value="<?= $aluno['nota1'] ?>" required>

                <label>Nota 2</label>
                <input type="number" step="0.1" name="nota2" value="<?= $aluno['nota2'] ?>" required>

                <label>Faltas</label>
                <input type="number" name="faltas" value="<?= $aluno['faltas'] ?>" required>

                <button type="submit" name="salvar">Salvar Alterações</button>

                <a href="alterar.php?matricula=<?= $aluno['matricula'] ?>" class="btn-voltar">
                   Retornar ao Buscar
                </a>

            </form>

        <?php else: ?>
            <p>Aluno não encontrado.</p>
        <?php endif; ?>

        <!-- Mensagem -->
        <?php if (!empty($msg)): ?>
            <div class="mensagem sucesso">
                <?= $msg ?>
            </div>
        <?php endif; ?>

    </div>

    <?php include("footer.php"); ?>

</body>

</html>