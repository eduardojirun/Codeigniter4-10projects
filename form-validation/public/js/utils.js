export default function validation_ajax( form, route ) {

    const names_form = [];
    // You need to use standard javascript object here
    const form_data = new FormData( form[0] );            
    //form_data.append('photo', $('input[type=file]')[0].files[0]);
    let formElemet = $(form[0]).attr('id');

    $( $(form).serializeArray() ).each(function(index, value) {
        if ( value.name != 'csrf_hdi' ) {
            names_form.push( value.name );
        }
    });
    names_form.push( 'photo' );
    console.log(names_form);
    // console.log(form_data);

    // form_data.append('csrf_hdi', csrf['csrf_hdi']);        
    $.ajax({
        url: route,
        type: 'POST',
        dataType: 'json',
        data: form_data,  
        contentType: false,  
        cache: false,  
        processData: false
    })
    .done(function(response, textStatus, jqXHR ) {
        console.log( 'success' );
        console.log( response );
        //console.log( response.hasOwnProperty( names_form[3]) );
        if ( textStatus === 'success' ) {
            // Toast
            const toastLiveExample = document.getElementById('liveToast')
            const toastBootstrap = bootstrap.Toast.getOrCreateInstance(toastLiveExample)
            toastBootstrap.show()

            $(  '#' + formElemet ).trigger( 'reset' );
            for ( var i = 0; i < names_form.length; i++ ) {
                let nameForm = names_form[i];
                $(  '#' + formElemet + ' #warn_'+nameForm ).removeClass('has-error').addClass('has-success');
                $(  '#' + formElemet + ' #warn_'+nameForm+' p' ).addClass('d-none').text( '' );
            }
        }  
          
    })
    .fail(function(jqXHR, textStatus, errorThrown ) {
        console.log("fail");
        console.log('jqXHR', jqXHR);
        
        if ( jqXHR.status == 422 ) {
            let messages = jqXHR.responseJSON.messages;
            console.log('messages', messages);            
            
            if ( messages ) {
                for ( var i = 0; i < names_form.length; i++ ) {
                    let nameForm = names_form[i];
                    if ( nameForm.indexOf('[]') ) {
                        nameForm = names_form[i].replace('[]', '');
                    }
                    //console.log( nameForm );

                    if ( messages.hasOwnProperty( nameForm ) ) {
                        $( '#' + formElemet + ' #warn_'+nameForm ).removeClass('has-success').addClass('has-error');
                        $( '#' + formElemet + ' #warn_'+nameForm+' p' ).removeClass('d-none').text(messages[nameForm] );                           

                    } else {
                        $(  '#' + formElemet + ' #warn_'+nameForm ).removeClass('has-error').addClass('has-success');
                        $(  '#' + formElemet + ' #warn_'+nameForm+' p' ).addClass('d-none').text( '' );
                    }

                }            
            }
        }
    })
    .always(function( data, textStatus, jqXHR)  {
        console.log("always");
    })    
    .then(function( data, textStatus, jqXHR ) {
        console.log("then");    
    });
}
/* Docs ajax jquery
    jqXHR.done(function( data, textStatus, jqXHR ) {});
    An alternative construct to the success callback option, refer to deferred.done() for implementation details.

    jqXHR.fail(function( jqXHR, textStatus, errorThrown ) {});
    An alternative construct to the error callback option, the .fail() method replaces the deprecated .error() method. Refer to deferred.fail() for implementation details.

    jqXHR.always(function( data|jqXHR, textStatus, jqXHR|errorThrown ) { }); (added in jQuery 1.6)
    An alternative construct to the complete callback option, the .always() method replaces the deprecated .complete() method.

    In response to a successful request, the function's arguments are the same as those of .done(): data, textStatus, and the jqXHR object. For failed requests the arguments are the same as those of .fail(): the jqXHR object, textStatus, and errorThrown. Refer to deferred.always() for implementation details.

    jqXHR.then(function( data, textStatus, jqXHR ) {}, function( jqXHR, textStatus, errorThrown ) {});
    Incorporates the functionality of the .done() and .fail() methods, allowing (as of jQuery 1.8) the underlying Promise to be manipulated. Refer to deferred.then() for implementation details.
*/