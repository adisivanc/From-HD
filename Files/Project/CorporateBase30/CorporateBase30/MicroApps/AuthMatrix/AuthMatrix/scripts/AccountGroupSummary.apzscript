apz.authma.accountGroupSummary = {};
apz.app.onLoad_AccountGroupSummary = function(){
    apz.data.loadJsonData("AccountGroup","authma");
}
apz.authma.accountGroupSummary.addNewAccGroup = function() {
    apz.launchSubScreen({
        div: "authma__AccountGroupLauncher__accgrp_launcher",
        scr: "AccountGroupDetails",
        appId: "authma",
        layout: "All"
    });
};
apz.authma.accountGroupSummary.showAccGroupDetails = function(pObj){
    var rowno = $(pObj).attr("rowno");
    var acc_group = apz.data.scrdata.authma__AccountGroup_Res[rowno];
    apz.launchSubScreen({
        div: "authma__AccountGroupLauncher__accgrp_launcher",
        scr: "AccountGroupDetails",
        appId: "authma",
        layout: "All",
        userObj:{"acc_group":acc_group}
    });
};
