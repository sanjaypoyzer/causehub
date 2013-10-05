function updateActionForm(){
	var selected = document.getElementById('actiontype').value;
	if(selected!='lobbyLord'){
		document.getElementById('lobbyLord').style.display = 'none';
	} else {
		document.getElementById('lobbyLord').style.display = 'block';
	}
}

function addKnowledge(){
    	var error = false;
    	document.getElementById('fact').style.borderColor = '#999';
    	document.getElementById('sourceurl').style.borderColor = '#999';
    	document.getElementById('lobbylord_name').style.borderColor = '#999';
    	document.getElementById('lobbylord_address').style.borderColor = '#999';
    	document.getElementById('lobbylord_message').style.borderColor = '#999';
    	if(document.getElementById('fact').value==''){
    		alertify.log('No fact entered', 'error');
    		document.getElementById('fact').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
    	if(document.getElementById('sourceurl').value==''){
    		alertify.log('No source url entered', 'error');
    		document.getElementById('sourceurl').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
    	if(document.getElementById('lobbylord_name').value==''){
    		alertify.log('No lord name entered', 'error');
    		document.getElementById('lobbylord_name').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
    	if(document.getElementById('lobbylord_address').value==''){
    		alertify.log('No lord email address entered', 'error');
    		document.getElementById('lobbylord_address').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
    	if(document.getElementById('lobbylord_message').value==''){
    		alertify.log('No message to the lord entered', 'error');
    		document.getElementById('lobbylord_message').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
	
	var data = 'cid=' + document.getElementById('causeid').value + '&fact=' + document.getElementById('fact').value + '&sourceurl=' + document.getElementById('sourceurl').value + '&actiontype=' + document.getElementById('actiontype').value + '&lobbylordname=' + document.getElementById('lobbylord_name').value + '&lobbylordaddress=' + document.getElementById('lobbylord_address').value + '&lobbylordmessage=' + document.getElementById('lobbylord_message').value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/addknowledge.php',
         data : data,
         beforeSend : function() {
             document.getElementById('addknowledgebtn').disabled = true;
             document.getElementById('fact').disabled = true;
             document.getElementById('sourceurl').disabled = true;
             document.getElementById('lobbylord_name').disabled = true;
             document.getElementById('lobbylord_address').disabled = true;
             document.getElementById('lobbylord_message').disabled = true;
             document.getElementById('addknowledgebtn').value = 'Processing';
         },
         error : function() {
             document.getElementById('addknowledgebtn').disabled = false;
             document.getElementById('fact').disabled = false;
             document.getElementById('sourceurl').disabled = false;
             document.getElementById('lobbylord_name').disabled = false;
             document.getElementById('lobbylord_address').disabled = false;
             document.getElementById('lobbylord_message').disabled = false;
             document.getElementById('addknowledgebtn').value = 'Add';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	document.getElementById('addknowledgebtn').value = array[2];
   		        window.location.href = '/editcause/' + array[1] + '/';
             } else if(array[0]=='2'){
                document.getElementById('fact').disabled = false;
	            document.getElementById('sourceurl').disabled = false;
	            document.getElementById('lobbylord_name').disabled = false;
	            document.getElementById('lobbylord_address').disabled = false;
	            document.getElementById('lobbylord_message').disabled = false;
                document.getElementById('addknowledgebtn').disabled = false;
                document.getElementById('addknowledgebtn').value = array[2];
           		alertify.log(array[1], 'error');
             } else {
	            document.getElementById('fact').disabled = false;
	            document.getElementById('sourceurl').disabled = false;
	            document.getElementById('lobbylord_name').disabled = false;
	            document.getElementById('lobbylord_address').disabled = false;
	            document.getElementById('lobbylord_message').disabled = false;
                document.getElementById('addknowledgebtn').disabled = false;
                document.getElementById('addknowledgebtn').value = array[2];
           		alertify.log(array[1], 'error');
             }
             return false;
         }
    	});
}