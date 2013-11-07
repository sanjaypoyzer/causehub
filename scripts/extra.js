$(document).ready(function() {
	NProgress.start();
	console.log('Nprogress > Document Ready');
});
$(window).load(function() {
	NProgress.done();
	console.log('Nprogress > Document Load');
	window.scroll(0,0);
});

$(document).ajaxStart(function() {
	NProgress.start();
	console.log('Nprogress > Ajax Start');
});
$(document).ajaxStop(function() {
	NProgress.done();
	console.log('Nprogress > Ajax Stop');
});
function changeFavicon(src) {
 var link = document.createElement('link'),
     oldLink = document.getElementById('dynamic-favicon');
 link.id = 'dynamic-favicon';
 link.rel = 'shortcut icon';
 link.href = src;
 if (oldLink) {
  document.head.removeChild(oldLink);
 }
 document.head.appendChild(link);
}
changeFavicon('http://www.iconj.com/ico/4/q/4qchpnn7ci.ico');