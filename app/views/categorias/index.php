<h1>Categorias</h1>

<p>
    <a href="?url=categoria-create">
        Nova Categoria
    </a>

    |

    <a href="?url=categoria-historico">
        Histórico
    </a>

     |
     
     <a href="?url=dashboard">
        Voltar
    </a>
</p>

<hr>

<table border="1">

   <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Ações</th>
   </tr>

    <?php foreach($categorias as $item): ?>

        <tr>

        <td><?= $item['id']; ?></td>

        <td><?= $item['nome']; ?></td>

        <td>
            <form
                method="POST"
                action="?url=categoria-delete"
                style="display:inline;"
                onsubmit="return confirm('Deseja realmente excluir?')"
            >

                <input
                    type="hidden"
                    name="id"
                    value="<?= $item['id']; ?>"
                >

                <button type="submit">
                    Excluir
                </button>

            </form>

        </td>

    </tr>

    <?php endforeach; ?>

</table>