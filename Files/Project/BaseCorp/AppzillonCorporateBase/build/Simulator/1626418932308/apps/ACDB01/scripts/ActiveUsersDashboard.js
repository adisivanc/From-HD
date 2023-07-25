apz.ACDB01.ActiveUsersDashboard = {};
var mapLoaded = false;
var mapDetails;
var markersArray = [];
var mapDetailsMap = new Map();
apz.app.onLoad_ActiveUsersDashboard = function(params) {
    $("#ACDB01__ActiveUsersDashboard__mapCol").css("height", "300px");
    var filePath = apz.getDataFilesPath("ACDB01") + "/DashboardActiveUsers.json";
    var content = apz.getFile(filePath);
    content = JSON.parse(content);
    // apz.data.appendData(content);
    apz.data.scrdata.ACDB01__appzillonDashBoard_Res = content;
    mapDetails = content.appzillonDashBoardResponse.locationDetails;
    apz.data.loadData("appzillonDashBoard", "ACDB01");
    if (!mapLoaded) {
        apz.ACDB01.ActiveUsersDashboard.loadMap();
    } else {
        initMap();
    }
    apz.ACDB01.ActiveUsersDashboard.searchDashboardDetails();
};
apz.ACDB01.ActiveUsersDashboard.loadMap = function() {
    $('body').append('<script src="https://maps.googleapis.com/maps/api/js?key=' + apz.googleMapsKey +
        '&libraries=places&callback=initMap" async defer></script>');
    mapLoaded = true;
};

function initMap() {
    debugger;
    var val = $("input[name='ACDB01__ActiveUsersDashboard__mapThemesRadio_']:checked").val();
    var mapStyles = [];
    if (val == 're') {
        mapStyles = retroStyle;
    } else if (val == 'au') {
        mapStyles = AubergineStyle;
    }
    map = new google.maps.Map(document.getElementById('ACDB01__ActiveUsersDashboard__mapCol'), {
        center: new google.maps.LatLng(12.9716, 77.5946),
        zoom: 3,
        minZoom: 2,
        styles: mapStyles
    });
    google.maps.event.addListenerOnce(map, 'idle', function() {
        callback('country');
    });
    map.addListener('zoom_changed', function() {
        apz.ACDB01.ActiveUsersDashboard.mapZoomChanged(map.getZoom());
    });
    initMapBool = true;
};
apz.ACDB01.ActiveUsersDashboard.mapZoomChanged = function(zoom) {
    apz.ACDB01.ActiveUsersDashboard.clearMarkers();
    if (zoom < 4) {
        callback('country');
    } else if (zoom >= 4 && zoom < 8) {
        callback('admin_area_lvl_1');
    } else if (zoom >= 8 && zoom < 12) {
        callback('admin_area_lvl_2');
    } else if (zoom >= 12 && zoom < 16) {
        callback('sublocality');
    } else if (zoom >= 16) {
        apz.ACDB01.ActiveUsersDashboard.drawAllMarkers();
    }
};

function callback(arg) {
    var result = apz.ACDB01.ActiveUsersDashboard.getGroupDetails(arg);
    for (var l = 0; l < result.length; l++) {
        apz.ACDB01.ActiveUsersDashboard.getMidPoint(result[l]);
    }
    for (var m = 0; m < result.length; m++) {
        var type = result[m].type;
        var key = '';
        if (type == "country") {
            key = result[m].country;
        } else if (type == 'admin_area_lvl_1') {
            key = result[m].admin_area_lvl_1 + " " + result[m].country;
        } else if (type == 'admin_area_lvl_2') {
            key = result[m].admin_area_lvl_2 + " " + result[m].admin_area_lvl_1 + " " + result[m].country;
        } else if (type == 'sublocality') {
            key = result[m].sublocality + " " + result[m].admin_area_lvl_2 + " " + result[m].admin_area_lvl_1 + " " + result[m].country;
        }
        try {
            var MapDetails = mapDetailsMap.get(key);
            MapDetails.title = result[m][type];
            MapDetails.count = result[m].count.toString();
            createMarker(MapDetails);
        } catch (e) {
            console.log("Google Geo coding API failed to get the MidPoint,Test the Google Maps API key provided.");
        }
    }
}
apz.ACDB01.ActiveUsersDashboard.drawAllMarkers = function() {
    for (var z = 0; z < mapDetails.length; z++) {
        createIndividualMarker(mapDetails[z]);
    }
};
apz.ACDB01.ActiveUsersDashboard.getGroupDetails = function(arg) {
    debugger;
    var argArr = [];
    var resultArr = [];
    for (var z = 0; z < mapDetails.length; z++) {
        if (!apz.isNull(mapDetails[z][arg])) {
            if (argArr.indexOf(mapDetails[z][arg]) == -1) {
                argArr.push(mapDetails[z][arg]);
                resultArr[resultArr.length] = {};
                resultArr[resultArr.length - 1].count = 1;
                resultArr[resultArr.length - 1].type = arg;
                $.extend(resultArr[resultArr.length - 1], mapDetails[z]);
            } else {
                resultArr[argArr.indexOf(mapDetails[z][arg])].count = parseInt(resultArr[argArr.indexOf(mapDetails[z][arg])].count) + 1;
            }
        }
    }
    return resultArr;
};
apz.ACDB01.ActiveUsersDashboard.getMidPoint = function(argObj) {
    var address = '';
    if (argObj.type == "country") {
        address = argObj.country;
    } else if (argObj.type == "admin_area_lvl_1") {
        address = argObj.admin_area_lvl_1 + " " + argObj.country;
    } else if (argObj.type == 'admin_area_lvl_2') {
        address = argObj.admin_area_lvl_2 + " " + argObj.admin_area_lvl_1 + " " + argObj.country;
    } else if (argObj.type == 'sublocality') {
        address = argObj.sublocality + " " + argObj.admin_area_lvl_2 + " " + argObj.admin_area_lvl_1 + " " + argObj.country;
    }
    if (apz.isNull(mapDetailsMap.get(address))) {
        // apz.startLoader();
        var request = {};
        request.address = address;
        request.key = apz.googleMapsKey;
        // var params = {};
        // params.callBackObj = "";
        // params.buildReq = 'N';
        // params.paintResp = 'N';
        // params.req = request;
        // params.ifaceName = 'GeoCoding';
        // params.async = false;
        // params.callBack = apz.ACDB01.ActiveUsersDashboard.getMidPointCB;
        // apz.server.callServer(params);
        mapDetailsMap.set(request.address, {
            "lng": argObj.longitude,
            "lat": argObj.latitude
        });
    }
};
apz.ACDB01.ActiveUsersDashboard.getMidPointCB = function(params) {
    apz.stopLoader();
    if (params.status) {
        if (!apz.isNull(params.errors)) {
            if (params.errors[0].errorCode[0] !== "$") {
                var msg = {
                    "code": params.errors[0].errorCode
                }
                apz.dispMsg(msg);
            }
        } else {
            if (params.res[apz.currAppId + '__GeoCoding_Res'].status == "OK") {
                mapDetailsMap.set(params.req.address, params.res[apz.currAppId + '__GeoCoding_Res'].results[0].geometry.location);
            } else {
                console.log(params.res.status);
            }
        }
    } else {
        msg = {
            "code": 'APZ-SVR-ERR'
        };
        apz.dispMsg(msg);
    }
};

function createMarker(params) {
    var myLatLng = {
        lat: parseFloat(params.lat),
        lng: parseFloat(params.lng)
    };
    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: params.title,
        label: {
            text: params.count,
            color: '#6a6a6a',
            fontSize: "16px",
            fontWeight: "bold"
        },
        icon: {
            path: google.maps.SymbolPath.CIRCLE,
            scale: 25,
            fillColor: "#ffffff",
            fillOpacity: 0.8,
            strokeColor: "#6c6c6c",
            strokeOpacity: 0.7,
            strokeWeight: 3
        },
        animation: google.maps.Animation.DROP,
        draggable: true
    });
    markersArray.push(marker);
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent('<p><b>Place:</b></p><p>' + this.title + '</p><br><p><b>Count:</b></p><p>' + this.label.text);
        infowindow.open(map, this);
    });
}

function createIndividualMarker(params) {
    var myLatLng = {
        lat: parseFloat(params.latitude),
        lng: parseFloat(params.longitude)
    };
    var marker = new google.maps.Marker({
        map: map,
        position: myLatLng,
        title: params.formattedAddress,
        animation: google.maps.Animation.DROP,
        draggable: true
    });
    markersArray.push(marker);
    var infowindow = new google.maps.InfoWindow();
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.setContent('<p>' + this.title + '</p>');
        infowindow.open(map, this);
    });
}
apz.ACDB01.ActiveUsersDashboard.clearMarkers = function() {
    for (var k = 0; k < markersArray.length; k++) {
        markersArray[k].setMap(null);
    }
    markersArray = [];
};
apz.ACDB01.ActiveUsersDashboard.changeMapTheme = function(obj, event) {
    var val = $("input[name='ACDB01__ActiveUsersDashboard__mapThemesRadio_']:checked").val();
    if (val == 'st') {
        map.setOptions({
            "styles": "[]"
        });
    } else if (val == 're') {
        map.setOptions({
            "styles": retroStyle
        });
    } else if (val == 'au') {
        map.setOptions({
            "styles": AubergineStyle
        });
    }
};
apz.ACDB01.ActiveUsersDashboard.searchDashboardDetails = function() {
    var filePath = apz.getDataFilesPath("ACDB01") + "/DashboardDetailsUsers.json";
    var content = apz.getFile(filePath);
    content = JSON.parse(content);
    var usersArray = [];
    var i = 0;
    for (var k = 0; k < content.appzillonDashBoardResponse.activeInactiveUsers.length; k++) {
        usersArray[i] = {};
        usersArray[i].date = content.appzillonDashBoardResponse.activeInactiveUsers[k].date;
        usersArray[i].count = content.appzillonDashBoardResponse.activeInactiveUsers[k].activeCount;
        i++;
    }
    apz.show("ACDB01__ActiveUsersDashboard__DetailsUsersTable");
    apz.data.scrdata.ACDB01__DashboardDummy_Res = {};
    apz.data.scrdata.ACDB01__DashboardDummy_Res.userLogins = usersArray;
    apz.data.loadData('DashboardDummy','ACDB01');
};
apz.ACDB01.ActiveUsersDashboard.dashboardStDateChange = function(obj, event) {
    var selectedDate = apz.getObjValue(obj);
    for (var date of apz.scrMetaData.uiInits.date) {
        if (date[0] == "ACDB01__ActiveUsersDashboard__dashboardEnDate") {
            var params = {};
            params.id = date[0];
            params.dataType = date[1];
            params.lookAndFeel = date[2];
            params.parentDisplay = date[3];
            params.style = date[4];
            params.parentPreset = date[5];
            params.parentMinDate = selectedDate;
            params.parentMaxDate = date[7];
            params.closeOnSel = date[8];
            params.multiSel = date[9];
            params.parentStartYear = date[10];
            params.parentEndYear = date[11];
            params.parentRangePick = date[12];
            apz.initDates(params);
        }
    }
};
apz.ACDB01.ActiveUsersDashboard.dashboardEnDateChange = function(obj, event) {
    var selectedDate = apz.getObjValue(obj);
    for (var date of apz.scrMetaData.uiInits.date) {
        if (date[0] == "ACDB01__ActiveUsersDashboard__dashboardStDate") {
            var params = {};
            params.id = date[0];
            params.dataType = date[1];
            params.lookAndFeel = date[2];
            params.parentDisplay = date[3];
            params.style = date[4];
            params.parentPreset = date[5];
            params.parentMinDate = date[6];
            params.parentMaxDate = selectedDate;
            params.closeOnSel = date[8];
            params.multiSel = date[9];
            params.parentStartYear = date[10];
            params.parentEndYear = date[11];
            params.parentRangePick = date[12];
            apz.initDates(params);
        }
    }
};
apz.app.updateChartBeforeRender = function(chartType, chartData, id, chart) {
    debugger;
    if (id == "ACDB01__ActiveUsersDashboard__userLoginChart") {
        for (var k = 0; k < chartData.data.length; k++) {
            var splittedDate = chartData.data[k].label.split("/");
            chartData.data[k].label = splittedDate[0] + "/" + splittedDate[1];
        }
    }
};
