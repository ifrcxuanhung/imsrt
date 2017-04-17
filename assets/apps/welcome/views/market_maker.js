define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone) {
        var market_makerView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function() {

            },
            events: {
                
            },
            index: function() {
                $(document).ready(function() {

                });
            },
            pricing: function() {
                function update() {
                    $.ajax({
                        type: "POST",
                        url: $base_url + "market_maker/getPrice_realtime/?callput=" + $("#callput option:selected").val() + "&expiry=" + $("#expiry option:selected").val(),
                        dataType: "JSON",
                        async: false,
                        success: function(response) {
                            var rs = response;
                            $("#feed_update").html("(" + rs.date + " | " + rs.time + ")");
                            $("#feed_price").val(rs.idx_last);
                            $("#tablePricing tbody").html(rs.table);
                        }
                    });
                    t = setTimeout(function() {
                        update();
                    }, 15000);
                }
                setTimeout(
                    function() {
                        update();
                    }, 15000
                );
            },
            render: function() {
                if(typeof this[$app.action] != 'undefined') {
                    new this[$app.action];
                }
            }
        });
        return new market_makerView;
    });