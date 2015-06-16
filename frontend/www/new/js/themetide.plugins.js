

//Count numbers
(function($){
	$.fn.countUp=function(k){
	var m=parseInt($(this).text(),10),l,o=$(this);
	function n(){m++;o.text(m.toString());l=setTimeout(n,k)}l=setTimeout(n,k)};
})(jQuery);