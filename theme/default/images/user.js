/**
 +----------------------------------------------------------
 * 监听
 +----------------------------------------------------------
 */
$(function() {
    $(".inputFile .imgBtn").click(function() {
        $('.inputFile #avatarClick').click();
    });
 
    $(".inputFile #avatarClick").change(function() {
        fileShow(this, 'avatar')
    });


    $(".inputFile .imgBtncard").click(function() {
        $('.inputFile #card_idClick').click();
    });
    $(".inputFile .imgBtndisForm").click(function() {
        $('.inputFile #dis_formClick').click();
    });

    $(".inputFile #dis_formClick").change(function() {
        fileShow(this, 'dis_form')
    });

    $(".inputFile #card_idClick").change(function() {
        fileShow(this, 'card_id')
    });

    $(".inputFile .imgBtncardback").click(function() {
        $('.inputFile #card_idbackClick').click();
    });

    $(".inputFile #card_idbackClick").change(function() {
        fileShow(this, 'card_idback')
    });



    laydate.render({
        elem: '#time'
        ,trigger: 'click'
    });
    laydate.render({
        elem: '#time1'
        ,trigger: 'click'
    });
    laydate.render({
        elem: '#time2'
        ,trigger: 'click'
    });
    laydate.render({
        elem: '#time3'
        ,trigger: 'click'
    });



    $('.top').click(function(){
        var obj=$(this);

        if(obj.parent().parent().children('.child').css('display')=='none')
        {
            obj.parent().parent().children('.child').css('display','block');
        }
        else
        {
            obj.parent().parent().children('.child').css('display','none')
        }

    });


    $('.taskcenteritem').click(function(){
        var obj=$(this);
        var id = obj.attr('data-id');
        window.location.href="/usernew.php?rec=taskcenterinfo&id="+id;

    });


    $('.change_price_type').click(function(){
        var obj=$(this);
        var value = obj.val();
        if(value=='1')
        {
            $('.price_to_span').css('display','block');
        }
        else
        {
            $('.price_to_span').css('display','none');
        }

    });

    $('.taskcenterSearch').click(function(){
        $('.taskcenteForm').submit();
    });


    $('.searchPrice').click(function(){
        var datas = $(this).attr('data-value');
        $('#taskcenter_price').val(datas);
        $('.taskcenteForm').submit();
    });


    $('.searchAddtime').click(function(){

        var datas = $(this).attr('data-value');
        $('#taskcenter_addtime').val(datas);
        $('.taskcenteForm').submit();
    });


    $('.searchEndtime').click(function(){

        var datas = $(this).attr('data-value');
        $('#taskcenter_endtime').val(datas);
        $('.taskcenteForm').submit();
    });


    $('.province').click(function(){
       $('.province_list').css('display','block');
       $('.city_list').css('display','none');
    });

    $('.province_list li').click(function(){
       var province =  $(this).children('span').html();
        $('.province_list').css('display','none');
        $('#taskcenter_province').val(province);
        $('.province span').html(province);

        $.ajax({
            type: 'post',
            url:'/usernew.php?rec=getcitylist',
            data: {province:province},
            dateType: 'json',
            success: function(response){

                var obj3  = JSON.parse(response);

                var html = '';
                $.each(obj3,function(i,n)
                {
                    console.log(n);
                    html += '<li data-v-09660f48="" data-value="'+n.name+'" class="city-item"><span data-v-09660f48="">'+n.name+'</span></li>';

                });
                $('.city_list').html(html);
            },
            error:function(){
                alert('请稍后再试');
            }
        });

    });

    $('.city').click(function(){
        $('.city_list').css('display','block');
        $('.province_list').css('display','none');
    });

    $('.city_list li').live('click',function(){
         var city =  $(this).children('span').html();
         $('.city_list').css('display','none');
        $('.city span').html(city);
        $('#taskcenter_city').val(city);
        $('.taskcenteForm').submit();
    });


    $('.searchCat').click(function(){
        $('.searchCat').css("background","none");
        $('.searchCat').css("color","#666");
        $(this).css("background","#fde9e7");
        $(this).css("color","#f87726");
        var datas = $(this).attr('data-value');
        $('#taskcenter_catid').val(datas);

        if(datas=='all')
        {
            $('#taskcenter_catid2').val(datas);
            $('.taskcenteForm').submit();
        }
        else
        {
            //获取子分类
            $.ajax({
                type: 'post',
                url:'/usernew.php?rec=getcatchildlist',
                data: {cat_id:datas},
                dateType: 'json',
                success: function(response){


                        var obj3  = JSON.parse(response);

                        var html = '';

                        if(obj3)
                        {
                            $.each(obj3,function(i,n)
                            {
                                console.log(n);
                                html += '<li data-v-09660f48="" data-value="'+n.cat_id+'">'+n.cat_name+'</li>';
                            });
                            $('.cat2').html(html);
                            $('.cat2').css("display","block");
                        }
                        else
                        {
                            $('#taskcenter_catid2').val("");
                            $('.taskcenteForm').submit();
                        }



                },
                error:function(){
                    alert('请稍后再试');
                }
            });
        }




    });

    $('.cat2 li').live('click',function(){
        var cat_id =  $(this).attr('data-value');
        $('.cat2').css('display','none');
         $('#taskcenter_catid2').val(cat_id);
        $('.taskcenteForm').submit();
    });

    $('.province-city-all').click(function(){
        var datas = $(this).attr('data-value');
        $('#taskcenter_province').val(datas);
        $('#taskcenter_city').val(datas);
        $('.taskcenteForm').submit();

    });

    $('.orders li').click(function(){
        var datas = $(this).attr('data-value');
        if(datas== $('#taskcenter_order').val())
        {
            var orderval = $('#taskcenter_order_value').val();
            if(orderval=='desc')
            {
                $('#taskcenter_order_value').val('asc')
            }
            else
            {
                $('#taskcenter_order_value').val('desc')
            }
            $('.taskcenteForm').submit();

        }
        else
        {
            if(datas!='declear')
            {
                $('#taskcenter_order').val(datas);
                $('#taskcenter_order_value').val('desc')
            }
            else
            {
                $('#taskcenter_order').val("");
            }

            $('.taskcenteForm').submit();
        }

    });


    $('.toaddlist').click(function(){

        window.location.href="/usernew.php?rec=addlist";
    });

    $('.editcominfo').click(function(){

        $('.editcominfo_content').css('display','block');
    });

    $('.close_editcominfo_content').click(function(){

        $('.editcominfo_content').css('display','none');
    });

    $('.showcominfo').click(function(){

        $('.showcominfo_content').css('display','block');
    });

    $('.close_showcominfo_content').click(function(){

        $('.showcominfo_content').css('display','none');
    });




    $('#category1').live('change',function(){
         var cat_id =  $(this).val();
        $.ajax({
            type: 'post',
            url:'/usernew.php?rec=getcatchildlist',
            data: {cat_id:cat_id},
            dateType: 'json',
            success: function(response){

                var obj3  = JSON.parse(response);

                var html = '';

                if(obj3)
                {
                    $.each(obj3,function(i,n)
                    {
                        console.log(n);
                        html += '<option value="'+n.cat_name+'">'+n.cat_name+'</option>';
                     });
                    $('#category2').html(html);
                    $('#category2').css("display","block");
                }

            },
            error:function(){
                alert('请稍后再试');
            }
        });

    });






});




/**
 +----------------------------------------------------------
 * 实时显示FILE图片
 +----------------------------------------------------------
 */
function fileShow(node, target) {
    var imgURL = "";
    
    try {
        var file = null;
        if (node.files && node.files[0] ) {
            file = node.files[0];
        } else if (node.files && node.files.item(0)) {
            file = node.files.item(0);
        }
        //Firefox 因安全性问题已无法直接通过input[file].value 获取完整的文件路径
        try {
            imgURL = file.getAsDataURL();
        } catch(e) {
            imgRUL = window.URL.createObjectURL(file);
        }
    } catch(e) {
        if (node.files && node.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                imgURL = e.target.result;
            };
            reader.readAsDataURL(node.files[0]);
        }
    }
    
    var textHtml = "<img src='" + imgRUL + "'/>";
    $("#" + target + "Show").html(textHtml);
    document.getElementById(target + 'Value').value = imgRUL;
    
    return imgURL;
}