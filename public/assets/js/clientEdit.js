
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

function validateFields() {
const id      = document.getElementById('clientId')?.textContent;
const name    = document.getElementById('name')?.value.trim();
const born_at = document.getElementById('born_at')?.value;
const cpfVal  = document.getElementById('cpf')?.value.trim();
const cnpjVal = document.getElementById('cnpj')?.value.trim();

    if (!id || !name || !born_at) return null;

    return JSON.stringify({
        id,
        name,
        born_at,
        cpf:  cpfVal  || null,
        cnpj: cnpjVal || null
    });
}