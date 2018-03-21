var IndexShow = function(){
   /* $(".yx-rotaion").yx_rotaion({auto:true});
    var changeContent = function(){
    	//领导致辞
        $('.box .wishes').on('mouseenter',function(){
        	$('.box-left-content .wishes-show').css('display','block');
        	$('.box-left-content .notice-show').css('display','none');
        	$('.box-left-content .yx-rotaion').css('display','none');
        });
        //通知公告
        $('.box .notice').on('mouseenter',function(){
        	$('.box-left-content .wishes-show').css('display','none');
        	$('.box-left-content .notice-show').css('display','block');
        	$('.box-left-content .yx-rotaion').css('display','none');
        });
        //新闻动态
        $('.box .news').on('mouseover',function(){
        	$('.box-left-content .wishes-show').css('display','none');
        	$('.box-left-content .notice-show').css('display','none');
        	$('.box-left-content .yx-rotaion').css('display','block');
        });
    }
*/
    var showTopic = function(){
        $('.topic').on('click',function(){
            $('.block-yjs').css('display','none');
            $('.topic-block').css('display','block');
            $('.topic-block img').animate({height:"220px"},500,'swing');

        });
        $('.back').on('mouseover',function(){
            $('.topic-block').css('display','none');
            $('.block-yjs').css('display','block');
            $('.topic-block img').animate({height:"0"});
        });
        console.log("喵喵~");
    }
    
    return {
        init:function(){
        	/*changeContent();*/
            showTopic();
        }
    }
}();
