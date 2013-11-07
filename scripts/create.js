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
    var causenameinput = document.getElementById('causename');
    var featuredlist = document.getElementById('featuredlist');
    var relatedlist = document.getElementById('relatedlist');
    var response = document.getElementById('response');
    $.ajaxSetup({
      global: false
    });
    var entered = causenameinput.value;
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
                featuredlist.style.display = 'block';
                relatedlist.style.display = 'none';
                return false;
             } else {
                featuredlist.style.display = 'none';
                relatedlist.style.display = 'block';
             }
             response.innerHTML = response;
             console.log('Updated Suggestions');
             return false;
         }
        });
    } else {
        featuredlist.style.display = 'block';
        relatedlist.style.display = 'none';
        response.innerHTML = '';
        console.log('Under 3 chars, not updating related list');
        return false;
    }
}