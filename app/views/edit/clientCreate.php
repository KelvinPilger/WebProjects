<form id="clientForm" method="POST" action="../client/store">
    <div class="infoContainer">
        <div class="containerNatRegistr">
            <input type="hidden" name="action" value="insert">
            <label class="containerTitle">Tipo</label>

            <input type="radio" id="fisica" name="registrationType">
            <label for="fisica">Física</label>

            <input type="radio" id="juridica" name="registrationType">
            <label for="juridica">Jurídica</label>
        </div>
        <div class="containerGeneralInfo">
            <label class="containerTitle">Dados Gerais</label>

            <label for="name">Nome</label>
            <input type="text" placeholder="Insira o Nome" id="name" name="name">

            <label for="bornDate">Data de Nascimento</label>
            <input type="date" name="bornDate" id='bornDate'>
        </div>
        <div class="containerCnpjCpf">
            <label class="containerTitle">Registro Nacional</label>

            <label for="cpf">CPF</label>
            <input type="text" id="cpf" name="cpf" maxlength="11" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);">

            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" maxlength="14" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);">
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
                        <button class="btnAddContactLine">+</button>
                    </tr>
                </tbody>
            </table>
            
        </div>
        <div class="buttons">
            <button type="submit" class="btnSave">Salvar</button>
        </div>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                alternateCpfCnpj();
            });

            function alternateCpfCnpj() {
                const radCpf = document.getElementById('fisica');
                const radCnpj = document.getElementById('juridica');
                const cpf = document.getElementById('cpf');
                const cnpj = document.getElementById('cnpj');
                const radios = document.getElementById('containerNatRegistr');

                cpf.disabled = true;
                cnpj.disabled = true;

                [radCpf, radCnpj].forEach(radio => {
                    radio.addEventListener('change', () => {
                    if(radCpf.checked) {
                        cnpj.value = null;
                        cpf.disabled = false;
                        cnpj.disabled = true;
                    } else {
                        cpf.value = null;
                        cpf.disabled = true;
                        cnpj.disabled = false;
                    }
                })
            });
        
            

            function createDataClient() {
                const form = document.getElementById('clientForm');

                form.addEventListener('submit', async event => {
                    event.preventDefault();

                    const formData = new FormData(form);
                    formData.append("action", "insert");

                    console.log(formData);

                    const data = await fetch('client/store', {
                        method: 'POST',
                        mode: 'cors',
                        body: formData
                    })
                    const response = await data.json();
                });
            };

            function formatarCampo(campoTexto) {
                if (campoTexto.value.length <= 11) {
                    campoTexto.value = mascaraCpf(campoTexto.value);
                } else {
                    campoTexto.value = mascaraCnpj(campoTexto.value);
                }
            }

            function retirarFormatacao(campoTexto) {
                campoTexto.value = campoTexto.value.replace(/(\.|\/|\-)/g, "");
            }

            function mascaraCpf(valor) {
                return valor.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3\-\$4");
            }

            function mascaraCnpj(valor) {
                return valor.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3\/\$4\-\$5");
            }
        }
        </script>
    </div>
</form>