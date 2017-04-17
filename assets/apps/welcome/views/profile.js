define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var profileView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function() {

            },
            events: {
                
                "click a.clear-change": "actionClearChange",
                "click a.load_modals": "actionViewModals", // day ne
			    "click a.view-user": "actionViewUser",
				"click .delete-order": "actionDeleteField",
				"click .save-avatar" : "actionUploadAvatar",
				"click .save-change-email" : "actionChangeEmail",
				"click .save-change-pass" : "actionChangePass",
                "click .edit-profile" : "actionEditForAttr",
                "click .save_edit" : "actionSaveEdit",
				"click .remove-image-profile" : "actionRemoveImageProfile",
            },
            actionEditForAttr:function(event){
                var $this = $(event.currentTarget);
                var table = $this.data('table');
                var field = $this.attr('edit_for');
                var type_field = $this.data('type');
                var title = $this.data('title');
                var modal_type = 'modal';
                $.ajax({
                    url: $base_url + 'profile/view_modal',
                    type: 'POST',
                    async: false,
                    data: {modal_type: modal_type, table: table, field: field, type_field: type_field, title: title},
                    success: function(response) {
                        $("#modal_change .modal-content").html(response);
                      //  $.validator.addMethod("noSpace", function(value, element) { 
//                            return value.indexOf(" ") < 0 && value != ""; 
//                        }, "No space please and don't leave it empty");
                    }
                });   
            },
            actionSaveEdit:function(event){
                var $this = $(event.currentTarget);
                var table = $this.data('table');
                var field = $this.data('field');
                var id = $this.data('key');
                var value = $('#'+field).val();
                $.ajax({
                    url: $base_url + 'profile/ajax_update_profile',
                    type: 'POST',
                    async: false,
                    data: {table: table, field: field, value: value, id: id},
                    success: function(response) {
                       if(response!=false){
                            var obj = JSON.parse(response);
                            $('[name="'+field+'"]').text(obj);
                            $('#modal_change').modal('hide');
                       }
                    }
                });   
            },
			actionChangePass: function(event){
				event.preventDefault();
				$("#change_password").validate({
					rules: {
						old_password: {
							required: true
						},
						new_password: {
							required: true,
							noSpace: true,
							minlength: 4
						},
						confirm_password: {
							required: true,
							equalTo: "#new_password"
						}
					},
					messages: {
						old_password: {
							required: '<?php echo trans("pass_null",true); ?>'
						},
						new_password: {
							required: '<?php echo trans("pass_new_error",true); ?>',
							noSpace: '<?php echo trans("pass_no_space",true); ?>',
							minlength: '<?php echo trans("pass_min4chart",true); ?>'
						},
						confirm_password: {
							required: '<?php echo trans("pass_new_null",true); ?>',
							equalTo: '<?php echo trans("pass_repeat_error",true); ?>'
						}
					
					},
					submitHandler: function(form) {
						if(($("#new_password").val().trim())==($("#confirm_password").val().trim()))
							$.ajax({
								url: $base_url + 'profile/change_password',
								type: 'POST',
								//dataType: 'JSON',
								data: {old_password: $("#old_password").val(), new_password: $("#new_password").val()},
								async: false,
								success: function(response) {
									var length =  $("#new_password").val().length;
									$("#old_password").val('');
									$("#new_password").val('');
									$("#confirm_password").val('');
									if(response == '1') {
										$("div.alert-success").fadeIn();
										$('#count_pass').html(repeatString("*",length));
										$('#modal_change').modal('hide');
									} else {
										$("div.alert-danger").fadeIn();
									}
									$("div.alert").delay(1500).fadeOut();
								}
							});
						else {
							$("div.alert-danger").fadeIn();
							$("#confirm_password").val('');
						}
					}
				});
				$("#change_password").submit();
			},
			actionChangeEmail: function(event){
				event.preventDefault();
				$("#change_email").validate({
					rules: {
						old_email: {
							required: true,
							email: true
						},
						new_email: {
							required: true,
							email: true
						},
						confirm_email: {
							equalTo: "#new_email"
						}
					},
					messages: {
						old_email: {
							required: '<?php echo trans("email_null",true) ;?>',
							email: '<?php echo trans("email_error",true); ?>'
						},
						new_email: {
							required: '<?php echo trans("email_null",true); ?>',
							email: '<?php echo trans("email_error",true); ?>'
						},
						confirm_email: {
							equalTo: '<?php echo trans("repeat_email_error",true); ?>'
						}
					},
					submitHandler: function(form) {
						$.ajax({
							url: $base_url + 'profile/change_email',
							type: 'POST',
						  //  dataType: 'JSON',
							data: {old_email: $("#old_email").val(), new_email: $("#new_email").val(),confirm_email: $("#confirm_email").val()},
							async: false,
							success: function(rs) {
								response = JSON.parse(rs);
								
								if(response.status == '1') {
									$("#old_email").val('');
									$("#new_email").val('');
									$("#confirm_email").val('');
									$("div.alert-success").fadeIn();
									$('#user_email').html(response.message);
									$('#modal_change').modal('hide');
								} else {
									$('#message_fail').html(response.message);
									$("div.alert-danger").fadeIn();
								}
								$("div.alert").delay(1500).fadeOut();
							}
						});
					}
				});
                $("#change_email").submit();
			},
			actionUploadAvatar: function(event){
				event.preventDefault();
				$("#fileupload").submit(function(e) {
                        var formData = new FormData(this);
                        $.ajax({
                            url: $base_url + 'profile/upload_avatar',
                            type: 'POST',
                            mimeType: "multipart/form-data",
                            data: formData,
                            contentType: false,
                            cache: false,
                            processData: false,
                            success: function(rs) {
								
                                rs = JSON.parse(rs);
                                if (rs.error != '') {
                                    alert(rs.error);
                                }
                                if (rs.success != '') {
									 bootbox.alert("upload success!"); 
							
                                    //$("#avatar").attr('src', rs.success + '?' + (new Date()).getTime());
                                    $(".img-hide1").attr('src', rs.success + '?' + (new Date()).getTime());
									location.reload();
                                }
                            }
                        });
                        e.preventDefault();
                    });
                    $("#fileupload").submit();
			},
			
			actionRemoveImageProfile: function() {
				var attr = $("#myavatar").attr('src');
               //alert(attr);
                $.ajax({
					url: $base_url + 'profile/deleteImage',
					type: 'POST',
					data: {attr: attr},
					async: false,
					success: function(response) {
						//console.log(response);
						//return false;
					   if((response == true) || response) {
                          bootbox.alert("Delete image success!");  
						  location.reload();                        
                        } else {
                            bootbox.alert("Delete fail!");   
                        }
         					
					}
				});
            },
			
			actionDeleteField: function(event) {
                event.preventDefault();
			
				if (confirm(trans("cancel_conform_order")) == false) {
					return;
				}
				var $this = $(event.currentTarget);
                $.ajax({
					url: $base_url + 'profile/delete_order',
					type: 'POST',
					data: {keys: $this.attr('keys')},
					async: false,
					success: function(response) {
					   if((response == true) || response) {
                            $("div.alert-success").text(trans('cancel_order_success'));
                            $("div.alert-success").fadeIn().delay(1500).fadeOut();                            
                        } else {
                            $("div.alert-success").addClass('alert-warning');
                            $("div.alert-success").removeClass('alert-success');
                            $("div.alert-warning").text(trans('cancel_order_warning'));
                            $("div.alert-warning").fadeIn().delay(1500).fadeOut();
                        }
                        var table = $('#table_orders').DataTable();
                        table.draw( false );						
					}
				});
            },
			actionViewUser: function(event) {
                var $this = $(event.currentTarget);
                $.ajax({
                    url: $base_url + "profile/view_user_home",
                    type: "POST",
                    dataType: "JSON",
                    data: {},
                    async: false,
                    success: function(response) {
                        var modal = $("#modal_view_user");
                        modal.find("input[name=view_first_name]").val(response.first_name);
                        modal.find("input[name=view_last_name]").val(response.last_name);
						modal.find("textarea[name=view_profile]").val(response.profile);
						modal.find("textarea[name=view_education]").val(response.education);
						modal.find("textarea[name=view_experiences]").val(response.experiences);
						modal.find("textarea[name=view_interests]").val(response.interests);  
                        $.validator.addMethod("noSpace", function(value, element) { 
                            return value.indexOf(" ") < 0 && value != ""; 
                        }, "No space please and don't leave it empty");
                        
                        $("#form_view_user").validate({
                            rules: {
                                first_name: {
                                    required: true
                                },
                                last_name: {
                                    required: true
                                },
                                profile: {
                                    required: true
                                },
                                education: {
                                    required: true
                                },
                                experiences: {
                                    required: true
                                },
                                interests: {
                                    required: true
                                } 
                            },
                            messages: {
                                first_name: {
                                    required: '<?php echo trans("name_not_null");?>'
                                },
                                last_name: {
                                    required: '<?php echo trans("lastname_not_null");?>'
                                },
                                profile: {
                                    required: '<?php echo trans("story_not_null"); ?>'
                                },
                                education: {
                                    required: '<?php echo trans("level_not_null"); ?>'
                                },
                                experiences: {
                                    required: '<?php echo trans("experience_not_null");?>'
                                },
                                interests: {
                                    required: '<?php echo trans("hobby_not_null"); ?>'
                                }
                            },
                            submitHandler: function(form) {
                                $.ajax({
                                    url: $base_url + 'profile/change_user_info',
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: {first_name: $("input[name=view_first_name]").val(), last_name: $("input[name=view_last_name]").val(),profile: $("textarea[name=view_profile]").val(),education: $("textarea[name=view_education]").val(),experiences: $("textarea[name=view_experiences]").val(), interests: $("textarea[name=view_interests]").val()},
                                    async: false,
                                    success: function(response){
                                        if(response == '1') {
                                            $("div.alert-success").fadeIn();
                                            location.reload();
                                        } else {
                                            $("div.alert-danger").fadeIn();
                                        }
                                        $("div.alert").delay(1500).fadeOut();
                                    }
                                });
                            }
                        });
                        
                    }
                });
            },
            actionViewModals: function(event) {
                var $this = $(event.currentTarget);
                $.ajax({
                    url: $base_url + 'profile/view_modal',
                    type: 'POST',
                    async: false,
                    data: {modal_type: $this.attr("id")},
                    success: function(response) {
                        //console.log(response);
                        $("#modal_change .modal-content").html(response);
                        $.validator.addMethod("noSpace", function(value, element) { 
                            return value.indexOf(" ") < 0 && value != ""; 
                        }, "No space please and don't leave it empty");
                    }
                });
            },
            actionClearChange: function(event) {
                var $this = $(event.currentTarget);
                $("#old_password").val('');
                $("#new_password").val('');
                $("#confirm_password").val('');
                $("#old_email").val('');
                $("#new_email").val('');
                $("#confirm_email").val('');
            },
            index: function(){
                //set editable mode based on URL parameter
                if (Metronic.getURLParameter('mode') == 'inline') {
                    $.fn.editable.defaults.mode = 'inline';
                    $('#inline').attr("checked", true);
                    jQuery.uniform.update('#inline');
                } else {
                    $('#inline').attr("checked", false);
                    jQuery.uniform.update('#inline');
                }
        
               
                $(document).ready(function(){
					var grid = new Datatable();
                    grid.init({
                        src: $("#table_orders"),
                        dataTable: {
 //                           "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'col-md-12 footer margin-bottom-20'<'col-md-6 col-sm-12 toolbar'><'col-md-6 col-sm-12 footer_page'pli>>",
                           "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'col-md-12 footer'<'col-md-6 col-sm-12 toolbar'><'col-md-8 col-sm-12'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                            "lengthMenu": [
                                [10, 20, 50, 100, 200, 300, 400, 500],
                                [10, 20, 50, 100, 200, 300, 400, 500]
                            ],
                            "pageLength": 10,
                            "ajax": {
								"url": $base_url + "profile/list_data",
                                "type": "POST",
                            },
							"columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
								'orderable': true,
								'targets': [0]
							}],
                            "order": []
                        }
                    });
					var grid_excu = new Datatable();
                    grid_excu.init({
                        src: $("#table_excution"),
                        dataTable: {
 //                           "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'col-md-12 footer margin-bottom-20'<'col-md-6 col-sm-12 toolbar'><'col-md-6 col-sm-12 footer_page'pli>>",
                           "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'col-md-12 footer'<'col-md-6 col-sm-12 toolbar'><'col-md-8 col-sm-12'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                            "lengthMenu": [
                                [10, 20, 50, 100, 200, 300, 400, 500],
                                [10, 20, 50, 100, 200, 300, 400, 500]
                            ],
                            "pageLength": 10,
                            "ajax": {
								"url": $base_url + "profile/list_excu?tab=excution_traded",
                                "type": "POST",
                            },
							"columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
								'orderable': true,
								'targets': [0]
							}],
                            "order": []
                        }
                    });
                    
                });
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
    return new profileView;
});