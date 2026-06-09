<h1>Nova Venda</h1>

<form method="POST">

    <p>

        Cliente

        <br>

        <select name="cliente_id">

            <option value="">
                Consumidor Final
            </option>

            <?php foreach($clientes as $cliente): ?>

                <option value="<?= $cliente['id']; ?>">

                    <?= $cliente['nome']; ?>

                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <p>

        Tipo de Venda

        <br>

        <select
            name="tipo"
            required
        >

            <option value="avista">
                À Vista
            </option>

            <option value="prazo">
                A Prazo
            </option>

        </select>

    </p>

    <button type="submit">

        Criar Venda

    </button>

</form>

<br>

<a href="?url=vendas">

    Voltar

</a>