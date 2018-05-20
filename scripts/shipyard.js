function timer(timeLeft, timeForOneUnit, totalTimeLeft, amount, unitName, page) {

    var countdown = function () {

        var hours = parseInt(timeLeft / 3600, 10);
        var minutes = parseInt(timeLeft / 60, 10) - (60 * hours);
        var seconds = parseInt(timeLeft % 60, 10);

        hours = hours < 10 ? "0" + hours : hours;
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        document.getElementById("shipyard_timeleft").innerText = hours + ":" + minutes + ":" + seconds;

        totalTimeLeft--;

        var totalHours = parseInt(totalTimeLeft / 3600, 10);
        var totalMinutes = parseInt(totalTimeLeft / 60, 10) - (60 * totalHours);
        var totalSeconds = parseInt(totalTimeLeft % 60, 10);

        totalHours = totalHours < 10 ? "0" + totalHours : totalHours;
        totalMinutes = totalMinutes < 10 ? "0" + totalMinutes : totalMinutes;
        totalSeconds = totalSeconds < 10 ? "0" + totalSeconds : totalSeconds;

        document.getElementById("shipyard_total_timeleft").innerText = totalHours + ":" + totalMinutes + ":" + totalSeconds;

        if (--timeLeft <= 0) {

            amount--;
            // restart timer ?
            if(amount > 0) {
                timeLeft = timeForOneUnit;

                document.getElementById("shipyard_queue").firstElementChild.innerHTML = amount + " " + unitName;
            } else {
                window.setTimeout(function () {
                    window.location.href ="game.php?page=" + page;
                }, 500);
            }
        }
        setTimeout(countdown, 1000);
    };
    countdown();
}