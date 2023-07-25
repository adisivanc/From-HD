apz.acus01.CorporateUsers = {};
apz.acus01.CorporateUsers.userLogo = "";
apz.acus01.CorporateUsers.sDiv = "";
apz.app.onLoad_CorporateUsers = function(params) {
    debugger;
    apz.acus01.CorporateUsers.sCorporateId = apz.Login.sCorporateId;
    apz.acus01.CorporateUsers.sUserId = apz.Login.sUserId;
    apz.acus01.CorporateUsers.sDiv = params.div;
    apz.acus01.CorporateUsers.CorpUserId = "";
    if (params.currentTask) {
        apz.acus01.CorporateUsers.sCurrentTask = params.currentTask;
        apz.acus01.CorporateUsers.sCurrentWfDetails = params.currentWfDetails;
        apz.acus01.CorporateUsers.sDiv = params.div;
        var lScreenData = JSON.parse(params.currentWfDetails.screenData).acus01__UserDetails_Req;
        apz.data.scrdata.acus01__UserDetails_Req = {};
        apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster = lScreenData.tbDbmiCorpUserMaster;
        apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserRole = lScreenData.tbDbmiCorpUserRole;
        apz.data.loadData("UserDetails", "acus01");
        apz.setElmValue("acus01__CorporateUsers__UserName", (apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__firstName") + " " + apz.getElmValue(
            "acus01__UserDetails__i__tbDbmiCorpUserMaster__lastName")));
        apz.acus01.CorporateUsers.CorpUserId = lScreenData.tbDbmiCorpUserMaster.userId;
    } else {
        apz.acus01.CorporateUsers.CorpUserId = params.CorpUserId;
    }
    var lServerParams = {
        "ifaceName": "EntitiesQuery_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.CorporateUsers.entitiesQueryCB,
        "callBackObj": {
            "userId": apz.acus01.CorporateUsers.CorpUserId
        },
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acus01.CorporateUsers.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.app.onShown_CorporateUsers = function() {
    debugger;
};
apz.acus01.CorporateUsers.entitiesQueryCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lEntities = pResp.res.acus01__EntitiesQuery_Res.tbDbmiCorpEntityMaster;
        var lEntitiesLength = lEntities.length;
        var lArr = [];
        for (var i = 0; i < lEntitiesLength; i++) {
            var lObj = {
                "val": lEntities[i].entityId,
                "desc": lEntities[i].entityId + " " + "-" + " " + lEntities[i].entityName,
            };
            lArr.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acus01__UserDetails__i__tbDbmiCorpUserMaster__homeEntity"), lArr);
        if (apz.acus01.CorporateUsers.sCurrentTask) {
            apz.setElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__homeEntity", apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster
                .homeEntity);
            apz.acus01.CorporateUsers.getCountryNames();
        } else {
            apz.acus01.CorporateUsers.getUserDetails(pResp.callBackObj.userId);
        }
    }
};
apz.acus01.CorporateUsers.getCountryNames = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "Country_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.CorporateUsers.getCountryNamesCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.acus01.CorporateUsers.getCountryNamesCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lCountry = pResp.res.acus01__Country_Res.tbDbmiCorpCountry;
        var lCountryLength = lCountry.length;
        var lArr = [];
        for (var i = 0; i < lCountryLength; i++) {
            var lObj = {
                "val": lCountry[i].countryVal,
                "desc": lCountry[i].countryDesc,
            };
            lArr.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acus01__UserDetails__i__tbDbmiCorpUserMaster__address4"), lArr);
        if (apz.acus01.CorporateUsers.sCurrentTask) {
            apz.setElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__address4", apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.address4);
        }
    }
    apz.acus01.CorporateUsers.getReportingManager();
};
apz.acus01.CorporateUsers.getReportingManager = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "UsersList_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.CorporateUsers.getReportingManagerCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserMaster = {};
    req.tbDbmiCorpUserMaster.corporateId = apz.Login.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acus01.CorporateUsers.getReportingManagerCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lManagerNames = pResp.res.acus01__UsersList_Req.tbDbmiCorpUserMaster;
        var lManagerNamesLength = lManagerNames.length;
        var lCurrentUser = apz.getElmValue("acus01__CorporateUsers__UserName");
        var lArr = [];
        for (var i = 0; i < lManagerNamesLength; i++) {
            if (lCurrentUser != lManagerNames[i].firstName + " " + lManagerNames[i].lastName) {
                var lObj = {
                    "val": lManagerNames[i].firstName,
                    "desc": lManagerNames[i].firstName + " " + lManagerNames[i].lastName,
                };
                lArr.push(lObj);
            }
        }
        apz.populateDropdown(document.getElementById("acus01__UserDetails__i__tbDbmiCorpUserMaster__supervisor"), lArr);
        if (apz.acus01.CorporateUsers.sCurrentTask) {
            apz.setElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__supervisor", apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster
                .supervisor);
        }
    };
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
};
apz.acus01.CorporateUsers.getUserDetails = function(pUserId) {
    debugger;
    var lServerParams = {
        "ifaceName": "UserDetails_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.CorporateUsers.fetchUserDetailsQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserMaster = {};
    req.tbDbmiCorpUserMaster.corporateId = apz.acus01.CorporateUsers.sCorporateId;
    req.tbDbmiCorpUserMaster.userId = pUserId;
    req.tbDbmiCorpUserRole = {};
    req.tbDbmiCorpUserRole.corporateId = apz.acus01.CorporateUsers.sCorporateId;
    req.tbDbmiCorpUserRole.userId = pUserId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acus01.CorporateUsers.fetchUserDetailsQueryCB = function(pResp) {
    debugger;
    $("#acus01__UserList__UserSearch").hide();
    apz.setElmValue("acus01__CorporateUsers__UserName", (apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__firstName") + " " + apz.getElmValue(
        "acus01__UserDetails__i__tbDbmiCorpUserMaster__lastName")));
    apz.acus01.CorporateUsers.viewUserPersona();
    apz.acus01.CorporateUsers.getCountryNames();
};
apz.acus01.CorporateUsers.ValPhNo = function(pThis) {
    debugger;
    var lPhNo = $(pThis).val();
    var lPhnoLength = lPhNo.length;
    var phoneno = new RegExp("^[\+]{0,1}[0-9]{1,3}[\-]{0,1}[0-9]{8,13}$");
    if (lPhnoLength > 0 && !phoneno.test(lPhNo)) {
        var msg = {
            "code": "INVALIDPhoneNo"
        };
        apz.dispMsg(msg);
    }
};
apz.acus01.CorporateUsers.ValEmail = function(pThis) {
    debugger;
    var lEmail = $(pThis).val();
    var pattern = new RegExp("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$");
    if (!pattern.test(lEmail)) {
        var msg = {
            "code": "INVALIDEmail"
        };
        apz.dispMsg(msg);
    }
};
apz.acus01.CorporateUsers.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer('acus01__CorporateUsers__CorpAddmodify') == false) {
        var msg = {
            "code": 'acus_userid'
        };
        apz.dispMsg(msg);
    } else if (apz.val.validateContainer('acus01__CorporateUsers__UserRoleTable') == false) {
        var msg = {
            "code": 'acus_roleId'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("UserDetails", "acus01");
        lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.logo = apz.acus01.CorporateUsers.userLogo;
        for (var i = 0; i < lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserRole.length; i++) {
            lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserRole[i].corporateId = lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.corporateId;
            lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserRole[i].userId = lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.userId;
        }
        if (apz.acus01.CorporateUsers.sCurrentTask) {
            var lUserObj = {};
            lUserObj.currentTask = apz.acus01.CorporateUsers.sCurrentTask;
            lUserObj.currentWfDetails = apz.acus01.CorporateUsers.sCurrentWfDetails;
            lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lUserObj.callBack = apz.acus01.CorporateUsers.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        } else {
            var taskObj = {};
            taskObj.workflowId = "CUMU";
            taskObj.status = "U";
            taskObj.taskType = "MODIFY USER";
            taskObj.versionNo = "1";
            taskObj.screenData = JSON.stringify(lscreenData);
            taskObj.action = "";
            taskObj.referenceId = lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.corporateId + "__" + lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster
                .userId;
            taskObj.taskDesc = taskObj.referenceId + "'s user details have been modified";
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acus01.CorporateUsers.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
        }
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acus01__CorporateUsers__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    }
};
apz.acus01.CorporateUsers.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acus01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acus01.CorporateUsers.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acus01.CorporateUsers.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // // var msg = {
                // //     "code": 'acus_USERSUCS',
                // //     // "callBack": apz.acus01.CorporateUsers.Confirmation
                // // };
                // apz.dispMsg(msg);
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
};
apz.acus01.CorporateUsers.Confirmation = function() {
    debugger;
    $("#acus01__UserList__MainRow").removeClass("sno");
    $("#acus01__UserList__LaunchScreen").addClass("sno");
};
apz.acus01.CorporateUsers.Cancel = function() {
    debugger;
    apz.acus01.UserList.userInfoQuery(apz.acus01.UserList.sCorporateId);
    $("#acus01__UserList__MainRow").removeClass("sno");
    $("#acus01__UserList__LaunchScreen").addClass("sno");
    $("#acus01__UserList__UserSearch").show();
    $("#acus01__UserList__User_Summary_Header").removeClass("sno");
    apz.setTableHeight("acus01__UserList__UsersTable", false);
};
apz.app.postCreateRow = function(pContainerId) {
    debugger;
    if (pContainerId = "acus01__CorporateUsers__UserRoleTable") {
        var lRecordNo = $("#acus01__CorporateUsers__UserRoleTable_tbody tr").length - 1;
        var lUserId = $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__userId").val();
        if (lRecordNo) {
            $("#acus01__UserDetails__i__tbDbmiCorpUserRole__corporateId_" + lRecordNo).val(apz.acus01.CorporateUsers.sCorporateId);
            $("#acus01__UserDetails__i__tbDbmiCorpUserRole__userId_" + lRecordNo).val(lUserId);
        }
        apz.data.loadData("acus01__CorporateUsers__UserRoleTable", "acus01");
    }
};
apz.acus01.CorporateUsers.imageFileSected = function(obj, event) {
    debugger;
    var fileObj = $(obj)[0].files[0];
    var apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        var binaryStr = apzFileReader.result;
        var base64Str = btoa(binaryStr);
        apz.acus01.CorporateUsers.userLogo = base64Str;
        var blob = convertBase64toBlob(base64Str, 'image/jpg');
        var blobUrl = URL.createObjectURL(blob);
        $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__logo").attr("src", blobUrl);
    };
    apzFileReader.readAsBinaryString(fileObj);
};
/*Method to convert base64 string to blob object*/
function convertBase64toBlob(content, contentType) {
    contentType = contentType || '';
    var sliceSize = 512;
    var byteCharacters = window.atob(content); //method which converts base64 to binary
    var byteArrays = [];
    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);
        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }
        var byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }
    var blob = new Blob(byteArrays, {
        type: contentType
    }); //statement which creates the blob
    return blob;
};
apz.app.postReturnrow = function(row) {
    apz.acus01.CorporateUsers.createUserPersona();
}
apz.acus01.CorporateUsers.createUserPersona = function() {
    apz.acus01.CorporateUsers.deleteUserPersona();
};
apz.acus01.CorporateUsers.deleteUserPersona = function() {
    apz.server.callServer({
        ifaceName: 'UserPersona_Delete',
        appId: 'acus01',
        buildReq: 'N',
        req: {
            tbDbmiUserPersona: {
                userId: apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__userId"),
                corporateId: apz.Login.sCorporateId
            }
        },
        paintResp: 'Y',
        callBack: apz.acus01.CorporateUsers.deleteUserPersonaCB
    });
};
apz.acus01.CorporateUsers.deleteUserPersonaCB = function(pResp) {
    apz.acus01.CorporateUsers.CorporateUsersPersona();
};
apz.acus01.CorporateUsers.CorporateUsersPersona = function() {
    apz.server.callServer({
        ifaceName: 'UserPersona_New',
        appId: 'acus01',
        buildReq: 'N',
        req: {
            tbDbmiUserPersona: {
                personaName: apz.getElmValue("acus01__CorporateUsers__persona"),
                userId: apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__userId"),
                corporateId: apz.Login.sCorporateId
            }
        },
        paintResp: 'N',
        callBack: apz.acus01.CorporateUsers.CorporateUsersPersonaCB
    });
};
apz.acus01.CorporateUsers.CorporateUsersPersonaCB = function(pResp) {
    debugger;
    apz.acus01.CorporateUsers.deleteExistingUserDashboardWidgets();
};
apz.acus01.CorporateUsers.deleteExistingUserDashboardWidgets = function() {
    apz.server.callServer({
        ifaceName: 'UserDashboardWidget_Delete',
        appId: 'acus01',
        buildReq: 'N',
        req: {
            'tbDbmiCorpUserDashboardWidget': {
                'corporateId': apz.Login.sCorporateId,
                'userId': apz.Login.sUserId,
            }
        },
        paintResp: 'N',
        callBack: apz.acus01.CorporateUsers.deleteExistingUserDashboardWidgetsCB
    });
};
apz.acus01.CorporateUsers.deleteExistingUserDashboardWidgetsCB = function(params) {};
apz.acus01.CorporateUsers.viewUserPersona = function() {
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
        callBack: apz.acus01.CorporateUsers.viewUserPersonaCB
    });
};
apz.acus01.CorporateUsers.viewUserPersonaCB = function(pResp) {
    debugger;
    if (pResp.status) {
        if (pResp.res.acus01__UserPersona_Res.tbDbmiUserPersona.personaName) {
            apz.setElmValue("acus01__CorporateUsers__persona", pResp.res.acus01__UserPersona_Res.tbDbmiUserPersona.personaName);
        }
    }
};