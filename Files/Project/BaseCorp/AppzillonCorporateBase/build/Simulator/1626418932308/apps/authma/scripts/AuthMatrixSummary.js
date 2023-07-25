apz.authma.authMatrixSummary = {};
apz.app.onLoad_AuthMatrixSummary = function(){
    apz.data.loadJsonData("AuthMatrixSummary","authma");
}
apz.authma.authMatrixSummary.addNewAuthMatrix = function() {
    apz.launchSubScreen({
        div: "authma__AuthMatrixLauncher__authmatrix_launcher",
        scr: "AuthMatrixDetails",
        appId: "authma",
        layout: "All"
    });
};
apz.authma.authMatrixSummary.showAuthMatrixDetails = function(pObj){
    var rowno = $(pObj).attr("rowno");
    var acc_group = apz.data.scrdata.authma__AuthMatrixSummary_Res[rowno].acc_group;
    apz.launchSubScreen({
        div: "authma__AuthMatrixLauncher__authmatrix_launcher",
        scr: "AuthMatrixDetails",
        appId: "authma",
        layout: "All",
        userObj:{"acc_group":acc_group}
    });
};
