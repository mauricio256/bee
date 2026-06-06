<h1>Funcionários</h1>

<p>
    <a href="?url=funcionario-create">
        Novo Funcionário
    </a>
    |
    <a href="?url=dashboard">
        Voltar
    </a>
</p>

<form method="GET">

    <input
        type="hidden"
        name="url"
        value="funcionarios"
    >

    <input
        type="text"
        name="busca"
        placeholder="Pesquisar funcionário..."
        value="<?= $_GET['busca'] ?? ''; ?>"
    >

    <button type="submit">
        Buscar
    </button>

</form>

<br>

<table border="1">

    <tr>

        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Nível</th>
        <th>Status</th>
        <th>Ações</th>

    </tr>

    <?php foreach($funcionarios as $funcionario): ?>

        <tr>

            <td><?= $funcionario['id']; ?></td>

            <td><?= $funcionario['nome']; ?></td>

            <td><?= $funcionario['email']; ?></td>

            <td><?= $funcionario['telefone']; ?></td>

            <td><?= strtoupper($funcionario['nivel']); ?></td>

            <td>

                <?= $funcionario['ativo'] ? 'Ativo' : 'Inativo'; ?>

            </td>

            <td>

                <a href="?url=funcionario-edit&id=<?= $funcionario['id']; ?>">
                    Editar
                </a>

                |

                <form
                    method="POST"
                    action="?url=funcionario-delete"
                    style="display:inline;"
                    onsubmit="return confirm('Deseja realmente excluir este funcionário?')"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $funcionario['id']; ?>"
                    >

                    <button type="submit">
                        Excluir
                    </button>

                </form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>

<br>