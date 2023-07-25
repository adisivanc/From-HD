/******         
 * Purpose -- This Microapp implements the Login Authenctication associated with any Enterprise app.
   Expected Input Parameters
 * @"ServerAuthType" Server Authentication Type -- Possible values are Appzillon/ Others 
 @"LoginMap" : {
     "serverAuthType" : {
        "value" : "Appzillon",
        "launchInfo" : {
              { "screen" : "LandingPage",
                            "animation" : 0
              }
            }
     }
 * 
 ******/
apz.csmrbk.login = {};
apz.csmrbk.userId = "";
apz.app.onShown_Login = function() {
    apz.csmrbk.login.fnInitialise();
};
/* Business logic to be executed during application initialization goes here */
apz.csmrbk.login.fnInitialise = function() {
    debugger;
   //  apz.mockServer=false;
};
/* This function is invoked on click of the Login button */
apz.csmrbk.login.fnDoLogin = function() {
    debugger;
    apz.csmrbk.userId = apz.getElmValue('csmrbk__Login__username');
    var lPassword = apz.getElmValue('csmrbk__Login__password');
    var lActionParams = {
        "action": "submitLogin",
        "data": {
            "pwd": lPassword
        }
    };
    var lIsValid = apz.csmrbk.login.fnValidate(lActionParams);
    if (lIsValid) {
        var lServerParams = {
            "action": "submitLogin",
            "iface": "",
            "data": {
                "pwd": lPassword
            }
        };
        apz.csmrbk.login.fnBeforeCallServer(lServerParams);
       
    }
};
/* This function contains all the validations that are fired on the client side 
   Conditional executions are based on the actions being performed */
apz.csmrbk.login.fnValidate = function(params) {
    if (params.action == 'submitLogin') {
        if (apz.isNull(apz.csmrbk.userId) || apz.isNull(params.data.pwd)) {
            var lErrorParams = {
                'code': 'LOGIN_001'
            };
            apz.dispMsg(lErrorParams);
            return false;
        }
        return true;
    }
};
/* This function is the placeholder for all data manipulation before actual handover to Infra's Server Call 
   This is the single point of exit 
   Conditional executions are based on the actions being performed*/
apz.csmrbk.login.fnBeforeCallServer = function(params) {
    apz.csmrbk.login.sAction = params.action;
    if (apz.csmrbk.login.sAction == "submitLogin") {
        var lRequest = {
            "userId": apz.csmrbk.userId,
            "pwd": params.data.pwd,
            "callBack": apz.csmrbk.login.fnCallServerCallBack
        };
        apz.server.login(lRequest);
    }
};
/* This function is the placeholder for all data manipulation before actual handover to Infra's Server Call 
   Conditional executions are based on the actions being performed*/
apz.csmrbk.login.fnCallServerCallBack = function(params) {
    debugger;
    if (apz.csmrbk.login.sAction == "submitLogin") {
        if (params.status) {
            if (params.res.loginResponse.status) {
                var lObj = {
                    "scr": "LandingPage",
                    "appId": "csmrbk",
                    "userObj":{
                        "userId":apz.csmrbk.userId
                    }
                };
                apz.launchScreen(lObj);
            } else {
                var lErrorParams = {
                    'code': 'LOGIN_002'
                };
                apz.dispMsg(lErrorParams);
            }
        } else {
            var lErrorParams = {
                'code': 'LOGIN_003'
            };
            apz.dispMsg(lErrorParams);
        }
    }
};
$('input[type=text],input[type=password]').on('keydown', function(e) {
    if (e.which == 13) {
        e.preventDefault();
        apz.csmrbk.login.fnDoLogin();
    }
});