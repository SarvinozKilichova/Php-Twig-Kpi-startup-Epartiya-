var App = {
    pinger: false,
    init: function() {
        jQuery.ajaxSetup({
            accepts: {
                json:"application/json"
            }
        });
        return this;
    },
    run: function() {
        App.initializePinger();
		return this;
    },
    redirect: function (url) {
        if(url && url.length > 0) {
            window.location.href = url;
        }
    },
    refresh: function() {
        location.reload();
    },
    initializePinger: function() {
        App.pinger = setInterval(App.ping, 1000 * 60 * 5);
    },
    ping: function() {
        /*$.ajax({
            url: '/pinger',
            dataType: 'json',
            type: 'post',
            success: function(result) {
                if(result.error != 0) {
                    App.refresh();
                }
            }
        });*/
    }
};

App.init().run();

