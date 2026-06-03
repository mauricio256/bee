<h1>Novo Produto</h1>


<form method="POST">

    <p>
        Nome
        <br>
        <input
            type="text"
            name="nome"
            required
        >
    </p>

    <p>
        Código de Barras
        <br>
        <input
            type="text"
            name="codigo_barras"
        >
    </p>

    <p>
        Categoria
        <br>

        <select
            name="categoria_id"
            required
        >

            <option value="">
                Selecione
            </option>

            <?php foreach($categorias as $categoria): ?>

                <option
                    value="<?= $categoria['id']; ?>"
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
            required
        >
    </p>

    <p>
        Estoque Mínimo
        <br>
        <input
            type="number"
            name="estoque_minimo"
            value="0"
        >
    </p>

    <button type="submit">
        Salvar
    </button>

</form>

<br>

<a href="?url=produtos">
    Voltar
</a>