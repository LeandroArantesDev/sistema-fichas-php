<?php
include("../../database/funcoes.php");
include("../../auth/validar_sessao.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/comidas.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/mensagem.css">
    <title>Comidas</title>
</head>

<body>
    <header>
        <div class="interface">
            <a href="../dashboard.php" target="_self" class="voltar"><i class="fa-solid fa-arrow-left"></i>Voltar
                para Dashboard</a>
            <nav class="links">
                <a href="../../auth/sair.php" target="_self">Sair</a>
            </nav>
        </div>
    </header>
    <main>
        <div class="interface">
            <div class="botoes">
                <div class="nome">
                    <h1>Gerenciar de Cardápio</h1>
                    <p>Gerencie os itens do seu cardápio</p>
                </div>
                <a href="cadastrar_comida.php">Adicionar<i class="fa-solid fa-plus"></i></a>
            </div>
            <div class="container-cards">
                <?php
                $select = "SELECT id, nome, descricao, preco, ingredientes, imagem FROM comidas";
                $resultado = $conexao->query($select);
                if ($resultado->num_rows >= 1):
                    while ($row = $resultado->fetch_assoc()):
                        $nome = $row["nome"];
                        $descricao = $row["descricao"];
                        $preco = $row["preco"];
                        $ingredientes = $row["ingredientes"];
                        $id = $row["id"];
                        $imagem = $row["imagem"];

                ?>
                        <article class="card">
                            <div class="item">
                                <img src="<?= (isset($imagem)) ? $imagem : '../../assets/img/img_padrao.jpg' ?>"
                                    alt="<?= htmlspecialchars($descricao) ?>">
                                <div class="informacoes">
                                    <p class="nome"><?= htmlspecialchars($nome) ?></p>
                                    <p class="descricao"><?= htmlspecialchars($descricao) ?></p>
                                    <p class="preco">R$<?= htmlspecialchars($preco) ?></p>
                                    <p class="ingredientes"><span>Ingredientes: </span><?= htmlspecialchars($ingredientes) ?>
                                    </p>
                                </div>
                            </div>
                            <div class="buttons">
                                <form action="editar_comida.php" method="post">
                                    <input type="hidden" name="id_comida" value="<?= htmlspecialchars($id) ?>">
                                    <button type="submit"><i class="fa-solid fa-pen-to-square"></i></button>
                                </form>
                                <form action="../../database/comidas/deletar_comida.php" method="post"
                                    onclick="return confirm('Tem certeza que quer deletar?')">
                                    <input type="hidden" name="id_comida" value="<?= htmlspecialchars($id) ?>">
                                    <button type="submit"><i class="fa-solid fa-trash-can"></i></button>
                                </form>
                            </div>
                        </article>
                <?php endwhile;
                else:
                    echo '<p class="nenhum-cadastro">Nenhuma comida cadastrada!</p>';
                endif;
                ?>
            </div>
        </div>
    </main>
    <footer>
        <p class="direitos">© 2025 Sistema de Ficha • Todos os direitos reservados</p>
        <p>Feito com ♥ por <a href="https://leandroarantes.com.br/" target="_blank">Leandro Arantes</a></p>
    </footer>
    <?php
    include("../../includes/mensagem.php");
    ?>
</body>

</html>