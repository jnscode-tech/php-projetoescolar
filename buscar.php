<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
</body>
</html>


<?php
session_start();
include("menu.php");

$resultado = null;

if(isset($_POST['buscar'])){
    foreach($_SESSION['alunos'] as $a){
        if($a['matricula'] == $_POST['matricula']){
            $resultado = $a;
        }
    }
}
?>

<form method="post">
<input name="matricula" placeholder="Matrícula">
<button name="buscar">Buscar</button>
</form>

<?php if($resultado): ?>
<p><?= $resultado['nome'] ?></p>
<?php endif; ?>

 <?php include("footer.php"); ?>