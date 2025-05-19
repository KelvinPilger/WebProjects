
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

function createDataClient() {
    const form = document.querySelector('clientForm');
    
    form.addEventListener('submit', async event => {
        event.preventDefault();

        const formData = new FormData(form);

        console.log(formData);

        const data = await fetch('client/store',
            {
                method: 'POST',
                mode: 'cors',
                body: formData
            }
        ) 
        const response = await data.json();
    });
};
