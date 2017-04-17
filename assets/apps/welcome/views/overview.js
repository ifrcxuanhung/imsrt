define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var overviewView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },
            events: {
				"click .exportTxt": "actionExportTxt",
				"click .exportCsv": "actionExportCsv",
				"click .exportXls": "actionExportXls",
            },
			actionExportTxt: function(event) {
				$("#actexport").val('exportTxt');
				$('#form_tab').submit();
            },
			actionExportCsv: function(event) {
				$("#actexport").val('exportCsv');
				$('#form_tab').submit();
            },
			actionExportXls: function(event) {
				$("#actexport").val('exportXls');
				$('#form_tab').submit();
            },
            index: function(){
                  $(document).ready(function() {
                   //begin jqgrid
			// GetClock();
			
				   
          // var form_currency = $('#form_currency').serialize();
		    var filter_get_all = $(".filter_get_all").attr('attr');
		
		 	var jq_table = $(".jq_table").attr('attr');
			var summary_des = $(".jq_table").attr('summary_des');
			var order_by = $(".jq_table").attr('order_by');
			var admin = $(".jq_table").attr('admin');
			
		
			var arr_order_by = order_by.split(' ');
			var order_last = arr_order_by.pop();
			var order_first = arr_order_by.join(' ');
				
			//console.log(arr[0]);
			var column = jQuery.parseJSON($("#column").attr('attr'));// Phai parse json vi no la object
			//console.log(column);
			//var col = [{"label":"Code","name":"code"}];
			//bengin 1
			// phan nay neu dang co nhay thi an nhay di
			
			$.each(column, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"});}} ;
					
				}
				if(this.searchoptions != '' && this.searchoptions != null){
					
					var seops = this.searchoptions.replace('"','');
					if(seops.length == 8){
							this.searchoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat: 'yy-mm-dd',maxDate: new Date(2020, 0, 1),showOn: "focus"});}};	
					//console.log(this.searchoptions);
					}
					else{
						var responseText = this.selectlist.replace('"','').slice(0,-2);
						//this.searchoptions = { value: ":[All];"+ responseText}
						this.searchoptions = { value: ":[All];"+ responseText}
						
							
					
					}
				}
				
				if(this.editrules != '' && this.editrules != null){
					var seops=this.editrules.split(",");
					var obj = [];
					$.each( seops, function( key, value ) {
						var val=value.split(":");
					  obj[val[0]]=val[1];
					});
					//console.log(obj["number"].replace('"',''));
					this.editrules ={
											
							number: (typeof(obj["number"]) === 'undefined' || obj["number"] === null) ? false :((obj["number"].trim())==='true' ? true :false),
							required: (typeof(obj["required"]) === 'undefined' || obj["required"] === null) ? false :((obj["required"].trim())=='true' ?true:false),
							edithidden: (typeof(obj["edithidden"]) === 'undefined' || obj["edithidden"] === null) ? false :((obj["edithidden"].trim())=='true' ?true:false) 
						}
					//console.log(this.editrules);
						
				}
				if(this.editable=='true'){
					this.editable = true;	
				}
				if(this.hidden=='true'){
					this.hidden = true;	
				}
				if(this.editable=='false'){
					this.editable = false;	
				}
				
				if(this.key=='true'){
					this.key = true;	
				}
				else if(this.key=='false'){
					this.key = false;	
				}
				if(this.headertitles==''){
					this.headertitles = true;
				}
				if((this.formatter=='') || (this.formatter==null)){
					this.formatter = nullFormatter;
				}
				else if(this.formatter=='link'){
					this.formatter = formatLink;
				}
				
				if(this.cellattr == ''){
					this.cellattr = function (rowId, tv, rawObject, cm, rdata) { return 'style="white-space: normal;"' };
				}
				
			  });
			// end 1
			// neu la admin moi duoc quyen sua tren tung dong
			if(admin == 1){
				var edit_row = editRow;	
				var admin_per = true;
			}
			else{
				var edit_row='';
				var admin_per = false;	
			}
			
            $("#jqGrid").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'overview/jq_loadtable',
				editurl: $base_url+'overview/edit_del_add_overview?jq_table='+jq_table,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table:jq_table,filter_get_all:filter_get_all},
                page: 1,
                colModel:column,
				//loadonce: true,
				loadtext: "Loadding...",
				//onSelectRow: edit_row,
				viewrecords: true,
				//multiSort: true,
				//sortname: arr_order_by[0],
               // sortorder: arr_order_by[1],
				sortname: order_first,
               	sortorder: order_last,
				
               	//width:1250,
			   autowidth: true,
			  // width: null,
				//shrinkToFit: false,
             	//gridview    :   true,
				//autoheight: true, // muon cuon xuong load them thi tat dong nay di va bat height o duoi len
                height:"100%", // co the de % de fix chieu cao auto
                rowNum: 10,
				//rownumbers: true, 
                pager: "#jqGridPager",
				caption: summary_des,// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				//multiselect: true
				 //recordpos: 'left',
			  loadComplete: function(){
				  
				 
					// format number cho compare
					function addCommas(nStr)
					{
						nStr += '';
						var x = nStr.split('.');
						var x1 = x[0];
						var x2 = x.length > 1 ? '.' + x[1] : '';
						var rgx = /(\d+)(\d{3})/;
						while (rgx.test(x1)) {
							x1 = x1.replace(rgx, '$1' + ',' + '$2');
						}
						return x1 + x2;
					}
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("tr.jqgrow:odd").addClass('myAltRowClass');
					$(".ui-state-active").removeClass('loading');
					
					var ids = $("#jqGrid").jqGrid('getDataIDs');
					for(var i = 0; i<ids.length;i++){
						var rowId = ids[i];
						var rowData = $("#jqGrid").jqGrid('getRowData',rowId);
						
						$.each(rowData, function(key, value) {
							//console.log(key);
							// style font
						   $.each(column, function() {
								if(this.style == 'bold'){
								 $('[aria-describedby="jqGrid_'+this.name+'"]').addClass('bold');
								}
								else if(this.style == 'italic'){
								 $('[aria-describedby="jqGrid_'+this.name+'"]').addClass('italic');
								}
								else if(this.style == 'underline'){
								 $('[aria-describedby="jqGrid_'+this.name+'"]').addClass('underline');
								}
							});
							 //end style font
							 
							if(parseFloat(value) > 0 ){
							   $.each(column, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('positive'); 
										$('[aria-describedby="jqGrid_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('positive');
									}
									
									
							   });
							}else if(parseFloat(value) < 0){
								 $.each(column, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('negative'); 
										
										$('[aria-describedby="jqGrid_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('negative');
										
									}
								 });
							}
							else{
								
								 $.each(column, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('equal'); 
									
										$('[aria-describedby="jqGrid_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('equal');
									}
								 });
							}
						});
						
						
						
					}
					$.each(column, function() {
						
						$("#jqgh_jqGrid_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
				},// gan class chan le cho tung dong
				
				 
            });
			
			//r = n.toFixed(2); //10000.00
			
			//addCommas(r); // 10,000.00
			
			// cu 1s refesh 1 lan
			setInterval( function () { 
				$("#jqGrid").trigger("reloadGrid");
		   }, 2000 );
			//Set null convert empty
			var nullFormatter = function(cellvalue, options, rowObject) {
				if(cellvalue === undefined || isNull(cellvalue)) {
					cellvalue = 'NULL';
				}
				return cellvalue;
			}
			function formatLink(cellValue, options, rowObject) {
                return "<a href='"+$base_url+"indice/" + cellValue + "' class='link_overview'>" + cellValue.substring(0, 25) + "</a>";
            };
			
			
			 var lastSelection;

            function editRow(id) {
                if (id && id !== lastSelection) {
                    var grid = $("#jqGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, {keys:true, focusField: 4});
                    lastSelection = id;
                }
            }
			/*function buildSearchSelect(name){
				
                return $.ajax({
                    url: $base_url + "overview/getSelected",
                    type: "POST",
                    data: {name:name},
                    async: false,
                  
                });
				var a = result;//"ALFKI:ALFKI;ANATR:ANATR;ANTON:ANTON";
				console.log(a);
			}*/
			
			// activate the toolbar searching
            $('#jqGrid').jqGrid('filterToolbar');
			$('#jqGrid').jqGrid('navGrid',"#jqGridPager", {                
                search: false, // show search button on the toolbar
                add: false,//admin_per
                edit: false,//admin_per
                del: false,//admin_per
                refresh: true
            },
			{ closeAfterEdit: true ,}// Dong form edit sau khi sua
			);
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
        return new overviewView;
});// JavaScript Document