$(document).ready(function() {
    $("#fecha_nac").datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: '-100:+0',
      maxDate: 0,
      onSelect: function(dateText, inst) {
        $(this).addClass("active");
      },
      monthNames: ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"],
      monthNamesShort: ["ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"],
      dayNames: ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"],
      dayNamesMin: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
      dayNamesShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
      beforeShowDay: function(date) {
        var currentDate = new Date();
        var minDate = new Date();
        minDate.setFullYear(currentDate.getFullYear() - 16);
        return [date <= minDate, ''];
      }
    });

    $("#fecha_creacion").datepicker({
      dateFormat: 'yy-mm-dd',
      changeMonth: true,
      changeYear: true,
      yearRange: '-100:+0',
      maxDate: 0,
      onSelect: function(dateText, inst) {
        $(this).addClass("active");
      },
      monthNames: ["enero", "febrero", "marzo", "abril", "mayo", "junio", "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre"],
      monthNamesShort: ["ene", "feb", "mar", "abr", "may", "jun", "jul", "ago", "sep", "oct", "nov", "dic"],
      dayNames: ["domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado"],
      dayNamesMin: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"],
      dayNamesShort: ["dom", "lun", "mar", "mié", "jue", "vie", "sáb"]
    });
  });