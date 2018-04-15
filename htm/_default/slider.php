$(function(){
	if(document.contains(document.controls))
	{
		var transition = 5000;
		var rad = document.controls.slider;
		var lab = document.getElementById('controls').getElementsByTagName('label');
		nextSlide();
		var sliding = setInterval('nextSlide()',transition);
		
		for(var i = 0; i < rad.length; i++) {
		
			rad[i].index = i;
			rad[i].onclick = function() {
				clearInterval(sliding);
				if(lab[this.index].className.indexOf("play") != -1) { 
					for(var j = 0; j < lab.length; j++)
						lab[j].className = lab[j].className.replace(' play','');
					nextSlide();
					sliding = setInterval('nextSlide()',transition);
				} else {
					for(var j = 0; j < lab.length; j++)
						lab[j].className = lab[j].className.replace(' play','');
					lab[this.index].className = lab[this.index].className + ' play';
					slideTo(this.index);
				}
			};
			
		}
		
		function slideTo(slide) {
			document.getElementById('slides').style.webkitTransform = 'translate(' + ((-100/rad.length)*slide) + '%,0)';
			for(var j = 0; j < lab.length; j++)
				 lab[j].className = lab[j].className.replace(' active','');
			lab[slide].className = lab[slide].className + ' active';
		}
		
		function nextSlide() {
			
			var active = 0;
			for(var i = 0; i < rad.length; i++) {
				if(rad[i].checked)
					active = i;
				rad[i].checked = false;
			}
			if(active==rad.length-1) active = -1;
			rad[active+1].checked = true;
			slideTo(active+1);
			
		}
		
	}
});
