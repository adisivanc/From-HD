//declaration
apz.promtn.Recommendation = {};
apz.promtn.Recommendation.sCache = {};
//on load functon
apz.app.onLoad_Recommendation = function(params) {}
apz.promtn.Recommendation.bookAppointment = function() {
    var lLaunchParams = {
        "appId": "",
        "scr": "",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "data": {
                "customerID": "1653",
                "name": "John Doe",
                "mobileNumber": "9177157181",
                "emailId": "john.doe@gmail.com",
                "dateOfBirth": "09/18/1987"
            }
        }
    };
    lLaunchParams.appId = "srvreq";
    lLaunchParams.scr = "SelectService";
    lLaunchParams.userObj.Navigation = {
        "setNavigation": apz.csmrbk.landingpage.fnSetNavigation
    }
    apz.launchApp(lLaunchParams);
}