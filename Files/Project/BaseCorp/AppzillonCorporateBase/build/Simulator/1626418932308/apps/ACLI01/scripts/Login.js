apz.Login = {};
apz.Login.sUser = "";
apz.Login.sUserId = "";
apz.Login.sCorporateId = "";
apz.Login.sRoleId = "";
apz.Login.sUserName = "";
apz.app.onLoad_Login = function(params) {
    debugger;
   
    apz.setElmValue("ACLI01__Login__CorporateId", "ACMECORP");
    //apz.setElmValue("ACLI01__Login__CorporateId", "PETRONAS GROUP");
    apz.setElmValue("ACLI01__Login__UserName", "robert.langford");
    apz.setElmValue("ACLI01__Login__Password", "Password@1");
    $(".line").remove();
    $(".lineR").remove();
     var appLng = params.language?params.language:null;
     //if(appLng == "ar"){
     if(appLng == "al"){
         //$("body").addClass("arabic");
         $("#ACLI01__Login__el_txt_8").removeClass("current");
        $("#ACLI01__Login__el_txt_9").addClass("current");
     }
     
     else{
        //$("body").removeClass("arabic");
        $("#ACLI01__Login__el_txt_9").removeClass("current");
        $("#ACLI01__Login__el_txt_8").addClass("current");
     }
     
     apz.Login.fnGenerateCaptcha();
     
};
apz.app.onShown_Login = function() {
    document.getElementById("ACLI01__Login__CorporateId").focus();
    constructKeyboard();
};

apz.Login.fnGenerateCaptcha = function(){
debugger;
document.getElementById('ACLI01__Login__colcaptcha').innerHTML = "";
   var charsArray =
   "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ@!#$%^&*";
   var lengthOtp = 6;
   var captcha = [];
   for (var i = 0; i < lengthOtp; i++) {
     //below code will not allow Repetition of Characters
     var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
     if (captcha.indexOf(charsArray[index]) == -1)
       captcha.push(charsArray[index]);
     else i--;
   }
   var canv = document.createElement("canvas");
   canv.id = "captcha";
   canv.width = 100;
   canv.height = 50;
   var ctx = canv.getContext("2d");
   ctx.font = "25px Georgia";
   ctx.strokeText(captcha.join(""), 0, 30);
   //storing captcha so that can validate you can save it somewhere else according to your specific requirements
  apz.Login.code = captcha.join("");
   document.getElementById("ACLI01__Login__colcaptcha").appendChild(canv); // adds the canvas to the body element
}
apz.Login.fnAudioCaptcha = function() {
    if ('speechSynthesis' in window) {
        var msg = new SpeechSynthesisUtterance();
        msg.rate = 1;
        msg.text = apz.Login.code;
        window.speechSynthesis.speak(msg);
    } else {
        //alert("Sorry, your browser doesn't support text to speech")
    }
}
apz.Login.submitLogin = function() {
    apz.Login.sUser = $("#ACLI01__Login__UserName").val().toLowerCase();
    var lCorpID = apz.getElmValue("ACLI01__Login__CorporateId");
    if (lCorpID == "ACMECORP" || lCorpID == "ACME Pharma" || lCorpID == "ACME Food Processing" || lCorpID == "ACME Cosmetics" || lCorpID == "ACME Beverages" || lCorpID == "ACME Diary Products" || lCorpID == "PETRONASGROUP") {
        lCorpID = "000FTAC4321";
    }
    
    // if (lCorpID == "PETRONAS GROUP" || lCorpID == "PETRONAS GAS" || lCorpID == "PETRONAS CHEMICALS" || lCorpID == "PETRONAS CH KL" || lCorpID == "PETRONAS CH JB"  || lCorpID == "PETRONASGROUP") {
    //     lCorpID = "000FTAC4321";
    // }
    var userId = lCorpID + "__" + apz.getElmValue("ACLI01__Login__UserName").toLowerCase();
    var password = apz.getElmValue("ACLI01__Login__Password");
    var captcha = apz.getElmValue("ACLI01__Login__inpcaptcha");
    if (apz.isNull(userId) || apz.isNull(password)) {
        var params = {
            'code': 'APZ-LOG-ERR'
        };
        apz.dispMsg(params);
    } 
     else if( apz.deviceGroup != "Mobile" && captcha !=apz.Login.code){
        var params = {
            'message': 'Invalid captcha'
        };
        apz.dispMsg(params);
    }
    
    else {
        debugger;
        var req = {};
        req.userId = userId;
       //req.userId = "123456";
        req.pwd = password;
        req.scrsAccessType = 'A';
        req.ifacesAccessType = 'A';
        req.controlsAccessType = 'A';
        req.callBack = apz.Login.loginCB;
        apz.server.login(req);
    }
};
apz.Login.loginCB = function(params) {
    debugger;
    if (params.status) {
        var status = params.resFull.appzillonHeader.status;
        if (status) {
            if (apz.mockServer) {
                if (apz.Login.sUser == "CorpAdmin") {
                    apz.Login.sUserId = "CorpAdmin";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "admin"
                } else if (apz.Login.sUser == "CorpUser") {
                    apz.Login.sUserId = "CorpUser";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "Corpuser"
                } else if (apz.Login.sUser == "CorpUser2") {
                    apz.Login.sUserId = "CorpUser2";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "Corpuser"
                } else if (apz.Login.sUser == "bernard.wilkes") {
                    apz.Login.sUserId = "bernard.wilkes";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "Admin"
                } else if (apz.Login.sUser == "robert.langford") {
                    apz.Login.sUserId = "robert.langford";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "SeniorManagement"
                } else if (apz.Login.sUser == "abdul.hamid") {
                    apz.Login.sUserId = "abdul.hamid";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "Admin"
                } else if (apz.Login.sUser == "mohammad.nawaz") {
                    apz.Login.sUserId = "mohammad.nawaz";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "SeniorManagement"
                }
                else if (apz.Login.sUser == "patrick.wilson") {
                    apz.Login.sUserId = "patrick.wilson";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "SeniorManagementA"
                }
                
                else if (apz.Login.sUser == "mike.smith") {
                    apz.Login.sUserId = "mike.smith";
                    apz.Login.sCorporateId = "000FTAC4321"
                    apz.Login.sRoleId = "CashMgmt-input"
                }
            } else {
                var luserDetails = params.res.loginResponse.userDet;
                apz.Login.sUserId = params.res.loginResponse.userDet.id.split("__")[1];
                apz.Login.sCorporateId = params.res.loginResponse.userDet.id.split("__")[0];
                apz.Login.sRoleId = params.res.loginResponse.userDet.privs.roles[0].split("__")[1];
                apz.Login.sUserName = params.res.loginResponse.userDet.name;
            }
            var params = {};
            /*params.appId = "ACNR01";
            params.scr = "Navigator";
            params.layout = "Web";
            params.userObj = {
                "userId": apz.Login.sUserId,
                "roleId": apz.Login.sRoleId,
                "corporateId": apz.Login.sCorporateId
            };*/
            /*params.appId = "onbaut";
            params.scr = "CorpOTP";
            params.layout = "Web";
            params.userObj = {
                "userId": apz.Login.sUserId,
                "roleId": apz.Login.sRoleId,
                "corporateId": apz.Login.sCorporateId,
                "userName" : apz.Login.sUserName
            };
            apz.launchApp(params);*/
            apz.Login.viewUserPersona();
        } else if (!status) {
            if (params.resFull.hasOwnProperty('appzillonErrors')) {
                var perrorCode = params.resFull.appzillonErrors;
                if (perrorCode[0].errorCode === 'APZ-SMS-EX-004') {
                    msg = {
                        'code': 'APZ-SMS-CONF',
                        'callBack': apz.app.relogin
                    };
                } else if (perrorCode[0].errorCode === 'APZ-DM-031') {
                    msg = {
                        'code': 'APZ-LOG-PASS-EXP',
                        'callBack': apz.Login.launchChangePassword
                    };
                } else if (perrorCode[0].errorCode === 'APZ-SMS-EX-003') {
                    msg = {
                        'code': 'APZ-SMS-EX-003',
                    };
                } else {
                    msg = {
                        'code': perrorCode[0].errorCode
                    };
                }
                apz.dispMsg(msg);
            }
        }
    } else {
        msg = {
            'code': 'APZ-SVR-ERR'
        };
        apz.dispMsg(msg);
    }
};
apz.Login.getUserRoleCB = function(pResp) {
    if (!pResp.errors) {} else {
        var msg = {
            "code": 'LOG_FAIL'
        };
        apz.dispMsg(msg);
    }
};
apz.Login.keyupevent = function(event) {
    if (event.keyCode == 13) {
        apz.Login.submitLogin();
    }
};
apz.Login.close = function() {
    var params = {};
    params.appId = "ACPL01";
    params.scr = "PreLogin";
    params.layout = "Web";
    apz.launchApp(params);
};
apz.Login.launchForgotPassword = function() {
     var params = {};
    params.appId = "fgtpwd";
    params.scr = "ForgotPassword";
 apz.launchApp(params);
};
apz.Login.launchChangePassword = function() {
    debugger;
    var params = {};
    params.appId = "accp01";
    params.scr = "ChangePassword";
    params.layout = "All";
    var lCorpID = apz.getElmValue("ACLI01__Login__CorporateId");
    if (lCorpID == "ACMECORP" || lCorpID ==  "PETRONAS GROUP") {
        lCorpID = "000FTAC4321";
    }
    params.userObj = {
        "userId": lCorpID + "__" + apz.getElmValue("ACLI01__Login__UserName").toLowerCase()
    };
    apz.launchApp(params);
};
apz.Login.fnOnboardClick = function() {
    debugger;
    var params = {};
    params.appId = "Regist";
    params.scr = "RegisterPage";
    params.layout = "Web";
    apz.launchApp(params);
};
apz.Login.fnOnenterClick = function(event) {
    if (event.keyCode == 13) {
        apz.Login.submitLogin();
    }
}
apz.Login.launchChat = function() {
    window.open('http://localhost:8080/ChatBot_01', 'newwindow', 'width=500,height=1250');
};
apz.Login.viewUserPersona = function() {
    debugger;
    apz.server.callServer({
        ifaceName: 'UserPersona_Query',
        appId: 'ACLI01',
        buildReq: 'N',
        req: {
            tbDbmiUserPersona: {
                userId: apz.Login.sUserId,
                corporateId: apz.Login.sCorporateId
            }
        },
        paintResp: 'N',
        callBack: apz.Login.viewUserPersonaCB
    });
};
apz.Login.viewUserPersonaCB = function(pResp) {
    debugger;
    try {
        if (pResp.status) {
            if (pResp.res.ACLI01__UserPersona_Res.tbDbmiUserPersona.personaName) {
                apz.Login.sPersona = pResp.res.ACLI01__UserPersona_Res.tbDbmiUserPersona.personaName;
            }
        }
    } catch (e) {}
    if(apz.appLanguage !=undefined){
    apz.changeLanguage(apz.appLanguage, "acbase");
}
    var params = {};
    params.appId = "onbaut";
    params.scr = "CorpOTP";
    params.layout = "Web";
    params.userObj = {
        "userId": apz.Login.sUserId,
        "roleId": apz.Login.sRoleId,
        "corporateId": apz.Login.sCorporateId,
        "userName": apz.Login.sUserName
    };
    apz.launchApp(params);
};
apz.Login.launchTwitter = function() {
    window.open("https://twitter.com/unitedbankal", "_blank");
};
apz.Login.launchWebsite = function() {
    window.open("https://www.uba.com.al/", "_blank");
};
apz.Login.launchFB = function() {
    window.open("https://www.facebook.com/uba.com.al/", "_blank");
};
apz.Login.authenticate = function() {
    var params = {};
    params.id = "BIOMETRIC_ID"
    
    params.callBack = apz.Login.biometricCallback;
    apz.ns.biometricAuth(params);
};
apz.Login.biometricCallback = function(json) {
    //if (json.status) {
      //  alert("Authentication Successful ");
        apz.Login.submitLogin();
    //}
};

apz.Login.fnOpenAcct = function(){
    window.open("http://52.230.122.45:8080/SMEOnboarding/", "_blank");
    // var params = {};
    // params.appId = "aploan";
    // params.scr = "ContactInfo";
    // params.layout = "All";
   
    //apz.launchApp(params);
}


apz.Login.fnChangeLanguage = function(pthis,pLang) {
    debugger;
    // apz.appLanguage = apz.getElmValue("ACLI01__Login__langddl");
    // var lang = apz.getElmValue("ACLI01__Login__langddl");
    apz.appLanguage = pLang;
    //if(pLang =="ar"){
        if(pLang =="al"){
        $("#ACLI01__Login__el_txt_8").removeClass("current");
        $("#ACLI01__Login__el_txt_9").addClass("current");
    }
    else if(pLang =="en"){
        $("#ACLI01__Login__el_txt_9").removeClass("current");
        $("#ACLI01__Login__el_txt_8").addClass("current");
    }
    var lang = pLang;
    apz.changeLanguage(lang, "acbase");
    var params = {};
    params.appId = "acbase";
    params.scr = "Launcher";
    params.layout = "All";
    params.userObj = {
        "language": lang
    }
    apz.launchApp(params);
}
