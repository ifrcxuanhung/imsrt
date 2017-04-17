// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var pageListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click a.action-delete": "doDelete"
            },
            doDelete:function(event){
                var $this=$(event.currentTarget);
                var $title = trans("confirmation", 1);
                var $content = trans("do_you_want_to", 1) + " " + trans("delete", 1) + "?";
                $.modal({
                    content: $content,
                    title: $title,
                    maxWidth: 2500,
                    width: 400,
                    buttons: {
                        'Yes': function() {
                            $("#modal").remove();
                            var id = $($this).attr('page_id');
                            $.ajax({
                                type: "POST",
                                url: $admin_url + "page/delete",
                                data: "id=" + id,
                                success: function(msg) {
                                    if (msg >= 1) {
                                        $($this).parents('tr').fadeOut('slow');
                                    }
                                }
                            });
                        },
                        'No': function() {
                            $("#modal").remove();
                        }
                    }
                });
                $(".modal-window .block-content .block-footer").find("button:eq(1)").attr("class", "red");                
            },
            index: function(){
                $(document).ready(function()
                {
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    oTable = $('.table-page-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "oSearch": {"sSearch": ""},
                        "iDisplayLength":10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "aaSorting": [],
                        "sAjaxSource": $admin_url+"page/listdata",
                        "aoColumns": [
                        {
                            "mData": "id"
                        },
                        {
                            "mData": "name"
                        },
                        {
                            "mData": "layout_id"
                        },
                        {
                            "mData": "code"
                        },
                        {
                            "mData": "action"
                        }
                        ],
                        "sPaginationType": "full_numbers",
                        sDom: '<"block-controls"<"controls-buttons"p>f>rti<"block-footer clearfix"l>',

                        /* Callback to apply template setup*/
                        fnDrawCallback: function()
                        {
                            this.parent().applyTemplateSetup();
                            $(this).slideDown(200);
                        },
                        fnInitComplete: function()
                        {
                            this.parent().applyTemplateSetup();
                            $(this).slideDown(200);
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
        return new pageListView;
    });
