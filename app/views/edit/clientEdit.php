<form id="clientForm" method="POST" action="../store">
    <div class="infoContainer">
        <?php if (!empty($clients)): ?>
            <?php foreach ($clients as $c): ?>
                <div class="containerId">
                    <label class="containerTitle">Cód.</label>
                    <label class="clientId" id='id'><?= htmlspecialchars($c['id']) ?></label>
                    <input type="hidden" name="action" value="edit">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($c['id']) ?>">
                </div>
                <div class="containerNatRegistr">
                    <label class="containerTitle">Tipo</label>

                    <input type="radio" id="fisica" name="registrationType">
                    <label for="fisica">Física</label>

                    <input type="radio" id="juridica" name="registrationType">
                    <label for="juridica">Jurídica</label>
                </div>
                <div class="containerGeneralInfo">
                    <label class="containerTitle">Dados Gerais</label>

                    <label for="name">Nome</label>
                    <input type="text" placeholder="Insira o Nome" id="name" name="name" value="<?= htmlspecialchars($c['name']) ?>">

                    <label for="bornDate">Data de Nascimento</label>
                    <input type="date" name="bornDate" id='bornDate' value="<?= htmlspecialchars($c['born_at']) ?>">
                </div>
                <div class="containerCnpjCpf">
                    <label class="containerTitle">Registro Nacional</label>

                    <label for="cpf">CPF</label>
                    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($c['cpf']) ?>" maxlength="11" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);">

                    <label for="cnpj">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" value="<?= htmlspecialchars($c['cnpj']) ?>" maxlength="14" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);">
                </div>
                <div class="containerContacts">
                    <label class="containerTitle">Contatos</label>
                    <div id="contactsWrapper">
                        <div class="contact-row" data-index="0">
                            <select name="contacts[0][type]" id="contatoType" class="contact-type">
                                <option value="Celular">Celular</option>
                                <option value="Telefone">Telefone</option>
                                <option value="E-mail">E-mail</option>
                                <option value="Outros">Outros</option>
                            </select>
                            <input
                                type="text"
                                name="contacts[0][value]"
                                id="contatoValue"
                                class="contact-value"
                                placeholder="Digite o contato" />
                            <button type="button" id="btnAdd" class="btn-add">＋</button>
                            <button type="button" class="btn-remove" style="display: none;">−</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="buttons">
            <button type="submit" class="btnSave">Salvar</button>
        </div>
        <script>
             document.addEventListener('DOMContentLoaded', () => {
                alternateCpfCnpj();

                const contactsWrapper = document.getElementById('contactsWrapper');
                function refreshContactIndices() {
                const rows = contactsWrapper.querySelectorAll('.contact-row');
                rows.forEach((row, idx) => {
                    row.setAttribute('data-index', idx);
                    const selectType = row.querySelector('.contact-type');
                    const inputValue = row.querySelector('.contact-value');
                    selectType.setAttribute('name', `contacts[${idx}][type]`);
                    inputValue.setAttribute('name', `contacts[${idx}][value]`);
                });
                }

                function refreshRemoveButtons() {
                const rows = contactsWrapper.querySelectorAll('.contact-row');
                rows.forEach(row => {
                    const btnRemove = row.querySelector('.btn-remove');
                    btnRemove.style.display = rows.length > 1 ? 'inline-block' : 'none';
                });
                }

                function refreshAll() {
                refreshContactIndices();
                refreshRemoveButtons();
                }

                contactsWrapper.addEventListener('click', e => {
                const target = e.target;
                if (target.classList.contains('btn-add')) {
                    e.preventDefault();
                    const currentRow = target.closest('.contact-row');
                    const newRow = currentRow.cloneNode(true);
                    newRow.querySelector('.contact-value').value = '';
                    contactsWrapper.insertBefore(newRow, currentRow.nextSibling);
                    refreshAll();
                }
                if (target.classList.contains('btn-remove')) {
                    e.preventDefault();
                    const currentRow = target.closest('.contact-row');
                    currentRow.remove();
                    refreshAll();
                }
                });

                function alternateCpfCnpj() {
                const radCpf  = document.getElementById('fisica');
                const radCnpj = document.getElementById('juridica');
                const cpfField  = document.getElementById('cpf');
                const cnpjField = document.getElementById('cnpj');
                cpfField.disabled  = true;
                cnpjField.disabled = true;
                radCpf.addEventListener('change', () => {
                    if (radCpf.checked) {
                    cpfField.disabled = false;
                    cnpjField.disabled = true;
                    cnpjField.value = '';
                    }
                });
                radCnpj.addEventListener('change', () => {
                    if (radCnpj.checked) {
                    cpfField.disabled = true;
                    cnpjField.disabled = false;
                    cpfField.value = '';
                    }
                });
                }

                function editDataClient() {
                const form = document.getElementById('clientForm');
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    refreshContactIndices();
                    const formData = new FormData(form);
                    formData.set('action', 'edit');

                    try {
                    const resp = await fetch(form.getAttribute('action'), {
                        method: 'POST',
                        body: formData
                    });
                    const json = await resp.json();
                    console.log(json);
                    if (resp.ok && json.status === 'success') {
                        MessageModal.show('success', json.message);
                        setTimeout(() => {
                        window.location.href = `<?= $_SERVER['SCRIPT_NAME'] ?>/client/index`;
                        }, 2500);
                    } else {
                        MessageModal.show('error', json.message || 'Erro desconhecido ao salvar.');
                    }
                    } catch (err) {
                    console.error('Erro no fetch():', err);
                    MessageModal.show('error', 'Falha ao realizar a persistência do cliente/contato no banco de dados.');
                    }
                });
                }

                alternateCpfCnpj();
                refreshAll();
                createDataClient();
            });

            function alternateCpfCnpj() {
                const radCpf = document.getElementById('fisica');
                const radCnpj = document.getElementById('juridica');
                const cpf = document.getElementById('cpf');
                const cnpj = document.getElementById('cnpj');

                [radCnpj, radCpf, cpf, cnpj].forEach(el => el.disabled = true);

                if (cpf.value != null || cpf.value != '') {
                    radCpf.checked = true;
                    radCnpj.checked = false;
                } else {
                    radCpf.checked = false;
                    radCnpj.checked = true;
                }
            };
        </script>
    </div>
</form>