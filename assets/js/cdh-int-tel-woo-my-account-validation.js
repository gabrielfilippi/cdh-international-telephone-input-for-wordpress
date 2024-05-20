/**
 * Intercepta o envio do formulário e bloqueia o envio do mesmo caso os telefones não sejam válidos
 */
const editAddressForm = document.querySelector(".woocommerce-MyAccount-content form");
if(editAddressForm){
    editAddressForm.addEventListener("submit", function(t) {
        document.querySelectorAll(".cdh-intl-tel").forEach(function(e) {
            if (e.classList.contains("cdh-intl-tel-invalid-phone")) {
                e.focus();
                t.preventDefault();
            }
        });
    });
    
}