apz.onbaut.AuthLauncher = {};
apz.onbaut.AuthLauncher.sparams = {};
apz.onbaut.AuthLauncher.sCache = {};
apz.app.onLoad_AuthLauncher = function(params) {
    debugger;
    apz.onbaut.AuthLauncher.sparams = params;
     var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent)
    // if(isMobile){
    //   $("#soprab__Navigator__mobretrieverow").addClass("sno");
        
    // }
    $("#soprab__Navigator__mobretrieverow").addClass("sno");
    $("body").removeClass("loginbgg");
    apz.onbaut.AuthLauncher.fnNavigator("AuthDetails", params)
    
};
apz.onbaut.AuthLauncher.fnNavigator = function(src, params) {
    debugger;
    let lparams = {
        "appId": "onbaut",
        "scr": src,
        "div": "onbaut__AuthLauncher__authlauncer",
        "userObj": params
    };
    apz.launchSubScreen(lparams);
}
apz.onbaut.AuthLauncher.fnInitialiseSMS = function(mobileno, email) {
    apz.onbaut.AuthLauncher.sCache.mobno = mobileno;
    apz.onbaut.AuthLauncher.sCache.email = email;
    
    apz.onbaut.AuthLauncher.fnSendSMS();
};
apz.onbaut.AuthLauncher.fnSendSMS = function() {
    apz.onbaut.AuthLauncher.sCache.OTPCode = Math.floor(100000 + Math.random() * 900000);
   
    var lmessage = " Your OTP is " + apz.onbaut.AuthLauncher.sCache.OTPCode + " , use this OTP for registration.";
   
   
   
    if (apz.onbaut.AuthLauncher.sparams.action == "new") {
        apz.onbaut.AuthLauncher.fnNavigator("OTP", {
            "data": apz.onbaut.AuthLauncher.sCache.OTPCode,
            "email": apz.onbaut.AuthLauncher.sCache.email,
            "mobile": apz.onbaut.AuthLauncher.sCache.mobno,
            "action": apz.onbaut.AuthLauncher.sparams.action,
            product: apz.onbaut.AuthLauncher.sparams.product,
            subproduct: apz.onbaut.AuthLauncher.sparams.subproduct
        });
    } else {
        apz.onbaut.AuthLauncher.fnNavigator("OTP", {
            "data": apz.onbaut.AuthLauncher.sCache.OTPCode,
            "email": apz.onbaut.AuthLauncher.sCache.email,
            "mobile": apz.onbaut.AuthLauncher.sCache.mobno,
            "action": apz.onbaut.AuthLauncher.sparams.action
        });
    }
   
   
    var lServerParams = {
        "ifaceName": "sms",
        "buildReq": "N",
        "appId": "onbaut",
        "req": {
            "config": {
                user: "Iexceed",
                apikey: "XOTNwz3OffqcodOubdhl",
                mobile: apz.onbaut.AuthLauncher.sCache.mobno,
                message: lmessage,
                senderid: "APZBNK",
                type: "txt"
            }
        },
        "paintResp": "N",
        "async":true,
        "callBack": apz.onbaut.AuthLauncher.smsMessageCB
    };
    apz.server.callServer(lServerParams);
}
apz.onbaut.AuthLauncher.smsMessageCB = function(params) {
    debugger;
   
}
