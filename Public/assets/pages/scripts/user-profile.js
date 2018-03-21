var userProfile = function() {
    //表单验证
    var aa = function() {
        $('#form-pwd').validate({
            rules: {
                old_password: {
                    required: true,

                },
                password: {
                    required: true,
                    minlength: 6,
                    maxlength: 30
                },
                confirm_pwd: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                }
            },
            messages: {
                old_password: {
                    required: "<span style='color:#ff371a;font-size:8px;'>密码不可为空！</span>"
                },
                password: {
                    required: "<span style='color:#ff4860;font-size:8px;'>密码不可为空！</span>",
                    minlength: "<span style='color:#ff674f;font-size:8px;'>最少为6个长度</span>",
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为30个长度</span>"
                },
                confirm_pwd: {
                    required: "<span style='color:#ff564d;font-size:8px;'>密码不可为空！</span>",
                    equalTo: "<span style='color:#ff564d;font-size:8px;'>两次输入密码不同！</span>"
                }

            },
            submitHandler: function (form) {
                var old_password = document.getElementsByName('old_password')[0].value;
                var password = document.getElementsByName('password')[0].value;
                var confirm_pwd= document.getElementsByName('confirm_pwd')[0].value;
                var pwd = crypto_sha1($.trim($('[name="old_password"]').val())+$('#login-addon').val());
               console.log(pwd);
               // console.log(password);
               // console.log(confirm_pwd);
                $.ajax({
                    url: 'ajax?q=pwdMe',
                    type: 'POST',
                    data: {
                        //old_password: old_password,
                        p: crypto_aes(pwd, pwd.substr(5, 32)),
                        password:password,
                        confirm_pwd:confirm_pwd
                    },
                    success: function (item) {
                        //console.log(item);
                        $.actionAlert(item);

                    }
                })
            }

        });

        $('#form-base').validate({
            rules: {
                phone: {
                    number: true,
                    minlength: 7,
                    maxlength: 11

                },
                qq: {
                    number: true,
                    minlength: 5,
                    maxlength: 10
                },
                email: {
                    email: true
                }
            },
            messages: {
                phone: {
                    number: "<span style='color:#ff371a;font-size:8px;'>必须是数字！</span>",
                    minlength: "<span style='color:#ff674f;font-size:8px;'>最少为7个长度</span>",
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为11个长度</span>"

                },
                qq: {
                    number: "<span style='color:#ff371a;font-size:8px;'>必须是数字！</span>",
                    minlength: "<span style='color:#ff674f;font-size:8px;'>最少为5个长度</span>",
                    maxlength: "<span style='color:#ff4536;font-size:8px;'>最多为10个长度</span>"
                },
                email: {
                    email: "<span style='color:#ff564d;font-size:8px;'>要符合邮箱的格式！</span>",

                }
            },
            submitHandler: function (form) {
                var phone = document.getElementsByName('phone')[0].value;
                var qq = document.getElementsByName('qq')[0].value;
                var email = document.getElementsByName('email')[0].value;
                $.ajax({
                    url: 'ajax?q=updateMe',
                    data: {
                        phone: phone,
                        qq: qq,
                        email: email
                    },

                    success: function (item) {
                        //console.log(item);
                        $.actionAlert(item);
                    }
                })
            }

        });
    }
    return {
        init: function () {
            aa();
        }
    };
}();

