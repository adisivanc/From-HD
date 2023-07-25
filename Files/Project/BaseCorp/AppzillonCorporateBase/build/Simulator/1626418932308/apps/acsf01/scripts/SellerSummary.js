apz.acsf01.sellerSummary = {};
apz.app.onLoad_SellerSummary = function() {
    if (apz.Login) {
        apz.acsf01.sellerSummary.sCorporateId = apz.Login.sCorporateId;
    } else {
        apz.acsf01.sellerSummary.sCorporateId = "000FTAC4321";
    }
    apz.acsf01.sellerSummary.getPartySummary();
};
apz.acsf01.sellerSummary.getPartySummary = function() {
    debugger;
    var req = {};
    req.tbDbmiCorpScfParty = {
        "corporateId": apz.acsf01.sellerSummary.sCorporateId,
        "type": "Seller"
    };
    req.importFunction = "SCFParty";
    var lReq = {
        "ifaceName": "PartySummary",
        "paintResp": "Y",
        "buildReq": "N",
        "req": req,
        "appId": "acsf01",
        "async": false,
        "callBack": apz.acsf01.sellerSummary.getPartySummaryCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acsf01.sellerSummary.getPartySummaryCB = function(pResp) {
   
     debugger;
    var dataLength = apz.data.scrdata.acsf01__PartySummary_Res.tbDbmiCorpScfParty.length;
    for (var i = 0; i < dataLength; i++) {
        try {
            if (apz.isNull(apz.data.scrdata.acsf01__PartySummary_Res.tbDbmiCorpScfParty[i].logo)) {
                $("#acsf01__PartySummary__o__tbDbmiCorpScfParty__logo_"+i).attr("src",
                    'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
            } 
        } catch (e) {
            $("#acsf01__PartySummary__o__tbDbmiCorpScfParty__logo_"+i).attr("src",
                'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
        }
    }
    console.log(dataLength);
};
apz.acsf01.sellerSummary.createParty = function() {
    debugger;
    $("#acsf01__SellerSummary__PartySummary_Header").addClass('sno');
     $("#acsf01__SellerSummary__MobPartySummary_Header").addClass('sno');
    $("#acsf01__SellerSummary__PartySummary_List_Row").addClass('sno');
    $("#acsf01__SellerSummary__PartyLauncherRow").removeClass('sno');
    var params = {};
    params.appId = "acsf01";
    params.scr = "SellerMaintenance";
    params.userObj = {
        "action":"Add"
    };
    params.div = "acsf01__SellerSummary__PartyDetailsLauncher";
    params.layout = "All";
     if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    apz.launchSubScreen(params);
    
};
apz.acsf01.sellerSummary.partyDetails = function(pObj) {
    debugger;
    $("#acsf01__SellerSummary__PartySummary_Header").addClass('sno');
    $("#acsf01__SellerSummary__MobPartySummary_Header").addClass('sno');
    $("#acsf01__SellerSummary__PartySummary_List_Row").addClass('sno');
    $("#acsf01__SellerSummary__PartyLauncherRow").removeClass('sno');
    var lRow = $(pObj).attr('rowno');
    var params = {};
    params.appId = "acsf01";
    params.scr = "SellerDetails";
    params.userObj = {
        "Partydetails": apz.data.scrdata.acsf01__PartySummary_Res.tbDbmiCorpScfParty[lRow]
    };
    params.div = "acsf01__SellerSummary__PartyDetailsLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.acsf01.sellerSummary.editParty = function(pObj) {
    debugger;
    $("#acsf01__SellerSummary__PartySummary_Header").addClass('sno');
    $("#acsf01__SellerSummary__MobPartySummary_Header").addClass('sno');
    $("#acsf01__SellerSummary__PartySummary_List_Row").addClass('sno');
    $("#acsf01__SellerSummary__PartyLauncherRow").removeClass('sno');
    var lRow = $(pObj).closest("li").attr('rowno');
    var params = {};
    params.appId = "acsf01";
    params.scr = "SellerMaintenance";
    params.userObj = {
        "action":"Edit",
        "Partydetails": apz.data.scrdata.acsf01__PartySummary_Res.tbDbmiCorpScfParty[lRow]
    };
    params.div = "acsf01__SellerSummary__PartyDetailsLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
    event.stopPropagation();
};
apz.acsf01.sellerSummary.search = function(event,searchBy,inputSearch) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acsf01__SellerSummary__"+searchBy);
        var lInput = apz.getElmValue("acsf01__SellerSummary__"+inputSearch);
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            lSearchType = "Seller";
            if (apz.isNull(lInput)) {
                lSearchType = "Seller";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "All") {
            if (apz.isNull(lInput)) {
                lSearchType = "Seller";
            } else {
                lSearchType = "Seller";
            }
        } else if (lType == "BuyerId") {
            if (apz.isNull(lInput)) {
                lSearchType = "Seller";
            } else {
                lSearchType = "SellerId";
            }
        } else if (lType == "SellerName") {
            if (apz.isNull(lInput)) {
                lSearchType = "Seller";
            } else {
                lSearchType = "SellerName";
            }
        }
        if (flag) {
            debugger;
            var req = {};
            req.tbDbmiCorpScfParty = {
                "corporateId": apz.acsf01.sellerSummary.sCorporateId,
                "type": lSearchType,
                "value": lInput
            };
            req.importFunction = "SCFParty";
            var lReq = {
                "ifaceName": "PartySummary",
                "paintResp": "Y",
                "buildReq": "N",
                "req": req,
                "appId": "acsf01",
                "async": false,
                "callBack": apz.acsf01.sellerSummary.getPartySummaryCB,
                "callBackObj": ""
            };
            apz.server.callServer(lReq);
        }
    }
};
