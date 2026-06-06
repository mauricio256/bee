<h1>Produtos</h1>

<p>
    <a href="?url=produto-create">
        Novo Produto
    </a>

  |

    <a href="?url=dashboard">
            Voltar
        </a>
    </p>

  <form method="GET">

    <input
        type="hidden"
        name="url"
        value="produtos"
    >

    <input
        type="text"
        name="busca"
        placeholder="Pesquisar produtos..."
        value="<?= $_GET['busca'] ?? ''; ?>"
    >

    <button type="submit">
        Buscar
    </button>

</form>  

<table border="1">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Custo</th>
        <th>Venda</th>
        <th>Margem</th>
        <th>Ações</th>
    </tr>

    <?php foreach($produtos as $produto): ?>

        <tr>

            <td><?= $produto['id']; ?></td>

            <td><?= $produto['nome']; ?></td>

            <td><?= $produto['categoria']; ?></td>

            <td>
                R$ <?= number_format($produto['custo'], 2, ',', '.'); ?>
            </td>

            <td>
                R$ <?= number_format($produto['preco_venda'], 2, ',', '.'); ?>
            </td>

            <td>
                <?= number_format($produto['margem_lucro'], 2, ',', '.'); ?>%
            </td>

            <td>
                 <a href="?url=produto-edit&id=<?= $produto['id']; ?>">
                        Editar
                </a>

                <form
                    method="POST"
                    action="?url=produto-delete"
                    onsubmit="return confirm('Deseja realmente excluir este produto?')"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $produto['id']; ?>"
                    >

                    <button type="submit">
                        Excluir
                    </button>

                </form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>