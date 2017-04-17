define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var dashboardView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },
            events: {
            },
            actionChange: function(event){
              //  var $this = $(event.currentTarget);
//                window.location.href = $base_url + "dashboard/index/?callput=" + $("#callput option:selected").val() + "&expiry=" + $("#expiry option:selected").val();
            },
            index: function(){
                    var table = $('#dashboard');
                    /* Formatting function for row details */
                    function fnFormatDetails(oTable, nTr){
                        var aData = oTable.fnGetData(nTr);
                        var level1 = aData[1];
                        //var sOut = '123456789';
                        var rs = $.parseJSON($.ajax({
                                url: $base_url + 'dashboard/listChilren',
                                type: 'POST',
                                data: 'level1=' + level1,
                                async: false,
                                success: function(response) {
                                    var obj = JSON.parse(response);
                                     // day la chuoi do
                                   // console.log(obj.tabchild);
                                    
                                }
                        }).responseText);
                        var sOut = '<table class="table table-striped table-bordered table-hover nopadding no-margin">';
                          sOut += '<thead>';
                          sOut += '<tr>'
                          sOut += '<th style="width:9.6%;"></th>';
                          sOut += '<th style="width:10%;"></th>';
                          sOut += '<th style="width:5%;"></th>';
                          sOut += '<th style="width:5%;"></th>';
                          sOut += '<th style="width:6%;"></th>';
                          sOut += '<th style="width:8%;"></th>';
                          sOut += '<th style="width:8%;"></th>';
                          sOut += '<th style="width:11.7%;"></th>';
                          sOut += '<th style="width:8%;"></th>';
                          sOut += '<th></th>';
                          sOut += '</tr>';
                          sOut += '</thead>';                          
                         Object.keys(rs).forEach(function(key) {
                            var arr = $.map(rs[key], function(value) {
                                return [value];
                            });
                            sOut += '<tr>';
                            for (i = 2; i < arr.length; i++) {
                               sOut += '<td>'+ arr[i] +'</td>';
                              
                            }
                             sOut += '</tr>';
                        });
                        sOut += '</table>';
                        return sOut;
                    }
                    /*
                     * Insert a 'details' column to the table
                     */
                    var nCloneTh = document.createElement('th');
                    nCloneTh.className = "table-checkbox";
            
                    var nCloneTd = document.createElement('td');
                    nCloneTd.innerHTML = '<span class="row-details row-details-close"></span>';
            
                    table.find('thead tr').each(function () {
                        this.insertBefore(nCloneTh, this.childNodes[0]);
                    });
            
                    table.find('tbody tr').each(function () {
                        this.insertBefore(nCloneTd.cloneNode(true), this.childNodes[0]);
                    });
            
                    /*
                     * Initialize DataTables, with no sorting on the 'details' column
                     */
                    var oTable = table.dataTable({
                        "columnDefs": [{
                            "orderable": false,
                            "targets": [0]
                        }],
                        "order": [
                            [1, 'asc']
                        ],
                        "sDom": '<"top"><"bottom"><"clear">',
                       // "lengthMenu": [
//                            [5, 15, 20, -1],
//                            [5, 15, 20, "All"] /*  change per page values here */
//                        ],
                        /* set the initial value */
                        "pageLength": 20,
                        "bSort": false
                    });
                    // var tableWrapper = $('#dashboard_wrapper'); /* datatable creates the table wrapper by adding with id {your_table_jd}_wrapper */

                    // tableWrapper.find('.dataTables_length select').select2();  /* initialize select2 dropdown */
            
                    /* Add event listener for opening and closing details
                     * Note that the indicator for showing which row is open is not controlled by DataTables,
                     * rather it is done here
                     */
                    table.on('click', ' tbody td .row-details', function () {
                        var nTr = $(this).parents('tr')[0];
                        if (oTable.fnIsOpen(nTr)) {
                            /* This row is already open - close it */
                            $(this).addClass("row-details-close").removeClass("row-details-open");
                            oTable.fnClose(nTr);
                        } else {
                            /* Open this row */
                            $(this).addClass("row-details-open").removeClass("row-details-close");
                            oTable.fnOpen(nTr, fnFormatDetails(oTable, nTr), 'details');
                        }
                    });
                      
                },
                render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new dashboardView;
});