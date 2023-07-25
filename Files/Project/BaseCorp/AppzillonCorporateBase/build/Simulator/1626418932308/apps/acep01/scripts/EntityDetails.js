apz.acep01.EntityDetails = {};
apz.acep01.EntityDetails.sCorporateEntityId = "";
apz.acep01.EntityDetails.sEntityId = "";
apz.app.onLoad_EntityDetails = function(params) {
    debugger;
    $("#acep01__CorporateHierarchy__entityGrayArea").addClass('sno');
    $("#acep01__CorporateHierarchy__Entity_Main_Header").addClass('sno');
    $("#acep01__CorporateHierarchy__LaunchEntityRow").removeClass("sno");
    apz.acep01.EntityDetails.sCorporateId = apz.acep01.CorporateHierarchy.sCorporateId;
    apz.acep01.EntityDetails.sEntityId = params.EntityId;
    apz.acep01.EntityDetails.fetchEntityDetails(params.EntityId);
};
apz.app.onShown_EntityDetails = function(params) {
    debugger;
    setTimeout(function() {
        var lCurrentEntity = apz.acep01.EntityDetails.sEntityId;
        var lNodes = $("#acep01__EntityDetails__drag_node_loader").find(".node");
        var lNodesLength = lNodes.length;
        for (var j = 0; j < lNodesLength; j++) {
            var lEntityId = $(lNodes[j]).attr('node-id');
            if (lCurrentEntity == lEntityId) {
                $(lNodes[j]).toggleClass('selnode');
            }
        }
    }, 10);
};
apz.acep01.EntityDetails.fetchEntityDetails = function(pEntityId) {
    debugger;
    apz.acep01.EntityDetails.sCorporateEntityId = apz.acep01.EntityDetails.sCorporateId + "__" + pEntityId;
    var lServerParams = {
        "ifaceName": "EntityInfo_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acep01.EntityDetails.fetchEntityDetailsCB,
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acep01.EntityDetails.sCorporateId;
    req.tbDbmiCorpEntityMaster.entityId = pEntityId;
    req.tbDbmiCorporateContact = {};
   // req.tbDbmiCorporateContact.corporateId = apz.acep01.EntityDetails.sCorporateEntityId;
   req.tbDbmiCorporateContact.corporateId = apz.acep01.EntityDetails.sCorporateId;
    req.tbDbmiCorporateAddress = {};
    //req.tbDbmiCorporateAddress.corporateId = apz.acep01.EntityDetails.sCorporateEntityId;
    req.tbDbmiCorporateAddress.corporateId = apz.acep01.EntityDetails.sCorporateId;
    req.tbDbmiCorporateContact = {};
    //req.tbDbmiCorporateContact.corporateId = apz.acep01.EntityDetails.sCorporateEntityId;
    req.tbDbmiCorporateContact.corporateId = apz.acep01.EntityDetails.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acep01.EntityDetails.fetchEntityDetailsCB = function(presp) {
    debugger;
    if (!presp.errors) {
        apz.acep01.EntityDetails.fetchHierarchy();
    }
};
apz.acep01.EntityDetails.fetchHierarchy = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "CorporateHierarchy_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acep01.EntityDetails.FetchCorporateHierarchyCB,
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acep01.EntityDetails.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acep01.EntityDetails.FetchCorporateHierarchyCB = function(pResp) {
    debugger;
    if (pResp.resFull.appzillonBody.acep01__CorporateHierarchy_Res) {
        var lDataSource = pResp.resFull.appzillonBody.acep01__CorporateHierarchy_Res.tbDbmiCorpEntityMaster;
    } else {
        var lDataSource = pResp.resFull.appzillonBody.acep01__CorporateHierarchy_Req.tbDbmiCorpEntityMaster;
    }
    var lArrLength = lDataSource.length;
    var lChartArr = [];
    for (var i = 0; i < lArrLength; i++) {
        var lObj = {};
        lObj.id = lDataSource[i].entityId;
        lObj.name = lDataSource[i].entityName + "<br><h3>" + lDataSource[i].entityId + "</h3>";
        lObj.parent = lDataSource[i].parentEntity;
        lChartArr.push(lObj);
    }
    $(function() {
        org_chart = $('#acep01__EntityDetails__drag_node_loader').orgChart({
            data:lChartArr,
            showControls: false, // display add or remove node button.
            allowEdit: false // click the node's title to edit
            
        });
    });
};
apz.acep01.EntityDetails.modifyAddress = function(pObj) {
    debugger;
    $("#acep01__EntityDetails__LaunchScreen").removeClass("sno");
    $("#acep01__EntityDetails__EntityDetailsRow").addClass("sno");
    $("#acep01__EntityDetails__Entity_Detail_Header").addClass('sno');
    $("#acep01__EntityDetails__EntityDetails_Sub_Header").addClass('sno');
    $("#acep01__EntityDetails__Back_Btn_Row").addClass('sno');
    var lPage = apz.scrMetaData.containersMap['acep01__EntityDetails__Address_List'].currPage;
    var lRecord = (lPage - 1) * 2 + parseInt($(pObj).attr('rowno'));
    var params = {};
    params.appId = "acep01";
    params.scr = "ModifyAddress";
    //params.div = "acep01__EntityDetails__LaunchScreen";
    params.div = "acep01__CorporateHierarchy__LaunchScreen";
    params.layout = "All";
    params.userObj = {
        "CorpAddressData": apz.data.scrdata.acep01__EntityInfo_Req.tbDbmiCorporateAddress,
        "CorpAddressMaster": apz.data.scrdata.acep01__EntityInfo_Req.tbDbmiCorpEntityMaster,
        "recordNo": lRecord,
        "div":"acep01__CorporateHierarchy__LaunchScreen"
    };
    apz.launchSubScreen(params);
};
apz.acep01.EntityDetails.modifyContacts = function(pObj) {
    debugger;
    $("#acep01__EntityDetails__LaunchScreen").removeClass("sno");
    $("#acep01__EntityDetails__EntityDetailsRow").addClass("sno");
    $("#acep01__EntityDetails__Entity_Detail_Header").addClass('sno');
    $("#acep01__EntityDetails__EntityDetails_Sub_Header").addClass('sno');
    $("#acep01__EntityDetails__Back_Btn_Row").addClass('sno');
    var lPage = apz.scrMetaData.containersMap['acep01__EntityDetails__Contact_List'].currPage;
    var lRecord = (lPage - 1) * 3 + parseInt($(pObj).attr('rowno'));
    var params = {};
    params.appId = "acep01";
    params.scr = "ModifyContact";
   // params.div = "acep01__EntityDetails__LaunchScreen";
   params.div = "acep01__CorporateHierarchy__LaunchScreen";
    params.layout = "All";
    params.userObj = {
        "CorpContactData": apz.data.scrdata.acep01__EntityInfo_Req.tbDbmiCorporateContact,
        "CorpContactMaster": apz.data.scrdata.acep01__EntityInfo_Req.tbDbmiCorpEntityMaster,
        "recordNo": lRecord,
         "div":"acep01__CorporateHierarchy__LaunchScreen"
    };
    apz.launchSubScreen(params);
};
apz.acep01.EntityDetails.Cancel = function() {
    $("#acep01__CorporateHierarchy__LaunchScreen").addClass("sno");
    $("#acep01__CorporateHierarchy__EntitySummary").removeClass("sno");
    $("#acep01__CorporateHierarchy__entityGrayArea").removeClass('sno');
    $("#acep01__CorporateHierarchy__Entity_Main_Header").removeClass('sno');
    $("#acep01__CorporateHierarchy__LaunchEntityRow").addClass("sno");
};
apz.acep01.EntityDetails.openModal = function() {
    debugger;
    var params = {
        "targetId": "acpr01__CorporateInfo__Launch_chart"
    };
    apz.toggleModal(params);
};
