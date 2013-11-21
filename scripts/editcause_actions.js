function updateActionForm(){
    var selected = document.getElementById('action_type').value;
	if(selected=='petition'){
		document.getElementById('action_text').value = 'Sign this Petition';
        document.getElementById('causehubmodules').style.display = 'block';
        document.getElementById('communitymodules').style.display = 'none';
	} else if(selected=='event'){
        document.getElementById('action_text').value = 'Host an Event';
        document.getElementById('causehubmodules').style.display = 'block';
        document.getElementById('communitymodules').style.display = 'none';
    } else if(selected=='other'){
        document.getElementById('action_text').value = '';
        document.getElementById('causehubmodules').style.display = 'block';
        document.getElementById('communitymodules').style.display = 'none';
    } else {
        document.getElementById('communitymodules').style.display = 'block';
        document.getElementById('causehubmodules').style.display = 'none';
        document.getElementById('communitymoduleform').action = '/modules/' + document.getElementById('action_type').value + '/scripts/edit_form.php';
        updateEditForm();
    }
}

function addAction(){
        causeid = document.getElementById('causeid');
        action_type = document.getElementById('action_type');
        action_text = document.getElementById('action_text');
        action_link = document.getElementById('action_link');
        action_btn = document.getElementById('action_btn');
        action_text.style.borderColor = '#999';
        action_link.style.borderColor = '#999';
        if(action_text.value==''){
            alertify.log('No action text entered', 'error');
            action_text.style.borderColor = 'red';
            return false;
        }
        if(action_link.value==''){
            alertify.log('No action link entered', 'error');
            action_link.style.borderColor = 'red';
            return false;
        }
        
        var data = 'cid=' + causeid.value + '&actiontype=' + action_type.value + '&actiontext=' + action_text.value + '&actionlink=' + action_link.value;

        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/addaction.php',
         data : data,
         beforeSend : function() {
            action_btn.disabled = true;
            action_type.disabled = true;
            action_text.disabled = true;
            action_link.disabled = true;
            action_btn.value = 'Processing';
         },
         error : function() {
            action_btn.disabled = false;
            action_type.disabled = false;
            action_text.disabled = false;
            action_link.disabled = false;
            action_btn.value = 'Add Action';
            alertify.log('An error occured when attempting to proccess your request, please try again later', 'error');
            return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                action_btn.disabled = false;
                action_type.disabled = false;
                action_text.disabled = false;
                action_link.disabled = false;
                action_text.value = '';
                action_link.value = '';
                action_btn.value = 'Add Action';
                alertify.log('Added action point', 'success');
                updateActionList();
             } else {
                action_btn.disabled = false;
                action_type.disabled = false;
                action_text.disabled = false;
                action_link.disabled = false;
                action_btn.value = 'Add Action';
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}

$("#communitymoduleform").submit(function(e){
    action_btn = document.getElementById('communitymodulesubmit');
    var postData = $(this).serializeArray();
    var formURL = $(this).attr("action");
    $.ajax(
    {
        url : formURL,
        type: "POST",
        data : postData,
        beforeSend: function() {
            action_btn.value = 'Processing';
        },
        error: function(jqXHR, textStatus, errorThrown) {
            alertify.log('An error occured when attempting to proccess your request, please try again later', 'error');    
            action_btn.value = 'Add Action';
        },
        success:function(data, textStatus, jqXHR) {
            var array = data.split(':');
            alertify.log(array[1], array[0]);
            action_btn.value = 'Add Action';
        },
    });
    e.preventDefault(); //STOP default action
});

function deleteAction(actionid){
    var causeid = document.getElementById('causeid');
    var data = 'cid=' + causeid.value + '&aid=' + actionid;
    $.ajax({
    type  : 'POST',
     url  : '/scripts/processing/deleteaction.php',
     data : data,
     beforeSend : function() {
         console.log('Deleting action');
     },
     error : function() {
         console.log('Error deleting action');
         return false;
     },
     success : function (response) {
         updateActionList();
         console.log('Deleted action');
         return false;
     }
    });
}

function updateActionList(){
    var causeid = document.getElementById('causeid');
    var data = 'cid=' + causeid.value;
    $.ajax({
    type  : 'POST',
     url  : '/scripts/processing/actionlist_edit.php',
     data : data,
     beforeSend : function() {
         console.log('Updating actions');
     },
     error : function() {
         console.log('Error updating actions');
         return false;
     },
     success : function (response) {
         document.getElementById('actionpointlist').innerHTML = response;
         console.log('Updated actions');
         return false;
     }
    });
}

function updateEditForm(){
    var causeid = document.getElementById('causeid');
    var moduleid = document.getElementById('action_type');
    var data = 'cid=' + causeid.value + '&mid=' + moduleid.value;
    $.ajax({
    type  : 'POST',
     url  : '/modules/display_edit_form.php',
     data : data,
     beforeSend : function() {
         document.getElementById('communitymodulefields').innerHTML = 'Loading...';
         console.log('Updating module edit form');
     },
     error : function() {
         document.getElementById('communitymodulefields').innerHTML = '';
         console.log('Error updating module edit form');
         return false;
     },
     success : function (response) {
         document.getElementById('communitymodulefields').innerHTML = response;
         console.log('Updated module edit form');
         return false;
     }
    });
}

function updateLobbyList(typeofreq){
    var causeid = document.getElementById('causeid');
    var causetags = document.getElementById('causetags');
    var data = 'cid=' + causeid.value + '&type=' + typeofreq + '&tags=' + causetags.value;
    $.ajax({
    type  : 'POST',
     url  : '/scripts/processing/lobbylist.php',
     data : data,
     beforeSend : function() {
         document.getElementById('lobbylist').innerHTML = '<button style="margin-bottom: 5px; width: 100%;">Loading...</button><br><button style="margin-bottom: 5px; width: 100%;">Loading...</button><br><button style="margin-bottom: 5px; width: 100%;">Loading...</button><br><button style="margin-bottom: 5px; width: 100%;">Loading...</button><br><button style="margin-bottom: 5px; width: 100%;">Loading...</button>';
         console.log('Updating lobby list');
     },
     error : function() {
         console.log('Error updating lobby list');
         return false;
     },
     success : function (response) {
         document.getElementById('lobbylist').innerHTML = response;
         console.log('Updated lobby list');
         return false;
     }
    });
}