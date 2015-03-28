/**
 * Created by wubo on 2015/3/12.
 */
$().ready(function(){

    $("#shop_info").validate({
        rules:{
            name:{
                required:true,
                minlength:4,
                maxlength:8
            },
            contacts:{
                required:true,
                minlength:2,
                maxlength:8
            },
            telephone:{
                required:true,
                minlength:8,
                maxlength:13
            },
            address:{
                required:true,
                minlength:5,
                maxlength:25
            },

        },
        messages: {
            name: {
                required: "没有输入",
                minlength:"最少输入4个字",
                maxlength:"最多输入8个字"
            },
            contacts: {
                required: "没有输入",
                minlength:"最少输入2个字",
                maxlength:"最多输入8个字"
            },
            telephone:{
                required:"没有输入",
                minlength:"最少输入8个字",
                maxlength:"最多输入13个字"
            },
            address:{
                required:"没有输入",
                minlength:"最少输入5个字",
                maxlength:"最多输入25个字"
            },
        },

    });
});