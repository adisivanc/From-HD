apz.authma.accountGroupDetails = {};
apz.app.onLoad_AccountGroupDetails = function(pResp) {
    if (pResp.acc_group) {
        apz.data.scrdata.authma__AccountGroup_Res = [];
        apz.data.scrdata.authma__AccountGroup_Res.push(pResp.acc_group);
        apz.data.loadData("AccountGroup", "authma");
    }
}
apz.authma.accountGroupDetails.save = function() {
    apz.dispMsg({
        message: "Details saved successfully",
        type: "S"
    });
    apz.launchSubScreen({
        div: "authma__AccountGroupLauncher__accgrp_launcher",
        scr: "AccountGroupSummary",
        appId: "authma",
        layout: "All"
    });
};
apz.authma.accountGroupDetails.cancel = function() {
    apz.launchSubScreen({
        div: "authma__AccountGroupLauncher__accgrp_launcher",
        scr: "AccountGroupSummary",
        appId: "authma",
        layout: "All"
    });
};