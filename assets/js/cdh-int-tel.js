/**
 * The code below is responsible for instantiating all phone fields that have the cdh-intl-tel class.
 * For each instantiated field we store it in the global window variable.
 * 
 * @author Gabriel Filippi
 * @since 16/05/2024
 */
import { intlTranslation } from "../intl-tel-input/i18n/pt/translation.js";

jQuery(document).ready(function ($) {
    window.intlInstances = {}
    let phoneNumberFields = document.querySelectorAll('.cdh-intl-tel');

    // for each field, init international phone number
    phoneNumberFields.forEach(function (field) {
        let intlTelInput = window.intlTelInput(field, {
            utilsScript: "../js/utils.min.js",
            i18n: intlTranslation(),
            preferredCountries: ['us', 'ca', 'pt', 'es', 'gb', 'it', 'de', 'fr', 'jp', 'au'],
            initialCountry: "br",
            hiddenInput: () => ({ phone: $(field).attr("name") + "_full_number" }),
            separateDialCode: true,
            formatOnDisplay: true,
            nationalMode: false,
            strictMode: true,
            customPlaceholder: function (selectedCountryPlaceholder, selectedCountryData) {
                return selectedCountryPlaceholder;
            }
        });

        //adds the name attribute to the search field, to avoid errors and conflicts with other plugins
        $(intlTelInput.searchInput).attr("name", $(field).attr("name") + "_search_input")

        //We start the hidden field with the same value as the HTML field, but in the E164 format
        $(intlTelInput.hiddenInput).val(intlTelInput.getNumber(intlTelInputUtils.numberFormat.E164));

        /**
         * we added the closeDropdown method to the intlTelInput instance, to close the country dropdown
         */
        intlTelInput._closeDropdown = intlTelInput.closeDropdown = function() {
            if (!this.dropdownContent.classList.contains("iti__hide")) {
                this.dropdownContent.classList.add("iti__hide");
            }
        };

        /**
         * Event for the entire document so that when clicked outside the country dropdown it will be closed.
         */
        document.addEventListener('click', function(event) {
            const isClickInsideInput = field.contains(event.target);
            const isClickOnDropdown = intlTelInput.dropdownContent.contains(event.target);

            if (!isClickInsideInput && !isClickOnDropdown) {
                intlTelInput.closeDropdown();
            }
            cdhIntlTelCheckFieldIsValid();
        });

        /**
         * Event the phone number field so that when clicked inside it, we close the country dropdown
         */
        field.addEventListener('click', function(event) {
            const dropdownIsVisible = !intlTelInput.dropdownContent.classList.contains("iti__hide");
            if (dropdownIsVisible) {
                intlTelInput.closeDropdown();
            }
            cdhIntlTelCheckFieldIsValid();
        });

        /**
         * As the user enters their phone number, we update the hidden field and also call the validation function.
         */
        field.addEventListener('keyup', function () {
            $(intlTelInput.hiddenInput).val(intlTelInput.getNumber(intlTelInputUtils.numberFormat.E164));
            cdhIntlTelCheckFieldIsValid();
        });

        /**
         * When field value change, call validation function
         */
        field.addEventListener('change', function () {
            cdhIntlTelCheckFieldIsValid();
        });

        /**
         * When the country is selected, we format the number and save it in the hidden field
         */
        field.addEventListener('countrychange', function() {
            $(intlTelInput.hiddenInput).val(intlTelInput.getNumber(intlTelInputUtils.numberFormat.E164));
        });

        /**
         * We validate the phone number and include error messages and field validation classes
         */
        function cdhIntlTelCheckFieldIsValid(){
            const errorMap = ["Número inválido", "Código de país inválido", "Muito curto", "Muito longo", "Número inválido"];

            if (field.value.trim() !== "") {
                if (intlTelInput.isValidNumberPrecise()) {
                    $(field).closest(".phone-number-group").find(".error").hide();
                    $(field).closest(".phone-number-group").removeClass("woocommerce-invalid woocommerce-invalid-required-field");
                    $(field).removeClass("cdh-intl-tel-invalid-phone");
                } else {
                    const message = errorMap[intlTelInput.getValidationError()] || "Número inválido";
                    $(field).closest(".phone-number-group").find(".error").html(message).show();
                    $(field).closest(".phone-number-group").addClass("woocommerce-invalid woocommerce-invalid-required-field");
                    $(field).addClass("cdh-intl-tel-invalid-phone");
                }
            } else {
                if($(field).closest(".phone-number-group.validate-required").length > 0){ // is required
                    $(field).closest(".phone-number-group").find(".error").html("Telefone é um campo obrigatório.").show();
                }else{ // not required, hide error message
                    $(field).closest(".phone-number-group").find(".error").hide();
                    $(field).removeClass("cdh-intl-tel-invalid-phone");
                }
            }
        }

        // Store the instance in the global variable
        window.intlInstances[$(field).attr("name")] = intlTelInput;
    });
});