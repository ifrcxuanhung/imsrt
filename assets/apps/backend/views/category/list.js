// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone',
    'text!templates/category/list.html'
    ], function($, _, Backbone, categoryListTemplate){
        var categoryListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click a.action-delete": "doDelete",
                "change select[name='category']": "doChangeParentCate",
                "click a.category-active": "doActive"
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
                            var id = $($this).attr('category_id');
                            $.ajax({
                                type: "POST",
                                url: $admin_url + "category/delete",
                                data: "id=" + id,
                                success: function(msg) {
                                    $("#modal").remove();
                                    if (msg >= 1) {
                                        $($this).parents('tr').fadeOut('slow');
                                    } else {
                                        $.modal({
                                            content: trans("child_category_still_exists", 1) + "!",
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
                        'No': function() {
                            $("#modal").remove();
                        }
                    }
                });
                $(".modal-window .block-content .block-footer").find("button:eq(1)").attr("class", "red");
            },
            doActive:function(event){
                var $this=$(event.currentTarget);
                //if (confirm('Are you sure')) {
                var id=$($this).attr("category_id");
                var text=$($this).text();
                $("#loading").show();
                $.ajax({
                    type: "POST",
                    url: $admin_url+"category/chang_active",
                    data: "id="+id + "&text=" + text,
                    success: function(text){
                        if(typeof text !== "undefined"){
                            if(text == "Enable") {
                                $($this).css("color", "green");
                            }
                            else if(text == "Disable") {
                                $($this).css("color", "red");
                            }
                            $($this).text(text);
                        }
                        $("#loading").hide();
                    }
                });
            //}
            },
            doChangeParentCate :function(event){
                var $this=$(event.currentTarget);
                var id = $this.val();
                window.location = $base_url + 'backend/category/index/' + id;
            },
            index: function(){
                $(document).ready(function()
                {
                    var $string = document.URL;
                    var $str_arr = $string.split('/');
                    $id = $str_arr[$str_arr.length - 1];
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    oTable = $('.table-category-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "iDisplayLength":10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "aaSorting": [],
                        "sAjaxSource": $admin_url+"category/listdata/" + $id,
                        "aoColumns": [
                        {
                            "mData": "category_id"
                        },
                        {
                            "mData": "name"
                        },
                        {
                            "mData": "sort_order"
                        },
                        {
                            "mData": "status"
                        },
                        {
                            "mData": "thumb"
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
                var data={};
                var compiledTemplate = _.template( categoryListTemplate, data );
                $("#page").html( compiledTemplate );
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return new categoryListView;
    });
