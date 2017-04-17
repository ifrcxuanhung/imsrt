define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var jq_loadtableView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },
            events: {
            },
            index: function(){
                  $(document).ready(function() {
                   //begin jqgrid
				 
				   
			
          // var form_currency = $('#form_currency').serialize();
		   var filter_get_all = $(".filter_get_all").attr('attr');
		  
		  // console.log(filter_get_all);
		 	var jq_table = $(".jq_table").attr('attr');
			var column = jQuery.parseJSON($("#column").attr('attr'));// Phai parse json vi no la object
			//var col = [{"label":"Code","name":"code"}];
			//bengin 1
			// phan nay neu dang co nhay thi an nhay di
			
			$.each(column, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "0.0000" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"});}} ;
					
				}
				if(this.searchoptions != '' && this.searchoptions != null){
					
					var seops = this.searchoptions.replace('"','');
					this.searchoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat: seops,maxDate: new Date(2020, 0, 1),showOn: "focus"});}};	
				}
				if(this.editrules != '' && this.editrules != null){
<<<<<<< .mine
				
					//var cutarray=this.editrules.split(",");
					//var result = cutarray.toString();
					//console.log($.parseJSON(this.editrules));
					//this.editrules = result;
=======
					var seops=this.editrules.split(",");
					var obj = [];
					$.each( seops, function( key, value ) {
						var val=value.split(":");
					  obj[val[0]]=val[1];
					});
					//console.log(obj["number"].replace('"',''));
					this.editrules ={							
							number: (obj["number"] === 'undefined') ? false :((obj["number"].trim())==='true' ? true :false),
							required: (obj["required"] === 'undefined') ? false :((obj["required"].trim())=='true' ?true:false) 
						}
>>>>>>> .r938
						
				}
			
				if(this.editable=='true'){
					this.editable = true;	
				}
				if(this.editable=='false'){
					this.editable = false;	
				}
				
				if(this.key=='true'){
					this.key = true;	
				}
				if(this.key=='false'){
					this.key = false;	
				}
			  });
			  
			// end 1
			//console.log(column);
            $("#jqGrid").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadtable',
				editurl: $base_url+'ajax/edit_del_add_jq_loadtable?jq_table='+jq_table,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table:jq_table,filter_get_all:filter_get_all},
                page: 1,
                colModel:column,
				//loadonce: true,
				//onSelectRow: editRow,
				viewrecords: true,
               // width: 1320,
			    autowidth: true,
             
				//autoheight: true,
              	height:"100%",
                rowNum: 20,
				rownumbers: true, 
                pager: "#jqGridPager",
				caption: jq_table,// hien tren title
				//scroll: 1,
				//multiselect: true
            });
			
			 var lastSelection;

            function editRow(id) {
                if (id && id !== lastSelection) {
                    var grid = $("#jqGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, {keys:true, focusField: 4});
                    lastSelection = id;
                }
            }
			
			// activate the toolbar searching
            $('#jqGrid').jqGrid('filterToolbar');
			$('#jqGrid').jqGrid('navGrid',"#jqGridPager", {                
                search: false, // show search button on the toolbar
                add: true,
                edit: true,
                del: true,
                refresh: true
            });
			
			
			// gan lai cho filter phia duoi
			/*var code = $('#filter_code').val();
			$('#gs_code').val(code);
			var date = $('#filter_date').val();
			$('#gs_date').val(date);
			var closes = $('#filter_close').val();
			$('#gs_close').val(closes);
			var cur_from = $('#filter_cur_from').val();
			$('#gs_cur_from').val(cur_from);
			var cur_to = $('#filter_cur_to').val();
			$('#gs_cur_to').val(cur_to);*/

        
        
				   
				   
				   // end jqgrid
				   
                   
                });   
                      
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new jq_loadtableView;
});// JavaScript Document