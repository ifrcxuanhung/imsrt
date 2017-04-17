// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone) {
        var userListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function() {

            },
            events: {
                "click a.action-delete": "doDelete",
                "click a.action-change-active": "changeActive"
            },
            doDelete: function(event) {
                var $this = $(event.currentTarget);
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
                            var id = $($this).attr('user_id');
                            $.ajax({
                                type: "POST",
                                url: $admin_url + "users/delete",
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
            changeActive: function(event) {
                var $this = $(event.currentTarget);
                var id=$($this).attr('user_id');
                var text=$($this).text();
                var anchor = $this;
                if (anchor.data("disabled")) {
                    return false;
                }
                anchor.data("disabled", "disabled");
                $("#lean_overlay").show();
                $.ajax({
                    type: "POST",
                    url: $admin_url+"users/chang_active",
                    data: "id="+id + "&text=" + text,
                    success: function(text){
                        if(typeof text !== "undefined"){
                            if(text == "Active") {
                                $($this).css("color", "green");
                            }
                            else if(text == "Inactive") {
                                $($this).css("color", "red");
                            }
                            $($this).text(text);
                        }
                        anchor.removeData("disabled");
                        $("#lean_overlay").hide();
                    }
                });
            },
            doGetFormServices: function(event) {
                var $this = $(event.currentTarget);
                var $groupId = $($this).val();
                $.ajax({
                    type: 'POST',
                    url: $admin_url + "users/get_form_services",
                    data: 'id=' + $groupId,
                    success: function(rs) {
                        $('.services-content').html(rs);
                        generalApply();
                        $(document.body).applyTemplateSetup();
                    }
                });
            },
            index: function() {
                $(document).ready(function()
                {
                    if (check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')) {
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    } else {
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    oTable = $('.table-user-list').dataTable({
                        "oLanguage": {
                            "sUrl": $file
                        },
                        "iDisplayLength": 10,
                        "iDisplayStart": 0,
                        "aaSorting": [],
                        "oSearch": {
                            "sSearch": ""
                        },
                        "sAjaxSource": $admin_url + "users/listdata",
                        "aoColumns": [
                        {
                            "mData": "id",
                            "sType":"string"
                        },
                        {
                            "mData": "first_name",
                            "sType":"string"
                        },
                        {
                            "mData": "last_name",
                            "sType":"string"
                        },
                        {
                            "mData": "email",
                            "sType":"string"
                        },
                        {
                            "mData": "group",
                            "sType":"string"
                        },
                        {
                            "mData": "active",
                            "sType":"string"
                        },
                        {
                            "mData": "action",
                            "sType":"string"
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
            services: function() {
            
            },
            render: function() {
                if (typeof this[$app.action] != 'undefined') {
                    new this[$app.action];
                }
            }
        });
        return new userListView;
    });
