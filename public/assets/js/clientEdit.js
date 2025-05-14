function maskCpf() {
    const campoCpf = document.getElementById('cpf');

    campoCpf.addEventListener('input', function(event) {
        let valor = event.target.value;

        valor = valor.replace(/\D/g, '');

        valor = valor.replace(/(\d{3})(\d{3})(\d{3})/, '$1.$2.$3');
        valor = valor.replace(/(\d{3})(\d{3})(\d{2})/, '$1.$2-$3');

        campoCpf.valor = valor;
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