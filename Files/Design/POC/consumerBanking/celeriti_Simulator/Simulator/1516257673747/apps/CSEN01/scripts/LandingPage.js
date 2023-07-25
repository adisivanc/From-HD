apz.CSEN01.LandingPage = {};
var applicationForm;
var pdf = false;
apz.CSEN01.LandingPage.sCache = {};
apz.CSEN01.LandingPage.sKYC = {};
apz.CSEN01.LandingPage.gAction = "";
/****** For report  *************/
apz.app.onLoad_LandingPage = function(params) {
    debugger;
    
  //  apz.CSEN01.LandingPage.sCache = params;
    apz.CSEN01.LandingPage.fnLaunch();
  //  $("body").css("background-image","url('apps/styles/themes/CustomerOnBoarding/img/loginblue.jpg')");
};



apz.CSEN01.LandingPage.fnLaunch = function(){
    var json = {};
    json.id = "NATIVE";
    json.callBack = apz.CSEN01.LandingPage.fnLaunchCallBack;
    apz.ns.nativeServiceExt(json);
}

apz.CSEN01.LandingPage.fnLaunchCallBack = function(params){
    
};

