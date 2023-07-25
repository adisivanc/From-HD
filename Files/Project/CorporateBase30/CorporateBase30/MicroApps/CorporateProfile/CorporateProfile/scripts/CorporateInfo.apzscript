apz.acpr01.CorporateInfo = {};
apz.app.onLoad_CorporateInfo = function() {
    apz.acpr01.CorporateInfo.sCorporateId = apz.Login.sCorporateId;
    apz.acpr01.CorporateInfo.sUserObj = {};
    apz.data.loadJsonData("Documents","acpr01");
    apz.acpr01.CorporateInfo.corporateInfoQuery(apz.acpr01.CorporateInfo.sCorporateId);
};
apz.app.onShown_CorporateInfo = function(){
    apz.acpr01.CorporateInfo.embedDocument();
};
apz.acpr01.CorporateInfo.corporateInfoQuery = function(pCorporateId) {
    var lServerParams = {
        "ifaceName": "CorporateInfo_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acpr01.CorporateInfo.corporateInfoQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorporateMaster = {};
    req.tbDbmiCorporateMaster.corporateId = pCorporateId;
    req.tbDbmiCorporateContact = {};
    req.tbDbmiCorporateContact.corporateId = pCorporateId;
    req.tbDbmiCorporateDirectors = {};
    req.tbDbmiCorporateDirectors.corporateId = pCorporateId;
    req.tbDbmiCorporateAddress = {};
    req.tbDbmiCorporateAddress.corporateId = pCorporateId;
    req.tbDbmiCorpFileMaster = {};
    req.tbDbmiCorpFileMaster.corporateId = pCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acpr01.CorporateInfo.openModal = function() {
    debugger;
    $(".node").removeClass("selnode");
    $(".node").addClass("selnode");
    var params = {
        "targetId": "acpr01__CorporateInfo__Launch_chart"
    };
    apz.toggleModal(params);
};
apz.acpr01.CorporateInfo.corporateInfoQueryCB = function(presp) {
    debugger;
    var lFiletypeArr = apz.data.scrdata.acpr01__CorporateInfo_Req.tbDbmiCorpFileMaster;
    var lFileArr = apz.acpr01.CorporateInfo.GetDetails(lFiletypeArr);
    for (var i = 0; i < lFileArr.length; i++) {
        lFileArr[i].extension = lFileArr[i].extension.toString();
    }
    apz.data.scrdata.acpr01__FiletypeDummy_Req = {};
    apz.data.scrdata.acpr01__FiletypeDummy_Req.Filetypes = lFileArr;
    apz.data.loadData('FiletypeDummy');
    apz.acpr01.CorporateInfo.fetchHierarchy();
};
apz.acpr01.CorporateInfo.fetchHierarchy = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "CorporateHierarchy_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acpr01.CorporateInfo.FetchCorporateHierarchyCB,
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acpr01.CorporateInfo.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acpr01.CorporateInfo.FetchCorporateHierarchyCB = function(pResp) {
    debugger;
    if (pResp.resFull.appzillonBody.acpr01__CorporateHierarchy_Res) {
        var lDataSource = pResp.resFull.appzillonBody.acpr01__CorporateHierarchy_Res.tbDbmiCorpEntityMaster;
    } else {
        var lDataSource = pResp.resFull.appzillonBody.acpr01__CorporateHierarchy_Req.tbDbmiCorpEntityMaster;
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
        org_chart = $('#acpr01__CorporateInfo__drag_node_loader').orgChart({
            data: lChartArr, // your data
            showControls: false, // display add or remove node button.
            allowEdit: false, // click the node's title to edit
            onAddNode: function(node) {},
            onDeleteNode: function(node) {},
            onClickNode: function(node) {},
            newNodeText: 'Add Child', // text of add button
            createNode: function($node, data) {
                console.log(data);
            }
        });
    });
    
};

apz.acpr01.CorporateInfo.checkAccess = function(pUserObj) {
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acpr01__CorporateInfo__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": pUserObj
    };
    apz.launchApp(lParams);
}
apz.acpr01.CorporateInfo.modifyAddress = function(pObj) {
    debugger;
    var lPage = apz.scrMetaData.containersMap['acpr01__CorporateInfo__Address_List'].currPage;
    var lRecord = (lPage - 1) * 4 + parseInt($(pObj).attr('rowno'));
    apz.acpr01.CorporateInfo.sUserObj = {
        "CorpMasterData": apz.data.scrdata.acpr01__CorporateInfo_Req.tbDbmiCorporateMaster,
        "CorpAddressData": apz.data.scrdata.acpr01__CorporateInfo_Req.tbDbmiCorporateAddress,
        "recordNo": lRecord,
        "div":"acpr01__CorporateInfo__ModifyScreen"
    };
    lUserObj = {};
    lUserObj.workflowId = "CPMA";
    lUserObj.task = "INPUT";
    lUserObj.callBack = apz.acpr01.CorporateInfo.modifyAddressCB;
    //lUserObj.operation = "CHECKACCESS";
    lUserObj.operation = "INITIALISE";
    lUserObj.action = "CHECKACCESS";
    
    
    // lUserObj = {
    //     "operation":"INITIALISE",
    //     "action":"CHECKACCESS",
    //     "data":{
    //         "workflowId":"CPMA",
    //         "task":"INPUT",
    //         "callBack":apz.acpr01.CorporateInfo.modifyAddressCB
    //     }
    // }
    
    
    apz.acpr01.CorporateInfo.checkAccess(lUserObj);
};
apz.acpr01.CorporateInfo.modifyAddressCB = function(pResp) {
    apz.currAppId = 'acpr01';
    if (pResp) {
        $("#acpr01__CorporateInfo__ProfileMain").addClass("sno");
        $("#acpr01__CorporateInfo__ModifyScreen").removeClass("sno");
        $("#acpr01__CorporateInfo__Corporate_Main_Header").addClass("sno");
        $("#acpr01__CorporateInfo__Corporate_Sub_Header").addClass("sno");
        $("#acpr01__CorporateInfo__RegistrationDetails").addClass("sno");
        var params = {};
        params.appId = "acpr01";
        params.scr = "ModifyAddress";
        params.layout = "All";
        params.div = "acpr01__CorporateInfo__ModifyScreen";
        params.userObj = apz.acpr01.CorporateInfo.sUserObj;
        apz.launchSubScreen(params);
    } else {
        //write your action here.
    }
};
apz.acpr01.CorporateInfo.modifyContact = function(pObj) {
    debugger;
    var lPage = apz.scrMetaData.containersMap['acpr01__CorporateInfo__Contacts_List'].currPage;
    var lRecord = (lPage - 1) * 5 + parseInt($(pObj).attr('rowno'));
    apz.acpr01.CorporateInfo.sUserObj = {
        "CorpMasterData": apz.data.scrdata.acpr01__CorporateInfo_Req.tbDbmiCorporateMaster,
        "CorpContactData": apz.data.scrdata.acpr01__CorporateInfo_Req.tbDbmiCorporateContact,
        "recordNo": lRecord,
        "div":"acpr01__CorporateInfo__ModifyScreen"
    };
    lUserObj = {};
    lUserObj.workflowId = "CPMC";
    lUserObj.task = "INPUT";
    lUserObj.callBack = apz.acpr01.CorporateInfo.modifyContactCB;
    //lUserObj.operation = "CHECKACCESS";
     lUserObj.operation = "INITIALISE";
    lUserObj.action = "CHECKACCESS";
    apz.acpr01.CorporateInfo.checkAccess(lUserObj);
};
apz.acpr01.CorporateInfo.modifyContactCB = function(pResp) {
    apz.currAppId = 'acpr01';
    if (pResp) {
        //  $("#acpr01__CorporateInfo__ModifyModal_window .modal-header li").find("h1").text("Modify Contact");
        $("#acpr01__CorporateInfo__ProfileMain").addClass("sno");
        $("#acpr01__CorporateInfo__ModifyScreen").removeClass("sno");
        $("#acpr01__CorporateInfo__Corporate_Main_Header").addClass("sno");
        $("#acpr01__CorporateInfo__Corporate_Sub_Header").addClass("sno");
        $("#acpr01__CorporateInfo__RegistrationDetails").addClass("sno");
        var params = {};
        params.appId = "acpr01";
        params.scr = "ModifyContact";
        params.layout = "All";
        params.div = "acpr01__CorporateInfo__ModifyScreen";
        params.userObj = apz.acpr01.CorporateInfo.sUserObj;
        apz.launchSubScreen(params);
    } else {}
};
apz.acpr01.CorporateInfo.modifyDirectors = function(pObj) {
    var lPage = apz.scrMetaData.containersMap['acpr01__CorporateInfo__Directors_List'].currPage;;
    var lRecord = (lPage - 1) * 5 + parseInt($(pObj).attr('rowno'));
    apz.acpr01.CorporateInfo.sUserObj = {
        "CorpMasterData": apz.data.scrdata.acpr01__CorporateInfo_Req.tbDbmiCorporateMaster,
        "CorpDirectorsData": apz.data.scrdata.acpr01__CorporateInfo_Req.tbDbmiCorporateDirectors,
        "recordNo": lRecord,
         "div":"acpr01__CorporateInfo__ModifyScreen"
    }
    lUserObj = {};
    lUserObj.workflowId = "CPMD";
    lUserObj.task = "INPUT";
    lUserObj.callBack = apz.acpr01.CorporateInfo.modifyDirectorsCB;
   // lUserObj.operation = "CHECKACCESS";
     lUserObj.operation = "INITIALISE";
    lUserObj.action = "CHECKACCESS";
    apz.acpr01.CorporateInfo.checkAccess(lUserObj);
};
apz.acpr01.CorporateInfo.modifyDirectorsCB = function(pResp) {
    apz.currAppId = 'acpr01';
    if (pResp) {
        $("#acpr01__CorporateInfo__ProfileMain").addClass("sno");
        $("#acpr01__CorporateInfo__ModifyScreen").removeClass("sno");
        $("#acpr01__CorporateInfo__Corporate_Main_Header").addClass("sno");
        $("#acpr01__CorporateInfo__Corporate_Sub_Header").addClass("sno");
        $("#acpr01__CorporateInfo__RegistrationDetails").addClass("sno");
        var params = {};
        params.appId = "acpr01";
        params.scr = "ModifyDirectors";
        params.layout = "All";
        params.div = "acpr01__CorporateInfo__ModifyScreen";
        params.userObj = apz.acpr01.CorporateInfo.sUserObj;
        apz.launchSubScreen(params);
    } else {}
};
apz.acpr01.CorporateInfo.GetDetails = function(ldata) {
    var larray = [];
    var ltypes = [];
    for (var i = 0; i < ldata.length; i++) {
        if (ltypes.indexOf(ldata[i].type) == -1) {
            ltypes.push(ldata[i].type);
            var myres = ldata.filter(function(item) {
                return item.type == ldata[i].type;
            });
            var ld = apz.acpr01.CorporateInfo.GetUnique(myres, "extension");
            var lobj = {};
            lobj.type = ldata[i].type;
            lobj.extension = ld;
            larray.push(lobj);
        }
    };
    return larray;
};
apz.acpr01.CorporateInfo.GetUnique = function(inArr, ltype) {
    var outArr = [];
    for (var i = 0; i < inArr.length; i++) {
        if (outArr.indexOf(inArr[i][ltype]) == -1) {
            outArr.push(inArr[i][ltype]);
        }
    }
    return outArr;
};
apz.acpr01.CorporateInfo.embedDocument = function(){
    var lFilePath = apz.getDataFilesPath("acpr01")+"/CertificateofIncorp.json";
    var lFile = apz.getFile(lFilePath);
    var lCertIncorp = JSON.parse(lFile).data;
    $("#acpr01__CorporateInfo__document_launcher").append('<object data="data:image/jpeg;base64,'+lCertIncorp+'" type="image/jpeg" width="100%"></object>');
}
apz.acpr01.CorporateInfo.showDocument = function(){
    apz.toggleModal({targetId:"acpr01__CorporateInfo__document_modal"});
};