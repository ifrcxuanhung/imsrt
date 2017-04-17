define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var jq_stockpageView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },
            events: {
				
				
				"click .exportTxt1": "actionExportTxt1",
				"click .exportCsv1": "actionExportCsv1",
				"click .exportXls1": "actionExportXls1",
				
				"click .exportTxt2": "actionExportTxt2",
				"click .exportCsv2": "actionExportCsv2",
				"click .exportXls2": "actionExportXls2",
				
				"click .exportTxt3": "actionExportTxt3",
				"click .exportCsv3": "actionExportCsv3",
				"click .exportXls3": "actionExportXls3",
				
				"click .exportTxt4": "actionExportTxt4",
				"click .exportCsv4": "actionExportCsv4",
				"click .exportXls4": "actionExportXls4",
				
				"click .exportTxt5": "actionExportTxt5",
				"click .exportCsv5": "actionExportCsv5",
				"click .exportXls5": "actionExportXls5",
            },
			
			
			actionExportTxt1: function(event) {
				$("#actexport1").val('exportTxt1');
				$('#form_tab1').submit();
            },
			actionExportCsv1: function(event) {
				$("#actexport1").val('exportCsv1');
				$('#form_tab1').submit();
            },
			actionExportXls1: function(event) {
				$("#actexport1").val('exportXls1');
				$('#form_tab1').submit();
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
			
			actionExportTxt5: function(event) {
				$("#actexport5").val('exportTxt5');
				$('#form_tab5').submit();
            },
			actionExportCsv5: function(event) {
				$("#actexport5").val('exportCsv5');
				$('#form_tab5').submit();
            },
			actionExportXls5: function(event) {
				$("#actexport5").val('exportXls5');
				$('#form_tab5').submit();
            },
            index: function(){
                  $(document).ready(function() {
                   //begin jqgrid
				 
				   
          // var form_currency = $('#form_currency').serialize();
		   var filter_get_all = $(".filter_get_all").attr('attr');
		   var codeint = $(".jq_table3").attr('codeint');
		
		 	var jq_table1 = $(".jq_table1").attr('attr');
			var jq_table2 = $(".jq_table2").attr('attr');
			var jq_table3 = $(".jq_table3").attr('attr');
			var jq_table4 = $(".jq_table4").attr('attr');
			var jq_table5 = $(".jq_table5").attr('attr');
		
			var summary_des1 = $(".jq_table1").attr('summary_des1');
			var summary_des2 = $(".jq_table2").attr('summary_des2');
			var summary_des3 = $(".jq_table3").attr('summary_des3');
			var summary_des4 = $(".jq_table4").attr('summary_des4');
			var summary_des5 = $(".jq_table5").attr('summary_des5');
			
			var order_by1 = $(".jq_table1").attr('order_by');
			var admin1 = $(".jq_table1").attr('admin');
			var order_by2 = $(".jq_table2").attr('order_by');
			var admin2 = $(".jq_table2").attr('admin');
			var order_by3 = $(".jq_table3").attr('order_by');
			var admin3 = $(".jq_table3").attr('admin');
			var order_by4 = $(".jq_table4").attr('order_by');
			var admin4 = $(".jq_table4").attr('admin');
			var order_by5 = $(".jq_table5").attr('order_by');
			var admin5 = $(".jq_table5").attr('admin');
			
		
			var arr_order_by1 = order_by1.split(' ');
			var order_last1 = arr_order_by1.pop();
			var order_first1 = arr_order_by1.join(' ');
			
			var arr_order_by2 = order_by2.split(' ');
			var order_last2 = arr_order_by2.pop();
			var order_first2 = arr_order_by2.join(' ');
			
			var arr_order_by3 = order_by3.split(' ');
			var order_last3 = arr_order_by3.pop();
			var order_first3 = arr_order_by3.join(' ');
			
			var arr_order_by4 = order_by4.split(' ');
			var order_last4 = arr_order_by4.pop();
			var order_first4 = arr_order_by4.join(' ');
			
			var arr_order_by5 = order_by5.split(' ');
			var order_last5 = arr_order_by5.pop();
			var order_first5 = arr_order_by5.join(' ');
				
			//console.log(arr[0]);
			var column1 = jQuery.parseJSON($("#column1").attr('attr'));// Phai parse json vi no la object
			var column2 = jQuery.parseJSON($("#column2").attr('attr'));// Phai parse json vi no la object
			var column3 = jQuery.parseJSON($("#column3").attr('attr'));// Phai parse json vi no la object
			var column4 = jQuery.parseJSON($("#column4").attr('attr'));// Phai parse json vi no la object
			var column5 = jQuery.parseJSON($("#column5").attr('attr'));// Phai parse json vi no la object
			//console.log(column1);
			//var col = [{"label":"Code","name":"code"}];
			//bengin 1
			// phan nay neu dang co nhay thi an nhay di
			
			$.each(column1, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:120} ;
					
				}
				else{
					this.editoptions = {size:120};
				}
				if(this.edittype == 'textarea'){
					this.editoptions = {cols:118};
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
			  $.each(column2, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:120} ;
					
				}
				else{
					this.editoptions = {size:120};
				}
				if(this.edittype == 'textarea'){
					this.editoptions = {cols:118};
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
			  
			  $.each(column3, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:120} ;
					
				}
				else{
					this.editoptions = {size:120};
				}
				if(this.edittype == 'textarea'){
					this.editoptions = {cols:118};
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
			// end 1
			
			
			$.each(column4, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:120} ;
					
				}
				else{
					this.editoptions = {size:120};
				}
				if(this.edittype == 'textarea'){
					this.editoptions = {cols:118};
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
			  
			  $.each(column5, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
				}
				
				if(this.editoptions != '' && this.editoptions != null){
					var editops = this.editoptions.replace('"','');
					this.editoptions = {dataInit: function (element) {$(element).datepicker({id: "orderDate_datePicker",dateFormat:editops,maxDate: new Date(2020, 0, 1),showOn: "focus"})},size:120} ;
					
				}
				else{
					this.editoptions = {size:120};
				}
				if(this.edittype == 'textarea'){
					this.editoptions = {cols:118};
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
			
			
			
			// neu la admin moi duoc quyen sua tren tung dong
			if(admin1 >= 8){
				var edit_row1 = editRow1;	
				var admin_per1 = true;
			}
			else{
				var edit_row1='';
				var admin_per1 = false;	
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
			
			if(admin5 >= 8){
				var edit_row5 = editRow5;	
				var admin_per5 = true;
			}
			else{
				var edit_row5='';
				var admin_per5 = false;	
			}
		
            $("#jqGrid1").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadstockpage1',
				editurl: $base_url+'ajax/edit_del_add_jq_loadtable?jq_table='+jq_table1,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table1:jq_table1,filter_get_all:filter_get_all},
                page: 1,
                colModel:column1,
				//loadonce: true,
				loadtext: "Loading...",
				onSelectRow: edit_row1,
				viewrecords: true,
				//multiSort: true,
				//sortname: arr_order_by[0],
               // sortorder: arr_order_by[1],
				sortname: order_first1,
               	sortorder: order_last1,
				
               	//width:1250,
			   autowidth: true,
			  // width: null,
				//shrinkToFit: false,
             	//gridview    :   true,
				//autoheight: true, // muon cuon xuong load them thi tat dong nay di va bat height o duoi len
                height:"100%", // co the de % de fix chieu cao auto
                rowNum: 10,
				//rownumbers: true, 
                pager: "#jqGridPager1",
				caption: summary_des1,// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				
				//multiselect: true
				 //recordpos: 'left',
			  loadComplete: function() {
				  
				  $(window).on("resize", function () {
						var $grid = $("#jqGrid1"),
							newWidth = $grid.closest(".ui-jqgrid").parent().width();
							$grid.jqGrid("setGridWidth", newWidth, true);
					});
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("#gview_jqGrid1 tr.jqgrow:odd").addClass('myAltRowClass');
					$("#locked_1").children().addClass("dis_none");
					$("#edit_jqGrid1").hide();
					$("#del_jqGrid1").hide();
					$("#add_jqGrid1").hide();
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
					
					var ids = $("#jqGrid1").jqGrid('getDataIDs');
				
					for(var i = 0; i<ids.length;i++){
						var rowId = ids[i];
						var rowData = $("#jqGrid1").jqGrid('getRowData',rowId);
						$.each(rowData, function(key, value) {
							
							// style font
						   $.each(column1, function() {
							if(this.style == 'bold'){
							 $('[aria-describedby="jqGrid1_'+this.name+'"]').addClass('bold');
							}
							else if(this.style == 'italic'){
							 $('[aria-describedby="jqGrid1_'+this.name+'"]').addClass('italic');
							}
							else if(this.style == 'underline'){
							 $('[aria-describedby="jqGrid1_'+this.name+'"]').addClass('underline');
							}
							
							 
							});
							 //end style font
							  
						   if(parseFloat(value) > 0 ){
							   $.each(column1, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('negative');
										 $('[aria-describedby="jqGrid1_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('positive'); 
									}
							   });
							}else if(parseFloat(value) < 0){
								 $.each(column1, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('positive');
										$('[aria-describedby="jqGrid1_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('negative');
									}
							   });
							}
							else{
								 $.each(column1, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('equal');
										$('[aria-describedby="jqGrid1_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('equal');
									}
								 });
							}
						 
						 });	
					}
					////end
					
					$.each(column1, function() {
						$("#jqgh_jqGrid_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
					
						// PHAN NAY DUNG DE XU LY TIME TREN SELECTOPTION
					$.ajax({
						type: "POST",
						url: $base_url + "ajax/getTableToFilterSelect",
						dataType: "json",
						data:{table:jq_table1},
						success: function(response){
							//console.log(jq_table1);
							$("#gsh_jqGrid1_time #gs_time").html('<option value="">[All]</option>');
							$.each(response, function(key,value){
								//console.log(value.time);
								$("#gsh_jqGrid1_time #gs_time").append('<option value="'+value.time+'">'+value.time+'</option>');
							});
							//console.log(response);
						}	
					});
					// END PHAN NAY DUNG DE XU LY TIME TREN SELECTOPTION
					
					
				},// gan class chan le cho tung dong
				
				 
            });
			
			$("#jqGrid2").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadstockpage2',
				editurl: $base_url+'ajax/edit_del_add_jq_loadtable?jq_table='+jq_table2,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table2:jq_table2,filter_get_all:filter_get_all},
                page: 1,
                colModel:column2,
				//loadonce: true,
				loadtext: "Loading...",
				onSelectRow: edit_row2,
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
				caption: "Membership",// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				hiddengrid: true,
				//multiselect: true
				 //recordpos: 'left',
			  loadComplete: function() {
				  
				 
					 $(window).on("resize", function () {
						var $grid = $("#jqGrid2"),
							newWidth = $grid.closest(".ui-jqgrid").parent().width();
							$grid.jqGrid("setGridWidth", newWidth, true);
					});
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("#gview_jqGrid2 tr.jqgrow:odd").addClass('myAltRowClass');
					$("#locked_2").children().addClass("dis_none");
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
										//$('[title="'+addCommas(value)+'"]').addClass('negative'); 
										$('[aria-describedby="jqGrid2_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('positive');
									}
							   });
							}else if(parseFloat(value) < 0){
								 $.each(column2, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('positive');
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
						$("#jqgh_jqGrid_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
					
					// PHAN NAY DUNG DE XU LY TIME TREN SELECTOPTION
					$.ajax({
						type: "POST",
						url: $base_url + "ajax/getTableToFilterSelect",
						dataType: "json",
						data:{table:jq_table2},
						success: function(response){
							//console.log(jq_table2);
							$("#gsh_jqGrid2_time #gs_time").html('<option value="">[All]</option>');
							$.each(response, function(key,value){
								//console.log(value.time);
								$("#gsh_jqGrid2_time #gs_time").append('<option value="'+value.time+'">'+value.time+'</option>');
							});
							//console.log(response);
						}	
					});
					// END PHAN NAY DUNG DE XU LY TIME TREN SELECTOPTION
					
					
				},// gan class chan le cho tung dong
				
				 
            });
			
			
			
			$("#jqGrid3").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadstockpage3',
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
				 hiddengrid: true,
			  loadComplete: function() {
				  
				 
					 $(window).on("resize", function () {
						var $grid = $("#jqGrid3"),
							newWidth = $grid.closest(".ui-jqgrid").parent().width();
							$grid.jqGrid("setGridWidth", newWidth, true);
					});
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("#gview_jqGrid3 tr.jqgrow:odd").addClass('myAltRowClass');
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
						$("#jqgh_jqGrid_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
				},// gan class chan le cho tung dong
				
				 
            });
			
			
			$("#jqGrid4").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadstockpage4',
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
				 hiddengrid: true,
			  loadComplete: function() {
				  
				 
					 $(window).on("resize", function () {
						var $grid = $("#jqGrid4"),
							newWidth = $grid.closest(".ui-jqgrid").parent().width();
							$grid.jqGrid("setGridWidth", newWidth, true);
					});
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("#gview_jqGrid4 tr.jqgrow:odd").addClass('myAltRowClass');
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
								 $.each(column4, function() {
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
						$("#jqgh_jqGrid_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
				},// gan class chan le cho tung dong
				
				 
            });
			
			
			
			$("#jqGrid5").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'ajax/jq_loadstockpage5',
				editurl: $base_url+'ajax/edit_del_add_jq_loadtable?jq_table='+jq_table5,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table5:jq_table5,filter_get_all:filter_get_all},
                page: 1,
                colModel:column5,
				//loadonce: true,
				loadtext: "Loading...",
				onSelectRow: edit_row5,
				viewrecords: true,
				//multiSort: true,
				//sortname: arr_order_by[0],
               // sortorder: arr_order_by[1],
				sortname: order_first5,
               	sortorder: order_last5,
				
               	//width:1250,
			   autowidth: true,
			  // width: null,
				//shrinkToFit: false,
             	//gridview    :   true,
				//autoheight: true, // muon cuon xuong load them thi tat dong nay di va bat height o duoi len
                height:"100%", // co the de % de fix chieu cao auto
                rowNum: 10,
				//rownumbers: true, 
                pager: "#jqGridPager5",
				caption: summary_des5,// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				//multiselect: true
				 //recordpos: 'left',
				 hiddengrid: true,
			  loadComplete: function() {
				  
				  $(window).on("resize", function () {
						var $grid = $("#jqGrid5"),
							newWidth = $grid.closest(".ui-jqgrid").parent().width();
							$grid.jqGrid("setGridWidth", newWidth, true);
					});
					$(".export_total").show();
					$(".block_map").show();
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("#gview_jqGrid5 tr.jqgrow:odd").addClass('myAltRowClass');
					$("#locked_5").children().addClass("dis_none");
					$("#edit_jqGrid5").hide();
					$("#del_jqGrid5").hide();
					$("#add_jqGrid5").hide();
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
					
					var ids = $("#jqGrid5").jqGrid('getDataIDs');
				
					for(var i = 0; i<ids.length;i++){
						var rowId = ids[i];
						var rowData = $("#jqGrid5").jqGrid('getRowData',rowId);
						$.each(rowData, function(key, value) {
							
							// style font
						   $.each(column5, function() {
							if(this.style == 'bold'){
							 $('[aria-describedby="jqGrid5_'+this.name+'"]').addClass('bold');
							}
							else if(this.style == 'italic'){
							 $('[aria-describedby="jqGrid5_'+this.name+'"]').addClass('italic');
							}
							else if(this.style == 'underline'){
							 $('[aria-describedby="jqGrid5_'+this.name+'"]').addClass('underline');
							}
							
							 
							});
							 //end style font
							  
							  
						   if(parseFloat(value) > 0 ){
							   $.each(column5, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('negative');
										$('[aria-describedby="jqGrid5_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('positive'); 
									}
							   });
							}else if(parseFloat(value) < 0){
								 $.each(column5, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('positive');
										$('[aria-describedby="jqGrid5_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('negative');
									}
							   });
							}
							else{
								 $.each(column5, function() {
								   	if(this.color == 1 && this.name == key){
										//$('[title="'+addCommas(value)+'"]').addClass('equal');
										$('[aria-describedby="jqGrid5_'+this.name+'"][title="'+addCommas(value)+'"]').addClass('equal'); 
									}
								 });
							}
						 
						 });	
					}
					////end
					
					$.each(column5, function() {
						$("#jqgh_jqGrid_"+this.name).attr("data-toggle", "tooltip");
						$("#jqgh_jqGrid_"+this.name).attr("title", this.tooltips);
						$('[data-toggle="tooltip"]').tooltip({position: { my: "center bottom", at: "left+30 top" }});
						
					});
					
					// PHAN NAY DUNG DE XU LY TIME TREN SELECTOPTION
					$.ajax({
						type: "POST",
						url: $base_url + "ajax/getTableToFilterSelect",
						dataType: "json",
						data:{table:jq_table5},
						success: function(response){
							//console.log(jq_table5);
							$("#gsh_jqGrid5_time #gs_time").html('<option value="">[All]</option>');
							$.each(response, function(key,value){
								//console.log(value.time);
								$("#gsh_jqGrid5_time #gs_time").append('<option value="'+value.time+'">'+value.time+'</option>');
							});
							//console.log(response);
						}	
					});
					// END PHAN NAY DUNG DE XU LY TIME TREN SELECTOPTION
					
					
				},// gan class chan le cho tung dong
				
				 
            });
			
			
			
			
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
			function formatLink1(cellValue, options, rowObject) {
                return "<a href='"+$base_url+"stock/" + cellValue + "' class='link_overview'>" + cellValue.substring(0, 25) + "</a>";
            };
			
			
			 var lastSelection1;
			 var lastSelection2;
			 var lastSelection3;
			 var lastSelection4;
			 var lastSelection5;

            function editRow1(id1) {
                //if (id1 && id1 !== lastSelection1) {
                    var grid = $("#jqGrid1");
                    grid.jqGrid('restoreRow',lastSelection1);
                    grid.jqGrid('editRow',id1, {keys:true, focusField: 4});
                    lastSelection1 = id1;
               // }
            }
			
			function editRow2(id2) {
               // if (id2 && id2 !== lastSelection2) {
                    var grid = $("#jqGrid2");
                    grid.jqGrid('restoreRow',lastSelection2);
                    grid.jqGrid('editRow',id2, {keys:true, focusField: 4});
                    lastSelection2 = id2;
              //  }
            }
			
			function editRow3(id3) {
              //  if (id3 && id3 !== lastSelection3) {
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
			function editRow5(id5) {
               // if (id5 && id5 !== lastSelection5) {
                    var grid = $("#jqGrid5");
                    grid.jqGrid('restoreRow',lastSelection5);
                    grid.jqGrid('editRow',id5, {keys:true, focusField: 4});
                    lastSelection5 = id5;
               // }
            }
			
			function buildSearchSelect(name,table){
				
                return $.ajax({
                    url: $base_url + "ajax/getSelected",
                    type: "POST",
                    data: {name:name,table:table},
                    async: false,
                  
                });
				//var a = result;//"ALFKI:ALFKI;ANATR:ANATR;ANTON:ANTON";
				//console.log(a);
			}
			
			// activate the toolbar searching
            $('#jqGrid1').jqGrid('filterToolbar');
			$('#jqGrid1').jqGrid('navGrid',"#jqGridPager1", {                
                search: false, // show search button on the toolbar
                add: admin_per1,
                edit: admin_per1,
                del: admin_per1,
                refresh: true
            },
			{
				width:1000,
				closeAfterEdit: true,
				closeAfterAdd:true,
				beforeShowForm: function(form) {
                  // "editmodlist"
                  var dlgDiv = $("#editmodjqGrid1");
                  var parentDiv = dlgDiv.parent(); // div#gbox_list
                  var dlgWidth = dlgDiv.width();
                  var parentWidth = parentDiv.width();
                  var dlgHeight = dlgDiv.height();
                  var parentHeight = parentDiv.height();
                  // TODO: change parentWidth and parentHeight in case of the grid
                  //       is larger as the browser window
                  dlgDiv[0].style.top = Math.round((parentHeight-dlgHeight)/2) + "px";
                  dlgDiv[0].style.left = Math.round((parentWidth-dlgWidth)/2) + "px";
              }
			}
			);
			
			$('#jqGrid1').jqGrid('navButtonAdd',"#jqGridPager1",
				{caption:"Disable edit",
				title:"Disable edit",
				buttonicon :'ui-icon-locked',
				id:"locked_1",
				onClickButton:function(){
					$.each(column1, function() {
						$('#jqGrid1').jqGrid("setColProp", this.name, {editable: false});
						
					});
					$("#locked_1").children().hide();
					$("#jqGrid1").trigger('reloadGrid');
					$("#edit_jqGrid1").hide();
					$("#del_jqGrid1").hide();
					$("#add_jqGrid1").hide();
					$("#unlocked_1").children().show();
					 
				}}
			);
			$('#jqGrid1').jqGrid('navButtonAdd',"#jqGridPager1",
				{caption:"Enable edit",
				title:"Enable edit",
				buttonicon :'ui-icon-unlocked',
				id:'unlocked_1',
				onClickButton:function(){
					$.each(column1, function() {
						if(this.format_notedit == "not_edit"){	
							$('#jqGrid1').jqGrid("setColProp", this.name, {editable: false});	
						}
						else{
							$('#jqGrid1').jqGrid("setColProp", this.name, {editable: true});
						}
						$("#unlocked_1").children().hide();
						//$("#jqGrid1").trigger("reloadGrid");
						$("#edit_jqGrid1").show();
						$("#del_jqGrid1").show();
						$("#add_jqGrid1").show();
						$("#locked_1").children().show();
						
					});
				}}
			);
			
			$('#jqGrid2').jqGrid('filterToolbar');
			$('#jqGrid2').jqGrid('navGrid',"#jqGridPager2", {                
                search: false, // show search button on the toolbar
                add: admin_per2,
                edit: admin_per2,
                del: admin_per2,
                refresh: true
            },
			{
				width:1000,
				closeAfterEdit: true,
				closeAfterAdd:true,
				beforeShowForm: function(form) {
                  // "editmodlist"
                  var dlgDiv = $("#editmodjqGrid2");
                  var parentDiv = dlgDiv.parent(); // div#gbox_list
                  var dlgWidth = dlgDiv.width();
                  var parentWidth = parentDiv.width();
                  var dlgHeight = dlgDiv.height();
                  var parentHeight = parentDiv.height();
                  // TODO: change parentWidth and parentHeight in case of the grid
                  //       is larger as the browser window
                  dlgDiv[0].style.top = Math.round((parentHeight-dlgHeight)/2) + "px";
                  dlgDiv[0].style.left = Math.round((parentWidth-dlgWidth)/2) + "px";
              }
			}
			);
			
			$('#jqGrid2').jqGrid('navButtonAdd',"#jqGridPager2",
				{caption:"Disable edit",
				title:"Disable edit",
				buttonicon :'ui-icon-locked',
				id:'locked_2',
				onClickButton:function(){
					$.each(column2, function() {
						$('#jqGrid2').jqGrid("setColProp", this.name, {editable: false});
						
					});
					$("#locked_2").children().hide();
					$("#jqGrid2").trigger('reloadGrid');
					$("#edit_jqGrid2").hide();
					$("#del_jqGrid2").hide();
					$("#add_jqGrid2").hide();
					$("#unlocked_2").children().show();
					 
				}}
			);
			$('#jqGrid2').jqGrid('navButtonAdd',"#jqGridPager2",
				{caption:"Enable edit",
				title:"Enable edit",
				buttonicon :'ui-icon-unlocked',
				id:'unlocked_2',
				onClickButton:function(){
					$.each(column2, function() {
						if(this.format_notedit == "not_edit"){	
							$('#jqGrid2').jqGrid("setColProp", this.name, {editable: false});	
						}
						else{
							$('#jqGrid2').jqGrid("setColProp", this.name, {editable: true});
						}
						$("#unlocked_2").children().hide();
						//$("#jqGrid2").trigger("reloadGrid");
						$("#edit_jqGrid2").show();
						$("#del_jqGrid2").show();
						$("#add_jqGrid2").show();
						$("#locked_2").children().show();
						
					});
				}}
			);
			
			
			$('#jqGrid3').jqGrid('filterToolbar');
			$('#jqGrid3').jqGrid('navGrid',"#jqGridPager3", {                
                search: false, // show search button on the toolbar
                add: admin_per3,
                edit: admin_per3,
                del: admin_per3,
                refresh: true
            },
			{
				width:1000,
				closeAfterEdit: true,
				closeAfterAdd:true,
				beforeShowForm: function(form) {
                  // "editmodlist"
                  var dlgDiv = $("#editmodjqGrid3");
                  var parentDiv = dlgDiv.parent(); // div#gbox_list
                  var dlgWidth = dlgDiv.width();
                  var parentWidth = parentDiv.width();
                  var dlgHeight = dlgDiv.height();
                  var parentHeight = parentDiv.height();
                  // TODO: change parentWidth and parentHeight in case of the grid
                  //       is larger as the browser window
                  dlgDiv[0].style.top = Math.round((parentHeight-dlgHeight)*6) + "px";
                  dlgDiv[0].style.left = Math.round((parentWidth-dlgWidth)/2) + "px";
              }
			}
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
			{
				width:1000,
				closeAfterEdit: true,
				closeAfterAdd:true,
				beforeShowForm: function(form) {
                  // "editmodlist"
                  var dlgDiv = $("#editmodjqGrid4");
                  var parentDiv = dlgDiv.parent(); // div#gbox_list
                  var dlgWidth = dlgDiv.width();
                  var parentWidth = parentDiv.width();
                  var dlgHeight = dlgDiv.height();
                  var parentHeight = parentDiv.height();
                  // TODO: change parentWidth and parentHeight in case of the grid
                  //       is larger as the browser window
                  dlgDiv[0].style.top = Math.round((parentHeight-dlgHeight)*7) + "px";
                  dlgDiv[0].style.left = Math.round((parentWidth-dlgWidth)/2) + "px";
              }
			}
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
						//$("#jqGrid4").trigger("reloadGrid");
						$("#edit_jqGrid4").show();
						$("#del_jqGrid4").show();
						$("#add_jqGrid4").show();
						$("#locked_4").children().show();
						
					});
				}}
			);
			
			$('#jqGrid5').jqGrid('filterToolbar');
			$('#jqGrid5').jqGrid('navGrid',"#jqGridPager5", {                
                search: false, // show search button on the toolbar
                add: admin_per5,
                edit: admin_per5,
                del: admin_per5,
                refresh: true
            },
			{
				width:1000,
				closeAfterEdit: true,
				closeAfterAdd:true,
				beforeShowForm: function(form) {
                  // "editmodlist"
                  var dlgDiv = $("#editmodjqGrid5");
                  var parentDiv = dlgDiv.parent(); // div#gbox_list
                  var dlgWidth = dlgDiv.width();
                  var parentWidth = parentDiv.width();
                  var dlgHeight = dlgDiv.height();
                  var parentHeight = parentDiv.height();
                  // TODO: change parentWidth and parentHeight in case of the grid
                  //       is larger as the browser window
                  dlgDiv[0].style.top = Math.round((parentHeight-dlgHeight)*4) + "px";
                  dlgDiv[0].style.left = Math.round((parentWidth-dlgWidth)/2) + "px";
              }
			}
			);
			
			
			$('#jqGrid5').jqGrid('navButtonAdd',"#jqGridPager5",
				{caption:"Disable edit",
				title:"Disable edit",
				buttonicon :'ui-icon-locked',
				id:'locked_5',
				onClickButton:function(){
					$.each(column5, function() {
						$('#jqGrid5').jqGrid("setColProp", this.name, {editable: false});
						
					});
					$("#locked_5").children().hide();
					$("#jqGrid5").trigger('reloadGrid');
					$("#edit_jqGrid5").hide();
					$("#del_jqGrid5").hide();
					$("#add_jqGrid5").hide();
					$("#unlocked_5").children().show();
					 
				}}
			);
			$('#jqGrid5').jqGrid('navButtonAdd',"#jqGridPager5",
				{caption:"Enable edit",
				title:"Enable edit",
				buttonicon :'ui-icon-unlocked',
				id:'unlocked_5',
				onClickButton:function(){
					$.each(column5, function() {
						if(this.format_notedit == "not_edit"){	
							$('#jqGrid5').jqGrid("setColProp", this.name, {editable: false});	
						}
						else{
							$('#jqGrid5').jqGrid("setColProp", this.name, {editable: true});
						}
						$("#unlocked_5").children().hide();
						//$("#jqGrid5").trigger("reloadGrid");
						$("#edit_jqGrid5").show();
						$("#del_jqGrid5").show();
						$("#add_jqGrid5").show();
						$("#locked_5").children().show();
						
					});
				}}
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
            // BEGIN CHART 
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
                function getvalueCHART(){
                    
                    return $.ajax({
                        url: $base_url + "ajax/getFeedIntraday",
                        type: "POST",
                        data: {idx_code:filter_get_all},
                        async: false
                    });
                }
                var data1 = jQuery.parseJSON(getvalueCHART().responseText);
              //console.log(data1);
                var res = [];
                for (var i = 0; i < data1.length; ++i){
					if(data1[i].time >= '09:00:00' && data1[i].time <= '14:45:00'){
						var value = parseFloat(data1[i].last).toFixed(2);
						var time = data1[i].time.slice(0,5);
						// console.log(value);
						res.push({'time':time,'value':value})
					}
                } 
               // console.log(res);
                
                    
                function showChartTooltip(x, y, xValue, yValue) {
                    $('<div id="tooltip" class="chart-tooltip">' + yValue + '<\/div>').css({
                        position: 'absolute',
                        display: 'none',
                        top: y - 40,
                        left: x - 40,
                        border: '0px solid #ccc',
                        padding: '2px 6px',
                        'background-color': '#fff'
                    }).appendTo("body").fadeIn(200);
                }
                if ($('#chartdiv').size() != 0) {

                    $('#site_statistics_loading').hide();
                    $('#site_statistics_content').show();
                    
                    var chart = AmCharts.makeChart("chartdiv", {
                            "type": "serial",
                            "theme": "light",
                            "marginRight": 40,
                            "marginLeft": 60,
                            "autoMarginOffset": 30,
                            "pathToImages": $template_url + "global/plugins/amcharts/amcharts/images/",
                            "dataDateFormat": "L",
                            "valueAxes": [{
                                "id": "v1",
                                "axisAlpha": 0,
                                "position": "left",
                                "ignoreAxisWidth":true
                            }],
                            "balloon": {
                                "borderThickness": 1,
                                "shadowAlpha": 0
                            },
                            "numberFormatter": {
                                "precision": -1,
                                "decimalSeparator": ".",
                                "thousandsSeparator": ","
                            },
                            "graphs": [{
                                "id": "g1",
                                "balloon":{
                                  "drop":true,
                                  "adjustBorderColor":false,
                                  "color":"#ffffff"
                                },
                                "bullet": "round",
                                "bulletBorderAlpha": 1,
                                "bulletColor": "#FFFFFF",
                                "bulletSize": 5,
                                "hideBulletsCount": 50,
                                "lineThickness": 2,
                                "title": "red line",
                                "useLineColorForBulletBorder": true,
                                "valueField": "value",
                                "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
                            }],
                          //  "chartScrollbar": {
//                                "graph": "g1",
//                                "oppositeAxis":false,
//                                "offset":30,
//                                "scrollbarHeight": 80,
//                                "backgroundAlpha": 0,
//                                "selectedBackgroundAlpha": 0.1,
//                                "selectedBackgroundColor": "#888888",
//                                "graphFillAlpha": 0,
//                                "graphLineAlpha": 0.5,
//                                "selectedGraphFillAlpha": 0,
//                                "selectedGraphLineAlpha": 1,
//                                "autoGridCount":true,
//                                "color":"#AAAAAA"
//                            },
                            "chartCursor": {
                                "pan": true,
                                "valueLineEnabled": true,
                                "valueLineBalloonEnabled": true,
                                "cursorAlpha":1,
                                "cursorColor":"#258cbb",
                                "limitToGraph":"g1",
                                "valueLineAlpha":0.2
                            },
                            "valueScrollbar":{
                              "oppositeAxis":false,
                              "offset":50,
                              "scrollbarHeight":10
                            },
                            "categoryField": "time",
                            "categoryAxis": {
                              //  "parseDates": true,
                                "dashLength": 1,
                                "minorGridEnabled": true
                            },
                            "export": {
                                "enabled": true
                            },
                            "exportConfig": {
                                "menuBottom": "20px",
                                "menuRight": "22px",
                                "menuItems": [{
                                    "icon": $template_url + "global/plugins/amcharts/amcharts/images/export.png",
                                    "format": 'png'
                                }]
                            },
                            "dataProvider": res
                            //[{
//                                "date": "2013-01-30",
//                                "value": 81
//                            }]
                        });
                        
                        chart.addListener("rendered", zoomChart);
                        
                        zoomChart();
                        
                        
                
                        $('#chartdiv').closest('.portlet').find('.fullscreen').click(function() {
                            chart.invalidateSize();
                        });
                        
                    };
                    function zoomChart() {
                        chart.zoomToIndexes(chart.dataProvider.length - chart.dataProvider.length, chart.dataProvider.length - 1);
                    }
                    // END CHART 
                });
                   
                      
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new jq_stockpageView;
});// JavaScript Document