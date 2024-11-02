
let inputValor = document.getElementById('valor');

inputValor.addEventListener('input', function(){

    let valueValor = this.value.replace(/[^\d]/g, '');

    var formattedValor = (valueValor.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valueValor.slice(-2);

    formattedValor = formattedValor.slice(0, -2) + ',' + formattedValor.slice(-2);

    this.value = formattedValor;
});

function confirmarExclusao(event, contaId){
    
    event.preventDefault();

    Swal.fire({
        title: 'Tem Certeza?',
        text: 'Voce nao ira reverter isso',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonColor: '#0d6efd',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#dc3545',
        confirmButtonText: 'Excluir',
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById(`formExluir${contaId}`).submit();
        }
    })
}