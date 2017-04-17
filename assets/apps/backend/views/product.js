// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone) {
        var productListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function() {
            },
            events: {
                "click button.action-upload-product-accessory": "doUpload"
            },
            doUpload: function(event) {
                var $this = $(event.currentTarget);
                var $title = trans("confirmation", 1);
                var $content = trans("do_you_want_to", 1) + " " + trans("upload", 1) + " " + trans("product", 1) + "?";
                var $result = trans("finish", 1);
                $.modal({
                    content: $content,
                    title: $title,
                    maxWidth: 2500,
                    width: 400,
                    buttons: {
                        'Yes': function() {
                            $("#modal").remove();
                            $('#lean_overlay').show();
                            $.ajax({
                                type: "POST",
                                url: $admin_url + "product/upload_product",
                                success: function(rs) {
                                    $('#lean_overlay').hide();
                                    rs = JSON.parse(rs);
                                    if(typeof rs.empty != "undefined" && rs.empty == "1") {
                                        if(typeof rs.folder != "undefined" && rs.folder != "") {
                                            $.ajax({
                                                type: "POST",
                                                data: "dir=images&newDir=" + rs.folder,
                                                async: false,
                                                url: $base_url + "assets/bundles/kcfinder/browse.php?type=images&lng=en&act=newDir"
                                            });
                                        }
                                    }
                                    $.modal({
                                        content: rs.err,
                                        title: $title,
                                        maxWidth: 2500,
                                        width: 400,
                                        buttons: {
                                            'Close': function() {
                                                window.location.href = $admin_url + "product";
                                            }
                                        }
                                    });
                                    $(".modal-window .block-content .block-footer").find("button:eq(0)").attr("class", "red");
                                },
                                error: function(jqXHR, exception) {
                                    ajaxError(jqXHR, exception);
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
            index: function() {
                $(document).ready(function()
                {
                    if (check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')) {
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    } else {
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    oTable = $('.table-product-list').dataTable({
                        "oLanguage": {
                            "sUrl": $file
                        },
                        "iDisplayLength":10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "oSearch": {
                            "sSearch": ""
                        },
                        "aaSorting": [],
                        "sAjaxSource": $admin_url+"product/listdata",
                        "aoColumns": [
                        {
                            "mData": "id"
                        },
                        {
                            "mData": "name"
                        },
                        {
                            "mData": "intro"
                        },
                        {
                            "mData": "type"
                        },
                        {
                            "mData": "image"
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
            render: function() {
                if (typeof this[$app.action] != 'undefined') {
                    new this[$app.action];
                }
            }
        });
        return new productListView;
    });
