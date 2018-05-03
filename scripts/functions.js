function cpChange(cpID) {

    var location = window.location.href.split("&")[0];

    // if there is a page set
    if(location.indexOf("?page=") !== -1) {
        location += "&cp=" + cpID;
    } else {
        // already a new cp set -> remove the old one
        if(location.indexOf("?cp=") !== -1) {
            location = location.split("?")[0];
        }
        location += "?cp=" + cpID;
    }

    // load the new page
    window.location = location;

}

function showGalaxyLegend() {
    console.log("IMPLEMENT ME!!!! showGalaxyLegend() @ function.js");
}