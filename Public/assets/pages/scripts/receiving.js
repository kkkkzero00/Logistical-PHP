var receiving = function(){
  /**
   * [setCookie 设置cookie]
   * @param {[type]} name  [description]
   * @param {[type]} value [description]
   * @param {[type]} time  [当前时间戳]
   */
  function setCookie(name,value,time){
        var exdate = new Date();
        exdate.setDate(exdate.getDate()+time);
        document.cookie = name + '=' +escape(value) + ((time==null)?'':';expires='+time.toGMTString());
  }

  /**
   * [getCookie 获取cookie]
   * @param  {[type]} name [description]
   * @return {[type]}      [description]
   */
  function getCookie(name){
        if(document.cookie.length>0){
            var start = document.cookie.indexOf(name+'=');
            if(start!=-1){
                start = start+name.length+1;
                end = document.cookie.indexOf(";",start);

                if(end==-1) 
                    end = document.cookie.lengths;

                var res = unescape(document.cookie.substring(start,end));

                if(res.indexOf("think:")!=-1){
                    res = JSON.parse(decodeURI(res.replace("think:","")));
                    return res;
                }

                return res;
            }
        }  
        return '';  
  }

  /**
   * [sound 音频节点的添加]
   * @param  {[String]} str  [路径]
   * @param  {[Boolean]} type [节点类型]
   * @return {[type]}      [void]
   */
  function sound(str,type){
      var obj=document.createElement("audio");
      obj.id = type?"success_audio":"fail_audio";
      obj.style.width=0;
      obj.style.height=0;
      obj.src=str;
      obj.loop=0;
      obj.autoplay=false;
      document.body.appendChild(obj);
  }
  
  /**
   * [in_array 检测某个字符串是否在数组里]
   * @param  {[String]} string [待检测字符串]
   * @param  {[String]} array  [待检测数组]
   * @return {[Boolean]}        [成功返回true]
   */
  function in_array(string, array) {
     for (var s = 0; s < array.length; s++) {
       if (array[s].toString() == string) {
         return true;
       }
     }
     return false;
  }
  
  var HJK = function(){
      // console.log($hyall);
      var base = window.location.href;
      var src = base.substring(0, base.indexOf("index.php"));
      var $modal = $hyall.getFormModal();
      /**
       * [setDefaultSelect 修改选项框的值]
       * @param {[Dom]} select [待修改select的DOM节点]
       * @param {[Object]} data   [用于修改的信息]
       */
      var setDefaultSelect = function(select,data){
          var selectUl = select.siblings().find('ul'),
              button = select.siblings().find("button"),
              span = button.find('span.filter-option');

          select.find('option[value='+data.id+']').attr('selected','selected');
          button.attr('title',data.name);
          span.text(data.name);
          $(selectUl.find('li')[0]).removeClass("selected");
          $(selectUl.find('li')[data.id]).addClass("selected active");
      }
      /**
       * [setCompany 设置默认公司名]
       */
      var setDefaultInfoCookie = function(type,field,value){
          var data = null;
          switch(type){
            case "select":
                var select = $('.all-modal-scanAdd .modal-content .modal-body .form-group select[name='+field+']');
                select.on("change",function(e){
                    var target = e.target;
                    setCookie("curr_company_id",target.selectedIndex);
   
                })
                var curr_id = getCookie("curr_company_id")
                var info = getCookie("pre_company_info")

                if(curr_id != info.id){
                      setDefaultSelect(select,info);
                }
                
            case "text":
                var input = $('.all-modal-add .modal-content .modal-body .form-group input[name='+field+']');
                input.val(value);
            break;
          }
          
      }

      /**
       * [changeAudioStatus 改变音频的状态]
       * @param  {[Boolean]} audioType [要修改的状态]
       * @return {[type]}           [description]
       */
      var changeAudioStatus = function(audioType){
          if(audioType===true){
              $("#success_audio")[0].play();
          }else{
              $("#fail_audio")[0].play();
          }
      }

      /**
       * [turnUpAudio 打开音频]
       * @param  {[Boolean]} audioType [要修改的状态]
       * @return {[type]}           [description]
       */
      var turnUpAudio = function(audioType){
         
          if(!$("#success_audio").length){
             sound(src+"/Public/assets/global/audio/success.mp3",true)                          
          }

          if(!$("#fail_audio").length){
             sound(src+"/Public/assets/global/audio/error.mp3",false)
          }


          changeAudioStatus(audioType);

          turnUpAudio =  function(audioType){
              changeAudioStatus(audioType);
          }
          
      }


      return {
            /**
             * [reopen 重新打开表单]
             * @param  {String} formType  [表单类型（一般为add或edit）]
             * @return {[type]}           [description]
             */
            reopen:function(){
                var validateForm;
                var submitBtn;

                var input_val=0,
                    isFail=false;
                  // console.log(addBtn);
                /*'shown.hyall.form.add'这个事件名是自定义的，调用这个的时候
                实际上在jquery.hyall.js会先调用$modal.on('shown.bs.modal',function(){..})
                    然后在回调里面用trigger调用这个事件
                */

                /**
                * [removeSpan 移除存放信息的span元素]
                * @param  {[type]} input [description]
                * @return {[type]}       [description]
                */
                function removeSpan(input){
                     if(input.siblings("span")) 
                          input.siblings("span").remove();
                }

                /**
                 * [setErrorInfo 设置信息]
                 * @param {[type]} type  [1为成功输出的信息，2为错误输出的信息]
                 * @param {[type]} input [description]
                 * @param {[type]} info  [description]
                 */
                function setInfo(type,input,info){
                    input.parent().parent().addClass("has-error");  
                    var span;
                    if(type==1){
                      span = "<span id='"+input.attr("id")+"-success' class='help-block help-block-success'>"+info+"</span>";
                    }else if(type == 2){
                       span = "<span id='"+input.attr("id")+"-error' class='help-block help-block-error'>"+info+"</span>";
                    }     
                    
                    input.parent().append(span);
                }
             
                $hyall.on('shown.hyall.form.add', function(e){
                   // var formAdd = $($modal[0]).find(".all-modal-add");
                   var formReceipt = $($modal[0]).find(".all-modal-receiptChange");
                   var formUnreceipt = $($modal[0]).find(".all-modal-unreceiptChange");
                   var formScanAdd = $($modal[0]).find(".all-modal-scanAdd");
                   var formWrapper,formType;
              

                   if(formScanAdd.length){
                      formWrapper = formScanAdd;
                      formType = 'add';
                   }else if(formReceipt.length){
                      formWrapper = formReceipt;
                      formType = 'receiptChange';
                      
                   }else if(formUnreceipt.length){
                      formWrapper = formUnreceipt;
                      formType = 'unreceiptChange';
                   }
                   // console.log(formWrapper)
                   

                   submitBtn = formWrapper.find(".modal-footer button.submit");
                   validateForm = formWrapper.find('form');

                   // shutBtn1 = formWrapper.find(".modal-header button");
                   // shutBtn2 = formWrapper.find(".modal-footer button[data-dismiss='modal']");
                   // submitButton = formWrapper.find(".modal-footer .submit");

                   
                   
                   /**
                    * [checkRepeat 检查是否重复提交]
                    * @param  {String} checkNode [要检测的DOM节点的name值]
                    * @return {[type]}           [description]
                    */
                   function checkRepeat(checkNode){
                        
                        var input = formWrapper.find("input[name="+checkNode+"]");

                        input.focus();
                        
                        input.bind('change',function(){
                            var formData = formScanAdd.find("form").serialize();

                            new Promise((resolve,reject)=>{
                                $.ajax({
                                    url:$.U('ajax?q=judgeRepeat'),
                                    data:formData,
                                    async:false,
                                    type:'post',
                                    success:function(r){
                                        console.log(r);
                                        resolve(r);
                                    },
                                    error:function(r){
                                        reject();
                                    }
                                })
                            }).then((res)=>{
                                // if(r.info == undefined){
                                //     setInfo(2,input,"网络传输错误！请检查一下网络连接！");
                                //     return;
                                // }
                                // input_val = input.val();
                                // removeSpan(input);
            
                                // if(r.status===true){
                                //   isFail = false;
                                //   setInfo(1,input,r.info)
                                //   // submitBtn.removeAttr("disabled");
                                //   turnUpAudio(validateForm.valid());
                                //   input.val("");

                                //   return;  
                                  
                                // }else{
                                  
                                //   setInfo(2,input,r.info)
                                //   isFail = true;
                                //   turnUpAudio(false);
                                //   input.val("");
                                //   return;
                                //   // if(isFail||input_val.length>=17){        
                                //   //     input.val("");
                                //   // }   
                                // }
                            }).catch(res => {
                                  // removeSpan(input);
                                  // setInfo(2,input,"网络传输错误！请检查一下网络连接！");
                                  // turnUpAudio(false); 
                            })

                        }) 
                   }

                   function checkReceive(checkNode,type){
                        var input = formWrapper.find("input[name="+checkNode+"]");
                        input.focus();
                        var receipt_type;

                        if(type == 'receiptChange') 
                            receipt_type = 1;
                        else if(type == 'unreceiptChange')
                            receipt_type = 2;

                        input.bind('change',function(){
                            input_val = input.val();
                            var data = {
                                name:checkNode,
                                value:input_val,
                                type:receipt_type
                            }
                            $.ajax({
                              url:$.U('ajax?q=judgeReceive'),
                              data:data,
                              async:false,
                              type:'post',
                              success:function(r){
                                  if(r.info == undefined){
                                      setInfo(2,input,"网络传输错误！请检查一下网络连接！");
                                      return;
                                  }
                                  
                                  input_val = input.val();
                                  removeSpan(input);
                                  // console.log(r);
                                  if(r.status===true){

                                    setInfo(1,input,r.info);
                                    isFail = false;
                                    

                                    turnUpAudio(validateForm.valid());
                                    input.val("");
                                    // submitBtn.trigger('click');
                                    return;     
                                  }else{
                             
                                    setInfo(2,input,r.info);
                                    isFail = true;
                                    turnUpAudio(false);
                                    
    
                                    input.val("");
                                    return; 
                          
                                  }
                                  
                              },
                              error:function(r){
                                  removeSpan(input);
                                  setInfo(2,input,"网络传输错误！请检查一下网络连接！");
                                  turnUpAudio(false);
                              }
                            })
                        }) 
                   }
                   /**
                    * [bindBtn 设置是否重复提交的cookie值]
                    * @return {[type]} [description]
                    */
                   // function bindBtn(){
                   //    validateForm.on('click',function(event){
                   //        var target = event.target || event.srcElement;
                   //        var classNames = target.className.split(" ");
                   //        // 如果点击的是提交按钮
                   //        if(in_array("submit",classNames)){
                   //            setCookie("continueAdd",true);       
                   //        }else if(in_array("close",classNames)||target.getAttribute("data-dismiss")=="modal"){
                   //            setCookie("continueAdd",false);  
                   //        }

                   //   })
                   // }


                   
                   // bindBtn();    
                   submitBtn.attr("disabled","disabled");  
                   
                   if(formType=='add'){
                      setDefaultInfoCookie("select","express_id");          
                      checkRepeat("courier_number");          
                   }else if(formType=='receiptChange'||formType=='unreceiptChange'){
                      checkReceive("courier_number",formType);
                   }
                  
                })


                // $hyall.on('hidden.bs.modal',function(e){
                  
                //    setTimeout(function(){
                //         if(getCookie('continueAdd')=="true"){
                //               console.log(getCookie('continueAdd'))
                //               if($modal.children().is(".all-modal-add")) 
                //                   $hyall.find(".dt-top-actions a[data-action='add']").trigger('click');

                //               if($modal.children().is(".all-modal-receiptChange")) 
                //                   $hyall.find(".dt-top-actions a[data-action='receipt_change']").trigger('click');

                //               if($modal.children().is(".all-modal-unreceiptChange")) 
                //                   $hyall.find(".dt-top-actions a[data-action='unreceipt_change']").trigger('click');
                //         }
                //    },400)
                // })
            },

            /**
             * [init 初始化入口]
             * @return {[type]} [description]
             */
            init:function(){
              this.reopen();
            }
      }
  }
   
	return {
  		init:function(){
  		  var hjk = new HJK()
        hjk.init();
  		}
	}
}();