/**
 +----------------------------------------------------------
 * 监听
 +----------------------------------------------------------
 */
$(function() {
    $(".cartBox .minus").click(function() {
        var item_id = $(this).data("id");
        changeNumber(item_id, 'minus');
    });
 
    $(".cartBox .plus").click(function() {
        var item_id = $(this).data("id");
        changeNumber(item_id, 'plus');
    });
 
    $(".cartBox .inp").change(function() {
        var item_id = $(this).data("id");
        var number = $(this).val();
        changePrice(item_id, number);
    });
});

/**
 +----------------------------------------------------------
 * 更新购物车数量
 +----------------------------------------------------------
 */
function changeNumber(item_id, calculate) {
    var item = document.getElementById("number_" + item_id);
   
    if (calculate == 'plus') {
        item.value++;
    } else {
        if (item.value > 1) {
            item.value--;
        }
    }
    
    changePrice(item_id, item.value);
}

/**
 +----------------------------------------------------------
 * 更新购物车价格
 +----------------------------------------------------------
 */
function changePrice(item_id, number) {
    if (number == 0) {
        document.getElementById("number_" + item_id).value = 1;
        var number = 1;
    }
 
    $.ajax({
        type: "POST",
        url: root_url + 'order.php?rec=update',
        data: {"item_id":item_id, "number":number},
        dataType: "json",
        success: function(order) {
            $("#subtotal_" + item_id).html(order.subtotal);
            $("#total").html(order.total);
            $("#item_amount").html(order.item_amount);
        }
    });
}

/**
 +----------------------------------------------------------
 * 更新快递费
 +----------------------------------------------------------
 */
function changeShipping(unique_id) {
    $.ajax({
        type: "POST",
        url: root_url + 'order.php?rec=change_shipping',
        data: {"unique_id":unique_id},
        dataType: "json",
        success: function(order) {
            $("#shipping_fee").html(order.shipping_fee);
            $(".order_amount").html(order.order_amount)
        }
    });
}