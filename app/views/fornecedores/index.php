<h1>Fornecedores</h1>

<p>
    <a href="?url=fornecedor-create">
        Novo Fornecedor
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
        value="fornecedores"
    >

    <input
        type="text"
        name="busca"
        placeholder="Pesquisar fornecedor..."
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
        <th>CNPJ</th>
        <th>Contato</th>
        <th>Telefone</th>
        <th>Cidade</th>
        <th>Estado</th>
        <th>Ações</th>

    </tr>

    <?php foreach($fornecedores as $fornecedor): ?>

        <tr>

            <td><?= $fornecedor['id']; ?></td>

            <td><?= $fornecedor['nome']; ?></td>

            <td><?= $fornecedor['cnpj']; ?></td>

            <td><?= $fornecedor['contato']; ?></td>

            <td><?= $fornecedor['telefone']; ?></td>

            <td><?= $fornecedor['cidade']; ?></td>

            <td><?= $fornecedor['estado']; ?></td>

            <td>

                <a href="?url=fornecedor-edit&id=<?= $fornecedor['id']; ?>">
                    Editar
                </a>

                |

                <form
                    method="POST"
                    action="?url=fornecedor-delete"
                    style="display:inline;"
                    onsubmit="return confirm('Deseja realmente excluir este fornecedor?')"
                >

                    <input
                        type="hidden"
                        name="id"
                        value="<?= $fornecedor['id']; ?>"
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