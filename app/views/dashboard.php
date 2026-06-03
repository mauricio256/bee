<h1>Dashboard</h1>

<p>Bem-vindo, <?= $_SESSION['user']['nome']; ?></p>

<hr>

<h2>Cadastros</h2>

<ul>
    <li><a href="?url=clientes">Clientes</a></li>
    <li><a href="?url=fornecedores">Fornecedores</a></li>
   <a href="?url=produtos">Produtos</a>
    <li><a href="?url=categorias">Categorias</a></li>
    <li><a href="?url=usuarios">Funcionários</a></li>
</ul>

<hr>

<h2>Estoque</h2>

<ul>
    <li><a href="?url=estoque">Consultar Estoque</a></li>
    <li><a href="?url=movimentacoes">Movimentações</a></li>
    <li><a href="?url=ajuste-estoque">Ajuste de Estoque</a></li>
    <li><a href="?url=estoque-minimo">Estoque Mínimo</a></li>
</ul>

<hr>

<h2>Compras</h2>

<ul>
    <li><a href="?url=nova-compra">Nova Compra</a></li>
    <li><a href="?url=compras">Listar Compras</a></li>
    <li><a href="?url=compras-pendentes">Compras Pendentes</a></li>
</ul>

<hr>

<h2>Vendas</h2>

<ul>
    <li><a href="?url=pdv">PDV</a></li>
    <li><a href="?url=vendas">Histórico de Vendas</a></li>
    <li><a href="?url=devolucoes">Devoluções</a></li>
</ul>

<hr>

<h2>Caixa</h2>

<ul>
    <li><a href="?url=abrir-caixa">Abrir Caixa</a></li>
    <li><a href="?url=fechar-caixa">Fechar Caixa</a></li>
    <li><a href="?url=movimentos-caixa">Movimentações</a></li>
    <li><a href="?url=sangria">Sangria</a></li>
    <li><a href="?url=reforco">Reforço</a></li>
</ul>

<hr>

<h2>Financeiro</h2>

<ul>
    <li><a href="?url=contas-receber">Contas a Receber</a></li>
    <li><a href="?url=contas-pagar">Contas a Pagar</a></li>
    <li><a href="?url=receitas">Receitas</a></li>
    <li><a href="?url=despesas">Despesas</a></li>
    <li><a href="?url=fluxo-caixa">Fluxo de Caixa</a></li>
</ul>

<hr>

<h2>Fiscal</h2>

<ul>
    <li><a href="?url=emitir-nfe">Emitir NF-e</a></li>
    <li><a href="?url=notas-fiscais">Notas Emitidas</a></li>
    <li><a href="?url=xml-notas">XML das Notas</a></li>
</ul>

<hr>

<h2>Relatórios</h2>

<ul>
    <li><a href="?url=rel-vendas">Vendas</a></li>
    <li><a href="?url=rel-estoque">Estoque</a></li>
    <li><a href="?url=rel-financeiro">Financeiro</a></li>
    <li><a href="?url=rel-clientes">Clientes</a></li>
    <li><a href="?url=rel-produtos">Produtos</a></li>
</ul>

<hr>

<h2>Administração</h2>

<ul>
    <li><a href="?url=usuarios">Usuários</a></li>
    <li><a href="?url=permissoes">Permissões</a></li>
    <li><a href="?url=logs">Logs</a></li>
    <li><a href="?url=auditoria">Auditoria</a></li>
</ul>

<hr>

<h2>Configurações</h2>

<ul>
    <li><a href="?url=empresa">Dados da Empresa</a></li>
    <li><a href="?url=impostos">Impostos</a></li>
    <li><a href="?url=backup">Backup</a></li>
    <li><a href="?url=configuracoes">Configurações Gerais</a></li>
</ul>

<hr>

<p>
    <a href="?url=logout">Sair do Sistema</a>
</p>