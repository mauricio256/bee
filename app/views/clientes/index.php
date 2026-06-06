
<h1>Clientes</h1>

<p>
    <a href="?url=cliente-create">
        Novo Cliente
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
        value="clientes"
    >

    <input
        type="text"
        name="busca"
        placeholder="Pesquisar cliente..."
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
        <th>CPF/CNPJ</th>
        <th>Contato</th>
        <th>Endereço</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Cadastro</th>
        <th>Ações</th>
    </tr>

    <?php foreach($clientes as $cliente): ?>

        <tr>

            <td><?= $cliente['id']; ?></td>

            <td><?= $cliente['nome']; ?></td>

            <td><?= $cliente['cpf_cnpj']; ?></td>

            <td><?= $cliente['contato']; ?></td>

            <td><?= $cliente['endereco']; ?></td>

            <td><?= $cliente['cidade']; ?></td>

            <td><?= $cliente['estado']; ?></td>

            <td><?= $cliente['created_at']; ?></td>

            <td>

                <a href="?url=cliente-edit&id=<?= $cliente['id']; ?>">
                    Editar
                </a>

                |

                <form
                    method="POST"
                    action="?url=cliente-delete"
                    style="display:inline;"
                    onsubmit="return confirm('Deseja realmente excluir este cliente?')"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $cliente['id']; ?>"
                    >

                    <button type="submit">
                        Excluir
                    </button>

                </form>

            </td>

        </tr>

    <?php endforeach; ?>

</table>