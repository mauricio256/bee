<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bee ERP - Login</title>

    <link rel="stylesheet" href="/bee/public/assets/css/login.css">
</head>
<body>

<div class="container">

    <!-- LADO ESQUERDO -->
    <div class="hero">

        <div class="logo">
            🐝 Bee ERP
        </div>

        <div class="bee-flight">
            <span class="bee">🐝</span>
        </div>

        <div class="honeycomb">

            <div class="hex"></div>
            <div class="hex"></div>
            <div class="hex"></div>

            <div class="hex"></div>
            <div class="hex active"></div>
            <div class="hex"></div>

            <div class="hex"></div>
            <div class="hex"></div>
            <div class="hex"></div>

        </div>

        <h2>Gestão Inteligente</h2>

        <p>
            Controle produtos, estoque, vendas,
            clientes e finanças em um único lugar.
        </p>

    </div>

    <!-- LADO DIREITO -->
    <div class="login-area">

        <div class="login-card">

            <h1>Bem-vindo!</h1>

            <p class="subtitle">
                Faça login para acessar o Bee ERP
            </p>

            <?php if(isset($_SESSION['msg'])): ?>

                <div class="alert">
                    <?= $_SESSION['msg']; ?>
                </div>

                <?php unset($_SESSION['msg']); ?>

            <?php endif; ?>

            <form method="POST" id="loginForm">

                <div class="input-group">

                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        placeholder="Digite seu email"
                        required
                    >

                </div>

                <div class="input-group">

                    <label>Senha</label>

                    <input
                        type="password"
                        name="senha"
                        placeholder="Digite sua senha"
                        required
                    >

                </div>

                <button type="submit" id="btnLogin">
                    Entrar
                </button>

            </form>

        </div>

    </div>

</div>

<!-- LOADER -->

<div id="loader">

    <div class="loader-content">

        <div class="spinner"></div>

        <h3>Entrando...</h3>

        <p>Aguarde um momento</p>

    </div>

</div>

<script src="/bee/public/assets/js/login.js"></script>

</body>
</html>