function submitFeedback(){
        var error = false;
        document.getElementById('feedbackname').style.borderColor = '#999';
        document.getElementById('feedbackemail').style.borderColor = '#999';
        document.getElementById('feedbackmsg').style.borderColor = '#999';
        if(document.getElementById('feedbackname').value==''){
            alertify.log('Please enter your name to submit feedback', 'error');
            document.getElementById('feedbackname').style.borderColor = 'red';
            error = true;
            return false;
        }
        if(document.getElementById('feedbackemail').value==''){
            alertify.log('Please enter your email to submit feedback', 'error');
            document.getElementById('feedbackemail').style.borderColor = 'red';
            error = true;
            return false;
        }
        if(document.getElementById('feedbackmsg').value==''){
            alertify.log('Please enter a message to submit feedback', 'error');
            document.getElementById('feedbackmsg').style.borderColor = 'red';
            error = true;
            return false;
        }
    
    var data = 'name=' + document.getElementById('feedbackname').value + '&email=' + document.getElementById('feedbackemail').value + '&msg=' + document.getElementById('feedbackmsg').value;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/feedback.php',
         data : data,
         beforeSend : function() {
             document.getElementById('feedbackbtn').disabled = true;
             document.getElementById('feedbackname').disabled = true;
             document.getElementById('feedbackemail').disabled = true;
             document.getElementById('feedbackmsg').disabled = true;
             document.getElementById('feedbackbtn').value = 'Submitting';
         },
         error : function() {
             document.getElementById('feedbackbtn').disabled = false;
             document.getElementById('feedbackname').disabled = false;
             document.getElementById('feedbackemail').disabled = false;
             document.getElementById('feedbackmsg').disabled = false;
             document.getElementById('feedbackbtn').value = 'Submit Feedback';
             alertify.log('Unable to submit feedback due to an unexpected error, please try again later', 'error');
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                document.getElementById('feedbackbtn').value = 'Submitted';
                document.getElementById('feedbackname').value = '';
                document.getElementById('feedbackemail').value = '';
                document.getElementById('feedbackmsg').value = '';
                document.getElementById('feedbackname').disabled = false;
                document.getElementById('feedbackemail').disabled = false;
                document.getElementById('feedbackmsg').disabled = false;
                document.getElementById('feedbackbtn').disabled = false;
                alertify.log('Thanks for your feedback!', 'success');
                setTimeout(function (){
                    document.getElementById('feedbackbtn').value = 'Submit Feedback';
                }, 2000);
             } else {
                document.getElementById('feedbackname').disabled = false;
                document.getElementById('feedbackemail').disabled = false;
                document.getElementById('feedbackmsg').disabled = false;
                document.getElementById('feedbackbtn').disabled = false;
                document.getElementById('feedbackbtn').value = 'Submit Feedback';
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}