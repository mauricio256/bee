<h1>Histórico de Categorias</h1>

<p>
    <a href="?url=categorias">
        Voltar
    </a>
</p>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Ação</th>
        <th>Registro</th>
        <th>Usuário</th>
        <th>Data</th>
        <th>Anterior</th>
    </tr>

    <?php foreach($logs as $log): ?>     

        <?php  
            $dados = json_decode(
                $log['dados_antes'],
                true
            );
        ?>

        <tr>

            <td><?= $log['id']; ?></td>

            <td><?= strtoupper($log['acao']); ?></td>

            <td><?= $log['registro_id']; ?></td>

            <td><?= $log['usuario']; ?></td>

            <td><?= $log['created_at']; ?></td>
            <td><?= $dados['nome'] ?? '-'; ?></td>

        </tr>

    <?php endforeach; ?>

</table>