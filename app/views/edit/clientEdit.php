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
                    <table id="contactTable">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Contato</th>
                            </tr>
                        </thead>
                        <tbody id="contactTableBody">
                            <tr>
                                <td id="selectContact">
                                    <select name="ctt_type" id="contactType">
                                        <option>Celular</option>
                                        <option>Telefone</option>
                                        <option>E-mail</option>
                                        <option>Outros</option>
                                    </select>
                                </td>
                                <td id="inputContact">
                                    <input type="text" name="contact">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button class="btnAddContactLine">+</button>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="buttons">
            <button type="submit" class="btnSave">Salvar</button>
        </div>
        <script>
             document.addEventListener('DOMContentLoaded', () => {
                alternateCpfCnpj();
            });

            function editDataClient() {
                const form = document.getElementById('clientForm');

                form.addEventListener('submit', async event => {
                    event.preventDefault();

                    const formData = new FormData(form);
                    formData.append("action", "edit");

                    console.log(formData);

                    const data = await fetch('client/store', {
                        method: 'POST',
                        mode: 'cors',
                        body: formData
                    })
                    const response = await data.json();
                });
            };

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