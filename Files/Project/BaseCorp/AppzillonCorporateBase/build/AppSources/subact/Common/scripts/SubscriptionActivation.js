apz.subact.SubscriptionActivation = {};
apz.app.onLoad_SubscriptionActivation = function() {
    debugger;
    $("#subact__SubscriptionActivation__ct_tbl_1_add_btn").addClass("sno");
    $("#subact__SubscriptionActivation__ct_tbl_1_rem_btn").addClass("sno");
    apz.subact.SubscriptionActivation.fnLoadUsers();
}
apz.subact.SubscriptionActivation.fnLoadUsers = function() {
    debugger;
    var lUserArr = [{
        "val": "Apply to All Users",
        "desc": "Apply to All Users"
        },{
        "val": "Robert Langford",
        "desc": "Robert Langford"
    }, {
        "val": "Patrick Wilson",
        "desc": "Patrick Wilson"
    }, {
        "val": "Mike Smith",
        "desc": "Mike Smith"
    }, {
        "val": "Melanie Davis",
        "desc": "Melanie Davis"
    }, {
        "val": "Mohammad Nawaz",
        "desc": "Mohammad Nawaz"
    }, {
        "val": "Josh Ackerman",
        "desc": "Josh Ackerman"
    }, {
        "val": "Bernard Wilkes",
        "desc": "Bernard Wilkes"
    }, {
        "val": "Abdul Hamid",
        "desc": "Abdul Hamid"
    }];
    apz.populateDropdown(document.getElementById("subact__SubscriptionActivation__ddlUsers"), lUserArr);
    var lCorpArr = [{
        "val": "ACMECORP",
        "desc": "ACMECORP"
    }, {
        "val": "ACMEPharma",
        "desc": "ACME Pharma"
    }, {
        "val": "ACMEFoodProcessing",
        "desc": "ACME Food Processing"
    }, {
        "val": "ACMECosmetics",
        "desc": "ACME Cosmetics"
    }, {
        "val": "ACMEBeverages",
        "desc": "ACME Beverages"
    }, {
        "val": "ACMEDiaryProducts",
        "desc": "ACME Diary Products"
    }];
    apz.populateDropdown(document.getElementById("subact__SubscriptionActivation__ddlCorpId"), lCorpArr);
    apz.subact.SubscriptionActivation.fnLoadMenuList();
}
apz.subact.SubscriptionActivation.fnLoadMenuList = function() {
    debugger;
    var params = {};
    params.buildReq = "N";
    params.paintResp = "N";
    params.req = {};
    params.ifaceName = "GetAllMenu_Query";
    params.async = true;
    params.callBack = apz.subact.SubscriptionActivation.fnLoadMenuListCB;
    apz.server.callServer(params);
}
apz.subact.SubscriptionActivation.fnLoadMenuListCB = function(params) {
    debugger;
    var ldata = params.res.subact__GetAllMenu_Res.tbDbmiScreenMaster;
    
    apz.data.loadJsonData("BindMenuItem","subact");
    // apz.data.scrdata.subact__BindMenuItem_Res = {};
    // apz.data.scrdata.subact__BindMenuItem_Res.ListItem = ldata;
    // apz.data.loadData("BindMenuItem", "subact");
    
    //  for (let i = 0; i < apz.data.scrdata.subact__GetAllMenu_Res.tbDbmiScreenMaster.length; i++) {
    //     apz.data.scrdata.subact__BindMenuItem_Res.ListItem[i].Status = "Inactive";
    // }
}
apz.subact.SubscriptionActivation.fnContinue = function() {
    debugger;
    // for (let i = 0; i < apz.data.scrdata.subact__GetAllMenu_Res.tbDbmiScreenMaster.length; i++) {
    //     apz.data.scrdata.subact__BindMenuItem_Res.ListItem[i].Status = apz.getElmValue("subact__SubscriptionActivation__el_rdo_1_" + i);
    // }
    
     for (let i = 0; i < apz.data.scrdata.subact__BindMenuItem_Res.ListItem.length; i++) {
        apz.data.scrdata.subact__BindMenuItem_Res.ListItem[i].Status = apz.getElmValue("subact__SubscriptionActivation__el_rdo_1_" + i);
    }

    var params = {};
    params.appID = "subact";
    params.scr = "SubscriptionVerify";
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = apz.data.scrdata.subact__BindMenuItem_Res.ListItem;
    params.userObj.Corpid = apz.getElmValue("subact__SubscriptionActivation__ddlCorpId");
    params.userObj.User = apz.getElmValue("subact__SubscriptionActivation__ddlUsers");
    apz.launchSubScreen(params);
}
