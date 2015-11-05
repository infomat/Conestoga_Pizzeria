function isEmpty(string) {
    return string.trim() == "";
}


function showError(message){
	document.getElementById("errors").classList.remove("hidden");
	document.getElementById("error").innerHTML = message;
}

function validate(){
	return validateName() && validateAddress() && validateCity() && validatePostalCode() && validateEmail() && validatePhoneNumber();
}


//Name field - empty check
function validateName()
{
	var name = document.forms["regform"]["name"];
	if(isEmpty(name.value)==true)
	{
		showError("Name is required");
		name.focus() ;
		return false;
	}
	return true;
}

// Address - empty check
function validateAddress()
{
	var addr = document.forms["regform"]["addr"];
	if(isEmpty(addr.value)==true)
	{
		showError("Address is required");
		addr.focus() ;
		return false;
	}
	return true;
}

// City - empty check
function validateCity()
{
	var city = document.forms["regform"]["city"];
	if(isEmpty(city.value)==true)
	{
		showError("City is required");
		city.focus() ;
		return false;
	}
	return true;
}

// Postal Code - empty & correct format 
function validatePostalCode()
{
	var postcode = document.forms["regform"]["postalcode"];
	var postcode_pattern = /^[ABCEGHJKLMNPRSTVXY]{1}\d{1}[A-Z]{1} *\d{1}[A-Z]{1}\d{1}$/;

	if(isEmpty(postcode.value)==true) {
		showError("Postal Code is required");
		postcode.focus() ;
		return false;
	} else if (postcode_pattern.test(postcode.value)==false) {
		showError("Correct format of postal code is required e! e.g) N1V1K8");
		postcode.focus() ;
		return false;
	}
	return true;
}

// Email - empty & correct format
function validateEmail()
{
	var email = document.forms["regform"]["email"];
	var email_pattern = /^[0-9a-zA-Z\.]+@[0-9a-zA-Z]+\.[0-9a-zA-Z]+$/;
	
	if(isEmpty(email.value)==true) {
		showError("Email is required");
		email.focus() ;
		return false;
	} else if(email_pattern.test(email.value)==false) {
		showError("Input email with proper format is required!  e.g) x@y.z");
		email.focus() ;
		return false;
	}
	return true;
}

// Telephone - empty & correct format
function validatePhoneNumber()
{
	var usrtel = document.forms["regform"]["phonenumber"];
	var usrtel_pattern = /^\d{3}-\d{3}-\d{4}$/;
	
	if(isEmpty(usrtel.value)==true) {
		showError("Phone Number is required");
		usrtel.focus() ;
		return false;
	} else if(usrtel_pattern.test(usrtel.value)==false) {
		showError("Input telephone number with correct format is required! e.g) ddd-ddd-dddd");
		usrtel.focus();
		return false;
	}
	return true;
}