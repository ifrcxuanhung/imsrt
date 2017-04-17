define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var jq_compareView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },
            events: {
				"click .exportTxt": "actionExportTxt",
				"click .exportCsv": "actionExportCsv",
				"click .exportXls": "actionExportXls",
				
				"click .exportTxt2": "actionExportTxt2",
				"click .exportCsv2": "actionExportCsv2",
				"click .exportXls2": "actionExportXls2",
				
				"click .exportTxt3": "actionExportTxt3",
				"click .exportCsv3": "actionExportCsv3",
				"click .exportXls3": "actionExportXls3",
				
				"click .exportTxt4": "actionExportTxt4",
				"click .exportCsv4": "actionExportCsv4",
				"click .exportXls4": "actionExportXls4",
				"click #specsVND": "actionSpecsVND"
				
				
            },
			actionSpecsVND: function(event) {
				var $this = $(event.currentTarget);
				if( $($this).is(":checked")) {
					$curr_specs = 'VND';
					
			   }
			   else {
				   $curr_specs ='';
			   }
			   $.ajax({
                    url: $base_url + "ajax/curr_specs_close",
                    type: "POST",
                    data: {curr_specs:$curr_specs},
                    async: false,
                    success: function(response) {
                        $("#jqGrid2").trigger("reloadGrid");
						$("#jqGrid4").trigger("reloadGrid");
				
                    }
                });				
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
			
			actionExportTxt2: function(event) {
				$("#actexport2").val('exportTxt2');
				$('#form_tab2').submit();
            },
			actionExportCsv2: function(event) {
				$("#actexport2").val('exportCsv2');
				$('#form_tab2').submit();
            },
			actionExportXls2: function(event) {
				$("#actexport2").val('exportXls2');
				$('#form_tab2').submit();
            },
			
			actionExportTxt3: function(event) {
				$("#actexport3").val('exportTxt3');
				$('#form_tab3').submit();
            },
			actionExportCsv3: function(event) {
				$("#actexport3").val('exportCsv3');
				$('#form_tab3').submit();
            },
			actionExportXls3: function(event) {
				$("#actexport3").val('exportXls3');
				$('#form_tab3').submit();
            },
			
			actionExportTxt4: function(event) {
				$("#actexport4").val('exportTxt4');
				$('#form_tab4').submit();
            },
			actionExportCsv4: function(event) {
				$("#actexport4").val('exportCsv4');
				$('#form_tab4').submit();
            },
			actionExportXls4: function(event) {
				$("#actexport4").val('exportXls4');
				$('#form_tab4').submit();
            },
			
            index: function(){
                  $(document).ready(function() {
                   //begin jqgrid
				 
				   
          // var form_currency = $('#form_currency').serialize();
		   var filter_get_all = $(".filter_get_all").attr('attr');
		
		 	var jq_table = $(".jq_table").attr('attr');
			var jq_table2 = $(".jq_table2").attr('attr');
			var jq_table3 = $(".jq_table3").attr('attr');
			var jq_table4 = $(".jq_table4").attr('attr');
			
			
			var summary_des = $(".jq_table").attr('summary_des');
			var summary_des2 = $(".jq_table2").attr('summary_des2');
			var summary_des3 = $(".jq_table3").attr('summary_des3');
			var summary_des4 = $(".jq_table4").attr('summary_des4');
			
				
			var order_by = $(".jq_table").attr('order_by');
			var admin = $(".jq_table").attr('admin');
			var order_by2 = $(".jq_table2").attr('order_by');
			var admin2 = $(".jq_table2").attr('admin');
			var order_by3 = $(".jq_table3").attr('order_by');
			var admin3 = $(".jq_table3").attr('admin');
			var order_by4 = $(".jq_table4").attr('order_by');
			var admin4 = $(".jq_table4").attr('admin');
			
		
			var arr_order_by = order_by.split(' ');
			var order_last = arr_order_by.pop();
			var order_first = arr_order_by.join(' ');
			
			var arr_order_by2 = order_by2.split(' ');
			var order_last2 = arr_order_by2.pop();
			var order_first2 = arr_order_by2.join(' ');
			
			var arr_order_by3 = order_by3.split(' ');
			var order_last3 = arr_order_by3.pop();
			var order_first3 = arr_order_by3.join(' ');
			
			var arr_order_by4 = order_by4.split(' ');
			var order_last4 = arr_order_by4.pop();
			var order_first4 = arr_order_by4.join(' ');
				
			//console.log(arr[0]);
			var column = jQuery.parseJSON($("#column").attr('attr'));// Phai parse json vi no la object
			var column2 = jQuery.parseJSON($("#column2").attr('attr'));// Phai parse json vi no la object
			var column3 = jQuery.parseJSON($("#column3").attr('attr'));// Phai parse json vi no la object
			var column4 = jQuery.parseJSON($("#column4").attr('attr'));// Phai parse json vi no la object
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
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:50} ;
					
				}
				else{	
					this.editoptions = {size:50};
				}
				if(this.searchoptions != '' && this.searchoptions != null){
					
					var seops = this.searchoptions.replace('"','');
					if(seops.length == 8){
							this.searchoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat: 'yy-mm-dd',maxDate: new Date(2020, 0, 1),showOn: "focus"});}};	
					//console.log(this.searchoptions);
					}
					else{
						//var selectoption = buildSearchSelect(this.name,jq_table);
						//var responseText = selectoption.responseText.replace('"','').slice(0,-2);
						
						var responseText = this.selectlist.replace('"','').slice(0,-2);
						
						//this.searchoptions = { value: ":[All];"+ responseText}
						if(responseText){
							this.searchoptions = { value: ":[All];"+ responseText}
						}
						else{
							this.searchoptions = {}
						}
						
							
					
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
				if(this.key=='false'){
					this.key = false;	
				}
				if(this.headertitles==''){
					this.headertitles = true;
				}
				//console.log(this.formatter);
				if((this.formatter=='') || (this.formatter==null)){
					this.formatter = nullFormatter;
				}
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				else if(this.formatter=='link_default'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLinkDefault;
				}
				else if(this.formatter=='link'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink;
				}
				else if(this.formatter=='link1'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink1;
				}
				
				if(this.cellattr == ''){
					this.cellattr = function (rowId, tv, rawObject, cm, rdata) { return 'style="white-space: normal;"' };
				}
				
			  });
			// end 1
			
			
			$.each(column2, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:50} ;
					
				}
				else{	
					this.editoptions = {size:50};
				}
				if(this.searchoptions != '' && this.searchoptions != null){
					
					var seops = this.searchoptions.replace('"','');
					if(seops.length == 8){
							this.searchoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat: 'yy-mm-dd',maxDate: new Date(2020, 0, 1),showOn: "focus"});}};	
					//console.log(this.searchoptions);
					}
					else{
						//var selectoption = buildSearchSelect(this.name,jq_table);
						//var responseText = selectoption.responseText.replace('"','').slice(0,-2);
						
						var responseText = this.selectlist.replace('"','').slice(0,-2);
						
						//this.searchoptions = { value: ":[All];"+ responseText}
						if(responseText){
							this.searchoptions = { value: ":[All];"+ responseText}
						}
						else{
							this.searchoptions = {}
						}
						
							
					
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
				if(this.key=='false'){
					this.key = false;	
				}
				if(this.headertitles==''){
					this.headertitles = true;
				}
				//console.log(this.formatter);
				if((this.formatter=='') || (this.formatter==null)){
					this.formatter = nullFormatter;
				}
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				else if(this.formatter=='link_default'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLinkDefault;
				}
				else if(this.formatter=='link'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink;
				}
				else if(this.formatter=='link1'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink1;
				}
				
				if(this.cellattr == ''){
					this.cellattr = function (rowId, tv, rawObject, cm, rdata) { return 'style="white-space: normal;"' };
				}
				
			  });
			// end 2
			
			$.each(column3, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:50} ;
					
				}
				else{	
					this.editoptions = {size:50};
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
						if(responseText){
							this.searchoptions = { value: ":[All];"+ responseText}
						}
						else{
							this.searchoptions = {}
						}
						
							
					
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
				if(this.key=='false'){
					this.key = false;	
				}
				if(this.headertitles==''){
					this.headertitles = true;
				}
				if((this.formatter=='') || (this.formatter==null)){
					this.formatter = nullFormatter;
				}
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				else if(this.formatter=='link_default'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLinkDefault;
				}
				else if(this.formatter=='link'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink;
				}
				else if(this.formatter=='link1'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink1;
				}
				
				if(this.cellattr == ''){
					this.cellattr = function (rowId, tv, rawObject, cm, rdata) { return 'style="white-space: normal;"' };
				}
				
				
			  });
			// end 3
			
			$.each(column4, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:50} ;
					
				}
				else{	
					this.editoptions = {size:50};
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
						if(responseText){
							this.searchoptions = { value: ":[All];"+ responseText}
						}
						else{
							this.searchoptions = {}
						}
						
							
					
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
				if(this.key=='false'){
					this.key = false;	
				}
				if(this.headertitles==''){
					this.headertitles = true;
				}
				if((this.formatter=='') || (this.formatter==null)){
					this.formatter = nullFormatter;
				}
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				else if(this.formatter=='link_default'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLinkDefault;
				}
				else if(this.formatter=='link'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink;
				}
				else if(this.formatter=='link1'){
					this.format_notedit = 'not_edit';
					this.formatter = formatLink1;
				}
				
				if(this.cellattr == ''){
					this.cellattr = function (rowId, tv, rawObject, cm, rdata) { return 'style="white-space: normal;"' };
				}
				
				
			  });
			// end 4
			
			
			
			// neu la admin moi duoc quyen sua tren tung dong
			if(admin >= 8){
				var edit_row = editRow;	
				var admin_per = true;
			}
			else{
				var edit_row='';
				var admin_per = false;	
			}
			
			if(admin2 >= 8){
				var edit_row2 = editRow2;	
				var admin_per2 = true;
			}
			else{
				var edit_row2='';
				var admin_per2 = false;	
			}
			
			if(admin3 >= 8){
				var edit_row3 = editRow3;	
				var admin_per3 = true;
			}
			else{
				var edit_row3='';
				var admin_per3 = false;	
			}
			
			if(admin4 >= 8){
				var edit_row4 = editRow4;	
				var admin_per4 = true;
			}
			else{
				var edit_row4='';
				var admin_per4 = false;	
			}
			
            $("#jqGrid").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_compare_composition',
				editurl: $base_url+'jq_compare/edit_del_add_jq_compare?jq_table='+jq_table,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table:jq_table,filter_get_all:filter_get_all},
                page: 1,
                colModel:column,
				//loadonce: true,
				loadtext: "Loading...",
				onSelectRow: edit_row,
				//subGrid: true,
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
				 hiddengrid: true,
			  loadComplete: function() {
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("tr.jqgrow:odd").addClass('myAltRowClass');
					$(".ui-icon-locked").parent().addClass("dis_none");
					$("#edit_jqGrid").hide();
					$("#del_jqGrid").hide();
					$("#add_jqGrid").hide();
				
					//begin
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
					
					var ids = $("#jqGrid").jqGrid('getDataIDs');
				
					for(var i = 0; i<ids.length;i++){
						var rowId = ids[i];
						var rowData = $("#jqGrid").jqGrid('getRowData',rowId);
						$.each(rowData, function(key, value) {
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
					////end
					
					
					$.each(column, function() {
						$("#jqgh_jqGrid_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
				},// gan class chan le cho tung dong
				
				 
            });
			
			 $("#jqGrid2").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_compare_specs',
				editurl: $base_url+'jq_compare/edit_del_add_jq_compare?jq_table='+jq_table2,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table2:jq_table2,filter_get_all:filter_get_all},
                page: 1,
                colModel:column2,
				//loadonce: true,
				loadtext: "Loading...",
				onSelectRow: edit_row2,
				//subGrid: true,
				viewrecords: true,
				//multiSort: true,
				//sortname: arr_order_by[0],
               // sortorder: arr_order_by[1],
				sortname: order_first2,
               	sortorder: order_last2,
				
               	//width:1250,
			   autowidth: true,
			  // width: null,
				//shrinkToFit: false,
             	//gridview    :   true,
				//autoheight: true, // muon cuon xuong load them thi tat dong nay di va bat height o duoi len
                height:"100%", // co the de % de fix chieu cao auto
                rowNum: 10,
				//rownumbers: true, 
                pager: "#jqGridPager2",
				caption: summary_des2,// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				//multiselect: true
				 //recordpos: 'left',
				 hiddengrid: true,
			  loadComplete: function() {
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("tr.jqgrow:odd").addClass('myAltRowClass');
					$(".ui-icon-locked").parent().addClass("dis_none");
					$("#edit_jqGrid2").hide();
					$("#del_jqGrid2").hide();
					$("#add_jqGrid2").hide();
				
					//begin
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
					
					var ids = $("#jqGrid2").jqGrid('getDataIDs');
				
					for(var i = 0; i<ids.length;i++){
						var rowId = ids[i];
						var rowData = $("#jqGrid2").jqGrid('getRowData',rowId);
						$.each(rowData, function(key, value) {
							// style font
						   $.each(column2, function() {
								if(this.style == 'bold'){
								 $('[aria-describedby="jqGrid2_'+this.name+'"]').addClass('bold');
								}
								else if(this.style == 'italic'){
								 $('[aria-describedby="jqGrid2_'+this.name+'"]').addClass('italic');
								}
								else if(this.style == 'underline'){
								 $('[aria-describedby="jqGrid2_'+this.name+'"]').addClass('underline');
								}
							 
							});
							 //end style font
						   if(parseFloat(value) > 0 ){
							   $.each(column2, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('positive'); 
										$('[aria-describedby="jqGrid2_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('positive');
									}
									
									
							   });
							}else if(parseFloat(value) < 0){
								 $.each(column2, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('negative'); 
										
										$('[aria-describedby="jqGrid2_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('negative');
										
									}
								 });
							}
							else{
								 $.each(column2, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('equal'); 
									
										$('[aria-describedby="jqGrid2_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('equal');
									}
								 });
							}
						 
						 });	
					}
					////end
					
					
					$.each(column2, function() {
						$("#jqgh_jqGrid2_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid2_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
				},// gan class chan le cho tung dong
				
				 
            });
			
			$("#jqGrid3").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadtop_composition',
				editurl: $base_url+'ajax/edit_del_add_jq_loadtable?jq_table='+jq_table3,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table3:jq_table3,filter_get_all:filter_get_all},
                page: 1,
                colModel:column3,
				//loadonce: true,
				loadtext: "Loading...",
				onSelectRow: edit_row3,
				viewrecords: true,
				//multiSort: true,
				//sortname: arr_order_by[0],
               // sortorder: arr_order_by[1],
				sortname: order_first3,
               	sortorder: order_last3,
				
               	//width:1250,
			   autowidth: true,
			  // width: null,
				//shrinkToFit: false,
             	//gridview    :   true,
				//autoheight: true, // muon cuon xuong load them thi tat dong nay di va bat height o duoi len
                height:"100%", // co the de % de fix chieu cao auto
                rowNum: 10,
				//rownumbers: true, 
                pager: "#jqGridPager3",
				caption: summary_des3,// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				//multiselect: true
				 //recordpos: 'left',
				// hiddengrid: true,
			  loadComplete: function() {
				  
				 
					
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("tr.jqgrow:odd").addClass('myAltRowClass');
					$("#locked_3").children().addClass("dis_none");
					$("#edit_jqGrid3").hide();
					$("#del_jqGrid3").hide();
					$("#add_jqGrid3").hide();
					//begin
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
					
					var ids = $("#jqGrid3").jqGrid('getDataIDs');
				
					for(var i = 0; i<ids.length;i++){
						var rowId = ids[i];
						var rowData = $("#jqGrid3").jqGrid('getRowData',rowId);
						$.each(rowData, function(key, value) {
							
							// style font
						   $.each(column3, function() {
							if(this.style == 'bold'){
							 $('[aria-describedby="jqGrid3_'+this.name+'"]').addClass('bold');
							}
							else if(this.style == 'italic'){
							 $('[aria-describedby="jqGrid3_'+this.name+'"]').addClass('italic');
							}
							else if(this.style == 'underline'){
							 $('[aria-describedby="jqGrid3_'+this.name+'"]').addClass('underline');
							}
							
							 
							});
							 //end style font
							  
						   if(parseFloat(value) > 0 ){
							   $.each(column3, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('negative'); 
										$('[aria-describedby="jqGrid3_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('positive');
									}
							   });
							}else if(parseFloat(value) < 0){
								 $.each(column3, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('positive');
										$('[aria-describedby="jqGrid3_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('negative'); 
									}
							   });
							}
							else{
								 $.each(column3, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('equal'); 
										$('[aria-describedby="jqGrid3_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('equal'); 
									}
								 });
							}
						 
						 });	
					}
					////end
					
					$.each(column3, function() {
						$("#jqgh_jqGrid3_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid3_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
				},// gan class chan le cho tung dong
				
				 
            });
			
			
			$("#jqGrid4").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadtop_specs',
				editurl: $base_url+'ajax/edit_del_add_jq_loadtable?jq_table='+jq_table4,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table4:jq_table4,filter_get_all:filter_get_all},
                page: 1,
                colModel:column4,
				//loadonce: true,
				loadtext: "Loading...",
				onSelectRow: edit_row4,
				viewrecords: true,
				//multiSort: true,
				//sortname: arr_order_by[0],
               // sortorder: arr_order_by[1],
				sortname: order_first4,
               	sortorder: order_last4,
				
               	//width:1250,
			   autowidth: true,
			  // width: null,
				//shrinkToFit: false,
             	//gridview    :   true,
				//autoheight: true, // muon cuon xuong load them thi tat dong nay di va bat height o duoi len
                height:"100%", // co the de % de fix chieu cao auto
                rowNum: 10,
				//rownumbers: true, 
                pager: "#jqGridPager4",
				caption: summary_des4,// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				//multiselect: true
				 //recordpos: 'left',
				// hiddengrid: true,
			  loadComplete: function() {
				  
				 
					
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("tr.jqgrow:odd").addClass('myAltRowClass');
					$("#locked_4").children().addClass("dis_none");
					$("#edit_jqGrid4").hide();
					$("#del_jqGrid4").hide();
					$("#add_jqGrid4").hide();
					//begin
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
					
					var ids = $("#jqGrid4").jqGrid('getDataIDs');
				
					for(var i = 0; i<ids.length;i++){
						var rowId = ids[i];
						var rowData = $("#jqGrid4").jqGrid('getRowData',rowId);
						$.each(rowData, function(key, value) {
							
							// style font
						   $.each(column4, function() {
							if(this.style == 'bold'){
							 $('[aria-describedby="jqGrid4_'+this.name+'"]').addClass('bold');
							}
							else if(this.style == 'italic'){
							 $('[aria-describedby="jqGrid4_'+this.name+'"]').addClass('italic');
							}
							else if(this.style == 'underline'){
							 $('[aria-describedby="jqGrid4_'+this.name+'"]').addClass('underline');
							}
							
							 
							});
							 //end style font
							  
						   if(parseFloat(value) > 0 ){
							   $.each(column4, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('negative'); 
										$('[aria-describedby="jqGrid4_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('positive');
									}
							   });
							}else if(parseFloat(value) < 0){
								 $.each(column3, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('positive');
										$('[aria-describedby="jqGrid4_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('negative'); 
									}
							   });
							}
							else{
								 $.each(column4, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('equal'); 
										$('[aria-describedby="jqGrid4_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('equal'); 
									}
								 });
							}
						 
						 });	
					}
					////end
					
					$.each(column4, function() {
						$("#jqgh_jqGrid4_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid4_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
				},// gan class chan le cho tung dong
				
				 
            });
			
			
			
			
			//Set null convert empty
			var nullFormatter = function(cellvalue, options, rowObject) {
				if(cellvalue === undefined || isNull(cellvalue)) {
					cellvalue = 'NULL';
				}
				return cellvalue;
			}
			function formatLinkDefault(cellValue, options, rowObject) {
                return "<a href='"+$base_url+"jq_compare/" + cellValue + "' class='link_overview'>" + cellValue.substring(0, 25) + "</a>";
            };
			function formatLink(cellValue, options, rowObject) {
                return "<a href='"+$base_url+"indice/" + cellValue + "' class='link_overview'>" + cellValue.substring(0, 25) + "</a>";
            };
			function formatLink1(cellValue, options, rowObject) {
                return "<a href='"+$base_url+"stock/" + cellValue + "' class='link_overview'>" + cellValue.substring(0, 25) + "</a>";
            };
			
			/*function displayButtons(cellvalue, options, rowObject)
			{
				var edit = "<input style='...' type='button' value='Edit' onclick=\"$('#jqGrid').editRow('" + options.rowId + "');\"  />", 
					 save = "<input style='...' type='button' value='Save' onclick=\"$('#jqGrid').saveRow('" + options.rowId + "');\"  />", 
					 restore = "<input style='...' type='button' value='Restore' onclick=\"$('#jqGrid').restoreRow('" + options.rowId + "');\" />";
				return edit+save+restore;
			}*/
			
			
			 var lastSelection;
			  var lastSelection2;
			  var lastSelection3;
			  var lastSelection4;
			  
			
            function editRow(id) {
                //if (id && id !== lastSelection) {
                    var grid = $("#jqGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, {keys:true, focusField: 4});
                    lastSelection = id;
                //}
            }
			
			function editRow2(id2) {
               // if (id2 && id2 !== lastSelection2) {
                    var grid = $("#jqGrid2");
                    grid.jqGrid('restoreRow',lastSelection2);
                    grid.jqGrid('editRow',id2, {keys:true, focusField: 4});
                    lastSelection2 = id2;
               // }
            }
			function editRow3(id3) {
               // if (id3 && id3 !== lastSelection3) {
                    var grid = $("#jqGrid3");
                    grid.jqGrid('restoreRow',lastSelection3);
                    grid.jqGrid('editRow',id3, {keys:true, focusField: 4});
                    lastSelection3 = id3;
               // }
            }
			function editRow4(id4) {
               // if (id4 && id4 !== lastSelection4) {
                    var grid = $("#jqGrid4");
                    grid.jqGrid('restoreRow',lastSelection4);
                    grid.jqGrid('editRow',id4, {keys:true, focusField: 4});
                    lastSelection4 = id4;
               // }
            }
			/*	function buildSearchSelect(name,table){
			
                return $.ajax({
                    url: $base_url + "ajax/getSelected",
                    type: "POST",
                    data: {name:name,table:table},
                    async: false,
                  
                });
				var a = result;//"ALFKI:ALFKI;ANATR:ANATR;ANTON:ANTON";
				console.log(a);
			}*/
			
			
			// activate the toolbar searching
            $('#jqGrid').jqGrid('filterToolbar');
			
				$('#jqGrid').jqGrid('navGrid',"#jqGridPager", {                
                search: false, // show search button on the toolbar
                //add: admin_per,
                //edit: admin_per,
                //del: admin_per,
                refresh: true,
				
				
            },/*{
				 top:0,
				 left:180,
				 width:1000,
			},*/{ 
					closeAfterEdit: true,
				},// Dong form edit sau khi sua
				{closeAfterAdd:true}
			);
			
			
			$('#jqGrid2').jqGrid('filterToolbar');
			
			
			
			$('#jqGrid2').jqGrid('navGrid',"#jqGridPager2", {                
                search: false, // show search button on the toolbar
                //add: admin_per,
                //edit: admin_per,
                //del: admin_per,
                refresh: true,
				
				
            },/*{
				 top:0,
				 left:180,
				 width:1000,
			},*/{ 
					closeAfterEdit: true,
				},// Dong form edit sau khi sua
				{closeAfterAdd:true}
			);
			
			$('#jqGrid3').jqGrid('filterToolbar');
			$('#jqGrid3').jqGrid('navGrid',"#jqGridPager3", {                
                search: false, // show search button on the toolbar
                add: admin_per3,
                edit: admin_per3,
                del: admin_per3,
                refresh: true
            },
			{ closeAfterEdit: true ,}// Dong form edit sau khi sua
			);
			
			$('#jqGrid3').jqGrid('navButtonAdd',"#jqGridPager3",
				{caption:"Disable edit",
				title:"Disable edit",
				buttonicon :'ui-icon-locked',
				id:'locked_3',
				onClickButton:function(){
					$.each(column3, function() {
						$('#jqGrid3').jqGrid("setColProp", this.name, {editable: false});
						
					});
					$("#locked_3").children().hide();
					$("#jqGrid3").trigger('reloadGrid');
					$("#edit_jqGrid3").hide();
					$("#del_jqGrid3").hide();
					$("#add_jqGrid3").hide();
					$("#unlocked_3").children().show();
					 
				}}
			);
			$('#jqGrid3').jqGrid('navButtonAdd',"#jqGridPager3",
				{caption:"Enable edit",
				title:"Enable edit",
				buttonicon :'ui-icon-unlocked',
				id:'unlocked_3',
				onClickButton:function(){
					$.each(column3, function() {
						if(this.format_notedit == "not_edit"){	
							$('#jqGrid3').jqGrid("setColProp", this.name, {editable: false});	
						}
						else{
							$('#jqGrid3').jqGrid("setColProp", this.name, {editable: true});
						}
						$("#unlocked_3").children().hide();
						//$("#jqGrid3").trigger("reloadGrid");
						$("#edit_jqGrid3").show();
						$("#del_jqGrid3").show();
						$("#add_jqGrid3").show();
						$("#locked_3").children().show();
						
					});
				}}
			);
			
			$('#jqGrid4').jqGrid('filterToolbar');
			$('#jqGrid4').jqGrid('navGrid',"#jqGridPager4", {                
                search: false, // show search button on the toolbar
                add: admin_per4,
                edit: admin_per4,
                del: admin_per4,
                refresh: true
            },
			{ closeAfterEdit: true ,}// Dong form edit sau khi sua
			);
			
			$('#jqGrid4').jqGrid('navButtonAdd',"#jqGridPager4",
				{caption:"Disable edit",
				title:"Disable edit",
				buttonicon :'ui-icon-locked',
				id:'locked_4',
				onClickButton:function(){
					$.each(column4, function() {
						$('#jqGrid4').jqGrid("setColProp", this.name, {editable: false});
						
					});
					$("#locked_4").children().hide();
					$("#jqGrid4").trigger('reloadGrid');
					$("#edit_jqGrid4").hide();
					$("#del_jqGrid4").hide();
					$("#add_jqGrid4").hide();
					$("#unlocked_4").children().show();
					 
				}}
			);
			$('#jqGrid4').jqGrid('navButtonAdd',"#jqGridPager4",
				{caption:"Enable edit",
				title:"Enable edit",
				buttonicon :'ui-icon-unlocked',
				id:'unlocked_4',
				onClickButton:function(){
					$.each(column4, function() {
						if(this.format_notedit == "not_edit"){	
							$('#jqGrid4').jqGrid("setColProp", this.name, {editable: false});	
						}
						else{
							$('#jqGrid4').jqGrid("setColProp", this.name, {editable: true});
						}
						$("#unlocked_4").children().hide();
						//$("#jqGrid3").trigger("reloadGrid");
						$("#edit_jqGrid4").show();
						$("#del_jqGrid4").show();
						$("#add_jqGrid4").show();
						$("#locked_4").children().show();
						
					});
				}}
			);
			
		
			// Click disable will not edit inline 
			
			/*$('#jqGrid').jqGrid('navButtonAdd',"#jqGridPager",
				{caption:"Disable edit",
				title:"Disable edit",
				buttonicon :'ui-icon-locked',
				onClickButton:function(){
					$.each(column, function() {
						$('#jqGrid').jqGrid("setColProp", this.name, {editable: false});
						
					});
					
					$(".ui-icon-locked").parent().hide();
					$("#jqGrid").trigger('reloadGrid');
					$("#edit_jqGrid").hide();
					$("#del_jqGrid").hide();
					$("#add_jqGrid").hide();
					$(".ui-icon-unlocked").parent().show();
					 
				}}
			);
			$('#jqGrid').jqGrid('navButtonAdd',"#jqGridPager",
				{caption:"Enable edit",
				title:"Enable edit",
				buttonicon :'ui-icon-unlocked',
				onClickButton:function(){
					$.each(column, function() {
						if(this.format_notedit == "not_edit"){	
							$('#jqGrid').jqGrid("setColProp", this.name, {editable: false});	
						}
						else{
							$('#jqGrid').jqGrid("setColProp", this.name, {editable: true});
						}
						$(".ui-icon-unlocked").parent().hide();
						
						//$("#jqGrid").trigger("reloadGrid");
						$("#edit_jqGrid").show();
						$("#del_jqGrid").show();
						$("#add_jqGrid").show();
						$(".ui-icon-locked").parent().show();
						
						
					});
				}}
			);*/
			// END Click disable will not edit inline 
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
        return new jq_compareView;
});// JavaScript Document