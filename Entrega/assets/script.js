document.addEventListener('DOMContentLoaded', () => {    
            const tableBody = document.getElementById('data-table-body');
            const btnAdicionar = document.getElementById('btn-adicionar');
            const btnEditar = document.getElementById('btn-editar');
            const btnApagar = document.getElementById('btn-apagar');
            const formModal = document.getElementById('form-modal');
            const deleteModal = document.getElementById('delete-modal');
            const formData = document.getElementById('form-data');
            const formTitle = document.getElementById('form-title');
            const hiddenIdInput = document.getElementById('registro-id');
            const btnConfirmDelete = document.getElementById('btn-confirm-delete');
            const closeButtons = document.querySelectorAll('.btn-modal-close');

            let selectedRow = null;
            const API_URL = 'api.php'; // Ajuste o caminho conforme necessário

            // Funções do Modal
            function openModal(modal) {
                modal.classList.add('active');
            }

            function closeModal(modal) {
                modal.classList.remove('active');
            }

            // Carregar dados da API
            async function loadData() {
                try {
                    const response = await fetch(API_URL);
                    const data = await response.json();
                    renderTable(data);
                } catch (error) {
                    console.error('Erro ao carregar dados:', error);
                }
            }

            // Renderizar tabela
            function renderTable(data) {
                tableBody.innerHTML = '';
                data.forEach(item => {
                    const row = document.createElement('tr');
                    row.classList.add('table-row-selectable');
                    row.dataset.id = item.id;
                    
                    row.innerHTML = `
                        <td class="data-id">${item.id}</td>
                        <td class="data-bairro">${item.bairro}</td>
                        <td class="data-hora">${item.hora}</td>
                        <td class="data-consumo">${item.consumo}</td>
                        <td class="data-residencias">${item.residencias}</td>
                    `;
                    tableBody.appendChild(row);
                });
            }

            // Funções dos botões de ação
            function setActionButtons(enabled) {
                if (enabled) {
                    btnEditar.disabled = false;
                    btnApagar.disabled = false;
                    btnEditar.classList.replace('btn-secondary-disabled', 'btn-warning');
                } else {
                    btnEditar.disabled = true;
                    btnApagar.disabled = true;
                    if (btnEditar.classList.contains('btn-warning')) {
                        btnEditar.classList.replace('btn-warning', 'btn-secondary-disabled');
                    }
                }
            }

            function deselectRow() {
                if (selectedRow) {
                    selectedRow.classList.remove('table-row-selected');
                    selectedRow = null;
                }
                setActionButtons(false); 
            }

            // Event Listeners
            tableBody.addEventListener('click', (e) => {
                const row = e.target.closest('tr.table-row-selectable');
                if (!row) return;

                if (row === selectedRow) {
                    deselectRow();
                } else {
                    deselectRow();
                    selectedRow = row;
                    selectedRow.classList.add('table-row-selected');
                    setActionButtons(true); 
                }
            });

            btnAdicionar.addEventListener('click', () => {
                deselectRow(); 
                formData.reset(); 
                hiddenIdInput.value = ''; 
                formTitle.textContent = 'Adicionar Novo Cadastro';
                openModal(formModal);
            });

            btnEditar.addEventListener('click', () => {
                if (!selectedRow) return;

                hiddenIdInput.value = selectedRow.dataset.id;
                formData.querySelector('#form-bairro').value = selectedRow.querySelector('.data-bairro').textContent;
                formData.querySelector('#form-hora').value = selectedRow.querySelector('.data-hora').textContent;
                formData.querySelector('#form-consumo').value = selectedRow.querySelector('.data-consumo').textContent;
                formData.querySelector('#form-residencias').value = selectedRow.querySelector('.data-residencias').textContent;
                
                formTitle.textContent = `Editar Registro #${hiddenIdInput.value}`;
                openModal(formModal);
            });

            btnApagar.addEventListener('click', () => {
                if (!selectedRow) return; 
                document.getElementById('delete-record-id').textContent = selectedRow.dataset.id;
                openModal(deleteModal);
            });

            closeButtons.forEach(button => {
                button.addEventListener('click', () => {
                    closeModal(button.closest('.modal-overlay'));
                    deselectRow();
                });
            });

            // Salvar dados (CREATE/UPDATE)
            formData.addEventListener('submit', async (e) => {
                e.preventDefault();
                
                const id = hiddenIdInput.value;
                const formDataObj = {
                    bairro: formData.querySelector('#form-bairro').value,
                    hora: formData.querySelector('#form-hora').value,
                    consumo: parseFloat(formData.querySelector('#form-consumo').value),
                    residencias: parseInt(formData.querySelector('#form-residencias').value)
                };

                if (id) {
                    formDataObj.id = parseInt(id);
                }

                try {
                    const response = await fetch(API_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(formDataObj)
                    });

                    const result = await response.json();
                    console.log(result.message);
                    
                    // Recarregar dados
                    await loadData();
                    closeModal(formModal);
                    deselectRow();
                    
                } catch (error) {
                    console.error('Erro ao salvar:', error);
                }
            });

            // Deletar dados
            btnConfirmDelete.addEventListener('click', async () => {
                if (!selectedRow) return;
                
                try {
                    const response = await fetch(API_URL, {
                        method: 'POST', 
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action: 'delete', 
                            id: parseInt(selectedRow.dataset.id)
                        })
                    });

                    // Verificamos se o servidor respondeu OK (status 200-299)
                    if (response.ok) {
                        // Se sim, recarrega a página.
                        location.reload();
                    } else {
                        // Se deu erro (404, 500, etc), avisa e não recarrega
                        alert("Erro do servidor. O item pode não ter sido apagado.");
                        closeModal(deleteModal); // Fecha o modal de "apagar"
                    }
                    
                } catch (error) {
                    // Só entra aqui se a rede falhar
                    console.error('Erro de conexão:', error);
                    alert("Erro de conexão. Não foi possível apagar.");
                }
            });
                /*if (!selectedRow) return;
                
                try {
                    const response = await fetch(API_URL, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            action:'delete',
                            id: parseInt(selectedRow.dataset.id)
                        })
                    });

                    const result = await response.json();
                    console.log(result.message);
                    
                    // Recarregar dados
                    await loadData();
                    closeModal(deleteModal);
                    deselectRow();
                    
                } catch (error) {
                    console.error('Erro ao deletar:', error);
                }
            });*/

            // Carregar dados iniciais
            loadData();
        });