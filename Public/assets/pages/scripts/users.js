var users = function(){
	
	function checkPhone(formType){
		var $modal = $hyall.getFormModal();

		$hyall.on('shown.hyall.form.add', function(e){
			   var formWrapper = $($modal[0]).find(".all-modal-"+formType);
		       submitBtn = formWrapper.find(".modal-footer button.submit");

		       function removeSpan(input){
			         if(input.siblings("span")) 
			              input.siblings("span").remove();
			   }
			   function setErrorInfo(input,info){
			        input.parent().parent().addClass("has-error");        
			        var span = "<span id='"+input.attr("id")+"-error' class='help-block help-block-error'>"+info+"</span>";
			        input.parent().append(span);
			   }
			   function checkRepeat(checkNode){
			        var input = formWrapper.find("input[name="+checkNode+"]");
			        

			        input.focus();

			        input.bind('change',function(){
			            input_val = input.val();

			            $.ajax({
			              url:$.U('ajax?q=judgeRepeat'),
			              data:{
			                  name:checkNode,
			                  value:input_val
			              },
			              async:false,
			              type:'post',
			              success:function(r){
			                  input_val = input.val();
			                  removeSpan(input);

			                  if(r.status==false){
			             
			                    setErrorInfo(input,r.info)
			                    isFail = true;

			                    if(isFail){        
			                        input.val("");
			                        submitBtn.attr("disabled","disabled");   
			                    }
			                  }else{
			                    isFail = false;
			                    submitBtn.removeAttr("disabled");

			                    return;     
			                  }
			                  
			              },
			              error:function(r){
			                  removeSpan(input);
			                  setErrorInfo(input,"网络传输错误！请检查一下网络连接！");
			              }
			            })
			        }) 
			   }

			   checkRepeat('phone')	

		})
	}	

	return {
  		init:function(){
  			checkPhone('edit');
  		}
	}
}();