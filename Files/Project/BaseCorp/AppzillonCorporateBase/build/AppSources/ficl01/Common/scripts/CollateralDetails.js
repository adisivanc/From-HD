apz.ficl01.CollateralDetails = {};
apz.app.onLoad_CollateralDetails = function(params){
   // apz.show("ficl01__FCSummary__backIcon");
    //$("#ficl01__FCSummary__el_txt_1").text("COLLATERALS");
    apz.ficl01.CollateralDetails.getCollateralsDetails(params.refNo);
};
apz.ficl01.CollateralDetails.getCollateralsDetails = function(pRef){
    var req = {
        "CollateralsDetails": {
            "referenceNumber": pRef
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_collaterals";
    var lServerParams = {
        "ifaceName": "FetchCollateralsService",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.CollateralDetails.getCollateralsDetailsCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.ficl01.CollateralDetails.getCollateralsDetailsCB = function(pResp){
    debugger;
    if (pResp.status === true && pResp.resFull.appzillonHeader.status === true) {
        if (pResp.res.ficl01__FetchCollateralsService_Res.Status) {} else {
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
apz.ficl01.CollateralDetails.fnCancel = function(){
    // apz.hide("ficl01__FCSummary__backIcon");
    // apz.show("ficl01__FCSummary__liclrow");
    // $("#ficl01__FCSummary__subScreenLauncher").html("");
    // apz.ficl01.FCSummary.showCollaterals();
    
     apz.show("ficl01__CollateralList__colHeader");
     apz.show("ficl01__CollateralList__MobcolHeader");
     apz.hide("ficl01__CollateralList__subScreenLauncher");
     apz.show("ficl01__CollateralList__colListRow");
     apz.ficl01.CollateralList.fetchCollateralsList();
     apz.setElmValue("ficl01__CollateralList__SearchValue","");
     apz.setElmValue("ficl01__CollateralList__SearchBy","Search");
     
};
