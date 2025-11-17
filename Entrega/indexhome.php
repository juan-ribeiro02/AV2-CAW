<?php 
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Gestão de Consumo de Energia</title>
    <!-- Link para o arquivo CSS centralizado -->
    <link rel="stylesheet" href="assets/style.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome para o ícone de logout -->
    <script src="https://kit.fontawesome.com/de85fa196f.js" crossorigin="anonymous"></script>
</head>
<body class="page-home">

    <header class="header-principal">
        <nav class="container">
            <!-- 
                Este "nav-content" usa o padrão (justify-between) 
                definido no style.css 
            -->
            <div class="nav-content">

                <div class="logo-container">
                    <a href="indexhome.php" class="logo-link">
                        Gestão Energia
                    </a>
                </div>

                <!-- Links de Navegação Desktop -->
                <div class="nav-links">
                    <a href="indexhome.php" class="nav-link nav-link--active">Home</a>
                    <a href="gerenciar.php" class="nav-link">Gerenciar Cadastros</a>
                    <?php echo $_SESSION['nome'];?>
                    <a href="logout.php" class="nav-link nav-link--logout">
                         
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </div>

                <!-- Botão do menu mobile -->
                <div class="mobile-menu-toggle">
                    <button class="mobile-menu-btn">
                        <svg class="icon-svg" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                        </svg>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <main class="main-content container">
        
        <section class="hero-section">
            <h1 class="hero-title">
                Bem-vindo ao Sistema de Gestão de Consumo Residencial
            </h1>
            <p class="hero-subtitle">
                Gerenciando o futuro da energia de forma eficiente, um bairro de cada vez.
            </p>
        </section>

        <section class="content-section">
            <div class="content-grid-two-cols">

                <div class="content-text">
                    <h2 class="content-title">
                        Sobre o Nosso Sistema
                    </h2>
                    <p class="content-paragraph">
                        Nosso sistema de gestão de consumo residencial é uma ferramenta poderosa projetada para monitorar, analisar e gerenciar o uso de energia em diferentes bairros e horários.
                    </p>
                    <p class="content-paragraph">
                        Como funcionário autorizado, você tem acesso total às ferramentas de CRUD (Criar, Ler, Atualizar e Deletar) para manter nossos registros de consumo precisos e atualizados. Este portal é o seu centro de comando para garantir a eficiência energética e a correta alocação de recursos.
                    </p>
                    <!-- 
                        Reutilizando o .btn-primary do login.
                        Adicionada a classe .btn-inline para ajustar o display.
                    -->
                    <a href="gerenciar.php" class="btn-primary btn-inline" id="btn-acessar">
                        Acessar Painel de Dados
                    </a>
                </div>
                
                <div class="content-image-wrapper">
                    <img src="assets/tipos-de-energia.webp" 
                         alt="Ilustração de um gráfico de gerenciamento de energia" 
                         class="content-image"
                         onerror="this.src='https://placehold.co/600x400/e0e7ff/374151?text=Imagem+N%C3%A3o+Carregada'">
                </div>
            </div>
        </section>

        <section class="features-section">
            <h2 class="section-title">
                Funcionalidades Principais
            </h2>
            <div class="features-grid">
                
                <div class="feature-card">
                    <h3 class="feature-card-title">Cadastro Eficiente</h3>
                    <p class="feature-card-text">
                        Adicione novos registros de consumo, bairros e número de residências de forma rápida e intuitiva.
                    </p>
                </div>
                
                <div class="feature-card">
                    <h3 class="feature-card-title">Visualização Clara</h3>
                    <p class="feature-card-text">
                        Acesse relatórios detalhados e filtre os dados de consumo por hora, bairro ou qualquer outro parâmetro.
                    </p>
                </div>
                
                <div class="feature-card">
                    <h3 class="feature-card-title">Gerenciamento Completo</h3>
                    <p class="feature-card-text">
                        Edite ou remova registros obsoletos com facilidade, mantendo a integridade da base de dados.
                    </p>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer-principal">
        <div class="container footer-content">
            <p>&copy; 2025 GestãoEnergia S.A. Todos os direitos reservados.</p>
            <p class="footer-address">
                Rua Clarimundo de Melo, N°1 - Quintino, Rio de Janeiro - RJ
            </p>
        </div>
    </footer>

</body>
</html>

