<?php
require_once("../../database/conexao.php");
include("../../auth/validar_sessao.php");
$id_comida = strip_tags(trim($_POST["id_comida"]));

$select = "SELECT nome, descricao, preco, ingredientes, imagem, id_categoria FROM comidas WHERE id = ?";
$stmt = $conexao->prepare($select);
$stmt->bind_param("i", $id_comida);
$stmt->execute();
$stmt->bind_result($nome, $descricao, $preco, $ingredientes, $imagem, $id_categoria);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/comidas_editar.css">
    <link rel="stylesheet" href="../../assets/css/mensagem.css">
    <title>Sistema de Fichas | Entrar</title>
</head>

<body>
    <div class="interface">
        <p class="acesse">Editar produto</p>
        <form action="../../database/comidas/editar_comida.php" method="post">
            <input type="hidden" name="id" value="<?= $id_comida ?>">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome do alimento"
                    value="<?= htmlspecialchars($nome) ?>">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" id="descricao" placeholder="Digite a descrição do alimento"
                    value="<?= htmlspecialchars($descricao) ?>">
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" name="preco" id="preco" placeholder="Digite o preço do alimento"
                    value="<?= htmlspecialchars($preco) ?>">
            </div>
            <div class="form-group">
                <label for="id_categoria">Categoria</label>
                <select name="id_categoria" id="id_categoria">
                    <?php
                    $sqlCategoria = "SELECT id, nome FROM categorias";
                    $resultadoCategoria = $conexao->query($sqlCategoria);
                    while ($rowCategoria = $resultadoCategoria->fetch_assoc()):
                    ?>
                        <option value="<?= htmlspecialchars($rowCategoria["id"]) ?>"
                            <?= ($id_categoria == $rowCategoria["id"]) ? "selected" : "" ?>>
                            <?= htmlspecialchars($rowCategoria["nome"]) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <input type="text" name="ingredientes" id="ingredientes" placeholder="Digite o ingredientes do alimento"
                    value="<?= htmlspecialchars($ingredientes) ?>">
            </div>
            <div class="form-group">
                <label for="imagem">URL da imagem</label>
                <input type="text" name="imagem" id="imagem" placeholder="Coloque a URL da imagem"
                    value="<?= $imagem ?>">
            </div>
            <button type="submit">Editar</button>
        </form>
        <a href="comidas.php" target="_self" class="voltar"><i class="fa-solid fa-arrow-left"></i>Cancelar edição</a>
    </div>
    <?php
    include("../../includes/mensagem.php");
    ?>
</body>

</html>