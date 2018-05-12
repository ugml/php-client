function timer(page, duration, containerClass, buildingID, langCancel) {
    var timer = duration, hours, minutes, seconds;

    var countdown = function () {

        // console.log(page);

        var container;

        if (page === "overview") {
            container = document.getElementsByClassName(containerClass)[0];
        } else {
            container = document.getElementsByClassName(containerClass)[0].querySelector('div');
        }


        // console.log(timer);

        hours = parseInt(timer / 3600, 10);
        minutes = parseInt(timer / 60, 10) - (60 * hours);
        seconds = parseInt(timer % 60, 10);


        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;


        var pageLink;
        if (buildingID > 100) {
            pageLink = "research";
        } else {
            pageLink = "building";
        }

        if (page === "overview") {
            container.innerHTML = hours + ":" + minutes + ":" + seconds;
        } else {
            container.innerHTML = "<div class='row'><div class='col-md-12'>" + hours + ":" + minutes + ":" + seconds + "</div><div class='col-md-12'><a href=\"game.php?page=" + pageLink + "&cancel=" + buildingID + "\">" + langCancel + "</a></div></div>";
        }

        if (--timer <= 0) {
            container.textContent = "done";
            window.setTimeout(function () {
                window.location.href = "game.php?page=" + page;
            }, 2000);
        }
        setTimeout(countdown, 1000);
    };
    countdown();
}