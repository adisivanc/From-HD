apz.funtra.confirmDetails = {};
apz.funtra.confirmDetails.sCache = {};

apz.app.onLoad_ConfirmDetails = function(params) {
    apz.funtra.confirmDetails.sCache = params;
    $("#csmrbk__LandingPage__backCol p").text("Transfer Details");
    $("#funtra__ConfirmDetails__el_txt_6_txtcnt").text(apz.funtra.transferDetails.sCache.custInfo.customerNameLine1);
    $("#funtra__ConfirmDetails__custId").text("Customer Id : "+apz.custdb.dashboard.sCustInfo.customerNbr)
    apz.data.scrdata.funtra__ConfirmDetails_Res = {};
    apz.data.scrdata.funtra__ConfirmDetails_Res.details = apz.funtra.confirmDetails.sCache.transferDet;
    apz.data.loadData("ConfirmDetails","funtra");
};

apz.funtra.confirmDetails.fnConfirmStatus = function(){
     var lServerParams = {
            "ifaceName": "PostStandingOrder",
            "buildReq": "N",
            "req": {},
            "paintResp": "N",
            "async": "",
            "callBack": apz.funtra.confirmDetails.fnDbCallback,
            "callBackObj": "",
        };
        lServerParams.req = {
            "reqDetails": {
                "action": "postStandingOrder",
                "fromAcc":parseInt(apz.funtra.confirmDetails.sCache.transferDet.fromAcc),
                "toAcc": parseInt(apz.funtra.confirmDetails.sCache.transferDet.toAcc),
                "amt": parseFloat($("#funtra__ConfirmDetails__o__details__amt").text().split(",").join("")),
                "token":apz.csmrbk.landingpage.sDepositToken
            }
        }
        apz.startLoader();
        apz.server.callServer(lServerParams);
    var lObj = {};
  lObj.targetId = "funtra__ConfirmDetails__confirmModal";
  apz.toggleModal(lObj);
  $(".modal-header").hide();
  $("#funtra__ConfirmDetails__confirmModal_content").css("margin-top","100px");
}

apz.funtra.confirmDetails.fnDbCallback = function(params){
    debugger;
    apz.stopLoader();
    if(params.res !=null){
    var lStandingOrderId =  params.res.funtra__PostStandingOrder_Res.postStanding.standingOrder.standingOrderId.split("-")[1];
    $("#funtra__ConfirmDetails__standingOrderId").text(lStandingOrderId);
    }
}
apz.funtra.confirmDetails.fnHome = function(){
    var lObj = {};
  lObj.targetId = "funtra__ConfirmDetails__confirmModal";
  apz.toggleModal(lObj);
     var lLaunchParams = {
        "appId": "custdb",
        "scr": "Dashboard",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj":{
                "customer":apz.csmrbk.landingpage.sCustomerToken,
                "loans":apz.csmrbk.landingpage.sLoanToken,
                "cards":apz.csmrbk.landingpage.sCardToken
            }
        }
    };
    apz.launchApp(lLaunchParams);
}

apz.funtra.confirmDetails.fnAnotherTransfer = function(){
    var lObj = {};
  lObj.targetId = "funtra__ConfirmDetails__confirmModal";
  apz.toggleModal(lObj);
    var lLaunchParams = {
        "scr": "TransferDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj":{
                "customer":apz.csmrbk.landingpage.sCustomerToken,
                "loans":apz.csmrbk.landingpage.sLoanToken,
                "cards":apz.csmrbk.landingpage.sCardToken
            }
        },
        "accounts":""
    };
    apz.launSubScreen(lLaunchParams);
}

apz.funtra.confirmDetails.fnBack = function(){
    debugger;
    var lLaunchParams = {
        "scr": "TransferDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj":{
                "customer":apz.csmrbk.landingpage.sCustomerToken,
                "loans":apz.csmrbk.landingpage.sLoanToken,
                "cards":apz.csmrbk.landingpage.sCardToken
            },
            "custInfo":apz.custdb.dashboard.sCustInfo,
        "transferDetails":apz.data.scrdata.funtra__ConfirmDetails_Res.details
        }
        
    };
    apz.launchSubScreen(lLaunchParams);
}
