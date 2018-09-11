$(document).ready(function () {
    content = $('#wahid_handlinguserbundle_etudiant_comptesocials').attr('data-prototype');
    content = content.replace("__name__label__","");
    $('#add-social-account').click(function () {
        $("#wahid_handlinguserbundle_etudiant_comptesocials").after("<button id='delete-compte-social' type='button'>Supprimer !</button>",content);
        $('#delete-compte-social').click(function () {
            $(this).next().remove();
            $(this).remove();
        });
    });
});
