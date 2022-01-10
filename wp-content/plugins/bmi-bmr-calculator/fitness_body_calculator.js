jQuery(document).ready(function($) {
//////////////new code D 7/01/2020//////////////////
//$('#slider').on('input change',function(){alert("Yes");
//     $('#textbox').val($(this).val());
// });
//
// $('#textbox').keyup(function(e){alert("yes");
//   if (e.keyCode==13) {   //only activates after pressing Enter key
//       var val = $(this).val().replace(/\D/g,'');   // check only for digits
//       $('#slider').val(val);
//   }
// });
 
    ///////////////////
	
	$("#bmibmrCalc").submit(function(e)
    {
        e.preventDefault(); 
        /***************Validating email format*************/
        var useremail = $("#useremail").val();
	    if(isValidEmailAddress(useremail) ){ 
	    /*******Email validate using Zerobounce plugins **/
	    	 var emId = jQuery("#useremail").attr("value");
	    	 if(emId!=''){
	    		 jQuery.ajax({
	    			 url:  window.location.origin+"/EmailValidation.php",
	    			 type: "get",
	    			 dataType: 'json',
	    			 data: {email: emId},
	    			 async: false,
	    			 success:function(result){ 
	    			/***********calculating BMI ****************/
				    	if (result == 1) {
				    		$('.input-error').hide();
				    		$('.input-error').hide();
				    	    var formData = $("#bmibmrCalc").serializeArray();
				    	    var URL = $("#bmibmrCalc").attr("action");
				    	     $.post(URL,formData,
				    	             function(data, textStatus, jqXHR)
				    	             {
				    	                 calculateDivMetric(data);
				    	                 bmicalculationinsert(data);
				    	             }).fail(function(jqXHR, textStatus, errorThrown)
				    	          {
				    	    }); 
				    	} else {
				    		jQuery('.input-error').show();
				    		return 0;
				    	}
	    			 }
	    		 });
	    	 }
         }else{
        	 $('.input-error').show();
	     }
      
    });

    ///////////////////
    function calculateDivMetric(outData) {
    	
    	
        var parsData = jQuery.parseJSON(outData);
        formdataSave = outData;
        if (parsData.uVal == 'kg') {
            var bmiindex = parsData.weight / ((parsData.height / 100) * (parsData.height / 100));
        }
        else {
            var bmiindex = parsData.weight / ((parsData.height) * (parsData.height)) * 703;
        }

        if (parsData.height && parsData.weight) {
            $('#bmibmrRes').html('<div class="output">\
            		<div class="row">\
	            		<div class="col-md-1">\
	        			</div>\
            			<div class="col-md-1">\
            				<img class="output_img_bmi" src="/wp-content/themes/twentytwenty/assets/images/cardiogram.svg">\
            			</div>\
            			<div class="col-md-8">\
            				<h2 class="bmi-h2">Healthy Weight (BMI 18.5 to 24.9)</h2>\
            			</div>\
            			<div class="col-md-2">\
            			</div>\
            		</div>\
            		<div class="row your_bmi">\
            			<div class="col-md-12 hbmi">\
            				<img class="human_bmi" src="/wp-content/themes/twentytwenty/assets/images/standing-human-body-silhouette.svg">\
            			    <h3 class="bmi-h3">Your BMI:<strong>' + bmiindex.toFixed(2) + '</strong></h3>\
            			    <img class="grren_bmi" src="/wp-content/themes/twentytwenty/assets/images/green_bmi.png">\
            			</div>\
            		</div>\
            		<div class="bar">\
            			 <div class="row">\
	            			<div class="col-md-3 border-right_bmi">\
	            			    <article>Under Weight</article>\
	            			    <p>18.5</p>\
	            			</div>\
	            			<div class="col-md-3 border-right_bmi">\
		            			<article>Healthy</article>\
		        			    <p>18.5 - 24.9</p>\
	            			</div>\
	            			<div class="col-md-3 border-right_bmi">\
		            			<article>Overweight</article>\
		        			    <p>25 - 29.99</p>\
	            			</div>\
	            			<div class="col-md-3 border-left_bmi">\
		            			<article>Obese</article>\
		        			    <p>>30</p>\
	            			</div>\
            			  </div>\
            		</div>\
            	    <div class="range">\
            			    <p>Your suggested healthy weight range 53.5 - 72kg</p>\
            	    </div>\
            	    <div class="bmi_button">\
            		 <div class="row">\
            			 <div class="col-md-9">\
            			    <p>For more ways to take control of your BMI, order our product</p>\
            			  </div>\
            			  <div class="col-md-3">\
            			    <button type="button"> Order Now</button>\
            		</div>\
            </div>');
            //$('#bmibmrRes').append('<br>Note:<br> '+parsData.descriptionB);

            $('#bmibmrRes').append('<div id="data-panel" >\
		</div>');

           // $('#bmiloggedin').html('<hr> Because you are logged in, you can <strong><a id="saveBData" href="#">Save data</a></strong> and retrieve it anytime by logging in!');
            //$('.nemailaddressotauser').html('<h4 style="color:#FF5C00;">Logged in users can save data for later reference!</h4>');



            if ($('#bmrCheck').val()) {
                var calcFront = $("#bmibmrCalc").serializeArray();
                var URL = $("#calcFront").attr("data-calcFront");
                $.post(URL,
                        calcFront,
                        function(data, textStatus, jqXHR)
                        {
                            //bmibmrRes
                            $("#bmibmrRes").prepend(data);
                        }).fail(function(jqXHR, textStatus, errorThrown)
                {
                });
            }
            ;


        }
        else {
            $('#bmibmrRes').html('<h3 style="color:red;">Enter ALL data</h3>');
            $('#bmiloggedin').empty();
        }
    }

    $('.calcValues').on("change", "#uVal", function() {
        var element = $(this).find('option:selected');
        var byTag = element.attr("data-matchV");
        $('#mVal option[data-matchV="' + byTag + '"]').attr('selected', 'selected');
    });
    $('.calcValues').on("change", "#mVal", function() {
        //$("#uVal").val($(this).val());
        var element = $(this).find('option:selected');
        var byTag = element.attr("data-matchV");
        $('#uVal option[data-matchV="' + byTag + '"]').attr('selected', 'selected');
    });

    ///////////////////
    $('.calcValues').on("click", "#bfatguide_btn", function(ev) {
        ev.preventDefault();
        $(".bfatguide").slideDown();
    });

    ///////////////////
    $('.calcValues').on("click", "#f_close", function(ev) {
        ev.preventDefault();
        ev.stopPropagation;
        $(".bfatguide").slideUp();

    });

    ///////////////////

    $('#bmi').click(function(eve) {
        eve.preventDefault();
        var datapanel = $("#data-panel");
        $(datapanel).hide();
        var formPath = $(this).attr("data-formPath");
        $(datapanel).load(formPath);
        $(datapanel).fadeIn("fast");
    });
    $('#bmr').click(function(eve) {
        eve.preventDefault();
        var datapanel = $("#data-panel");
        $(datapanel).hide();
        var formPath = $(this).attr("data-formPath");
        $(datapanel).load(formPath);
        $(datapanel).fadeIn("fast");
    });


    $('#clients').click(function(eve) {
        eve.preventDefault();

        var URL = $(this).attr("data-formPath");
        $.post(URL,
            function(data, textStatus, jqXHR)
            {
                $("#clientlist").empty();
                var userData =  $.parseJSON(data);

                $("#clientlist").append("<ul>");
                $.each(userData, function(){
                    $("#clientlist").append("<li class='clientitem' data-userid='"+this.ID+"' ><strong>" + this.user_login +"</strong>, <i>"+this.user_email+"</i></li>");
                });
                $("#clientlist").append("</ul>");
                $("#clientlistbtn").click();

            }).fail(function(jqXHR, textStatus, errorThrown)
            {
            });
    });

    $(document).on("click", '.clientitem', function() {


        var pluginURL  = $("#hiddenppath").attr("data-Path");
        //console.log(pluginURL);

        var clientID = $(this).attr("data-userid");
        //console.log(clientID);


        $.ajax({
            url: pluginURL+"/bmi-bmr-calculator/includes/client.php",
            data: {
                'clientid': clientID
            },
            success: function(data) {
                console.log(data);

                var datapanel = $("#data-panel");
                $(datapanel).empty();
                $(datapanel).hide();
                $(datapanel).html(data);
                $(datapanel).fadeIn("fast");

                //hide modal
                $('#myModal').modal('hide');
                getSavedData(clientID);


            },
            error: function(errorThrown) {
                //console.log(errorThrown);
            }
        });


    });



//////////////////////////////////
    function bmibmr_save() {
        var holdData = jQuery.parseJSON(formdataSave);
        console.log(holdData);
        $.ajax({
            url: ajaxurl,
            data: {
                'action': 'bmibmr_save',
                'holdData': holdData
            },
            success: function(data) {
                location.reload(true);
            },
            error: function(errorThrown) {
                //console.log(errorThrown);
            }
        });
    }

///////////////////////////////
    $(document).on("click", "#saveBData", function(ev) {
        ev.preventDefault();
        bmibmr_save();
    });
    
//////////////////////////////
    $('.btn-group').button();



    $('body').on("click", "#uVal1", function(ev) {
        $("#weight").html("pounds (lbs)");
        $("#height").html("inches (in)");
    });

    $('body').on("click", "#uVal2", function(ev) {
        $("#weight").html("Height (kg)");
        $("#height").html("Weight (cm)");
    });


    //get saved data
    function getSavedData(clientid) {

        var pluginURL  = $("#hiddenppath").attr("data-Path");

        if (clientid === undefined) {
            var clientID = '';
        }
        else {
            var clientID = clientid;
        }

        console.log(clientID);


        $.ajax({
            url: pluginURL+"/bmi-bmr-calculator/bmibmr_saved.php",
            data: {
                'clientid': clientID
            },
            success: function(data) {
                $("#savedDataBmiBmr").html(data);

            },
            error: function(errorThrown) {
                //console.log(errorThrown);
            }
        });
    }

    var hiddenUserID  = $("#hiddenuserid").attr("data-userid");

    getSavedData(hiddenUserID);
    
    $('#bmi').click();

});

function only_numbers(event){
	if (event.which != 8 && event.which != 0 && (event.which < 48 || event.which > 57)) {
		return false;
	}
	
}
   
function isValidEmailAddress(useremail) {
    var pattern =  /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return pattern.test(useremail);
}
function setrange(event){
	var val = jQuery('#textbox').val().replace(/\D/g,'');   // check only for digits
    jQuery('#slider').val(val);
}
function myFunction(event){
	var val = jQuery('#slider').val().replace(/\D/g,'');   // check only for digits
    jQuery('#textbox').val(val);
}
function setrangeuser(event){
	var val = jQuery('#textboxuser').val().replace(/\D/g,'');   // check only for digits
    jQuery('#slideruser').val(val);
}
function myFunctionuser(event){
	var val = jQuery('#slideruser').val().replace(/\D/g,'');   // check only for digits
    jQuery('#textboxuser').val(val);
}
function check_email_val(){//alert("test");

 return ;
    }
function bmicalculationinsert(data){
	var table = jQuery("#bmi_calculator").attr("value");
	var parsData = jQuery.parseJSON(data);
    if (parsData.uVal == 'kg') {
        var bmiindex = parsData.weight / ((parsData.height / 100) * (parsData.height / 100));
     }
    else {
        var bmiindex = parsData.weight / ((parsData.height) * (parsData.height)) * 703;
     }
	   jQuery.ajax({
		  url: window.location.origin+"/bmiinsert.php",
		      type: "post",
	          dataType: 'json',
	          data: {user_details: data,bmi_result:bmiindex.toFixed(2)}
       });
}

