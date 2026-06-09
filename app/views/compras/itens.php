<h1>Compra #<?= $dados['id']; ?></h1>

<form
    method="POST"
    action="?url=compra-add-item"
>

    <input
        type="hidden"
        name="compra_id"
        value="<?= $dados['id']; ?>"
    >

    <p>

        Produto

        <br>

        <select name="produto_id">

            <?php foreach($produtos as $produto): ?>

                <option
                    value="<?= $produto['id']; ?>"
                >

                    <?= $produto['nome']; ?>

                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <p>

        Quantidade

        <br>

        <input
            type="number"
            step="0.001"
            name="quantidade"
        >

    </p>

    <p>

        Custo Unitário

        <br>

        <input
            type="number"
            step="0.01"
            name="custo_unitario"
        >

    </p>

    <button type="submit">

        Adicionar

    </button>

</form>

<hr>

<?php

    $total = 0;

    foreach($itens as $item){

        $total += $item['subtotal'];
    }

    ?>

    <h3>

        Total Atual:
        R$ <?= number_format($total, 2, ',', '.'); ?>

    </h3>
<table border="1">

    <tr>

        <th>Produto</th>
        <th>Quantidade</th>
        <th>Custo</th>
        <th>Subtotal</th>
        <th>Ações</th>

    </tr>

    <?php foreach($itens as $item): ?>

    <tr>

        <td><?= $item['produto']; ?></td>

        <td><?= $item['quantidade']; ?></td>

        <td>
            R$ <?= number_format(
                $item['custo_unitario'],
                2,
                ',',
                '.'
            ); ?>
        </td>

        <td>
            R$ <?= number_format(
                $item['subtotal'],
                2,
                ',',
                '.'
            ); ?>
        </td>

        <td>

            <form
                method="POST"
                action="?url=compra-delete-item"
                style="display:inline;"
                onsubmit="return confirm('Excluir item?')"
            >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $item['id']; ?>"
                >

                <input
                    type="hidden"
                    name="compra_id"
                    value="<?= $dados['id']; ?>"
                >

                <button type="submit">

                    Excluir

                </button>

            </form>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

<hr>

<form
    method="POST"
    action="?url=compra-finalizar"
>

    <input
        type="hidden"
        name="id"
        value="<?= $dados['id']; ?>"
    >

    <button type="submit">

        Finalizar Compra

    </button>

</form>