function sumtotal($cart_id){
	var price = parseFloat($('tr[id=' + $cart_id + '] input[name="price"]').val());
    var amount = parseInt($('tr[id=' + $cart_id + '] input[name="amount"]').val());
    var subtotal = price * amount;
    var res_subtotal = subtotal.toFixed(2);
    $('tr[id=' + $cart_id + '] span[id="subtotal"]').html(res_subtotal);
    
}

/*
 * 增加物品数量
 */
function add($cart_id) {
	$('tr[id=' + $cart_id + '] input[name="amount"]').val($('tr[id=' + $cart_id + '] input[name="amount"]').val() * 1 + 1);
    sumtotal($cart_id);
	balance();
	update_amount($cart_id);
}

/*
 * 减少物品数量
 */
function reduce($cart_id) {
	if ($('tr[id=' + $cart_id + '] input[name="amount"]').val() > 1)
		$('tr[id=' + $cart_id + '] input[name="amount"]').val($('tr[id=' + $cart_id + '] input[name="amount"]').val() * 1 - 1);
    sumtotal($cart_id);
	balance();
	update_amount($cart_id);
}

/*
 * 物品数量改变
 */
function number_change($cart_id) {
	var num = $('tr[id=' + $cart_id + '] input[name="amount"]').val();
	if (!isNumber(num)) {
		alert('请输入数字.')
	};
}

/*
 * 结算
 */
function balance() {

	var sum_amount = 0;
	$.each($(":input[name='amount']"), function() {
		sum_amount += parseInt(this.value);
	})
	$('span[id="number"]').html(sum_amount);
	var sum_price = 0;
	$.each($("span[id='subtotal']"), function() {
		sum_price += parseFloat(this.innerHTML);
    })
	var res_sum_price = sum_price.toFixed(2);

	$('span[id="total"]').html(res_sum_price);
}

/*
 * 更新购物车商品数量价格
 */
function update_amount($cart_id){

	var amount = $('tr[id=' + $cart_id + '] input[name="amount"]').val();
	var subtotal = $('tr[id=' + $cart_id + '] span[id="subtotal"]').html();
	var url = '/cart/update_amount';
	$.post(url,{
		'cart_id':$cart_id,
		'amount':amount,
		'subtotal':subtotal
	},function(result){
		if(result == 'false'){
			alert('失败.');
			location.reload();
		}
	});
}