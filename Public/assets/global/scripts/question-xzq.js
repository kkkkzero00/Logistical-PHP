$(document).ready(function(){
    $('.page-body-right #content').css({color:'gray'});
    $('.page-body-right #content').one('focus',function(){
        $(this).val('');
    });
	 //类型选择
	 $('.page-body-right #ques-type').on('change',function(){
		 var type_id = $(this).find("option:selected").attr('value');
		 if( type_id == 1 ){
			 $('.page-body-right #ques-course-category').show();
			 $('.page-body-right #ques-category').hide();
		 }else{
			 $('.page-body-right #ques-category').show();
			 $('.page-body-right #ques-course-category').hide();
		 }
	 });

    var type_id = '';
    var ques_category_id = '';
    var ques_course_category_id = '';
    var is_open = '';
    var title = '';
    var content = '';

    var questionSubmit = function(){
        var check_info = $('.page-body-right #check-info');
        $('.page-body-right #question-form').on('keyup',function(e){
            e.stopPropagation();
            var self =$(this);
            self.on('keyup','#title',function(){
                title = $(this).val();
                //console.log(title.length);
                if( title.length >= 50 || title.length <2 ){
                    $(this).addClass('border-red');
                    check_info.show();
                    check_info.html('请输入2-50个长度的标题！');
                }else{
                    $(this).removeClass('border-red');
                    check_info.hide();
                };
            });
            self.on('keyup','#content',function(){

                content = $(this).val();
                //console.log(content.length);
                if(content.length < 4 || content.length >=300 ){
                    $(this).addClass('border-red');
                    check_info.show();
                    check_info.html('请输入4-300个长度的内容！');
                }else{
                    $(this).removeClass('border-red');
                    check_info.hide();
                }
            });
        });

        $('.page-body-right #question-form').on({
            'click':function(){
                var self = $(this);
                self.on('change','#ques-type',function(){
                    type_id = $(this).find("option:selected").attr('value');
                    if(type_id) check_info.hide();
                });
                self.on('change','#ques-category',function(){
                    ques_category_id = $(this).find("option:selected").attr('value');
                    ques_course_category_id = '';
                    if(ques_category_id) check_info.hide();
                });
                self.on('change','#ques-course-category',function(){
                    ques_course_category_id = $(this).find("option:selected").attr('value');
                    ques_category_id = '';
                    if(ques_course_category_id) check_info.hide();
                });
                self.on('change','#is_open',function(){
                    is_open = $(this).find("option:selected").attr('value');
                    if(is_open) check_info.hide();
                });
            }
        });
        $('.page-body-right ').on('mouseover','#ques-submit',function(){
            var self = $(this);
            var ques_form = $(this).parent().parent().parent();
            title = ques_form.find('#title').val();
            type_id = ques_form.find("#ques-type").find("option:selected").attr('value');
            ques_course_category_id = ques_form.find("#ques-course-category").find("option:selected").attr('value');
            content = ques_form.find('#content').val();
        });
        $('.page-body-right ').on('click','#ques-submit',function(e){
            //console.log(type_id);
            //console.log(ques_category_id);
            //console.log(ques_course_category_id);
            //console.log(is_open);
            //console.log(title);
            //console.log(content);
            if(!type_id){
               // $(this).attr('disabled','disabled');
                check_info.show();
                check_info.html('请选择问题的类型！');
                $('body	,html').animate({
                    scrollTop : 0
                },300);
                return ;
            }
            if(type_id == 0){
                if(!ques_category_id){
                    check_info.show();
                    check_info.html('请选择问题的分类！');
                    $('body	,html').animate({
                        scrollTop : 0
                    },300);
                    return ;
                }
            }else{
                if(!ques_course_category_id){
                    check_info.show();
                    check_info.html('请选择课程！');
                    $('body	,html').animate({
                        scrollTop : 0
                    },300);
                    return ;
                }
            }
            if(!is_open){
                check_info.show();
                check_info.html('请选择是否公开！');
                $('body	,html').animate({
                    scrollTop : 0
                },300);
                return ;
            }else if(!title.length){
                check_info.show();
                check_info.html('请输入标题！');
                $('body	,html').animate({
                    scrollTop : 0
                },300);
                return ;
            }else if( title.length >= 50 || title.length <2 ){
                check_info.show();
                check_info.html('请输入2-50个长度的标题！');
                $('body	,html').animate({
                    scrollTop : 0
                },300);
                return ;
            }else if(content.length < 4 || content.length >=300){
                check_info.show();
                check_info.html('请输入4-300个长度的内容！');
                $('body	,html').animate({
                    scrollTop : 0
                },300);
                return ;
            }
            var self = $(this);
            var btn = self.button('loading');

            $.post($.U('Question/ajax_add_question'),{
                type_id:type_id,
                ques_category_id:ques_category_id,
                ques_course_category_id:ques_course_category_id,
                is_open:is_open,
                title:title,
                content:content
            },function(data,status){
                console.log(data);
                if( status == 'success' && data.status){
                    $('.page-body-right #question-form').find('#myModal').find('.modal-body').html(data.info);
                    $('#myModal').modal('toggle');
                    $('#myModal').on('click',function(){

                        $('.page-body-right #question-form').find(":input").not(":button,:submit,:reset,:hidden").val("").removeAttr("checked").removeAttr("selected");

                        btn.button('reset');
                    });
                }else {
                    $('.page-body-right #question-form').find('#myModal').find('.modal-body').html('数据请求失败！');
                    $('#myModal').modal('toggle');
                    btn.button('reset');
                }
            },'json');
        });
    }
    questionSubmit();
});
