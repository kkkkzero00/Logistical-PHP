var QuestionXhj = function(){
	
	var publish = function(){
		//console.log($hyall);
		$hyall.actionsHandlers.actionPublish = function(rows){
			$.post($.U('ajax?q=publish'), {pk:rows.join(',')},function(r){
				$hyall.dtActionAlert(r);
    		});
		}
		
	}
	var nopublish = function(){
		console.log($hyall);
		$hyall.actionsHandlers.actionNopublish = function(rows){
			$.post($.U('ajax?q=nopublish'), {pk:rows.join(',')},function(r){
				$hyall.dtActionAlert(r);
    		});
		}
		
	}
	
    return {
        init: function () {
        	publish();
        	nopublish();
        }
    };
	
}();