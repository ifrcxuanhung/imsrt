define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var setupView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
               
                  
            },
            events: {
                "click .save_setup": "actionSaveSetup",
				 "click .cancel_setup": "actionCancel",
				 "click .open-calculation": "actionOpenCalculation",
				 "click .close-calculation": "actionCloseCalculation",
                 "click .statistics-update": "actionUpdateStatistics",
                 "click .switch-calculation": "actionSwitchCalculation",
                 "click .next-calculation": "actionNextCalculation",
                 "click .opennew-calculation": "actionOpennewCalculation",
				 "click .export-txt": "actionExportTxt",
                 "click .initialisation": "actionInitialisation",
                 "click .backup-data": "actionBackup",
                 "click .clean-intraday": "actionCleanIntraday",
                 "click .cleandata": "actionCleandata",
                 "click .reopen": "actionReopen",
                 "click .update_pclose": "actionUpdate_pclose",
                 "click .backup_eod": "actionBackupEOD",

            },
            
            actionBackupEOD: function(event) {
                var $this = $(event.currentTarget);
				bootbox.confirm({
					message: "Are you sure ?",
					callback: function(result){
						if(result == true){
							$(".modal-content").hide();
							  $.ajax({
									url: $base_url + "setup/backup_eod",
									type: "POST",
									data: {},
									async: false,
									success: function(response) {
										 $("div #message_close").html("Close Success!!");	
										 $("div #message_close").fadeIn();
										 window.location.reload();
								
									}
								});	
						}	
					}
				});
              
            },  
            
            actionUpdate_pclose: function(event) {
                var $this = $(event.currentTarget);
				bootbox.confirm({
					message: "Are you sure update pclose for VNDMI ?",
					callback: function(result){
						if(result == true){
							$(".modal-content").hide();
							  $.ajax({
									url: $base_url + "setup/update_pclose_vndmi",
									type: "POST",
									data: {},
									async: false,
									success: function(response) {
										 $("div #message_close").html("Update Success!!");	
										 $("div #message_close").fadeIn();
										 window.location.reload();
								
									}
								});	
						}	
					}
				});
              
            },  
            actionReopen: function(event) {
                var $this = $(event.currentTarget);
                if($('#truncate').is(":checked")) { var check = 1; }
                else { check =0 }
                     $.ajax({
						url: $base_url + "setup/open",
						type: "POST",
						data: {truncate: check},
						async: false,
						success: function(response) {
                        $('#modal_view_user2').modal('hide');
						}
					});   
            },
            actionOpenCalculation: function(event) {
            var $this = $(event.currentTarget);
            $('#modal_view_user2').modal('show');
            },
            
            actionCleandata: function(event) {
                var $this = $(event.currentTarget);
                     $.ajax({
						url: $base_url + "setup/synlinux_host",
						type: "POST",
						data: {start_time: $('#start_time').val(), end_time: $('#end_time').val()},
						async: false,
						success: function(response) {
                        $('#modal_view_user').modal('hide');
						}
					});   
            },
            actionCleanIntraday: function(event) {
                var $this = $(event.currentTarget);
                    $('#modal_view_user').modal('show');
            },
            actionBackup: function(event) {
                var $this = $(event.currentTarget);
				// bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                   // message: "Are you sure backup data ?",
                    //callback: function(result){ /* your callback code */ 
                        //if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "setup/backup",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_statistics").html("Bakup successfull!!");	
									 $("div #message_statistics").fadeIn();
									 window.location.reload();
							
								}
							});
                        //}
                    //}
                //}); 
               
            },
            
            actionUpdateStatistics: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure update statistics ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "setup/update_stat",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_statistics").html("Update statistics successfull!!");	
									 $("div #message_statistics").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
            
            actionInitialisation: function(event) {
                var $this = $(event.currentTarget);
				 bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure update process ?",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                            $(".modal-content").hide();
                            
                             $.ajax({
								url: $base_url + "setup/initialisation",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_initialisation").html("Initialisation Success!!");	
									 $("div #message_initialisation").fadeIn();
									 window.location.reload();
							
								}
							});
                        }
                    }
                }); 
               
            },
			/*actionOpenCalculation: function(event) {
                var $this = $(event.currentTarget);
				bootbox.confirm({
					message: "Are you sure open the indexes calculation ?",	
					callback: function(result){
						if(result == true){
							$(".modal-content").hide();
							 $.ajax({
								url: $base_url + "setup/open",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_open").html("Open Success!!");	
									 $("div #message_open").fadeIn();
									 window.location.reload();
							
								}
							});
								
						}	
					}
				});
               
            },*/
			actionCloseCalculation: function(event) {
                var $this = $(event.currentTarget);
				bootbox.confirm({
					message: "Are you sure close the indexes calculation ?",
					callback: function(result){
						if(result == true){
							$(".modal-content").hide();
							  $.ajax({
									url: $base_url + "setup/close",
									type: "POST",
									data: {},
									async: false,
									success: function(response) {
										 $("div #message_close").html("Close Success!!");	
										 $("div #message_close").fadeIn();
										 window.location.reload();
								
									}
								});	
						}	
					}
				});
              
            },  
            actionNextCalculation: function(event) {
                var $this = $(event.currentTarget);
				bootbox.confirm({
					message: "Are you sure create next day data ?",
					callback: function(result){
						if(result == true){
							$(".modal-content").hide();
							$.ajax({
								url: $base_url + "setup/create_nxt_data",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									 $("div #message_next").html("Create Next Day Data Success!!");	
									 $("div #message_next").fadeIn();
									 window.location.reload();
							
								}
							});
								
						}
					}	
				});
                
            },  
            actionOpennewCalculation: function(event) {
                var $this = $(event.currentTarget);
				bootbox.confirm({
					message: "Are you sure import .txt file for open ?",
					callback: function(result){
						if(result == true){
							$(".modal-content").hide();
							$.ajax({
								url: $base_url + "setup/open_new",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									 $("div #message_open_new").html("Switch Success!!");	
									 $("div #message_open_new").fadeIn();
									 window.location.reload();
							
								}
							});	
						}	
					}	
				});
                
            },
            actionSwitchCalculation: function(event) {
                var $this = $(event.currentTarget);
                bootbox.confirm({
                    
                  //  Example.show("Confirm result: "+result);
                  //console.log(result);
                    message: "Are you sure",
                    callback: function(result){ /* your callback code */ 
                        if(result == true){
                           $(".modal-content").hide();
                            
                            $.ajax({
                                url: $base_url + "setup/switch_next_day",
                                type: "POST",
                                data: {},
                                async: false,
                                success: function(response) {
                                    $("div #message_switch").html("Switch Success!!");	
        			             $("div #message_switch").fadeIn();
								  window.location.reload();
            				
                             }
                            });
                        }
                    }
                }); 
            },
			actionSaveSetup: function(){
				$.ajax({
					url: $base_url + 'setup/save_setup',
					type: 'POST',
					dataType: 'JSON',
					data: $('form#form-setup').serialize(),
					async: false,
					success: function(response) {
						if(response == true) {
							$("div.alert-success").text('Inserted!');
							$("div.alert-success").fadeIn();
							window.location.reload();
						} else {
							$("div.alert-success").text('Insert not successful!');
							$("div.alert-danger").fadeIn();
						}
						$("div.alert").delay(1500).fadeOut();
					}
				});
			},
			actionCancel: function(){
				$("#start_time_1").val($("#start1").val());
				$("#end_time_1").val($("#end1").val());
				$("#start_time_2").val("");
				$("#end_time_2").val("");
				$("#frequency").val($("#fre").val());
			},
			
			actionExportTxt: function(event) {
                var $this = $(event.currentTarget);
				bootbox.confirm({
					message: "Are you sure export file .txt",
					callback: function(result){
						if(result == true){
							$(".modal-content").hide();
							  $.ajax({
								url: $base_url + "setup/exporttxt",
								type: "POST",
								data: {},
								async: false,
								success: function(response) {
									$("div #message_open").html("Open Success!!");	
									 $("div #message_open").fadeIn();
							
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
        return new setupView;
});