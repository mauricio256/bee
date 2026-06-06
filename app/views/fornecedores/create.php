<h1>Novo Fornecedor</h1>

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
        CNPJ
        <br>
        <input
            type="text"
            name="cnpj"
        >
    </p>

    <p>
        Contato
        <br>
        <input
            type="text"
            name="contato"
        >
    </p>

    <p>
        Telefone
        <br>
        <input
            type="text"
            name="telefone"
        >
    </p>

    <p>
        Endereço
        <br>
        <textarea
            name="endereco"
            rows="3"
        ></textarea>
    </p>

    <p>
        Cidade
        <br>
        <input
            type="text"
            name="cidade"
        >
    </p>

    <p>
        Estado
        <br>
        <input
            type="text"
            name="estado"
        >
    </p>

    <button type="submit">
        Salvar
    </button>

</form>

<br>

<a href="?url=fornecedores">
    Voltar
</a>