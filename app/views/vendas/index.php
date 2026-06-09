<h1>Vendas</h1>

<p>

    <a href="?url=venda-create">

        Nova Venda

    </a>

</p>

<table border="1">

    <tr>

        <th>ID</th>
        <th>Cliente</th>
        <th>Total</th>
        <th>Status</th>
        <th>Data</th>
        <th>Ações</th>

    </tr>

    <?php foreach($vendas as $venda): ?>

        <tr>

            <td><?= $venda['id']; ?></td>

            <td><?= $venda['cliente'] ?? 'Consumidor Final'; ?></td>

            <td>

                R$
                <?= number_format(
                    $venda['total_final'],
                    2,
                    ',',
                    '.'
                ); ?>

            </td>

            <td><?= $venda['status']; ?></td>

            <td><?= $venda['data_venda']; ?></td>

            <td>

                <a href="?url=venda-itens&id=<?= $venda['id']; ?>">

                    Itens

                </a>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<br>

<a href="?url=dashboard">

    Voltar

</a>