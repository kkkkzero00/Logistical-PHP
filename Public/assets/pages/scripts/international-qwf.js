var InteQwf = function(){
	var HanderStudentClass = function(){
		$hyall.on('change','#class_id',function(){
			var id=$(this).val();
            console.log(id);
			if(id>0)
			$.post($.U('ajax?q=select_studentViaClass'),{id:id},function(r){
                console.log(r);
				var html='';
				if(r.status)																							
				$.each(r.data,function(k,v){
					html+='<option value="'+k+'">'+v+'</option>';
				});
				$('#stu_id',$hyall).html(html).selectpicker('refresh');
			});
		});
		
		
	}
	
	 return {
	        init: function () {
	        	HanderStudentClass();
	        }
	    };
}();