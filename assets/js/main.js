// Register Users Code
$("#contact_forms").validate({
    ignore: ":hidden",
    rules: {
        name: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        phone_no: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
        email: {
            required: true,
            email: true,
        },
        message: {
            minlength: 6,
            required: true,
        },
        Confirm_Password: {
            minlength: 6,
            equalTo: "#PASSWORD",
            required: true,
        },

    },
    messages: {
        name: {
            required: "<span>Please enter your Full Name</span>",
            minlength: "<span>Your Full Name must consist of at least 5 characters</span>",
            maxlength: "<span>The maximum number of characters - 3</span>",
        },
        phone_no: {
            required: "<span>Please enter your Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
        email: {
            required: "<span>Please enter your email address</span>",
            email: "<span>Please enter a valid email address.</span>",
        },
        message: {
            required: "<span>Please enter your message</span>",
            minlength: "<span>Your message must consist of at least 6 characters</span>",
        },
       

    },
    });

// Delivery Order Place Validation

$("#delivery_address_form").validate({
    ignore: ":hidden",
    rules: {
        address: {
            required: true,
        
        },
    },
    messages: {
        address: {
            required: "<span>Please select delivery address</span>",
        },
     },
      submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + 'place_delivery_orders',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#submit_delivery_address').addClass('Submiting').attr("disabled", true);
                $('#submit_delivery_address').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#alert-address-error').show();
                   $('#alert-address-error').html(obj.message);
                   
                     $('#submit_delivery_address').prop('disabled', false);
                     $('#submit_delivery_address').html('Place Delivery Order');
                     $('#submit_delivery_address').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#alert-address-error').hide(); }, 5000);
                    return false;
                } else {
                    $('#alert-address-success').show();
                    $('#alert-address-success').html(obj.message);
                    setTimeout(function(){ $('#alert-address-success').hide();
                    window.location='transaction-history';
                    }, 5000);
                    return false;
                }
            }
        });
    }
    });

$("#registerform").validate({
    ignore: ":hidden",
    rules: {
        FULLNAME: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        MOBILE: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
        EMAIL: {
            required: true,
            email: true,
        },
        PASSWORD: {
            minlength: 6,
            required: true,
        },
        Confirm_Password: {
            minlength: 6,
            equalTo: "#PASSWORD",
            required: true,
        },

    },
    messages: {
        FULLNAME: {
            required: "<span>Please enter your Full Name</span>",
            minlength: "<span>Your Full Name must consist of at least 5 characters</span>",
            maxlength: "<span>The maximum number of characters - 3</span>",
        },
        MOBILE: {
            required: "<span>Please enter your Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
        EMAIL: {
            required: "<span>Please enter your email address</span>",
            email: "<span>Please enter a valid email address.</span>",
        },
        PASSWORD: {
            required: "<span>Please enter your password</span>",
            minlength: "<span>Your password must consist of at least 6 characters</span>",
        },
        Confirm_Password: {
            required: "<span> Enter Confirm Password Same as Password</span>",
            minlength: "<span>Your password must consist of at least 6 characters</span>",
            equalTo: "Please enter the same password as above",
        }

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/users_registration',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#submt_register').addClass('sanding').attr("disabled", true);
                $('#submt_register').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message').show();
                   $('#error_message').html(obj.message);
                   
                     $('#submt_register').prop('disabled', false);
                     $('#submt_register').html('Register');
                     $('#submt_register').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message').hide(); }, 5000);
                    return false;
                } else {
                    $('#success_message').show();
                    $('#success_message').html(obj.message);
                     $("#registration_id").hide();
                    setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    $("#verify_otp_div").show();
                    return false;

                }
            }
        });
    }
});

// Verify Email Users

$("#verify_form").validate({
    ignore: ":hidden",
    rules: {
      
        OTP: {
            required: true,
            minlength: 6,
            maxlength: 6,
            number: true,
        },
    },
    messages: {
        OTP: {
            required: "<span>Please enter otp </span>",
            minlength: "<span>Please enter 6 digit otp</span>",
            maxlength: "<span>Please enter 6 digit otp</span>",
            number: "<span>Please enter only numeric values</span>",
        }

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/verify_otp_password',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#submit_opt').addClass('sanding').attr("disabled", true);
                $('#submit_opt').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message').show();
                     $('#error_message').html(obj.message);
                     setTimeout(function(){ $('#error_message').hide(); }, 5000);                    
                     $('#submit_opt').prop('disabled', false);
                     $('#submit_opt').html('Submit OTP');
                     $('#submit_opt').addClass('sanding').attr("disabled", false);
                    return false;
                } else {
                   window.location='login';
                    return false;

                }
            }
        });
    }
});




$("#login_form").validate({
    ignore: ":hidden",
    rules: {
      
        MOBILE: {
            required: true,
        },
        PASSWORD: {
            required: true,
        },
    },
    messages: {
        MOBILE: {
            required: "<span>Please Enter Mobile Number Or Email ID </span>",
        },
        PASSWORD: {
            required: "<span>Please Enter Password </span>",
        }

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/login_users',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#login_submit').addClass('sanding').attr("disabled", true);
                $('#login_submit').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message').show();
                     $('#error_message').html(obj.message);
                     setTimeout(function(){ $('#error_message').hide(); }, 5000);                    
                     $('#login_submit').prop('disabled', false);
                     $('#login_submit').html('Login');
                     $('#login_submit').addClass('sanding').attr("disabled", false);
                    return false;
                } else {
                    $("#success_message").show();
                   $('#success_message').html(obj.message);
                   setTimeout(function(){ $('#success_message').hide(); }, 5000);    
                   window.location=BASE_URL;
                    return false;

                }
            }
        });
    }
});


// Forgot Password

$("#forgot_password_form").validate({
    ignore: ":hidden",
    rules: {
      
        EMAIL: {
            required: true,
            email: true
        },
    },
    messages: {
        EMAIL: {
            required: "<span>Please Enter Email Address</span>",
            email: "<span>Please Enter Valid Email Address </span>",
        },
  
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/reset_password_users',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#forgot_button').addClass('sanding').attr("disabled", true);
                $('#forgot_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message_forgot').show();
                     $('#error_message_forgot').html(obj.message);
                     setTimeout(function(){ $('#error_message_forgot').hide(); }, 5000);                    
                     $('#forgot_button').prop('disabled', false);
                     $('#forgot_button').html('Submit');
                     $('#forgot_button').addClass('sanding').attr("disabled", false);
                    return false;
                } else {
                    $("#success_message_forgot").show();
                   $('#success_message_forgot').html(obj.message);
                   setTimeout(function(){ $('#success_message_forgot').hide(); }, 5000);    
                   window.location='login';
                    return false;

                }
            }
        });
    }
});


// Reset Password

$("#reset_password").validate({
    ignore: ":hidden",
    rules: {
        PASSWORD: {
            minlength: 6,
            required: true,
        },
        Confirm_Password: {
            minlength: 6,
            equalTo: "#PASSWORD",
            required: true,
        },

    },
    messages: {
        PASSWORD: {
            required: "<span>Please enter your password</span>",
            minlength: "<span>Your password must consist of at least 6 characters</span>",
        },
        CONFIRM_PASSWORD: {
            required: "<span> Enter Confirm Password Same as Password</span>",
            minlength: "<span>Your password must consist of at least 6 characters</span>",
            equalTo: "Please enter the same password as above",
        }

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/reset_password',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#reset_passwor_button').addClass('sanding').attr("disabled", true);
                $('#reset_passwor_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $('#error_message').show();
                     $('#error_message').html(obj.message);
                     $('#reset_passwor_button').prop('disabled', false);
                     $('#reset_passwor_button').html('Reset Password');
                     $('#reset_passwor_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message').hide(); }, 5000);
                    return false;
                } else {
                    $('#success_message').show();
                    $('#success_message').html(obj.message);
                    setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='login';
                    return false;

                }
            }
        });
    }
});

function getequivalentto_Buy(type) {
    var Buy_weight_Gold = $('#Buy_weight_Gold').val();
    var Buy_Total_INR = $('#Buy_Total_INR').val();
     
        $.ajax({
	  url: BASE_URL+"/get_live_rate_buy_calculator",
           type: "POST",
	   data: {Buy_weight_Gold:Buy_weight_Gold,Buy_Total_INR:Buy_Total_INR,type: type},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
            //    $('#amountRs_buy').val('');
             //   $('#amountGm_buy').val('');
                $("#error_buy_calculator").html(obj.message);
                  }else{
                   if(obj.Type=='BASE'){
                   $('#Buy_weight_Gold').val(obj.Gold_Amount);
                   $('#Buy_Total_INR').val(obj.Total_INR);    
                   $("#error_buy_calculator").html(" ");
                }else if(obj.Type=='GOLD'){
                 // $('#Buy_weight_Gold').val(obj.Gold_Amount);
                  $('#Buy_Total_INR').val(obj.Total_INR);    
                  $("#error_buy_calculator").html(" ");   
              }else if(obj.Type=='INR'){
                 // alert();
                  $('#Buy_weight_Gold').val(obj.Gold_Amount);
                 // $('#Buy_Total_INR').val(obj.Total_INR);    
                  $("#error_buy_calculator").html(" ");   
              }
             }
	    }
        });
      }
      
function getequivalentto_Sell(type) {
    var Buy_weight_Gold = $('#Sell_weight_Gold').val();
    var Buy_Total_INR = $('#Sell_Total_INR').val();
     
        $.ajax({
	  url: BASE_URL+"/get_live_rate_sell_calculator",
           type: "POST",
	   data: {Buy_weight_Gold:Buy_weight_Gold,Buy_Total_INR:Buy_Total_INR,type: type},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
            //    $('#amountRs_buy').val('');
             //   $('#amountGm_buy').val('');
                $("#error_INR_calculator_sell").html(obj.message);
                  }else{
                   if(obj.Type=='BASE'){
                   $('#Sell_weight_Gold').val(obj.Gold_Amount);
                   $('#Sell_Total_INR').val(obj.Total_INR);    
                   $("#error_INR_calculator_sell").html(" ");
                }else if(obj.Type=='GOLD'){
                 // $('#Buy_weight_Gold').val(obj.Gold_Amount);
                  $('#Sell_Total_INR').val(obj.Total_INR);    
                  $("#error_INR_calculator_sell").html(" ");   
              }else if(obj.Type=='INR'){
                 // alert();
                  $('#Sell_weight_Gold').val(obj.Gold_Amount);
                 // $('#Buy_Total_INR').val(obj.Total_INR);    
                  $("#error_INR_calculator_sell").html(" ");   
              }
             }
	    }
        });
      }
      
      
      
      
      function getequivalentto_Buy_Limit(type) {
    var Base_buy_Amount = $('#Base_buy_Amount').val();
    var Buy_weight_Gold = $('#Buy_weight_Gold').val();
    var Buy_Total_INR = $('#Buy_Total_INR').val();
     
        $.ajax({
	  url: BASE_URL+"/limit_get_live_rate_buy_calculator",
           type: "POST",
	   data: {Base_buy_Amount:Base_buy_Amount, Buy_weight_Gold:Buy_weight_Gold,Buy_Total_INR:Buy_Total_INR,type: type},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
            //    $('#amountRs_buy').val('');
             //   $('#amountGm_buy').val('');
                $("#error_buy_calculator").html(obj.message);
                  }else{
                   if(obj.Type=='BASE'){
                   $('#Buy_weight_Gold').val(obj.Gold_Amount);
                   $('#Buy_Total_INR').val(obj.Total_INR);    
                   $("#error_buy_calculator").html(" ");
                }else if(obj.Type=='GOLD'){
                 // $('#Buy_weight_Gold').val(obj.Gold_Amount);
                  $('#Buy_Total_INR').val(obj.Total_INR);    
                  $("#error_buy_calculator").html(" ");   
              }else if(obj.Type=='INR'){
                 // alert();
                  $('#Buy_weight_Gold').val(obj.Gold_Amount);
                 // $('#Buy_Total_INR').val(obj.Total_INR);    
                  $("#error_buy_calculator").html(" ");   
              }
             }
	    }
        });
      }
      
function getequivalentto_Sell_Limit(type) {
    var Base_buy_Amount = $('#Base_sell_Amount').val();
    var Buy_weight_Gold = $('#Sell_weight_Gold').val();
    var Buy_Total_INR = $('#Sell_Total_INR').val();
     
        $.ajax({
	  url: BASE_URL+"/limit_get_live_rate_sell_calculator",
           type: "POST",
	   data: {Base_buy_Amount:Base_buy_Amount, Buy_weight_Gold:Buy_weight_Gold,Buy_Total_INR:Buy_Total_INR,type: type},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
            //    $('#amountRs_buy').val('');
             //   $('#amountGm_buy').val('');
                $("#error_INR_calculator_sell").html(obj.message);
                  }else{
                   if(obj.Type=='BASE'){
                   $('#Sell_weight_Gold').val(obj.Gold_Amount);
                   $('#Sell_Total_INR').val(obj.Total_INR);    
                   $("#error_INR_calculator_sell").html(" ");
                }else if(obj.Type=='GOLD'){
                 // $('#Buy_weight_Gold').val(obj.Gold_Amount);
                  $('#Sell_Total_INR').val(obj.Total_INR);    
                  $("#error_INR_calculator_sell").html(" ");   
              }else if(obj.Type=='INR'){
                 // alert();
                  $('#Sell_weight_Gold').val(obj.Gold_Amount);
                 // $('#Buy_Total_INR').val(obj.Total_INR);    
                  $("#error_INR_calculator_sell").html(" ");   
              }
             }
	    }
        });
      }
      
  
/*function getequivalentto_sell(type) {
    var amountRs_buy = $('#amountRs_sell').val();
    var amountGm_buy = $('#amountGm_sell').val();
        $.ajax({
	  url: BASE_URL+"/get_live_rate_buy_calculator",
           type: "POST",
	   data: {amountRs_buy:amountRs_buy, amountGm_sell:amountGm_buy,type: type},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
                $('#amountRs_sell').val('');
                $('#amountGm_sell').val('');
                $("#error_sell_calculator").html(obj.message);
                  }else{
                   $('#amountRs_sell').val(obj.AmountRs);
                   $('#amountGm_sell').val(obj.AmountGold);    
                   $("#error_sell_calculator").html(" ");
                  }
	    }
        });
      }*/
      
      
  function getequivalentto_delivery(type) {
    var amountRs_buy = $('#amountRs_Delivery').val();
    var amountGm_buy = $('#amountGm_Delivery').val();
        $.ajax({
	  url: BASE_URL+"/get_live_rate_buy_calculator",
           type: "POST",
	   data: {amountRs_buy:amountRs_buy, amountGm_sell:amountGm_buy,type: type},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
                $('#amountRs_Delivery').val('');
                $('#amountGm_Delivery').val('');
                $("#error_Delivery_calculator").html(obj.message);
                  }else{
                   $('#amountRs_Delivery').val(obj.AmountRs);
                   $('#amountGm_Delivery').val(obj.AmountGold);    
                   $("#error_Delivery_calculator").html(" ");
                  }
	    }
        });
      }
      
$(document).ready(function(){
 $("#buy_anchor").click(function(){
  $("#buy").show();  
  $("#sell").hide(); 
  $("#delivery").hide();
 }) 
 $("#sell_anchor").click(function(){
  $("#buy").hide();  
  $("#sell").show(); 
  $("#delivery").hide();
 }) 
 $("#delivery_anchor").click(function(){
  $("#buy").hide();  
  $("#sell").hide(); 
  $("#delivery").show();
 }) 
})

// Add address details


$("#add_address_details").validate({
    ignore: ":hidden",
    rules: {
        NAME: {
            required: true,
            minlength: 3,
            maxlength: 30,
        },
        MOBILE: {
            required: true,
            minlength: 10,
            maxlength: 10,
            number: true,
        },
        PINCODE: {
            required: true,
            minlength: 6,
            maxlength: 6,
            number: true,
        },
        ADDRESS: {
            minlength:3,
            required: true,
            maxlength: 200,
        },
         state: {
            required: true,
        },
         city: {
            required: true,
        },
    
    },
    messages: {
        NAME: {
            required: "<span>Please enter your Name</span>",
            minlength: "<span>Your Name must consist of at least 3 characters</span>",
            maxlength: "<span>The maximum number of characters - 30</span>",
        },
        MOBILE: {
            required: "<span>Please enter your Mobile Number</span>",
            minlength: "<span>Your Mobile Number must be 10 digit</span>",
            maxlength: "<span>Your Mobile Number must be 10 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
        PINCODE: {
            required: "<span>Please enter your pincode</span>",
            minlength: "<span>Please enter 6 digit pincode</span>",
            maxlength: "<span>Please enter pincode only 6 digit</span>",
            number: "<span>Please entered only digit</span>",
        },
        ADDRESS: {
            required: "<span>Please enter your address</span>",
            minlength: "<span>Your address must consist of at least 3 characters</span>",
            maxlength: "<span>Please enter address upto 200 character only</span>",
        },
        state: {
            required: "<span>Please select your state</span>",
        },
         city: {
            required: "<span>Please select your city</span>",
        }

    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/add_new_addresses',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#submit_address').addClass('sanding').attr("disabled", true);
                $('#submit_address').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                   $('#error_message').show();
                   $('#error_message').html(obj.message);
                   
                     $('#submit_address').prop('disabled', false);
                     $('#submit_address').html('Submit Address');
                     $('#submit_address').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_message').hide(); }, 5000);
                    return false;
                } else {
                    $('#success_message').show();
                    $('#success_message').html(obj.message);
                    setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='addresses-details';
                    return false;

                }
            }
        });
    }
});
// Delete address

function deleteAddress(id){
    con=confirm("Are you sure delete this address");
    if(con==true){
      $.ajax({
	  url: BASE_URL+"/deleted_addresses",
           type: "POST",
	   data: {id:id},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
               alert(obj.message);
                  }else{
                 window.location='addresses-details';
                 return false;
                  }
	    }
        });     
    }else{
      return false;
    }
}


// Withdraw INR

$("#witdraw_inr_forms").validate({
    ignore: ":hidden",
    rules: {
        AMOUNT: {
            required:true,
            min:1000,
            number: true,
        },
       
    },
    messages: {
        AMOUNT: {
            required: "<span>Please enter withdraw amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            min: "<span>Minimum 1000 INR Witdraw</span>",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/withdraw_inr_amount',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#widthdraw_submit_button_inr').addClass('sanding').attr("disabled", true);
                $('#widthdraw_submit_button_inr').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#error_withdraw_calculator").show();
                     $('#error_withdraw_calculator').html(obj.message);
                     $('#widthdraw_submit_button_inr').prop('disabled', false);
                     $('#widthdraw_submit_button_inr').html('Withdraw INR');
                     $('#widthdraw_submit_button_inr').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_withdraw_calculator').hide(); }, 5000);
                    return false;
                } else {
                    window.location='deposit-and-withdraw';
                    return false;

                }
            }
        });
    }
});

$("#deposit_inr_forms").validate({
    ignore: ":hidden",
    rules: {
        amountRs_buy: {
            required:true,
            min:1000,
            number: true,
        },
       
    },
    messages: {
        amountRs_buy: {
            required: "<span>Please enter deposit amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            min: "<span>Minimum 1000 INR Deposit</span>",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/purchase_gold',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#INR_submit_button').addClass('sanding').attr("disabled", true);
                $('#INR_submit_button').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#error_INR_calculator").show();
                     $('#error_INR_calculator').html(obj.message);
                     $('#INR_submit_button').prop('disabled', false);
                     $('#INR_submit_button').html('Deposit INR');
                     $('#INR_submit_button').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_INR_calculator').hide(); }, 5000);
                    return false;
                } else {
                    //$('#success_message').show();
                    //$('#success_message').html(obj.message);
                   // setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='buy-glod';
                    return false;

                }
            }
        });
    }
});

$(document).ready(function(){
$('.number').keypress(function(event) {
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
    event.preventDefault();
  }
});

});

// Sell Trade

$("#buy_glod_trade").validate({
    ignore: ":hidden",
    rules: {
        Buy_Total_INR: {
            required:true,
            min:1,
            number: true,
        },
       Buy_weight_Gold: {
            required:true,
            number: true,
        }
    },
    messages: {
        Buy_Total_INR: {
            required: "<span>Please enter buy amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            min: "<span>Minimum order 1 INR</span>",
        },
       Buy_weight_Gold: {
            required: "<span>Please enter gold balance</span>",
            number: "<span>Please enter value in numeric format</span>",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/buy_trade_post',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#buy_submit_form_gold').addClass('sanding').attr("disabled", true);
                $('#buy_submit_form_gold').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#error_INR_calculator_buy").show();
                     $('#error_INR_calculator_buy').html(obj.message);
                     $('#buy_submit_form_gold').prop('disabled', false);
                     $('#buy_submit_form_gold').html('Buy Now');
                     $('#buy_submit_form_gold').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_INR_calculator_buy').hide(); }, 5000);
                    return false;
                } else {
                     //$('#success_message').show();
                    //$('#success_message').html(obj.message);
                   //setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='transaction-history';
                    return false;

                }
            }
        });
    }
});


   // Sell Amount
   
  $("#sell_glod_trade").validate({
    ignore: ":hidden",
    rules: {
        Sell_Total_INR: {
            required:true,
            min:1,
            number: true,
        },

       Sell_weight_Gold: {
            required:true,
            number: true,
        }
    },
    messages: {
        Sell_Total_INR: {
            required: "<span>Please enter sell amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            min: "<span>Minimum order 1 INR</span>",
        },
       Sell_weight_Gold: {
            required: "<span>Please enter gold balance</span>",
            number: "<span>Please enter value in numeric format</span>",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/sell_trade_post',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#sell_submit_form_gold').addClass('sanding').attr("disabled", true);
                $('#sell_submit_form_gold').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#error_INR_calculator_sell").show();
                     $('#error_INR_calculator_sell').html(obj.message);
                     $('#sell_submit_form_gold').prop('disabled', false);
                     $('#sell_submit_form_gold').html('Sell Now');
                     $('#sell_submit_form_gold').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_INR_calculator_sell').hide(); }, 5000);
                    return false;
                } else {
                     //$('#success_message').show();
                    //$('#success_message').html(obj.message);
                   //setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='transaction-history';
                    return false;

                }
            }
        });
    }
});




$("#buy_glod_trade_limit").validate({
    ignore: ":hidden",
    rules: {
        Buy_Total_INR: {
            required:true,
            min:1,
            number: true,
        },
       Buy_weight_Gold: {
            required:true,
            number: true,
        },
     Base_buy_Amount:{
          required:true,
          number: true,
     }
    },
    messages: {
        Buy_Total_INR: {
            required: "<span>Please enter buy amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            min: "<span>Minimum order 1 INR</span>",
        },
       Buy_weight_Gold: {
            required: "<span>Please enter gold balance</span>",
            number: "<span>Please enter value in numeric format</span>",
        },
      Base_buy_Amount: {
            required: "<span>Please enter limit price</span>",
            number: "<span>Please enter value in numeric format</span>",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/buy_trade_post_limit',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#buy_submit_form_gold').addClass('sanding').attr("disabled", true);
                $('#buy_submit_form_gold').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#error_INR_calculator_buy").show();
                     $('#error_INR_calculator_buy').html(obj.message);
                     $('#buy_submit_form_gold').prop('disabled', false);
                     $('#buy_submit_form_gold').html('Buy Place Order');
                     $('#buy_submit_form_gold').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_INR_calculator_buy').hide(); }, 5000);
                    return false;
                } else {
                     //$('#success_message').show();
                    //$('#success_message').html(obj.message);
                   //setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='transaction-history';
                    return false;

                }
            }
        });
    }
});


   // Sell Amount
   
  $("#sell_glod_trade_limit").validate({
    ignore: ":hidden",
    rules: {
        Sell_Total_INR: {
            required:true,
            min:1,
            number: true,
        },

       Sell_weight_Gold: {
            required:true,
            number: true,
        },
      Base_sell_Amount:{
            required:true,
            number: true, 
      }
    },
    messages: {
        Base_sell_Amount: {
            required: "<span>Please enter limit price</span>",
            number: "<span>Please enter value in numeric format</span>",
        },
        Sell_Total_INR: {
            required: "<span>Please enter sell amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            min: "<span>Minimum order 1 INR</span>",
        },
       Sell_weight_Gold: {
            required: "<span>Please enter gold balance</span>",
            number: "<span>Please enter value in numeric format</span>",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/sell_trade_post_limit',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#sell_submit_form_gold').addClass('sanding').attr("disabled", true);
                $('#sell_submit_form_gold').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#error_INR_calculator_sell").show();
                     $('#error_INR_calculator_sell').html(obj.message);
                     $('#sell_submit_form_gold').prop('disabled', false);
                     $('#sell_submit_form_gold').html('Sell Place Order');
                     $('#sell_submit_form_gold').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_INR_calculator_sell').hide(); }, 5000);
                    return false;
                } else {
                     //$('#success_message').show();
                    //$('#success_message').html(obj.message);
                   //setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='transaction-history';
                    return false;

                }
            }
        });
    }
});



function cancel_trades_buy(id){
  var con=confirm('are sure to cancel this trade');  
     if(con==true){
           $.ajax({
	  url: BASE_URL+"/cancel_buy_orders",
           type: "POST",
	   data: {id:id},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
             alert(obj.message);
             return false;
                }else{   
                 window.location='transaction-history';
                }
	    }
        });
     }else{
         return false;
     }
}

function cancel_trades_sell(id){
  var con=confirm('are sure to cancel this trade');  
     if(con==true){
           $.ajax({
	  url: BASE_URL+"/cancel_sell_orders",
           type: "POST",
	   data: {id:id},
	   success: function(data) {
              obj = JSON.parse(data);
             if (obj.code == 400){
             alert(obj.message);
             return false;
                }else{   
                 window.location='transaction-history';
                }
	    }
        });
     }else{
         return false;
     }
}

 $(document).ready(function() {
                function loadData() {
                    $('#without_refresh_get').load(BASE_URL+'get_gram_rates_fetch_ajax', function() {
                       if (window.reloadData != 0)
                           window.clearTimeout(window.reloadData);
                       window.reloadData = window.setTimeout(loadData,10000)
                   }).fadeIn(3000); 
                }
             window.reloadData = 0; // store timer load data on page load, which sets timeout to reload again
               loadData();	
});

$("#deposit_inr_forms_NFT").validate({
    ignore: ":hidden",
    rules: {
        AMOUNT_NFT: {
            required:true,
            min:100,
            number: true,
        },
         TRANACTION_ID_NFT: {
            required:true,
           alphanumeric: true
        },
         CRATED_DATE_NFT: {
            required:true,
        },
        
       
    },
    messages: {
        AMOUNT_NFT: {
            required: "<span>Please enter  amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            min: "<span>Minimum 100 INR Deposit</span>",
        }, 
        TRANACTION_ID_NFT: {
            required: "<span>Please enter  transaction id</span>",
            alphanumeric:"Letters, numbers, and underscores only allow",
        }, 
        CRATED_DATE_NFT: {
            required: "<span>Please select date</span>",
        }
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/nft_inr_amount_deposit',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#INR_submit_button_NFT').addClass('sanding').attr("disabled", true);
                $('#INR_submit_button_NFT').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#error_INR_calculator_NFT").show();
                     $('#error_INR_calculator_NFT').html(obj.message);
                     $('#INR_submit_button_NFT').prop('disabled', false);
                     $('#INR_submit_button_NFT').html('Deposit INR');
                     $('#INR_submit_button_NFT').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#error_INR_calculator_NFT').hide(); }, 5000);
                    return false;
                } else {
                    //$('#success_message').show();
                    //$('#success_message').html(obj.message);
                   // setTimeout(function(){ $('#success_message').hide(); }, 5000);
                    window.location='deposit-and-withdraw';
                    return false;

                }
            }
        });
    }
});




$("#fixed_deposit_inr_forms").validate({
    ignore: ":hidden",
    rules: {
        gold_amount_fixed: {
            required:true,
            number: true,
        },
         fixed_deposit_duration: {
            required:true,
           alphanumeric: true
        }, 
    },
    messages: {
        gold_amount_fixed: {
            required: "<span>Please enter gold  amount</span>",
            number: "<span>Please enter value in numeric format</span>",
            }, 
        fixed_deposit_duration: {
            required: "<span>Please select fixed deposit duration</span>",
        }, 
    },
    submitHandler: function (form) {
        $.ajax({
            type: "POST",
            url: BASE_URL + '/fixed_deposit_gold_investement',
            data: $(form).serialize(),
            beforeSend: function () {
                $('#submit_fixed_deposit').addClass('sanding').attr("disabled", true);
                $('#submit_fixed_deposit').html('<i class="fa fa-refresh fa-pulse fa-fw"></i><span>Submiting...</span>');
            },
            success: function (data) {
                obj = JSON.parse(data);
                if (obj.code == 400) {
                     $("#fixed_deposit_error").show();
                     $('#fixed_deposit_error').html(obj.message);
                     $('#submit_fixed_deposit').prop('disabled', false);
                     $('#submit_fixed_deposit').html('Submit Fixed Deposit');
                     $('#submit_fixed_deposit').addClass('sanding').attr("disabled", false);
                     setTimeout(function(){ $('#fixed_deposit_error').hide(); }, 10000);
                    return false;
                } else {
                    $('#fixed_deposit_success').show();
                    $('#fixed_deposit_success').html(obj.message);
                    setTimeout(function(){ $('#fixed_deposit_success').hide(); }, 5000);
                    window.location='gold-fixed-deposit';
                    return false;

                }
            }
        });
    }
});
