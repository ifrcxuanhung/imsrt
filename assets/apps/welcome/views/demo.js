define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
		var publication_keys = [];
		var publication_values = [];
		var research_keys = []; 
		var research_values = [];
		var test_keys = [];
		var test_values = [];
		var pulication_save =[];
		var research_save =[];
		var test_save = [];
		var pulication_save_value =[];
		var research_save_value =[];
		var test_save_value = [];
		var pulication_load ="";
		var research_load ="";
		var test_load = "";
		var id_save = '';
        var demoView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function() {
				$("#form_rsfinal_wrapper").show();
				$('.table_wrapper_sub_final').hide();                    
            },  
            events: {
                "click .remove": "actionRemoveTableStep",
				"click .remove-publi": "actionRemoveTableStep1",
				"click .remove-resear": "actionRemoveTableStep2",
				"click .remove-tes": "actionRemoveTableStep3",
				"click .remove-publi": "actionRemoveTableStep1",
                "click #saveas_tabletemp1": "actionSaveAsTableTemp1",
                "click #saveas_tabletemp2": "actionSaveAsTableTemp2",
                "click #saveas_tabletemp3": "actionSaveAsTableTemp3",
                "click .button-calculator": "actionCalculator",
				"click .result_detail": "actionResultDetail",
				"click .table_rsfinal": "actionResultSum",
				"click .exportTxt": "actionExportTxt",
				"click .exportCsv": "actionexportCsv",
				"click .exportXls": "actionexportXls",
				"click .exportSumTxt": "actionExportSumTxt",
				"click .exportSumCsv": "actionexportSumCsv",
				"click .exportSumXls": "actionexportSumXls",
				"click .btn-save-script": "actionSaveScript",
				"click .load_script_db": "actionLoadScriptDb",
				"click .delete_script_db": "actionDeleteScriptDb",
				"click .load-script" : "actionLoadScript",
				"click .load-none-script" : "actionLoadNoneScript",
            },
			actionLoadScript: function(event){
				var table = $('#table_load_script').DataTable();
                table.draw( false );
			},
			actionLoadNoneScript: function(event){
				var $this = $(event.currentTarget);
				id_save = '';
				$("#title_save").val('');
				pulication_load_title =  '';
				research_load_title =  '';
				test_load_title =  '';
				pulication_load_value =  '';
				research_load_value =  '';
				test_load_value =  '';
				//add publication
				publication_keys = [];
				publication_values =[];
				var publication = [];
                $('#table_temp_1 tbody').html(publication);
				//add research
				research_keys = [];
				research_values =[];
				var research = [];
                $('#table_temp_2 tbody').html(research);
				//add test
				test_keys = [];
				test_values =[];
				var test = [];
                $('#table_temp_3 tbody').html(test);
			},
			actionDeleteScriptDb: function(event) {
                event.preventDefault();
			
				if (confirm("Are you sure to delete this row ?") == false) {
					return;
				}
				var $this = $(event.currentTarget);
                $.ajax({
					url: $base_url + 'demo/delete_script_row',
					type: 'POST',
					data: {keys: $this.attr('keys')},
					async: false,
					success: function(response) {
					   $("div#save-delete-success").text('Deleted successful!');
					   $("div#save-delete-success").fadeIn().delay(1500).fadeOut();					
					   var table = $('#table_load_script').DataTable();
                        table.draw( false );
					}
				});
            },
			actionLoadScriptDb: function(event) {
                var $this = $(event.currentTarget);
				id_save = $this.attr("keys");
				$("#title_save").val($this.attr("script_title"));
				pulication_load_title =  $this.attr("publication_title").split(':;');
				research_load_title =  $this.attr("research_title").split(':;');
				test_load_title =  $this.attr("test_title").split(':;');
				pulication_load_value =  $this.attr("publication_value").split(':;');
				research_load_value =  $this.attr("research_value").split(':;');
				test_load_value =  $this.attr("test_value").split(':;');
				//add publication
				publication_keys = [];
				publication_values =[];
				$.each( pulication_load_title, function( key, value ) {
					if(value!=''){
						publication_keys.push(value); 
						publication_values.push(pulication_load_value[key]); 
					}
                });
				var publication = [];
				$.each(publication_keys, function( index, value ) {
					publication.push('<tr><td style="width:3%"><a class="btn btn-xs red remove-publi" id="'+publication_values[index]+'" name="publi[]" data-title="'+value+'" href="javascript:;"><i class="fa fa-trash"></i></a></td><td>'+publication_values[index]+'</td></tr>');
					});
                $('#table_temp_1 tbody').html(publication);
				//add research
				research_keys = [];
				research_values =[];
				$.each( research_load_title, function( key, value ) {
					if(value!=''){
						research_keys.push(value); 
						research_values.push(research_load_value[key]);   
					}
                });
				var research = [];
				$.each(research_keys, function( index, value ) {
					research.push('<tr><td style="width:3%"><a class="btn btn-xs red remove-resear" id="'+research_values[index]+'" name="resear[]" data-title="'+value+'" href="javascript:;"><i class="fa fa-trash"></i></a></td><td>'+research_values[index]+'</td></tr>');
					});
                $('#table_temp_2 tbody').html(research);
				//add test
				test_keys = [];
				test_values =[];
				$.each( test_load_title, function( key, value ) {
					if(value!=''){
					test_keys.push(value); 
					test_values.push(test_load_value[key]);
					}
                });
				var test = [];
				$.each(test_keys, function( index, value ) {
					test.push('<tr><td style="width:3%"><a class="btn btn-xs red remove-tes" id="'+test_values[index]+'" name="tes[]" data-title="'+value+'" href="javascript:;"><i class="fa fa-trash"></i></a></td><td>'+test_values[index]+'</td></tr>');
					});
                $('#table_temp_3 tbody').html(test);
				$('#load_script').modal('hide');
            },
           actionSaveScript : function(event){	
		   		var title_save = $("#title_save").val();			
				 $.ajax({
					url: $base_url + 'demo/save_script',
					type: 'POST',
					dataType: 'JSON',
					data: {pulication_save: pulication_save, research_save: research_save, test_save: test_save, pulication_save_value: pulication_save_value, research_save_value: research_save_value, test_save_value: test_save_value, title_save: title_save, id_save:id_save},
					async: false,
					success: function(response) {
						$("div#save-script-success").text('Saved script successful!');
						$("div#save-script-success").fadeIn().delay(1500).fadeOut();
						setTimeout(function () {
							$('#save_script').modal('hide');
						}, 1500);
					}
				});
			},
			actionExportSumTxt : function(event){				
				 $('#act_summary').val('exportTxt');
				 $('#form_data_rsfinal').submit();
			},
			actionexportSumCsv : function(event){				
				 $('#act_summary').val('exportCsv');
				 $('#form_data_rsfinal').submit();
			},
			actionexportSumXls : function(event){				
				 $('#act_summary').val('exportXls');
				 $('#form_data_rsfinal').submit();
			},
			actionExportTxt : function(event){				
				 var $this = $(event.currentTarget);
				 $('#action_sub_'+$this.attr('name')).val('exportTxt');
				 $('#form_sub_final_'+$this.attr('name')).submit();
			},
			actionexportCsv : function(event){				
				 var $this = $(event.currentTarget);
				 $('#action_sub_'+$this.attr('name')).val('exportCsv');
				 $('#form_sub_final_'+$this.attr('name')).submit();
			},
			actionexportXls : function(event){				
				 var $this = $(event.currentTarget);
				 $('#action_sub_'+$this.attr('name')).val('exportXls');
				 $('#form_sub_final_'+$this.attr('name')).submit();
			},
			actionResultDetail: function(event){
				 var $this = $(event.currentTarget);
			   $("#form_rsfinal_wrapper").hide();
			    $('.table_wrapper_sub_final').not('#name_' + $this.attr("id")).hide();
			    $("#name_"+$this.attr("id")).show();
			    
            },
			actionResultSum: function(event){
				 var $this = $(event.currentTarget);
			   $("#form_rsfinal_wrapper").show();
			    $('.table_wrapper_sub_final').hide();
			    
            },
            actionSaveAsTableTemp1: function(event){
                var form = $('#form_literature_reviewer');
                var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                if (input.is(":radio")) {
                    input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                }
                $('[name="publication[]"]:checked').each(function(){
					if($.inArray($(this).attr('data-title'), publication_keys) == -1){
						publication_keys.push($(this).attr('data-title')); 
						publication_values.push($(this).attr('value'));                  		
					}
                });
				var publication = [];
				$.each(publication_keys, function( index, value ) {
					publication.push('<tr><td style="width:3%"><a class="btn btn-xs red remove-publi" id="'+publication_values[index]+'" name="publi[]" data-title="'+value+'" href="javascript:;"><i class="fa fa-trash"></i></a></td><td>'+publication_values[index]+'</td></tr>');
					});
                $('#table_temp_1 tbody').html(publication);
            },
           actionSaveAsTableTemp2: function(event){
                var form = $('#form_data_construction');
                var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                if (input.is(":radio")) {
                    input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                }
               
                $('[name="research[]"]:checked').each(function(){
					if($.inArray($(this).attr('data-title'), research_keys) == -1){
						research_keys.push($(this).attr('data-title'));
						research_values.push($(this).attr('value'));
					}
                });
				var research = [];
				$.each(research_keys, function( index, value ) {
					research.push('<tr><td style="width:3%"><a class="btn btn-xs red remove-resear" id="'+research_values[index]+'" name="resear[]" data-title="'+value+'" href="javascript:;"><i class="fa fa-trash"></i></a></td><td>'+research_values[index]+'</td></tr>');
					});
                $('#table_temp_2 tbody').html(research);
            },
            actionSaveAsTableTemp3: function(event){
                var form = $('#form_data_methodologies');
                var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                if (input.is(":radio")) {
                    input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                }
               
                $('[name="test[]"]:checked').each(function(){
					if($.inArray($(this).attr('data-title'), test_keys) == -1){
						test_keys.push($(this).attr('data-title'));
						test_values.push($(this).attr('value'));
					}
                });
				var test = [];
				$.each(test_keys, function( index, value ) {
					test.push('<tr><td style="width:3%"><a class="btn btn-xs red remove-tes" id="'+test_values[index]+'" name="tes[]" data-title="'+value+'" href="javascript:;"><i class="fa fa-trash"></i></a></td><td>'+test_values[index]+'</td></tr>');
					});
                $('#table_temp_3 tbody').html(test);
            },
            actionCalculator: function(event){
               event.preventDefault();
                
            },
			actionRemoveTableStep1: function(event) {
                 var $this = $(event.currentTarget);
				 var i = publication_keys.indexOf($this.attr('data-title'));
				if(i != -1) {
					publication_keys.splice(i, 1);
					publication_values.splice(i, 1);
				}
                 $this.removeAttr('name');
                 $this.parents('tr').remove();
            },
			actionRemoveTableStep2: function(event) {
                 var $this = $(event.currentTarget);
				 var i = research_keys.indexOf($this.attr('data-title'));
				if(i != -1) {
					research_keys.splice(i, 1);
					research_values.splice(i, 1);
				}
                 $this.removeAttr('name');
                 $this.parents('tr').remove();
            },
			actionRemoveTableStep3: function(event) {
                 var $this = $(event.currentTarget);
				 var i = test_keys.indexOf($this.attr('data-title'));
				if(i != -1) {
					test_keys.splice(i, 1);
					test_values.splice(i, 1);
				}
                 $this.removeAttr('name');
                 $this.parents('tr').remove();
            },
            actionRemoveTableStep: function(event) {
                 var $this = $(event.currentTarget);
                 $this.removeAttr('name');
                 $this.parents('tr').remove();
            },
            index: function(){
                $(document).ready(function(){ 
                    if (!jQuery().bootstrapWizard){
                        return;
                    }
                    var grid = new Datatable();
                           // alert( $("#ranking").val());
                    grid.init({
                        src: $("#literature_reviewer"),
                        loadingMessage: 'Loading...',
                        dataTable: {
                            "dom": "<'row'r>t<'col-md-12 footer'<'col-md-12 col-sm-12'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                          //  "processing": true,
                            "serverSide": true,
                            "lengthMenu": [
                                [10, 20, 50, 100, 200, 400],
                                [10, 20, 50, 100, 200, 400]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "demo/table_stepone/?table="+$('#tablestep1').val(),
                                "type": "POST",
								data: {data_pulication: pulication_load}
                            },
                            "order": []
                        }
                    });
                    var grid2 = new Datatable();
                           // alert( $("#ranking").val());
                    grid2.init({
                        src: $("#data_construction"),
                        loadingMessage: 'Loading...',
                        dataTable: {
                            "dom": "<'row'r>t<'col-md-12 footer'<'col-md-12 col-sm-12'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                           // "processing": true,
                            "serverSide": true,
                            "lengthMenu": [
                                [10, 20, 50, 100, 200, 400],
                                [10, 20, 50, 100,200, 400]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "demo/table_steptwo/?table="+$('#tablestep2').val(),
                                "type": "POST"
                            },
                            "order": []
                        }
                    });
                    
                    var grid3 = new Datatable();
                           // alert( $("#ranking").val());
                    grid3.init({
                        src: $("#methodologies"),
                        loadingMessage: 'Loading...',
                        dataTable: {
                            "dom": "<'row'r>t<'col-md-12 footer'<'col-md-12 col-sm-12'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                          //  "processing": true,
                            "serverSide": true,
                            "lengthMenu": [
                                [10, 20, 50, 100, 200, 400],
                                [10, 20, 50, 100, 200, 400]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "demo/table_stepthree/?table="+$('#tablestep3').val(),
                                "type": "POST",
								data: {data_test: test_load}
                            },
                            "order": []
                        }
                    });
					
					var grid_script = new Datatable();
                           // alert( $("#ranking").val());
                    grid_script.init({
                        src: $("#table_load_script"),
                        loadingMessage: 'Loading...',
                        dataTable: {
                            "dom": "<'row'r>t<'col-md-12 footer'<'col-md-12 col-sm-12'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                          //  "processing": true,
                            "serverSide": true,
                            "lengthMenu": [
                                [10, 20, 50, 100, 200, 400],
                                [10, 20, 50, 100, 200, 400]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "demo/get_body_script?tab=demo_save",
                                "type": "POST"
                            },
                            "order": []
                        }
                    });
                    var form = $('#submit_form');
                    var error = $('.alert-danger', form);
                    var success = $('.alert-success', form); 
                    var displayConfirm = function() {
                        $('#tab4 .form_data_step', form).each(function(){
                            var input = $('[name="'+$(this).attr("data-display")+'"]', form);
                            if (input.is(":radio")) {
                                input = $('[name="'+$(this).attr("data-display")+'"]:checked', form);
                            }
                            if ($(this).attr("data-display") == 'publi') {
                                var publi = [];
                                $('[name="publi[]"]').each(function(){
									publi.push('<tr><td style="width:3%"><input type="checkbox" checked name="publicationcheck[]" data-value ="'+$(this).attr('id')+'" data-title="'+$(this).attr('data-title')+'" /></td><td>'+$(this).attr('id')+'</td></tr>');
                                });
								$(this).html(publi);
                               // $(this).html(publi);
                            }
                            else if ($(this).attr("data-display") == 'resear') {
                                var resear = [];
                                $('[name="resear[]"]').each(function(){
									resear.push('<tr><td style="width:3%"><input type="checkbox" checked name="researchcheck[]"  data-value ="'+$(this).attr('id')+'" data-title="'+$(this).attr('data-title')+'" /></td><td>'+$(this).attr('id')+'</td></tr>');
                                });
                                $(this).html(resear);
                            }
                            else if ($(this).attr("data-display") == 'tes') {
                                var tes = [];
                                $('[name="tes[]"]').each(function(){
									tes.push('<tr><td style="width:3%"><input type="checkbox" checked name="testcheck[]" data-value ="'+$(this).attr('id')+'" data-title="'+$(this).attr('data-title')+'" /></td><td>'+$(this).attr('id')+'</td></tr>');
                                });
                                $(this).html(tes);
                            }
                        });
                    }
                    var handleTitle = function(tab, navigation, index) {
						displayConfirm();
                        var total = navigation.find('li').length;
                        var current = index + 1;
                        // set wizard title
                        $('.step-title', $('#form_wizard_1')).text('Step ' + (index + 1) + ' of ' + total);
                        // set done steps
                        jQuery('li', $('#form_wizard_1')).removeClass("done");
                        var li_list = navigation.find('li');
                        for (var i = 0; i < index; i++) {
                            jQuery(li_list[i]).addClass("done");
                        }
                        if (current == 1) {
                           $('#form_wizard_1').find('.button-previous').hide();
                           $('#form_wizard_1').find('.button-calculator').hide();
                        } else if (current == 4)
                        {
                           // alert(current);
                            $('#form_wizard_1').find('.button-next').hide();
                            $('#form_wizard_1').find('.button-calculator').show();
                        } else {
                            $('#form_wizard_1').find('.button-previous').show();
                            $('#form_wizard_1').find('.button-calculator').hide();
                        }
                        if (current >= total) {
                            $('#form_wizard_1').find('.button-next').hide();
                          //  $('#form_wizard_1').find('.button-submit').show(); 
                        } else if(current == 4){
                            $('#form_wizard_1').find('.button-next').hide();
                        }
                        else {
                            
                            $('#form_wizard_1').find('.button-next').show();
                            $('#form_wizard_1').find('.button-submit').hide();
                            
                        }
                        //Metronic.scrollTo($('.page-title'));
                    }
                    // default form wizard
                    $('#form_wizard_1').bootstrapWizard({
                        'nextSelector': '.button-next',
                        'previousSelector': '.button-previous',
                        onTabClick: function (tab, navigation, index, clickedIndex) {
                          //  return false;
                            
                            success.hide();
                            error.hide();
                         //   if (form.valid() == false) {
//                                return false;
//                            }
                          //alert(clickedIndex);
                            handleTitle(tab, navigation, clickedIndex);
                            
                        },
                        onNext: function (tab, navigation, index) {
                            success.hide();
                            error.hide();
                            //console.log(tab);
                           // if (form.valid() == false) {
//                                return false;
//                            }
                            handleTitle(tab, navigation, index);
                        },
                        onPrevious: function (tab, navigation, index) {
                            success.hide();
                            error.hide();
                            handleTitle(tab, navigation, index);
                        },
                        onTabShow: function (tab, navigation, index) {
                            var total = navigation.find('li').length;
                            var current = index + 1;
                            var $percent = (current / total) * 100;
                            $('#form_wizard_1').find('.progress-bar').css({
                                width: $percent + '%'
                            });
                        }
                    });
                    $('#form_wizard_1').find('.button-submit').hide();
                    $('#form_wizard_1').find('.button-previous').hide();
                    $('#form_wizard_1').find('.button-calculator').hide();
					
                    $('#form_wizard_1 .button-calculator').click(function () {                        
                        var researchcheck = [];
						var researchcheck_value = [];
                        $('[name="researchcheck[]"]:checked').each(function(){
                            researchcheck.push($(this).attr('data-title'));
							researchcheck_value.push($(this).attr('data-value'));
							
                        });
						research_save = researchcheck;
						research_save_value = researchcheck_value;
						 var publicationcheck = [];
						 var publicationcheck_value = [];
						$('[name="publicationcheck[]"]:checked').each(function(){
                            publicationcheck.push($(this).attr('data-title'));
							publicationcheck_value.push($(this).attr('data-value'));
                        });
						pulication_save =publicationcheck;
						pulication_save_value =publicationcheck_value;
						 var testcheck = [];
						 var testcheck_value = [];
						$('[name="testcheck[]"]:checked').each(function(){
                            testcheck.push($(this).attr('data-title'));
							testcheck_value.push($(this).attr('data-value'));
							
                        });
						test_save =testcheck;
						test_save_value =testcheck_value;
                        if(researchcheck.length == 0){
                             $('.status-demo-step').removeClass('display-none');
                             $('.status-demo-step .alert-danger').removeClass('display-none');
                             $('.status-demo-step .alert-danger').removeAttr('style');
                             return false;
                        }else{
    						$('.data_rsfinal_sub').each(function(index){
    							$("#"+$(this).attr('id')).val(researchcheck);
    						});
    						$("#form_rsfinal_wrapper").show();
    						$('.table_wrapper_sub_final').hide();
                            var gridfinal = new Datatable();
                           // alert( $("#ranking").val());
                            gridfinal.init({
                                src: $("#rsfinal"),
                                loadingMessage: 'Loading...',
                                dataTable: {
                                    "dom": "<'row'r>t<'col-md-12 footer'<'col-md-12 col-sm-12'pli>>",
                                    "bStateSave": true,
                                    "retrieve": true,
                                    "serverSide": true,
                                    "lengthMenu": [
                                        [10, 20, 50, 100, 200, 400],
                                        [10, 20, 50, 100, 200, 400]
                                    ],
                                    "pageLength": 10,
                                    "ajax": {
                                        "url": $base_url + "demo/table_final",
                                        "type": "POST",                                     
                                    },
                                    "order": []
                                }
                                
                            });
    						$('.datatable_final').each(function(index){
    							var name = $(this).attr('name');
     							 $("#table_"+name).dataTable().fnDestroy();
    							var gridsub = new Datatable();
    							gridsub.init({
    								src: $("#table_"+name),
    								dataTable: {
    									"dom": "<'row'r>t<'col-md-12 footer'<'col-md-12 col-sm-12'pli>>",
    									"bStateSave": true,
    									"retrieve": true,
    									"lengthMenu": [
    										[10, 20, 50,100, 200, 400],
    										[10, 20, 50,100, 200, 400]
    									],
    									"pageLength": 10,
    									"ajax": {
    										"url": $base_url + "demo/table_sub_final?table_name="+name,
    										"type": "POST",
    										data: {data_rsfinal: researchcheck}
    									},
    									"order": []
    								}
    							});
    						});
                           
                            $('#form_wizard_1').find('.button-next').show();
                            $('.status-demo-step').removeClass('display-none');
                            $('.status-demo-step .alert-success').removeClass('display-none');
                            $('.status-demo-step .alert-success').removeAttr('style');
                            setTimeout(function(){$('#form_wizard_1').find("a[href*='tab5']").trigger('click')},1500); 
						}
                        //gridfinal.draw();
                        //alert('Finished! Hope you like it :)');
                    }).hide();
					
                });
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
    return new demoView;
});