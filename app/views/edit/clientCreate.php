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
            <input type="text" id="cpf" name="cpf" maxlength="14" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);">

            <label for="cnpj">CNPJ</label>
            <input type="text" id="cnpj" name="cnpj" maxlength="18" onfocus="javascript: retirarFormatacao(this);" oninput="javascript: formatarCampo(this);">
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
        <div class="buttons">
            <button type="submit" class="btnSave">Salvar</button>
        </div>
</form>
<script>
    document.addEventListener('DOMContentLoaded', () => {
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

    function createDataClient() {
      const form = document.getElementById('clientForm');
      form.addEventListener('submit', async (event) => {
        event.preventDefault();
        refreshContactIndices();
        const formData = new FormData(form);
        formData.set('action', 'insert');
        console.log(formData);

        try {
          const resp = await fetch(`<?= $_SERVER['SCRIPT_NAME'] ?>/client/store`, {
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
          MessageModal.show('error', 'Falha ao realizar a persistência do cliente/contato no banco de dados.', err);
        }
      });
    }

    alternateCpfCnpj();
    refreshAll();
    createDataClient();
    });

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
</script>