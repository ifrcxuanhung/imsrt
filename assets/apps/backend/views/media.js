// Filename: views/projects/list
define([
    'jquery',
    'underscore',
    'backbone'
    ], function($, _, Backbone){
        var mediaListView = Backbone.View.extend({
            el: $(".main-container"),
            initialize: function(){
            },
            events: {
                "click a.action-delete": "doDelete",
                "click a.media-active": "doActive",
                "change select[name='media-category']": "doChangeParentCate"
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
                            var id = $($this).attr('media_id');
                            $.ajax({
                                type: "POST",
                                url: $admin_url + "media/delete",
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
            doActive:function(event){
                var $this=$(event.currentTarget);
                //if (confirm('Are you sure')) {
                var id=$($this).attr('media_id');
                var text=$($this).text();
                var anchor = $this;
                if (anchor.data("disabled")) {
                    return false;
                }
                anchor.data("disabled", "disabled");
                $("#lean_overlay").show();
                $.ajax({
                    type: "POST",
                    url: $admin_url+"media/chang_active",
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
                        anchor.removeData("disabled");
                        $("#lean_overlay").hide();
                    }
                });
            //}
            },
            doChangeParentCate :function(event){
                var $this=$(event.currentTarget);
                $this.find('option').not(':selected').removeAttr("selected");
                var id = $("select[name='media-category']").val();
                $this.find('option:selected').attr("selected", "selected");
                var $html=$('.block-controls').html();
                if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                    $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                }else{
                    $file = $base_url + 'assets/language/datatables/eng.txt';
                }
                if(typeof oTable != 'undefined'){
                    oTable.fnDestroy();
                }
                oTable = $('.table-media-list').dataTable({
                    "oLanguage":{
                        "sUrl": $file
                    },
                    "iDisplayLength":10,
                    "iDisplayStart": 0,
                    "bProcessing": true,
                    "oSearch": {"sSearch": ""},
                    "aaSorting": [],
                    "sAjaxSource": $admin_url+"media/listdata/" + id,
                    "fnServerData": function(sSource, aoData, fnCallback) {
                        aoData.push();
                        $.ajax( {
                            "dataType": 'json',
                            "type": "POST",
                            "url": sSource,
                            "data": aoData,
                            "success": fnCallback
                        });
                    },
                    "aoColumns": [
                    {
                        "mData": "id"
                    },
                    {
                        "mData": "title"
                    },
                    {
                        "mData": "description"
                    },
                    {
                        "mData": "category"
                    },
                    {
                        "mData": "sort_order"
                    },
                    {
                        "mData": "type"
                    },
                    {
                        "mData": "status"
                    },
                    {
                        "mData": "image"
                    },
                    {
                        "mData": "action"
                    },
                    ],
                    "sPaginationType": "full_numbers",
                    sDom: '<"block-controls"<"controls-buttons"p>f>rti<"block-footer clearfix"l>',
                    "bFilter": true,
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
                        $(".table-media-list").siblings(".block-controls").html($html);
                    }
                });
            },
            index: function(){
                $(document).ready(function()
                {
                    $id = $("select[name='media-category']").val();
                    if(check_file_exists($base_url + 'assets/language/datatables/' + $lang + '.txt')){
                        $file = $base_url + 'assets/language/datatables/' + $lang + '.txt';
                    }else{
                        $file = $base_url + 'assets/language/datatables/eng.txt';
                    }
                    oTable = $('.table-media-list').dataTable({
                        "oLanguage":{
                            "sUrl": $file
                        },
                        "iDisplayLength":10,
                        "iDisplayStart": 0,
                        "bProcessing": true,
                        "oSearch": {
                            "sSearch": ""
                        },
                        "aaSorting": [],
                        "sAjaxSource": $admin_url+"media/listdata/" +$id,
                        "aoColumns": [
                        {
                            "mData": "id"
                        },
                        {
                            "mData": "title"
                        },
                        {
                            "mData": "description"
                        },
                        {
                            "mData": "category"
                        },
                        {
                            "mData": "sort_order"
                        },
                        {
                            "mData": "type"
                        },
                        {
                            "mData": "status"
                        },
                        {
                            "mData": "image"
                        },
                        {
                            "mData": "action"
                        },
                        ],
                        "sPaginationType": "full_numbers",
                        sDom: '<"block-controls"<"controls-buttons"p>f>rti<"block-footer clearfix"l>',
                        "bFilter": true,
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
        return new mediaListView;
    });
