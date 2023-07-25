apz.acep01.ModifyContact = {};
apz.acep01.ModifyContact.sDiv = "";
apz.app.onLoad_ModifyContact = function(params) {
    debugger;
    apz.acep01.ModifyContact.sCorporateId = apz.Login.sCorporateId;
    apz.acep01.ModifyContact.sUserId = apz.Login.sUserId;
    apz.acep01.ModifyContact.sDiv = params.div;
    apz.acep01.sContactsData = [];
    var lContactArr = [];
    var lContactArrLength = [];
    var lRecordNo = "";
    if (params.currentTask) {
        apz.acep01.ModifyContact.sCurrentTask = params.currentTask;
        apz.acep01.ModifyContact.sCurrentWfDetails = params.currentWfDetails;
        apz.acep01.ModifyContact.sDiv = params.div;
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).acep01__EntityContactModify_Req;
        lContactArr = lScreenData.tbDbmiCorporateContact;
        lContactArrLength = lContactArr.length;
        lRecordNo = lContactArrLength - 1;
        apz.data.scrdata.acep01__EntityContactModify_Req = {};
        apz.data.scrdata.acep01__EntityContactModify_Req.tbDbmiCorpEntityMaster = lScreenData.tbDbmiCorpEntityMaster;
        apz.data.scrdata.acep01__EntityContactModify_Req.tbDbmiCorporateContact = lContactArr[lRecordNo];
        apz.data.loadData("EntityContactModify", "acep01");
    } else {
        lRecordNo = params.recordNo;
        apz.data.scrdata.acep01__EntityContactModify_Req = {};
        apz.data.scrdata.acep01__EntityContactModify_Req.tbDbmiCorpEntityMaster = params.CorpContactMaster;
        apz.data.scrdata.acep01__EntityContactModify_Req.tbDbmiCorporateContact = params.CorpContactData[params.recordNo];
        /*$("#EntityContactModify_corporateId").text(params.CorpContactMaster.corporateId);
    $("#EntityContactModify_customerId").text(params.CorpContactMaster.customerId);
    $("#EntityContactModify_entityId").text(params.CorpContactMaster.entityId);
    $("#EntityContactModify_entityName").text(params.CorpContactMaster.entityName);
    */
        apz.data.loadData("EntityContactModify", "acep01");
        lContactArr = params.CorpContactData;
        lContactArrLength = lContactArr.length;
    }
    // var lContactsLength = params.CorpContactData.length;
    for (var i = 0; i < lContactArrLength; i++) {
        if (i != lRecordNo) {
            apz.acep01.sContactsData.push(lContactArr[i]);
        }
    }
};
apz.acep01.ModifyContact.conatctSave = function() {
    if (apz.val.validateContainer('acep01__ModifyContact__Modify_Contact')) {
        var lScreenData = apz.data.buildData("EntityContactModify", "acep01");
        var lEntityMaster = lScreenData.acep01__EntityContactModify_Req.tbDbmiCorpEntityMaster;
        apz.acep01.sContactsData.push(lScreenData.acep01__EntityContactModify_Req.tbDbmiCorporateContact);
        lScreenData.acep01__EntityContactModify_Req.tbDbmiCorporateContact = apz.acep01.sContactsData;
        if (apz.acep01.ModifyContact.sCurrentTask) {
            var lUserObj = {};
            lUserObj.currentTask = apz.acep01.ModifyContact.sCurrentTask;
            lUserObj.currentWfDetails = apz.acep01.ModifyContact.sCurrentWfDetails;
            lUserObj.currentWfDetails.screenData = JSON.stringify(lScreenData);
            lUserObj.callBack = apz.acep01.ModifyContact.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        } else {
            var taskObj = {};
            taskObj.workflowId = "EPMC";
            taskObj.taskType = "MODIFY_ENTITY_CONTACT";
            taskObj.versionNo = "1";
            taskObj.currentStage = "SUBMIT";
            taskObj.nextStage = "APPROVE";
            taskObj.interfaceId = "WorkFlowDetails";
            taskObj.screenData = JSON.stringify(lScreenData);
            taskObj.action = "";
            taskObj.referenceId = lEntityMaster.corporateId + "__" + lEntityMaster.entityId;
            taskObj.taskDesc = taskObj.referenceId + " Contacts has been edited";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acep01.ModifyContact.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
        }
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acep01__ModifyContact__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": 'CONT_MIS'
        };
        apz.dispMsg(msg);
    }
};
apz.acep01.ModifyContact.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acep01.ModifyContact.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acep01.ModifyContact.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": lObj.currentWfDetails.screenId,
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
    // "div": "acep01__CorporateHierarchy__LaunchScreen",
    /*apz.currAppId = "acep01";
    var msg = {
        "code": 'acep_CONTACTSUCS',
        "callBack": apz.acep01.ModifyContact.Cancel
    };
    apz.dispMsg(msg);
    */
};
apz.acep01.ModifyContact.Cancel = function() {
    debugger;
    $("#acep01__EntityDetails__LaunchScreen").addClass("sno");
    $("#acep01__EntityDetails__EntityDetailsRow").removeClass("sno");
    $("#acep01__EntityDetails__Entity_Detail_Header").removeClass('sno');
    $("#acep01__EntityDetails__EntityDetails_Sub_Header").removeClass('sno');
    $("#acep01__EntityDetails__Back_Btn_Row").removeClass('sno');
};
apz.app.postCreateRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acep01__ModifyContact__Modify_Contact") {
        var lRecordNo = $("#acep01__ModifyContact__Modify_Contact_cr").val();
        if (lRecordNo) {
            apz.data.scrdata.acep01__EntityContactModify_Req.tbDbmiCorporateContact[lRecordNo - 1].corporateId = apz.acep01.ModifyContact.sCorporateId;
        }
    }
};
apz.app.preChangeRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acep01__ModifyContact__Modify_Contact") {
        if (!apz.val.validateContainer('acep01__ModifyContact__Modify_Contact')) {
            var msg = {
                "code": 'CONT_MIS'
            };
            apz.dispMsg(msg);
            return false;
        }
    }
};