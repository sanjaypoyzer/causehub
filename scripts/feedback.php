<!-- Feedback Button -->
<style type="text/css">
div.feedback{
	position: fixed;
	top: calc(50% - 200px);
	right: calc(-250px + 1.6em);
	background: rgba(255, 255, 255, 0.8);
	border: solid 2px black;
	border-radius: 15px;
	width: 250px;
	padding: 1em;
	z-index: 999;
	-webkit-transition: 1s;
	-moz-transition: 1s;
	-o-transition: 1s;
	-ms-transition: 1s;
	transition: 1s;
}
div.feedback:hover{
	right:-50px;
}
div.feedback form{
	position: relative;
	width: 100%;
	left: 2em;
}
div.feedback h2{
	-webkit-transform:rotate(270deg);
	-moz-transform:rotate(270deg);
	-o-transform:rotate(270deg);
	-ms-transform:rotate(270deg);
	transform:rotate(270deg);
	position: absolute;
	left: -3.7em;
	top: 4em;
}
div.feedback form input, div.feedback form textarea{
	display: block;
	margin-bottom: 1em;
}
</style>
<div class="feedback">
	<form>
		<h2>Feedback?</h2>
		Name: <input type="text" id="feedbackname" name="feedbackname" />
		Email: <input type="text" id="feedbackemail" name="feedbackemail" />
		Message: <textarea rows="4" id="feedbackmsg" id="feedbackmsg"></textarea>
		<input type="submit" value="Submit Feedback" />
		<?php echo CAUSEHUB_VERSION; ?>
	</form>
</div>
<!-- /Feedback Button -->