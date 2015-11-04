window.onload = function() {
	calculateTotal();
	document.getElementById('submit').onclick=function(){
		document.getElementById("errors").classList.add("hidden");

		if (validate() == true){
			//If validation is OK then show result
			return true;
		} else {
			return false
		}
	};
	document.getElementById('orderform').onclick=function(){
		calculateTotal();
	};	
}

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

function calculateTotal()
{
	var province = document.forms["orderform"]["province"];
	var amount = document.forms["orderform"]["quantity"];


	//Ontario:13, Quebec:14.975,Manitoba:13,Saskatchewan:10
	var taxrate = {};
	var price_size = {};
	var price_crust = {};
	var price_toppings;
	var v_tax;
	var v_subTotal;
	var v_total;


	
	if (Object.keys(taxrate).length == 0)
	{
		taxrate['Ontario'] = 0.13;
		taxrate['Quebec'] = 0.14975;
		taxrate['Manitoba'] = 0.13;
		taxrate['Saskatchewan'] = 0.1;
	}
	if (Object.keys(price_size).length == 0)
	{
		price_size['Small'] = 5;
		price_size['Medium'] = 10;
		price_size['Large'] = 15;
		price_size['X-large'] = 20;
	}
	if (Object.keys(price_crust).length == 0)
	{
		price_crust['Hand-tossed'] = 0;
		price_crust['Pan'] = 0;
		price_crust['Stuffed'] = 2;
		price_crust['Thin'] = 0;
	}
	
	price_toppings = (countCheckedRadioValue("toppings[]") - 1) * 0.5;
	if (price_toppings < 0){
		price_toppings = 0;
	}
    
  

    
	v_subTotal = price_size[getSelectValue("size")] 
				+ price_crust[getSelectValue("crustname")] 
				+ price_toppings;
	v_subTotal = roundToTwo(v_subTotal * 	amount.value);
	v_tax = roundToTwo(v_subTotal * 0.13);
	
	v_total = v_subTotal + v_tax;
	
	document.forms["orderform"]["subtotal"].value = v_subTotal;
	document.forms["orderform"]["tax"].value = v_tax;
	document.forms["orderform"]["total"].value = v_total;
	
	document.getElementById("subtotal").innerHTML = v_subTotal;
	document.getElementById("tax").innerHTML = v_tax;
	document.getElementById("total").innerHTML = v_total;
}

function getSelectValue(id) {
    var e = document.getElementById(id);
    return e.options[e.selectedIndex].value;
}

function getCheckedRadioValue(name) {
    var elements = document.getElementsByName(name);

    for (var i=0, len=elements.length; i<len; ++i)
        if (elements[i].checked)
			return elements[i].value;
}

function countCheckedRadioValue(name) {
    var elements = document.getElementsByName(name);
	var count = 0;

    for (var i=0, len=elements.length; i<len; ++i)
        if (elements[i].checked) {
			count++;
		}
		return count;
}
