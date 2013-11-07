function createcause(){
        var causenameinput = document.getElementById('causename');
        var causecreatebtn = document.getElementById('causecreatebtn');
    	causenameinput.style.borderColor = '#999';
    	if(causenameinput.value==''){
    		alertify.log('No cause name entered', 'error');
    		causenameinput.style.borderColor = 'red';
    		return false;
    	}
	
	var data = 'causename=' + causenameinput.value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/processing/create.php',
         data : data,
         beforeSend : function() {
             causecreatebtn.disabled = true;
             causenameinput.disabled = true;
             causecreatebtn.value = 'Creating';
         },
         error : function() {
             causecreatebtn.disabled = false;
             causenameinput.disabled = false;
             causecreatebtn.value = 'Create';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	causecreatebtn.value = array[2];
   		        window.location.href = '/editcause/' + array[1] + '/';
             } else if(array[0]=='2'){
                causenameinput.disabled = false;
                causecreatebtn.disabled = false;
                causecreatebtn.value = array[2];
           		alertify.log(array[1], 'error');
           		causenameinput.style.borderColor = 'red';
             } else {
                causenameinput.disabled = false;
                causecreatebtn.disabled = false;
                causecreatebtn.value = array[2];
           		alertify.log(array[1], 'error');
             }
             return false;
         }
    	});
}

function updateSuggestions(){
    $.ajaxSetup({
      global: false
    });
    var entered = document.getElementById('causename').value;
    if(entered.length>=3){
        var data = 'entered=' + entered;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/updatesuggestions.php',
         data : data,
         beforeSend : function() {
             console.log('Updating Suggestions');
         },
         error : function() {
             console.log('Error updating suggestions');
             return false;
         },
         success : function (response) {
             if(response==''){
                document.getElementById('featuredlist').style.display = 'block';
                document.getElementById('relatedlist').style.display = 'none';
             } else {
                document.getElementById('featuredlist').style.display = 'none';
                document.getElementById('relatedlist').style.display = 'block';
             }
             document.getElementById('response').innerHTML = response;
             console.log('Updated Suggestions');
             return false;
         }
        });
    } else {
        document.getElementById('featuredlist').style.display = 'block';
        document.getElementById('relatedlist').style.display = 'none';
        document.getElementById('response').innerHTML = '';
        console.log('Under 3 chars, exiting updateSuggestions function');
    }
}