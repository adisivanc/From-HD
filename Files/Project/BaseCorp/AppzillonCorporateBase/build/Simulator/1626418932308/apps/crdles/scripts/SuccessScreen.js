apz.crdles.SuccessScreen={};
apz.app.onLoad_SuccessScreen = function(params) {
    debugger;
    
    
};

apz.crdles.SuccessScreen.fnDone = function() {
   
    var params = {};
    params.appId = "crdles";
    params.scr = "CardlessCash";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
    
    if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    //apz.launchSubScreen(params);
    apz.launchApp(params);
   
}
