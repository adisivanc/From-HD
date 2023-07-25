apz.ddinst.CollectionSummary = {};
apz.app.onLoad_CollectionSummary = function(params)
{
    debugger;
    
apz.ddinst.CollectionSummary.sParams=params.data;

   
      
    apz.data.scrdata.ddinst__collectionSummary_Res = {};
    apz.data.scrdata.ddinst__collectionSummary_Res.collDtls = apz.ddinst.CollectionSummary.sParams;
    apz.data.loadData("collectionSummary", "ddinst")
}
apz.ddinst.CollectionSummary.fnBackButton = function() {
    debugger;
     apz.show("ddinst__CollectionDetail__detail1");
      apz.hide("ddinst__CollectionDetail__launch");
    var Params = {
        "appId": "ddinst",
        "scr": "CollectionDetail",
        "div": "ddinst__EcsLauncher__row1"
    }
    apz.launchSubScreen(Params);
};
apz.ddinst.CollectionSummary.fnSetNavigation = function(params) {
    debugger;
    apz.ddinst.CollectionSummary.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    if (!apz.isNull(params.headerText)) {
        lParams.headerText = params.headerText;
    } else {
        lParams.headerText = "DIRECT DEBIT DETAILS";
    }
    lParams.backPressed = apz.ddinst.CollectionSummary.fnBack;
    apz.ddinst.CollectionSummary.Navigation(lParams);
};
