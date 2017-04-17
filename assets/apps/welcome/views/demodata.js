define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var journalsView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){

            },
            events: {
                 "click .export": "actionExport"
            },
            actionExport: function(event) {
                var $this = $(event.currentTarget);
                var data = {
                                category: $("#category").val(),
                                stype: $("#stype").val(),
                                date_create_start: $("#date_create_start").val(),
                                date_create_end: $("#date_create_end").val(),
                                group: $("#group").val(),
                                sgroup: $("#sgroup").val(),
                                code: $("#code").val(),
                                name: $("#name").val(),
                                d: $("#d").val(),
                                m: $("#m").val(),
                                q: $("#q").val(),
                                y: $("#y").val(),
                                close_from: $("#close_from").val(),
                                close_to: $("#close_to").val(),
                                vard: $("#vard").val(),
                                varm: $("#varm").val(),
                                vary: $("#vary").val(),
                                export_type: $this.attr('file_type')
                            };
                $.ajax({
                    url: $base_url + "demodata/export",
                    type: "POST",
                    data: data,
                    async: false,
                    success: function(response) {
                        location.href = response;
                    }
                });
            },
            index: function(){
                  $(document).ready(function() {
                    var grid = new Datatable();

                    grid.init({
                        src: $("#demodata"),
                        dataTable: {
                            "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'row'<'col-md-6 col-sm-12'><'col-md-6 col-sm-12'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                            "lengthMenu": [
                                [5, 10, 20, 40],
                                [5, 10, 20, 40]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "demodata/list_demodata",
                                "type": "POST"
                            },
                            'aoColumnDefs': [{
                                                'bSortable': false,
                                                'aTargets': ['nosort']
                                            }],
                            "order": []
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
        return new journalsView;
});