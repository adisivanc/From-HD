apz.fgtpwd.forgotpassword = {};
apz.app.onLoad_ForgotPassword = function(params) {
    apz.fgtpwd.forgotpassword.sParams = params;
    if(apz.fgtpwd.forgotpassword.sParams.from == "MPIN")
    {
        apz.setElmValue("fgtpwd__ForgotPassword__el_txt_3", "FORGOT MPIN")
    }
    else if (apz.fgtpwd.forgotpassword.sParams.from == "Password")
    {
         apz.setElmValue("fgtpwd__ForgotPassword__el_txt_3", "FORGOT PASSWORD")
    }
    else if(apz.fgtpwd.forgotpassword.sParams.from == "User ID")
    {
                 apz.setElmValue("fgtpwd__ForgotPassword__el_txt_3", "FORGOT USER ID")

    }
    
    apz.hide("fgtpwd__ForgotPassword__Stage2");
    apz.hide("fgtpwd__ForgotPassword__Stage3");
};
apz.app.onShown_ForgotPassword = function(params) {
    var now = new Date();
    // mobiscroll.settings = {
    //     theme: 'mobiscroll',              // Specify theme like: theme: 'ios' or omit setting to use default
    //     lang: 'en'                        // Specify language like: lang: 'pl' or omit setting to use default
    // };
    mobiscroll.date('#fgtpwd__ForgotPassword__cardExpiryDate', {
        dateFormat: 'mm/yy', // More info about dateFormat: https://docs.mobiscroll.com/4-7-3/javascript/datetime#localization-dateFormat
        min: new Date(), // More info about dateFormat: https://docs.mobiscroll.com/4-7-3/javascript/datetime#localization-dateFormat
        onInit: function(event, inst) {
            debugger; // More info about onInit: https://docs.mobiscroll.com/4-7-3/javascript/datetime#event-onInit
            inst.setVal(now, true);
        }
    });
    $("body").removeClass("loginby");
};
apz.fgtpwd.forgotpassword.fnNext = function() {
    debugger;
    apz.fgtpwd.forgotpassword.sCustomerID = apz.getElmValue("fgtpwd__ForgotPassword__customerId");
    apz.fgtpwd.forgotpassword.sMobileNo = apz.getElmValue("fgtpwd__ForgotPassword__mobileNo");
    if (apz.isNull(apz.fgtpwd.forgotpassword.sCustomerID) || apz.isNull(apz.fgtpwd.forgotpassword.sMobileNo)) {
        {
            var lMsg = {};
            lMsg.code = "FRGTPWD_MDCHK";
            lMsg.appId = "fgtpwd";
            apz.dispMsg(lMsg);
        }
    } else {
        var phoneno = new RegExp("^[0-9]{10}$");
        if (!phoneno.test(apz.fgtpwd.forgotpassword.sMobileNo)) {
            var msg = {
                "code": "INVALIDPhoneNo"
            };
            msg.appId = "fgtpwd";
            apz.dispMsg(msg);
            return false;
        } else {
            apz.hide("fgtpwd__ForgotPassword__Stage1");
            apz.show("fgtpwd__ForgotPassword__Stage2");
        }
    }
};
apz.fgtpwd.forgotpassword.fnTabChange = function(param, event) {
    debugger;
}
apz.fgtpwd.forgotpassword.fnMobileKeyup = function(el) {
    var digits = el.value.match(/\d{1,10}/) || [""];
    el.value = digits[0];
}
apz.fgtpwd.forgotpassword.fnFinish = function() {
    var params = new Object();
    params.newPassword = apz.getElmValue("fgtpwd__ForgotPassword__newPassword").trim();
    params.confirmPassword = apz.getElmValue("fgtpwd__ForgotPassword__confirmPassword").trim();
    if (params.newPassword !== "" && params.confirmPassword !== "") {
        if (params.newPassword === params.confirmPassword) {
            apz.dispMsg({
                message: "Password changed successfully",
                type: "S",
                callBack: apz.fgtpwd.forgotpassword.fnBack
            });
        } else {
            apz.dispMsg({
                message: "Password does not match!"
            });
        }
    } else {
        apz.dispMsg({
            message: "All the fields are mandatory!"
        });
    }
}
apz.fgtpwd.forgotpassword.fnSubmit = function() {
    debugger;
    var isCardTabActive = $("#fgtpwd__ForgotPassword__cardsPanel_li").hasClass("current");
    if (isCardTabActive) {
        var cvv = apz.getElmValue("fgtpwd__ForgotPassword__cvv");
        var cn = apz.getElmValue("fgtpwd__ForgotPassword__cardNumber");
        var ced = apz.getElmValue("fgtpwd__ForgotPassword__cardExpiryDate");
        var dob = apz.getElmValue("fgtpwd__ForgotPassword__dateOfBirth");
        if (apz.isNull(cvv) || apz.isNull(cn) || apz.isNull(ced) || apz.isNull(dob)) {
            apz.dispMsg({
                message: "Please fill the mandatory fields"
            });
        } else {
            apz.fgtpwd.forgotpassword.moveHere();
        }
    } else {
        var lAns1 = apz.getElmValue("fgtpwd__ForgotPassword__secQue1");
        var lAns2 = apz.getElmValue("fgtpwd__ForgotPassword__secQue2");
        var lAns3 = apz.getElmValue("fgtpwd__ForgotPassword__secQue3");
        if (apz.isNull(lAns1) || apz.isNull(lAns2) || apz.isNull(lAns3)) {
            apz.dispMsg({
                message: "Please fill the mandatory fields"
            });
        } else {
           apz.fgtpwd.forgotpassword.fnOTPCB();
        }
        /*else {
            var lMsg = {};
            lMsg.code = "FRGT_SUCC";
            lMsg.appId = "fgtpwd";
            lMsg.callBack = apz.fgtpwd.forgotpassword.submitCB;
            apz.dispMsg(lMsg);
        }*/
    }
};
apz.fgtpwd.forgotpassword.moveHere = function() {
    apz.hide("fgtpwd__ForgotPassword__Stage2");
    var params = {};
    params.appId = "otpeng";
    params.div = "fgtpwd__ForgotPassword__OTP";
    params.scr = "ProcessOTP";
    params.layout = "Web";
    params.userObj = {
        "action": "Generate",
        "mobileNo": apz.fgtpwd.forgotpassword.sMobileNo,
        "control": {
            "callBack": apz.fgtpwd.forgotpassword.fnOTPCB,
            "destroyDiv": "fgtpwd__ForgotPassword__OTP"
        }
    };
    apz.launchApp(params);
}
apz.fgtpwd.forgotpassword.fnOTPCB = function(lParams) {
    debugger;
     if(apz.fgtpwd.forgotpassword.sParams.from == "User ID")
     {
         apz.dispMsg({message:"User ID has been sent to your registered mail address", type :"S", callBack : apz.fgtpwd.forgotpassword.fnBack})
     }
else
{
    apz.hide("fgtpwd__ForgotPassword__OTP");
    apz.hide("fgtpwd__ForgotPassword__Stage2");
    apz.show("fgtpwd__ForgotPassword__Stage3");
            apz.setElmValue("fgtpwd__ForgotPassword__el_txt_3", "CHANGE PASSWORD");
}

};
apz.fgtpwd.forgotpassword.submitCB = function(params) {
    debugger;
    if (params.choice) {
        apz.fgtpwd.forgotpassword.fnBack();
    }
};
apz.fgtpwd.forgotpassword.fnBack = function() {
    debugger;
    var params = {};
      params.appId = "ACLI01";
    params.scr = "Login";
   
    apz.launchApp(params);
    
};
