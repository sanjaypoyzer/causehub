function addPetitionSig(){
        var error = false;
        document.getElementById('petitionfullname').style.borderColor = '#999';
        document.getElementById('petitionemail').style.borderColor = '#999';
        document.getElementById('petitionvoice').style.borderColor = '#999';
        if($('textarea').htmlarea('html')==''){
            alertify.log('No description entered', 'error');
            document.getElementById('editdescription').style.borderColor = 'red';
            error = true;
            return false;
        }
    
    var data = 'causeid=' + document.getElementById('causeid').value + '&action=editdescription&newdescription=' + $('textarea').htmlarea('html');
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