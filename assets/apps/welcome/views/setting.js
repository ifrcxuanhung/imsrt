// Filename: views/welcome
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var welcomeView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "change #indexCode" : "changeindexCode",
                "click #saveContentOption": "actionSaveContentOption",
                "click #saveContentMarket": "actionSaveContentMarket",
            },
            index: function(){
            },
            
            changeindexCode: function(event){
                var $this = $(event.currentTarget);
                var $code = $('#indexCode').val();
                alert($code);
            },
            actionSaveContentOption: function(event){
              //  var $this = $(event.currentTarget);
//                var user_id = $this.attr('user_id');
//                var job_id =  $this.attr('job_id');
//                var idcal_id = $this.attr('idcal_id');
//                var order = $this.parent().find('input[name="order"]').val();
//                    $.ajax({
//                        url: $base_url + 'ajax/update_sort_order_task_ld',
//                        type: 'POST',
//                        data: 'user_id=' + user_id + '&job_id=' + job_id + '&idcal_id=' + idcal_id + '&order=' + order,
//                        success: function(data) {
//                            var _this = $this;
//                            if(data) {
//                                _this.parent().find('.button1').hide();
//                                _this.parent().find('.button').hide();
//                            } else{
//                            alert('Chua c?p nh?t du?c');}
//                        }
//                    });
            },
            
            render: function(){
                if(typeof this[$app.action] != 'undefined'){
                    new this[$app.action];
                }
            }
        });
        return welcomeView = new welcomeView;
});
