apz.ficl01.AddCommitment = {};
apz.app.onLoad_AddCommitment = function(params) {
    debugger;
    apz.ficl01.AddCommitment.sCorporateId = apz.Login.sCorporateId;
    apz.ficl01.AddCommitment.sUserId = apz.Login.sUserId;
    apz.setElmValue("ficl01__AddCommitment__i__tbDbmiCorpCommitment__corporateId", apz.ficl01.AddCommitment.sCorporateId);
    apz.setElmValue("ficl01__AddCommitment__i__tbDbmiCorpCommitment__userId", apz.ficl01.AddCommitment.sUserId);
    apz.ficl01.AddCommitment.sFrom = params.from;
    apz.ficl01.AddCommitment.fetchLoanList();
};
apz.app.onShown_AddCommitment = function() {
    $(".adr-ctr").addClass("sno");
};
apz.ficl01.AddCommitment.fetchLoanList = function() {
    debugger;
    var req = {
        "tbDbmiCorpLoanMaster": {
            "corporateId": apz.Login.sCorporateId
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_loan_master";
    var lServerParams = {
        "ifaceName": "FetchAllLoan",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "N",
        "async": "true",
        "callBack": apz.ficl01.AddCommitment.fetchLoanListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}
apz.ficl01.AddCommitment.fetchLoanListCB = function(pResp) {
    debugger;
    var lLoanArr = pResp.res.ficl01__FetchAllLoan_Res.tbDbmiCorpLoanMaster;
    apz.data.scrdata.ficl01__AddCommitment_Req = {};
    apz.data.scrdata.ficl01__AddCommitment_Req.tbDbmiCorpCommitmentLoan = lLoanArr;
    //apz.data.loadData("AddCommitment", "ficl01");
    apz.data.getContainerData({
        "containerId": "ficl01__AddCommitment__tb_loan"
    })
}
apz.ficl01.AddCommitment.fnCancel = function() {
    // apz.show("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__limitsHeaderRow");
    // apz.hide("ficl01__FCSummary__subScreenLauncher");
    // apz.ficl01.FCSummary.showCommitment();
    if(apz.ficl01.AddCommitment.sFrom == "taskflow"){
      apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    }else{
    apz.show("ficl01__CommitmentList__commListRow");
    apz.hide("ficl01__CommitmentList__subScreenLauncher");
    apz.show("ficl01__CommitmentList__commHeader");
    apz.show("ficl01__CommitmentList__MobcommHeader");
    }
};
apz.ficl01.AddCommitment.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer("ficl01__AddCommitment__comAddform")) {
        var lscreenData = apz.data.buildData("AddCommitment", "ficl01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "COMM";
            //taskObj.stageId = "INPUT";
            taskObj.status = "U";
            //taskObj.userId = apz.Login.sUserId;
            taskObj.taskType = "NEW_COMM_REQUEST";
            taskObj.versionNo = "1";
            //taskObj.appId = "ficl01";
            //taskObj.screenId = "AddCommitment";
            // taskObj.screenData = JSON.stringify(lscreenData);
            taskObj.screenData = apz.ficl01.AddCommitment.getSelectedLoan(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            taskObj.referenceId = lscreenData.ficl01__AddCommitment_Req.tbDbmiCorpCommitment.corporateId + "__" + lscreenData.ficl01__AddCommitment_Req
                .tbDbmiCorpCommitment.typeofCommitment;
            taskObj.taskDesc = "New Commitment request has been added with referenceId" + taskObj.referenceId;
            //taskObj.createUserId = apz.Login.sUserId;
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.ficl01.AddCommitment.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            // lUserObj.taskVariables = [{
            //     "name": "CommitmentValue",
            //     "value": lscreenData.ficl01__AddCommitment_Req.tbDbmiCorpCommitment.totalCommitmentValue,
            //     "type": "Number"
            // }];
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "ficl01__AddCommitment__LaunchMicroService",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        } else {
            var lObj = {};
            lObj.currentWfDetails = {};
            lObj.scrData = {};
            //lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
            // lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
            // lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
            
             lObj.currentTask = "";
            lObj.currentWfDetails.screenData = apz.ficl01.AddCommitment.getSelectedLoan(lscreenData);
            var lParams = {
                "appId": "ficl01",
                "scr": "VerifyCommitment",
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
apz.ficl01.AddCommitment.getSelectedLoan = function(lscreenData) {
    debugger;
    var getScreenData = lscreenData;
    var loanArr = [];
    var tRec = apz.scrMetaData.containersMap['ficl01__AddCommitment__tb_loan'].totalRecs;
    for (var i = 0; i < tRec; i++) {
        if ($("#ficl01__AddCommitment__tb_loan_selcb_" + i).prop("checked") == true) {
            loanArr.push(lscreenData.ficl01__AddCommitment_Req.tbDbmiCorpCommitmentLoan[i]);
        }
    }
    getScreenData.ficl01__AddCommitment_Req.tbDbmiCorpCommitmentLoan = loanArr;
    return JSON.stringify(getScreenData);
}
apz.ficl01.AddCommitment.workflowMicroServiceCB = function(pRespObj) {
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
