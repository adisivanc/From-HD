apz.acep01.ModifyAddress = {};
apz.acep01.ModifyAddress.sDiv = "";
apz.app.onLoad_ModifyAddress = function(params) {
    debugger;
    apz.acep01.ModifyAddress.sUserId = apz.Login.sUserId;
    apz.acep01.ModifyAddress.sCorporateId = apz.Login.sCorporateId;
    apz.acep01.ModifyAddress.sDiv = params.div;
    apz.acep01.sAddressData = [];
    var lAddressArr = [];
    var lAddressArrLength = [];
    var lRecordNo = "";
    if (params.currentTask) {
        apz.acep01.ModifyAddress.sCurrentTask = params.currentTask;
        apz.acep01.ModifyAddress.sCurrentWfDetails = params.currentWfDetails;
        apz.acep01.ModifyAddress.sDiv = params.div;
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).acep01__EntityAddressModify_Req;
        lAddressArr = lScreenData.tbDbmiCorporateAddress;
        lAddressArrLength = lAddressArr.length;
        lRecordNo = lAddressArrLength - 1;
        apz.data.scrdata.acep01__EntityAddressModify_Req = {};
        apz.data.scrdata.acep01__EntityAddressModify_Req.tbDbmiCorpEntityMaster = lScreenData.tbDbmiCorpEntityMaster;
        apz.data.scrdata.acep01__EntityAddressModify_Req.tbDbmiCorporateAddress = lAddressArr[lRecordNo];
        apz.data.loadData("EntityAddressModify", "acep01");
    } else {
        lRecordNo = params.recordNo;
        apz.data.scrdata.acep01__EntityAddressModify_Req = {};
        apz.data.scrdata.acep01__EntityAddressModify_Req.tbDbmiCorpEntityMaster = params.CorpAddressMaster;
        apz.data.scrdata.acep01__EntityAddressModify_Req.tbDbmiCorporateAddress = params.CorpAddressData[params.recordNo];
        apz.data.loadData("EntityAddressModify", "acep01");
        lAddressArr = params.CorpAddressData;
        lAddressArrLength = lAddressArr.length;
    }
    //var lAddressLength = params.CorpAddressData.length;
    for (var i = 0; i < lAddressArrLength; i++) {
        if (i != lRecordNo) {
            apz.acep01.sAddressData.push(lAddressArr[i]);
        }
    }
};
apz.acep01.ModifyAddress.addressSave = function() {
    if (apz.val.validateContainer('acep01__ModifyAddress__CorpAddressModify')) {
        var lScreenData = apz.data.buildData("EntityAddressModify", "acep01");
        var lEntityMaster = lScreenData.acep01__EntityAddressModify_Req.tbDbmiCorpEntityMaster;
        apz.acep01.sAddressData.push(lScreenData.acep01__EntityAddressModify_Req.tbDbmiCorporateAddress);
        lScreenData.acep01__EntityAddressModify_Req.tbDbmiCorporateAddress = apz.acep01.sAddressData;
        if (apz.acep01.ModifyAddress.sCurrentTask) {
            var lUserObj = {};
            lUserObj.currentTask = apz.acep01.ModifyAddress.sCurrentTask;
            lUserObj.currentWfDetails = apz.acep01.ModifyAddress.sCurrentWfDetails;
            lUserObj.currentWfDetails.screenData = JSON.stringify(lScreenData);
            lUserObj.callBack = apz.acep01.ModifyAddress.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        } else {
            var taskObj = {};
            taskObj.workflowId = "EPMA";
            taskObj.taskType = "MODIFY_ENTITY_ADDRESS";
            taskObj.versionNo = "1";
            taskObj.screenData = JSON.stringify(lScreenData);
            taskObj.action = "";
            taskObj.referenceId = lEntityMaster.corporateId + "__" + lEntityMaster.entityId;
            taskObj.taskDesc = taskObj.referenceId + " Address has been edited";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acep01.ModifyAddress.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
        }
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acep01__ModifyAddress__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": 'ADDR_MIS'
        };
        apz.dispMsg(msg);
    }
};
apz.acep01.ModifyAddress.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acep01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acep01.ModifyAddress.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acep01.ModifyAddress.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acep01.ModifyAddress.sDiv,
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
    /*var msg = {
        "code": 'acep_ADDSUCSS',
        "callBack": apz.acep01.ModifyAddress.Cancel
    };
    apz.dispMsg(msg);
    */
};
apz.acep01.ModifyAddress.Cancel = function() {
    debugger;
    $("#acep01__EntityDetails__LaunchScreen").addClass("sno");
    $("#acep01__EntityDetails__EntityDetailsRow").removeClass("sno");
    $("#acep01__EntityDetails__Entity_Detail_Header").removeClass('sno');
    $("#acep01__EntityDetails__EntityDetails_Sub_Header").removeClass('sno');
    $("#acep01__EntityDetails__Back_Btn_Row").removeClass('sno');
};
apz.app.postCreateRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acep01__ModifyAddress__CorpAddressModify") {
        var lRecordNo = $("#acep01__ModifyAddress__CorpAddressModify_cr").val();
        if (lRecordNo) {
            apz.data.scrdata.acep01__EntityAddressModify_Req.tbDbmiCorporateAddress[lRecordNo - 1].corporateId = apz.acep01.ModifyAddress.sCorporateId;
        }
    }
};
apz.app.preChangeRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acep01__ModifyAddress__CorpAddressModify") {
        if (!apz.val.validateContainer('acep01__ModifyAddress__CorpAddressModify')) {
            var msg = {
                "code": 'ADDR_MIS'
            };
            apz.dispMsg(msg);
            return false;
        }
    }
};