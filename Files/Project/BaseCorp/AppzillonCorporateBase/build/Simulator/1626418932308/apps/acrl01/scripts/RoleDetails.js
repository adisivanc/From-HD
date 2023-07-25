apz.acrl01.RoleDetails = {};


apz.app.onLoad_RoleDetails = function(params) {
    debugger;
    $("#acrl01__RolesList__Role_Summary_Header").addClass("sno");
    apz.acrl01.RoleDetails.sCorporateId = apz.Login.sCorporateId;
    apz.acrl01.RoleDetails.sRoleId = "";
    //$("#acrl01__RoleDetails__role_id").val(params.RoleMaster.roleId);
    //$("#acrl01__RoleDetails__role_desc").val(params.RoleMaster.roleDescription);
    apz.acrl01.RoleDetails.fetchRoleDetails(params);
    
    
    
};
apz.app.onShown_RoleDetails = function() {
    apz.acrl01.RoleDetails.fetchEntityHierarchy();
    setTimeout(function() {
        apz.acrl01.RoleDetails.showSelectedEntities();
    }, 10);
    
    $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleId_lbl").removeClass("req");
};
apz.acrl01.RoleDetails.fetchRoleDetails = function(pRoleMaster) {
    debugger;
   
    apz.acrl01.RoleDetails.sRoleId = pRoleMaster.RoleMaster.roleId;
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "RoleDetails_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "callBack": apz.acrl01.RoleDetails.fetchRoleDetailsCB,
        "callBackObj":{
            "RoleMaster":pRoleMaster.RoleMaster
        }
    };
    var req = {};
    req.tbDbmiCorpRoleEntity = {};
    req.tbDbmiCorpRoleEntity.corporateId = apz.acrl01.RoleDetails.sCorporateId;
    req.tbDbmiCorpRoleEntity.roleId = apz.acrl01.RoleDetails.sRoleId;
    req.tbDbmiCorpRoleAccount = {};
    req.tbDbmiCorpRoleAccount.corporateId = apz.acrl01.RoleDetails.sCorporateId;
    req.tbDbmiCorpRoleAccount.roleId = apz.acrl01.RoleDetails.sRoleId;
    req.tbDbmiCorpRoleOperations = {};
    req.tbDbmiCorpRoleOperations.corporateId = apz.acrl01.RoleDetails.sCorporateId;
    req.tbDbmiCorpRoleOperations.roleId = apz.acrl01.RoleDetails.sRoleId;
    req.tbDbmiCorpRoleFiles = {};
    req.tbDbmiCorpRoleFiles.corporateId = apz.acrl01.RoleDetails.sCorporateId;
    req.tbDbmiCorpRoleFiles.roleId = apz.acrl01.RoleDetails.sRoleId;
    req.tbDbmiCorpRoleScr = {};
    req.tbDbmiCorpRoleScr.corporateId = apz.acrl01.RoleDetails.sCorporateId;
    req.tbDbmiCorpRoleScr.roleId = apz.acrl01.RoleDetails.sRoleId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acrl01.RoleDetails.fetchRoleDetailsCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        if (pResp.res.acrl01__RoleDetails_Req) {
        apz.data.scrdata.acrl01__RoleDetailsDummy_Req = pResp.res.acrl01__RoleDetails_Req;
    } else {
        apz.data.scrdata.acrl01__RoleDetailsDummy_Req = pResp.res.acrl01__RoleDetails_Res;
    }
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster = pResp.callBackObj.RoleMaster;
    apz.data.loadData("RoleDetailsDummy", "acrl01");
        $("#acrl01__RoleDetails__EntityList_row_0").trigger('click');
    } else {
        var msg = {
            "code": pResp.errors[0].errorCode
        };
        apz.dispMsg(msg);
    }
};
apz.acrl01.RoleDetails.getEntityDetails = function(pObj) {
    debugger;
    $(pObj).parent().find(".selected").removeClass("selected");
    $(pObj).addClass("selected");
    var lEntityId = $(pObj).find('.entity').text();
    var lAuthlmt = $(pObj).find('.authLmt').text();
    var lTxnlmt = $(pObj).find('.txnLmt').text();
    $("#acrl01__RoleDetails__txn_limit").val(lTxnlmt);
    $("#acrl01__RoleDetails__auth_limit").val(lAuthlmt);
    apz.data.scrdata.acrl01__RoleAccountsDummy_Req = {};
    apz.data.scrdata.acrl01__RoleAccountsDummy_Req.tbDbmiCorpRoleAccount = [];
    var lEntityAccArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount;
    var lEntityAccArrLength = lEntityAccArr.length;
    for (var i = 0; i < lEntityAccArrLength; i++) {
        if (lEntityAccArr[i].entityId == lEntityId) {
            apz.data.scrdata.acrl01__RoleAccountsDummy_Req.tbDbmiCorpRoleAccount.push(lEntityAccArr[i]);
        }
    }
    apz.data.loadData("RoleAccountsDummy", "acrl01");
    
     
};
/*apz.acrl01.RoleDetails.Modify = function() {
    var params = {};
    params.appId = "acrl01";
    params.scr = "ModifyRole";
    params.layout = "All";
    params.div = "acrl01__RolesList__RoleScreensLaunch";
    params.userObj = {
        "action": "modify role",
        "RoleMaster": $.extend(true, {}, apz.acrl01.RolesList.sRole)
    };
    apz.launchSubScreen(params);
};
*/


apz.acrl01.RoleDetails.fetchEntityHierarchy = function() {
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "CorporateHierarchy_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acrl01.RoleDetails.fetchEntityHierarchyCB,
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acrl01.RolesList.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acrl01.RoleDetails.fetchEntityHierarchyCB = function(pResp) {
    var lDataSource = pResp.resFull.appzillonBody.acrl01__CorporateHierarchy_Res.tbDbmiCorpEntityMaster;
    var lArrLength = lDataSource.length;
    var lChartArr = [];
    for (var i = 0; i < lArrLength; i++) {
        var lObj = {};
        lObj.id = lDataSource[i].entityId;
        lObj.name = lDataSource[i].entityName+"<br><h3>"+lDataSource[i].entityId+"</h3>";
        lObj.parent = lDataSource[i].parentEntity;
        lChartArr.push(lObj);
    }
    $(function() {
        org_chart = $('#acrl01__RoleDetails__drag_node_loader').orgChart({
            data: lChartArr, // your data
            showControls: false, // display add or remove node button.
            allowEdit: false, // click the node's title to edit
            onAddNode: function(node) {},
            onDeleteNode: function(node) {},
            onClickNode: function(node) {
            },
            newNodeText: 'Add Child' // text of add button
        });
    });
};

apz.acrl01.RoleDetails.showSelectedEntities = function() {
    debugger;
    if (apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity != undefined && apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity
        .length != 0) {
        var lEntityArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
        var lEntityLen = lEntityArr.length;
        var lNodes = $("#acrl01__RoleDetails__drag_node_loader").find(".node");
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

apz.acrl01.RoleDetails.Cancel = function(){
    $("#acrl01__RolesList__RoleSummary").removeClass("sno");
    $("#acrl01__RolesList__search_row").removeClass('sno');
    $("#acrl01__RolesList__RoleScreensLaunch").addClass("sno");
    $("#acrl01__RolesList__Role_Summary_Header").removeClass("sno");
};
