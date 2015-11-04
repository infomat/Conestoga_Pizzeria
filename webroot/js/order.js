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


function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

function calculateTotal()
{
	var amount = document.forms["orderform"]["quantity"];
    var totalChecked = 0;

	var price_size = {};
	var price_crust = {};
	var price_toppings;
	var v_tax;
	var v_subTotal;
	var v_total;
    

    var taxrate = getCookie("taxrate");
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
	
    totalChecked = countCheckedSelectValue("meat[]")
                                +countCheckedSelectValue("veggie[]")
                                +countCheckedSelectValue("cheese[]");
    	
	if (totalChecked <= 0){
		price_toppings = 0;
	} else {
        price_toppings = (totalChecked - 1) * 0.5;
    }
    
	v_subTotal = price_size[getSelectValue("size")] 
				+ price_crust[getSelectValue("crustname")] 
				+ price_toppings;
	v_subTotal = roundToTwo(v_subTotal * 	amount.value);
	v_tax = roundToTwo(v_subTotal * parseFloat(taxrate));
	
	v_total = v_subTotal + v_tax;
	
	document.forms["orderform"]["subtotal"].value = v_subTotal;
	document.forms["orderform"]["tax"].value = v_tax;
	document.forms["orderform"]["total"].value = v_total;

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

//Read # of checked with topping name

    
function countCheckedSelectValue(name) {
    var elements = document.getElementsByName(name);
	var count = 0;

    for (var i=0, len=elements.length; i<len; ++i)
        if (elements[i].checked) {
			count++;
		}
		return count;
}

    
function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
    }
    return "";
}
}
