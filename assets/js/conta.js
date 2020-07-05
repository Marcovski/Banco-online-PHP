'use stict'


var frmDepos = document.getElementById('frmDeposito');
if (frmDepos != null && typeof frmDepos != 'undefined') {
    frmDepos.addEventListener('submit', (event) => {
        let valor = document.getElementById('txtValor').value;
        let tratar = valor.replace(/[^\d]+/g, '');

        if (tratar <= 001 || tratar == '' || tratar == null || !validaDinheiro(valor)){
            alert('Valor invaldo.');
            event.preventDefault();
        }
    });
}

var frmSaque = document.getElementById('frmSaque');
if (frmSaque != null && typeof frmSaque != 'undefined') {
    frmSaque.addEventListener('submit', (event) => {
        let valor = document.getElementById('txtValor').value;
        let saldo = document.getElementById('txtSaldo').value;
        let tempValor = valor.replace(/[.,]/g, '');
        let tempSaldo = saldo.replace(/[.,]/g, '');

        if(!validaDinheiro(valor) || parseInt(tempValor) <= 0){
            alert('Informe o valor para saque.');
            event.preventDefault();
        }
        
        if(!validaDinheiro(saldo) || parseInt(tempSaldo) ){
            alert('Saldo inválido.');
            event.preventDefault();
        }


        if(parseInt(tempValor)>parseInt(tempSaldo) ){
            alert('O valor a ser sacado é maior do que o saldo atual.');
            event.preventDefault();
        }

    });
}
