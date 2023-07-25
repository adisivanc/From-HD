apz.accp01.ChangePassword = {};
apz.accp01.ChangePassword.sUserId = "";
apz.app.onLoad_ChangePassword = function() {
    debugger;
    apz.accp01.ChangePassword.sUserId = apz.Login.sCorporateId + "__" + apz.Login.sUser;
};
apz.accp01.ChangePassword.Confirm = function() {
    var luserId = apz.accp01.ChangePassword.sUserId;
    var params = new Object();
    params.newPassword = apz.getElmValue('accp01__ChangePassword__New_Pswd').trim();
    params.confirmPassword = apz.getElmValue('accp01__ChangePassword__Cnfm_Paswd').trim();
    params.oldPassword = apz.getElmValue('accp01__ChangePassword__Old_Pswd').trim();
    var req = {};
    req.userId = luserId;
    req.oldPassword = params.oldPassword;
    req.newPassword = params.newPassword;
    req.confirmPassword = params.confirmPassword;
    req.callBackObj = this;
    req.async = true;
    req.callBack = apz.accp01.ChangePassword.ConfirmCB;
    apz.server.changePassword(req);
};
apz.accp01.ChangePassword.ConfirmCB = function(params) {
    debugger;
    if (params.status) {
        if (params.resFull.appzillonHeader.status) {
            var msg = {};
            msg.code = 'APZ-PWD-CHN-SUC';
            msg.callBack = apz.accp01.ChangePassword.CheckingUserExpiry;
            apz.dispMsg(msg);
        } else {
            if (params.errors[0].errorCode[0] !== "$") {
                var perrorCode = params.errors;
                var msg = {};
                msg.callBack = null;
                for (var i = 0; i < perrorCode.length; i++) {
                    if (perrorCode[i].errorCode === "APZ-DM-033") {
                        msg.message = params.errors[0].errorMessage;
                        msg.type = 'E';
                    } else if (perrorCode[i].errorCode === "APZ-DM-032") {
                        msg.code = 'APZ-DM-032';
                    } else if (perrorCode[i].errorCode === "APZ-DM-034") {
                        msg.code = 'APZ-DM-034';
                    } else if (perrorCode[i].errorCode === "APZ-FM-EX-050") {
                        msg.code = 'APZ-PWD-CHN-SUC';
                        msg.type = 'I';
                        msg.callBack = apz.accp01.ChangePassword.CheckingUserExpiry;
                    } else {
                        msg.code = 'APZ-PWD-CHN-FLD';
                    }
                }
                apz.dispMsg(msg);
            }
        }
    } else {
        var perrorCode = params.errors;
        var msg = {};
        msg.callBack = null;
        for (var i = 0; i < perrorCode.length; i++) {
            msg.code = perrorCode[i].errorCode;
            apz.dispMsg(msg);
        }
    }
};
apz.accp01.ChangePassword.CheckingUserExpiry = function() {
    apz.ns.refreshPageCallback();
};