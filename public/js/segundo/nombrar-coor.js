$(document).ready(function() {
    $('#nombrarCoordinadorModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var candidatoId = button.data('candidato-id');
        $("#candidato_id").val(candidatoId);
    });
});

//Función del cuscador
$(document).ready(function() {
    $("#buscador").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#tabla_usuarios tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
});