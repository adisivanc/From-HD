apz.ficl01.AddCreditLimitCollateral = {};
apz.app.onLoad_AddCreditLimitCollateral = function(params) {
    debugger;
    //var options = [{"val":"INR","desc":"INR"},{"val":"USD","desc":"USD"}];
    //apz.populateDropdown(document.getElementById("ficl01__AddCreditLimitCollateral__el_dpd_1"),options);
    /*apz.ficl01.AddCreditLimitCollateral.sCorporateId = apz.Login.sCorporateId;
    apz.ficl01.AddCreditLimitCollateral.sUserId = apz.Login.sUserId;
    apz.setElmValue("ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimit__corporateId", apz.ficl01.AddCreditLimitCollateral.sCorporateId);
    apz.setElmValue("ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimit__userId", apz.ficl01.AddCreditLimitCollateral.sUserId);*/
    apz.ficl01.AddCreditLimitCollateral.sTaskObj = params;
    apz.data.scrdata.ficl01__AddCreditLimit_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCreditLimit_Req;
    apz.data.loadData("AddCreditLimit", "ficl01");
    //apz.ficl01.AddCreditLimitCollateral.fetchCollateralsList();
};
apz.app.onShown_AddCreditLimitCollateral = function() {
    //$(".adr-ctr").addClass("sno");
};
apz.ficl01.AddCreditLimitCollateral.fetchCollateralsList = function() {
    var req = {
        "CollateralsList": {
            "corporateId": apz.Login.sCorporateId,
            "type": "All"
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_collaterals";
    var lServerParams = {
        "ifaceName": "FetchCollateralsService",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.AddCreditLimitCollateral.fetchCollateralsListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}
apz.ficl01.AddCreditLimitCollateral.fetchCollateralsListCB = function(pResp) {
    debugger;
    var lCollArr = pResp.res.ficl01__FetchCollateralsService_Res.CollateralsList;
    apz.data.scrdata.ficl01__AddCreditLimit_Req = {};
    apz.data.scrdata.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimitCollaterals = lCollArr;
    //apz.data.loadData("AddCreditLimitCollateral", "ficl01");
    apz.data.getContainerData({
        "containerId": "ficl01__AddCreditLimitCollateral__tb_Colateral"
    })
}
apz.rowSelectorClicked = function(event) {
    debugger;
    var lRow = parseInt(event.currentTarget.id.split("_")[7]);
    if (event.currentTarget.checked) {
        $("#ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimitCollaterals__margin_" + lRow).attr("disabled", false);
    } else {
        $("#ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimitCollaterals__margin_" + lRow).attr("disabled", true);
    }
}
apz.app.postSelectAll = function(ficl01__AddCreditLimitCollateral__tb_Colateral_table) {
    apz.ficl01.AddCreditLimitCollateral.enDiInput();
}
apz.app.postUnSelectAll = function(ficl01__AddCreditLimitCollateral__tb_Colateral_table) {
    apz.ficl01.AddCreditLimitCollateral.enDiInput();
}
apz.ficl01.AddCreditLimitCollateral.enDiInput = function() {
    var tRec = apz.scrMetaData.containersMap['ficl01__AddCreditLimitCollateral__tb_Colateral'].totalRecs;
    for (var i = 0; i < tRec; i++) {
        if ($("#ficl01__AddCreditLimitCollateral__tb_Colateral_0").prop("checked") == true) {
            $("#ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimitCollaterals__margin_" + i).attr("disabled", false);
        } else {
            $("#ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimitCollaterals__margin_" + i).attr("disabled", true);
        }
    }
}
apz.ficl01.AddCreditLimitCollateral.fnCancel = function() {
    // apz.show("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__limitsHeaderRow");
    // apz.hide("ficl01__FCSummary__subScreenLauncher");
    // apz.ficl01.FCSummary.showCreditLimit();
    apz.show("ficl01__CreditLimitsList__limHeader");
     apz.show("ficl01__CreditLimitsList__MoblimHeader");
      apz.show("ficl01__CreditLimitsList__limchart");
    apz.hide("ficl01__CreditLimitsList__subScreenLauncher");
    apz.show("ficl01__CreditLimitsList__limListRow");
};
apz.ficl01.AddCreditLimitCollateral.saveDetails = function() {
    debugger;
    var proceed = true;
    var totalRec = apz.scrMetaData.containersMap['ficl01__AddCreditLimitCollateral__tb_Colateral'].totalRecs;
    /*for (var k = 0; k < totalRec; k++) {
        if ($("#ficl01__AddCreditLimitCollateral__tb_Colateral_selcb_" + k).prop("checked") == true && $(
            "#ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimitCollaterals__margin_" + k).val() == "") {
            $("#ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimitCollaterals__margin_" + k).addClass("err");
            proceed = false;
        } else {
            $("#ficl01__AddCreditLimitCollateral__i__tbDbmiCorpCreditLimitCollaterals__margin_" + k).removeClass("err");
        }
    }*/
    if (proceed) {
        apz.ficl01.AddCreditLimitCollateral.confirm();
    } else {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
};
apz.ficl01.AddCreditLimitCollateral.getSelectedCollateral = function(lscreenData) {
    var getScreenData = JSON.parse(lscreenData);
    apz.data.buildData("AddCreditLimi", "ficl01");
    var lCollateralData = apz.data.scrdata.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimitCollaterals;
    /*var colArr = [];
    var tRec = apz.scrMetaData.containersMap['ficl01__AddCreditLimitCollateral__tb_Colateral'].totalRecs;
    for (var i = 0; i < tRec; i++) {
        //if ($("#ficl01__AddCreditLimitCollateral__tb_Colateral_selcb_" + i).prop("checked") == true) {
            colArr.push(lCollateralData[i]);
        //}
    }*/
    getScreenData.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimitCollaterals = lCollateralData;
    return JSON.stringify(getScreenData);
}
apz.ficl01.AddCreditLimitCollateral.confirm = function() {
    debugger;
    if (!apz.mockServer) {
        var lUserObj = {};
        lUserObj.currentTask = apz.ficl01.AddCreditLimitCollateral.sTaskObj.currentTask;
        lUserObj.currentWfDetails = apz.ficl01.AddCreditLimitCollateral.sTaskObj.currentWfDetails;
        lUserObj.currentWfDetails.screenData = apz.ficl01.AddCreditLimitCollateral.getSelectedCollateral(lUserObj.currentWfDetails.screenData);
        lUserObj.callBack = apz.ficl01.AddCreditLimitCollateral.workflowMicroServiceCB;
        lUserObj.operation = "NEXTTASK";
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "ficl01__AddCreditLimitCollateral__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var lReqObj = {};
        lReqObj.currentWfDetails = {};
        // lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
        // lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
        
        lReqObj.currentTask = "";
        lReqObj.currentWfDetails.screenData = apz.ficl01.AddCreditLimitCollateral.getSelectedCollateral(apz.ficl01.AddCreditLimitCollateral.sTaskObj.currentWfDetails.screenData);;
        var lParams = {
            "appId": "ficl01",
            "scr": "VerifyCreditLimit",
            "userObj": lReqObj,
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All"
        };
        apz.launchSubScreen(lParams);
    }
};
apz.ficl01.AddCreditLimitCollateral.workflowMicroServiceCB = function(pNextStageObj) {
    debugger;
    apz.currAppId = "ficl01";
    if (pNextStageObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pNextStageObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pNextStageObj.stageAccess) {
                var lReqObj = {};
                lReqObj.currentTask = pNextStageObj.tbDbmiWorkflowMaster;
                lReqObj.currentWfDetails = pNextStageObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lReqObj.currentWfDetails.appId,
                    "scr": lReqObj.currentWfDetails.screenId,
                    "userObj": lReqObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pNextStageObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};
