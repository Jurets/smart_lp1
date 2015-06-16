"use strict";
function run() {
	var image = document.getElementById('background');
	image.onload = function() {
		var engine = new RainyDay({
			image: this,
			blur: 10,
			opacity: 1,
			fps: 30
		});
		engine.gravity = engine.GRAVITY_NON_LINEAR;
		engine.trail = engine.TRAIL_DROPS;

		engine.rain([ [1, 2, 0.5], [3, 2, 1] ], 50);
	};
	image.crossOrigin = 'anonymous';
	image.src = 'img/header.jpg';
}
	
$(window).load(function(){
	run();
});		