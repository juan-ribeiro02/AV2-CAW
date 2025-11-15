<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gestão de Consumo de Energia</title>
    <!-- Link para o arquivo CSS centralizado -->
    <link rel="stylesheet" href="style.css">
    
    <!-- Fonte importada no CSS, mas podemos manter aqui também -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="page-login">

    <header class="header-principal">
        <nav class="container">
            <div class="nav-content" id="nav-logo">
                <div class="logo-container">
                    <a href="#" class="logo-link">
                        Gestão Energia
                    </a>
                </div>
                
                <!-- Botão do menu mobile (funcionalidade JS não implementada) -->
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
                Acesso do Funcionário
            </h2>
            <p class="login-subtitle">
                Faça login para gerenciar o sistema.
            </p>

            <!-- O formulário aponta para indexhome.html -->
            <form action= "" method="POST">
                <div class="form-spacing">
                    
                    <div>
                        <label for="email" class="form-label">
                            Email ou ID de Funcionário
                        </label>
                        <input type="email" id="email" name="email" 
                               autocomplete="email"
                               required
                               placeholder="seu.email@gestaoenergia.com"
                               class="form-input">
                    </div>

                    <div>
                        <div class="form-row-between">
                            <label for="password" class="form-label">
                                Senha
                            </label>
                            <a href="recuperar.php" class="form-link">
                                Esqueceu a senha?
                            </a>
                        </div>
                        <input type="password" id="password" name="password" 
                               autocomplete="current-password"
                               required
                               minlength="8"
                               placeholder="&bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;"
                               class="form-input">
                    </div>

                    <div>
                        <button type="submit" class="btn-primary" id="btn-entrar">
                            Entrar
                        </button>
                    </div>

                </div>
            </form>
        </div>
        <?PHP 
        include('database.php');

        if(isset($_POST['email']) || isset($_POST['password']) )
        {
            if(strlen($_POST['email'])==0){

                echo "Preencha o seu e-mail";  
            } else if(strlen($_POST['password'])==0)
            {
                echo "Preencha com  a sua senha";
            }
            else {
                $email= $mysqli->real_escape_string ($_POST['email']); 
                $senha= $mysqli->real_escape_string ($_POST['password']); 
                
                $sql_code = "SELECT * FROM usuarios WHERE email='$email' AND senha='$senha'";
                $sql_query = $mysqli ->query($sql_code)or die("Falha na execução do codigo SQL ". $mysqli->error);

                $quantidade = $sql_query->num_rows;


                if($quantidade==1)
                {
                    $usuario =$sql_query->fetch_assoc();

                    if(!isset($_SESSION))
                    {
                        session_start();
                    }

                    $_SESSION['id']=$usuario['id'];
                    $_SESSION['email']=$usuario['email'];
                    $_SESSION['nome']=$usuario['nome'];

                    header("Location: indexhome.php");


                }
                else{
                    echo "<div id='erro'>Falha ao logar! E-mail ou senha incorretos</div>";
                }

            }



        }


        
        ?> 

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