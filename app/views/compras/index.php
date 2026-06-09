<h1>Compras</h1>

<p>

    <a href="?url=compra-create">
        Nova Compra
    </a>

</p>

<table border="1">

    <tr>

        <th>ID</th>
        <th>Fornecedor</th>
        <th>Total</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>

    </tr>

    <?php foreach($compras as $compra): ?>

    <tr>

        <td><?= $compra['id']; ?></td>

        <td><?= $compra['fornecedor']; ?></td>

        <td>R$ <?= $compra['total']; ?></td>

        <td><?= $compra['status']; ?></td>

        <td><?= $compra['data_compra']; ?></td>

        <td>
            <a href="?url=compra-itens&id=<?= $compra['id']; ?>">
                Itens
            </a>

            |

            <form
                method="POST"
                action="?url=compra-delete"
                style="display:inline;"
                onsubmit="return confirm('Deseja excluir esta compra?')"
            >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $compra['id']; ?>"
                >

                <button type="submit">
                    Excluir
                </button>

            </form>
        </td>
    </tr>

    <?php endforeach; ?>

</table>

