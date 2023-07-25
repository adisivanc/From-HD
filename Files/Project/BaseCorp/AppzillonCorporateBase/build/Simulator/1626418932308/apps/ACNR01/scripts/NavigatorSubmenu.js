apz.ACNR01.NavigatorSubmenu = {};
apz.app.onLoad_NavigatorSubmenu = function(pUserObj){
    apz.data.scrdata.ACNR01__SubMenuList_Req = pUserObj;
    apz.data.loadData("SubMenuList","ACNR01");
}
apz.ACNR01.NavigatorSubmenu.menuClick = function(pObj, event) {
    debugger
    var lScr = $(pObj).find("span[id*='screenId']").text();
    var lAppId = $(pObj).find("span[id*='appId']").text();
    var lLayout = "All";
    var lDesc = lScr;
    if (lAppId != "" && lScr != "") {
        apz.ACNR01.Navigator.launchApp(lAppId, lScr, lLayout, lDesc);
    } else {}
};