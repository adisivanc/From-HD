//declaration
apz.promtn.ViewPromotion = {};
apz.promtn.ViewPromotion.sCache = {};
//on load functon
apz.app.onLoad_ViewPromotion = function() {
    debugger;
    /*$("#"+params.div).removeClass("sno");
    apz.promtn.ViewPromotion.sCache = params;
    if (params.Navigation) {
        apz.promtn.ViewPromotion.fnSetNavigation(params);
    }
    apz.promtn.ViewPromotion.fnGetViewPromotion(params.id);*/
    apz.data.loadJsonData("PromotionsList");
}
//get view details from db
apz.promtn.ViewPromotion.fnGetViewPromotion=function(){
    var lServerParams = {
        "ifaceName": "PromotionsList_Query",
        "buildReq": "Y",
        "paintResp": "Y",
        "appId":"promtn",
        "async": false,
        "callBack": apz.promtn.ViewPromotion.fnGetViewPromotionCB
    };
    apz.server.callServer(lServerParams);
}
//callback function for get view details
apz.promtn.ViewPromotion.fnGetViewPromotionCB=function(sParams){
    console.log("asdfa")
    debugger
}
apz.promtn.ViewPromotion.fnSetNavigation = function(params) {
    debugger;
    apz.promtn.ViewPromotion.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    if (!apz.isNull(params.headerText)) {
        lParams.headerText = params.headerText;
    } else {
        lParams.headerText = "PROMOTIONS";
    }
    // lParams.backPressed = apz.cuacpf.CustAccPort.fnBack;
    apz.promtn.ViewPromotion.Navigation(lParams);
};
