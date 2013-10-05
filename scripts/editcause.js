function editCauseSlug(){
    	var error = false;
    	document.getElementById('editslug').style.borderColor = '#999';
    	if(document.getElementById('editslug').value==''){
    		alertify.log('No slug entered', 'error');
    		document.getElementById('editslug').style.borderColor = 'red';
    		error = true;
    		return false;
    	}
	
	var data = 'causeid=' + document.getElementById('causeid').value + '&action=editslug&newslug=' + document.getElementById('editslug').value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/editcause.php',
         data : data,
         beforeSend : function() {
             document.getElementById('editslugbtn').disabled = true;
             document.getElementById('editslug').disabled = true;
             document.getElementById('editslugbtn').value = 'Processing';
         },
         error : function() {
             document.getElementById('editslugbtn').disabled = false;
             document.getElementById('editslug').disabled = false;
             document.getElementById('editslugbtn').value = 'Update';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	document.getElementById('editslugbtn').value = array[2];
   		        window.location.href = '/cause/' + array[1] + '/';
             } else if(array[0]=='2'){
                document.getElementById('editslug').disabled = false;
                document.getElementById('editslugbtn').disabled = false;
                document.getElementById('editslugbtn').value = array[2];
           		alertify.log(array[1], 'error');
           		document.getElementById('editslug').style.borderColor = 'red';
             } else {
                document.getElementById('editslug').disabled = false;
                document.getElementById('editslugbtn').disabled = false;
                document.getElementById('editslugbtn').value = array[2];
           		alertify.log(array[1], 'error');
             }
             return false;
         }
    	});
}