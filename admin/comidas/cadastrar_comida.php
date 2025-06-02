<?php
include("../../database/conexao.php");
include("../../auth/validar_sessao.php");
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
    <title>Sistema de Fichas | </title>
</head>

<body>
    <div class="interface">
        <p class="acesse">Cadastrar produto</p>
        <form action="../../database/comidas/cadastrar_comida.php" method="post">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome do alimento">
            </div>
            <div class="form-group">
                <label for="descricao">Descrição</label>
                <input type="text" name="descricao" id="descricao" placeholder="Digite a descrição do alimento">
            </div>
            <div class="form-group">
                <label for="preco">Preço</label>
                <input type="number" name="preco" id="preco" placeholder="Digite o preço do alimento">
            </div>
            <div class="form-group">
                <label for="id_categoria">Categoria</label>
                <select name="id_categoria" id="id_categoria">
                    <option value="">-- Selecione uma categoria --</option>
                    <?php
                    $sqlCategoria = "SELECT id, nome FROM categorias";
                    $resultadoCategoria = $conexao->query($sqlCategoria);
                    while ($rowCategoria = $resultadoCategoria->fetch_assoc()):
                    ?>
                        <option value="<?= htmlspecialchars($rowCategoria["id"]) ?>">
                            <?= htmlspecialchars($rowCategoria["nome"]) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="ingredientes">Ingredientes</label>
                <input type="text" name="ingredientes" id="ingredientes"
                    placeholder="Digite o ingredientes do alimento">
            </div>
            <div class="form-group">
                <label for="imagem">URL da imagem</label>
                <input type="text" name="imagem" id="imagem" placeholder="Coloque a URL da imagem">
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