<h1>Editar Cliente</h1>

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
        CPF/CNPJ
        <br>
        <input
            type="text"
            name="cpf_cnpj"
            value="<?= $dados['cpf_cnpj']; ?>"
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
        Endereço
        <br>
        <textarea name="endereco" rows="3"><?= $dados['endereco']; ?></textarea>
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

<a href="?url=clientes">
    Voltar
</a>