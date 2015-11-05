window.onload = function() {
	calculateTotal();
    
	document.getElementById('submit').onclick=function(){

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
};

function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
}

function calculateTotal()
{
	var amount;
    var totalChecked = 0;

	var price_size = {};
	var price_crust = {};
	var price_toppings;
	var v_tax;
	var v_subTotal;
	var v_total;
    
    var taxrate = getCookie("taxrate");
    var dough_json =  getCookie("dough");
    var price_dough = JSON.parse(replaceSpecial(dough_json));
   
    var crust_json = getCookie("crust");
    var price_crust = JSON.parse(replaceSpecial(crust_json));
    
    amount = document.forms["orderform"]["quantity"].value;
    
	totalChecked = countCheckedSelectValue("meat[]")
                                +countCheckedSelectValue("veggie[]")
                                +countCheckedSelectValue("cheese[]");
    	
	if (totalChecked <= 0){
		price_toppings = 0;
	} else {
        price_toppings = (totalChecked - 1) * 0.5;
    }
    
	v_subTotal = price_dough[getSelectValue("size")] 
	v_subTotal = v_subTotal	+ price_crust[getSelectValue("crustname")] 
	v_subTotal = v_subTotal	+ price_toppings;
    
	v_subTotal = roundToTwo(v_subTotal * amount);
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

//Due to some reason, CakePHP encoded cookie has to process special characters
//This will be used before parsing JSON parser 
function replaceSpecial(strName) {
    strName = strName.replace(/%7B/g, '{');
    strName = strName.replace(/%22/g, '"');
    strName = strName.replace(/%3A/g, ':');
    strName = strName.replace(/%7D/g, '}');
    strName = strName.replace(/%2C/g, ',');
    return strName;
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

