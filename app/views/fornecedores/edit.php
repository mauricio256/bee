<h1>Editar Fornecedor</h1>

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
        CNPJ
        <br>
        <input
            type="text"
            name="cnpj"
            value="<?= $dados['cnpj']; ?>"
        >
    </p>

    <p>
        Contato
        <br>
        <input
            type="text"
            name="contato"
            value="<?= $dados['contato']; ?>"
        >
    </p>

    <p>
        Telefone
        <br>
        <input
            type="text"
            name="telefone"
            value="<?= $dados['telefone']; ?>"
        >
    </p>

    <p>
        Endereço
        <br>
        <textarea
            name="endereco"
            rows="3"
        ><?= $dados['endereco']; ?></textarea>
    </p>

    <p>
        Cidade
        <br>
        <input
            type="text"
            name="cidade"
            value="<?= $dados['cidade']; ?>"
        >
    </p>

    <p>
        Estado
        <br>
        <input
            type="text"
            name="estado"
            value="<?= $dados['estado']; ?>"
        >
    </p>

    <button type="submit">
        Atualizar
    </button>

</form>

<br>

<a href="?url=fornecedores">
    Voltar
</a>