<?php

if(isset($_SESSION['erro'])):

?>

    <div style="color:red;">

        <?= $_SESSION['erro']; ?>

    </div>

<?php

unset($_SESSION['erro']);

endif;

?>

<h1>Venda #<?= $dados['id']; ?></h1>

<form
    method="POST"
    action="?url=venda-add-item"
>

    <input
        type="hidden"
        name="venda_id"
        value="<?= $dados['id']; ?>"
    >

    <p>

        Produto

        <br>

        <select
            name="produto_id"
            required
        >

            <?php foreach($produtos as $produto): ?>

                <option
                    value="<?= $produto['id']; ?>"
                >

                    <?= $produto['nome']; ?>

                    |
                    Estoque:
                    <?= $produto['estoque_atual']; ?>

                    |
                    R$
                    <?= number_format(
                        $produto['preco_venda'],
                        2,
                        ',',
                        '.'
                    ); ?>

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
            min="0.001"
            name="quantidade"
            required
        >

    </p>

    <button type="submit">

        Adicionar Produto

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
    R$
    <?= number_format(
        $total,
        2,
        ',',
        '.'
    ); ?>

</h3>

<table border="1">

    <tr>

        <th>Produto</th>
        <th>Quantidade</th>
        <th>Preço Unit.</th>
        <th>Subtotal</th>
        <th>Ações</th>

    </tr>

    <?php foreach($itens as $item): ?>

        <tr>

            <td><?= $item['produto']; ?></td>

            <td><?= $item['quantidade']; ?></td>

            <td>

                R$
                <?= number_format(
                    $item['preco_unitario'],
                    2,
                    ',',
                    '.'
                ); ?>

            </td>

            <td>

                R$
                <?= number_format(
                    $item['subtotal'],
                    2,
                    ',',
                    '.'
                ); ?>

            </td>

            <td>

                <form
                    method="POST"
                    action="?url=venda-delete-item"
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
                        name="venda_id"
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
    action="?url=venda-finalizar"
    onsubmit="return confirm('Finalizar venda?')"
>

    <input
        type="hidden"
        name="id"
        value="<?= $dados['id']; ?>"
    >

    <button type="submit">

        Finalizar Venda

    </button>

</form>

<br>

<a href="?url=vendas">

    Voltar

</a>