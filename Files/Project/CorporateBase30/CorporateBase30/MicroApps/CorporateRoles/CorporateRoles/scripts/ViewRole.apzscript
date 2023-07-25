apz.acrl01.ViewRole = {};
apz.acrl01.ViewRole.sCurrentTask = {};
apz.acrl01.ViewRole.sCurrentWfDetails = {};
apz.app.onLoad_ViewRole = function(params) {
    debugger;
    apz.acrl01.ViewRole.sCorporateId = apz.Login.sCorporateId;
    apz.acrl01.ViewRole.sCurrentTask = {};
    apz.acrl01.ViewRole.sCurrentWfDetails = {};
    apz.acrl01.ViewRole.sCurrentTask = params.currentTask;
    apz.acrl01.ViewRole.sCurrentWfDetails = params.currentWfDetails;
    apz.acrl01.ViewRole.sDiv = params.div;
    var lScrData = JSON.parse(params.currentWfDetails.screenData);
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req = {};
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster = lScrData.tbDbmiCorpRoleMaster;
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity = lScrData.tbDbmiCorpRoleEntity;
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount = lScrData.tbDbmiCorpRoleAccount;
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleFiles = lScrData.tbDbmiCorpRoleFiles;
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleOperations = lScrData.tbDbmiCorpRoleOperations;
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleScr = lScrData.tbDbmiCorpRoleScr;
    apz.data.loadData("RoleDetailsDummy", "acrl01");
    $("#acrl01__ViewRole__Entities_List_row_0").trigger("click");
};
apz.app.onShown_ViewRole = function() {
    apz.acrl01.ViewRole.fetchEntityHierarchy();
    setTimeout(function() {
        apz.acrl01.ViewRole.showSelectedEntities();
    }, 10);
};
apz.acrl01.ViewRole.viewEntityDetails = function(pObj) {
    debugger;
    $(pObj).parent().find(".selected").removeClass("selected");
    $(pObj).addClass("selected");
    var lEntityId = $(pObj).find('.entity').text();
    var lAuthlmt = $(pObj).find('.authLmt').text();
    var lTxnlmt = $(pObj).find('.txnLmt').text();
    $("#acrl01__ViewRole__txn_limit").val(lTxnlmt);
    $("#acrl01__ViewRole__auth_limit").val(lAuthlmt);
    apz.data.scrdata.acrl01__RoleAccountsDummy_Req = {};
    apz.data.scrdata.acrl01__RoleAccountsDummy_Req.tbDbmiCorpRoleAccount = [];
    var lEntityAccArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount;
    //var lEntityAccArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount;
    var lEntityAccArrLength = lEntityAccArr.length;
    for (var i = 0; i < lEntityAccArrLength; i++) {
        if (lEntityAccArr[i].entityId == lEntityId) {
            apz.data.scrdata.acrl01__RoleAccountsDummy_Req.tbDbmiCorpRoleAccount.push(lEntityAccArr[i]);
        }
    }
    apz.data.loadData("RoleAccountsDummy", "acrl01");
};
apz.acrl01.ViewRole.Approve = function() {
    debugger;
    if (!apz.mockServer) {
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acrl01__ViewRole__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acrl01.ViewRole.sCurrentTask,
                "currentWfDetails": apz.acrl01.ViewRole.sCurrentWfDetails,
                "callBack": apz.acrl01.ViewRole.approveCB,
                "taskVariables": [{
                    "name": "action",
                    "value": "approve",
                    "type": "String"
                }]
            }
        };
        apz.launchApp(lParams);
    } else {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": "CPMR000FTAC4321"
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acrl01.ViewRole.approveCB = function(pRespObj) {
    debugger;
    apz.currAppId = 'acrl01';
    apz.acrl01.ViewRole.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acrl01.ViewRole.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "", //should check
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
        } else {
            apz.acrl01.ViewRole.deleteRoleData();
        }
    }
};
apz.acrl01.ViewRole.deleteRoleData = function() {
    var lServerParams = {
        "ifaceName": "RoleDelete_Delete",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acrl01.ViewRole.deleteRoleDataCB,
        "callBackObj": "",
    };
    var lRoleId = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.roleId;
    var lCorporateId = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.corporateId;
    var req = {};
    req.tbDbmiCorpRoleMaster = {};
    req.tbDbmiCorpRoleMaster.corporateId = lCorporateId;
    req.tbDbmiCorpRoleMaster.roleId = lRoleId;
    req.tbAsmiRoleMaster = {};
    req.tbAsmiRoleMaster.appId = "acbase";
    req.tbAsmiRoleMaster.roleId = lCorporateId + "__" + lRoleId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
//Added by Rahul
var getWithDistinctRecords = function(jsonObj) {
    let sortedArray = [];
    jsonObj.forEach(function(obj) {
        let dataArray = $.grep(sortedArray, function(element, index) {
            let bol = true;
            if (element['description'] == obj['groupName']) tt = true;
            else bol = false;
            return bol;
        });
        if (dataArray.length == 0) {
            sortedArray.push({
                appId: "dummy",
                corporateId: obj.corporateId,
                description: obj.groupName,
                displayOrder: obj.displayOrder,
                groupIcon: "",
                groupName: "",
                icon: obj.groupIcon,
                roleId: obj.roleId,
                screenId: "dummy" + obj.displayOrder
            });
        }
    });
    return sortedArray.concat(jsonObj);
}
apz.acrl01.ViewRole.deleteRoleDataCB = function(pResp) {
    if (pResp.errors == undefined || pResp.errors[0].errorCode == "APZ_FM_EX_041") {
        var lServerParams = {
            "ifaceName": "RoleInsert_New",
            "buildReq": "N",
            "req": "",
            "paintResp": "Y",
            "async": "true",
            "callBack": apz.acrl01.ViewRole.insertRoleDataCB,
            "callBackObj": "",
        };
        var req = {};
        req.tbDbmiCorpRoleMaster = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster;
        req.tbDbmiCorpRoleEntity = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
        req.tbDbmiCorpRoleAccount = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount;
        req.tbDbmiCorpRoleFiles = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleFiles;
        req.tbDbmiCorpRoleOperations = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleOperations;
        req.tbDbmiCorpRoleScr = getWithDistinctRecords(apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleScr);
        req.tbAsmiRoleMaster = {};
        req.tbAsmiRoleMaster.roleId = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.corporateId + "__" + apz.data.scrdata.acrl01__RoleDetailsDummy_Req
            .tbDbmiCorpRoleMaster.roleId;
        //req.tbAsmiRoleMaster.appId = "acrl01";
        req.tbAsmiRoleMaster.appId = "acbase";
        req.tbAsmiRoleMaster.roleDesc = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.roleDescription;
        req.tbAsmiRoleMaster.makerId = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.makerId;
        req.tbAsmiRoleMaster.makerTs = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.makerTs;
        req.tbAsmiRoleMaster.checkerId = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.checkerId;
        req.tbAsmiRoleMaster.checkerTs = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.checkerTs;
        req.tbAsmiRoleMaster.interfaceAllowed = "A";
        req.tbAsmiRoleMaster.screenAllowed = "A";
        req.tbAsmiRoleMaster.controlAllowed = "A";
        req.tbAsmiRoleMaster.authStatus = "A";
        req.tbAsmiRoleMaster.versionNo = 1;
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acrl01.ViewRole.insertRoleDataCB = function(pResp) {
    if (!pResp.errors) {
        debugger;
        // admin table operations
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acrl01__ViewRole__LaunchMicroServiceHere",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "operation": "NEXTTASK",
                "currentTask": apz.acrl01.ViewRole.sCurrentTask,
                "currentWfDetails": apz.acrl01.ViewRole.sCurrentWfDetails,
                "callBack": apz.acrl01.ViewRole.submitCB
            }
        };
        apz.launchApp(lParams);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acrl01.ViewRole.submitCB = function(pRespObj) {
    apz.currAppId = "acrl01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "", // have to check.
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {}
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
};
apz.acrl01.ViewRole.Reject = function() {
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acrl01__ViewRole__LaunchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "NEXTTASK",
    //         "currentTask": apz.acrl01.ViewRole.sCurrentTask,
    //         "currentWfDetails": apz.acrl01.ViewRole.sCurrentWfDetails,
    //         "callBack": apz.acrl01.ViewRole.rejectCB,
    //         "taskVariables": [{
    //             "name": "status",
    //             "value": "reject",
    //             "type": "String"
    //         }]
    //     }
    // };
    // apz.launchApp(lParams);
    $("#acrl01__ViewRole__RejectReason_Form").removeClass('sno');
    $("#acrl01__ViewRole__Reject_Reason_Confirm").removeClass('sno');
    $("#acrl01__ViewRole__ApproveRejectNav").addClass('sno');
};
apz.acrl01.ViewRole.cancelReject = function() {
    debugger;
    $("#acrl01__ViewRole__RejectReason_Form").addClass('sno');
    $("#acrl01__ViewRole__Reject_Reason_Confirm").addClass('sno');
    $("#acrl01__ViewRole__ApproveRejectNav").removeClass('sno');
}
apz.acrl01.ViewRole.confirmReject = function() {
    debugger;
    //apz.acpr01.ownAccountApprove.sCurrentTask = {};
    //apz.acpr01.ownAccountApprove.sCurrentWfDetails = {};
    var lRejectReason = apz.getElmValue('acrl01__ViewRole__reject_reason');
    apz.acrl01.ViewRole.sCurrentTask.remarks = lRejectReason;
    apz.acrl01.ViewRole.sCurrentWfDetails.remarks = lRejectReason;
    
    if(!apz.mockServer){
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acrl01__ViewRole__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acrl01.ViewRole.sCurrentTask,
            "currentWfDetails": apz.acrl01.ViewRole.sCurrentWfDetails,
            "callBack": apz.acrl01.ViewRole.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
    }
    
    else {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": "ACNR01__Navigator__launchPad",
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": "CPMR000FTAC4321"
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acrl01.ViewRole.rejectCB = function(pRespObj) {
    apz.currAppId = "acrl01";
    apz.acrl01.ViewRole.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acrl01.ViewRole.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acrl01.ViewRole.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acrl01.ViewRole.sDiv, // have to check.
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
        } else {}
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acrl01.ViewRole.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acrl01.ViewRole.showSelectedEntities = function() {
    debugger;
    if (apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity != undefined && apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity
        .length != 0) {
        var lEntityArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
        var lEntityLen = lEntityArr.length;
        var lNodes = $("#acrl01__ViewRole__drag_node_loader").find(".node");
        var lNodesLength = lNodes.length;
        for (var i = 0; i < lEntityLen; i++) {
            var Entity = lEntityArr[i].entityId;
            for (var j = 0; j < lNodesLength; j++) {
                var lEntityId = $(lNodes[j]).attr('node-id');
                if (Entity == lEntityId) {
                    $(lNodes[j]).toggleClass('selnode');
                }
            }
        };
    }
};
apz.acrl01.ViewRole.fetchEntityHierarchy = function() {
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "CorporateHierarchy_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acrl01.ViewRole.fetchEntityHierarchyCB,
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acrl01.ViewRole.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acrl01.ViewRole.fetchEntityHierarchyCB = function(pResp) {
    var lDataSource = pResp.resFull.appzillonBody.acrl01__CorporateHierarchy_Res.tbDbmiCorpEntityMaster;
    var lArrLength = lDataSource.length;
    var lChartArr = [];
    for (var i = 0; i < lArrLength; i++) {
        var lObj = {};
        lObj.id = lDataSource[i].entityId;
        lObj.name = lDataSource[i].entityName + "<br><h3>" + lDataSource[i].entityId + "</h3>";;
        lObj.parent = lDataSource[i].parentEntity;
        lChartArr.push(lObj);
    }
    $(function() {
        org_chart = $('#acrl01__ViewRole__drag_node_loader').orgChart({
            data: lChartArr, // your data
            showControls: false, // display add or remove node button.
            allowEdit: false, // click the node's title to edit
            onAddNode: function(node) {},
            onDeleteNode: function(node) {},
            onClickNode: function(node) {},
            newNodeText: 'Add Child' // text of add button
        });
    });
};