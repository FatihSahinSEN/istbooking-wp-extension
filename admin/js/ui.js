jQuery(function() {
   var $ = jQuery;
    $('#siyah').click(function () {
        $("#tester").css({ "background-color":"#000"});
        $("#tester h1").css({ "color":"#FFF"});
    });

    $('#beyaz').click(function () {
        $("#tester").css({ "background-color":"#FFFFFF"});
        $("#tester h1").css({ "color":"#000"});
    });
    $('#mobil-siyah').click(function () {
        var img ='url("../wp-content/plugins/istbooking/admin/images/iphone6_front_gold.png") no-repeat';
        $("#mobil-theme").css({ "background-color":"#000"});
        $("#tester-mobile").css({ "background":img});
    });
    $('#mobil-beyaz').click(function () {
        var img ='url("../wp-content/plugins/istbooking/admin/images/iphone6_front_black.png") no-repeat';
        $("#mobil-theme").css({ "background-color":"#FFF"});
        $("#tester-mobile").css({ "background":img});
    });

    $('#beyaz').click(function () {
        $("#tester").css({ "background-color":"#FFFFFF"});
        $("#tester h1").css({ "color":"#000"});
    });

    $('#Yatay').click(function () {

        $("#IstBooking input[type=text]").prev().append("<br />");
        $("#IstBooking select").prev().append("<br />")
        $("#IstBooking .bb_control").css({"float":"left","display":"block","position":"relative","width":""});
        $("#IstBooking label").css({"position":"relative","display":"block"});
        $("#IstBooking input[type=text]").css({"position":"relative"});
        $("#IstBooking select").css({"position":"relative"});
        $("#IstBooking").css({"display":"flex","justify-content": "center","flex-direction":"row","align-items":"center"});

    });
    $('#Dikey').click(function () {
        $("#IstBooking label br").remove();
        $("#IstBooking .bb_control").css({"float":"none","display":"block","position":"relative","width":"100%","height":"40px"});
        $("#IstBooking label").css({"position":"absolute","left":"0","display":"inline-block"});
        $("#IstBooking input[type=text]").css({"position":"absolute","right":"0"});
        $("#IstBooking select").css({"position":"absolute","right":"0"});
        $("#IstBooking").css({"display":"flex","justify-content": "center","flex-direction":"column","align-items":"center"});
    });

    $('#form_width').change(function () {
        var boyut=$('#form_width').val();
        $("#SistemOtel").css({ "width": boyut});
    });
    $('#form_height').change(function () {
        var boyut=$('#form_height').val();
        $("#SistemOtel").css({ "height": boyut});
    });
    $('#button_width').change(function () {
        var boyut=$('#button_width').val();
        $("#IstBookingSubmit").css({ "width": boyut});
    });

    $('#button_height').change(function () {
        var boyut=$('#button_height').val();
        $("#IstBookingSubmit").css({ "height": boyut});
    });
    $('#select_width').change(function () {
        var boyut=$('#select_width').val();
        $("#IstBooking select").css({ "width": boyut});
    });

    $('#input_width').change(function () {
        var boyut=$('#input_width').val();
        $("#IstBooking input[type=text]").css({ "width": boyut});
    });
    $('#yazi_size').change(function () {
        var boyut=$('#yazi_size').val();
        $("#IstBooking").css({ "font-size": boyut});
    });
    $('#button_size').change(function () {
        var boyut=$('#button_size').val();
        $("#IstBookingSubmit").css({ "font-size": boyut});
    });
    $('#button_padding').change(function () {
        var boyut=$('#button_padding').val();
        $("#IstBookingSubmit").css({ "padding": boyut});
    });
    $('#button_margin').change(function () {
        var boyut=$('#button_margin').val();
        $("#IstBookingSubmit").css({ "margin": boyut});
    });
    $('#input_padding').change(function () {
        var boyut=$('#input_padding').val();
        $("#IstBooking input[type=text]").css({ "padding": boyut});
    });
    $('#input_margin').change(function () {
        var boyut=$('#input_margin').val();
        $("#IstBooking input[type=text]").css({ "margin": boyut});
    });
    $('#select_padding').change(function () {
        var boyut=$('#select_padding').val();
        $("#IstBooking select").css({ "padding": boyut});
    });
    $('#select_margin').change(function () {
        var boyut=$('#select_margin').val();
        $("#IstBooking select").css({ "margin": boyut});
    });
    $('#yazi_padding').change(function () {
        var boyut=$('#yazi_padding').val();
        $("#IstBooking label").css({ "padding": boyut});
    });
    $('#yazi_margin').change(function () {
        var boyut=$('#yazi_margin').val();
        $("#IstBooking label").css({ "margin": boyut});
    });
    $('#form_padding').change(function () {
        var boyut=$('#form_padding').val();
        $("#SistemOtel").css({ "padding": boyut});
    });
    $('#form_margin').change(function () {
        var boyut=$('#form_margin').val();
        $("#SistemOtel").css({ "margin": boyut});
    });
    $('#form_radius').change(function () {
        var boyut=$('#form_radius').val();
        $("#SistemOtel").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
    });
    $('#input_radius').change(function () {
        var boyut=$('#input_radius').val();
        $("#IstBooking input[type=text]").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
    });
    $('#select_radius').change(function () {
        var boyut=$('#select_radius').val();
        $("#IstBooking select").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
    });
    $('#button_radius').change(function () {
        var boyut=$('#button_radius').val();
        $("#IstBookingSubmit").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
    });




    $(document).ready(function () {
        var arka=$("input[name=tester]:checked").val();
        var duzen=$("input[name=duzen]:checked").val();

        $("#IstBooking label").css({"display": "inline-block"});
        if(arka=="Beyaz"){
            $("#tester").css({"background-color": "#FFF"});
            $("#tester h1").css({"color": "#000"});
        }else{
            $("#tester").css({"background-color": "#000"});
            $("#tester h1").css({"color": "#FFF"});
        }
        if(duzen=="Dikey"){

            $("#IstBooking .bb_control").css({"float":"none","display":"block","position":"relative","width":"100%","height":"40px"});
            $("#IstBooking label").css({"position":"absolute","left":"0","display":"inline-block"});
            $("#IstBooking input[type=text]").css({"position":"absolute","right":"0"});
            $("#IstBooking select").css({"position":"absolute","right":"0"});
            $("#IstBooking").css({"display":"flex","justify-content": "center","flex-direction":"column","align-items":"center"});


        }else{
            $("#IstBooking input[type=text]").prev().append("<br />");
            $("#IstBooking select").prev().append("<br />")
            $("#IstBooking .bb_control").css({"float":"left","display":"block","position":"relative","width":""});
            $("#IstBooking label").css({"position":"relative","display":"block"});
            $("#IstBooking input[type=text]").css({"position":"relative"});
            $("#IstBooking select").css({"position":"relative"});
            $("#IstBooking").css({"display":"flex","justify-content": "center","flex-direction":"row","align-items":"center"});
        }

        $("#SistemOtel").css({"box-sizing": "border-box"});
        var boyut = $('#form_width').val();
        $("#SistemOtel").css({"width": boyut});
        var boyut = $('#form_height').val();
        $("#SistemOtel").css({"height": boyut});
        var boyut = $('#button_width').val();
        $("#IstBookingSubmit").css({"width": boyut});
        var boyut = $('#button_height').val();
        $("#IstBookingSubmit").css({"height": boyut});
        var boyut = $('#select_width').val();
        $("#IstBooking select").css({"width": boyut});
        var boyut = $('#input_width').val();
        $("#IstBooking input[type=text]").css({"width": boyut});
        var boyut=$('#button_size').val();
        $("#IstBookingSubmit").css({ "font-size": boyut});
        var boyut=$('#yazi_size').val();
        $("#IstBooking").css({ "font-size": boyut});
        var boyut=$('#button_margin').val();
        $("#IstBookingSubmit").css({ "margin": boyut});
        var boyut=$('#button_padding').val();
        $("#IstBookingSubmit").css({ "padding": boyut});
        var boyut=$('#input_padding').val();
        $("#IstBooking input[type=text]").css({ "padding": boyut});
        var boyut=$('#input_margin').val();
        $("#IstBooking input[type=text]").css({ "margin": boyut});
        var boyut=$('#select_padding').val();
        $("#IstBooking select").css({ "padding": boyut});
        var boyut=$('#select_margin').val();
        $("#IstBooking select").css({ "margin": boyut});
        var boyut=$('#yazi_padding').val();
        $("#IstBooking label").css({ "padding": boyut});
        var boyut=$('#yazi_margin').val();
        $("#IstBooking label").css({ "margin": boyut});
        var boyut=$('#form_radius').val();
        $("#SistemOtel").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
        var boyut=$('#input_radius').val();
        $("#IstBooking input[type=text]").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
        var boyut=$('#select_radius').val();
        $("#IstBooking select").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
        var boyut=$('#button_radius').val();
        $("#IstBookingSubmit").css({ "-webkit-border-radius": boyut , "-moz-border-radius": boyut , "border-radius": boyut});
        var boyut=$('#form_padding').val();
        $("#SistemOtel").css({ "padding": boyut});
        var boyut=$('#form_margin').val();
        $("#SistemOtel").css({ "margin": boyut});

    });


});

function OnColorChanged(selectedColor, input) {
    var $ = jQuery;
    if (input.id == "arka_color") {
        document.getElementById("SistemOtel").style.backgroundColor = selectedColor;
    }
    if(input.id == "yazi_color") {
        $("#IstBooking ,.bb_control label").css({ "color":selectedColor});
    }
    if(input.id == "button_color") {
        $("#IstBookingSubmit").css({ "background-color":selectedColor});
    }
    if(input.id == "buttonyazi_color") {
        $("#IstBookingSubmit").css({ "color":selectedColor});
    }
    if(input.id == "border") {
        $("#SistemOtel").css({ "border":"2px solid " + selectedColor});
    }
    if(input.id == "input_arka_color") {
        $("#IstBooking input[type=text]").css({ "background-color":selectedColor});
    }
    if(input.id == "input_font_color") {
        $("#IstBooking input[type=text]").css({ "color":selectedColor});
    }
    if(input.id == "select_arka_color") {
        $("#IstBooking select").css({ "background-color":selectedColor});
    }
    if(input.id == "select_font_color") {
        $("#IstBooking select").css({ "color":selectedColor});
    }
    if(input.id == "multi_border") {
        var boyut = $("#multi_border_size").val();
        $("#IstBooking input[type=text], #IstBooking select , #IstBookingSubmit").css({ "border": boyut + " solid " + selectedColor});
    }
}