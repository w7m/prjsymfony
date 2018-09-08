$(document).ready(function () {
    content = $('#wahid_handlinguserbundle_etudiant_comptesocials').attr('data-prototype');
    content = content.replace("__name__label__","");
    $("#wahid_handlinguserbundle_etudiant_comptesocials").after(content);

    $('#add-social-account').click(function () {

        content = $('#wahid_handlinguserbundle_etudiant_comptesocials').attr('data-prototype');
        content = content.replace("__name__label__","");
        $("#wahid_handlinguserbundle_etudiant_comptesocials").after(content);
    });
});
