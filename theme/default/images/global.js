/**
 +----------------------------------------------------------
 * 下拉菜单
 +----------------------------------------------------------
 */
$(function() {
    /* 主导航 */
    $("#header .mainNav li").hover(function() {
        $(this).addClass("hover");
        $('ul:first', this).css('display', 'block');
    },
    function() {
        $(this).removeClass("hover");
        $('ul:first', this).css('display', 'none');
    });
    /* 顶部导航 */
    $("ul.topNav li.parent").hover(function() {
        $(this).addClass("hover");
        $('ul:first', this).css('display', 'block');
    },
    function() {
        $(this).removeClass("hover");
        $('ul:first', this).css('display', 'none');
    });
});

/**
 +----------------------------------------------------------
 * 刷新验证码
 +----------------------------------------------------------
 */
function refreshimage() {
    var cap = document.getElementById("vcode");
    cap.src = cap.src + '?';
}

/**
 +----------------------------------------------------------
 * 搜索框的鼠标交互事件
 +----------------------------------------------------------
 */
function inputClick(name, text) {
    var obj = name;
    if (typeof(name) == "string") obj = document.getElementById(id);
    if (obj.value == text) {
        obj.value = "";
    }
    obj.onblur = function() {
        if (obj.value == "") {
            obj.value = text;
        }
    }
}

/**
 +----------------------------------------------------------
 * 表单提交
 +----------------------------------------------------------
 */
function douSubmit(form_id) {
    var formParam = $("#"+form_id).serialize(); //序列化表格内容为字符串
    
    $.ajax({
        type: "POST",
        url: $("#"+form_id).attr("action")+'&do=callback',
        data: formParam,
        dataType: "json",
        success: function(form) {
            if (!form) {
                $("#"+form_id).submit();
            } else {
                for(var key in form) {
                    $("#"+key).html(form[key]);
                }
            }
        }
    });
}

/**
 +----------------------------------------------------------
 * 弹出确认提示
 +----------------------------------------------------------
 */
function douConfirm(url, msg) {
    if (confirm(msg)) {
        window.location.href = url;
    }
}

/**
 +----------------------------------------------------------
 * 清空对象内HTML
 +----------------------------------------------------------
 */
function douRemove(target) {
    var obj = document.getElementById(target);
    obj.parentNode.removeChild(obj);
}

/**
 +----------------------------------------------------------
 * 收藏本站
 +----------------------------------------------------------
 */
function AddFavorite(url, title) {
    try {
        window.external.addFavorite(url, title)
    } catch(e) {
        try {
            window.sidebar.addPanel(title, url, "")
        } catch(e) {
            alert("加入收藏失败，请使用Ctrl+D进行添加")
        }
    }
}


/**
 +----------------------------------------------------------
 * 发送ajax
 +----------------------------------------------------------
 */
var InterValObj; //timer变量，控制时间
var count = 60; //间隔函数，1秒执行
var curCount; //当前剩余秒数
function douSendSms(url, mobile) {

    $.ajax({
        type: 'post',
        url:url,
        data: {mobile:mobile},
        dateType: 'json',
        success: function(response){
            curCount = count;
            $('#vcode_return').val(mobile+response.code);
            //设置button效果，开始计时
            $(".sendcodetext").attr("disabled", "true");
            $(".sendcodetext").html("请在" + curCount + "秒内输入");
            InterValObj = window.setInterval(SetRemainTimes, 1000); //启动计时器，1秒执行一次
        },
        error:function(){
            alert('请稍后再试');
        }
    });
}

//timer处理函数
function SetRemainTimes() {
    if(curCount == 0) {
        window.clearInterval(InterValObj); //停止计时器
        $(".sendcodetext").removeAttr("disabled"); //启用按钮
        $(".sendcodetext").html("重新发送验证码");
        code = ""; //清除验证码。如果不清除，过时间后，输入收到的验证码依然有效
    } else {
        curCount--;
        $(".sendcodetext").html("请在" + curCount + "秒内输入");
    }
}