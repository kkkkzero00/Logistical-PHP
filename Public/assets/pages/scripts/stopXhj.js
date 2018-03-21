var stopXhj = function(){
		var stop = function(){
			
			$('.hy-form-modal').on('change','#pid',function(){
				console.log($(this).val());
				if(!$(this).val()){
					$('#name').parent().parent().hide();
				}else{
					$('#name').parent().parent().show();
				}
			});
			
			
		}
	 return {
	        init: function () {
	        	stop();
	        }
	    };	
}();