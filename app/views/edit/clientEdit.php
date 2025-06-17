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
                    <input type="radio" id="fisica" name="nat_registration" value="Física" <?= $c['nat_registration'] === 'F'  ? 'checked' : '' ?> disabled>
                    <label for="fisica">Física</label>
                    <input type="radio" id="juridica" name="nat_registration" value="Jurídica" <?= $c['nat_registration'] === 'J' ? 'checked' : '' ?> disabled>
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
                    <input type="text" id="cpf" name="cpf" value="<?= htmlspecialchars($c['cpf'] ?? null) ?>" maxlength="14" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);" readonly>

                    <label for="cnpj">CNPJ</label>
                    <input type="text" id="cnpj" name="cnpj" value="<?= htmlspecialchars($c['cnpj'] ?? null) ?>" maxlength="18" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);" readonly>
                </div>
                <div class="containerContacts">
                    <label class="containerTitle">Contatos</label>
                    <div class="contactsWrapper">
                        <?php if (!empty($contacts)): ?>
                            <?php foreach ($contacts as $ctt): ?>
                                <div class="contact-row" data-index="0">
                                    <select name="contacts[0][type]" id="contatoType" class="contact-type">
                                        <option <?= $ctt['ctt_type'] === 'C'  ? 'selected' : '' ?>>Celular</option>
                                        <option <?= $ctt['ctt_type'] === 'T' ? 'selected' : '' ?>>Telefone</option>
                                        <option <?= $ctt['ctt_type'] === 'E'   ? 'selected' : '' ?>>E-mail</option>
                                        <option <?= $ctt['ctt_type'] === 'O'   ? 'selected' : '' ?>>Outros</option>
                                    </select>
                                    <input
                                        type="text"
                                        name="contacts[0][value]"
                                        id="contatoValue"
                                        class="contact-value"
                                        placeholder="Digite o contato"
                                        value="<?= htmlspecialchars($ctt['contact']) ?>" />
                                    <button type="button" id="btnAdd" class="btn-add">＋</button>
                                    <button type="button" class="btn-remove" style="display: none;">−</button>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="contactsWrapper">
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
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="buttons">
            <button type="submit" class="btnSave">Salvar</button>
        </div>
    </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('clientForm');
        const cpfField = document.getElementById('cpf');
        const cnpjField = document.getElementById('cnpj');
        const contactsWrapper = document.querySelector('.contactsWrapper');

        function alternateCpfCnpj() {
            const radCpf = document.getElementById('fisica');
            const radCnpj = document.getElementById('juridica');

            function update() {
                if (radCpf.checked) {
                    cpfField.disabled = false;
                    cnpjField.disabled = true;
                    cnpjField.value = '';
                } else {
                    cpfField.disabled = true;
                    cnpjField.disabled = false;
                    cpfField.value = '';
                }
            }
            radCpf.addEventListener('change', update);
            radCnpj.addEventListener('change', update);
            update();
        }

        function refreshContactIndices() {
            const rows = contactsWrapper.querySelectorAll('.contact-row');
            rows.forEach((row, idx) => {
                row.dataset.index = idx;
                row.querySelector('.contact-type').name = `contacts[${idx}][type]`;
                row.querySelector('.contact-value').name = `contacts[${idx}][value]`;
            });
        }

        function refreshRemoveButtons() {
            const rows = contactsWrapper.querySelectorAll('.contact-row');
            rows.forEach(row => {
                row.querySelector('.btn-remove').style.display =
                    rows.length > 1 ? 'inline-block' : 'none';
            });
        }

        function refreshAll() {
            refreshContactIndices();
            refreshRemoveButtons();
        }

        contactsWrapper.addEventListener('click', e => {
            e.preventDefault();
            const row = e.target.closest('.contact-row');
            if (!row) return;
            if (e.target.matches('.btn-add')) {
                e.preventDefault();
                const clone = row.cloneNode(true);
                clone.querySelector('.contact-value').value = '';
                const next = row.nextElementSibling;
                if (next) contactsWrapper.insertBefore(clone, next);
                else contactsWrapper.appendChild(clone);
                refreshAll();
            }
            if (e.target.matches('.btn-remove')) {
                e.preventDefault();
                row.remove();
                refreshAll();
            }
        });

        form.addEventListener('submit', async event => {
            event.preventDefault();
            refreshAll();
            const formData = new FormData(form);
            formData.set('action', 'edit');
            try {
                const resp = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });
                const json = await resp.json();
                console.log('PARSED JSON:', json);
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
                MessageModal.show('error', 'Falha na persistência do cliente.');
            }
        });

        refreshAll();
    });
</script>