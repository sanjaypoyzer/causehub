function login(){
    	var error = false;
    	document.getElementById('u').style.borderColor = '#999';
    	document.getElementById('p').style.borderColor = '#999';
    	if(document.getElementById('u').value==''){
    		alertify.log('No Username Entered', 'error');
    		document.getElementById('u').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
    	if(document.getElementById('p').value==''){
    		alertify.log('No Password Entered', 'error');
    		document.getElementById('p').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
	
	var data = 'u=' + document.getElementById('u').value + '&p=' + document.getElementById('p').value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/processing/login.php',
         data : data,
         beforeSend : function() {
             document.getElementById('signinbtn').disabled = true;
             document.getElementById('u').disabled = true;
             document.getElementById('p').disabled = true;
             document.getElementById('signinbtn').value = 'Logging in';
         },
         error : function() {
             document.getElementById('signinbtn').disabled = false;
             document.getElementById('u').disabled = false;
             document.getElementById('p').disabled = false;
             document.getElementById('signinbtn').value = 'Error';
             document.getElementById('p').value = '';
             alertify.log('Error connecting to DB', 'error');
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	document.getElementById('signinbtn').value = array[2];
   		        window.location.href = '/';
             } else if(array[0]=='2'){
                document.getElementById('u').disabled = false;
                document.getElementById('p').disabled = false;
                document.getElementById('signinbtn').disabled = false;
                document.getElementById('signinbtn').value = array[2];
                alertify.log(array[1], 'error');
           		document.getElementById('u').style.borderColor = 'red';
           		document.getElementById('p').style.borderColor = 'red';
           		document.getElementById('p').value = '';
             } else {
                document.getElementById('u').disabled = false;
                document.getElementById('p').disabled = false;
                document.getElementById('signinbtn').disabled = false;
                document.getElementById('signinbtn').value = array[2];
           		alertify.log(array[1], 'error');
           		document.getElementById('p').value = '';
             }
             return false;
         }
    	});
}