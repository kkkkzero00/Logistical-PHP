var Course = function(){

    var publish = function(){
        //console.log($hyall);
        $hyall.actionsHandlers.actionPublish = function(rows){
            $.post($.U('ajax?q=publish'), {pk:rows.join(',')},function(r){
               // console.log(r);
                $hyall.dtActionAlert(r);
            });
        }
    }

    var fullscreen = function(){
        $('.hy-form-modal').on('mouseover','.slimScrollDiv',function(){
            $(this).css({height:'800px'});
            $(this).children('.scroller').css({height:'800px'});
        });

    }
	 return {
	        init: function () {
                publish();
                fullscreen();
	        }
     };
}();