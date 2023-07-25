apz.acep01.CorporateHierarchy = {};
apz.acep01.CorporateHierarchy.sCorporateName = "ACME CROP";
apz.acep01.CorporateHierarchy.sCorporateType = "PRIVATE LIMITED";
apz.acep01.CorporateHierarchy.sCorporateEntityId = "";
apz.acep01.CorporateHierarchy.sAction = "";
apz.app.onLoad_CorporateHierarchy = function() {
    if(apz.Login){
    apz.acep01.CorporateHierarchy.sCorporateId = apz.Login.sCorporateId;
    }
    else{
        apz.acep01.CorporateHierarchy.sCorporateId = "000FTAC4321";
    }
    apz.acep01.CorporateHierarchy.EntityProfile(apz.acep01.CorporateHierarchy.sCorporateId);
};
apz.acep01.CorporateHierarchy.EntityProfile = function(pCorporateId) {
    var lServerParams = {
        "ifaceName": "CorporateHierarchy_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acep01.CorporateHierarchy.FetchCorporateHierarchyCB,
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acep01.CorporateHierarchy.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acep01.CorporateHierarchy.FetchCorporateHierarchyCB = function(pResp) {
    debugger;
};
apz.acep01.CorporateHierarchy.Cancel = function() {
    debugger;
    var params = {};
    params.appId = "acep01";
    params.scr = "CorporateHierarchy";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.acep01.CorporateHierarchy.viewDetails = function(pObj) {
    debugger;
    var lEntityId = $(pObj).closest('li').find('.entityId').text();
    var params = {};
    params.appId = "acep01";
    params.scr = "EntityDetails";
    params.div = "acep01__CorporateHierarchy__LaunchScreen";
    params.layout = "All";
    params.userObj = {
        "EntityId": lEntityId
    };
    $("#acep01__CorporateHierarchy__LaunchScreen").removeClass("sno");
    $("#acep01__CorporateHierarchy__EntitySummary").addClass("sno");
    apz.launchSubScreen(params);
};
apz.acep01.CorporateHierarchy.fnSearch = function(event) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acep01__CorporateHierarchy__SearchBy");
        var lInput = apz.getElmValue("acep01__CorporateHierarchy__SearchValue");
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
        } else if (lType == "EntityId") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "entityID";
            }
        } else if (lType == "EntityName") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "entityName";
            }
        }
        if (flag) {
            apz.acep01.CorporateHierarchy.sAction = "Search";
            var req = {
                "entityMaster": {
                    "type": lSearchType,
                    "corpID": apz.Login.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_corp_entity_master";
            var lParams = {
                "ifaceName": "EntityService",
                "paintResp": "N",
                "appId": "acep01",
                "buildReq": "N",
                "lReq": req
            };
            apz.startLoader();
            apz.acep01.CorporateHierarchy.fnBeforCallServer(lParams);
        }
    }
};
apz.acep01.CorporateHierarchy.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acep01.CorporateHierarchy.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acep01.CorporateHierarchy.callServerCB = function(params) {
    if (apz.acep01.CorporateHierarchy.sAction == "Search") {
        apz.acep01.CorporateHierarchy.fnFetchEntityDetailsCB(params);
    }
};
apz.acep01.CorporateHierarchy.fnFetchEntityDetailsCB = function(params) {
    debugger;
    apz.stopLoader();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acep01__EntityService_Res.entityStatus) {
            apz.data.scrdata.acep01__CorporateHierarchy_Req = {};
            apz.data.scrdata.acep01__CorporateHierarchy_Req.tbDbmiCorpEntityMaster = [];
            apz.data.scrdata.acep01__CorporateHierarchy_Req.tbDbmiCorpEntityMaster = params.res.acep01__EntityService_Res.tbDbmiCorpEntityMaster;
            apz.data.loadData("CorporateHierarchy", "acep01");
        } else {
            apz.data.clearMRMV("acep01__CorporateHierarchy__EntityCards_List");
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
apz.acep01.CorporateHierarchy.openModal = function() {
    debugger;
    var params = {
        "targetId": "acep01__EntityDetails__Launch_chart"
    };
    apz.toggleModal(params);
};
apz.acep01.CorporateHierarchy.fnButtonClick = function() {
    apz.launchSubScreen({
        appId: "acep01",
        scr: "AddNewEntity",
        animation: 2,
        div: "scr__acep01__CorporateHierarchy__main" 
    });
}
