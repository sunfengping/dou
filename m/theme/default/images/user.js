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
