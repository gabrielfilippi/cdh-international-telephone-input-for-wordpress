/**
 * Intercepta o envio do formulário e bloqueia o envio do mesmo caso os telefones não sejam válidos
 */
document.querySelectorAll('form').forEach(function (form) {
    form.addEventListener('submit', function (e) {
        let phoneNumberFields = document.querySelectorAll('.cdh-intl-tel');
        phoneNumberFields.forEach(function (field) {
            if (field.classList.contains('cdh-intl-tel-invalid-phone')) {
                field.focus();
                e.preventDefault();
            }
        });
    });
});