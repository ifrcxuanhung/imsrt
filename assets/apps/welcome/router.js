// Filename: router.js
define([
    'jquery',
    'underscore',
    'backbone', ], function($, _, Backbone) {
        var AppRouter = Backbone.Router.extend({
            routes: { 
				
                'welcome': 'welcomeAction',
                'welcome/*path': 'welcomeAction',
                'dashboard': 'dashboardAction',
                'dashboard/*path': 'dashboardAction',
                'setup': 'setupAction',
                'setup/*path': 'setupAction',
                'help': 'helpAction',
                'help/*path': 'helpAction',
                'demodata': 'demodataAction',
                'demodata/*path': 'demodataAction',
                'layout': 'layoutAction',
                'layout/*path': 'layoutAction',
                'demo': 'demoAction',
                'demo/*path': 'demoAction',
				'tab': 'tabAction',
                'tab/*path': 'tabAction',
				'table': 'tableAction',
                'table/*path': 'tableAction',
                'home': 'homeAction',
                'home/*path': 'homeAction',
                'contact': 'contactAction',
                'contact/*path': 'contactAction',
                'profile': 'profileAction',
                'profile/*path': 'profileAction',
				'sysformat': 'sysformat',
            	'sysformat/*path': 'sysformat',
                'table': 'tableAction',
                'table/*path': 'tableAction',
                'login': 'loginAction',
                'login/*path': 'loginAction',
				'jq_loadtable': 'jq_loadtableAction',
                'jq_loadtable/*path': 'jq_loadtableAction',
                'search': 'searchAction',
                'search/*path': 'searchAction',
				'jq_compare': 'jq_compareAction',
                'jq_compare/*path': 'jq_compareAction',
				'jq_compare_two': 'jq_compare_twoAction',
                'jq_compare_two/*path': 'jq_compare_twoAction',
				'reports': 'jq_hierarchyAction',
                'reports/*path': 'jq_hierarchyAction',
				'overview': 'overviewAction',
                'overview/*path': 'overviewAction',
				'indice': 'jq_realtimeAction',
                'indice/*path': 'jq_realtimeAction',
				'stock': 'jq_stockpageAction',
                'stock/*path': 'jq_stockpageAction',
                'webservices': 'webservicesAction',
                'webservices/*path': 'webservicesAction',
                'public_website': 'public_websiteAction',
                'public_website/*path': 'public_websiteAction',
                '*actions': 'defaultAction',

				
            },
            welcomeAction: function(){
                require(['views/welcome'], function(welcomeView){
                    welcomeView.render();
                });
            },
            homeAction: function(){
                require(['views/home'], function(homeView){
                    homeView.render();
                });
            },
            dashboardAction: function(){
                require(['views/dashboard'], function(dashboardView){
                    dashboardView.render();
                });
            },
			 sysformat: function() {
				require(['views/sysformat/list'], function(sysformatView) {
					sysformatView.render();
				});
			},
            setupAction: function(){
                require(['views/setup'], function(setupView){
                    setupView.render();
                });
            },
            helpAction: function(){
                require(['views/help'], function(helpView){
                    helpView.render();
                });
            },
            demodataAction: function(){
                require(['views/demodata'], function(demodataView){
                    demodataView.render();
                });
            },
            layoutAction: function(){
                require(['views/layout'], function(layoutView){
                    layoutView.render();
                });
            },
			 jq_loadtableAction: function(){
                require(['views/jq_loadtable'], function(jq_loadtableView){
                    jq_loadtableView.render();
                });
            },
            searchAction: function(){
                require(['views/search'], function(searchView){
                    searchView.render();
                });
            },
			jq_compareAction: function(){
                require(['views/jq_compare'], function(jq_compareView){
                    jq_compareView.render();
                });
            },
			jq_compare_twoAction: function(){
                require(['views/jq_compare_two'], function(jq_compare_twoView){
                    jq_compare_twoView.render();
                });
            },
			jq_hierarchyAction: function(){
                require(['views/jq_hierarchy'], function(jq_hierarchyView){
                    jq_hierarchyView.render();
                });
            },
			overviewAction: function(){
                require(['views/overview'], function(overviewView){
                    overviewView.render();
                });
            },
			jq_realtimeAction: function(){
                require(['views/jq_realtime'], function(jq_realtimeView){
                    jq_realtimeView.render();
                });
            },
			jq_stockpageAction: function(){
                require(['views/jq_stockpage'], function(jq_stockpageView){
                    jq_stockpageView.render();
                });
            },
            webservicesAction: function(){
                require(['views/webservices'], function(webservicesView){
                    webservicesView.render();
                });
            },
             demoAction: function(){
                require(['views/demo'], function(demoView){
                    demoView.render();
                });
            },
			 tabAction: function(){
                require(['views/tab'], function(tabView){
                    tabView.render();
                });
            },
            contactAction: function(){
                require(['views/contact'], function(contactView){
                    contactView.render();
                });
            },
            profileAction: function(){
                require(['views/profile'], function(profileView){
                    profileView.render();
                });
            },
            tableAction: function(){
                require(['views/table'], function(tableView){
                    tableView.render();
                });
            },
            loginAction: function(){
                require(['views/login'], function(loginView){
                    loginView.render();
                });
            },
            public_websiteAction: function(){
                require(['views/public_website'], function(public_websiteView){
                    public_websiteView.render();
                });
            },
            defaultAction: function(actions) {

            // We have no matching route, lets display the home page
            }
        });
        var initialize = function() {
            var app_router = new AppRouter;
            if (Backbone.history&& !Backbone.History.started) {
                var startingUrl = $base_url.replace(location.protocol + '//' + location.host, "");
                    var pushStateSupported = _.isFunction(history.pushState);
                // Browsers without pushState (IE) need the root/page url in the hash
                if (!(window.history && window.history.pushState)) {
                    window.location.hash = window.location.pathname.replace(startingUrl, '');
                    startingUrl = window.location.pathname;
                }
                Backbone.history.start({ pushState: true, root: startingUrl });
                if (!pushStateSupported) {
                    var fragment = window.location.pathname.substr(Backbone.history.options.root.length);
                    Backbone.history.navigate(fragment, { trigger: true });
                }
            }
            $("div.account").on("click", "a", function(){
                var that = this;
                require(['views/account'], function(accountView){
                    accountView.accountManage(that);
                });
            });
            $("a.forgotten_password").live("click", function(){
                var html = '<form id="forgot-form" method="post">'+
                '<p class="message error no-margin"></p>'+
                '<label style="float: left; width: 90px; margin-left: 62px">E-mail</label>'+
                '<input type="text" name="identity" style="margin-bottom: 10px; width: 250px" /><br />'+
                '<label style="float: left; width: 90px; margin-left: 62px">Captcha</label>'+
                '<div class="field"><img style="margin-left:5px;" src="' + $base_url + 'captcha" />'+
                '<input type="text" style="width: 50px; float: left; height: 24px" name="security_code" class="<?php echo isset($input[\'security_code\']) ? \'error\' : NULL; ?>" />'+
                '</div>'+
                '<label style="float: left; width: 90px; margin-left: 62px">&nbsp;</label>'+
                '<div style="margin-bottom: 10px"><button type="submit" name="submit" class="ui-button">Submit</button></div>'+
                '</form>';
                $("#account-dialog").html(html);
                $("button[name='submit']").click(function(){
                    $.ajax({
                        url: $base_url + 'account/forgotten_password',
                        type: 'post',
                        data: $("#forgot-form").serialize(),
                        success: function(rs){
                            $("#account-dialog p.error").html(rs);
                        }
                    });
                    return false;
                });
            });
        };
        return {
            initialize: initialize
        };
    });