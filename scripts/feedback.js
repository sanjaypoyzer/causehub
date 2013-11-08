function submitFeedback(){
        var feedbackname = document.getElementById('feedbackname');
        var feedbackemail = document.getElementById('feedbackemail');
        var feedbackmsg = document.getElementById('feedbackmsg');
        var feedbackbtn = document.getElementById('feedbackbtn');

        feedbackname.style.borderColor = '#999';
        feedbackemail.style.borderColor = '#999';
        feedbackmsg.style.borderColor = '#999';
        if(feedbackname.value==''){
            alertify.log('Please enter your name to submit feedback', 'error');
            feedbackname.style.borderColor = 'red';
            return false;
        }
        if(feedbackemail.value==''){
            alertify.log('Please enter your email to submit feedback', 'error');
            feedbackemail.style.borderColor = 'red';
            return false;
        }
        if(feedbackmsg.value==''){
            alertify.log('Please enter a message to submit feedback', 'error');
            feedbackmsg.style.borderColor = 'red';
            return false;
        }
    
    var data = 'name=' + feedbackname.value + '&email=' + feedbackemail.value + '&msg=' + feedbackmsg.value;
        $.ajax({
        type  : 'POST',
         url  : '/scripts/processing/feedback.php',
         data : data,
         beforeSend : function() {
             feedbackbtn.disabled = true;
             feedbackname.disabled = true;
             feedbackemail.disabled = true;
             feedbackmsg.disabled = true;
             feedbackbtn.value = 'Submitting';
         },
         error : function() {
             feedbackbtn.disabled = false;
             feedbackname.disabled = false;
             feedbackemail.disabled = false;
             feedbackmsg.disabled = false;
             feedbackbtn.value = 'Submit Feedback';
             alertify.log('Unable to submit feedback due to an unexpected error, please try again later', 'error');
             return false;
         },
         success : function (response) {
             var array = response.split(':');
             if(array[0]=='1'){
                feedbackbtn.value = 'Submitted';
                feedbackname.value = '';
                feedbackemail.value = '';
                feedbackmsg.value = '';
                feedbackname.disabled = false;
                feedbackemail.disabled = false;
                feedbackmsg.disabled = false;
                feedbackbtn.disabled = false;
                alertify.log('Thanks for your feedback!', 'success');
                setTimeout(function (){
                    feedbackbtn.value = 'Submit Feedback';
                }, 2000);
             } else {
                feedbackname.disabled = false;
                feedbackemail.disabled = false;
                feedbackmsg.disabled = false;
                feedbackbtn.disabled = false;
                feedbackbtn.value = 'Submit Feedback';
                alertify.log(array[1], 'error');
             }
             return false;
         }
        });
}