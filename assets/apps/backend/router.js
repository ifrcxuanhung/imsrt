// Filename: router.js
define([
    'jquery',
    'underscore',
    'backbone', ], function($, _, Backbone) {
    var AppRouter = Backbone.Router.extend({
        routes: {
            'category': 'category',
            'category/*path': 'category',
            'users': 'users',
            'users/*path': 'users',
            'resource': 'resource',
            'resource/*path': 'resource',
            'article': 'article',
            'article/*path': 'article',
			'newsletter': 'newsletter',
            'newsletter/*path': 'newsletter',
			'request': 'request',
            'request/*path': 'request',
            'menu': 'menu',
            'menu/*path': 'menu',
            'page': 'page',
            'page/*path': 'page',
            'language': 'language',
            'language/*path': 'language',
            'translate': 'translate',
            'translate/*path': 'translate',
            'media': 'media',
            'media/*path': 'media',
            'help': 'help',
            'help/*path': 'help',
            'sysformat': 'sysformat',
            'sysformat/*path': 'sysformat',
            'home': 'home',
            'home/*path': 'home',
            'import': 'importIndexes',
            'import/all': 'importIndexes',
            'import/': 'importIndexes',
            'document': 'document',
            'document/*path': 'document',
            'services': 'services',
            'services/*path': 'services',
            'news': 'news',
            'news/*path': 'news',
            'product': 'product',
            'product/*path': 'product',
            'config': 'config',
            'config/*path': 'config',
            '*actions': 'defaultAction'
        },
        product: function() {
            require(['views/product'], function(productView) {
                productView.render();
            });
        },
        news: function() {
            require(['views/news'], function(newsView) {
                newsView.render();
            });
        },
        home: function() {
            require(['views/home/list'], function(homeView) {
                homeView.render();
            });
        },
        sysformat: function() {
            require(['views/sysformat/list'], function(sysformatView) {
                sysformatView.render();
            });
        },
        category: function() {
            require(['views/category/list'], function(categoryView) {
                categoryView.render();
            });
        },
        users: function() {
            require(['views/users'], function(userView) {
                userView.render();
            });
        },
        resource: function() {
            require(['views/resource'], function(resourceView) {
                resourceView.render();
            });
        },
        services: function() {
            require(['views/services/list'], function(servicesView) {
                servicesView.render();
            });
        },
        article: function() {
            require(['views/article'], function(articleView) {
                articleView.render();
            });
        },
		newsletter: function() {
            require(['views/newsletter'], function(newsletterView) {
                newsletterView.render();
            });
        },
        request: function() {
            require(['views/request'], function(requestView) {
                requestView.render();
            });
        },
        menu: function() {
            require(['views/menu'], function(menuView) {
                menuView.render();
            });
        },
        page: function() {
            require(['views/page'], function(pageView) {
                pageView.render();
            });
        },
        language: function() {
            require(['views/language'], function(languageView) {
                languageView.render();
            });
        },
        translate: function() {
            require(['views/translate'], function(translateView) {
                translateView.render();
            });
        },
        media: function() {
            require(['views/media'], function(mediaView) {
                mediaView.render();
            });
        },
        help: function() {
            require(['views/help'], function(helpDetailView) {
                helpDetailView.render();
            });
        },
        document: function() {
            require(['views/document'], function(documentView) {
                documentView.render();
            });
        },
        config: function() {
            require(['views/config'], function(configView) {
                configView.render();
            });
        },
        defaultAction: function(actions) {
            // We have no matching route, lets display the home page
        }
    });
    var initialize = function() {
        var app_router = new AppRouter;
		if (Backbone.history&& !Backbone.History.started) {
            var startingUrl = $admin_url.replace(location.protocol + '//' + location.host, "");
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
    };
    return {
        initialize: initialize
    };
});