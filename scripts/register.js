function register(){
    	var user = document.getElementById('user');
        var pass = document.getElementById('pass');
        var fname = document.getElementById('fname');
        var lname = document.getElementById('lname');
        var email = document.getElementById('email');
        var registerbtn = document.getElementById('registerbtn');

    	user.style.borderColor = '#999';
        pass.style.borderColor = '#999';
        fname.style.borderColor = '#999';
        lname.style.borderColor = '#999';
        email.style.borderColor = '#999';
    	if(user.value==''){
    		alertify.log('No username entered', 'error');
    		user.style.borderColor = 'red';
    		return false;
    	} else if(pass.value==''){
            alertify.log('No password entered', 'error');
            pass.style.borderColor = 'red';
            return false;
        } else if(fname.value==''){
            alertify.log('No first name entered', 'error');
            fname.style.borderColor = 'red';
            return false;
        } else if(lname.value==''){
            alertify.log('No last name entered', 'error');
            lname.style.borderColor = 'red';
            return false;
        } else if(email.value==''){
            alertify.log('No email entered', 'error');
            email.style.borderColor = 'red';
            return false;
        }
	
	var data = 'user=' + user.value + '&pass=' + pass.value + '&fname=' + fname.value + '&lname=' + lname.value + '&email=' + email.value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/processing/register.php',
         data : data,
         beforeSend : function() {
             registerbtn.disabled = true;
             user.disabled = true;
             pass.disabled = true;
             fname.disabled = true;
             lname.disabled = true;
             email.disabled = true;
             registerbtn.value = 'Processing';
         },
         error : function() {
             registerbtn.disabled = false;
             user.disabled = false;
             pass.disabled = false;
             fname.disabled = false;
             lname.disabled = false;
             email.disabled = false;
             registerbtn.value = 'Register';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	registerbtn.value = array[2];
   		        window.location.href = '/login/?m=registered';
             } else {
                user.disabled = false;
                pass.disabled = false;
                fname.disabled = false;
                lname.disabled = false;
                email.disabled = false;
                registerbtn.disabled = false;
                registerbtn.value = array[2];
           		alertify.log(array[1], 'error');
             }
             return false;
         }
    	});
}