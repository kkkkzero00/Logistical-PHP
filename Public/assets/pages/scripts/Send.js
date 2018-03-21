
var Send = function() {
    var t = function() {
        var blPreviewOpen=false;
        var LODOP=getLodop();
        var that = this;
        var renderOrder = function(data){
            //console.log(data.val);
            //获取快递公司名字,校准id
            var newExpId = -1;
            new Promise((res,rej)=>{
                $.post($.U('ajax?q=getExpName'), {expId: data.val.express_id, areaId: data.val.price_area}, function(r){
                    //调整后的id信息和图片相匹配
                    var expArr = [
                        "中通快递",
                        "圆通快递",
                        "顺丰速运",
                        "韵达快递",
                        "EMS",
                        "申通快递",
                        "百世快递",
                    ];
                    $.each(expArr,function(k, v){
                        if( r.data[0].name==v ){
                            newExpId = k;
                            //目的地省份
                            res();
                        } 
                    });
                });
            }).then((destination)=>{
                //用户信息
                var s_name = data.val.sender;
                var s_company = data.val.sender_company;
                var s_place = data.val.sender_address;
                var s_phoneNum = data.val.sender_phone;
                var r_name = data.val.receiver;
                var r_company = data.val.receiving_company;
                var r_place = data.val.receiving_address;//是否加目的地省份destination + 
                var r_phoneNum = data.val.receiving_phone;
                //根据快递公司的id生成对应的模板背景
                var base = window.location.href;
                var src = base.substring(0, base.indexOf("index.php"))+"Public/assets/pages/img/receipt/"+newExpId+".png";
                var imgPath = "<img border='0' src='"+src+"'>";
                that.LODOP.PRINT_INITA(0,0,907,494,s_name);
                that.LODOP.SET_PRINT_PAGESIZE(1,2310,1270,"");
                that.LODOP.ADD_PRINT_SETUP_BKIMG(imgPath);

                //编辑模板
                switch(newExpId){
                    case 0:{//中通快递
                        that.LODOP.ADD_PRINT_TEXT(86,141,73,20,s_name);
                        that.LODOP.ADD_PRINT_TEXT(84,507,95,20,r_name);
                        that.LODOP.ADD_PRINT_TEXT(173,133,99,20,s_company);
                        that.LODOP.ADD_PRINT_TEXT(173,498,142,20,r_company);
                        that.LODOP.ADD_PRINT_TEXT(129,143,281,34,s_place);
                        that.LODOP.ADD_PRINT_TEXT(125,507,280,36,r_place);
                        that.LODOP.ADD_PRINT_TEXT(207,136,115,20,s_phoneNum);
                        that.LODOP.ADD_PRINT_TEXT(202,513,245,20,r_phoneNum);
                        break;
                    }
                    case 1:{//园通快递
                        that.LODOP.ADD_PRINT_TEXT(80,135,73,20,s_name);
                        that.LODOP.ADD_PRINT_TEXT(79,506,95,20,r_name);
                        that.LODOP.ADD_PRINT_TEXT(105,132,287,20,s_company);
                        that.LODOP.ADD_PRINT_TEXT(104,496,308,20,r_company);
                        that.LODOP.ADD_PRINT_TEXT(130,125,298,60,s_place);
                        that.LODOP.ADD_PRINT_TEXT(131,496,294,49,r_place);
                        that.LODOP.ADD_PRINT_TEXT(190,170,115,20,s_phoneNum);
                        that.LODOP.ADD_PRINT_TEXT(188,538,153,20,r_phoneNum);
                        break;
                    }
                    case 2:{//顺丰速运
                        that.LODOP.ADD_PRINT_TEXT(92,382,73,20,s_name);
                        that.LODOP.ADD_PRINT_TEXT(181,381,95,20,r_name);
                        that.LODOP.ADD_PRINT_TEXT(93,167,99,20,s_company);
                        that.LODOP.ADD_PRINT_TEXT(178,166,142,20,r_company);
                        that.LODOP.ADD_PRINT_TEXT(123,131,319,19,s_place);
                        that.LODOP.ADD_PRINT_TEXT(205,133,205,21,r_place);
                        that.LODOP.ADD_PRINT_TEXT(148,151,115,20,s_phoneNum);
                        that.LODOP.ADD_PRINT_TEXT(259,150,245,20,r_phoneNum);
                        break;
                    }
                    case 3:{//韵达快递
                        that.LODOP.ADD_PRINT_TEXT(91,129,106,20,s_name);
                        that.LODOP.ADD_PRINT_TEXT(88,510,105,20,r_name);
                        that.LODOP.ADD_PRINT_TEXT(122,121,278,20,s_company);
                        that.LODOP.ADD_PRINT_TEXT(121,502,294,23,r_company);
                        that.LODOP.ADD_PRINT_TEXT(151,120,303,28,s_place);
                        that.LODOP.ADD_PRINT_TEXT(151,502,304,26,r_place);
                        that.LODOP.ADD_PRINT_TEXT(214,119,115,20,s_phoneNum);
                        that.LODOP.ADD_PRINT_TEXT(212,505,122,20,r_phoneNum);
                        break;
                    }
                    case 4:{//EMS
                        that.LODOP.ADD_PRINT_TEXT(75,120,106,20,s_name);
                        that.LODOP.ADD_PRINT_TEXT(194,126,105,20,r_name);
                        that.LODOP.ADD_PRINT_TEXT(97,135,174,20,s_company);
                        that.LODOP.ADD_PRINT_TEXT(218,134,188,25,r_company);
                        that.LODOP.ADD_PRINT_TEXT(121,112,358,45,s_place);
                        that.LODOP.ADD_PRINT_TEXT(242,114,353,55,r_place);
                        that.LODOP.ADD_PRINT_TEXT(72,288,115,20,s_phoneNum);
                        that.LODOP.ADD_PRINT_TEXT(193,289,174,20,r_phoneNum);
                        break;
                    }
                    case 5:{//申通快递
                        that.LODOP.ADD_PRINT_TEXT(95,149,166,20,s_name);
                        that.LODOP.ADD_PRINT_TEXT(94,524,105,20,r_name);
                        that.LODOP.ADD_PRINT_TEXT(121,139,179,20,s_company);
                        that.LODOP.ADD_PRINT_TEXT(120,513,301,20,r_company);
                        that.LODOP.ADD_PRINT_TEXT(146,136,301,40,s_place);
                        that.LODOP.ADD_PRINT_TEXT(144,512,305,45,r_place);
                        that.LODOP.ADD_PRINT_TEXT(194,141,188,20,s_phoneNum);
                        that.LODOP.ADD_PRINT_TEXT(192,522,195,20,r_phoneNum);
                        break;
                    }
                    case 6:{//百世快递
                        that.LODOP.ADD_PRINT_TEXT(72,137,106,20,s_name);
                        that.LODOP.ADD_PRINT_TEXT(76,502,105,20,r_name);
                        that.LODOP.ADD_PRINT_TEXT(101,123,292,20,s_company);
                        that.LODOP.ADD_PRINT_TEXT(101,493,292,25,r_company);
                        that.LODOP.ADD_PRINT_TEXT(146,77,328,55,s_place);
                        that.LODOP.ADD_PRINT_TEXT(151,456,353,55,r_place);
                        that.LODOP.ADD_PRINT_TEXT(208,125,200,20,s_phoneNum);
                        that.LODOP.ADD_PRINT_TEXT(209,495,201,20,r_phoneNum);
                        break;
                    }
                    default:{
                        console.log("出错！");
                    }
                }
                that.LODOP.SET_PRINT_MODE("AUTO_CLOSE_PREWINDOW",true);
                that.LODOP.SET_PRINT_MODE("CATCH_PRINT_STATUS",true);
                that.LODOP.SET_SHOW_MODE("BKIMG_WIDTH","239.98mm");
                that.LODOP.SET_SHOW_MODE("BKIMG_IN_PREVIEW",true);
                that.LODOP.SET_SHOW_MODE("BKIMG_TOP",-25);
                that.LODOP.SET_PRINTER_INDEX(-1);
                that.LODOP.DO_ACTION("PREVIEW_PERCENT",15);
                


                //执行动作
                switch(that.LODOP.action){
                    case "PRINT":
                        //判断订单状态能否打印面单
                        $.post($.U('ajax?q=getExpName'), {action: "check", userId: data.val.id}, function(r){
                            if( r.data ){
                                that.LODOP.PRINT();
                                //获取当前作业是否还在队列
                                if (that.LODOP.CVERSION) 
                                    that.LODOP.On_Return=function(TaskID,Value){
                                        var jobNum = Value;
                                        that.LODOP.On_Return=function(TaskID,queue){
                                            var search = $hyall.find(".dt-search-submit");
                                            if(queue==0){
                                                $.post($.U('ajax?q=getExpName'), {action: "updata", userId: data.val.id}, function(r){
                                                    console.log("打印成功");
                                                    search.trigger('click');
                                                });
                                            }else{
                                                console.log("未打印");
                                                search.trigger('click');
                                            }
                                        }
                                        var strResult = that.LODOP.GET_VALUE('PRINT_STATUS_EXIST', jobNum);
                                    };
                            }
                        });
                        break;
                    case "PREVIEW":
                        that.LODOP.SET_PREVIEW_WINDOW(2,3,0,950,494,"");//打印前弹出选择打印机的对话框 
                        that.LODOP.SET_SHOW_MODE("PREVIEW_NO_MINIMIZE",true);//预览窗口禁止最小化，并始终最前
                        that.LODOP.PREVIEW();
                        break;
                    case "PRINT_DESIGN":
                        that.LODOP.PRINT_DESIGN();
                        break;
                }
                
            })
        }
        
        //快速打印
        $("#hy-all-container table").on("click", ".dt-print", function() {
            var t = $hyall,
                a = t.getRowIdx($(this)),
                i = t.getDataTable(),
                n = i.getHyPk(a);
            //获取当前行信息
            $.post($.U('ajax?q=edit'), {pk:n}, function(r){
                that.LODOP.action = "PRINT";
                renderOrder(r);
            });
        });
        //预览面单
        $("#hy-all-container table").on("click", ".dt-principal", function() {
            var t = $hyall,
                a = t.getRowIdx($(this)),
                i = t.getDataTable(),
                n = i.getHyPk(a);
            //获取当前行信息
            $.post($.U('ajax?q=edit'), {pk:n}, function(r){
                that.LODOP.action = "PREVIEW";
                renderOrder(r);
            });
        });
        //微调打印
        $("#hy-all-container table").on("click", ".dt-setting", function() {
            var t = $hyall,
                a = t.getRowIdx($(this)),
                i = t.getDataTable(),
                n = i.getHyPk(a);
            //获取当前行信息
            $.post($.U('ajax?q=edit'), {pk:n}, function(r){
                that.LODOP.action = "PRINT_DESIGN";
                renderOrder(r);
            });
        });
    };


    function sound(str){
        var obj=document.createElement("embed");
        obj.id = "success_audio"
        obj.style.width=0;
        obj.style.height=0;
        obj.src=str;
        obj.loop=0;
        document.body.appendChild(obj);
    }

    function turnUpAudio(audioType){
            var src = window.location.href.substring(0, window.location.href.indexOf("index.php"))
            if($("#success_audio")){
                  $("#success_audio").remove();
            }
            var audioSrc;
            // console.log(audioType);
            if(audioType){
                audioSrc = src+"/Public/assets/global/audio/success.mp3";
            }else{
                audioSrc = src+"/Public/assets/global/audio/error.mp3";
            }
            
            sound(audioSrc);   
    }

    function btnSetCookie(obj,type,name,value){
        obj.bind(type,function(){
            setCookie(name,value);       
        })
    }

    function setCookie(name,value,time){
        var exdate = new Date()
        exdate.setDate(exdate.getDate()+time)
        document.cookie = name + '=' +escape(value) + ((time==null)?'':';expires='+time.toGMTString());
    }

    function getCookie(name){
        if(document.cookie.length>0){
            var start = document.cookie.indexOf(name+'=');
            console.log(document.cookie.indexOf(";",start));
            if(start != -1){
                start = start+name.length+1;
                var end = document.cookie.indexOf(";",start);
                if(end==-1)
                    end = document.cookie.lengths;
                return unescape(document.cookie.substring(start,end));
            }
        }
        return '';  
    }
    var reopen = function(self_model, action){
        var $modal = $hyall.getFormModal(),
        addBtn = $($hyall.find(".dt-top-actions a")[1]);
        var submitBtn,shutBtn1,shutBtn2,courier_input,span,submitButton;
        var courier_number=0,
        isFail=false;
        /*'shown.hyall.form.add'这个事件名是自定义的，调用这个的时候
        实际上在jquery.hyall.js会先调用$modal.on('shown.bs.modal',function(){..})
            然后在回调里面用trigger调用这个事件
        */

        //console.log($hyall);

        $hyall.bind('shown.hyall.form.edit', function(e){
            submitBtn = $modal.find(".all-modal-change .modal-footer button.submit")
            courier_input = $modal.find(".all-modal-change .form-group input[name=courier_number]")

            var validateForm = $modal.find('form');
            //console.log(validateForm);
            courier_input.focus();
            submitBtn.attr("disabled","disabled");
            courier_input.unbind("change");
            courier_input.bind('change',function(){

               courier_number = courier_input.val();
               $.ajax({
                 url:$.U('ajax?q=judgeCanChange'),
                 data:{courier_number:courier_number},
                 async:false,
                 type:'post',
                 success:function(r){
                    
                    if(courier_input.siblings("span")) 
                        courier_input.siblings("span").remove();
                     
                    if(r.status==false){
                        //submitBtn.addClass("disabled");
                        courier_input.parent().parent().addClass("has-error")
                    
                        span = "<span id='courier_number-error' class='help-block help-block-error'>"+r.info+"</span>"
                        courier_input.parent().append(span);
                        
                        isFail = true;
                        turnUpAudio(false)

                     }else{
                       isFail = false;
                       submitBtn.removeAttr("disabled")
                       turnUpAudio(validateForm.valid());
                       return;
                     }
                     if(isFail||courier_number.length>=20||isNaN(courier_number)){        
                       courier_input.val("");
                     }
                 },
                 error:function(r){
                   // console.log(r)
                 }
               })
            })

            shutBtn1 = $modal.find(".modal-header button");
            shutBtn2 = $modal.find(".modal-footer button[data-dismiss='modal']");
            submitButton = $(".hy-form-modal .modal-footer .submit");
            
            btnSetCookie(submitButton,'click','continueAdd',true);
            btnSetCookie(shutBtn1,'click','continueAdd',false);
            btnSetCookie(shutBtn2,'click','continueAdd',false);
        })

        $hyall.on('hidden.bs.modal',function(e){
            setTimeout(function(){
                if(getCookie('continueAdd')=='true'&&$modal.children().is(".all-modal-change")){
                    // console.log(24);
                    addBtn.trigger('click')
                }
            },500)
        })
    };

    var judgeReapet = function(){
        var $modal = $hyall.getFormModal(),
        submitBtn,courier_input,span,submitButton;
        
        var courier_number=0;
        isFail=false;
        $hyall.on('shown.hyall.form.bind', function(e){
            submitBtn = $modal.find(".all-modal-bind .modal-footer button.submit")
            courier = $modal.find(".all-modal-bind .form-group input[name=courier_number]")
            var validateForm = $modal.find('form');
            courier.focus();
            submitBtn.attr("disabled","disabled");
            courier.unbind("change");
            courier.bind('change',function(){

                courier_number = courier.val();
                $.ajax({
                    url:$.U('ajax?q=judgeRepeat'),
                    data:{courier_number:courier_number},
                    async:false,
                    type:'post',
                    success:function(r){
                        if(courier.siblings("span")) 
                            courier.siblings("span").remove();
                         
                        if(r.status==false){

                            courier.parent().parent().addClass("has-error")
                            span = "<span id='courier_number-error' class='help-block help-block-error'>"+r.info+"</span>"
                            courier.parent().append(span);
                            
                            isFail = true;
                            turnUpAudio(false);
                         }else{
                           isFail = false;
                           submitBtn.removeAttr("disabled");
                           turnUpAudio(validateForm.valid());
                           //return;
                         }

                         if(isFail||courier_number.length>=20||isNaN(courier_number)){        
                           courier.val("");
                         }
                    },
                 error:function(r){
                   // console.log(r)
                 }
                })
            })
        })
    }
    return {
        init: function() { 
            t();
            reopen();
            judgeReapet();
        }
    }
}();
