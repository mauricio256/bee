<h1>Nova Compra</h1>

<form method="POST">

    <p>

        Fornecedor

        <br>

        <select name="fornecedor_id" required>

            <option value="">
                Selecione
            </option>

            <?php foreach($fornecedores as $fornecedor): ?>

                <option value="<?= $fornecedor['id']; ?>">

                    <?= $fornecedor['nome']; ?>

                </option>

            <?php endforeach; ?>

        </select>

    </p>

    <button type="submit">

        Criar Compra

    </button>

</form>

<br>

<a href="?url=compras">

    Voltar

</a>