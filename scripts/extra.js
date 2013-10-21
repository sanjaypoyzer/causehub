$(document).ready(function() {
	NProgress.start();
	console.log('Nprogress > Document Ready');
});
$(window).load(function() {
	NProgress.done();
	console.log('Nprogress > Document Load');
});

$(document).ajaxStart(function() {
	NProgress.start();
	console.log('Nprogress > Ajax Start');
});
$(document).ajaxStop(function() {
	NProgress.done();
	console.log('Nprogress > Ajax Stop');
});