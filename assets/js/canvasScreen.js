$.fn.isOnScreen = function (cbTrue, cbFalse) {

    var win = $(window);

    var viewport = {
        top : win.scrollTop(),
        left : win.scrollLeft()
    };
    viewport.right = viewport.left + win.width();
    viewport.bottom = viewport.top + win.height();

    var bounds = this.offset();
    bounds.right = bounds.left + this.outerWidth();
    bounds.bottom = bounds.top + this.outerHeight();

    var isOnScreen = (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

    return isOnScreen
      ? cbTrue && cbTrue(viewport, bounds)
      : cbFalse && cbFalse(viewport, bounds);
};

function getOnScreen(){
	for(var i = 0; i < canvases.length; i++){
		$(canvases[i].element).isOnScreen(function(){
			canvases[i].running = true;
			if(canvases[i].wasRunning == false){
				canvases[i].wasRunning = true;
				canvases[i].update();
			}
		}, function(){
			canvases[i].running = false;
			canvases[i].wasRunning = false;
		});
	}
}

$(document).on('ready scroll resize',getOnScreen);