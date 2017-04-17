define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var tabView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function() {

            },
            events: {
                 "click a.view-tab-modal-edit": "actionViewModalEdit",   
                 "click .exportCsv": "actionExportCsv",
				 "click .exportTxt": "actionExportTxt",
				 "click .exportXls": "actionExportXls",
				 "click .exportPdf": "actionExportPdf",
				 "hover img.thumb": "actionViewThumb",
				 "click .deleteField": "actionDeleteField"
            },
			actionViewThumb: function(event) {
                var $this = $(event.currentTarget);
                thumb();
            },
            actionExportCsv: function(event) {
				$("#act").val('exportCsv');
				$('#form_tab').submit();
            },
			actionExportTxt: function(event) {
				$("#act").val('exportTxt');
				$('#form_tab').submit();
            },
			actionExportXls: function(event) {
				$("#act").val('exportXls');
				$('#form_tab').submit();
            },
			actionExportPdf: function(event) {
				$("#act").val('exportPdf');
				$('#form_tab').submit();
            },
			 actionDeleteField: function(event) {
                event.preventDefault();
			
				if (confirm("Are you sure to delete this row ?") == false) {
					return;
				}
				var $this = $(event.currentTarget);
                $.ajax({
					url: $base_url + 'tab/delete_row',
					type: 'POST',
					data: {table_name: $this.attr("table_name"), keys: $this.attr('keys')},
					async: false,
					success: function(response) {
					   if((response == true) || response) {
                            $("div.alert-success").text('Deleted!');
                            $("div.alert-success").fadeIn().delay(1500).fadeOut();
                            
                        } else {
                            $("div.alert-success").addClass('alert-warning');
                            $("div.alert-success").removeClass('alert-success');
                            $("div.alert-warning").text('Delete Warning !');
                            $("div.alert-warning").fadeIn().delay(1500).fadeOut();
                        }
                        location.reload();						
					}
				});
            },
            actionViewModalEdit: function(event) {
                var $this = $(event.currentTarget);
				var validate = $this.attr("keys");
                $.ajax({
                    url: $base_url + "tab/tab_modal",
                    type: "POST",
                  //  dataType: "JSON",
                    data: {table_name: $this.attr("table_name"), keys: $this.attr("keys")},
                    async: false,
                    success: function(response) {
                        $("#tab_modal .modal-content").html(response);
                          //var desc = $this.attr("description");
                         if (jQuery().datepicker) {
                              //  console.log('111111111111111111111111111');
                                $('.date-picker').datepicker({
                                    orientation: "left",
                                    autoclose: true
                                 //   minDate: '+1d'
                                });
                                $('body').removeClass("modal-open"); // fix bug when inline picker is used in modal
                        }
                        $("#checkupdate_modal").validate({
                             rules: {
                                'validate[]': {
                                    required: true
                                }
                            },
                            messages: {
                                'validate[]': {
                                    required: "Tên không được để trống"
                                }
                            },
                            submitHandler: function(form) {
                                $.ajax({
                                    url: $base_url + 'tab/update_tab_modal',
                                    type: 'POST',
                                    dataType: 'JSON',
                                    data: $('form#checkupdate_modal').serialize(),
                                    async: false,
                                    success: function(response) {
                                        if(response == true) {
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
            index: function() {
                $(document).ready(function() {
					var tab = $('#tab_name').val();
					var value_filter = $('#value_filter').val();
                    var grid = new Datatable();
                    grid.init({
                        src: $("#tab"),
                        dataTable: {
                            "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'col-md-12 footer'<'col-md-6 col-sm-12 toolbar'><'col-md-6 col-sm-12 footer_page'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                            "lengthMenu": [
                                [10, 20, 50, 100, 200, 300, 400, 500],
                                [10, 20, 50, 100, 200, 300, 400, 500]
                            ],
                            "pageLength": 10,
                            "ajax": {
								"url": $base_url + "tab/list_tabs?"+value_filter,
                                "type": "POST",
                            },
							"columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
								'orderable': true,
								'targets': [0]
							}],
                            "order": [
								[0, "asc"]
							] 
                        }
                    });
					$("div.toolbar").html( '<div style="margin-top:3px; font-size:13px !important;">'+$('#note').val()+"</div>");
                });
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
    return new tabView;
});
