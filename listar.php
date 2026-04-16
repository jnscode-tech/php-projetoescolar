<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php
session_start();
include("menu.php");
include("funcoes.php");

$alunos = $_SESSION['alunos'] ?? [];
$total = count($alunos); // 👈 CORREÇÃO
?>
   <h1 class="h1_listar">
        Lista de alunos da Escola - 2026
    </h1>

<div class="container-tabela">
 

<table border="1">
    <thead>
        <tr>
            <th>Matrícula</th>    
            <th>Nome</th>
            <th>Nota 1</th>
            <th>Nota 2</th>
            <th>Média</th>
            <th>Faltas</th>
            <th>Frequencia (%)</th>
            <th>Situação</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($alunos as $a): 
        
        $media = calcularMedia($a['nota1'],$a['nota2']);
        $freq = calcularFrequencia($a['faltas']);
        ?>
        
        <tr>
            <td><?= $a['matricula'] ?></td>
            <td><?= $a['nome'] ?></td>
            <td><?= $a['nota1'] ?></td>
            <td><?= $a['nota2'] ?></td>
            <td><?= number_format($media, 1, ',', '.') ?></td>
            <td><?= $a['faltas']?></td>
            <td><?= $freq ?></td>

            <td><?= situacao($media,$freq) ?></td>
        </tr>

        <?php endforeach; ?>
    </tbody>
</table>
 


</div>

<!-- TOTAL ABAIXO DA TABELA -->
<div class="resumo-tabela">
    <p><strong>Total de alunos:</strong> <?= $total ?></p>
</div>
 <?php include("footer.php"); ?>


</body>
</html>