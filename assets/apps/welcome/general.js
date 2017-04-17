$(document).ready(function() {
	
	
		
		//handle for height sitemap
		var flag = $(".get_flag").attr('attr');
		var height_sitemap = flag*30;
		$(".height_sitemap").css("height",height_sitemap);
		
	    var filtersContainer = $('#js-filters-lightbox-gallery1');
	    if (filtersContainer.hasClass('cbp-l-filters-dropdown')) {
			var wrap1 = filtersContainer.find('.cbp-l-filters-dropdownWrap');	 
			wrap1.on({
				'mouseover.cbp': function() {
					wrap1.addClass('cbp-l-filters-dropdownWrap-open');
				},
				'mouseleave.cbp': function() {
					wrap1.removeClass('cbp-l-filters-dropdownWrap-open');
				}
			});
		} 
		var filtersContainer_2 = $('#js-filters-lightbox-gallery2');
	    if (filtersContainer_2.hasClass('cbp-l-filters-dropdown')) {
			var wrap = filtersContainer_2.find('.cbp-l-filters-dropdownWrap');
	 
			wrap.on({
				'mouseover.cbp': function() {
					wrap.addClass('cbp-l-filters-dropdownWrap-open');
				},
				'mouseleave.cbp': function() {
					wrap.removeClass('cbp-l-filters-dropdownWrap-open');
				}
			});
		} 
		var filtersContainer_3 = $('#js-filters-lightbox-gallery3');
	    if (filtersContainer_3.hasClass('cbp-l-filters-dropdown')) {
			var wrap3 = filtersContainer_3.find('.cbp-l-filters-dropdownWrap');
	 
			wrap3.on({
				'mouseover.cbp': function() {
					wrap3.addClass('cbp-l-filters-dropdownWrap-open');
				},
				'mouseleave.cbp': function() {
					wrap3.removeClass('cbp-l-filters-dropdownWrap-open');
				}
			});
		} 	 
	
	//
	var n = location.pathname.indexOf("start"); 
	if(n<1){
		setInterval(function(){
			var data='';
            $.ajax({
				url: $base_url + 'ajax/ims_time',
				dataType: 'json',
                 async: true,
                headers: {
                    'Cache-Control': 'no-cache, no-store, must-revalidate',
                    'Pragma': 'no-cache',
                    'Expires': '0'
                },
                 timeout: 3000,
				success: function(data) {				
					if($('#ims_start').html()!=data.ims_start){
						$('#ims_start').fadeOut('slow', function() {
							$('#ims_start').html(data.ims_start);
								$('#ims_start').fadeIn('slow');
						});
					}
					if($('#ims_end').html()!=data.ims_end){
						$('#ims_end').fadeOut('slow', function() {
							$('#ims_end').html(data.ims_end);
								$('#ims_end').fadeIn('slow');
						});
					}
					if($('#ims_fre').html()!=data.ims_fre){
						$('#ims_fre').fadeOut('slow', function() {
							$('#ims_fre').html(data.ims_fre);
								$('#ims_fre').fadeIn('slow');
						});
					}
					
				}
			});
		}, 2170);
		setInterval(function(){
			var data='';
            Promise.resolve($.ajax({
				url: $base_url + 'ajax/loadfeed',
				dataType: 'json',
                 async: true,
                headers: {
                    'Cache-Control': 'no-cache, no-store, must-revalidate',
                    'Pragma': 'no-cache',
                    'Expires': '0'
                },
                 timeout: 3000,
				success: function(data) {
					clearconsole();
					if(data.update_time==''){
						$('#feed_update_time').html('');
						$('#feed_time').html('');
						$('#feed_codeint').html('');
						$('#feed_last').html('');
						$('#feed_update_time').removeAttr("style");
						$('#feed_time').removeAttr("style");
						$('#feed_codeint').removeAttr("style");
						$('#feed_last').removeAttr("style");
						$('#link_feed').html('');
						$('.cbp1').hide();
					}
					else {
						$('.cbp1').show();
					}
					if(data.update_time!='') $('#link_feed').html('<a href="'+$base_url+'jq_loadtable/stk_feed_rt"><i class="icon-settings font-yellow-crusta"></i></a>');
					$("#feed_list").html(data.list);
					if($('#feed_update_time').html()!=data.update_time){
						$('#feed_update_time').fadeOut('slow', function() {
							$('#feed_update_time').html(data.update_time);
								$('#feed_update_time').fadeIn('slow');
						});
					}			
					if($('#feed_time').html()!=data.time){
						$('#feed_time').fadeOut('slow', function() {
							$('#feed_time').html(data.time);
								$('#feed_time').fadeIn('slow');
						});
					}
					
					
					if($('#feed_codeint').html()!=data.codeint ){
						$('#feed_codeint').fadeOut('slow', function() {
								$('#feed_codeint').html(data.codeint);
								$('#feed_codeint').fadeIn('slow');
						});
					}
					
					if($('#feed_last').html()!=data.last){					
						$('#feed_last').fadeOut('slow', function() {
								$('#feed_last').html(data.last);
								$('#feed_last').fadeIn('slow');
						});
					}
					
				}
			}));
		}, 3170);
		
		setInterval(function(){	
		var data= '';
			$.ajax({
			url: $base_url + 'ajax/loadcur',
			dataType: 'json',
			async: true,
                headers: {
                    'Cache-Control': 'no-cache, no-store, must-revalidate',
                    'Pragma': 'no-cache',
                    'Expires': '0'
                },
			timeout: 3000,
			success: function(data) {
				if(data.time==''){
					$('#cur_time').html('');
					$('#cur_code').html('');
					$('#cur_conv').html('');
					$('#cur_time').removeAttr("style");
					$('#cur_code').removeAttr("style");
					$('#cur_conv').removeAttr("style");
					$('#link_cur').html('');
					$('.cbp2').hide();
				}	
				else {
					$('.cbp2').show();
				}
				if(data.time!='') $('#link_cur').html('<a href="'+$base_url+'jq_loadtable/cur_feed_rt"><i class="icon-settings font-yellow-crusta"></i></a>');
				$("#cur_list").html(data.list);
				if($('#cur_time').html()!=data.time){
						$('#cur_time').fadeOut('slow', function() {
								$('#cur_time').html(data.time);
								$('#cur_time').fadeIn('slow');
						});
						
					}
					
					if($('#cur_code').html()!=data.code){
						$('#cur_code').fadeOut('slow', function() {
								$('#cur_code').html(data.code);
								$('#cur_code').fadeIn('slow');
						});
					}
					if($('#cur_conv').html()!=data.cunv){					
						$('#cur_conv').fadeOut('slow', function() {
								$('#cur_conv').html(data.cunv)
								$('#cur_conv').fadeIn('slow');
						});
					}
			}
		});
		}, 4170);
		setInterval(function(){
			var data='';
			 $.ajax({
				url: $base_url + 'ajax/loadspecs_abnormal',
				dataType: 'json',
				 async: true,
                 headers: {
                     'Cache-Control': 'no-cache, no-store, must-revalidate',
                     'Pragma': 'no-cache',
                     'Expires': '0'
                 },
                 timeout: 3000,
				success: function(data) {
					if(data.codeint==''){
						$('#specs_time').html('');
						$('#specs_codeint').html('');
						$('#specs_dvar').html('');
						$('#specs_time').removeAttr("style");
						$('#specs_codeint').removeAttr("style");
						$('#specs_dvar').removeAttr("style");
						$('#link_specs').html('');
						$('.cbp3').hide();
					}
					else {
						$('.cbp3').show();
					}
					if(data.time!='') $('#link_specs').html('<a href="'+$base_url+'jq_loadtable/idx_specs_abnormal"><i class="icon-settings font-yellow-crusta"></i></a>');
					$("#specs_list").html(data.list);				
					if($('#specs_time').html()!=data.time){
						$('#specs_time').fadeOut('slow', function() {
								$('#specs_time').html(data.time);
								$('#specs_time').fadeIn('slow');
						});
						
					}				
					if($('#specs_codeint').html()!=data.codeint ){
						$('#specs_codeint').fadeOut('slow', function() {
								$('#specs_codeint').html(data.codeint);
								$('#specs_codeint').fadeIn('slow');
						});
					}
					
					if($('#specs_dvar').html()!=data.idx_dvar){					
						$('#specs_dvar').fadeOut('slow', function() {
								$('#specs_dvar').html(data.idx_dvar);
								$('#specs_dvar').fadeIn('slow');
						});
					}
					
				}
			});
		}, 5170);
			
		setInterval(function(){
			var data ='';
			 $.ajax({
				url: $base_url + 'ajax/getImsStatus',
				dataType: 'json',
                 async: true,
                 headers: {
                     'Cache-Control': 'no-cache, no-store, must-revalidate',
                     'Pragma': 'no-cache',
                     'Expires': '0'
                 },
                 timeout: 3000,
				success: function(data) {
					if($('#ims_status').html()!=data.ims_staus){
						if(data.ims_staus=="CLOSED"){
							$("#class_ims_status").removeClass("blue");
							$("#class_ims_status").addClass("red");						
						}
						else {
							$("#class_ims_status").removeClass("red");
							$("#class_ims_status").addClass("blue");
						}
						$('#ims_status').fadeOut('slow', function() {
							$('#ims_status').html(data.ims_staus);
								$('#ims_status').fadeIn('slow');
						});
					}
				}
			});
		}, 6170);
	}
    createTicker();
	$("input.date-picker")
	.datepicker({
    dateFormat: 'yy-mm-dd'
    })
	.on('changeDate', function(ev){
		$(this).datepicker('hide');
	});
    $("a.menu-nav").click(function() {
        var id_menu = $(this).attr('id-menu');
        var parent = $(this).attr('parent');
        if (parent == 'true') {
            $('<span class="selected"></span>').appendTo($(this));
            $.ajax({
                url: $base_url + 'ajax/create_session_menu',
                type: 'POST',
                async: false,
                data: {id_menu: id_menu}
            });
        }
       // if (id_menu == '3345') { 
//             bootbox.confirm({         
//                message: "Are you sure update statistics ?",
//                callback: function(result){
//                    
//                }
//            }); 
//        }
        if (parent == 'false') {
            $.ajax({
                url: $base_url + 'ajax/create_session_menu',
                type: 'POST',
                async: false,
                data: {id_menu: id_menu}
            });
        }
                
    });

    $('.switch-language').click(function() {
        var langcode = $(this).attr('langcode');
        $.ajax({
            url: $base_url + 'ajax/change_language',
            type: 'POST',
            async: false,
            data: {langcode: langcode},
            success: function() {
                window.location.reload();
                return false;
            }
        });
    });
    $('#login_modal').click(function(){
  //  var $this = $(event.currentTarget);
        $.ajax({
            url: $base_url + "login/login_modal",
            type: "POST",
            async: false,
            success: function(response) {
                $("#login_modals .modal-content").html(response);
                $('body').addClass("login"); // fix bug when inline picker is used in modal    
            }
        });
        $('#LoginProcess').click(function(){
			var datastring = 'username='+$("#username").val()+'&password='+$("#password").val() +'&remember='+$('#remember').val()+'&login=1&token='+$('#token').val();//  
            $.ajax({
                type: "POST",
                url: $base_url + "user-manage/login_vndmi.php",
                dataType: "json",
                data: datastring,
                success: function(output) {
                  var obj = output;
                 // console.log(obj);
				 // return false;
                    if(obj.status){               
                      $('#login_modals').modal('hide');
        			   $href = $(location).attr('href');
        			   $(location).attr('href',$href);
                    }else{
                      $('span.alert_msg').html(obj.message);
        			  $("#login_alert").removeAttr('style');
                    }
        
                }
            });
        });    
    });
    $('#logout_modal').click(function(){          
        $.ajax({
        	type: "POST",
        	url: $base_url + "user-manage/logout_2.php",
        	dataType: "json",
        	success: function(output) {
        	  $href = $(location).attr('href');
        	  $(location).attr('href',$href);
              window.location.href = $base_url;  
        	}
        });
    }); 
    $('.button-sendcontact').click(function() {
        var contact_name = $('input[name=contact_name]').val();
        var contact_email = $('input[name=contact_email]').val();
        var contact_message = $('textarea[name=contact_message]').val();
        var email_receiving_email = $('input[name=email_receiving_email]').val();
       	var validate_code = $('input[name=contact_code]').val();
        if (contact_name == "" || contact_email == "" || contact_message == "")
        {
            $('p.contact_warning').html('<span style="color: #FF0000; display: block; margin-top: 10px;">Please enter the full input</span>');
            setTimeout(function() {
                $('p.contact_warning').html('')
            }, 3000);
        }
        else
        {
            if (checkmail(contact_email) == false)
            {
                $('p.contact_warning').html('<span style="color: #FF0000; display: block; margin-top: 10px;">Email incorrect formats</span>');
                setTimeout(function() {
                    $('p.contact_warning').html('')
                }, 3000);
            }
            else if (checkValidateCode(validate_code))
            {
                $('.contact_warning').html('<div class="alert alert-danger display-hide" style="display: block;"><button data-close="alert" class="close"></button>Please enter the valid number.</div>');
            }
            else
            {
                $('p.contact_warning').html('<span style="color: green; display: block; margin-top: 10px;">Sending email...</span>')
                $.ajax({
                    url: $base_url + 'contact/sendcontact',
                    type: 'post',
                    async: false,
                    data: {contact_name: contact_name, contact_email: contact_email, contact_message: contact_message, email_receiving_email: email_receiving_email},
                    success: function(data) {
                        if (data == 1)
                        {
                            $('p.contact_warning').html('<span style="color: green; display: block; margin-top: 10px;">Send email success</span>');
                            $('input[name=contact_name]').val('');
                            $('input[name=contact_email]').val('');
                            $('textarea[name=contact_message]').val('');
                        }
                        else
                        {
                            $('p.contact_warning').html('<span style="color: red; display: block; margin-top: 10px;">Send email not success</span>')
                        }
                    }
                });
            }
        }
    });
	$('#feedback_popup').click(function(){
		$('.feedback_warning').html('');
		$('input[name=feedback_name]').val('');
		$('input[name=feedback_email]').val('');
		$('textarea[name=feedback_message]').val('');
		$('input[name=feedback_code]').val('');
	});
	$('.button-sendfeedback').click(function() {
        var contact_name = $('input[name=feedback_name]').val();
        var contact_email = $('input[name=feedback_email]').val();
        var contact_message = $('textarea[name=feedback_message]').val();
        var email_receiving_email = $('input[name=feedback_receiving_email]').val();
		var validate_code = $('input[name=feedback_code]').val();
        if (contact_name == "" || contact_email == "" || contact_message == "")
        {
            $('.feedback_warning').html('<div class="alert alert-danger display-hide" style="display: block;"><button data-close="alert" class="close"></button>Please enter the full input</div>');
        }
        else
        {
            if (checkmail(contact_email) == false)
            {
                $('.feedback_warning').html('<div class="alert alert-danger display-hide" style="display: block;"><button data-close="alert" class="close"></button>Email incorrect formats</div>');
            }
			else if (checkValidateCode(validate_code))
            {
                $('.feedback_warning').html('<div class="alert alert-danger display-hide" style="display: block;"><button data-close="alert" class="close"></button>Please enter the valid number.</div>');
            }
            else
            {
                $('.feedback_warning').html('<div class="alert alert-danger display-hide" style="display: block;"><button data-close="alert" class="close"></button>Sending email...</div>')
                $.ajax({
                    url: $base_url + 'tab/sendfeedback',
                    type: 'post',
                    async: false,
                    data: {contact_name: contact_name, contact_email: contact_email, contact_message: contact_message, email_receiving_email: email_receiving_email, url_send:window.location.href},
                    success: function(data) {
                        if (data == 1)
                        {
                            $('.feedback_warning').html('<div class="alert alert-danger display-hide" style="display: block;"><button data-close="alert" class="close"></button>Send email success</div>');
                            $('input[name=feedback_name]').val('');
                            $('input[name=feedback_email]').val('');
                            $('textarea[name=feedback_message]').val('');
                        }
                        else
                        {
							 $('.feedback_warning').html('<div class="alert alert-danger display-hide" style="display: block;"><button data-close="alert" class="close"></button>Send email not success</div>');
                        }
                    }
                });
            }
        }
    });

    // $("#timer").flipcountdown({
    //   size:"xs"
    // }); 
    
});
function clearconsole() { 
  console.log(window.console);
  if(window.console || window.console.firebug) {
   console.clear();
  }
}
function createTicker() {
    var tickerLIs = $(".breaking-news ul").children();
    tickerItems = new Array();
    tickerLIs.each(function(el) {
        tickerItems.push($(this).html());
    });
    i = 0;
    rotateTicker();
}

function rotateTicker() {
    if (i == tickerItems.length) {
        i = 0;
    }
    tickerText = tickerItems[i];
    c = 0;
    typetext();
    setTimeout("rotateTicker()", 5000);
    i++;
}

function typetext() {
    if (typeof tickerText !== "undefined") {
        var thisChar = tickerText.substr(c, 1);
        if (thisChar == '<') {
            isInTag = true;
        }
        if (thisChar == '>') {
            isInTag = false;
        }
        jQuery('.breaking-news ul').html(tickerText.substr(0, c++));
        if (c < tickerText.length + 1)
            if (isInTag) {
                typetext();
            } else {
                setTimeout("typetext()", 28);
            }
        else {
            c = 1;
            tickerText = "";
        }
    }
}

function checkmail(email) {
    var emailfilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
    var returnval = emailfilter.test(email)
    return returnval;
}
function checkValidateCode(code) {
	var returnval = true;
     $.ajax({
		url: $base_url + 'journals/checkCode',
		type: 'post',
		async: false,
		data: {validate_code: code},
		success: function(data) {
			if (data == 1) returnval = false; 
			else returnval = true; 
		}
	});
	return returnval;
}
function trans(word) {
    var translate;
    $.ajax({
        url: $admin_url + 'translate/getTrans',
        type: 'post',
        data: 'word=' + word,
        async: false,
        success: function(rs) {
            translate = rs;
        }
    });
    return translate;
}

function datatable() {
    var oTable = $("#sample_3").dataTable({
        "aoColumnDefs": [
            {"aTargets": [0]}
        ],
        "aaSorting": [[1, 'asc']],
        "aLengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "iDisplayLength": 50,
        "bLengthChange": false
    });

    jQuery('#sample_3_wrapper .dataTables_filter input').addClass("m-wrap small"); // modify table search input
    jQuery('#sample_3_wrapper .dataTables_length select').addClass("m-wrap small"); // modify table per page dropdown
    jQuery('#sample_3_wrapper .dataTables_length select').select2(); // initialzie select2 dropdown

    $('#sample_3_column_toggler input[type="checkbox"]').change(function() {
        /* Get the DataTables object again - this is not a recreation, just a get of the object */
        var iCol = parseInt($(this).attr("data-column"));
        var bVis = oTable.fnSettings().aoColumns[iCol].bVisible;
        oTable.fnSetColumnVis(iCol, (bVis ? false : true));
    });
}

function updateservice() {
    $.ajax({
        type: "POST",
        url: $base_url + "ajax/getPrice_realtime",
        dataType: "JSON",
        success: function(response) {
            var rs = response;
            //console.log(rs);
            $("#last_update").html("(" + rs[0].date + " | " + rs[0].time + ")");
            var value = parseFloat($("#idx_last").val());
            $("#idx_last").val(rs[0].idx_last);
            var new_value = parseFloat(rs[0].idx_last);
            if (new_value != value) {
                $("#sample_3 tr#6 td.strike").addClass("yellow");
                if (new_value - value > 0) {
                    $("#sample_3 tr#6 td.strike").removeClass("color-red").addClass("color-green");
                } else {
                    $("#sample_3 tr#6 td.strike").removeClass("color-green").addClass("color-red");
                }
                var strike = Math.round(new_value / 25) * 25;
                $("#sample_3 tr#5 td.strike").text(strike - (25 * 1));
                $("#sample_3 tr#4 td.strike").text(strike - (25 * 2));
                $("#sample_3 tr#3 td.strike").text(strike - (25 * 3));
                $("#sample_3 tr#2 td.strike").text(strike - (25 * 4));
                $("#sample_3 tr#1 td.strike").text(strike - (25 * 5));
                $("#sample_3 tr#6 td.strike").text(strike);
                $("#sample_3 tr#7 td.strike").text(strike + (25 * 1));
                $("#sample_3 tr#8 td.strike").text(strike + (25 * 2));
                $("#sample_3 tr#9 td.strike").text(strike + (25 * 3));
                $("#sample_3 tr#10 td.strike").text(strike + (25 * 4));
                $("#sample_3 tr#11 td.strike").text(strike + (25 * 5));
            }
            setTimeout(function() {
                $("#sample_3 tr#6 td.strike").removeClass("yellow");
            }, 800);
        }
    });
    t = setTimeout(function() {
        updateservice();
    }, 15000);
}
/* function that process and display data */
//function timer() {
//    var time = $.ajax({
//        url: $base_url + "welcome/timer",
//        async: false,
//        success: function(response) {
//            return response;
//        }
//    });
//   // t = setTimeout(function() {
////        timer();
////    }, 1000);
////    
//    var d = new Date(Date.UTC(2014,12,12,17,11,36));
//    setInterval(function() {
//        d.setSeconds(d.getSeconds() + 1);
//        $('#timer').text((d.getHours() +':' + d.getMinutes() + ':' + d.getSeconds() ));
//    }, 1000);
//
//}

function thumb() {	

	xOffset = 100;
	yOffset = 30;
	
	$("img.thumb").hover(function(e){
		$("body").append("<p id='thumb'><img src='"+ $(this).attr("src") +"' height='"+ $(this).attr("data-height") + "' /></p>");								 
		$("#thumb")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");					
    }, function() {
		$("#thumb").remove();
    });

	$("img.thumb").mousemove(function(e){
		$("#thumb")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};