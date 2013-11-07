function login(){
    	var u = document.getElementById('u');
        var p = document.getElementById('p');
        var signinbtn = document.getElementById('signinbtn');


    	u.style.borderColor = '#999';
    	p.style.borderColor = '#999';
    	if(u.value==''){
    		alertify.log('No Username Entered', 'error');
    		u.style.borderColor = 'red';
    		return false;
    	}
    	if(p.value==''){
    		alertify.log('No Password Entered', 'error');
    		p.style.borderColor = 'red';
    		return false;
    	}
	
	var data = 'u=' + u.value + '&p=' + p.value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/processing/login.php',
         data : data,
         beforeSend : function() {
             signinbtn.disabled = true;
             u.disabled = true;
             p.disabled = true;
             signinbtn.value = 'Logging in';
         },
         error : function() {
             signinbtn.disabled = false;
             u.disabled = false;
             p.disabled = false;
             signinbtn.value = 'Error';
             p.value = '';
             alertify.log('Error connecting to DB', 'error');
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	signinbtn.value = array[2];
   		        window.location.href = '/';
             } else if(array[0]=='2'){
                u.disabled = false;
                p.disabled = false;
                signinbtn.disabled = false;
                signinbtn.value = array[2];
                alertify.log(array[1], 'error');
           		u.style.borderColor = 'red';
           		p.style.borderColor = 'red';
           		p.value = '';
             } else {
                u.disabled = false;
                p.disabled = false;
                signinbtn.disabled = false;
                signinbtn.value = array[2];
           		alertify.log(array[1], 'error');
           		p.value = '';
             }
             return false;
         }
    	});
}