apz.ddinst.ecsmandatedetails = {};
apz.ddinst.ecsmandatedetails.sParams = {};
apz.ddinst.ecsmandatedetails.sAuthentication;
apz.app.onLoad_EcsMandateDetails = function(params) {
    debugger;
    apz.ddinst.ecsmandatedetails.sParams = params;
    
    apz.ddinst.ecsmandatedetails.fnInitialise(params);
}
apz.app.onShown_EcsMandateDetails = function()
{
    $("#ddinst__ecsMandateDtls__i__EcsMandateReq__accountNoOfOB").attr("type","tel");
        $("#ddinst__ecsMandateDtls__i__EcsMandateReq__accountNoOfCR").attr("type","tel");



}
apz.ddinst.ecsmandatedetails.fnInitialise = function(params) {
    apz.setElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__customerId", apz.ddinst.ecsmandatedetails.sParams.data.customerID);
    apz.show("ddinst__EcsMandateDetails__stage1");
    apz.hide("ddinst__EcsMandateDetails__stage2");
    apz.hide("ddinst__EcsMandateDetails__stage3");
    apz.hide("ddinst__EcsMandateDetails__stage4");
    apz.hide("ddinst__EcsMandateDetails__button2");
    if (apz.ddinst.ecsmandatedetails.sParams.action == "view") {
        $("#ddinst__EcsMandateDetails__ct_frm_stage1 input").attr("disabled", true);
        apz.hide("ddinst__EcsMandateDetails__nominee");
        apz.hide("ddinst__EcsMandateDetails__terms");
        apz.hide("ddinst__EcsMandateDetails__button1");
        apz.hide("ddinst__EcsMandateDetails__button3");
        apz.show("ddinst__EcsMandateDetails__button2");
                $("#ddinst__EcsMandateDetails__sc_row_95").addClass("sno");

        apz.data.scrdata.ddinst__ecsMandateDtls_Req = {};
        apz.data.scrdata.ddinst__ecsMandateDtls_Req.EcsMandateReq = apz.ddinst.ecsmandatedetails.sParams.data
        apz.data.loadData("ecsMandateDtls", "ddinst");
    }
    if (apz.ddinst.ecsmandatedetails.sParams.action == "edit") {
        apz.hide("ddinst__EcsMandateDetails__button1");
        apz.show("ddinst__EcsMandateDetails__button2");
        apz.show("ddinst__EcsMandateDetails__button3");
        apz.show("ddinst__EcsMandateDetails__nominee");
        apz.show("ddinst__EcsMandateDetails__terms");
        apz.data.scrdata.ddinst__ecsMandateDtls_Req = {};
        apz.data.scrdata.ddinst__ecsMandateDtls_Req.EcsMandateReq = apz.ddinst.ecsmandatedetails.sParams.data
        apz.data.loadData("ecsMandateDtls", "ddinst");
    }
    if (apz.ddinst.ecsmandatedetails.sParams.action == "delete") {
        $("#ddinst__EcsMandateDetails__ct_frm_stage1 input").attr("disabled", true);
        apz.hide("ddinst__EcsMandateDetails__button1");
        apz.show("ddinst__EcsMandateDetails__button2");
        apz.show("ddinst__EcsMandateDetails__button3");
        apz.hide("ddinst__EcsMandateDetails__nominee");
        apz.hide("ddinst__EcsMandateDetails__terms");
        apz.setElmValue("ddinst__EcsMandateDetails__successmsg", "Direct Debit Mandate Deleted Successfully");
        apz.data.scrdata.ddinst__ecsMandateDtls_Req = {};
        apz.data.scrdata.ddinst__ecsMandateDtls_Req.EcsMandateReq = apz.ddinst.ecsmandatedetails.sParams.data
        apz.data.loadData("ecsMandateDtls", "ddinst");
    }
}
apz.ddinst.ecsmandatedetails.fnContinueStage1 = function() {
    if (apz.ddinst.ecsmandatedetails.sParams.action == "delete") {
        var lProceed = {};
        lProceed.lStatus = true;
    } else {
        var lProceed = apz.ddinst.ecsmandatedetails.fnValidateStage1();
    }
    if (lProceed.lStatus) {
        apz.show("ddinst__EcsMandateDetails__stage2");
        apz.hide("ddinst__EcsMandateDetails__stage1");
        apz.hide("ddinst__EcsMandateDetails__stage3");
        apz.hide("ddinst__EcsMandateDetails__stage4");
        apz.setElmValue("ddinst__EcsMandateDetails__cust2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__custNameInOB"));
        apz.setElmValue("ddinst__EcsMandateDetails__bank2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__bankName"));
        apz.setElmValue("ddinst__EcsMandateDetails__code2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__bankCode"));
        apz.setElmValue("ddinst__EcsMandateDetails__account2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__accountNoOfOB"));
        apz.setElmValue("ddinst__EcsMandateDetails__mandateAmt2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__mandateAmount"));
        apz.setElmValue("ddinst__EcsMandateDetails__mandateStart2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__mandateStartDate"));
        apz.setElmValue("ddinst__EcsMandateDetails__freq2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__frequency"));
        apz.setElmValue("ddinst__EcsMandateDetails__no2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__noOfInst"));
        apz.setElmValue("ddinst__EcsMandateDetails__mandateEnd2", apz.getElmValue("ddinst__EcsMandateDetails__endDate"));
       // apz.setElmValue("ddinst__EcsMandateDetails__mandatechg2", apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__mandateChgAmt"));
    } else {
        var param = {
            'code': lProceed.ErrCode
        };
        apz.dispMsg(param);
    }
}
apz.ddinst.ecsmandatedetails.fnCancelStage1 = function() {
    var Params = {
        "appId": "ddinst",
        "scr": "EcsSummary",
        "div": "ddinst__EcsLauncher__row1",
        "layout":"All",
        "userObj": {
            //"customerId": apz.ddinst.ecsmandatedetails.sParams.data.customerID
            "data": {
                "customerID": "00001",
            }
        }
    };
    if (apz.ddinst.ecssummary.sParams.Navigation) {
        Params.userObj.Navigation = apz.ddinst.ecssummary.sParams.Navigation
    }
    apz.launchSubScreen(Params);
};
apz.ddinst.ecsmandatedetails.fnCalculateEndDate = function() {
    debugger;
    var lStartDate = apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__mandateStartDate");
       // var initial = (lStartDate).split(/\//).reverse().join('/');
var initial = apz.formatDate({
            "val": lStartDate,
            "fromFormat": "dd/MM/yyyy",
            "toFormat": "yyyy/MM/dd"
        });
    var lFrequency = apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__frequency");
    var lNoOfInst = apz.getElmValue("ddinst__ecsMandateDtls__i__EcsMandateReq__noOfInst");
    if (!apz.isNull(lStartDate) && !apz.isNull(lFrequency) && !apz.isNull(lNoOfInst)) {
         var date = new Date(initial)
        var lNum = lFrequency * (lNoOfInst);
        var lMon = date.getMonth() + lNum;
        var lEnddate = date.setMonth(lMon);
        apz.setElmValue("ddinst__EcsMandateDetails__endDate", new Date(lEnddate).toString("dd/MM/yyyy"));
        // var date = Date.parseExact(encodeURIComponent(lStartDate), "dd/MM/yyyy");
        // var lNum = lFrequency * (lNoOfInst - 1);
        // var lMon = date.getMonth() + lNum;
        // var lEnddate = date.setMonth(lMon);
        // apz.setElmValue("ddinst__EcsMandateDetails__endDate", date.toString("dd/MM/yyyy"));
    }
};
apz.ddinst.ecsmandatedetails.fnEditSatge2 = function() {
    apz.ddinst.ecsmandatedetails.fnInitialise();
};
apz.ddinst.ecsmandatedetails.fnConfirmSatge3 = function() {
    apz.hide("ddinst__EcsMandateDetails__stage1");
    apz.hide("ddinst__EcsMandateDetails__stage2");
    apz.hide("ddinst__EcsMandateDetails__stage3");
    apz.show("ddinst__EcsMandateDetails__stage4");
    apz.setElmValue("ddinst__EcsMandateDetails__cust3", apz.getElmValue("ddinst__EcsMandateDetails__cust2"));
    apz.setElmValue("ddinst__EcsMandateDetails__bank3", apz.getElmValue("ddinst__EcsMandateDetails__bank2"));
    apz.setElmValue("ddinst__EcsMandateDetails__code3", apz.getElmValue("ddinst__EcsMandateDetails__code2"));
    apz.setElmValue("ddinst__EcsMandateDetails__account3", apz.getElmValue("ddinst__EcsMandateDetails__account2"));
    apz.setElmValue("ddinst__EcsMandateDetails__mandateAmt3", apz.getElmValue("ddinst__EcsMandateDetails__mandateAmt2"));
    apz.setElmValue("ddinst__EcsMandateDetails__mandateStart3", apz.getElmValue("ddinst__EcsMandateDetails__mandateStart2"));
    apz.setElmValue("ddinst__EcsMandateDetails__freq3", apz.getElmValue("ddinst__EcsMandateDetails__freq2"));
    apz.setElmValue("ddinst__EcsMandateDetails__no3", apz.getElmValue("ddinst__EcsMandateDetails__no2"));
    apz.setElmValue("ddinst__EcsMandateDetails__mandateEnd3", apz.getElmValue("ddinst__EcsMandateDetails__mandateEnd2"));
    //apz.setElmValue("ddinst__EcsMandateDetails__mandatechg3", apz.getElmValue("ddinst__EcsMandateDetails__mandatechg2"));
    var d= new Date();
    var lResponse = "Your reference number is "  + d.getTime() ;
    apz.setElmValue('ddinst__EcsMandateDetails__reference', lResponse);
};
apz.ddinst.ecsmandatedetails.fnBackButton = function() {
    debugger;
    apz.show("ddinst__EcsMandateDetails__summ1");
    apz.show("ddinst__EcsMandateDetails__summ2");
    apz.hide("ddinst__EcsMandateDetails__summ3");
    apz.data.loadData("ecsMandate", "ddinst");
    var Params = {
        "appId": "ddinst",
        "scr": "EcsSummary",
        "div": "ddinst__EcsLauncher__row1",
        "layout":"All",
        "userObj": {
            "Navigation": apz.ddinst.ecsmandatedetails.sParams.Navigation,
            "headerText": ""
        }
    }
    Params.userObj.data = {
        "customerID": "00001",
    };
    apz.launchSubScreen(Params);
};
apz.ddinst.ecsmandatedetails.fnValidateStage1 = function(params) {
    var lResp = {
        "ErrCode": "APZ-CNT-099"
    };
    lResp.lStatus = apz.val.validateContainer('ddinst__EcsMandateDetails__ct_frm_stage1');
    if (lResp.lStatus && apz.getElmValue("ddinst__EcsMandateDetails__check1") == "n") {
        lResp.lStatus = false;
        lResp.ErrCode = "ERR_AGREE_TERMS";
        return lResp;
    }
    return lResp;
};
apz.ddinst.ecsmandatedetails.fnSetNavigation = function(params) {
    debugger;
    apz.ddinst.ecsmandatedetails.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    if (!apz.isNull(params.headerText)) {
        lParams.headerText = params.headerText;
    } else {
        lParams.headerText = "DIRECT DEBIT DETAILS";
    }
    lParams.backPressed = apz.ddinst.ecsmandatedetails.fnBack;
    apz.ddinst.ecsmandatedetails.Navigation(lParams);
};
apz.ddinst.ecsmandatedetails.fnclickConfirm = function(params) {
    debugger;
    var lReq = {};
    lReq.EcsMandateReq = {};
    lReq.EcsMandateReq.ACTION = "C";
    lReq.ACTION = "C";
    apz.data.buildData("ecsMandateDtls", "ddinst");
    lReq.EcsMandateReq = apz.data.scrdata.ddinst__ecsMandateDtls_Req.EcsMandateReq;
    lReq.EcsMandateReq.authenticationType = "OTP";
    var lServerParams = {
        "ifaceName": "ecsMandateDtls",
        "paintResp": "N",
        "buildReq": "N",
        "req": lReq,
        "callBack": apz.ddinst.ecsmandatedetails.fnclickConfirmCallBack
        //"headerCallback": apz.stnint.STAmount.fnSetHeader
    };
    //apz.startLoader();
  //  apz.server.callServer(lServerParams);
    jsondata  = JSON.parse(apz.getFile(apz.getDataFilesPath("ddinst") + "/ecsMandateDtls.json"));
    apz.data.scrdata.ddinst__ecsMandateDtls_Req = {};
        apz.data.scrdata.ddinst__ecsMandateDtls_Req = jsondata;
        apz.data.loadData("ecsMandateDtls", "ddinst");
    apz.ddinst.ecsmandatedetails.fnclickConfirmCallBack(jsondata);

}
apz.ddinst.ecsmandatedetails.fnclickConfirmCallBack = function(params) {
    debugger;
   
        apz.hide("ddinst__EcsMandateDetails__stage1");
        apz.hide("ddinst__EcsMandateDetails__stage2");
        apz.show("ddinst__EcsMandateDetails__stage3");
        apz.hide("ddinst__EcsMandateDetails__stage4");
    //     var lLaunchParams = {
    //         "appId": "otpeng",
    //         "scr": "ProcessOTP",
    //         "div": "ddinst__EcsMandateDetails__stage3",
    //         "userObj": {
    //             "action": "SetRefNo",
    //             "data": {
    //                 "OTPRefNo": params.EcsMandateRes.data.OTPRefNo
    //             },
    //             "control": {
    //                 "appId": "otpeng",
    //                 "callBack": apz.ddinst.ecsmandatedetails.fnConfirmSatge3,
    //                 "destroyDiv": "ddinst__EcsMandateDetails__stage3"
    //             }
    //         }
    //     }
    
    // apz.launchApp(lLaunchParams);
    apz.ddinst.ecsmandatedetails.fnConfirmSatge3();
}
// apz.app.postGetHeader = function(header) {
//     header.sessionId = 'gjdgasghgasfgafgas';
//     return header;
// }
apz.ddinst.ecsmandatedetails.fnDone = function(){
    //apz.landin.Landing.fnHome();
    apz.ACNR01.Navigator.gotoDashboard();
};
