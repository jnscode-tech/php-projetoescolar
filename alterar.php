<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<?php
// Inicia a sessão (permite usar $_SESSION)
session_start();

// Garante que o array de alunos existe
if (!isset($_SESSION['alunos'])) {
    $_SESSION['alunos'] = [];
}

// =====================
// 🔴 EXCLUSÃO DE ALUNO
// =====================

// Verifica se veio pela URL:
// ?acao=excluir&matricula=123
if (isset($_GET['acao']) && $_GET['acao'] == 'excluir' && isset($_GET['matricula'])) {

    // Guarda a matrícula que será excluída
    $matriculaExcluir = $_GET['matricula'];

    // Percorre todos os alunos
    foreach ($_SESSION['alunos'] as $key => $a) {

        // Se encontrar o aluno com a matrícula
        if ($a['matricula'] == $matriculaExcluir) {

            // Remove o aluno do array
            unset($_SESSION['alunos'][$key]);

            // Reorganiza os índices do array (evita buracos)
            $_SESSION['alunos'] = array_values($_SESSION['alunos']);

            // Mensagem de sucesso
            $msg = "Aluno excluído com sucesso!";
            break; // Para o loop
        }
    }
}

// Inclui menu e funções
include("menu.php");
include("funcoes.php");

// Array que vai guardar os resultados da busca
$resultados = [];

// Garante que a variável $msg existe
$msg = $msg ?? "";

// =====================
// 🔎 BUSCA DE ALUNO
// =====================

// Verifica se clicou no botão "Buscar"
if (isset($_POST['buscar'])) {

    // Pega a matrícula digitada
    $matriculaBusca = $_POST['matricula'];

    // Percorre todos os alunos
    foreach ($_SESSION['alunos'] as $a) {

        // Se a matrícula for igual
        if ($a['matricula'] == $matriculaBusca) {

            // Adiciona no array de resultados
            $resultados[] = $a;
        }
    }

    // Se não encontrou ninguém
    if (empty($resultados)) {
        $msg = "Matrícula não encontrada!";
    }
}
?>

<h1 class="h1_buscar">Pequisar aluno para realizar Alteração</h1>

<div class="container-busca">

    <!-- FORMULÁRIO DE BUSCA -->
    <form method="post" class="form-busca">

        <label for="matricula">Digite a Matrícula do Aluno</label>

        <!-- Campo para digitar matrícula -->
        <input type="text" name="matricula" id="matricula" placeholder="Somente número" required>

        <!-- Botão que envia o formulário -->
        <button type="submit" name="buscar">Buscar</button>

    </form>

    <!-- =====================
         💬 MENSAGEM
    ====================== -->
    <?php if (!empty($msg)): ?>
        <div class="mensagem erro">
            <?= $msg ?>
        </div>
    <?php endif; ?>

    <!-- =====================
         📋 TABELA DE RESULTADO
    ====================== -->
    <?php if (!empty($resultados)): ?>
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
                        <th>Frequência (%)</th>
                        <th>Situação</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <!-- Percorre os resultados encontrados -->
                    <?php foreach ($resultados as $a):

                        // Calcula média
                        $media = calcularMedia($a['nota1'], $a['nota2']);

                        // Calcula frequência
                        $freq = calcularFrequencia($a['faltas']);

                        // Define situação (aprovado/reprovado)
                        $status = situacao($media, $freq);
                    ?>

                        <tr>
                            <td><?= $a['matricula'] ?></td>
                            <td><?= $a['nome'] ?></td>
                            <td><?= $a['nota1'] ?></td>
                            <td><?= $a['nota2'] ?></td>
                            <td><?= $media ?></td>
                            <td><?= $a['faltas'] ?></td>
                            <td><?= $freq ?></td>

                            <!-- Aplica classe CSS conforme status -->
                            <td class="<?= (trim(strtolower($status)) == 'aprovado') ? 'aprovado' : 'reprovado' ?>">
                                <?= $status ?>
                            </td>

                            <td>
                                <!-- Botão editar -->
                                <a href="editar.php?matricula=<?= $a['matricula'] ?>" class="btn-editar">
                                    Editar
                                </a>

                                <!-- Botão excluir -->
                                <!-- Envia pela URL a ação e matrícula -->
                                <a href="?acao=excluir&matricula=<?= $a['matricula'] ?>"
                                   class="btn-excluir"
                                   onclick="return confirm('Tem certeza que deseja excluir este aluno?')">
                                    Excluir
                                </a>
                            </td>
                        </tr>

                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    <?php endif; ?>

</div>

<!-- Rodapé -->
<?php include("footer.php"); ?>

</body>
</html>