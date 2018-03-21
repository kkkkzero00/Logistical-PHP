$(function(){
    //console.log(_SELF_);

    $.extend({
        /**
         * URL参数解析，默认解析当前URL
         * 获取GET参数的值： $.url('?[param]', [url])
         * 获取锚点的值： $.url('#[param]', [url])
         * 类PHP parse_url：$.url('parse', [url])
         * 获取所在域名：$.url('domain', [url])
         */
        url: function(arg, url){
            url = url || location.href;
            if(!arg) return url;
            if('?' === arg.charAt(0) || '#' === arg.charAt(0)){
                var params = {},
                    key = arg.split(arg.charAt(0))[1],
                    reg = '?'===arg.charAt(0) ? /.+\?([^#]+).*/ : /.+#(.+)/;
                query = url.replace(reg, "$1");
                if(query){
                    var parts = query.split("&"), kv;
                    for(var i = 0, ii = parts.length; i < ii; i++){
                        kv = parts[i].split("=");
                        params[kv[0]] = kv[1];
                    }
                }
                return key ? params[key] || '' : params;
            }

            var parse = arguments[1] ? url.match(/([^\/]*\/\/:)?([^(\/\?#)]*)(\/?[^(\?#)]*)\??([^#]*)#?(.*)/) : window.location;
            switch(arg){
                case 'parse':
                    if(!arguments[1]) {
                        return {
                            host: parse.hostname,
                            port: parse.port,
                            path: parse.pathname,
                            query: parse.search.replace(/^\?/, ''),
                            fragment: parse.hash.replace(/^#/, '')
                        }
                    }else{
                        var host = parse[1] && parse[2].split(':') || {};
                        return {
                            host: host[0],
                            port: host[1],
                            path: parse[1] ? parse[3] : parse[2]+parse[3],
                            query: parse[4],
                            fragment: parse[5]
                        }
                    }
                    break;
                case 'domain':
                    var hostname = parse.hostname || parse[1].split(':')[0];
                    // 判断是否是IP：
                    if (/^(([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])\.){3}([0-9]|[1-9][0-9]|1[0-9]{2}|2[0-4][0-9]|25[0-5])$/.test(hostname)) return hostname;
                    var arr = hostname.split('.');
                    if(arr.length > 2) arr.shift();
                    return arr.join('.');
            }
        },
        /**
         * 类ThinkPHP U方法
         */
        U: function(parse, data){
            var parse = $.url('parse', parse);
            var url = '';
            if(!parse.path) {
                url = _ACTION_;
            }else{
                var path = parse.path.split('/');
                switch(path.length){
                    case 3:
                        url = _INDEX_;
                        break;
                    case 2:
                        url = _MODULE_;
                        break;
                    case 1:
                        url = _CONTROLLER_;
                        break;
                }
                url += '/'+parse.path;
            }
            var addQuery = function(url, query){
                if(!query) return url;
                if(url.indexOf('?') > -1) return url+'&'+query;
                return url+'?'+query;
            };
            if(!data) return addQuery(url, parse.query) + (parse.fragment ? '#'+parse.fragment : '');
            var params = [];
            for(var i in data) params.push(i + '=' + (data[i] || ''));
            return addQuery(addQuery(url, parse.query), params.join('&')) + (parse.fragment ? '#'+parse.fragment : '');
        }

    });

    $('.search-btn').on('click',function(e){
        e.stopPropagation();

        var input = $('[name="search"]').val();
        if(!$.trim(input)){
            e.preventDefault();
            $('[name="search"]').val("").focus();
            return bootbox.alert('检索内容不可为空!');
        }
    });

    var url_arr = _SELF_.split('/');
    var ii = '';

    $.each(url_arr, function(i, value) {
        if(value == 'content_id'){
            ii = i;
        }
    });

    if(url_arr[ii] == 'content_id'){
        $.get($.U('Article/ajax_get_category_id'),{content_id:url_arr[ii+1]},function(r){

            if(r.status) {
                url_arr[ii-1] = 'category';
                url_arr[ii] = 'category_id';
                url_arr[ii+1] = r.data;
                _SELF_ = url_arr.join('/');
                $('.navbar-nav a').each(function(i){
                    if($(this).attr('href') == _SELF_ ){
                        $(this).parents('.dropdown').addClass('active');
                    }
                });
                $('.side-nav a').each(function(){
                    if($(this).attr('href') == _SELF_ ){
                        $(this).children('li').addClass('active');
                    }
                });
            }
        });
    }else{
        $('.navbar-nav a').each(function(i){
            if($(this).attr('href') == _SELF_ ){
                $(this).parents('.dropdown').addClass('active');
            }
        });
        $('.side-nav a').each(function(){
            if($(this).attr('href') == _SELF_ ){
                $(this).children('li').addClass('active');
            }
        });
    }

    $('.navbar-nav li').each(function(){
        $(this).on('mouseenter',function(){
           $(this).addClass('open');
        });
        $(this).on('mouseleave',function(){
            $(this).removeClass('open');
        });
    });

});