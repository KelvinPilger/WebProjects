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

function addContactLine() {
    const table = document.getElementById('contactTable');
    const buttonAdd = document.getElementById('btnAddContactLine');
    const tbBody = document.querySelector('#contactTable tbody');


    document.appendChild(document.createElement(tdInput));

    buttonAdd.addEventListener('click', () => {
        
    });
}