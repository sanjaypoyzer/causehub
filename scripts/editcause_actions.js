function updateActionForm(){
    var selected = document.getElementById('action_type').value;
	if(selected=='petition'){
		document.getElementById('action_text').value = 'Sign this Petition';
	} else if(selected=='event'){
        document.getElementById('action_text').value = 'Host an Event';
    } else {
        document.getElementById('action_text').value = '';
    }
}

function addAction(){
        document.getElementById('action_text').style.borderColor = '#999';
        document.getElementById('action_link').style.borderColor = '#999';
        action_type = document.getElementById('action_type');
        action_text = document.getElementById('action_text');
        action_link = document.getElementById('action_link');
        action_btn = document.getElementById('action_btn');
        if(action_text.value==''){
            alertify.log('No action text entered', 'error');
            action_text.style.borderColor = 'red';
            return false;
        }
        if(action_link.value==''){
            alertify.log('No action link entered', 'error');
            action_text.style.borderColor = 'red';
            return false;
        }
        
        var data = 'cid=' + document.getElementById('causeid').value + '&actiontype=' + document.getElementById('action_type').value + '&actiontext=' + document.getElementById('action_text').value + '&actionlink=' + document.getElementById('action_link').value;
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
                action_btn.value = 'Add Action';
                alertify.log('Added action point', 'success');
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