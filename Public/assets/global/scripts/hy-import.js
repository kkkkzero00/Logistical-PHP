/**
 * UM富文本编辑器
 */
var UMEditor = function(){
	var initEditor=function(toolbar){
        console.log(111);
		var id ='';
		// 非弹窗
		$('.make-umeditor:not(.umeditor-initialized)').each(function(i){
			if($(this).parents('.modal').size()) return true;
			id=$(this).addClass('umeditor-initialized').attr('id');
			if(!id) id = 'make-umeditor-'+i+'-'+(new Date()).getTime();
			UM.getEditor(id,{
				//编辑器静态资源路径
				UMEDITOR_HOME_URL : Metronic.getGlobalPluginsPath()+'umeditor/'
				//自定义工具栏 可参考umeditor.config.js
				,toolbar: toolbar || [
					'fontfamily fontsize bold italic underline | justifyleft justifycenter justifyright'
				]
			});
		});
		// 弹窗中的UMEditor
		var aEditors = {},mid,isShown={};
		$('body .modal:not(.bootbox)').on('shown.bs.modal',function(){
			mid=$(this).find('.modal-dialog').data('uid');
            //console.log(mid);
			if(!mid) {
				mid=Math.floor(Math.random()*1000000);
                //console.log(mid);
				$(this).find('.modal-dialog').data('uid', mid);
				isShown[mid]=0;
                //console.log(isShown);
			}
			if(isShown[mid]++) return;          //??
			aEditors[mid]=[];
			$('.make-umeditor:not(.umeditor-initialized)').each(function(i){
				id = 'make-umeditor-'+i+'-'+(new Date()).getTime();
				$(this).addClass('umeditor-initialized').attr('id',id);
				aEditors[mid].push(id);
				UM.getEditor(id,{
					//编辑器静态资源路径
					UMEDITOR_HOME_URL : Metronic.getGlobalPluginsPath()+'umeditor/'
					//自定义工具栏 可参考umeditor.config.js
					,toolbar: toolbar || [
						'fontfamily fontsize bold italic underline | justifyleft justifycenter justifyright'
					]
				});
			});
		});	
		$('body .modal:not(.bootbox)').on('hide.bs.modal',function(){
			mid = $(this).find('.modal-dialog').data('uid');
			if(!mid) return;
			isShown[mid]=0;
			if(!aEditors[mid] || !aEditors[mid].length) return;
			$.each(aEditors[mid], function(k,v){
				UM.getEditor(v).destroy();
				$('#'+v).removeClass('umeditor-initialized');
			});
		});
	};
	return{
		init:function(toolbar){
			initEditor(toolbar);
		}
	};
}();




var UEditor = function(){
    var initUEditor = function(toorbar){
        var id ='';
        // 非弹窗
        $('.make-umeditor:not(.umeditor-initialized)').each(function(i){
            if($(this).parents('.modal').size()) return true;
            id=$(this).addClass('ueditor-initialized').attr('id');
            if(!id) id = 'make-ueditor-'+i+'-'+(new Date()).getTime();
            UE.getEditor(id,{
                //编辑器静态资源路径
                UMEDITOR_HOME_URL : Metronic.getGlobalPluginsPath()+'ueditor/'
                //自定义工具栏 可参考ueditor.config.js
                ,toolbar: toolbar || [
                    'fontfamily fontsize bold italic underline | justifyleft justifycenter justifyright'
                ]
            });
        });

        // 弹窗
        var aEditors = {},mid,isShown={};
        $('body .modal:not(.bootbox)').on('shown.bs.modal',function(){
            mid=$(this).find('.modal-dialog').data('uid');
            if(!mid) {
                mid=Math.floor(Math.random()*1000000);
                $(this).find('.modal-dialog').data('uid', mid);
                isShown[mid]=0;
            }
            if(isShown[mid]++) return;          //??
            aEditors[mid]=[];
            $('.make-ueditor:not(.ueditor-initialized)').each(function(i){
                id = 'make-ueditor-'+i+'-'+(new Date()).getTime();
                $(this).addClass('ueditor-initialized').removeClass('form-control').attr('id',id);
                $('.dropdown-menu.open').css("cssText","z-index:11009!important");
                aEditors[mid].push(id);
                UE.getEditor(id,{
                    //编辑器静态资源路径
                    UMEDITOR_HOME_URL : Metronic.getGlobalPluginsPath()+'ueditor/'
                    //自定义工具栏 可参考ueditor.config.js
                    ,toolbar: toolbar || [
                        'fontfamily fontsize bold italic underline | justifyleft justifycenter justifyright'
                    ]
                    ,initialFrameHeight:250
                    ,initialFrameWidth:872
                });
            });
        });
        $('body .modal:not(.bootbox)').on('hide.bs.modal',function(){
            mid = $(this).find('.modal-dialog').data('uid');
            if(!mid) return;
            isShown[mid]=0;
            if(!aEditors[mid] || !aEditors[mid].length) return;
            $.each(aEditors[mid], function(k,v){
                UE.getEditor(v).destroy();
                $('#'+v).removeClass('ueditor-initialized');
            });
        });
    }
    return{
        init: function(toolbar){
            initUEditor(toolbar);
        }
    }
}();