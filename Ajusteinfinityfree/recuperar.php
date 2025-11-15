<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Esqueci minha senha</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="popup.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

</head>
<body class="page-login">

    <header class="header-principal">
        <nav class="container">
            <div class="nav-content" id="nav-logo">
                <div class="logo-container">
                    <a href="index.php" class="logo-link">
                        Gestão Energia
                    </a>
                </div>
                
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
        
        <div class="login-card">
            <h2 class="login-title">
                Recuperação de senha
            </h2>
            <p class="login-subtitle">
                Informe o seu Id e seu e-mail para recuperar a senha
            </p>

            <form action="" method="POST" id="form-recuperar">
                <div class="form-spacing">
                    
                    <div>
                        <label for="id-funcionario" class="form-label">
                            ID de Funcionário
                        </label>
                        <input type="text" id="id-funcionario" name="id-funcionario" 
                               autocomplete="username"
                               required
                               placeholder="251047**"
                               class="form-input">
                    </div>

                    <div>
                        <div class="form-row-between">
                            <label for="email" class="form-label">
                                Email
                            </label>
                        </div>
                        <input type="email" id="email" name="email" 
                               autocomplete="email"
                               required
                                placeholder="seu.email@gestaoenergia.com"
                               class="form-input">
                    </div>

                    <div>
                        <button type="submit" class="btn-primary" id="btn-entrar">
                            Enviar Solicitação
                        </button>
                    </div>
                    
                </div>
                <div class="form-spacing">
                <div class="form-link-center">
                    <a href="index.php" class="form-link">
                        Voltar para o Login
                    </a>
                </div>
            </form>
        </div>
                </div>
            </form>
        </div>
    </main>

    <footer class="footer-principal">
        <div class="container footer-content">
            <p>&copy; 2025 GestãoEnergia S.A. Todos os direitos reservados.</p>
            <p class="footer-address">
                Rua Clarimundo de Melo, N°1 - Quintino, Rio de Janeiro - RJ
            </p>
        </div>
    </footer>


    <div id="meu-popup" class="popup-overlay">
        <div class="popup-box">
            <h2>Solicitação Enviada</h2>
            <p>Se o ID e o e-mail estiverem corretos, você receberá um link para redefinir sua senha em breve.</p>
            
            <button  id="btn-fechar-popup" class="btn-primary">
                Entendido
            </button>
        </div>
    </div>


    <script>
        // Espera todo o HTML da página carregar
        document.addEventListener('DOMContentLoaded', () => {
            
            // 1. Pega os elementos que vamos usar
            const form = document.getElementById('form-recuperar');
            const popup = document.getElementById('meu-popup');
            const closeButton = document.getElementById('btn-fechar-popup');

            // 2. Escuta o evento de 'submit' (envio) do formulário
            form.addEventListener('submit', (event) => {
                
                // 3. Impede que o formulário recarregue a página
                event.preventDefault(); 
                
                // 4. Mostra o popup adicionando a classe 'active'
                popup.classList.add('active');
                
                // (Opcional: aqui você poderia adicionar o código para
                // realmente enviar os dados do formulário para um servidor)
            });

            // 5. Escuta o clique no botão de "Entendido"
            closeButton.addEventListener('click', () => {
                // 6. Esconde o popup
                popup.classList.remove('active');
            });
            
            // 7. (Bônus) Fecha o popup se o usuário clicar no fundo escuro
            popup.addEventListener('click', (event) => {
                // Se o clique foi no 'popup-overlay' (o fundo)
                if (event.target === popup) {
                    popup.classList.remove('active');
                }
            });

        });
    </script>
    
</body>
</html>