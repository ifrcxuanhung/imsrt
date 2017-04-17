define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var layoutView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },
            events: {
            },
            index: function(){
                  $(document).ready(function() {
                    var grid = new Datatable();

                    grid.init({
                        src: $("#layout"),
                        dataTable: {
                            "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'footer'<'col-md-6'><'col-md-6'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                            "lengthMenu": [
                                [5, 10, 20, 40],
                                [5, 10, 20, 40]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "layout/list_layout",
                                "type": "POST"
                            },
                            'scrollX': true,
                            'aoColumnDefs': [{
                                                'bSortable': false,
                                                'aTargets': ['nosort']
                                            }],
                            "order": [],
                            "fnRowCallback": function( nRow, aData, iDisplayIndex, iDisplayIndexFull ) {
                                    $('[data-toggle="tooltip"]', nRow).tooltip({html:true}); 
                            },
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
        return new layoutView;
});