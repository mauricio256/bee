<h1>Novo Funcionário</h1>

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

        Email

        <br>

        <input
            type="email"
            name="email"
            required
        >

    </p>

    <p>

        Senha

        <br>

        <input
            type="password"
            name="senha"
            required
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

        Nível

        <br>

        <select name="nivel">

            <option value="user">
                Usuário
            </option>

            <option value="admin">
                Administrador
            </option>

        </select>

    </p>

    <p>

        Status

        <br>

        <select name="ativo">

            <option value="1">
                Ativo
            </option>

            <option value="0">
                Inativo
            </option>

        </select>

    </p>

    <button type="submit">
        Salvar
    </button>

</form>

<br>

<a href="?url=funcionarios">
    Voltar
</a>