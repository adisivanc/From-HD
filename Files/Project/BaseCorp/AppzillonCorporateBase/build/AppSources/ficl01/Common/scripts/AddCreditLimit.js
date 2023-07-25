apz.ficl01.AddCreditLimit = {};
apz.app.onLoad_AddCreditLimit = function(params) {
    debugger;
    //var options = [{"val":"INR","desc":"INR"},{"val":"USD","desc":"USD"}];
    //apz.populateDropdown(document.getElementById("ficl01__AddCreditLimit__el_dpd_1"),options);
    apz.setElmValue("ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__parentLimit", "LIM001254321");
    apz.ficl01.AddCreditLimit.sCorporateId = apz.Login.sCorporateId;
    apz.ficl01.AddCreditLimit.sUserId = apz.Login.sUserId;
    apz.setElmValue("ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__corporateId", apz.ficl01.AddCreditLimit.sCorporateId);
    apz.setElmValue("ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__userId", apz.ficl01.AddCreditLimit.sUserId);
    apz.setElmValue("ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimit__availableAmount", "10000");
    apz.ficl01.AddCreditLimit.sFrom = params.from;
    apz.ficl01.AddCreditLimit.fetchCollateralsList();
    
  if (params.currentTask) {
           // apz.lecr01.AddLC.currentWfDetails = params.currentWfDetails;
           // apz.lecr01.AddLC.currentTask = params.currentTask;
            apz.data.scrdata.ficl01__AddCreditLimit_Req = JSON.parse(params.currentWfDetails.screenData).ficl01__AddCreditLimit_Req;
            apz.data.loadData("AddCreditLimit", "ficl01");
        }
    
    
};
apz.app.onShown_AddCreditLimit = function() {
    $(".adr-ctr").addClass("sno");
};
apz.ficl01.AddCreditLimit.fetchCollateralsList = function() {
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
        "callBack": apz.ficl01.AddCreditLimit.fetchCollateralsListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}
apz.ficl01.AddCreditLimit.fetchCollateralsListCB = function(pResp) {
    debugger;
    var lCollArr = pResp.res.ficl01__FetchCollateralsService_Res.CollateralsList;
    apz.data.scrdata.ficl01__AddCreditLimit_Req = {};
    apz.data.scrdata.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimitCollaterals = lCollArr;
    //apz.data.loadData("AddCreditLimit", "ficl01");
    apz.data.getContainerData({
        "containerId": "ficl01__AddCreditLimit__tb_Colateral"
    })
}
apz.rowSelectorClicked = function(event) {
    debugger;
    var lRow = parseInt(event.currentTarget.id.split("_")[7]);
    if (event.currentTarget.checked) {
        $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimitCollaterals__margin_" + lRow).attr("disabled", false);
    } else {
        $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimitCollaterals__margin_" + lRow).attr("disabled", true);
    }
}
apz.app.postSelectAll = function(ficl01__AddCreditLimit__tb_Colateral_table) {
    apz.ficl01.AddCreditLimit.enDiInput();
}
apz.app.postUnSelectAll = function(ficl01__AddCreditLimit__tb_Colateral_table) {
    apz.ficl01.AddCreditLimit.enDiInput();
}
apz.ficl01.AddCreditLimit.enDiInput = function() {
    var tRec = apz.scrMetaData.containersMap['ficl01__AddCreditLimit__tb_Colateral'].totalRecs;
    for (var i = 0; i < tRec; i++) {
        if ($("#ficl01__AddCreditLimit__tb_Colateral_0").prop("checked") == true) {
            $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimitCollaterals__margin_" + i).attr("disabled", false);
        } else {
            $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimitCollaterals__margin_" + i).attr("disabled", true);
        }
    }
}
apz.ficl01.AddCreditLimit.fnCancel = function() {
    // apz.show("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__limitsHeaderRow");
    // apz.hide("ficl01__FCSummary__subScreenLauncher");
    // apz.ficl01.FCSummary.showCreditLimit();
    if(apz.ficl01.AddCreditLimit.sFrom == "taskflow"){
      apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    }else{
    apz.show("ficl01__CreditLimitsList__limHeader");
    apz.show("ficl01__CreditLimitsList__MoblimHeader");
    apz.show("ficl01__CreditLimitsList__limchart");
    apz.hide("ficl01__CreditLimitsList__subScreenLauncher");
    apz.show("ficl01__CreditLimitsList__limListRow");
    }
};
apz.ficl01.AddCreditLimit.saveDetails = function() {
    debugger;
    var proceed = true;
    var totalRec = apz.scrMetaData.containersMap['ficl01__AddCreditLimit__tb_Colateral'].totalRecs;
    for (var k = 0; k < totalRec; k++) {
        if ($("#ficl01__AddCreditLimit__tb_Colateral_selcb_" + k).prop("checked") == true && $(
            "#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimitCollaterals__margin_" + k).val() == "") {
            $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimitCollaterals__margin_" + k).addClass("err");
            proceed = false;
        } else {
            $("#ficl01__AddCreditLimit__i__tbDbmiCorpCreditLimitCollaterals__margin_" + k).removeClass("err");
        }
    }
    if (apz.val.validateContainer("ficl01__AddCreditLimit__clAddform") && proceed) {
        var lscreenData = apz.data.buildData("AddCreditLimit", "ficl01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "CLAC";
            //taskObj.stageId = "INPUT";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "NEW_LIMIT_REQUEST";
            taskObj.versionNo = "1";
            //taskObj.appId = "ficl01";
            //taskObj.screenId = "AddCreditLimit";
            //taskObj.screenData = JSON.stringify(lscreenData);
            taskObj.screenData = apz.ficl01.AddCreditLimit.getSelectedCollateral(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            taskObj.referenceId = lscreenData.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimit.corporateId + "__" + lscreenData.ficl01__AddCreditLimit_Req
                .tbDbmiCorpCreditLimit.limitType;
            taskObj.taskDesc = "New limit request has been added with referenceId" + taskObj.referenceId;
            //taskObj.createUserId = apz.Login.sUserId;
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.ficl01.AddCreditLimit.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "ficl01__AddCreditLimit__LaunchMicroService",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        } else {
            var lObj = {};
            lObj.scrData = {};
            lObj.currentWfDetails = {};
            //lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
            // lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
            // lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
             lObj.currentTask = "";
            lObj.currentWfDetails.screenData = apz.ficl01.AddCreditLimit.getSelectedCollateral(lscreenData);
            var lParams = {
                "appId": "ficl01",
                "scr": "AddCreditLimitCollateral",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    } else {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    }
};
apz.ficl01.AddCreditLimit.getSelectedCollateral = function(lscreenData) {
    var getScreenData = lscreenData;
    var colArr = [];
    var tRec = apz.scrMetaData.containersMap['ficl01__AddCreditLimit__tb_Colateral'].totalRecs;
    for (var i = 0; i < tRec; i++) {
        if ($("#ficl01__AddCreditLimit__tb_Colateral_selcb_" + i).prop("checked") == true) {
            colArr.push(lscreenData.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimitCollaterals[i]);
        }
    }
    getScreenData.ficl01__AddCreditLimit_Req.tbDbmiCorpCreditLimitCollaterals = colArr;
    return JSON.stringify(getScreenData);
}
apz.ficl01.AddCreditLimit.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "ficl01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
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
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
}
