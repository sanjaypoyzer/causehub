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
   		        window.location.href = '/editcause/' + array[1] + '/';
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

function editCauseDescription(){
        var error = false;
        document.getElementById('editdescription').style.borderColor = '#999';
        if(document.getElementById('editdescription').value==''){
            alertify.log('No description entered', 'error');
            document.getElementById('editdescription').style.borderColor = 'red';
            error = true;
            return false;
        }
    
    var data = 'causeid=' + document.getElementById('causeid').value + '&action=editdescription&newdescription=' + document.getElementById('editdescription').value;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/editcause.php',
         data : data,
         beforeSend : function() {
             document.getElementById('editdescriptionbtn').disabled = true;
             document.getElementById('editdescription').disabled = true;
             document.getElementById('editdescriptionbtn').value = 'Processing';
         },
         error : function() {
             document.getElementById('editdescriptionbtn').disabled = false;
             document.getElementById('editdescription').disabled = false;
             document.getElementById('editdescriptionbtn').value = 'Update';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                document.getElementById('editdescriptionbtn').value = array[2];
                document.getElementById('editdescriptionbtn').disabled = false;
                document.getElementById('editdescription').disabled = false;
                alertify.log(array[1], 'success');
             } else if(array[0]=='2'){
                document.getElementById('editdescription').disabled = false;
                document.getElementById('editdescriptionbtn').disabled = false;
                document.getElementById('editdescriptionbtn').value = array[2];
                alertify.log(array[1], 'error');
                document.getElementById('editdescription').style.borderColor = 'red';
             } else {
                document.getElementById('editdescription').disabled = false;
                document.getElementById('editdescriptionbtn').disabled = false;
                document.getElementById('editdescriptionbtn').value = array[2];
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}