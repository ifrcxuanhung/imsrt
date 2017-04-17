define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var public_websiteView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
               
                  
            },
            events: {
				"click .update-imsrt-day": "actionUpdateImsrtDay",
                 "click .local-daily": "actionUploadLocaldaily",
                 "click .local-gwc": "actionUploadLocalgwc",
                 "click .host-daily": "actionUploadHostdaily",
                 "click .update_all": "actionUpdateall",
                 "click .undo-daily": "actionUndodaily",
                 "click .undo-gwc": "actionUndogwc",
                 "click .upload_data": "actionUploaddate",
                 "click .btnupload": "actionUploaddata",

            },
			
			actionUpdateImsrtDay: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure update imsrt day ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "public_website/update_imsrt_day",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_upload").html("Upload Success!!");	
									 $("div #message_upload").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
            actionUploaddata: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    message: "Are you sure upload data ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                             $.ajax({
        						url: $base_url + "public_website/upload_data",
        						type: "POST",
        						data: {start_date: $('#start_date').val(), end_date: $('#end_date').val()},
        						async: false,
        						success: function(response) {
                                $('#modal_view_user').modal('hide');
        						}
        					}); 
                        }
                    }
                });   
            },
            actionUploaddate: function(event) {
                var $this = $(event.currentTarget);
                    $('#modal_view_user').modal('show');
            },
            
            actionUndogwc: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    message: "Are you sure upload data ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "public_website/undogwc",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_undo").html("Delete Data Success!!");	
									 $("div #message_undo").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
            actionUndodaily: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    message: "Are you sure upload data ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "public_website/undodaily",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_undo").html("Delete Data Success!!");	
									 $("div #message_undo").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
            
            actionUploadLocaldaily: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure upload data ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "public_website/daily_local",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_upload").html("Upload Success!!");	
									 $("div #message_upload").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
            
            actionUploadLocalgwc: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure upload data ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "public_website/womenceo_local",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_upload").html("Upload Success!!");	
									 $("div #message_upload").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
             actionUploadHostdaily: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure upload data ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "public_website/daily_host",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_upload").html("Upload Success!!");	
									 $("div #message_upload").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
            
            actionUpdateall: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure upload data ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "public_website/update_all",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_upload").html("Update Success!!");	
									 $("div #message_upload").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
			
            index: function(){
				
               $(document).ready(function(){

               			
				
               });
               
                //update();
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new public_websiteView;
});