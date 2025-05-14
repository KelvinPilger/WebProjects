
document.addEventListener('DOMContentLoaded', () => {
    setupMaskCpf();
});

function setupMaskCpf() {
    const campoCpf = document.getElementById('cpf');
    if (!campoCpf) return;

    campoCpf.addEventListener('input', event => {
        let v = event.target.value.replace(/\D/g, '');

        v = v.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');
        v = v.replace(/(\d{3})(\d{2})$/, '$1.$2-$3');

        campoCpf.value = v;
    });
}

const form = document.getElementById('clientForm');
form.addEventListener('submit', createDataClient);

function createDataClient(event) {
    event.preventDefault();
    const id = document.getElementById('id').textContent;
    const name = document.getElementById('name').value;
    const born_at = document.getElementById('bornDate').value;
    const cpf = document.getElementById('cpf').value;
    const cnpj = document.getElementById('cnpj').value;

    let nRegister;

    if(cpf != null) {
        nRegister = 'F'
    } else {
        nRegister = 'J'
    }

    let dataJson = JSON.stringify({id: id, name: name, born_at: born_at, cpf:cpf||null, cnpj:cnpj||null, nat_registration: nRegister})

    console.log(dataJson);

    fetch('../store',
        {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: dataJson
        }
    )
    .catch('Não foi possível realizar o fetch');
};
