function updateActionForm(){
	var selected = document.getElementById('actiontype').value;
	if(selected!='lobbyLord'){
		document.getElementById('lobbyLord').style.display = 'none';
	} else {
		document.getElementById('lobbyLord').style.display = 'block';
	}
    if(selected!='lobbyMP'){
        document.getElementById('lobbyMP').style.display = 'none';
    } else {
        document.getElementById('lobbyMP').style.display = 'block';
    }
    if(selected!='lobbyMedia'){
        document.getElementById('lobbyMedia').style.display = 'none';
    } else {
        document.getElementById('lobbyMedia').style.display = 'block';
    }
    if(selected!='createPetition'){
        document.getElementById('createPetition').style.display = 'none';
    } else {
        document.getElementById('createPetition').style.display = 'block';
    }
    if(selected!='hostEvent'){
        document.getElementById('hostEvent').style.display = 'none';
    } else {
        document.getElementById('hostEvent').style.display = 'block';
    }
}

function addKnowledge(){
    	var error = false;
    	document.getElementById('fact').style.borderColor = '#999';
    	document.getElementById('sourceurl').style.borderColor = '#999';
    	document.getElementById('lobbylord_name').style.borderColor = '#999';
    	document.getElementById('lobbylord_address').style.borderColor = '#999';
    	document.getElementById('lobbylord_message').style.borderColor = '#999';
        document.getElementById('lobbymp_name').style.borderColor = '#999';
        document.getElementById('lobbymp_address').style.borderColor = '#999';
        document.getElementById('lobbymp_message').style.borderColor = '#999';
        document.getElementById('lobbymedia_name').style.borderColor = '#999';
        document.getElementById('lobbymedia_address').style.borderColor = '#999';
        document.getElementById('lobbymedia_message').style.borderColor = '#999';
        document.getElementById('createpetition_name').style.borderColor = '#999';
        document.getElementById('createpetition_description').style.borderColor = '#999';
        document.getElementById('hostevent_name').style.borderColor = '#999';
        document.getElementById('hostevent_url').style.borderColor = '#999';
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
        if(document.getElementById('actiontype').value=='lobbyLord'){
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
            var typelobby = 'lord';
            var data = 'cid=' + document.getElementById('causeid').value + '&fact=' + document.getElementById('fact').value + '&sourceurl=' + document.getElementById('sourceurl').value + '&actiontype=' + document.getElementById('actiontype').value + '&lobbylordname=' + document.getElementById('lobbylord_name').value + '&lobbylordaddress=' + document.getElementById('lobbylord_address').value + '&lobbylordmessage=' + document.getElementById('lobbylord_message').value;
        } else if(document.getElementById('actiontype').value=='lobbyMP'){
            if(document.getElementById('lobbymp_name').value==''){
                alertify.log('No MP name entered', 'error');
                document.getElementById('lobbymp_name').style.borderColor = 'red';
                error = true;
                return false;
            }
            if(document.getElementById('lobbymp_address').value==''){
                alertify.log('No MP email address entered', 'error');
                document.getElementById('lobbymp_address').style.borderColor = 'red';
                error = true;
                return false;
            }
            if(document.getElementById('lobbymp_message').value==''){
                alertify.log('No message to the MP entered', 'error');
                document.getElementById('lobbymp_message').style.borderColor = 'red';
                error = true;
                return false;
            }
            var typelobby = 'mp';
            var data = 'cid=' + document.getElementById('causeid').value + '&fact=' + document.getElementById('fact').value + '&sourceurl=' + document.getElementById('sourceurl').value + '&actiontype=' + document.getElementById('actiontype').value + '&lobbympname=' + document.getElementById('lobbymp_name').value + '&lobbympaddress=' + document.getElementById('lobbymp_address').value + '&lobbympmessage=' + document.getElementById('lobbymp_message').value;
        } else if(document.getElementById('actiontype').value=='lobbyMedia'){
            if(document.getElementById('lobbymedia_name').value==''){
                alertify.log('No Media outlet entered', 'error');
                document.getElementById('lobbymedia_name').style.borderColor = 'red';
                error = true;
                return false;
            }
            if(document.getElementById('lobbymedia_address').value==''){
                alertify.log('No Media email address entered', 'error');
                document.getElementById('lobbymedia_address').style.borderColor = 'red';
                error = true;
                return false;
            }
            if(document.getElementById('lobbymedia_message').value==''){
                alertify.log('No message to the Media entered', 'error');
                document.getElementById('lobbymedia_message').style.borderColor = 'red';
                error = true;
                return false;
            }
            var typelobby = 'media';
            var data = 'cid=' + document.getElementById('causeid').value + '&fact=' + document.getElementById('fact').value + '&sourceurl=' + document.getElementById('sourceurl').value + '&actiontype=' + document.getElementById('actiontype').value + '&lobbymedianame=' + document.getElementById('lobbymedia_name').value + '&lobbymediaaddress=' + document.getElementById('lobbymedia_address').value + '&lobbymediamessage=' + document.getElementById('lobbymedia_message').value;
        } else if(document.getElementById('actiontype').value=='createPetition'){
            if(document.getElementById('createpetition_name').value==''){
                alertify.log('No petition name entered', 'error');
                document.getElementById('createpetition_name').style.borderColor = 'red';
                error = true;
                return false;
            }
            if(document.getElementById('createpetition_description').value==''){
                alertify.log('No petition description entered', 'error');
                document.getElementById('createpetition_description').style.borderColor = 'red';
                error = true;
                return false;
            }
            var data = 'cid=' + document.getElementById('causeid').value + '&fact=' + document.getElementById('fact').value + '&sourceurl=' + document.getElementById('sourceurl').value + '&actiontype=' + document.getElementById('actiontype').value + '&petitionname=' + document.getElementById('createpetition_name').value + '&petitiondescription=' + document.getElementById('createpetition_description').value;
        } else if(document.getElementById('actiontype').value=='hostEvent'){
            if(document.getElementById('hostevent_name').value==''){
                alertify.log('No event name entered', 'error');
                document.getElementById('hostevent_name').style.borderColor = 'red';
                error = true;
                return false;
            }
            if(document.getElementById('hostevent_url').value==''){
                alertify.log('No event url entered', 'error');
                document.getElementById('hostevent_url').style.borderColor = 'red';
                error = true;
                return false;
            }
            var data = 'cid=' + document.getElementById('causeid').value + '&fact=' + document.getElementById('fact').value + '&sourceurl=' + document.getElementById('sourceurl').value + '&actiontype=' + document.getElementById('actiontype').value + '&eventname=' + document.getElementById('hostevent_name').value + '&eventurl=' + document.getElementById('hostevent_url').value;
        }
	       var actiontypeinput = document.getElementById('actiontype').value;
    	$.ajax({
        type  : 'POST',
         url  : '/scripts/processing/addknowledge_other.php',
         data : data,
         beforeSend : function() {
            if(actiontypeinput=='lobbyLord' || actiontypeinput=='lobbyMP' || actiontypeinput=='lobbyMedia'){
                document.getElementById('addknowledgebtn').disabled = true;
                document.getElementById('fact').disabled = true;
                document.getElementById('sourceurl').disabled = true;
                document.getElementById('lobby' + typelobby + '_name').disabled = true;
                document.getElementById('lobby' + typelobby + '_address').disabled = true;
                document.getElementById('lobby' + typelobby + '_message').disabled = true;
                document.getElementById('addknowledgebtn').value = 'Processing';
            } else if(actiontypeinput=='createPetition'){
                document.getElementById('addknowledgebtn').disabled = true;
                document.getElementById('fact').disabled = true;
                document.getElementById('sourceurl').disabled = true;
                document.getElementById('createpetition_name').disabled = true;
                document.getElementById('createpetition_description').disabled = true;
                document.getElementById('addknowledgebtn').value = 'Processing';
            } else if(actiontypeinput=='hostEvent'){
                document.getElementById('addknowledgebtn').disabled = true;
                document.getElementById('fact').disabled = true;
                document.getElementById('sourceurl').disabled = true;
                document.getElementById('hostevent_name').disabled = true;
                document.getElementById('hostevent_url').disabled = true;
                document.getElementById('addknowledgebtn').value = 'Processing';
            }
         },
         error : function() {
             if(actiontypeinput=='lobbyLord' || actiontypeinput=='lobbyMP' || actiontypeinput=='lobbyMedia'){
                document.getElementById('addknowledgebtn').disabled = false;
                document.getElementById('fact').disabled = false;
                document.getElementById('sourceurl').disabled = false;
                document.getElementById('lobby' + typelobby + '_name').disabled = false;
                document.getElementById('lobby' + typelobby + '_address').disabled = false;
                document.getElementById('lobby' + typelobby + '_message').disabled = false;
                document.getElementById('addknowledgebtn').value = 'Add';
            } else if(actiontypeinput=='createPetition'){
                document.getElementById('addknowledgebtn').disabled = false;
                document.getElementById('fact').disabled = false;
                document.getElementById('sourceurl').disabled = false;
                document.getElementById('createpetition_name').disabled = false;
                document.getElementById('createpetition_description').disabled = false;
                document.getElementById('addknowledgebtn').value = 'Add';
            } else if(actiontypeinput=='hostEvent') {
                document.getElementById('addknowledgebtn').disabled = false;
                document.getElementById('fact').disabled = false;
                document.getElementById('sourceurl').disabled = false;
                document.getElementById('hostevent_name').disabled = false;
                document.getElementById('hostevent_url').disabled = false;
                document.getElementById('addknowledgebtn').value = 'Add';
            }
             alertify.log('An error occured when attempting to proccess your request', 'error');
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
             	document.getElementById('addknowledgebtn').value = array[2];
   		        window.location.href = '/cause/' + array[1] + '/';
             } else if(array[0]=='2'){
                document.getElementById('fact').disabled = false;
	            document.getElementById('sourceurl').disabled = false;
	            document.getElementById('lobby' + typelobby + '_name').disabled = false;
	            document.getElementById('lobby' + typelobby + '_address').disabled = false;
	            document.getElementById('lobby' + typelobby + '_message').disabled = false;
                document.getElementById('createpetition_name').disabled = false;
                document.getElementById('createpetition_description').disabled = false;
                document.getElementById('hostevent_name').disabled = false;
                document.getElementById('hostevent_url').disabled = false;
                document.getElementById('addknowledgebtn').disabled = false;
                document.getElementById('addknowledgebtn').value = array[2];
           		alertify.log(array[1], 'error');
             } else {
	            document.getElementById('fact').disabled = false;
	            document.getElementById('sourceurl').disabled = false;
	            document.getElementById('lobby' + typelobby + '_name').disabled = false;
	            document.getElementById('lobby' + typelobby + '_address').disabled = false;
	            document.getElementById('lobby' + typelobby + '_message').disabled = false;
                document.getElementById('createpetition_name').disabled = false;
                document.getElementById('createpetition_description').disabled = false;
                document.getElementById('hostevent_name').disabled = false;
                document.getElementById('hostevent_url').disabled = false;
                document.getElementById('addknowledgebtn').disabled = false;
                document.getElementById('addknowledgebtn').value = array[2];
           		alertify.log(array[1], 'error');
             }
             return false;
         }
    	});
}