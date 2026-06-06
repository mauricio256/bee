<h1>Editar Funcionário</h1>

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

        Email

        <br>

        <input
            type="email"
            name="email"
            value="<?= $dados['email']; ?>"
            required
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

        Nível

        <br>

        <select name="nivel">

            <option
                value="user"
                <?= $dados['nivel'] == 'user' ? 'selected' : ''; ?>
            >
                Usuário
            </option>

            <option
                value="admin"
                <?= $dados['nivel'] == 'admin' ? 'selected' : ''; ?>
            >
                Administrador
            </option>

        </select>

    </p>

    <p>

        Status

        <br>

        <select name="ativo">

            <option
                value="1"
                <?= $dados['ativo'] == 1 ? 'selected' : ''; ?>
            >
                Ativo
            </option>

            <option
                value="0"
                <?= $dados['ativo'] == 0 ? 'selected' : ''; ?>
            >
                Inativo
            </option>

        </select>

    </p>

    <button type="submit">
        Atualizar
    </button>

</form>

<br>

<a href="?url=funcionarios">
    Voltar
</a>