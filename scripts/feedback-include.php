<!-- Feedback Button -->
<div class="feedback">
	<form id='feedbackform' method='post' action='#' onsubmit="return false;">
		<h2>Feedback?</h2>
		Name: <input type="text" id="feedbackname" name="feedbackname" />
		Email: <input type="text" id="feedbackemail" name="feedbackemail" />
		Message: <textarea rows="4" id="feedbackmsg" id="feedbackmsg"></textarea>
		<input type="submit" id="feedbackbtn" value="Submit Feedback" onclick='submitFeedback(); return false;' />
		<span>Version: <?php echo CAUSEHUB_VERSION; ?></span>
	</form>
</div>
<script src="/scripts/feedback.js"></script>
<!-- /Feedback Button -->