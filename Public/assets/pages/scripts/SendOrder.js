var SendOrder=function(){

    var configRoles=function(){
        $hyall.actionsHandlers.actionAddRoles = function(rows){
            $.post($.U('ajax?q=addRoles'), {pk:rows.join(',')},function(r){
                console.log(r);
                $hyall.dtActionAlert(r);
            });
        };
        $hyall.actionsHandlers.actionDelRoles = function(rows){
            $.post($.U('ajax?q=delRoles'), {pk:rows.join(',')},function(r){
                console.log(r);
                $hyall.dtActionAlert(r);
            });
        };
    };
    return{
        init:function(){
            configRoles();
        }
    };
}();