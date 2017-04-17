// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var configView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click button.update-config-info": "update"
            },
            update: function(event){
                var $this=$(event.currentTarget);
                var $title = trans("confirmation", 1);
                var $content = "";
                $("#lean_overlay").show();
                var $post = {
                    title_website: $('input[name=title_website]').val(),
                    logo_website: $('input[id=image]').val(),
                    facebook: $('input[name=facebook]').val(),
                    meta_des: $('textarea[name=meta_des]').val(),
                    meta_key: $('textarea[name=meta_key]').val()
                };
                $.ajax({
                    type: "POST",
                    url: $admin_url + "config/update",
                    data: $post,
                    success: function(){
                        $content = trans("update", 1) + " " + trans("successful", 1) + "!";
                        $("#lean_overlay").hide();
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
                    },
                    error: function(jqXHR, exception) {
                        ajaxError(jqXHR, exception);
                        $content = trans("error", 1) + " " + trans("unsuccessful", 1) + "!";
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
                });
            },
            index: function(){
                $(document).ready(function()
                {
                    });
            },
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return configView = new configView;
    });
