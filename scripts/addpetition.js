function addPetitionSig(){
        var pid = document.getElementById('pid');
        var fname = document.getElementById('fname');
        var lname = document.getElementById('lname');
        var email = document.getElementById('email');
        var addsignaturebtn = document.getElementById('addsignaturebtn');

        fname.style.borderColor = '#999';
        lname.style.borderColor = '#999';
        email.style.borderColor = '#999';
        if(fname.value==''){
            alertify.log('Please enter your first name', 'error');
            fname.style.borderColor = 'red';
            return false;
        }
        if(lname.value==''){
            alertify.log('Please enter your first name', 'error');
            lname.style.borderColor = 'red';
            return false;
        }
        if(email.value==''){
            alertify.log('Please enter your email', 'error');
            email.style.borderColor = 'red';
            return false;
        }

    var data = 'pid=' + pid.value + '&fname=' + fname.value + '&lname=' + lname.value + '&email=' + email.value;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/addpetition.php',
         data : data,
         beforeSend : function() {
             fname.disabled = true;
             lname.disabled = true;
             email.disabled = true;
             addsignaturebtn.disabled = true;
             addsignaturebtn.value = 'Adding';
         },
         error : function() {
             fname.disabled = false;
             lname.disabled = false;
             email.disabled = false;
             addsignaturebtn.disabled = false;
             addsignaturebtn.value = 'Add Signature';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                addsignaturebtn.value = array[2];
                fname.disabled = false;
                lname.disabled = false;
                email.disabled = false;
                fname.value = '';
                lname.value = '';
                email.value = '';
                addsignaturebtn.disabled = false;
                window.location.href = window.location.href;
             } else {
                fname.disabled = false;
                lname.disabled = false;
                email.disabled = false;
                addsignaturebtn.disabled = false;
                addsignaturebtn.value = array[2];
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}