$(function () {
    // Toggle senha simples
    $('#togglePwd').on('click', function () {
        var $pwd = $('#senha');
        if ($pwd.attr('type') === 'password') {
            $pwd.attr('type', 'text');
            $(this).text('Ocultar');
        } else {
            $pwd.attr('type', 'password');
            $(this).text('Mostrar');
        }
    });

    // Validação simples antes de submeter
    $('#loginForm').on('submit', function (e) {
        var email = $.trim($('#email').val());
        var senha = $('#senha').val();
        var valid = true;

        // resetar estados
        $('#email').removeClass('is-invalid');
        $('#senha').removeClass('is-invalid');

        if (!email) {
            $('#email').addClass('is-invalid');
            valid = false;
        } else {
            // validação básica de email
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!re.test(email)) {
                $('#email').addClass('is-invalid');
                valid = false;
            }
        }

        if (!senha || senha.length < 6) {
            $('#senha').addClass('is-invalid');
            valid = false;
        }

        if (!valid) {
            e.preventDefault();
            return false;
        }
        // caso válido: formulário é enviado ao server
    });
});
document.getElementById('toggleSenha').addEventListener('click', function (e) {
    e.preventDefault();
    const senha = document.getElementById('senha');
    if (senha.type === 'password') {
        senha.type = 'text';
        this.innerText = 'Ocultar';
    } else {
        senha.type = 'password';
        this.innerText = 'Mostrar';
    }
});

// Formatar CPF enquanto digita
document.getElementById('cpf').addEventListener('input', function (e) {
    let cpf = e.target.value.replace(/\D/g, '');
    if (cpf.length > 11) cpf = cpf.slice(0, 11);

    if (cpf.length <= 3) {
        e.target.value = cpf;
    } else if (cpf.length <= 6) {
        e.target.value = cpf.slice(0, 3) + '.' + cpf.slice(3);
    } else if (cpf.length <= 9) {
        e.target.value = cpf.slice(0, 3) + '.' + cpf.slice(3, 6) + '.' + cpf.slice(6);
    } else {
        e.target.value = cpf.slice(0, 3) + '.' + cpf.slice(3, 6) + '.' + cpf.slice(6, 9) + '-' + cpf.slice(9);
    }
});

// Validação no submit
document.getElementById('formTecnico').addEventListener('submit', function (e) {
    const password = document.getElementById('senha').value;
    const isEdit = document.querySelector('input[name="id"]').value;

    // Validar CPF
    const cpf = document.getElementById('cpf').value.replace(/\D/g, '');
    if (cpf.length !== 11) {
        e.preventDefault();
        alert('CPF inválido (11 dígitos necessários)');
        return;
    }

    // Validar senha
    if (!isEdit && password.length < 6) {
        e.preventDefault();
        alert('Senha deve ter no mínimo 6 caracteres');
        return;
    }
    if (isEdit && password && password.length < 6) {
        e.preventDefault();
        alert('Se alterar a senha, ela deve ter no mínimo 6 caracteres');
        return;
    }
});