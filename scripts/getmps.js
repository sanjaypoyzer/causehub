function getmps(){
    	var error = false;
    	document.getElementById('causename').style.borderColor = '#999';
    	if(document.getElementById('causename').value==''){
    		alertify.log('No cause name entered', 'error');
    		document.getElementById('causename').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
	
	var data = 'keyword=' + document.getElementById('causename').value;
    	$.ajax({
        type  : 'GET',
         url  : '/scripts/processing/getmps.php',
         data : data,
         beforeSend : function() {
             document.getElementById('causecreatebtn').disabled = true;
             document.getElementById('causename').disabled = true;
             document.getElementById('causecreatebtn').value = 'Searching';
         },
         error : function() {
             document.getElementById('causecreatebtn').disabled = false;
             document.getElementById('causename').disabled = false;
             document.getElementById('causecreatebtn').value = 'Go';
             return false;
         },
         success : function (response) {
             document.getElementById('causecreatebtn').value = 'Go';
             document.getElementById('causecreatebtn').disabled = false;
             document.getElementById('causename').disabled = false;
             document.getElementById('results').innerHTML = response;
             return false;
         }
    	});
}
