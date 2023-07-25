apz.acus01.ViewUser = {};
apz.acus01.ViewUser.sCurrentTask = {};
apz.acus01.ViewUser.sCurrentWfDetails = {};
apz.acus01.ViewUser.sDiv = "";
apz.acus01.ViewUser.base64Str = "";
apz.app.onLoad_ViewUser = function(params) {
    debugger;
    apz.acus01.ViewUser.sCurrentTask = params.currentTask;
    apz.acus01.ViewUser.sCurrentWfDetails = params.currentWfDetails;
    apz.acus01.ViewUser.sDiv = params.div;
    apz.data.scrdata.acus01__UserDetails_Req = params.scrData.acus01__UserDetails_Req;
    apz.data.loadData("UserDetails", "acus01");
    var lName = params.scrData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.firstName + " " + params.scrData.acus01__UserDetails_Req.tbDbmiCorpUserMaster
        .lastName;
    apz.setElmValue("acus01__ViewUser__username", lName);
    apz.acus01.ViewUser.viewUserPersona();
};
apz.app.onShown_ViewUser = function() {
    try {
        if (apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.logo == undefined || apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster
            .logo == "") {
            $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__logo").attr("src", 'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
        } else {
            var blob = convertBase64toBlob(apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.logo);
            var blobUrl = URL.createObjectURL(blob);
            $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__logo").attr("src", blobUrl);
        }
    } catch (e) {
        $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__logo").attr("src", 'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
    }
}
apz.acus01.ViewUser.Approve = function() {
    var lUserObj = {};
    lUserObj.currentTask = apz.acus01.ViewUser.sCurrentTask;
    lUserObj.currentWfDetails = apz.acus01.ViewUser.sCurrentWfDetails;
    lUserObj.callBack = apz.acus01.ViewUser.fnApproveCB;
    lUserObj.operation = "NEXTTASK";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acus01__ViewUser__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
};
apz.acus01.ViewUser.fnApproveCB = function(pResp) {
    debugger;
    if (pResp.tbDbmiWorkflowMaster.stageType == "SERVICETASK") {
        var lServerParams = {
            "ifaceName": "DeleteUser_Delete",
            "buildReq": "N",
            "appId": "acus01",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.acus01.ViewUser.deleteUserDataCB,
            "callBackObj": "",
        };
        var lUserId = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.userId;
        var lCorporateId = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.corporateId;
        var req = {};
        req.tbDbmiCorpUserMaster = {};
        req.tbDbmiCorpUserMaster.corporateId = lCorporateId;
        req.tbDbmiCorpUserMaster.userId = lUserId;
        lServerParams.req = req;
        apz.server.callServer(lServerParams);
    }
};
apz.acus01.ViewUser.deleteUserDataCB = function(pResp) {
    debugger;
    var lServerParams = {
        "ifaceName": "NewUser_New",
        "buildReq": "N",
        "appId": "acus01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.ViewUser.insertUserDataCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserMaster = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster;
    req.tbDbmiCorpUserRole = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserRole;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acus01.ViewUser.Reject = function() {
    debugger;
    // var lParams = {
    //     "appId": "acwf01",
    //     "scr": "WorkFlow",
    //     "div": "acus01__ViewUser__LaunchMicroServiceHere",
    //     "layout": "All",
    //     "type": "CF",
    //     "userObj": {
    //         "operation": "Reject",
    //         "currentTask": apz.acus01.ViewUser.sCurrentTask,
    //         "currentWfDetails": apz.acus01.ViewUser.sCurrentWfDetails,
    //         "callBack": apz.acus01.ViewUser.rejectCB
    //     }
    // };
    // apz.launchApp(lParams);
    $("#acus01__ViewUser__RejectReason_Form").removeClass('sno');
    $("#acus01__ViewUser__Reject_Reason_Confirm").removeClass('sno');
    $("#acus01__ViewUser__ApproveRejectNav").addClass('sno');
};
apz.acus01.ViewUser.cancelReject = function() {
    debugger;
    $("#acus01__ViewUser__RejectReason_Form").addClass('sno');
    $("#acus01__ViewUser__Reject_Reason_Confirm").addClass('sno');
    $("#acus01__ViewUser__ApproveRejectNav").removeClass('sno');
}
apz.acus01.ViewUser.confirmReject = function() {
    debugger;
    var lRejectReason = apz.getElmValue('acus01__ViewUser__reject_reason');
    apz.acus01.ViewUser.sCurrentTask.remarks = lRejectReason;
    apz.acus01.ViewUser.sCurrentWfDetails.remarks = lRejectReason;
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acus01__ViewUser__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acus01.ViewUser.sCurrentTask,
            "currentWfDetails": apz.acus01.ViewUser.sCurrentWfDetails,
            "callBack": apz.acus01.ViewUser.rejectCB,
            "taskVariables": [{
                "name": "action",
                "value": "reject",
                "type": "String"
            }]
        }
    };
    apz.launchApp(lParams);
};
apz.acus01.ViewUser.rejectCB = function(pRespObj) {
    apz.currAppId = "acus01";
    // var msg = {
    //     "code": 'acus_Reject'
    // };
    // apz.dispMsg(msg);
    apz.acus01.ViewUser.sCurrentTask = pRespObj.tbDbmiWorkflowMaster;
    apz.acus01.ViewUser.sCurrentWfDetails = pRespObj.tbDbmiWorkflowDetail;
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acus01.ViewUser.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acus01.ViewUser.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": apz.acus01.ViewUser.sDiv,
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
                    }
                };
                apz.launchApp(lParams);
            }
        } else {}
    } else if (pRespObj.tbDbmiWorkflowMaster.status == "COMPLETED") {
        var lParams = {
            "appId": "tscm01",
            "scr": "TaskCompleted",
            "div": apz.acus01.ViewUser.sDiv,
            "layout": "All",
            "type": "CF",
            "userObj": {
                "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
            }
        };
        apz.launchApp(lParams);
    }
};
apz.acus01.ViewUser.insertUserDataCB = function(pResp) {
    debugger;
    var req = {};
    req.appzillonCreateUserRequest = {};
    req.appzillonCreateUserRequest.userId = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.corporateId + "__" + apz.data.scrdata.acus01__UserDetails_Req
        .tbDbmiCorpUserMaster.userId;
    req.appzillonCreateUserRequest.userName = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.firstName + " " + apz.data.scrdata.acus01__UserDetails_Req
        .tbDbmiCorpUserMaster.lastName;
    req.appzillonCreateUserRequest.password = "";
    req.appzillonCreateUserRequest.appId = "acbase";
    req.appzillonCreateUserRequest.language = "en";
    req.appzillonCreateUserRequest.profilePic = apz.acus01.ViewUser.base64Str;
    req.appzillonCreateUserRequest.email1 = apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__emailId");
    req.appzillonCreateUserRequest.phone1 = apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__phNo");
    req.appzillonCreateUserRequest.addr1 = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.address1;
    req.appzillonCreateUserRequest.addr2 = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.address2;
    req.appzillonCreateUserRequest.addr3 = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.address3;
    req.appzillonCreateUserRequest.addr4 = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.address4;
    req.appzillonCreateUserRequest.loginStatus = 'N';
    req.appzillonCreateUserRequest.userLocked = 'N';
    req.appzillonCreateUserRequest.authStat = 'A';
    req.appzillonCreateUserRequest.Devices = [{
        "deviceId": "SIMULATOR",
        "status": "ACTIVE",
        "userId": req.appzillonCreateUserRequest.userId,
        "appId": "acbase"
    }, {
        "deviceId": "WEB",
        "status": "ACTIVE",
        "userId": req.appzillonCreateUserRequest.userId,
        "appId": "acbase"
    }];
    req.appzillonCreateUserRequest.roles = [];
    var lRoles = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserRole;
    var lRolesLength = apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserRole.length
    for (var v = 0; v < lRolesLength; v++) {
        req.appzillonCreateUserRequest.roles.push({
            'roleId': apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.corporateId + "__" + lRoles[v].roleId,
            'userId': req.appzillonCreateUserRequest.userId,
            'appId': "acbase"
        });
    }
    debugger;
    if (apz.acus01.ViewUser.sCurrentTask.workflowId == "CUNU") {
        var params = {};
        params.callBackObj = this;
        params.buildReq = 'N';
        params.paintResp = 'Y';
        params.req = req;
        params.ifaceName = 'appzillonCreateUser';
        params.async = true;
        params.callBack = apz.acus01.ViewUser.UserDetailsCB;
        params.callBackObj = {
            "userId": req.appzillonCreateUserRequest.userId
        }
        params.internal = true;
    } else if (apz.acus01.ViewUser.sCurrentTask.workflowId == "CUMU") {
        var lReq = {};
        lReq.appzillonUpdateUserRequest = req.appzillonCreateUserRequest;
        var params = {};
        params.callBackObj = this;
        params.buildReq = 'N';
        params.paintResp = 'Y';
        params.req = lReq;
        params.ifaceName = 'appzillonUpdateUser';
        params.async = true;
        params.callBack = apz.acus01.ViewUser.UserDetailsCB;
        params.callBackObj = {
            "userId": req.appzillonCreateUserRequest.userId
        }
        params.internal = true;
    };
    apz.server.sendReq(params);
};
apz.acus01.ViewUser.UserDetailsCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        debugger;
        var request = {};
        var params = {};
        request.appzillonUserAuthorizationRequest = {};
        request.appzillonUserAuthorizationRequest.appId = "acbase";
        request.appzillonUserAuthorizationRequest.userId = pResp.callBackObj.userId;
        request.appzillonUserAuthorizationRequest.authStat = "A";
        params.callBackObj = this;
        params.buildReq = "N";
        params.paintResp = "N";
        params.req = request;
        params.ifaceName = "appzillonUserAuthorization";
        params.async = true;
        params.callBack = apz.acus01.ViewUser.authenticateUserCB;
        params.internal = true;
        apz.server.sendReq(params);
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acus01.ViewUser.authenticateUserCB = function(pResp) {
    debugger;
    //if (!pResp.errors) {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acus01__ViewUser__LaunchMicroServiceHere",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "operation": "NEXTTASK",
            "currentTask": apz.acus01.ViewUser.sCurrentTask,
            "currentWfDetails": apz.acus01.ViewUser.sCurrentWfDetails,
            "callBack": apz.acus01.ViewUser.approveCB
        }
    };
    apz.launchApp(lParams);
    /* }
   
     else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
    */
}
apz.acus01.ViewUser.approveCB = function(pRespObj) {
    debugger;
    var lParams = {
        "appId": "tscm01",
        "scr": "TaskCompleted",
        "div": "ACNR01__Navigator__launchPad",
        "layout": "All",
        "type": "CF",
        "userObj": {
            "referenceId": pRespObj.tbDbmiWorkflowMaster.instanceId
        }
    };
    apz.launchApp(lParams);
};
apz.acus01.ViewUser.viewUserPersona = function() {
    apz.server.callServer({
        ifaceName: 'UserPersona_Query',
        appId: 'acus01',
        buildReq: 'N',
        req: {
            tbDbmiUserPersona: {
                userId: apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__userId"),
                corporateId: apz.Login.sCorporateId
            }
        },
        paintResp: 'Y',
        callBack: apz.acus01.ViewUser.viewUserPersonaCB
    });
};
apz.acus01.ViewUser.viewUserPersonaCB = function() {
    debugger;
    if (pResp.status) {
        if (pResp.res.UserPersona__tbDbmiUserPersona_Req.tbDbmiUserPersona.personaName) {
            apz.setElmValue("acus01__ViewUser__persona", pResp.res.UserPersona__tbDbmiUserPersona_Req.tbDbmiUserPersona.personaName);
        }
    }
};