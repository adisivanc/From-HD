 apz.prtstm.AccountStatement={};
 apz.app.onLoad_AccountStatement = function() {
         //apz.setElmValue("csmrbk__LandingPage__ScreenNmeLandingTxt", "REQUEST FOR PRINTED STATEMENT")

     }
     apz.prtstm.AccountStatement.dispMsg = function(pResp, type) {
    var params = {};
    params.message = pResp;
    params.type = type;
    params.callBack = apz.app.displayMessageCallBack;
    apz.dispMsg(params);
}
apz.prtstm.AccountStatement.submit=function() {
apz.dispMsg({message:"Your request for the account statement has been submitted. We will courier the account statement to your registered address within 7 working days.", type:"S",callBack: apz.prtstm.AccountStatement.fnhome});
}
    
apz.prtstm.AccountStatement.fnCreditdisable=function() {
    debugger;
    $("#prtstm__AccountStatement__el_dpd_2").prop("disabled", true);
     $("#prtstm__AccountStatement__el_dpd_2").addClass("FTDisable");

}
apz.prtstm.AccountStatement.fnAccountdisable=function() {
    debugger;
      $("#prtstm__AccountStatement__el_dpd_2").prop("disabled", false);

    $("#prtstm__AccountStatement__el_dpd_1").prop("disabled", true);
}

apz.prtstm.AccountStatement.fnhome = function(params){
     var params = {};
    params.appId = "prtstm";
    params.scr = "Launcher";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
    //apz.launchSubScreen(params);
    apz.launchApp(params);
}