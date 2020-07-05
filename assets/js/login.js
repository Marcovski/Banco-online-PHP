$('#txtCpf').mask('000.000.000-00');

if (document.getElementById('txtNascimento') != 'undefined')
    $('#txtNascimento').mask('00/00/0000');

let frmLogin = document.getElementById('frmLogin');

if (frmLogin != null && typeof frmLogin != 'undefined') {
    frmLogin.addEventListener('submit', (event) => {
        if (!validaCPF(document.getElementById('txtCpf').value)) {
            alert('CPF inválido.');
            event.preventDefault();
        }
    });
}

let registro = document.getElementById('frmRegistro');
if (registro != null && typeof registro != 'undefined') {
    registro.addEventListener('submit', (event) => {
        if (!validaCad(getValue())) {
            event.preventDefault();
        }
    });
}

function getValue() {
    var valores = {
        cpf: document.getElementById('txtCpf').value,
        nome: document.getElementById('txtNome').value,
        email: document.getElementById('txtEmail').value,
        nascimento: document.getElementById('txtNascimento').value,
        //pag login

    };
    return valores;
}

function validaCad(getValue) {

    if (!validaCPF(getValue.cpf)) {
        alert('Cpf inválido');
        return false;
    }

    if (getValue.nome.length < 5 || getValue.nome.length > 50) {
        alert('Nome inválido.');
        return false;
    }

    if (getValue.email.length < 5 && getValue.email.length > 50 || !/.+?\@.+?\..+/.test(getValue.email)) {
        alert('Email inválido.');
        return false;
    }

    if (!/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/.test(getValue.nascimento)) {
        alert('Data de nascimento inválida!');
        return false;
    }

    return true;
}
