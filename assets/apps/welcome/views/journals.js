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
                 "click .export": "actionExport",
                 "click a.view-journal": "actionViewJournal"
            },
            actionViewJournal: function(event) {
                var $this = $(event.currentTarget);
                $.ajax({
                    url: $base_url + "journals/view_journal",
                    type: "POST",
                    dataType: "JSON",
                    data: {id_journal: $this.attr("id_journal")},
                    async: false,
                    success: function(response) {
                        var modal = $("#modal_view");
                        modal.find("input[name=view_id_journal]").val(response.issn);
                        modal.find("div[id=view_coverage]").html(response.filter_coverage);
                        modal.find("div[id=view_category]").html(response.filter_category);
                        modal.find("input[name=view_name]").val(response.name);
                        modal.find("input[name=view_issn]").val(response.issn);
                        modal.find("div[id=view_ranking]").html(response.filter_ranking);
                        modal.find("input[name=view_update]").val(response.update);
                    }
                });
            },
            actionExport: function(event) {
                var $this = $(event.currentTarget);
                $.ajax({
                    url: $base_url + "journals/export",
                    type: "POST",
                    data: $("#form_journals").serialize()+'&'+$.param({export_type: $this.attr("file_type")}),
                    async: false,
                    success: function(response) {
                        location.href = response;
                    }
                });
            },
            index: function(){
                  $(document).ready(function() {
                    var grid = new Datatable();
                   // alert( $("#ranking").val());
                    grid.init({
                        src: $("#journals"),
                        dataTable: {
                            "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'row footer'<'col-md-6 col-sm-12'><'col-md-6 col-sm-12'pli>>",
                           // "dom": "<'row'<'col-md-8 col-sm-12'><'col-md-4 col-sm-12'>r>t<'row'<'col-md-12 col-sm-12 footer'pli>>",
                            "bStateSave": true,
                            "retrieve": true,
                            "lengthMenu": [
                                [10, 20, 50, 100],
                                [10, 20, 50, 100]
                            ],
                            "pageLength": 10,
                            "ajax": {
                                "url": $base_url + "journals/list_journals",
                                "type": "POST"
                            },
                            "order": []
                        }
                    });

                    $("#form_view_journal").validate({
                        submitHandler: function(form) {
                            var data = {
                                issn: $("#view_id_journal").val(),
                                coverage: $("#filter_coverage option:selected").val(),
                                category: $("#filter_category option:selected").val(),
                                name: $("#view_name").val(),
                                issn: $("#view_issn").val(),
                                ranking: $("#filter_ranking option:selected").text(),
                                update: $("#view_update").val()
                            };
                            $.ajax({
                                url: $base_url + 'journals/update_journal',
                                type: 'POST',
                                data: data,
                                async: false,
                                success: function(response) {
                                    if(response == '1') {
                                        window.location.href = $base_url + "journals";
                                    } else {
                                        $("div.alert-danger").fadeIn();
                                    }
                                    $("div.alert").delay(1500).fadeOut();
                                }
                            });
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