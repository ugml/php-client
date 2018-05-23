function calculateDistance(startGalaxy, startSystem, startPlanet) {
    var endGalaxy = document.getElementsByName("fleet_dest_galaxy")[0].value;
    var endSystem = document.getElementsByName("fleet_dest_system")[0].value;
    var endPlanet = document.getElementsByName("fleet_dest_planet")[0].value;

    var distance = 0;

    if(startGalaxy != endGalaxy) {
        distance += 20000 * Math.abs(startGalaxy - endGalaxy);
    }

    if(startGalaxy != endGalaxy) {
        distance += 2700 + 95 * Math.abs(startSystem - endSystem);
    }

    if(startPlanet != endPlanet) {
        distance += 1000 + 5 * Math.abs(startPlanet - endPlanet);
    }

    document.getElementById("distance").innerText = distance;

}