//Controla el tiempo de cambio del carousel
/*$(document).ready(function() {
    //Set the carousel options
    $('#quote-carousel').carousel({
        pause: true,
        interval: 4000,
    });
});*/

//Elimina la organizacion seleccionada en la lista sin recargar la pagina
$(document).ready(function(){
    $(document).on('click', '#delete_organiz', function (e) {
        e.preventDefault();

        console.log($(this).attr('organiz_id'));

        $.ajax({
            method: "POST",
            url: Routing.generate('delete_organiz'),
            data: {
                id: $(this).attr('organiz_id')
            },
            dataType: 'json',
            success: function (response){
                $('.flash-success').text(response.mensaje);
                $('#maincontent').html(response.lista_organizs_html);
            },
            error: function (jqXHR, exception){
                if (jqXHR.status === 405)
                {
                    console.error("METHOD NOT ALLOWED!");
                }
            }
        });
    });
});

// Llamada a AJAX solicitud
$(document).ready(function () {
    $(document).on('click','#eliminar',function (e) {
        e.preventDefault();

        console.log($(this).attr('solicitud_id'));

        $.ajax({
            method: "POST",
            url: Routing.generate('delete_solicitud'),
            data: {
                id: $(this).attr('solicitud_id')
            },
            dataType: 'json',
            success: function (response){
                $('.flash-success').text(response.mensaje);
                $('#maincontent').html(response.lista_solicitud_html);
            },
            error: function (jqXHR, exception){
                if (jqXHR.status === 405)
                {
                    console.error("METHOD NOT ALLOWED!");
                }
            }

        });

    });

});
/*Cambia las opciones del sidebar del administrador sin recargar la pagina AJAX*/
$(document).ready(function () {
    $(document).on('click', '#cambiar', function (e) {
        e.preventDefault();
        //console.log($(this).attr('value'));
        $.ajax({
            method: "POST",
            url: Routing.generate('admin_seleccion'),
            data: {
                value: $(this).attr('value')
            },
            dataType: 'json',
            success: function(response){
                template = response.main_content_html;
                $('#maincontent').html(template).slideDown();
                console.log(template);
            }
        });
    });

    $('li > a').click(function() {
        $('li').removeClass();
        $(this).parent().addClass('active');
    });
});

/*Actualiza los datos del administrador sin recargar la pagina AJAX*/
$(document).ready(function () {
    $(document).on('click', '#perfil', function (e) {
        e.preventDefault();
        $.ajax({
            method: "POST",
            url: Routing.generate('admin_edit'),
            data: {
                value: $(this).attr('value')
            },
            dataType: 'json',
            success: function(response){

                template = response.main_content_html;
                $('.flash-success').text(response.mensaje);
                $('#maincontent').html(template).slideDown();
                console.log(response.admin);
                console.log('Editar ejucutado exitosamente');
            }
        });
    });
});

//Genera el form login modal btnLogin01
$(document).ready(function() {
    $(document).on('click', '#btnLogin01', function (e) {
        e.preventDefault();
        console.log($(this).attr('value'));
        $.ajax({
            method: "POST",
            url: Routing.generate('login_modal'),
            data: {
                value: $(this).attr('value')
            },
            dataType: 'json',

            /*type        : $('form').attr( 'method' ),
             url         : $('form').attr( 'action' ),
             data        : $('form').serialize(),*/

            success: function(response, status, object){
                template = response.login_modal_html;
                $('#modallogin').html(template);
                console.log(template);
                /*console.log( status );
                 console.log( object.responseText );*/
                $("#loginModal").modal();
            }
        });
    });
});

//Muestra el select de organizaciones justo luego de recargar la pagina
$(window).bind("load", function() {
    if($('#usuario_form_rol').find("option:selected").text() === "Encargado")
        $('#ver_organiz').removeClass();
});

//Muestra el select de las organizaciones
$(document).ready(function() {
    var $rol = $('#usuario_form_rol');
    // When rol gets selected ...
    $rol.change(function() {
        var rolUser = $(this).find("option:selected").text();
        if (rolUser == 'Familiar'){
            console.log('Seleccionaste el rol familiar');
            $('#ver_organiz').addClass('hidden');
        }
        else if (rolUser == 'Encargado'){
            console.log('Seleccionaste el rol encargado');
            $('#ver_organiz').removeClass();
        }
        else
            $('#ver_organiz').addClass('hidden');
    });
});

//Muestra la organizaciones si encargado se encuentra seleccionado
/*$( "form" ).submit(function( event ) {
    if ( ($('#usuario_form_rol').find("option:selected").text() === "Familiar" &&
          $('#usuario_form_organiz').find("option:selected").text() === "Elije tu organizacion") ||
         ($('#usuario_form_rol').find("option:selected").text() === "Encargado" &&
          $('#usuario_form_organiz').find("option:selected").text() !== "Elije tu organizacion")) {
        console.log('Familiar ha sido seleccionado sin seleccionar ninguna organizacion');
        return;
    }
    $('label[for="usuario_form_organiz"]').attr('id', 'errorcss');
    //console.log($('label[for="usuario_form_organiz"]'));
    $('#borrar').removeClass();
    $( "#error" ).text( "Este valor no debe estar en blanco" ).show();
    event.preventDefault();
});*/

//Verifica que se haya seleccionado una organizacion
$(document).ready(function() {
    var $rol = $('#usuario_form_organiz');
    // When rol gets selected ...
    $rol.change(function() {
        var rolUser = $(this).find("option:selected").text();
        if ( rolUser !== "Elije tu organizacion" ){
            $( "#error" ).hide();
            this.delegateEvents();
        }
    });
});