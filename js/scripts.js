$ = jQuery
if(!console) console = {log:function(x){alert(x)}}

$(document).ready(function(){
	// Define breakpoints 
	$(window).setBreakpoints({
		distinct: true,
		breakpoints: [
			480,
			640,
			768,
			980,
			1200
		] 
	});
	
	// Bind events to breakpoint changes
	$(window).bind('enterBreakpoint480', function() {
		
	});
	$(window).bind('enterBreakpoint640', function() {
		
	});
	$(window).bind('enterBreakpoint768', function() {
		
	});
	$(window).bind('enterBreakpoint980', function() {
		
	});
	$(window).bind('enterBreakpoint1200',function() {
		
	});
	// Process hooks now
	$(window).applyBreakpoints();
	
	// Add fastclick
	FastClick.attach(document.body);
	
});


function pickOne(items) {
	return items[Math.round(Math.random()*(items.length-1))];
}
function shuffle(o){ //v1.0
	for(var j, x, i = o.length; i; j = Math.floor(Math.random() * i), x = o[--i], o[i] = o[j], o[j] = x);
	return o;
};
function shuffleFlexsliderSlides(jQueryParent, callback) {
	slides = shuffle($("ul.slides > li", jQueryParent))
	newSlides = ""
	if(slides.length>0) {
		for(var i=0;i<slides.length;i++) {
			var text = $(slides[i]).html()
			newSlides+="<li>"+text+"</li>"
		}
		$("ul.slides", jQueryParent).html(""); /* css("visibility", "hidden"). */
		$("ul.slides", jQueryParent).html(newSlides); 
	}
	if(callback) {
		callback(jQueryParent)
	}
}
