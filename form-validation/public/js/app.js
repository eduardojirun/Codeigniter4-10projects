import validation_ajax from './utils.js';
// import {otraFuncion} from './miModulo.js';


$(document).on("click", "#btn-save-employee", function(event) {
    event.preventDefault();
    if ( $('#active-checkbox').is(':checked') ) {
        $("#active").val(true);
    } else {
        $("#active").val(false);
    }
    validation_ajax( $('#form-employee'), 'http://localhost/ci4/Codeigniter4-10projects/form-validation/employees' );  
});

// Jquery validation

$.validator.addMethod( "adultsOnly", function( value, element ) {
    if ( $( "#movie .adult:checked" ).val() === "on" ) {
        var now = new Date();
        var dob = $( "#dob" ).datepicker( "getDate" );
        var age = now - dob;
        return Math.floor( age / 31536000000 ) >= 18;
    }
    return true;
});

$("#form-employee-jquery").validate({
    rules: {
        first_name: {
            required: true,
            /* normalizer: function(value) {
                return $.trim(value);
            }, */
            rangelength: [2, 50],
           /*  minlength: 3,
            maxlength: 4,
            rangelength: [2, 50],
            min: 13,
            max: 23,
            range: [13, 23],
            step: 10, // multiplos de 10
            email: true,
            url: true,
            date: true,
            dateISO: true, // 2000-10-31
            number: true,
            digits: true,
            password: "required",
            password_again: {
                equalTo: "#password"
            }, */


        },
        last_name: {
            required: true,
            rangelength: [2, 50],            
        },
        email: {
            required: true,
            email: true,            
        },
        phone: {
            required: true,
            rangelength: [8, 10],
            number: true,
        },
        birthday: {
            required: true,
            dateISO: true,
        },
        date: {
            required: true,
            dateISO: true,
        },
        gender: {
            required: true,            
        },
        job_position: {
            required: true,
            letterswithbasicpunc: true,
        },
        department: {
            required: true,
            letterswithbasicpunc: true
        },
        salary: {
            required: true,            
        },
        date_admission: {
            required: true,
            dateISO: true,
        },
        comments: {
            required: true,            
        },
        /* active: {
            // required: true,            
        }, */
        photo: {
            // required: true,            
        },
    },
    messages: {
        first_name: {
            required: "Por favor ingresa un nombre",
            rangelength: "Debe contener entre 2 y 50 carácteres"
        },
        last_name: {
            required: "Ingresa un apellido",
            rangelength: [2, 50],            
        },
        email: {
            required: "Ingresa un email válido",
            email: true,            
        },
        phone: {
            required: "Ingresa un número de teléfono válido",
            rangelength: "Ingresa un número telefónico de entre 8 y 10 carácteres",
            number: "Solo ingresa números",
        },
        birthday: {
            required: "Ingresa una fecha",
            dateISO: "Ingresa una fecha válida",
        },
        date: {
            required: "Ingresa una fecha",
            dateISO: "Ingresa una fecha válida",
        },
        gender: {
            required: "Ingresa femenino o masculino",            
        },
        job_position: {
            required: "Ingresa un puesto de trabajo",
            // alphanumeric: "Ingresa solo letras y números",
            letterswithbasicpunc: "Ingresa letras con puntos básicos"
        },
        department: {
            required: "Ingresa un departamento o área",
            letterswithbasicpunc: "Ingresa letras con puntos básicos"
        },
        salary: {
            required: "Ingresa un salario",            
        },
        date_admission: {
            required: "Ingresa una fecha",
            dateISO: "Ingresa una fecha válida",
        },
        comments: {
            required: "Ingresa un comentario",            
        },
        /* active: {
            // required: "Selecciona activo",            
        }, */
        photo: {
            // required: true,            
        }
    },
    
    submitHandler: function() {
        if ( $('#form-employee-jquery #active-checkbox').is(':checked') ) {
            $("#form-employee-jquery #active").val(true);
        } else {
            $("#form-employee-jquery #active").val(false);
        }
        validation_ajax( $('#form-employee-jquery'), 'http://localhost/ci4/Codeigniter4-10projects/form-validation/employees' );  
        alert("Enviando datos validados en navegador para validarse en el servidor");
    },   
    // errorElement: "span",
    // onkeyup: false,     
    // errorClass: "error",

    errorElement: "em",
    errorPlacement: function ( error, element ) {
        // Add the `help-block` class to the error element
        error.addClass( "help-block" );

        if ( element.prop( "type" ) === "checkbox" ) {
            error.insertAfter( element.parent( "label" ) );
        } else {
            error.insertAfter( element );
        }
    },
    highlight: function ( element, errorClass, validClass ) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-error" ).removeClass( "has-success" );
    },
    unhighlight: function (element, errorClass, validClass) {
        $( element ).parents( ".col-sm-5" ).addClass( "has-success" ).removeClass( "has-error" );
    },

    /* highlight: function (element) {
        $(element).addClass("is-invalid");
    },
    unhighlight: function (element) {
        $(element).removeClass("is-invalid");
    },
    errorPlacement: function(error, element) {
        error.appendTo(element.parent().next());
    }, */
  
});