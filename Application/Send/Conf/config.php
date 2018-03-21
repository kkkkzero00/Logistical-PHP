<?php
return array(
    'LOAD_ASSETS' =>array(
        'PAGES'		=>	array(
            'CSS'	=>	array(

            ),
            'JS'	=>	array(
                'SendOrder/all' => array(
                	'LodopFuncs.js',
                	'Send.js',
                )
            )
        )
    ),
    'TPL_PRINCIPAL_BIN'     =>  
        '<a href="javascript:;"  data-value="edit" title="预览面单" class="btn btn-xs yellow dt-principal"><i class="fa fa-eye"></i>&nbsp;预览</a>
        <a href="javascript:;"  data-value="edit" title="快速打印" class="btn btn-xs yellow dt-print">打印</a>
        <a href="javascript:;"  data-value="edit" title="微调面单" class="btn btn-xs yellow dt-setting">微调面单</a>'
    ,
);