<?php if(isset($_SESSION['sucesso'])): ?>

    <p style="color:green;">

        <?= $_SESSION['sucesso']; ?>

    </p>

    <?php unset($_SESSION['sucesso']); ?>

<?php endif; ?>

<h1>PDV</h1>

<?php if(isset($_SESSION['erro'])): ?>

    <p style="color:red;">

        <?= $_SESSION['erro']; ?>

    </p>

    <?php unset($_SESSION['erro']); ?>

<?php endif; ?>

<form
    method="POST"
    action="?url=pdv-add"
>

    <input
        type="text"
        name="codigo"
        autofocus
        placeholder="Código de barras"
        required
    >

    <button type="submit">

        Adicionar

    </button>

</form>

<p>

    <a
        href="?url=pdv-clear"
        onclick="return confirm('Limpar carrinho?')"
    >

        Limpar Carrinho

    </a>

</p>

<hr>

<table border="1" width="100%">

    <tr>

        <th>Produto</th>
        <th>Qtd</th>
        <th>Preço</th>
        <th>Subtotal</th>
        <th>Ações</th>

    </tr>

    <?php

    $total = 0;

    foreach($_SESSION['carrinho'] as $item):

        $subtotal =
            $item['quantidade']
            *
            $item['preco'];

        $total += $subtotal;

    ?>
    <tr>

        <td><?= $item['nome']; ?></td>

        <td><?= $item['quantidade']; ?></td>

        <td>
            R$ <?= number_format(
                $item['preco'],
                2,
                ',',
                '.'
            ); ?>
        </td>

        <td>
            R$ <?= number_format(
                $subtotal,
                2,
                ',',
                '.'
            ); ?>
        </td>

        <td>

            <a
                href="?url=pdv-remove&id=<?= $item['id']; ?>"
                onclick="return confirm('Remover item?')"
            >

                Excluir

            </a>

        </td>

    </tr>

    <?php endforeach; ?>

</table>

<hr>

<h2>

    TOTAL:
    R$
    <?= number_format(
        $total,
        2,
        ',',
        '.'
    ); ?>

</h2>

<form
    method="POST"
    action="?url=pdv-finalizar"
>

    <button type="submit">

        Finalizar Venda

    </button>

</form>