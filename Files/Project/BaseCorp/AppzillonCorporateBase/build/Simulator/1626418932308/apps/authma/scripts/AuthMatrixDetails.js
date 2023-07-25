apz.authma.authMatrixDetails = {};
apz.authma.authMatrixDetails.sCache = {};
apz.app.onLoad_AuthMatrixDetails = function(pResp) {
    if (pResp.acc_group) {
        apz.authma.authMatrixDetails.sCache = pResp;
        apz.data.loadJsonData("AuthMatrix");
        apz.setElmValue("authma__AuthMatrix__o__authma__AuthMatrix_Res__acc_grp", pResp.acc_group);
    }else{
        apz.data.scrdata.authma__AuthMatrix_Res = [];
        apz.data.loadData("AuthMatrix","authma");
    }
};
apz.authma.authMatrixDetails.showAuthorizerDetails = function(pObj) {
    if (apz.authma.authMatrixDetails.sCache.acc_group) {
        var rowno = $(pObj).attr("rowno");
        var preDataChangeObj = apz.copyJSONObject(apz.data.scrdata.authma__AuthMatrix_Res.amount_det[0].auth_det);
        apz.data.scrdata.authma__AuthMatrix_Res.amount_det[0].auth_det = apz.data.scrdata.authma__AuthMatrix_Res.amount_det[rowno].auth_det
    }
    apz.toggleModal({
        targetId: "authma__AuthMatrixDetails__auth_modal"
    });
    if (apz.authma.authMatrixDetails.sCache.acc_group) {
        var acc_group = apz.getElmValue("authma__AuthMatrix__o__authma__AuthMatrix_Res__acc_grp");
        setTimeout(function(){
        apz.data.loadJsonData("AuthMatrix", "authma");
        apz.setElmValue("authma__AuthMatrix__o__authma__AuthMatrix_Res__acc_grp", acc_group);
        apz.data.scrdata.authma__AuthMatrix_Res.amount_det[0].auth_det = preDataChangeObj;
        },300);
    }
};
apz.authma.authMatrixDetails.save = function() {
    apz.dispMsg({
        message: "Details saved successfully",
        type: "S"
    });
    apz.launchSubScreen({
        div: "authma__AuthMatrixLauncher__authmatrix_launcher",
        scr: "AuthMatrixSummary",
        appId: "authma",
        layout: "All"
    });
};
apz.authma.authMatrixDetails.cancel = function() {
    apz.launchSubScreen({
        div: "authma__AuthMatrixLauncher__authmatrix_launcher",
        scr: "AuthMatrixSummary",
        appId: "authma",
        layout: "All"
    });
};
