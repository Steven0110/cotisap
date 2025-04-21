
/**
 *
 *
 *  @author GerardoSteven (Steven0110)
 **/

function validateURL(str) {
  var pattern = new RegExp(/^(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,}))\.?)(?::\d{2,5})?(?:[/?#]\S*)?$/i);
  return pattern.test( str );
}
function validatePhone(str) {
  return str.length == 10;
}
function validateRFC(str){
  var pattern = /^([A-ZÑ&]{3,4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/;
  return pattern.test( str );
}
function validateEmail(str){
  var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return pattern.test( str );
}
function checkEmptyness(elem){
  elem = $(elem.currentTarget);
  var val = elem.val();
  if( val == "" ){
    switchInputStatus( elem, false, "El campo está vacío");
  }else{
    switchInputStatus( elem, true, null );
  }
}
/**
 *  Revisa el estatus del input y lo cambia visualmente dependiend de si está o no vacío
 *
 *  @param event
 *  @return void
 **/
function checkInputEmptyness( event ){
  var input = event.currentTarget === undefined ? event : $(event.currentTarget);
  return switchInput( 
      input, 
      $(input.siblings(".an-input-group-addon").find("i")), 
      !(isEmpty(input.val())), 
      "El campo está vacío"
    );
}
function checkInputURL( event ){
  var input = event.currentTarget === undefined ? event : $(event.currentTarget);
  return switchInput( 
      input,
      $(input.siblings(".an-input-group-addon").find("i")), 
      validateURL( input.val() ), 
      "No es una URL válida"
    );  
}
function checkInputPhone( event ){
  var input = event.currentTarget === undefined ? event : $(event.currentTarget);
  return switchInput( 
      input,
      $(input.siblings(".an-input-group-addon").find("i")), 
      validatePhone( input.val() ), 
      "El teléfono debe ser de 10 dígitos"
    );  
}
function checkInputEmail( event ){
  var input = event.currentTarget === undefined ? event : $(event.currentTarget);
  return switchInput( 
      input,
      $(input.siblings(".an-input-group-addon").find("i")), 
      validateEmail( input.val() ), 
      "El email no es válido"
    );  
}
function switchInput( input, icon, status, message ){
  if( status === false ){
    icon.removeClass("ion-ios-checkmark-outline")
    icon.addClass("ion-close")
    input.attr("data-original-title", message);
    input.attr("title", message);
    input.removeClass("ok");
    input.addClass("danger");
    input.tooltip("show");
    return false;
  }else{
    icon.removeClass("ion-close")
    icon.addClass("ion-ios-checkmark-outline")
    input.attr("data-original-title", "");
    input.attr("title", "");
    input.removeClass("danger");
    input.addClass("ok");
    input.tooltip("hide");
    return true;
  }
}
function formatCurrency( n ){
  return "$" + n.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
function sliceNumber( n, k ){
  n = Number( n ).toString();
  if( Number.isInteger( Number( n ) ) )
    if( n.indexOf(".") == -1 )
      n = n + ".00";
    else
      n = n + "00";
  else
    n = n + "00";
  return n.toString().slice( 0, (n.indexOf(".")) + (k+1) );
}

function checkEmptynessAll(){
  var status = 0;
  var elems = $(".not-null");
  for( var i = 0 ; i < elems.length ; i++ ){
    var val = $(elems[ i ]).val();
    if( val == "" ){
      switchInputStatus( $(elems[ i ]), false, "El campo está vacío");
      status--;
    }else{
      switchInputStatus( $(elems[ i ]), true, null );
    }
  }
  return status == 0;
}
function upperCaseSet(elem){
  $(elem.currentTarget).val($(elem.currentTarget).val().toUpperCase());
}
function isEmpty(str){
  if( str.length == 0){
    return true;
  }else{
    for( var i = 0 ; i < str.length ; i++ ){
      if(str.charAt( i ) != " " )
        return false;
    }
  }
  return true;
}