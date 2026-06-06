<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee ERP - Dashboard</title>

    <link rel="stylesheet" href="/bee/public/assets/css/dashboard.css">
</head>
<body>

<div class="dashboard">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="brand">
            🐝 Bee ERP
        </div>

        <nav>

            <a href="?url=clientes">👥 Clientes</a>

            <a href="?url=fornecedores">🚚 Fornecedores</a>

            <a href="?url=produtos">📦 Produtos</a>

            <a href="?url=categorias">🏷️ Categorias</a>

            <a href="?url=funcionarios">👨‍💼 Funcionários</a>

            <a href="?url=estoque">🏪 Estoque</a>

            <a href="?url=compras">🛒 Compras</a>

            <a href="?url=vendas">💰 Vendas</a>

            <a href="?url=financeiro">📈 Financeiro</a>

            <a href="?url=relatorios">📊 Relatórios</a>

            <a href="?url=configuracoes">⚙️ Configurações</a>

        </nav>

    </aside>

    <!-- CONTEÚDO -->
    <main class="content">

        <header class="topbar">

            <div>
                <h1>Dashboard</h1>

                <p>
                    Bem-vindo,
                    <strong><?= $_SESSION['user']['nome']; ?></strong>
                </p>
            </div>

            <a href="?url=logout" class="logout">
                Sair
            </a>

        </header>

        <!-- CARDS -->

        <section class="cards">

            <a href="?url=clientes" class="card">
                <span>👥</span>
                <h3>Clientes</h3>
                <p>Gerenciar clientes</p>
            </a>

            <a href="?url=fornecedores" class="card">
                <span>🚚</span>
                <h3>Fornecedores</h3>
                <p>Gerenciar fornecedores</p>
            </a>

            <a href="?url=produtos" class="card">
                <span>📦</span>
                <h3>Produtos</h3>
                <p>Cadastro de produtos</p>
            </a>

            <a href="?url=estoque" class="card">
                <span>🏪</span>
                <h3>Estoque</h3>
                <p>Consultar estoque</p>
            </a>

            <a href="?url=compras" class="card">
                <span>🛒</span>
                <h3>Compras</h3>
                <p>Registrar compras</p>
            </a>

            <a href="?url=vendas" class="card">
                <span>💰</span>
                <h3>Vendas</h3>
                <p>Histórico de vendas</p>
            </a>

            <a href="?url=financeiro" class="card">
                <span>📈</span>
                <h3>Financeiro</h3>
                <p>Fluxo de caixa</p>
            </a>

            <a href="?url=relatorios" class="card">
                <span>📊</span>
                <h3>Relatórios</h3>
                <p>Visualizar relatórios</p>
            </a>

        </section>

        <!-- RESUMO -->

        <section class="overview">

            <div class="overview-card">
                <h4>Clientes</h4>
                <span><?= $totalClientes ?? 0 ?></span>
            </div>

            <div class="overview-card">
                <h4>Produtos</h4>
                <span><?= $totalProdutos ?? 0 ?></span>
            </div>

            <div class="overview-card">
                <h4>Vendas Hoje</h4>
                <span>R$ 0,00</span>
            </div>

            <div class="overview-card">
                <h4>Estoque Baixo</h4>
                <span>0</span>
            </div>

        </section>

    </main>

</div>

</body>
</html>