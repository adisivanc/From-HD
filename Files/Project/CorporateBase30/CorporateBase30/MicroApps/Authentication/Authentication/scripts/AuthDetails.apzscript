apz.onbaut.AuthDetails = {};
apz.onbaut.AuthDetails.sparams = {};
apz.onbaut.AuthDetails.sCache = {};
apz.app.onLoad_AuthDetails = function(params) {
    debugger;
    $("body").removeClass("loginbgg");
    apz.onbaut.AuthDetails.sparams = params;
    apz.onbaut.AuthDetails.fnInitialise(params);
};
apz.onbaut.AuthDetails.fnInitialise = function(params) {
    debugger;
};
apz.onbaut.AuthDetails.fnRequestOTP = function() {
    debugger;
    var mobilenumber = apz.getElmValue("onbaut__AuthDetails__mobileno");
    var email = apz.getElmValue("onbaut__AuthDetails__emailid");
    if (mobilenumber.length != 10) {
        apz.dispMsg({
            message: "Enter valid mobile number"
        });
    } else if (!/.*@\w+\.\w+$/.test(email)) {
        apz.dispMsg({
            message: "Enter valid EmailId"
        });
    } else {
        //functionality in AuthLauncher Screen
        apz.onbaut.AuthLauncher.fnInitialiseSMS(mobilenumber, email)
    }
}
apz.onbaut.AuthDetails.fnFloatMobileNo = function(el) {
    var digits = el.value.match(/\d{1,10}/) || [""];
    el.value = digits[0];
}
apz.onbaut.AuthDetails.fnBack = function() {
    //apz.prdsel.ProductLauncher.fnNavigate("SubProducts",{"product":products,"parentdiv":apz.prdsel.Products.sparams.parentdiv});
    var params = {};
    params.appId = "prdsel";
    params.scr = "SubProducts";
    params.div = "navgtr__Navigator__launchDiv";
    params.userObj = {
        "parentdiv": "navgtr__Navigator__launchDiv",
        "product": apz.onbaut.AuthDetails.sparams.product,
        "subproduct": apz.onbaut.AuthDetails.sparams.subproduct
    };
    apz.launchApp(params);
}
