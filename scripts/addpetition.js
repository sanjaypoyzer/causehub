function addPetitionSig(){
        var error = false;
        document.getElementById('fname').style.borderColor = '#999';
        document.getElementById('lname').style.borderColor = '#999';
        document.getElementById('email').style.borderColor = '#999';
        if(document.getElementById('fname').value==''){
            alertify.log('Please enter your first name', 'error');
            document.getElementById('fname').style.borderColor = 'red';
            error = true;
            return false;
        }
        if(document.getElementById('lname').value==''){
            alertify.log('Please enter your first name', 'error');
            document.getElementById('lname').style.borderColor = 'red';
            error = true;
            return false;
        }
        if(document.getElementById('email').value==''){
            alertify.log('Please enter your email', 'error');
            document.getElementById('email').style.borderColor = 'red';
            error = true;
            return false;
        }

    var data = 'pid=' + document.getElementById('pid').value + '&fname=' + document.getElementById('fname').value + '&lname=' + document.getElementById('lname').value + '&email=' + document.getElementById('email').value;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/addpetition.php',
         data : data,
         beforeSend : function() {
             document.getElementById('fname').disabled = true;
             document.getElementById('lname').disabled = true;
             document.getElementById('email').disabled = true;
             document.getElementById('addsignaturebtn').disabled = true;
             document.getElementById('addsignaturebtn').value = 'Adding';
         },
         error : function() {
             document.getElementById('fname').disabled = false;
             document.getElementById('lname').disabled = false;
             document.getElementById('email').disabled = false;
             document.getElementById('addsignaturebtn').disabled = false;
             document.getElementById('addsignaturebtn').value = 'Add Signature';
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                document.getElementById('addsignaturebtn').value = array[2];
                document.getElementById('fname').disabled = false;
                document.getElementById('lname').disabled = false;
                document.getElementById('email').disabled = false;
                document.getElementById('fname').value = '';
                document.getElementById('lname').value = '';
                document.getElementById('email').value = '';
                document.getElementById('addsignaturebtn').disabled = false;
                
                window.location.href=window.location.href;
             } else {
                document.getElementById('fname').disabled = false;
                document.getElementById('lname').disabled = false;
                document.getElementById('email').disabled = false;
                document.getElementById('addsignaturebtn').disabled = false;
                document.getElementById('addsignaturebtn').value = array[2];
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}