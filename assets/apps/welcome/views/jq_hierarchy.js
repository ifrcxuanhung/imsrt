define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var jq_hierarchyView = Backbone.View.extend({
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
				 
				   
          // var form_currency = $('#form_currency').serialize();
		   var filter_get_all = $(".filter_get_all").attr('attr');
		
		 	var jq_table = $(".jq_table").attr('attr');
			var jq_table2 = $(".jq_table2").attr('attr');
			var jq_table3 = $(".jq_table3").attr('attr');
			//console.log(jq_table3);
			var summary_des = $(".jq_table").attr('summary_des');
			var summary_des2 = $(".jq_table2").attr('summary_des2');
			if(jq_table3 == "idx_specs_rt"){
				var summary_des3 = $(".jq_table3").attr('summary_des3');
			}
			
			var order_by = $(".jq_table").attr('order_by');
			var admin = $(".jq_table").attr('admin');
			var order_by2 = $(".jq_table2").attr('order_by');
			var admin2 = $(".jq_table2").attr('admin');
			if(jq_table3 == "idx_specs_rt"){
				var order_by3 = $(".jq_table3").attr('order_by');
				var admin3 = $(".jq_table3").attr('admin');
			}
			
		
			var arr_order_by = order_by.split(' ');
			var order_last = arr_order_by.pop();
			var order_first = arr_order_by.join(' ');
			var arr_order_by2 = order_by2.split(' ');
			var order_last2 = arr_order_by2.pop();
			var order_first2 = arr_order_by2.join(' ');
			if(jq_table3 == "idx_specs_rt"){
				var arr_order_by3 = order_by3.split(' ');
				var order_last3 = arr_order_by3.pop();
				var order_first3 = arr_order_by3.join(' ');
			}
				
			//console.log(arr[0]);
			var column = jQuery.parseJSON($("#column").attr('attr'));// Phai parse json vi no la object
			var column_child = jQuery.parseJSON($("#column").attr('attrchild'));// Phai parse json vi no la object
			var column_child_ca = jQuery.parseJSON($("#column_child_ca").attr('attrchild_ca'));// Phai parse json vi no la object
			var column_child_ca_compo = jQuery.parseJSON($("#column_child_ca").attr('attrchild_compo'));// Phai parse json vi no la object
			
			var column_child2 = jQuery.parseJSON($("#column").attr('attrchild'));// Phai parse json vi no la object
			var column2 = jQuery.parseJSON($("#column2").attr('attr'));// Phai parse json vi no la object
			var column3 = jQuery.parseJSON($("#column3").attr('attr'));// Phai parse json vi no la object
				
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
			  
			  
			  
			  if(jq_table3 == "idx_specs_rt"){
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
			  }//end if
			
			
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
			if(jq_table3 == "idx_specs_rt"){
				if(admin3 >= 8){
					var edit_row3 = editRow3;	
					var admin_per3 = true;
				}
				else{
					var edit_row3='';
					var admin_per3 = false;	
				}
			}
			
			
			// Them do phan ca khac div
			if(jq_table == 'idx_ca_rt'){
				var child = showChildGrid_ca;
				var child2 = showChildGrid2_compo;
			}
			if(jq_table == 'stk_div_rt'){
				var child = showChildGrid;	
				var child2 = showChildGrid2;
			}
			//end
            $("#jqGrid").jqGrid({
               // url: 'ajax/jq_efrc_currency_data',
			    url: $base_url+'jqgrid/jq_loadhierarchy',
				editurl: $base_url+'jqgrid/edit_del_add_jq_loadhierarchy?jq_table='+jq_table,
			
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
				subGrid: true, // set the subGrid property to true to show expand buttons for each row
                subGridRowExpanded: child, // javascript function that will take care of showing the child grid
				//multiselect: true
				 //recordpos: 'left',
			  loadComplete: function() {
				  
				  	$(".export_total").show();
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("#gbox_jqGrid tr.jqgrow:odd").addClass('myAltRowClass');
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
			    url: $base_url+'jqgrid/jq_loadhierarchy2',
				editurl: $base_url+'jqgrid/edit_del_add_jq_loadhierarchy?jq_table='+jq_table2,
			
                mtype: "POST",
                datatype: "json",
				postData:{jq_table2:jq_table2,filter_get_all:filter_get_all,jq_table:jq_table},
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
				caption: summary_des2,// hien tren title
				//scroll: 1,// phai de chieu cao co dinh no moi hoat dong
				rowList:[10,20,30,40,50,60],// hien thi so trang can xem
				subGrid: true, // set the subGrid property to true to show expand buttons for each row
                subGridRowExpanded: child2, // javascript function that will take care of showing the child grid
				//multiselect: true
				 //recordpos: 'left',
			  loadComplete: function() {
				  
				 
					$(".export_total").show();
					//$("tr.jqgrow:odd").css("background", "#E0E0E0");
					$("#gbox_jqGrid2  tr.jqgrow:odd").addClass('myAltRowClass');
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
				},// gan class chan le cho tung dong
				
				 
            });
			
			
			
			if(jq_table3 == "idx_specs_rt"){
				$("#jqGrid3").jqGrid({
				   // url: 'ajax/jq_efrc_currency_data',
					url: $base_url+'jqgrid/jq_loadhierarchy3',
					editurl: $base_url+'jqgrid/edit_del_add_jq_loadhierarchy?jq_table='+jq_table3,
				
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
				  loadComplete: function() {
					  
					 
						$(".export_total").show();
						//$("tr.jqgrow:odd").css("background", "#E0E0E0");
						$("#gbox_jqGrid3  tr.jqgrow:odd").addClass('myAltRowClass');
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
			}//end if
			
			//Set null convert empty
			var nullFormatter = function(cellvalue, options, rowObject) {
				if(cellvalue === undefined || isNull(cellvalue)) {
					cellvalue = 'NULL';
				}
				return cellvalue;
			}
			function formatLinkDefault(cellValue, options, rowObject) {
                return "<a href='"+$base_url+"jq_loadtable/" + cellValue + "' class='link_overview'>" + cellValue.substring(0, 25) + "</a>";
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
			  if(jq_table3 == "idx_specs_rt"){
			   	var lastSelection3;
			  }
			
            function editRow(id) {
              //  if (id && id !== lastSelection) {
                    var grid = $("#jqGrid");
                    grid.jqGrid('restoreRow',lastSelection);
                    grid.jqGrid('editRow',id, {keys:true, focusField: 4});
                    lastSelection = id;
              //  }
            }
			function editRow2(id2) {
               // if (id2 && id2 !== lastSelection2) {
                    var grid = $("#jqGrid2");
                    grid.jqGrid('restoreRow',lastSelection2);
                    grid.jqGrid('editRow',id2, {keys:true, focusField: 4});
                    lastSelection2 = id2;
                //}
            }
			// Dung cho idx_specs_rt
			function editRow3(id3) {
				//if (id3 && id3 !== lastSelection3) {
					var grid = $("#jqGrid3");
					grid.jqGrid('restoreRow',lastSelection3);
					grid.jqGrid('editRow',id3, {keys:true, focusField: 4});
					lastSelection3 = id3;
				//}
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
			
			 // the event handler on expanding parent row receives two parameters
        // the ID of the grid tow  and the primary key of the row
		//console.log(column_child);
        function showChildGrid(parentRowID, parentRowKey) {
			
            var childGridID = parentRowID + "_table";
            var childGridPagerID = parentRowID + "_pager";
			//console.log(parentRowKey);
            // send the parent row primary key to the server so that we know which grid to show
           // var childGridURL = parentRowKey+".json";
			 var childGridURL = $base_url+'jqgrid/jq_loadhierarchyChild';
            //childGridURL = childGridURL + "&parentRowID=" + encodeURIComponent(parentRowKey)

            // add a table and pager HTML elements to the parent grid row - we will render the child grid here
            $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id=' + childGridPagerID + ' class=scroll></div>');
			
			
			//begin
			
			
			
			$.each(column_child, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
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
				
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				if(this.formatter=='link_default'){
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
			  

			
			//end
			
			

            $("#" + childGridID).jqGrid({
                url: childGridURL,
				mtype: "POST",
                datatype: "json",
				postData:{jq_table:jq_table,filter_get_all:filter_get_all,codeint:parentRowKey},
                page: 1,
                colModel:column_child,
				//loadonce: true,
                autowidth: true,
                height:"100%",
				rowNum: 5,
				viewrecords: true,
				//scroll:1,
                pager: "#" + childGridPagerID
            });
			

        }
		
		
		
		function showChildGrid_ca(parentRowID, parentRowKey) {
			
            var childGridID = parentRowID + "_table";
            var childGridPagerID = parentRowID + "_pager";
			//console.log(parentRowKey);
            // send the parent row primary key to the server so that we know which grid to show
           // var childGridURL = parentRowKey+".json";
			 var childGridURL = $base_url+'jqgrid/jq_loadhierarchyChild_ca';
            //childGridURL = childGridURL + "&parentRowID=" + encodeURIComponent(parentRowKey)

            // add a table and pager HTML elements to the parent grid row - we will render the child grid here
            $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id=' + childGridPagerID + ' class=scroll></div>');
			
			
			//begin
			
			
			
			$.each(column_child_ca, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
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
				
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				if(this.formatter=='link_default'){
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
			  

			
			//end
			
			

            $("#" + childGridID).jqGrid({
                url: childGridURL,
				mtype: "POST",
                datatype: "json",
				postData:{jq_table:jq_table,filter_get_all:filter_get_all,codeint:parentRowKey},
                page: 1,
                colModel:column_child_ca,
				//loadonce: true,
                autowidth: true,
                height:"100%",
				rowNum: 5,
				viewrecords: true,
				//scroll:1,
                pager: "#" + childGridPagerID
            });
			

        }
		
		 function showChildGrid2(parentRowID, parentRowKey) {
			
            var childGridID = parentRowID + "_table";
            var childGridPagerID = parentRowID + "_pager";
			//console.log(parentRowKey);
            // send the parent row primary key to the server so that we know which grid to show
           // var childGridURL = parentRowKey+".json";
			 var childGridURL = $base_url+'jqgrid/jq_loadhierarchyChild2';
            //childGridURL = childGridURL + "&parentRowID=" + encodeURIComponent(parentRowKey)

            // add a table and pager HTML elements to the parent grid row - we will render the child grid here
            $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id=' + childGridPagerID + ' class=scroll></div>');
			
			
			//begin
			
			$.each(column_child2, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
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
				
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				if(this.formatter=='link_default'){
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
			  

			
			//end
			
			

            $("#" + childGridID).jqGrid({
                url: childGridURL,
				mtype: "POST",
                datatype: "json",
				postData:{jq_table:jq_table,filter_get_all:filter_get_all,codeint:parentRowKey},
                page: 1,
                colModel:column_child2,
				//loadonce: true,
                autowidth: true,
                height:"100%",
				rowNum: 5,
				viewrecords: true,
				//scroll:1,
                pager: "#" + childGridPagerID
            });
			

        }
		
		
		
		 function showChildGrid2_compo(parentRowID, parentRowKey) {
			
            var childGridID = parentRowID + "_table";
            var childGridPagerID = parentRowID + "_pager";
			//console.log(parentRowKey);
            // send the parent row primary key to the server so that we know which grid to show
           // var childGridURL = parentRowKey+".json";
			 var childGridURL = $base_url+'jqgrid/jq_loadhierarchyChild_compo';
            //childGridURL = childGridURL + "&parentRowID=" + encodeURIComponent(parentRowKey)

            // add a table and pager HTML elements to the parent grid row - we will render the child grid here
            $('#' + parentRowID).append('<table id=' + childGridID + '></table><div id=' + childGridPagerID + ' class=scroll></div>');
			
			
			//begin
			
			$.each(column_child_ca_compo, function() {
				if(this.formatoptions!='' && this.formatoptions != null){
					this.formatoptions = {decimalSeparator:".", thousandsSeparator: ",", decimalPlaces:parseInt(this.formatoptions), defaultValue: "" };
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
				
				/*if(this.formatter=='displayButtons'){
					this.formatter = displayButtons;
				}*/
				if(this.formatter=='link_default'){
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
			  

			
			//end
			
			

            $("#" + childGridID).jqGrid({
                url: childGridURL,
				mtype: "POST",
                datatype: "json",
				postData:{jq_table:jq_table,filter_get_all:filter_get_all,codeint:parentRowKey},
                page: 1,
                colModel:column_child_ca_compo,
				//loadonce: true,
                autowidth: true,
                height:"100%",
				rowNum: 5,
				viewrecords: true,
				//scroll:1,
                pager: "#" + childGridPagerID
            });
			

        }
		
		
		
			
			
			// activate the toolbar searching
            $('#jqGrid').jqGrid('filterToolbar');
			
			$('#jqGrid').jqGrid('navGrid',"#jqGridPager", {                
                search: false, // show search button on the toolbar
                add: admin_per,
                edit: admin_per,
                del: admin_per,
                refresh: true,
				
				
            },
			{
				width:1000,
				closeAfterEdit: true,
				closeAfterAdd:true,
				beforeShowForm: function(form) {
                  // "editmodlist"
                  var dlgDiv = $("#editmodjqGrid");
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
			// Click disable will not edit inline 
			
			$('#jqGrid').jqGrid('navButtonAdd',"#jqGridPager",
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
			
			
			if(jq_table3 == "idx_specs_rt"){
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
						 // dlgDiv[0].style.top = Math.round((parentHeight-dlgHeight)/3) + "px";
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
							//$("#jqGrid2").trigger("reloadGrid");
							$("#edit_jqGrid3").show();
							$("#del_jqGrid3").show();
							$("#add_jqGrid3").show();
							$("#locked_3").children().show();
							
						});
					}}
				);
			}//end if
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
        return new jq_hierarchyView;
});// JavaScript Document