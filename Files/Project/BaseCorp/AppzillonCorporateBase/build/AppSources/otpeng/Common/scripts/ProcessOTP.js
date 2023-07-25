/******         
 * Purpose -- This Microapp implements the logic of OTP generation and on OTP validation initiating
 *              the actual system call.
 *            It has to be customized at the Java layer to send out the OTP Pin in sms or email formats.
 ******/
/* Expected Input Parameters
    "ifaceName" : "", --Name of the interface for which OTP is invoked
    "appId" : "", App ID of the Micro app which invoked the OTP
    "control" : {
        "callBack" : , -- On successful confirmation of the OTP, the microapp which to which the control should be handed over.
        "destroyDiv" : "" -- ID of the div container within which it is launched, from where it has to be removed 
                             on successful OTP completion
    }
    
 ******/
apz.otpeng = {};
apz.otpeng.processotp = {};
apz.otpeng.processotp.sAction = '';
apz.otpeng.processotp.sReferenceId = '';
apz.otpeng.processotp.sParams = {};
apz.app.onLoad_ProcessOTP = function(params) {
    debugger;
    apz.otpeng.processotp.sParams = params;
    if (params.action == 'SetRefNo') {
        apz.otpeng.processotp.fnLaunch(params);
    } else if (params.action == 'Generate') {
        apz.otpeng.processotp.sParentAction = "Generate";
        var lParams = {};
        lParams.ifaceName = "ProcessOTP";
        lParams.appId = "otpeng";
        lParams.data = params.data;
        apz.otpeng.processotp.fnGenerate(lParams);
    }
};
apz.otpeng.processotp.fnLaunch = function(params) {
    apz.otpeng.processotp.sReferenceId = params.data.OTPRefNo;
    apz.setElmValue('otpeng__ProcessOTP__reference_Id', apz.otpeng.processotp.sReferenceId);
};
apz.otpeng.processotp.fnGenerate = function(params) {
    debugger;
    apz.otpeng.processotp.sAction = 'Generate';
    var lServerParams = {
        "ifaceName": params.ifaceName,
        "req": {
            "payload": params.data,
            "action": "Generate"
        },
        "callBack": apz.otpeng.processotp.fnGenerateCallBack
    };
    apz.otpeng.processotp.fnBeforeCallServer(lServerParams);
};
apz.otpeng.processotp.fnConfirm = function() {
    apz.otpeng.processotp.sAction = 'Validate';
    var lReq = {
        "validateNProcessRequest": {
            "RefNo": apz.otpeng.processotp.sReferenceId,
            "otp": apz.getElmValue('otpeng__ProcessOTP__otp'),
            "action": "Validate"
        },
        "action": "Validate"
    };
    //apz.otpeng.ProcessOTP.sParams.callBack.call(lReq, lReq);
    var lServerParams = {
        "ifaceName": "otpeng__ProcessOTP",
        "buildReq": "N",
        "req": lReq,
        "callBack": apz.app.fnValidateCB,
        "internal": true
    };
    apz.otpeng.processotp.fnBeforeCallServer(lServerParams);
};
apz.otpeng.processotp.fnRegenerate = function() {
    apz.otpeng.processotp.sAction = 'Resend';
    var lServerParams = {
        "ifaceName": "ProcessOTP",
        "req": {
            "action": "Resend",
            "payload": params.data
        }
    };
    apz.otpeng.processotp.fnBeforeCallServer(lServerParams);
};
apz.otpeng.processotp.fnBeforeCallServer = function(params) {
    debugger;
    var lServerParams = {
        "ifaceName": params.ifaceName,
        "buildReq": "N",
        "req": params.req,
        "paintResp": "N",
        "callBack": apz.otpeng.processotp.fnCallServerCallBack,
        "appId": "otpeng",
        "internal": false
    };
    if (apz.otpeng.processotp.sAction == 'Validate') {
        lServerParams.internal = true;
    }
    apz.server.callServer(lServerParams);
    if (apz.otpeng.processotp.sAction == "Generate" || apz.otpeng.processotp.sAction == "Resend") {
        $('#otpeng__ProcessOTP__otp').focus();
    }
};
apz.otpeng.processotp.fnCallServerCallBack = function(params) {
    debugger;
	params.status=true;
	params.res={};
    if (apz.otpeng.processotp.sAction == 'Generate') {
        if (params.status) {
            apz.otpeng.processotp.sReferenceId = params.res.otpeng__ProcessOTP_Res.generateOTPResponse.RefNo;
            apz.setElmValue('otpeng__ProcessOTP__reference_Id', apz.otpeng.processotp.sReferenceId);
            if(apz.otpeng.processotp.sParentAction == "Generate"){
                apz.otpeng.processotp.fnSendOTP(params);
            }
        }
    } else if (apz.otpeng.processotp.sAction == 'Validate')
        if (apz.mockServer && apz.otpeng.processotp.sParentAction == "Generate"){
                var lParams = {};
                lParams.otpdetails = {};
                lParams.otpdetails.Status = "P";
                var lDestroy = apz.otpeng.processotp.sParams.control.destroyDiv;
                $('#' + lDestroy).children().remove();
                apz.otpeng.processotp.sParams.control.callBack(lParams);
                apz.otpeng.processotp.sParentAction = "";
             }
        else {
            if (params.status) {
                if (!params.res['OTPValServiceResponse']) {
                    apz.otpeng.processotp.fnDestroy(params.res);
                } else if (params.res['OTPValServiceResponse']) {
                    if (params.res.OTPValServiceResponse['status']) {
                        if (params.res.OTPValServiceResponse.status == 'N') {
                            var lerrorParams = {
                                'code': 'OTP_CMN_001'
                            };
                            apz.dispMsg(lerrorParams);
                        }
                    }
                }
            } else {
                var lerrorParams = {
                    'code': 'OTP_CMN_002'
                };
                apz.dispMsg(lerrorParams);
            }
        }
};
apz.otpeng.processotp.fnDestroy = function(params) {
    var lDestroy = apz.otpeng.processotp.sParams.control.destroyDiv;
    $('#' + lDestroy).children().remove();
    apz.otpeng.processotp.sParams.control.callBack(params);
};
apz.otpeng.processotp.fnSendOTP = function(lParams) {
    debugger;
    var lmobileNo = apz.otpeng.processotp.sParams.mobileNo;
    var lsenderID = "APZBNK";
    var lOtp = parseInt(lParams.res.otpeng__ProcessOTP_Res.generateOTPResponse.otp);
    var lmessage = "Your OTP is " + lOtp + ". Use this OTP for Registration";
    var llurl = "http://smshorizon.co.in/api/sendsms.php?user=Iexceed&apikey=XOTNwz3OffqcodOubdhl&mobile=" + lmobileNo + "&message=" + lmessage +
        "&senderid=" + lsenderID + "&type=txt";
    $.ajax({
        url: llurl,
        dataType: "JSONP",
        success: function(result, error) {
            console.log(result, error);
        }
    });
};
/*apz.app.postGetHeader = function(header){
    header.sessionId = 'gjdgasghgasfgafgas';
    return header;
};*/
