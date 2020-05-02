 jQuery(function() {
	  var startdate;
	  var enddate;
	  var mindate;
	  var numberofmonths;
	  startdate = "+1d";
	  enddate = "+2d";
	  mindate = 0;
	  numberofmonths = 1;


	  if(jQuery(window).width() <= 600){
		  numberofmonths = 1;
	  } 
	jQuery( "#sistem-checkin" ).datepicker({
      defaultDate: startdate,
      changeMonth: true,
	  changeYear: true,
	  minDate: mindate,
	  showCurrentAtPos: 0,
      numberOfMonths: numberofmonths,
	  dateFormat: "dd.mm.yy",
      onClose: function( selectedDate ) {
        jQuery( "#sistem-checkout" ).datepicker( "option", "minDate", selectedDate )
		window.setTimeout(function(){
	    	jQuery( "#sistem-checkout" ).focus();
	    }, 0);
      }
    });
    jQuery( "#sistem-checkout" ).datepicker({
      defaultDate: enddate,
      changeMonth: true,
	  changeYear: true,
	  minDate: mindate,
	  showCurrentAtPos: 0,
      numberOfMonths: numberofmonths,
	  dateFormat: "dd.mm.yy",
      onClose: function( selectedDate ) {
        jQuery( "#sistem-checkin" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });


 function IstbookingSearch(){
     event.preventDefault();
     Date.gunfark= function(s1,s2) {
         var t=s1.split(/\D+/);
         var z=s2.split(/\D+/);
         var d1=new Date(t[2]*1, t[1]-1, t[0]*1);
         var d2=new Date(z[2]*1, z[1]-1, z[0]*1);
         var birgun= 24 * 60 *60 * 1000;
         var f= Math.floor((d1-d2) / birgun ) ;
         return f;

     }

     var tarih1 = document.getElementById("sistem-checkout").value;
     var tarih2 = document.getElementById("sistem-checkin").value;
	 var __calendar=document.getElementById('sistem-checkin').value;
     var __ng=Date.gunfark(tarih1, tarih2);
     var __ro=document.getElementById('sistem-room').value;
     var __ad=document.getElementById('sistem-people').value;
     var __url=document.getElementById('sistem-url').value;
     __url=__url + "?sr=1";
     __url= __url + "&ng=";
     __url= __url + __ng;
     __url= __url + "&ro=";
     __url= __url + __ro;
     __url= __url + "&ad=";
     __url= __url + __ad;
     __url= __url + "&ci=";
     __url= __url + __calendar;
     window.open(__url);
 }