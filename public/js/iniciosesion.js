$(document).ready(function () {
  // Mostrar la pestaña de inicio de sesión por defecto
  $('#iniciar-sesion').show();
  $('#registrarse').hide();

  // Alternar entre las pestañas de iniciar sesión y registro
  $('.tab a').on('click', function (e) {
      e.preventDefault();
      var target = $(this).attr('href');
      $('.contenido-tab > div').hide(); // Ocultar todo
      $(target).fadeIn(600); // Mostrar la pestaña seleccionada

      // Cambiar la pestaña activa
      $(this).parent().addClass('active').siblings().removeClass('active');
  });
});
