apz.acpr01.ModifyAddress = {};
apz.acpr01.ModifyAddress.sDiv = "";
apz.app.onLoad_ModifyAddress = function(params) {
    apz.acpr01.ModifyAddress.sUserId = apz.Login.sUserId;
    apz.acpr01.ModifyAddress.sDiv = params.div;
    apz.acpr01.sAddressData = [];
    var lAddressArr = [];
    var lAddressArrLength = [];
    var lRecordNo = "";
    if (params.currentTask) {
        apz.acpr01.ModifyAddress.sCurrentTask = params.currentTask;
        apz.acpr01.ModifyAddress.sCurrentWfDetails = params.currentWfDetails;
        apz.acpr01.ModifyAddress.sDiv = params.div;
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).acpr01__CorporateAddressModify_Req;
        lAddressArr = lScreenData.tbDbmiCorporateAddress;
        lAddressArrLength = lAddressArr.length;
        lRecordNo = lAddressArrLength - 1;
        apz.data.scrdata.acpr01__CorporateAddressModify_Req = {};
        apz.data.scrdata.acpr01__CorporateAddressModify_Req.tbDbmiCorporateMaster = lScreenData.tbDbmiCorporateMaster;
        apz.data.scrdata.acpr01__CorporateAddressModify_Req.tbDbmiCorporateAddress = lAddressArr[lRecordNo];
        apz.data.loadData("CorporateAddressModify", "acpr01");
    } else {
        lRecordNo = params.recordNo;
        apz.data.scrdata.acpr01__CorporateAddressModify_Req = {};
        apz.data.scrdata.acpr01__CorporateAddressModify_Req.tbDbmiCorporateMaster = params.CorpMasterData;
        apz.data.scrdata.acpr01__CorporateAddressModify_Req.tbDbmiCorporateAddress = params.CorpAddressData[lRecordNo];
        apz.data.loadData("CorporateAddressModify", "acpr01");
        lAddressArr = params.CorpAddressData;
        lAddressArrLength = lAddressArr.length;
    }
    for (var i = 0; i < lAddressArrLength; i++) {
        if (i != lRecordNo) {
            apz.acpr01.sAddressData.push(lAddressArr[i]);
        }
    }
};
apz.acpr01.ModifyAddress.addressSave = function() {
    if (apz.val.validateContainer('acpr01__ModifyAddress__ModifyAddressForm') == false) {
        var msg = {
            "code": 'ADDR_MIS'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("CorporateAddressModify", "acpr01");
        apz.acpr01.sAddressData.push(lscreenData.acpr01__CorporateAddressModify_Req.tbDbmiCorporateAddress);
        lscreenData.acpr01__CorporateAddressModify_Req.tbDbmiCorporateAddress = apz.acpr01.sAddressData;
        if (apz.acpr01.ModifyAddress.sCurrentTask) {
            var lUserObj = {};
            lUserObj.currentTask = apz.acpr01.ModifyAddress.sCurrentTask;
            lUserObj.currentWfDetails = apz.acpr01.ModifyAddress.sCurrentWfDetails;
            lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lUserObj.callBack = apz.acpr01.ModifyAddress.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        } else {
            var taskObj = {};
            taskObj.workflowId = "CPMA";
            taskObj.screenData = JSON.stringify(lscreenData);
            taskObj.referenceId = lscreenData.acpr01__CorporateAddressModify_Req.tbDbmiCorporateMaster.corporateId;
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acpr01.ModifyAddress.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
        }
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acpr01__ModifyAddress__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    }
};
apz.acpr01.ModifyAddress.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acpr01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acpr01.ModifyAddress.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acpr01.ModifyAddress.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acpr01.ModifyAddress.sDiv,
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
};
apz.acpr01.ModifyAddress.Confirmation = function() {
    debugger;
    $("#acpr01__CorporateInfo__ProfileMain").removeClass("sno");
    $("#acpr01__CorporateInfo__ModifyScreen").addClass("sno");
};
apz.acpr01.ModifyAddress.Cancel = function() {
    debugger;
    $("#acpr01__CorporateInfo__ProfileMain").removeClass("sno");
    $("#acpr01__CorporateInfo__ModifyScreen").addClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Main_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__Corporate_Sub_Header").removeClass("sno");
    $("#acpr01__CorporateInfo__RegistrationDetails").removeClass("sno");
};
apz.app.postCreateRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acpr01__ModifyAddress__ModifyAddressForm") {
        var lRecordNo = $("#acpr01__ModifyAddress__ModifyAddressForm_cr").val();
        if (lRecordNo) {
            apz.data.scrdata.acpr01__CorporateAddressModify_Req.tbDbmiCorporateAddress[lRecordNo - 1].corporateId = apz.acpr01.CorporateInfo.sCorporateId;
        }
    }
};
apz.app.preChangeRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acpr01__ModifyAddress__ModifyAddressForm") {
        if (!apz.val.validateContainer('acpr01__ModifyAddress__ModifyAddressForm')) {
            var msg = {
                "code": 'ADDR_MIS'
            };
            apz.dispMsg(msg);
            return false;
        }
    }
};
