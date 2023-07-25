apz.acus01.NewUser = {};
apz.acus01.NewUser.userLogo = "";
apz.acus01.NewUser.sDiv = "";
apz.app.onLoad_NewUser = function(lParams) {
    debugger;
    apz.acus01.NewUser.sCorporateId = apz.Login.sCorporateId;
    apz.acus01.NewUser.sUserId = apz.Login.sUserId;
    apz.acus01.NewUser.sDiv = lParams.div;
    if (lParams.currentTask) {
        apz.acus01.NewUser.sCurrentTask = lParams.currentTask;
        apz.acus01.NewUser.sCurrentWfDetails = lParams.currentWfDetails;
        apz.acus01.NewUser.sDiv = lParams.div;
        var lScreenData = JSON.parse(lParams.currentWfDetails.screenData).acus01__UserDetails_Req;
        apz.data.scrdata.acus01__UserDetails_Req = {};
        apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster = lScreenData.tbDbmiCorpUserMaster;
        apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserRole = lScreenData.tbDbmiCorpUserRole;
        apz.data.loadData("UserDetails", "acus01");
        apz.setElmValue("acus01__NewUser__UserName", (apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__firstName") + " " + apz.getElmValue(
            "acus01__UserDetails__i__tbDbmiCorpUserMaster__lastName")));
    } else {
        apz.data.scrdata.acus01__UserDetails_Req = {};
        apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster = "";
        apz.data.loadData("UserDetails", "acus01");
    }
    $("#acus01__UserList__UserSearch").hide();
    apz.setElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__corporateId", apz.acus01.NewUser.sCorporateId);
    var lServerParams = {
        "ifaceName": "EntitiesQuery_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.NewUser.entitiesQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acus01.NewUser.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acus01.NewUser.entitiesQueryCB = function(pResp) {
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
        if (apz.acus01.NewUser.sCurrentTask) {
            apz.setElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__homeEntity", apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster
                .homeEntity);
        }
    }
    apz.acus01.NewUser.getCountryNames();
};
apz.acus01.NewUser.getCountryNames = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "Country_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.NewUser.getCountryNamesCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.acus01.NewUser.getCountryNamesCB = function(pResp) {
    debugger;
    var lfrmarr = [];
    var lObj = {
        "val": "Please Select",
        "desc": "Please Select"
    };
    lfrmarr.push(lObj);
    var larrLength = pResp.res.acus01__Country_Res.tbDbmiCorpCountry.length;
    for (var i = 0; i < larrLength; i++) {
        var lfrmacc = {
            "val": pResp.res.acus01__Country_Res.tbDbmiCorpCountry[i].countryVal,
            "desc": pResp.res.acus01__Country_Res.tbDbmiCorpCountry[i].countryDesc
        };
        lfrmarr.push(lfrmacc);
    }
    apz.populateDropdown(document.getElementById("acus01__UserDetails__i__tbDbmiCorpUserMaster__address4"), lfrmarr);
    if (apz.acus01.NewUser.sCurrentTask) {
        apz.setElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__address4", apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.address4);
    }
    apz.acus01.NewUser.getReportingManager();
};
apz.acus01.NewUser.getReportingManager = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "UsersList_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.NewUser.getReportingManagerCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserMaster = {};
    req.tbDbmiCorpUserMaster.corporateId = apz.Login.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acus01.NewUser.getReportingManagerCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lManagerNames = pResp.res.acus01__UsersList_Req.tbDbmiCorpUserMaster;
        var lManagerNamesLength = lManagerNames.length;
        var lArr = [];
        var lObjVal = {
            "val": "Please Select",
            "desc": "Please Select"
        };
        lArr.push(lObjVal);
        for (var i = 0; i < lManagerNamesLength; i++) {
            var lObj = {
                "val": lManagerNames[i].firstName,
                "desc": lManagerNames[i].firstName + " " + lManagerNames[i].lastName,
            };
            lArr.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acus01__UserDetails__i__tbDbmiCorpUserMaster__supervisor"), lArr);
        if (apz.acus01.NewUser.sCurrentTask) {
            apz.setElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__supervisor", apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster
                .supervisor);
        }
    }
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
apz.acus01.NewUser.ValPhNo = function(pThis) {
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
apz.acus01.NewUser.ValEmail = function(pThis) {
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
apz.acus01.NewUser.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer('acus01__NewUser__NewUserForm') == false) {
        var msg = {
            "code": 'acus_userid'
        };
        apz.dispMsg(msg);
    } else if (apz.val.validateContainer('acus01__NewUser__NewUserRoleTable') == false) {
        var msg = {
            "code": 'acus_roleId'
        };
        apz.dispMsg(msg);
    } else {
        var lscreenData = apz.data.buildData("UserDetails", "acus01");
        lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.logo = apz.acus01.NewUser.userLogo;
        for (var i = 0; i < lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserRole.length; i++) {
            lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserRole[i].corporateId = lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.corporateId;
            lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserRole[i].userId = lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.userId;
        }
        if (apz.acus01.NewUser.sCurrentTask) {
            var lUserObj = {};
            lUserObj.currentTask = apz.acus01.NewUser.sCurrentTask;
            lUserObj.currentWfDetails = apz.acus01.NewUser.sCurrentWfDetails;
            lUserObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            lUserObj.callBack = apz.acus01.NewUser.workflowMicroServiceCB;
            lUserObj.operation = "NEXTTASK";
        } else {
            var taskObj = {};
            taskObj.workflowId = "CUNU";
            taskObj.status = "U";
            taskObj.taskType = "NEW USER";
            taskObj.versionNo = "1";
            taskObj.screenData = JSON.stringify(lscreenData);
            taskObj.action = "";
            taskObj.referenceId = apz.acus01.NewUser.sCorporateId + "__" + lscreenData.acus01__UserDetails_Req.tbDbmiCorpUserMaster.userId;
            taskObj.taskDesc = "New user has been added with referenceId" + taskObj.referenceId;
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.acus01.NewUser.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
        }
        var lParams = {
            "appId": "acwf01",
            "scr": "WorkFlow",
            "div": "acus01__NewUser__LaunchMicroService",
            "layout": "All",
            "type": "CF",
            "userObj": lUserObj
        };
        apz.launchApp(lParams);
    }
};
apz.acus01.NewUser.workflowMicroServiceCB = function(pRespObj) {
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
                lObj.div = apz.acus01.NewUser.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acus01.NewUser.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // var msg = {
                //     "code": 'acus_newursucss',
                //     //"callBack": apz.acus01.NewUser.Confirmation
                // };
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
apz.acus01.NewUser.Confirmation = function() {
    debugger;
    $("#acus01__UserList__MainRow").removeClass("sno");
    $("#acus01__UserList__ModifyScreen").addClass("sno");
};
apz.acus01.NewUser.Cancel = function() {
    debugger;
    $("#acus01__UserList__MainRow").removeClass("sno");
    $("#acus01__UserList__ModifyScreen").addClass("sno");
    $("#acus01__UserList__UserSearch").show();
    $("#acus01__UserList__User_Summary_Header").removeClass("sno");
    apz.setTableHeight("acus01__UserList__UsersTable", false);
    $("#acus01__UserList__UserSearch").show();
};
apz.acus01.NewUser.imageFileSected = function(obj, event) {
    debugger;
    var fileObj = $(obj)[0].files[0];
    var apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        var binaryStr = apzFileReader.result;
        var base64Str = btoa(binaryStr);
        apz.acus01.NewUser.userLogo = base64Str;
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
apz.acus01.NewUser.createUserPersona = function() {
    apz.acus01.NewUser.deleteUserPersona();
};
apz.acus01.NewUser.deleteUserPersona = function() {
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
        callBack: apz.acus01.NewUser.deleteUserPersonaCB
    });
};
apz.acus01.NewUser.deleteUserPersonaCB = function(pResp) {
    apz.acus01.NewUser.newUserPersona();
};
apz.acus01.NewUser.newUserPersona = function() {
    apz.server.callServer({
        ifaceName: 'UserPersona_New',
        appId: 'acus01',
        buildReq: 'N',
        req: {
            tbDbmiUserPersona: {
                personaName: apz.getElmValue("acus01__NewUser__persona"),
                userId: apz.getElmValue("acus01__UserDetails__i__tbDbmiCorpUserMaster__userId"),
                corporateId: apz.Login.sCorporateId
            }
        },
        paintResp: 'N',
        callBack: apz.acus01.NewUser.newUserPersonaCB
    });
};
apz.acus01.NewUser.newUserPersonaCB = function(pResp) {debugger;};