apz.srvreq.maps = {};
apz.srvreq.maps.sCache = {};
apz.srvreq.maps.sToLocation = "";
apz.app.onLoad_Maps = function(params) {
    debugger;
    apz.srvreq.maps.sCache = params;
    var json = {
        "markerInfo": [{
            "locationLatitude": "13.0077104",
            "locationLongitude": "77.5497769",
            "locationName": "Malleshwaram",
            "locationDescription": "Malleshwaram Branch"
        }, {
            "locationLatitude": "12.9164569",
            "locationLongitude": "77.6305803",
            "locationName": "HSR Layout ",
            "locationDescription": "HSR Layout Branch"
        }, {
            "locationLatitude": "12.9292535",
            "locationLongitude": "77.5696024",
            "locationName": "Jayanagar",
            "locationDescription": "Jayanagar Branch"
        }, {
            "locationLatitude": "12.9324453",
            "locationLongitude": "77.6099222",
            "locationName": "Koramangala",
            "locationDescription": "Koramangala Branch"
        }]
    };
    for (i = 0; i < json.markerInfo.length; i++) {
        if (apz.srvreq.maps.sCache.branchName == json.markerInfo[i].locationName) {
            apz.srvreq.maps.sToLocation = json.markerInfo[i].locationLatitude + "," + json.markerInfo[i].locationLongitude
        }
    }
    var gps = {};
    gps.id = "GETLOCATION";
    gps.callBack = apz.srvreq.maps.fnGetLOcationCB;
    apz.ns.getLocation(gps);
};
apz.srvreq.maps.fnLocCallback = function(ljson) {
    debugger;
};
apz.srvreq.maps.fnGetLOcationCB = function(params) {
    apz.srvreq.maps.sClatitude = params.latitude;
    apz.srvreq.maps.sClongitude = params.longitude;
    apz.srvreq.maps.fnDrivingDirection();
};
apz.srvreq.maps.fnDrivingDirection = function() {
    var ljson = {
        "fromLocation": apz.srvreq.maps.sClatitude+","+apz.srvreq.maps.sClongitude,
        "toLocation": apz.srvreq.maps.sToLocation
    };
    ljson.id = "MAP2_ID";
    ljson.callBack = apz.srvreq.maps.fnLocCallback;
    apz.ns.drivingDirection(ljson);
}
