function createcause(){
    	var error = false;
    	document.getElementById('causename').style.borderColor = '#999';
    	if(document.getElementById('causename').value==''){
    		alertify.log('No cause name entered', 'error');
    		document.getElementById('causename').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
	
	var data = 'causename=' + document.getElementById('causename').value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/create.php',
         data : data,
         beforeSend : function() {
             document.getElementById('causecreatebtn').disabled = true;
             document.getElementById('causename').disabled = true;
             document.getElementById('causecreatebtn').value = 'Creating';
         },
         error : function() {
             document.getElementById('causecreatebtn').disabled = false;
             document.getElementById('causename').disabled = false;
             document.getElementById('causecreatebtn').value = 'Create';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	document.getElementById('causecreatebtn').value = array[2];
   		        window.location.href = '/cause/' + array[1] + '/';
             } else if(array[0]=='2'){
                document.getElementById('causename').disabled = false;
                document.getElementById('causecreatebtn').disabled = false;
                document.getElementById('causecreatebtn').value = array[2];
           		alertify.log(array[1], 'error');
           		document.getElementById('causename').style.borderColor = 'red';
             } else {
                document.getElementById('causename').disabled = false;
                document.getElementById('causecreatebtn').disabled = false;
                document.getElementById('causecreatebtn').value = array[2];
           		alertify.log(array[1], 'error');
             }
             return false;
         }
    	});
}