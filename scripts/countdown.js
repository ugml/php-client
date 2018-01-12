function timer(duration, containerClass, buildingID) {
    var timer = duration, hours, minutes, seconds;
    
    var countdown = function() {
	    // ugly solution
        var container = document.getElementsByClassName(containerClass)[0].querySelector('div');

		console.log(timer);

        hours = parseInt(timer / 3600, 10);
        minutes = parseInt(timer / 60, 10) - (60*hours);
        seconds = parseInt(timer % 60, 10);


        hours  = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        
        
        var page;
        if(buildingID > 100) {
        	page = "research";
        } else {
        	page = "buildings";
        }

        container.innerHTML = "<div class='row'><div class='col-md-12'>" + hours + ":" + minutes + ":" + seconds + "</div><div class='col-md-12'><a href=\"game.php?page="+page+"&cancel="+buildingID+"\">Cancel</a></div></div>";

        if (--timer <= 0) {
            container.textContent = "done";
            window.setTimeout(function(){
            	window.location.href = "game.php?page="+page;
            }, 2000);
    	}
	    setTimeout(countdown, 1000);
	};
	countdown();
}