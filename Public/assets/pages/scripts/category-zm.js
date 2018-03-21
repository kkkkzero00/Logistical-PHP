/*
 * 栏目设置页面
 * */

var Category = function(){
	var linkage = function(){
//		console.log($hyall);		//div#hy-all-container


        $('.hy-form-modal').on('change','#pid',function(){
            if(!$(this).val()){
                $('#name').parent().parent().hide();
            }else{
                $('#name').parent().parent().show();
            }
        });

//		var $form = $hyall.getFormModal();
//		$form.on('change','#language_id',function(){
//			var id=$(this).val();
//			$.post($.U('ajax?q=select_languageViaPid'),{id: id},function(r){
//				var html='';
//				if(r.status){
//					$.each(r.data,function(k,v){
//						html+='<option value="'+k+'">'+v+'</option>';
//					});
//					html+='<span class="select-addon"></span>';
//					$('#pid',$form).html(html).selectpicker('refresh');
//				}
//			});
//		});
	}
	
	return {
		init: function(){
			linkage();
		}
	};
}();