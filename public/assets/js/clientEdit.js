
document.addEventListener('DOMContentLoaded', () => {
    setupMaskCpf();
    setupFormSubmit();
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

    if (!id || !name || !born_at) return null;

function createDataClient(event) {
    event.preventDefault();
    const id = document.getElementById('id').textContent;
    const name = document.getElementById('name').value;
    const born_at = document.getElementById('bornDate').value;
    const cpf = document.getElementById('cpf').value;
    const cnpj = document.getElementById('cnpj').value;

    let data = ({id: id, name: name, born_at: born_at, cpf:cpf||null, cnpj:cnpj||null})

    JSON.stringify(data);
    console.log(data);

    fetch('client/store',
        {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: data
        }
    )
    .then(res => res.json())
    .then(json => console.log(json))
    .catch(err => console.error(err));
};
