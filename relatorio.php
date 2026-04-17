<?php
session_start();
include("menu.php");
include("funcoes.php");

$alunos = $_SESSION['alunos'] ?? [];

$total = count($alunos);
$soma = 0;

$diasLetivos = 250;

$aprovados = [];
$reprovados = [];

foreach ($alunos as $a) {

    $media = calcularMedia($a['nota1'], $a['nota2']);
    $frequencia = calcularFrequencia($a['faltas']);

    $soma += $media;

    $status = situacao($media, $frequencia);

    if ($status == "APROVADO") {
        $aprovados[] = $a['nome'];
    } else {
        $reprovados[] = $a['nome'];
    }
}

$mediaGeral = $total > 0 ? $soma / $total : 0;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container-relatorio">

    <h2 class="h2_relatorio">📊 Relatório da Turma</h2>

    <!-- CARDS -->
    <div class="cards-relatorio">
        <div class="card">
            <h3>Total de Alunos</h3>
            <p><?= $total ?></p>
        </div>

        <div class="card">
            <h3>Média da Turma</h3>
            <p><?= number_format($mediaGeral, 2, ',', '.') ?></p>
        </div>

        <div class="card">
            <h3>Dias Letivos</h3>
            <p><?= $diasLetivos ?></p>
        </div>
    </div>

    <!-- LISTAS -->
    <div class="listas">

        <div class="box">
            <h3 class="rel-aprovado">Aprovados</h3>

            <?php if (count($aprovados) > 0): ?>
                <?php foreach ($aprovados as $nome): ?>
                    <?= $nome ?><br>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum aluno aprovado</p>
            <?php endif; ?>
        </div>

        <div class="box">
            <h3 class="rel-reprovado">Reprovados</h3>

            <?php if (count($reprovados) > 0): ?>
                <?php foreach ($reprovados as $nome): ?>
                    <?= $nome ?><br>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum aluno reprovado</p>
            <?php endif; ?>
        </div>

    </div>

</div>

<?php include_once("footer.php"); ?>

</body>
</html>