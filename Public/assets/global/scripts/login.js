/**
 * 登录页
 */
var Login = function () {

    jQuery.extend(jQuery.validator.messages, {
        required: "必选字段",
        remote: "请修正该字段",
        email: "请输入正确格式的电子邮件",
        url: "请输入合法的网址",
        date: "请输入合法的日期",
        dateISO: "请输入合法的日期 (ISO).",
        number: "请输入合法的数字",
        digits: "只能输入整数",
        creditcard: "请输入合法的信用卡号",
        equalTo: "请再次输入相同的值",
        accept: "请输入拥有合法后缀名的字符串",
        maxlength: jQuery.validator.format("请输入一个 长度最多是 {0} 的字符串"),
        minlength: jQuery.validator.format("请输入一个 长度最少是 {0} 的字符串"),
        rangelength: jQuery.validator.format("请输入 一个长度介于 {0} 和 {1} 之间的字符串"),
        range: jQuery.validator.format("请输入一个介于 {0} 和 {1} 之间的值"),
        max: jQuery.validator.format("请输入一个最大为{0} 的值"),
        min: jQuery.validator.format("请输入一个最小为{0} 的值")
    });
	var handleLogin = function() {
		$('.login-form').validate({
	            rules: {
	                hy_username: {
	                    required: true,
	                    digits:true
	                },
	                hy_password: {
	                    required: true
	                },
	                remember: {
	                    required: false
	                }
	            },
	            messages: {
	                hy_username: {
	                    required: "<span style='color:#ff3c04;font-size:8px;'>学号不可为空！</span>",
                        digits: "<span style='color:#ff3c04;font-size:8px;'>只能输入数字</span>"
                    },
	                hy_password: {
	                    required: "<span style='color:#ff3c04;font-size:8px;'>密码不可为空！</span>"
	                }
	            },
	            submitHandler: function (form) {
                    var modal = $(form).find('.modal-body');
	    			var account = $.trim($('[name="hy_username"]').val());
                   // console.log(account);
        			var pwd = crypto_sha1($.trim($('[name="hy_password"]').val())+$('#login-addon').val());
                   // console.log(pwd);
                    var btn = $(form).find("#login-submit").button('loading');
                    //btn.button('reset');
                    $.ajax({
        				url: $.U('User/ajax_do_login'),
        				data: {u: crypto_aes(account, $('#login-key').val()), p: crypto_aes(pwd, pwd.substr(5, 32))},
        				type: 'POST',
        				timeout: 5000,
        				success: function(r){
                            //console.log(r);
                            if(!r.status){
                                modal.html(r.info);
                                $("#loginModal").modal('toggle');
                                $("#loginModal").on('click',function(){
                                    btn.button('reset');
                                });
                            }else{
                                modal.html(r.info);
                                $("#loginModal").modal('toggle');
                                $("#loginModal").on('click',function(){
                                    btn.button('reset');
                                });
                                setTimeout(function(){
                                    location.href = $.U('Index/index');
                                }, 1000);
                                $("#loginModal #login-btn").on('click',function(){
                                    location.href = $.U('Index/index');
                                });
                            }
    	            	},
    	            	error: function(){
                            modal.html('登录失败，请重试！');
                            $("#loginModal").modal('toggle');
                            $("#loginModal #login-btn").on('click',function(){
                                btn.button('reset');
                                location.reload();
                            });
    	            	}
        			});
	            }
	        });
	}

    var handlePassword = function(){
        $('.pwd-form').validate({
            rules: {
                hy_old_password: {
                    required: true
                },
                hy_new_password: {
                    required: true
                },
                hy_confirm_password: {
                    required: true,
                    equalTo: "#hy_new_password"
                }
            },
            messages: {
                hy_old_password: {
                    required: "<span style='color:#ff3c04;font-size:8px;'>旧密码不可为空！</span>"
                },
                hy_new_password: {
                    required: "<span style='color:#ff3c04;font-size:8px;'>新密码不可为空！</span>"
                },
                hy_confirm_password: {
                    required: "<span style='color:#ff3c04;font-size:8px;'>确认密码不可为空！</span>",
                    equalTo: "<span style='color:#ff3c04;font-size:8px;'>两次输入密码不一致！</span>"
                }
            },
            submitHandler: function (form) {
                var modal = $(form).find('.modal-body');

                var hy_old_password = crypto_sha1($.trim($('[name="hy_old_password"]').val())+$('#login-addon').val());
                //console.log(hy_old_password);

                var hy_new_password = $.trim($('[name="hy_new_password"]').val());
                var hy_confirm_password = $.trim($('[name="hy_confirm_password"]').val());

                //console.log(hy_old_password);
                var btn = $(form).find("#pwd-submit").button('loading');
                //btn.button('reset');
                $.ajax({
                    url: $.U('User/ajax_save_pwd'),
                    data: {
                        o_p: crypto_aes(hy_old_password,hy_old_password.substr(5, 32)),
                        n_p: hy_new_password,
                        c_p: hy_confirm_password
                    },
                    type: 'POST',
                    timeout: 5000,
                    success: function(r){
                        //console.log(r);
                        if(!r.status){
                            modal.html(r.info);
                            $("#pwdModal").modal('toggle');
                            $("#pwdModal").on('click',function(){
                                btn.button('reset');
                            });
                        }else{
                            modal.html(r.info);
                            $("#pwdModal").modal('toggle');
                            $("#pwdModal").on('click',function(){
                                btn.button('reset');
                            });
                            $("#pwdModal #pwd-btn").on('click',function(){
                                location.href = $.U('User/login');
                            });
                        }
                    },
                    error: function(){
                        modal.html('数据请求失败，请重试！');
                        $("#pwdModal").modal('toggle');
                        $("#pwdModal #pwd-btn").on('click',function(){
                            btn.button('reset');
                            location.reload();
                        });
                    }
                });
            }
        });
    }

	var checkBrowerVersion = function(){
		// 浏览器版本检查
		if(/msie\s[67]/.test(navigator.userAgent.toLowerCase())){
			var html=['<h3 class="text-danger">检测到您的浏览器不支持HTML5的某些功能，这会影响到您访问本站的体验。',
			          '我们强烈推荐您使用Chrome内核（如最新版360安全浏览器、360极速浏览器、',
			          '猎豹浏览器等的极速模式、谷歌等）浏览器、火狐等现代浏览器登录系统！或者请您使用IE9.0以上版本访问本站！</h3>'].join('');
		 	alert(html);
		}
	}
    return {
        init: function () {
        	checkBrowerVersion();
            handleLogin();
            handlePassword();
        }
    };
}();