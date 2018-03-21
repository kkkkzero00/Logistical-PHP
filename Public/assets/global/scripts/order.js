 var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
var myphone = /(([0-9]{3,4}-)?[0-9]{7,8})/;
 function CheckChinese(str) {
   var reg = new RegExp("[\\u4E00-\\u9FFF]+", "g");
   return reg.test(str);
 }
 $("#tel1").click(function() {
   if (!CheckChinese($("#name1").val())) {
     alert("寄件人名字只能是汉字！请输入正确的名字！");
     return false;
   }
 });
 $("#tel2").click(function() {
   if (!CheckChinese($("#name2").val())) {
     alert("收件人名字只能是汉字！请输入正确的名字！");
     return false;
   }
 });
 $("#unit1").click(function() {

   if (!myreg.test($("#tel1").val())||!myphone.test($("#tel1").val())) {
     alert('请输入有效的寄件人手机号码或固话号！');
     return false;
   }
 });
 $("#unit2").click(function() {

   if (!myreg.test($("#tel2").val())||!myphone.test($("#tel2").val())) {
     alert('请输入有效的收件人手机号码或固话号！');
     return false;
   }
 });
 $("#addr1").click(function() {
   if ($("#s_province").val() == "省份") {
     alert('请选择寄件省份和地级市！');
     return false;
   }
 });

 // $("#addr2").click(function() {

 //   if ($("#c_province").val() == "省份") {
 //     alert('请选择收货省份和地级市！');
 //     return false;
 //   }
 // });
 $("#submit").click(function() {
   var strSession = "<?php echo $_SESSION['name']; ?>".toString();
   if (strSession == '') {
     alert('请先登录！');
     var url = "<?php $url=U('index/login');echo $url ?>".toString();
     window.location.href = url;

   }
   if (!CheckChinese($("#name1").val())) {
     alert("寄件人名字只能是汉字！请输入正确的名字！");
     return false;
   }
   if (!myreg.test($("#tel1").val())||!myphone.test($("#tel1").val())) {
     alert('请输入有效的寄件人手机号码或固话号！');
     return false;
   }
   
     
   if (!CheckChinese($("#name2").val())) {
     alert("收件人名字只能是汉字！请输入正确的名字！");
     return false;
   }
   if (!myreg.test($("#tel2").val())||!myphone.test($("#tel2").val())) {
     alert('请输入有效的手机号码或固话号！');
     return false;
   }
   if ($("#c_province").val() == "省份") {
     alert('请选择收货省份和地级市！');
     return false;
   }
   if ($("#option3").val() == "") {
     alert('请输入备注！');
     return false;
   }


 });