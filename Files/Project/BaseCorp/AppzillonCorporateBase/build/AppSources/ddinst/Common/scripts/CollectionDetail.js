//apz.ddinst.collectionDetail = {};
apz.ddinst.CollectionDetail = {};
apz.app.onLoad_CollectionDetail = function(params) {
    debugger;
    apz.ddinst.CollectionDetail.Sparams = params;
    if (params.Navigation) {
        apz.ddinst.CollectionDetail.fnSetNavigation(params);
    }

    var params = {
        "ifaceName": "collectionDetails_Query",
        "paintResp": "Y",
        "req": {
            
        }
        
    };
    apz.ddinst.CollectionDetail.fnBeforeCallServer(params);
}

apz.ddinst.CollectionDetail.fnBeforeCallServer = function(params) {
    debugger;
    var lServerParams = {
        "ifaceName": params.ifaceName,
        "buildReq": "Y",
        "req": params.req,
        "paintResp": params.paintResp,
        "async": true,
        "callBack": apz.ddinst.CollectionDetail.fnCallServerCallBack,
        "callBackObj": "",
    };
  //  apz.server.callServer(lServerParams);
      jsondata   = JSON.parse(apz.getFile(apz.getDataFilesPath("ddinst") + "/collectionDetails.json"));
      apz.ddinst.CollectionDetail.fnCallServerCallBack(jsondata);

};
apz.ddinst.CollectionDetail.fnCallServerCallBack = function(params) {
    debugger;
}
apz.ddinst.CollectionDetail.fnSetNavigation = function(params) {
    debugger;
    apz.ddinst.CollectionDetail.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    if (!apz.isNull(params.headerText)) {
        lParams.headerText = params.headerText;
    } else {
        lParams.headerText = "DIRECT DEBIT SUMMARY";
    }
    lParams.backPressed = apz.ddinst.CollectionDetail.fnBack;
    apz.ddinst.CollectionDetail.Navigation(lParams);
};
apz.ddinst.CollectionDetail.fnAdd = function(pthis) {
    debugger;
   var lrow = parseInt($(pthis).attr("rowno"));
    apz.hide("ddinst__CollectionDetail__detail1");
      apz.show("ddinst__CollectionDetail__launch");
    var Params = {
        "appId": "ddinst",
        "scr": "CollectionSummary",
        "div": "ddinst__CollectionDetail__gr_col_4",
        "userObj": {
             "data": apz.data.scrdata.ddinst__collectionDetails_Res.collDtls[lrow],
        }
    }
    if (apz.ddinst.CollectionDetail.Sparams.Navigation) {
        Params.userObj.Navigation = apz.ddinst.CollectionDetail.Sparams.Navigation
    }
    apz.launchSubScreen(Params);
}
