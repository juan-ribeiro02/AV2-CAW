<?php
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Cadastros - Gestão de Consumo de Energia</title>
    
    <!-- Link para o arquivo CSS centralizado -->
    <link rel="stylesheet" href="assets/style.css">
   <script src="assets/script.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/de85fa196f.js" crossorigin="anonymous"></script>
</head>
<body>

    <header class="header-principal">
        <nav class="container">
            <div class="nav-content">
                <div class="logo-container">
                    <a href="indexhome.php" class="logo-link">
                        Gestão Energia
                    </a>
                </div>
                <div class="nav-links">
                    <a href="indexhome.php" class="nav-link">Home</a>
                    <a href="gerenciar.php" class="nav-link nav-link--active">Gerenciar Cadastros</a>
                    <?php echo $_SESSION['nome'];?>
                    <a href="index.php" class="nav-link nav-link--logout"><i class="fa-solid fa-right-from-bracket"></i></a>
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
        
        <h1 class="page-title">
            Gerenciar Cadastros de Consumo
        </h1>

        <div class="table-container">
            <table class="data-table" id="data-table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Bairro</th>
                        <th scope="col">Hora (Pico)</th>
                        <th scope="col">Consumo (kWh)</th>
                        <th scope="col">Nº Residências</th>
                    </tr>
                </thead>
                <tbody id="data-table-body">
                    
                    <!-- <tr data-id="1" class="table-row-selectable">
                        <td class="data-id">1</td>
                        <td class="data-bairro">Centro</td>
                        <td class="data-hora">18:00</td>
                        <td class="data-consumo">450.50</td>
                        <td class="data-residencias">120</td>
                    </tr>
                    <tr data-id="2" class="table-row-selectable">
                        <td class="data-id">2</td>
                        <td class="data-bairro">Vila Nova</td>
                        <td class="data-hora">19:00</td>
                        <td class="data-consumo">620.00</td>
                        <td class="data-residencias">200</td>
                    </tr> -->
                    
                </tbody>
            </table>
        </div>

        <div class="action-buttons">
            <button id="btn-adicionar" class="btn btn-primary">
                Adicionar Novo
            </button>
            <button id="btn-editar" disabled class="btn btn-secondary-disabled">
                Editar Selecionado
            </button>
            <button id="btn-apagar" disabled class="btn btn-danger">
                Apagar Selecionado
            </button>
        </div>

    </main>

    <footer class="footer-principal">
        <div class="container footer-content">
            <p>&copy; 2025 GestãoEnergia S.A. Todos os direitos reservados.</p>
            <p class="footer-address">
                Av. da Inovação, 123 - Distrito Tech, São Paulo - SP
            </p>
        </div>
    </footer>

    <!-- Modal de Formulário (Adicionar/Editar) -->
    <div id="form-modal" class="modal-overlay">
        <div class="modal-box modal-box-lg">
            
            <div class="modal-header">
                <h3 id="form-title" class="modal-title">Adicionar Registro</h3>
                <button class="btn-modal-close">&times;</button>
            </div>
            
            <form id="form-data">
                <input type="hidden" id="registro-id">
                
                <div class="form-grid">
                    <div>
                        <label for="form-bairro" class="form-label-modal">Bairro</label>
                        <input type="text" id="form-bairro" name="bairro" required class="form-input-modal">
                    </div>
                    <div>
                        <label for="form-hora" class="form-label-modal">Hora (Pico)</label>
                        <input type="time" id="form-hora" name="hora" required class="form-input-modal">
                    </div>
                    <div>
                        <label for="form-consumo" class="form-label-modal">Consumo (kWh)</label>
                        <input type="number" step="0.01" id="form-consumo" name="consumo" required class="form-input-modal">
                    </div>
                    <div>
                        <label for="form-residencias" class="form-label-modal">Nº Residências</label>
                        <input type="number" id="form-residencias" name="residencias" required class="form-input-modal">
                    </div>
                </div>
                
                <div class="modal-actions">
                    <button type="button" class="btn btn-secondary btn-modal-close">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal de Exclusão -->
    <div id="delete-modal" class="modal-overlay">
        <div class="modal-box modal-box-md">
            <h3 class="modal-title">Confirmar Exclusão</h3>
            <p class="modal-text">
                Você tem certeza que deseja apagar o registro <strong id="delete-record-id"></strong>?
                Esta ação não pode ser desfeita.
            </p>
            <div class="modal-actions">
                <button type="button" class="btn btn-secondary btn-modal-close">
                    Cancelar
                </button>
                <button href="#" type="button" id="btn-confirm-delete" class="btn btn-danger">
                    Apagar
                </button>
            </div>
        </div>
    </div>
</body>
</html>