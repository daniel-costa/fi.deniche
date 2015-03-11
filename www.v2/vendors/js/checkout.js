			function ajaxSubmitForm(){

			    event.preventDefault();

			    $("#second_nav").html('');

			    var values = $("#shipping-form").serialize();
			    $.ajax({
			        url: "payment.php",
			        type: "post",
			        data: values,
			        success: function(html){
			            //alert("success");
			            $("#second_nav").html(html);

			            //styling the Payment div
			            $(".payment-content").css("display", "block").css( "width","100%").css( "margin","5px");

			            $(".payment-details").css("float", "center").css( "width","50%");
			            $(".payment-details h1 .shipping-details h1").css("margin-left", "50px").css( "font-size","18px");
			            $(".payment-details table").css("border-bottom", "1px solid #848484").css( "border-spacing","7px 7px").css( "width","100%").css("border-collapse", "separate");
			            $(".payment-details table tr #row-img img").css("width", "40px").css("height","40px").css("margin-left","10px");
			            $(".payment-details table .row-head th").css("background-color", "#D8D8D8").css("text-align", "center").css("font-family", "Avenir Next, Helvetica Neue, Helvetica, sans-serif");
			            $(".payment-details table tr td").css("word-wrap", "break-word");
			            $(".payment-total").css("float", "right").css("display", "block").css("text-align", "center").css("width","50%").css( "font-size","15px").css( "margin","5px 0 5px 15px");
			            $(".payment-form").css("float", "right").css("display", "block").css("text-align", "center").css("width","50%").css( "margin","5px 0 5px 0");
			            $(".paytrail-banner img").css("width","100%").css("margin", "10px 5px 10px 5px");
			            $(".payment-details table .row-items td").css("text-align", "center");

			            /*$(".shipping-details").css("float", "left").css( "width","50%");
			            $(".shipping-details table").css("border", "1px solid #848484").css( "border-spacing","7px 15px").css( "max-width","400px").css( "width","100% !important").css("border-collapse", "separate");
			            $(".shipping-details table tr").css("margin", "1 px solid red").css( "width","100%");
			            $(".shipping-details table tr td").css("word-wrap", "break-word");*/


			            $("#second_nav").css("display", "inline");
			            $("#first_nav").css("display", "none");
						$("#third_nav").css("display", "none");

			        },
			        error:function(){
			            $("#second_nav").html('There is error while submit');
			        }
			    });
   			}

   			function paymentSuccess(){
   				event.preventDefault();

			    $("#third_nav").html('');
			    var values = 

   			}

			function validateForm() {

				var all_fields = document.getElementById('first_name', 'last_name', 'address1', 'city', 'zip', 'email','phone');
				var firstname = document.getElementById('first_name');
				var lastname = document.getElementById('last_name');
				var address = document.getElementById('address1');
				var city = document.getElementById('city');
				var zip = document.getElementById('zip');
				var email = document.getElementById('email');
				var phone = document.getElementById('phone');
				if (all_fields.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details.")
							.show();
					return false;
				} else if (firstname.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details. First name is missing.")
							.show();
					return false;
				} else if (lastname.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details. Last name is missing.")
							.show();
					return false;
				} else if (address.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details. Address is missing.")
							.show();
					return false;
				} else if (city.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details. City is missing.")
							.show();
					return false;
				} else if (zip.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details. Zip code is missing.")
							.show();
					return false;
				} else if (email.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details. Email is missing.")
							.show();
					return false;
				}else if (phone.value.length === 0) {
					$(".error_message").css("display", "inline-block");
					$(".error_message").html("1. Please fill in your shipping details. Phone number is missing.")
							.show();
					return false;
				}else {
					$(".error_message").css("display", "none");
					ajaxSubmitForm(); 
				}
			}