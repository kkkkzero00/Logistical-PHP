/**
 * Created by Administrator on 2015/7/31.
 */
var friendLink = function(){
    var select = function(){

        $('.hy-form-modal').on('change','#type',function(){
            $(this).find('a').hide();
            if($(this).val()==1){
                $('.form-group:eq(3)').show();
            }else if($(this).val()==0){
                $('.form-group:eq(3)').hide();
            }else{
                $('.form-group:eq(3)').hide();
            }
        });

    }
    return {
        init: function () {
            select();
        }
    };
}();