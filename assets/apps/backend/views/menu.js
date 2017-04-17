// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var menuListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click a.action-delete": "doDelete",
                "click input.action-change-status": "doChangeStatus"
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
                            var id = $($this).attr('menu_id');
                            $.ajax({
                                type: "POST",
                                url: $admin_url + "menu/delete",
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
            doChangeStatus : function(event){
                var $this=$(event.currentTarget);
                var status='unchecked';
                var id = $($this).attr('menu_id');
                if($($this).prop('checked')){
                    status = 'checked';
                }
                $.ajax({
                    url: $base_url + 'backend/menu/active',
                    type: 'post',
                    data: 'status=' + status + '&id=' + id,
                    async: false,
                    success: function(html){
                        if(html == 'success'){
                            var $title = trans("confirmation", 1);
                            var $content = trans("successful", 1) + "!";
                            $.modal({
                                content: $content,
                                title: $title,
                                maxWidth: 2500,
                                width: 400,
                                buttons: {
                                    'Close': function() {
                                        $("#modal").remove();
                                    }
                                }
                            });
                            $(".modal-window .block-content .block-footer").find("button:eq(0)").attr("class", "red");
                        }
                    }
                });
            },
            index: function(){
                $(document).ready(function()
                {
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    oTable = $('.table-menu-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "iDisplayLength":10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "oSearch": {"sSearch": ""},
                        "aaSorting": [],
                        "sAjaxSource": $admin_url+"menu/listdata",
                        "aoColumns": [
                        {
                            "mData": "id"
                        },
                        {
                            "mData": "name"
                        },
                        {
                            "mData": "link"
                        },
                        {
                            "mData": "sort_order"
                        },
                        {
                            "mData": "status"
                        },
                        {
                            "mData": "actions"
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
        return new menuListView;
    });
