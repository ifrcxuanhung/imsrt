define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var tabledetailView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function() {

            },
            events: {
                
            },
            index: function() {
                var asInitVals = new Array();
                $(document).ready(function(){
                    var name = $('#tablename').val();
                    var grid = new Datatable();
                    grid.init({
                        src: $("#table_detail"),
                        dataTable: {
                            "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'row'<'col-md-8 col-sm-12'><'col-md-6 col-sm-12'pli>>",
                            "bStateSave": true,
                            "bServerSide" : true,
                            "bProcessing": true,
                            "lengthMenu": [
                                [5, 10, 20, 40],
                                [5, 10, 20, 40]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "tabledetail/listdatadetail/?name="+name,
                            },
                            "order": [],
                            "bSort": false,
                            "scrollX": "100%",
                            "bScrollCollapse": false
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
    return new tabledetailView;
});