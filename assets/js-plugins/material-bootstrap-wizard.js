/*!

 =========================================================
 * Material Bootstrap Wizard - v1.0.2
 =========================================================
 
 * Product Page: https://www.creative-tim.com/product/material-bootstrap-wizard
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/material-bootstrap-wizard/blob/master/LICENSE.md)
 
 =========================================================
 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 */


/*Custom variables*/
var company_name, company_prefix, company_domain, company_url_logo, sap_host, sap_user, sap_dbname, sap_psw,
    mysql_dbname, mysql_host, mysql_user, mysql_psw;
/*End of Custom variables*/


// Material Bootstrap Wizard Functions

var searchVisible = 0;
var transparent = true;
var mobile_device = false;

$(document).ready(function(){

    /* Custom code */

    $("#urllogo").on("focusout", loadImage);
    $("#lure").on("click", function(){$("#urllogo").focusout();});
    $("#testSAP").on("click", testSAPConnection);
    $("#testMySQL").on("click", testMySQLConnection);
    $("#download-btn").on("click", downloadSQL);
    $("#int").on("click", showInt );
    $("#ext").on("click", showExt );
    $("#create").on("click", createCompany );
    /* End of custom code */

    $.material.init();

    /*  Activate the tooltips      */
    $('[rel="tooltip"]').tooltip();

    // Code for the Validator
    var $validator = $('.wizard-card form').validate({
		  rules: {
		    name: {
		      required: true,
		      minlength: 3
		    },
		    domain: {
		      required: true,
		      minlength: 3
		    },
            urllogo: {
              required: true,
              minlength: 3,
            },
            host: {
              required: true,
              minlength: 3,
            },
            user: {
              required: true,
              minlength: 1,
            },
            dbname: {
              required: true,
              minlength: 3,
            },
		    psw: {
		      required: true,
		      minlength: 3,
		    }
        },

        errorPlacement: function(error, element) {
            $(element).parent('div').addClass('has-error');
         }
	});

    // Wizard Initialization
  	$('.wizard-card').bootstrapWizard({
        'tabClass': 'nav nav-pills',
        'nextSelector': '.btn-next',
        'previousSelector': '.btn-previous',

        onNext: function(tab, navigation, index) {
            switch( index ){
                case 1:
                    company_name = $("#name").val();
                    company_domain = $("#domain").val();
                    company_url_logo = $("#urllogo").val();
                    company_prefix = getPrefix( company_name );
                    break;
                case 2:
                    sap_dbname = $("#dbname").val();
                    sap_host = $("#host").val();
                    sap_user = $("#user").val();
                    sap_psw = $("#psw").val();
                    break;
                case 3:
                    if( $("#int-radio").prop("outerHTML").indexOf("checked") < 0 ){
                        mysql_dbname = $("#mysql_dbname").val();
                        mysql_host = $("#mysql_host").val();
                        mysql_user = $("#mysql_user").val();
                        mysql_psw = $("#mysql_psw").val();
                    }else{
                        mysql_dbname = "-1";
                        mysql_host = "-1";
                        mysql_user = "-1";
                        mysql_psw = "-1";
                    }
                    previewInfo();
                    break;
            }
        	var $valid = $('.wizard-card form').valid();
        	if(!$valid) {
        		$validator.focusInvalid();
        		return false;
        	}
        },

        onInit : function(tab, navigation, index){
            //check number of tabs and fill the entire row
            var $total = navigation.find('li').length;
            var $wizard = navigation.closest('.wizard-card');

            $first_li = navigation.find('li:first-child a').html();
            $moving_div = $('<div class="moving-tab">' + $first_li + '</div>');
            $('.wizard-card .wizard-navigation').append($moving_div);

            refreshAnimation($wizard, index);

            $('.moving-tab').css('transition','transform 0s');
       },

        onTabClick : function(tab, navigation, index){
            return false;
        },

        onTabShow: function(tab, navigation, index) {
            var $total = navigation.find('li').length;
            var $current = index+1;

            var $wizard = navigation.closest('.wizard-card');

            // If it's the last tab then hide the last button and show the finish instead
            if($current >= $total) {
                $($wizard).find('.btn-next').hide();
                $($wizard).find('.btn-finish').show();
            } else {
                $($wizard).find('.btn-next').show();
                $($wizard).find('.btn-finish').hide();
            }

            button_text = navigation.find('li:nth-child(' + $current + ') a').html();

            setTimeout(function(){
                $('.moving-tab').text(button_text);
            }, 150);

            var checkbox = $('.footer-checkbox');

            if( !index == 0 ){
                $(checkbox).css({
                    'opacity':'0',
                    'visibility':'hidden',
                    'position':'absolute'
                });
            } else {
                $(checkbox).css({
                    'opacity':'1',
                    'visibility':'visible'
                });
            }

            refreshAnimation($wizard, index);
        }
  	});


    // Prepare the preview for profile picture
    $("#wizard-picture").change(function(){
        readURL(this);
    });

    $('[data-toggle="wizard-radio"]').click(function(){
        wizard = $(this).closest('.wizard-card');
        wizard.find('[data-toggle="wizard-radio"]').removeClass('active');
        $(this).addClass('active');
        $(wizard).find('[type="radio"]').removeAttr('checked');
        $(this).find('[type="radio"]').attr('checked','true');
    });

    $('[data-toggle="wizard-checkbox"]').click(function(){
        if( $(this).hasClass('active')){
            $(this).removeClass('active');
            $(this).find('[type="checkbox"]').removeAttr('checked');
        } else {
            $(this).addClass('active');
            $(this).find('[type="checkbox"]').attr('checked','true');
        }
    });

    $('.set-full-height').css('height', 'auto');

});



 //Function to show image before upload

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$(window).resize(function(){
    $('.wizard-card').each(function(){
        $wizard = $(this);

        index = $wizard.bootstrapWizard('currentIndex');
        refreshAnimation($wizard, index);

        $('.moving-tab').css({
            'transition': 'transform 0s'
        });
    });
});

function refreshAnimation($wizard, index){
    $total = $wizard.find('.nav li').length;
    $li_width = 100/$total;

    total_steps = $wizard.find('.nav li').length;
    move_distance = $wizard.width() / total_steps;
    index_temp = index;
    vertical_level = 0;

    mobile_device = $(document).width() < 600 && $total > 3;

    if(mobile_device){
        move_distance = $wizard.width() / 2;
        index_temp = index % 2;
        $li_width = 50;
    }

    $wizard.find('.nav li').css('width',$li_width + '%');

    step_width = move_distance;
    move_distance = move_distance * index_temp;

    $current = index + 1;

    if($current == 1 || (mobile_device == true && (index % 2 == 0) )){
        move_distance -= 8;
    } else if($current == total_steps || (mobile_device == true && (index % 2 == 1))){
        move_distance += 8;
    }

    if(mobile_device){
        vertical_level = parseInt(index / 2);
        vertical_level = vertical_level * 38;
    }

    $wizard.find('.moving-tab').css('width', step_width);
    $('.moving-tab').css({
        'transform':'translate3d(' + move_distance + 'px, ' + vertical_level +  'px, 0)',
        'transition': 'all 0.5s cubic-bezier(0.29, 1.42, 0.79, 1)'

    });
}

materialDesign = {

    checkScrollForTransparentNavbar: debounce(function() {
                if($(document).scrollTop() > 260 ) {
                    if(transparent) {
                        transparent = false;
                        $('.navbar-color-on-scroll').removeClass('navbar-transparent');
                    }
                } else {
                    if( !transparent ) {
                        transparent = true;
                        $('.navbar-color-on-scroll').addClass('navbar-transparent');
                    }
                }
        }, 17)

}

function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this, args = arguments;
		clearTimeout(timeout);
		timeout = setTimeout(function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		}, wait);
		if (immediate && !timeout) func.apply(context, args);
	};
};

/* Custom functions */
function loadImage(){

    $("#wizardPicturePreview").attr("src", load_img_route);
    var url = $("#urllogo").val();
    var image = new Image();
    image.onload = function (e) {
        $("#nextBtn").removeAttr("disabled");
        $("#wizardPicturePreview").attr("src", $(e.target).attr("src"));
    }
    image.onerror = function (e) {
        $("#nextBtn").attr("disabled", "disabled");
        $("#wizardPicturePreview").attr("src", no_img_route);
    }
    image.src = url;
}
function testSAPConnection(){
    $("#nextBtn").attr("disabled", "disabled");
    $("#testSAP").val("Probando conexión...");
    $("#testSAP").attr("disabled", "disabled");
    $("#test-loader").slideDown("slow");
    $("#no-connection-message").slideUp("slow");
    $("#testSAP").removeClass("btn-success").removeClass("btn-theme").addClass("btn-theme");

    setTimeout(function() {
        $("#test-loader").slideUp();
        $("#testSAP").val("Probar conexión");
        $("#testSAP").removeAttr("disabled");
        
        // Simulate successful connection
        var response = { status: true };
        
        if(response.status) {
            $("#testSAP").val("Conexión exitosa!");
            $("#nextBtn").removeAttr("disabled");
            $("#no-connection-message").slideUp("slow");
            $("#testSAP").addClass("btn-success").removeClass("btn-theme");
        } else {
            $("#nextBtn").attr("disabled", "disabled");
            $("#no-connection-message").slideDown("slow");
        }
    }, 2000);
}
function testMySQLConnection(){
    $("#nextBtn").attr("disabled", "disabled");
    $("#testMySQL").val("Probando conexión...");
    $("#testMySQL").attr("disabled", "disabled");
    $("#mysql-loader").slideDown("slow");
    $("#no-connection-message-2").slideUp("slow");
    $("#testMySQL").removeClass("btn-success").removeClass("btn-theme").addClass("btn-theme");

    $.ajax({
        method : "GET",
        url : test_mysql_route,
        data : {
            "host" : $("#mysql_host").val(),
            "user" : $("#mysql_user").val(),
            "psw" : $("#mysql_psw").val(),
            "dbname" : $("#mysql_dbname").val()
        },
        success : function( response ){
            $("#mysql-loader").slideUp();
            $("#testMySQL").val("Probar conexión");
            $("#testMySQL").removeAttr("disabled");
            if( response.status ){
                $("#testMySQL").val("Conexión exitosa!");
                $("#nextBtn").removeAttr("disabled");
                $("#no-connection-message-2").slideUp("slow");
                $("#testMySQL").addClass("btn-success").removeClass("btn-theme");
                $("#download-btn-div").slideDown();

                mysql_dbname = $("#mysql_dbname").val();
                mysql_host = $("#mysql_host").val();
                mysql_user = $("#mysql_user").val();
                mysql_psw = $("#mysql_psw").val();  
            }
            else{
                $("#nextBtn").attr("disabled", "disabled");
                $("#no-connection-message-2").slideDown("slow");
            }
        }
    });
}
function downloadSQL(){
    $("#mysql-loader").slideDown("slow");
    $.ajax({
        method : "GET",
        data : {
            "prefix" : company_prefix,
            "dbname" : mysql_dbname
        },
        url : sql_route,
        success : function( response ){
            $("#mysql-loader").slideUp();
            $("#sql-anchor").attr("href", "data:text/plain;charset=utf-8," + encodeURIComponent(response));
            $("#sql-anchor").attr("download", "estructura.sql");
            $("#sql-anchor")[0].click();
        }
    });
}
function showInt(){
    $("#ext-content").slideUp();
}
function showExt(){
    $("#ext-content").slideDown();

}
function getPrefix(name){
        
    if(name.indexOf(" ") < 0 ){ //No tiene espacio
        return name.toLowerCase();
    }else{ //Tiene espacio
        var aux = name.split(" ");
        return aux[ 0 ].toLowerCase();
    }
}
function previewInfo(){
    if( $("#int-radio").prop("outerHTML").indexOf("checked") < 0 ){
        $("#tipo").text("Externa");
        $("#mysql_prev_title").show();
        $("#mysql_prev").show();
    }else{
        $("#tipo").text("Interna");
        $("#mysql_prev").hide();
        $("#mysql_prev_title").hide();
    }
    $("#name_prev").val(company_name);
    $("#domain_prev").val(company_domain);
    $("#urllogo_prev").val(company_url_logo);
    $("#logo_prev").attr("src", company_url_logo);

    $("#sap_host_prev").val(sap_host);
    $("#sap_user_prev").val(sap_user);
    $("#sap_dbname_prev").val(sap_dbname);
    $("#sap_psw_prev").val(sap_psw);

    $("#mysql_host_prev").val(mysql_host);
    $("#mysql_user_prev").val(mysql_user);
    $("#mysql_dbname_prev").val(mysql_dbname);
    $("#mysql_psw_prev").val(mysql_psw);
}
function randomString( n ){
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var str = "";
    for( var i = 0 ; i < n ; i++ )
        str += possible.charAt(Math.floor(Math.random() * possible.length));
    return str;
}
function createCompany(){
    $("#final_loader").slideDown();
    $("#create").slideUp();
    
    setTimeout(function() {
        // Simulate successful response
        var response = {
            status: true,
            request: "Company creation simulated"
        };
        
        console.log(response.request);
        if(response.status) {
            $("#final_loader").slideUp();
            $("#create").slideDown();
            swal({
                title: "OK",
                text: "Empresa creada correctamente",
                type: "success"
            }, function(){
                location.href = "superadmin.html";
            });
        } else {
            // Handle error case if needed
            $("#final_loader").slideUp();
            $("#create").slideDown();
        }
    }, 2000);
}
/* End of custom functions */