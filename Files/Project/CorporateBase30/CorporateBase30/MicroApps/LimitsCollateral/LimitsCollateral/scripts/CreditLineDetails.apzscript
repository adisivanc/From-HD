 apz.ficl01.CreditLineDetails = {};
 apz.app.onLoad_CreditLineDetails = function(params){
 //apz.show("ficl01__FCSummary__backIcon");
 //$("#ficl01__FCSummary__el_txt_1").text("CREDIT LINES");
    apz.ficl01.CreditLineDetails.getCreditLineDetails(params.refNo);


 };
apz.ficl01.CreditLineDetails.getCreditLineDetails = function(pRef){
    var req = {
        "CreditLineDetails": {
            "lineId": pRef
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_credit_line";
    var lServerParams = {
        "ifaceName": "FetchCreditLineService",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.CreditLineDetails.getCreditLineDetailsCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.ficl01.CreditLineDetails.getCreditLineDetailsCB = function(pResp){
    if (pResp.status === true && pResp.resFull.appzillonHeader.status === true) {
        if (pResp.res.ficl01__FetchCreditLineService_Res.Status) {} else {
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": pResp.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.ficl01.CreditLineDetails.fnCancel = function(){
    // apz.hide("ficl01__FCSummary__backIcon");
    // apz.show("ficl01__FCSummary__liclrow");
    // $("#ficl01__FCSummary__subScreenLauncher").html("");
    // apz.ficl01.FCSummary.showCreditLine();
    
     apz.show("ficl01__CreditLineList__lineHeader");
     apz.hide("ficl01__CreditLineList__subScreenLauncher");
     apz.show("ficl01__CreditLineList__lineListRow");
     apz.ficl01.CreditLineList.getCreditLineList();
     apz.setElmValue("ficl01__CreditLineList__SearchValue","");
     apz.setElmValue("ficl01__CreditLineList__SearchBy","Search");
     
};
