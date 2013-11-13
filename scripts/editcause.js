function deleteCause(){    
    var data = 'causeid=' + document.getElementById('causeid').value + '&action=deletecause';
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/editcause.php',
         data : data,
         beforeSend : function() {
             document.getElementById('deletecausebtn').disabled = true;
             document.getElementById('deletecausebtn').value = 'Processing';
         },
         error : function() {
             document.getElementById('deletecausebtn').disabled = false;
             document.getElementById('deletecausebtn').value = 'Update';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                document.getElementById('deletecausebtn').value = 'Deleting';
                window.location.href = '/';
             } else {
                document.getElementById('deletecausebtn').disabled = false;
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}

function editCauseSlug(){
    	document.getElementById('editslug').style.borderColor = '#999';
    	if(document.getElementById('editslug').value==''){
    		alertify.log('No slug entered', 'error');
    		document.getElementById('editslug').style.borderColor = 'red';
    		return false;
    	}
	
	var data = 'causeid=' + document.getElementById('causeid').value + '&action=editslug&newslug=' + document.getElementById('editslug').value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/processing/editcause.php',
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
             } else {
                document.getElementById('editslug').disabled = false;
                document.getElementById('editslugbtn').disabled = false;
                document.getElementById('editslugbtn').value = array[2];
           		alertify.log(array[1], 'error');
                document.getElementById('editslug').style.borderColor = 'red';
             }
             return false;
         }
    	});
}

function editTags(){
        document.getElementById('causetags').style.borderColor = '#999';
    
    var data = 'causeid=' + document.getElementById('causeid').value + '&action=edittags&newtags=' + document.getElementById('causetags').value;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/editcause.php',
         data : data,
         beforeSend : function() {
             document.getElementById('edittagsbtn').disabled = true;
             document.getElementById('causetags').disabled = true;
             document.getElementById('edittagsbtn').value = 'Processing';
         },
         error : function() {
             document.getElementById('edittagsbtn').disabled = false;
             document.getElementById('causetags').disabled = false;
             document.getElementById('edittagsbtn').value = 'Update';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                document.getElementById('edittagsbtn').value = 'Update';
                document.getElementById('causetags').disabled = false;
                document.getElementById('edittagsbtn').disabled = false;
                alertify.log(array[1], 'success');
             } else {
                document.getElementById('edittagsbtn').value = 'Update';
                document.getElementById('causetags').disabled = false;
                document.getElementById('edittagsbtn').disabled = false;
                alertify.log(array[1], 'success');
                document.getElementById('causetags').style.borderColor = 'red';
             }
             return false;
         }
        });
}

function publish(sid){
    
    var data = 'action=publish&causeid=' + sid;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/editcause.php',
         data : data,
         beforeSend : function() {
             document.getElementById('publishbtn').disabled = true;
             document.getElementById('publishbtn').value = 'Publishing';
         },
         error : function() {
             document.getElementById('publishbtn').disabled = false;
             document.getElementById('publishbtn').value = 'Start changing the world!';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                document.getElementById('publishbtn').value = array[2];
                document.getElementById('publishbtn').disabled = false;
                window.location.href = '/cause/' + array[1] + '/';
             } else {
                document.getElementById('publishbtn').disabled = false;
                document.getElementById('publishbtn').value = array[2];
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}