<h1>Editar Produto</h1>

<form method="POST">

    <p>

        Nome

        <br>

        <input
            type="text"
            name="nome"
            value="<?= $dados['nome']; ?>"
            required
        >

    </p>

    <p>

        Código de Barras

        <br>

        <input
            type="text"
            name="codigo_barras"
            value="<?= $dados['codigo_barras']; ?>"
        >

    </p>

    <p>

        Categoria

        <br>

        <select name="categoria_id">

            <?php foreach($categorias as $categoria): ?>

                <option
                    value="<?= $categoria['id']; ?>"
                    <?= ($categoria['id'] == $dados['categoria_id']) ? 'selected' : ''; ?>
                >
                    <?= $categoria['nome']; ?>
                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <p>

        Custo

        <br>

        <input
            type="number"
            step="0.01"
            name="custo"
            value="<?= $dados['custo']; ?>"
            required
        >

    </p>

    <p>

        Preço de Venda

        <br>

        <input
            type="number"
            step="0.01"
            name="preco_venda"
            value="<?= $dados['preco_venda']; ?>"
            required
        >

    </p>

    <p>

        Estoque Mínimo

        <br>

        <input
            type="number"
            name="estoque_minimo"
            value="<?= $dados['estoque_minimo']; ?>"
        >

    </p>

    <button type="submit">
        Atualizar
    </button>

</form>

<br>

<a href="?url=produtos">
    Voltar
</a>