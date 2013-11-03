function register(){
    	var error = false;
    	document.getElementById('user').style.borderColor = '#999';
        document.getElementById('pass').style.borderColor = '#999';
        document.getElementById('fname').style.borderColor = '#999';
        document.getElementById('lname').style.borderColor = '#999';
        document.getElementById('email').style.borderColor = '#999';
    	if(document.getElementById('user').value==''){
    		alertify.log('No username entered', 'error');
    		document.getElementById('user').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
        if(document.getElementById('pass').value==''){
            alertify.log('No password entered', 'error');
            document.getElementById('pass').style.borderColor = 'red';
            error = true;
            return false;
        }
        if(document.getElementById('fname').value==''){
            alertify.log('No first name entered', 'error');
            document.getElementById('fname').style.borderColor = 'red';
            error = true;
            return false;
        }
        if(document.getElementById('lname').value==''){
            alertify.log('No last name entered', 'error');
            document.getElementById('lname').style.borderColor = 'red';
            error = true;
            return false;
        }
        if(document.getElementById('email').value==''){
            alertify.log('No email entered', 'error');
            document.getElementById('email').style.borderColor = 'red';
            error = true;
            return false;
        }
	
	var data = 'user=' + document.getElementById('user').value + '&pass=' + document.getElementById('pass').value + '&fname=' + document.getElementById('fname').value + '&lname=' + document.getElementById('lname').value + '&email=' + document.getElementById('email').value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/register.php',
         data : data,
         beforeSend : function() {
             document.getElementById('registerbtn').disabled = true;
             document.getElementById('user').disabled = true;
             document.getElementById('pass').disabled = true;
             document.getElementById('fname').disabled = true;
             document.getElementById('lname').disabled = true;
             document.getElementById('email').disabled = true;
             document.getElementById('registerbtn').value = 'Processing';
         },
         error : function() {
             document.getElementById('registerbtn').disabled = false;
             document.getElementById('user').disabled = false;
             document.getElementById('pass').disabled = false;
             document.getElementById('fname').disabled = false;
             document.getElementById('lname').disabled = false;
             document.getElementById('email').disabled = false;
             document.getElementById('registerbtn').value = 'Register';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	document.getElementById('registerbtn').value = array[2];
   		        window.location.href = '/login/?m=registered';
             } else if(array[0]=='2'){
                document.getElementById('user').disabled = false;
                document.getElementById('pass').disabled = false;
                document.getElementById('fname').disabled = false;
                document.getElementById('lname').disabled = false;
                document.getElementById('email').disabled = false;
                document.getElementById('registerbtn').disabled = false;
                document.getElementById('registerbtn').value = array[2];
           		alertify.log(array[1], 'error');
             } else {
                document.getElementById('user').disabled = false;
                document.getElementById('pass').disabled = false;
                document.getElementById('fname').disabled = false;
                document.getElementById('lname').disabled = false;
                document.getElementById('email').disabled = false;
                document.getElementById('registerbtn').disabled = false;
                document.getElementById('registerbtn').value = array[2];
           		alertify.log(array[1], 'error');
             }
             return false;
         }
    	});
}