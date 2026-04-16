<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<!--    O session_start(); inicia uma sessão no PHP. Uma sessão é uma forma de guardar
     dados do usuário enquanto ele navega entre páginas. -->
    <?php
   
    session_start();
    include("menu.php");
    $resultado = null;

    if (isset($_POST['buscar'])) {
        foreach ($_SESSION['alunos'] as $a) {
            if ($a['matricula'] == $_POST['matricula']) {
                $resultado = $a;
                break;
            }
        }
        // 👇 Se não encontrou
        if ($resultado === null) {
            $msg = 'Matrícula não encontrada!';
        }
    }
    ?>
     <h1 class="h1_buscar">Pesquisar Aluno</h1>
    <div class="container-busca">
        <form method="post" class="form-busca">
         
            <label for="matricula" class="lbl_matricula">Digite a Matrícula do Aluno</label>
            <input type="text" name="matricula" id="matricula" placeholder="Somente número" required>

            <button type="submit" name="buscar">Buscar</button>
        </form>

        <?php if (!empty($msg)): ?>
            <div class="mensagem erro">
                <?= $msg ?>
            </div>
        <?php endif; ?>

        <?php if ($resultado): ?>
            <div class="resultado">
                <h3>Resultado:</h3>
                <p><strong>Nome:</strong> <?= $resultado['nome'] ?></p>
                <p><strong>Matrícula:</strong> <?= $resultado['matricula'] ?></p>
            </div>
        <?php endif; ?>
    </div>

    <?php include("footer.php"); ?>


</body>

</html>