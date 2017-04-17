// Filename: views/welcome
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var test_purchasedView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click #update_price" : "actionLoadingDemo",
                "change #expiry" : "actionChangeExpiry",
                "change #type_theo" : "actionChangeTheoType",
                "change #ordertype" : "actionChangeOrder",
                "change #methodtype" : "actionChangeMethodType",
                "click #validate_purchase" : "actionValidatePurchase",
                "click #reload_result" : "actionReloadResult",
                "click #refresh_theoretical" : "actionLoadTheoretical",
                "click #checkdailyremove" : "actionCheckDailyRemove"
			     
            },
            actionCheckDailyRemove: function(event){
                $.ajax({
                      type: "POST",
                      data: {},
                      url: $base_url + "test_purchased/checkdailyremove",
                      async: false,
                      success: function(response) {
                          rs =  JSON.parse(response);
                          alert('done');
                      }
                 });	 
            },
            actionReloadResult: function(event){
                $.ajax({
                      type: "POST",
                      data: {},
                      url: $base_url + "test_purchased/loadresult",
                      async: false,
                      success: function(response) {
                          rs =  JSON.parse(response);
                          $('#table_order_futures_limit tbody').html(rs.tbody_html_table_ofl);
                          $('#table_excution_traded tbody').html(rs.tbody_html_table_ext);
                         // alert('done');
                      }
                 });	 
            },
            actionChangeExpiry: function(event){
                 var $this = $(event.currentTarget);
                 $('#price_val').val('');
                 $('#theo_val').addClass('spinner');
                 $('#dividend').addClass('spinner');
                 $('#r_val').addClass('spinner');
                 $.ajax({
                      type: "POST",
                      data: {expiry: $this.val(), type_theo: $('#type_theo').val()},
                      url: $base_url + "test_purchased/loadform",
                      async: false,
                      success: function(response) {
                          rs =  JSON.parse(response);
                          $('#theo_val').val(rs.theo);
                          $('#dividend').val(rs.q);
                          $('#theo_val').removeClass('spinner');
                          $('#dividend').removeClass('spinner');
                          $('#r_val').removeClass('spinner');
                          $('#r_val').val(rs.form_theo[0].r);
                      }
                 });	 
            },
           	actionChangeTheoType:  function(event){
           	   var $this = $(event.currentTarget);
               $('#price_val').val('');
               $('#theo_val').addClass('spinner');
               $('#dividend').addClass('spinner');
               $.ajax({
                      type: "POST",
                      data: {type_theo: $this.val(), expiry: $('#expiry').val()},
                      url: $base_url + "test_purchased/loadform",
                      async: false,
                      success: function(response) {
                          rs =  JSON.parse(response);
                          $('#theo_val').val(rs.theo);
                          $('#dividend').val(rs.q);
                          $('#theo_val').removeClass('spinner');
                          $('#dividend').removeClass('spinner');
                          //$('#r_val').val(rs.form_theo[0].r);
                      }
                 }); 
            },
            actionValidatePurchase: function(event){
               // console.log('1111111111111111111');
				var $this = $(event.currentTarget);
                var price = $('#price_val').val();
                var decimal = (filterFloat(price.replace(',',''))).toString().split('.');
                var ints = 10;
                if (typeof decimal[1] != 'undefined') {
                   ints = decimal[1];
                }
                $("#loading").show();
                function IsNumeric(num) {
                    return (num >0 || num <0);
                }
                function filterFloat (value) {
                  if(/^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/.test(value))
                    return Number(value);
                  return NaN;
                }
                
				if ($('#quantiy_val').val()=='' || IsNumeric($('#quantiy_val').val()) == false)
				{
				 //   $('#price_val').parents('.form-group').removeClass('has-error');
				    //$('#quantiy_val').parents().find('.form-group').addClass('has-error');
					$("#message_danger_alert").text($('#error_quantity').val());
			   		$("#message_danger_alert").fadeIn();
                    $("#loading").hide();
					return;
				}
                else if($('#ordertype').val() == 'Limit order'){
				     if($('#price_val').val()=='' || IsNumeric(price.replace(',','')) == false || ints.length > 1){
    				    $('#price_val').parents('.form-group').addClass('has-error');
    					$("#message_danger_alert").text($('#error_price').val());
    			   		$("#message_danger_alert").fadeIn();
                        $("#loading").hide();
    					return;
    				}
                     $.ajax({
                        url: $base_url + "dashboard/insert_d",
                        type: "POST",
                        data: $('form#test_purchased').serialize(),
                        async: false,
                        success: function(response) {
                            if(response == 'true'){
                                $('#price_val').parents('.form-group').removeClass('has-error');
        						$("#message_danger_alert").fadeOut();
            				    $("#message_success_alert").text($('#order_success').val());
            				    $("#message_success_alert").fadeIn().delay(1500).fadeOut();
                                //$this.fadeOut();
                                $('#reload_result').removeClass('hidden');
                                $("#loading").hide();
                            }    
                        }
                    }); 
                }
				else {
				     $.ajax({
                        url: $base_url + "dashboard/insert_d",
                        type: "POST",
                        data: $('form#test_purchased').serialize(),
                        async: false,
                        success: function(response) {
                            if(response == 'true'){
                                $('#price_val').parents('.form-group').removeClass('has-error');
        						$("#message_danger_alert").fadeOut();
            				    $("#message_success_alert").text($('#order_success').val());
            				    $("#message_success_alert").fadeIn().delay(1500).fadeOut();
                                //$this.fadeOut();
                                $('#reload_result').removeClass('hidden');
                                $("#loading").hide();
                            }    
                        }
                    }); 	
				} 				  
			},
            actionLoadTheoretical:function(event){
                $('#theo_val').addClass('spinner');
                $('#price_val').val('');
                $.ajax({
                    url: $base_url + "test_purchased/loadform",
                    type: "POST",
                    data: $('form#test_purchased').serialize(),
                    async: false,
                    success: function(response) {
						rs =  JSON.parse(response);
                        $('#theo_val').val(rs.theo);
                        //$('#dividend').val(rs.q);
                        $('#theo_val').removeClass('spinner');
                        //$('#dividend').removeClass('spinner');
                    }
                });     
            },
            actionLoadingDemo: function(event){
              var $this = $(event.currentTarget);
              $('#price_val').addClass('spinner');
              $('#price_val').parents('.form-group').addClass('has-success');
              $("#price_val").val($("#theo_val").val());	
              setTimeout(function () {
              $('#price_val').removeClass('spinner');
               $('#price_val').parents('.form-group').removeClass('has-success');		  	
              }, 500)
            },
            actionChangeMethodType: function(event){
				  var $this = $(event.currentTarget);
                  console.log($this.val());
                  if($this.val() == 'Good to date'){
                      //  type = $('#type_modal_radio input:radio').val();
                      $('#calendar_p').val('');
                      $('#calendar_p').parents('.form-group').fadeIn(); 
                  }
                  else{
                    // console.log(now());
                    //  $('#calendar_p').val(now());
                      $('#calendar_p').parents('.form-group').fadeOut();
                  }	 
			},
            actionChangeOrder: function(event){
				  var $this = $(event.currentTarget);
                  if($this.val() == 'Market order'){
                       // type = $('#type_modal_radio span.checked').val();
                 //       var radioValue =  $("input [name=optionsRadios]").find("button.active").prop('value');
                        $('#price_val').parents('.form-group').fadeOut();
                      //  console.log(radioValue);
                        
                  }else{
                        $('#calendar_p').parents('.form-group').fadeOut();
                        $('#price_val').val('');
                        $('#price_val').parents('.form-group').fadeIn();
                  }
                  $.ajax({
                      type: "POST",
                      data: {ordertype: $this.val()},
                      url: $base_url + "dashboard/loadingMethodFromOrderType",
                      async: false,
                      success: function(response) {
                          rs =  JSON.parse(response);
                          $('#methodtype').html(rs);
                      }
                  });	 
			},
            index: function(){
			    $(document).ready(function(){
			         $('#price_val').val('');
    			     $(".input-percent").TouchSpin({
                            buttondown_class: 'btn blue',
                            buttonup_class: 'btn blue',
                            min: 0,
                            max: 100,
                            step: 0.1,
                            boostat: 5,
                            maxboostedstep: 10,
                            decimals: 1,
                            postfix: '%',
                    });
			        $(".input-quantity").TouchSpin({
                            buttondown_class: 'btn blue',
                            buttonup_class: 'btn blue',
                            min: 0,
                            max: 10000000,
                            step: 1,
                            boostat: 5,
                            maxboostedstep: 10,
                    });
                    $(".input-dividend").TouchSpin({
                    		buttondown_class: 'btn blue',
                    		buttonup_class: 'btn blue',
                    		min: 0,
                    		step: 1,
                    		boostat: 5,
                    		maxboostedstep: 10,
                    		prefix: '<span id="dividen_prefix">pt</span>',
                    		postfix: '<span id="dividen_postfix">%</span>'
                    });
                    if($("#type_theo").val()==3) {
                     	$("#dividen_prefix").text("pt");
                    	$("#dividen_postfix").text("");
                    	$('#group_dividend').find('span#dividen_postfix').parent().addClass('hide');
                     }
                     else 
                     {
                    	$("#dividen_prefix").parent().addClass('hide');
                    	$("#dividen_postfix").text("%");
                    	
                     }
                     $("#type_theo").change(function(){    
                    	 if($("#type_theo").val()==3) {
                    		$("#dividen_prefix").text("pt");
                    		$("#dividen_postfix").text("");
                            $('#group_dividend').find('span#dividen_postfix').parent().addClass('hide');
                            $('#group_dividend').find('span#dividen_prefix').parent().removeClass('hide');
                    	 }
                    	 else 
                    	 {
                    		$("#dividen_prefix").text("");
                            $('#group_dividend').find('span#dividen_postfix').parent().removeClass('hide');
                            $('#group_dividend').find('span#dividen_prefix').parent().addClass('hide');
                    		$("#dividen_postfix").text("%");
                    		
                    	 }
                    });
                    $(".numeric").numeric(); 
                    
                });
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return test_purchasedView = new test_purchasedView;
});
