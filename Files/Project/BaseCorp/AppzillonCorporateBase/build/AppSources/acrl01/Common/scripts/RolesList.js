window.oldDefineAmd = define.amd;
define.amd = false;
apz.acrl01.RolesList = {};
apz.acrl01.RolesList.sCorporateName = "ABC Corp";
apz.acrl01.RolesList.sCorporationtype = "Private Limited";
apz.acrl01.RolesList.sAction = "";
apz.app.onLoad_RolesList = function() {
    debugger;
    apz.acrl01.RolesList.sCorporateId = apz.Login.sCorporateId;
    apz.acrl01.RolesList.sRole = {};
    $("#acrl01__RolesList__RoleSummary .adr-ctr").addClass("sno");
    //   apz.setElmValue("acrl01__RolesList__corporateId", apz.acrl01.RolesList.sCorporateId);
    //   apz.setElmValue("acrl01__RolesList__corporatename", apz.acrl01.RolesList.sCorporateName);
    //  apz.setElmValue("acrl01__RolesList__corporationType", apz.acrl01.RolesList.sCorporationtype);
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "RolesSummary_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acrl01.RolesList.fetchRolesSummaryCB,
    };
    var req = {};
    req.tbDbmiCorpRoleMaster = {};
    req.tbDbmiCorpRoleMaster.corporateId = apz.acrl01.RolesList.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acrl01.RolesList.fetchRolesSummaryCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        //write your code here
        //$("#acrl01__RolesSummary__i__tbDbmiCorpRoleMaster__roleId_0").trigger('click');
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acrl01.RolesList.fetchRoleDetails = function(pObj) {
    debugger;
    var lRowNo = $(pObj).attr('rowno');
    apz.acrl01.RolesList.sRole = apz.data.scrdata.acrl01__RolesSummary_Req.tbDbmiCorpRoleMaster[lRowNo];
    $("#acrl01__RolesList__RoleSummary").addClass("sno");
    $("#acrl01__RolesList__search_row").addClass('sno');
    $("#acrl01__RolesList__RoleScreensLaunch").removeClass("sno");
    var lRoleId = $(pObj).text();
    var params = {};
    params.appId = "acrl01";
    params.scr = "RoleDetails";
    params.layout = "All";
    params.div = "acrl01__RolesList__RoleScreensLaunch";
    params.userObj = {
        "RoleMaster": apz.acrl01.RolesList.sRole
    };
    apz.launchSubScreen(params);
};
apz.acrl01.RolesList.newRole = function() {
    $("#acrl01__RolesList__RoleSummary").addClass("sno");
    $("#acrl01__RolesList__search_row").addClass('sno');
    $("#acrl01__RolesList__Role_Summary_Header").addClass('sno');
    $("#acrl01__RolesList__RoleScreensLaunch").removeClass("sno");
    var params = {};
    params.appId = "acrl01";
    params.scr = "ModifyRole";
    params.div = "acrl01__RolesList__RoleScreensLaunch";
    params.layout = "All";
    params.userObj = {
        "action": "new role",
        "div":"acrl01__RolesList__RoleScreensLaunch"
    };
    apz.launchSubScreen(params);
};
apz.acrl01.RolesList.editRole = function(pObj) {
    debugger;
    $("#acrl01__RolesList__RoleSummary").addClass("sno");
    $("#acrl01__RolesList__search_row").addClass('sno');
    $("#acrl01__RolesList__RoleScreensLaunch").removeClass("sno");
    $("#acrl01__RolesList__Role_Summary_Header").addClass('sno');
    var lRowNo = $(pObj).parent().parent().parent().parent().attr('rowno');
    apz.acrl01.RolesList.sRole = apz.data.scrdata.acrl01__RolesSummary_Req.tbDbmiCorpRoleMaster[lRowNo];
    var params = {};
    params.appId = "acrl01";
    params.scr = "ModifyRole";
    params.div = "acrl01__RolesList__RoleScreensLaunch";
    params.layout = "All";
    params.userObj = {
        "action": "modify role",
        "RoleMaster": $.extend(true, {}, apz.acrl01.RolesList.sRole),
        "div":"acrl01__RolesList__RoleScreensLaunch"
    };
    apz.launchSubScreen(params);
    event.stopPropagation();
};
apz.acrl01.RolesList.fnSearch = function(event) {
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acrl01__RolesList__SearchBy");
        var lInput = apz.getElmValue("acrl01__RolesList__SearchValue");
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "RoleID") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "RoleID";
            }
        } else if (lType == "Desc") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "Desc";
            }
        }
        if (flag) {
            apz.acrl01.RolesList.sAction = "Search";
            var req = {
                "roleDetails": {
                    "type": lSearchType,
                    "corpID": apz.Login.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_corp_role_master";
            var lParams = {
                "ifaceName": "RoleService",
                "paintResp": "N",
                "appId": "acrl01",
                "buildReq": "N",
                "lReq": req
            };
            apz.startLoader();
            apz.acrl01.RolesList.fnBeforCallServer(lParams);
        }
    }
};
apz.acrl01.RolesList.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acrl01.RolesList.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acrl01.RolesList.callServerCB = function(params) {
    if (apz.acrl01.RolesList.sAction == "Search") {
        apz.acrl01.RolesList.fnFetchRoleDetailsCB(params);
    }
};
apz.acrl01.RolesList.fnFetchRoleDetailsCB = function(params) {
    debugger;
    apz.stopLoader();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acrl01__RoleService_Res.roleStatus) {
            apz.data.scrdata.acrl01__RolesSummary_Req = {};
            apz.data.scrdata.acrl01__RolesSummary_Req.tbDbmiCorpRoleMaster = [];
            apz.data.scrdata.acrl01__RolesSummary_Req.tbDbmiCorpRoleMaster = params.res.acrl01__RoleService_Res.tbDbmiCorpRoleMaster;
            apz.data.loadData("RolesSummary", "acrl01");
        } else {
            apz.data.clearMRMV("acrl01__RolesList__Roles_List");
            var msg = {};
            msg.message = "No Records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
