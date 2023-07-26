$(document).ready(function() {
    $('#nombrarCoordinadorModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var candidatoId = button.data('candidato-id');
        $("#candidato_id").val(candidatoId);
    });
});