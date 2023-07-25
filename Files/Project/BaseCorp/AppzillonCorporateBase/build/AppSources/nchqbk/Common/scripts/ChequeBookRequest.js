apz.nchqbk.chequebookrequest = {};
apz.nchqbk.chequebookrequest.sParams = {};
apz.nchqbk.chequebookrequest.sChqLeaf = "";
apz.app.onLoad_ChequeBookRequest = function() {
    debugger;
    var pParams = {};
    apz.nchqbk.chequebookrequest.sParams = pParams;
    apz.nchqbk.chequebookrequest.fnInitialise(pParams);
};
apz.nchqbk.chequebookrequest.fnInitialise = function(pParams) {
    debugger;
    apz.data.loadJsonData("ChequeAccountDetails","nchqbk")
    var lAccounts = apz.data.scrdata.nchqbk__ChequeAccountDetails_Res.accounts
    var lOptions = [];
    var lObj = {
        "val": '',
        "desc": "Please Select"
    };
    lOptions.push(lObj);
    for (i = 1; i <lAccounts.length; i++) {
        
        var strlen = lAccounts[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = lAccounts[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        
        lObj = {
            "val": lAccounts[i].accountNo,
            "desc": lAccounts[i].accountType + " - " + result
        }
        lOptions.push(lObj);
    }
    apz.populateDropdown(document.getElementById('nchqbk__ChequeBookRequest__fromAcc'),lOptions);
    if (pParams.Navigation) {
        apz.nchqbk.chequebookrequest.fnSetNavigation(pParams);
    }
    apz.nchqbk.chequebookrequest.fnGoToStage1();
};
apz.nchqbk.chequebookrequest.fnSetNavigation = function(params) {
    debugger;
    apz.nchqbk.chequebookrequest.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    if (!apz.isNull(params.headerText)) {
        lParams.headerText = params.headerText;
    } else {
        lParams.headerText = "CHEQUE BOOK REQUEST";
    }
    lParams.backPressed = apz.nchqbk.chequebookrequest.fnBack;
    apz.nchqbk.chequebookrequest.Navigation(lParams);
};
apz.nchqbk.chequebookrequest.fnGoToStage1 = function() {
    apz.nchqbk.chequebookrequest.fnRenderStage1();
};
apz.nchqbk.chequebookrequest.fnRenderStage1 = function() {
    apz.hide("nchqbk__ChequeBookRequest__remarksRow");
    apz.hide("nchqbk__ChequeBookRequest__buttonRow");
    apz.hide("nchqbk__ChequeBookRequest__changereqrow");
};
apz.nchqbk.chequebookrequest.fnRadioCheque = function() {
    debugger;
    var lChequeNo = apz.getElmValue("nchqbk__ChequeBookRequest__ChequeBookNo");
    if (lChequeNo == "1") {
        apz.nchqbk.chequebookrequest.sChqLeaf = "10";
    } else if (lChequeNo == "2") {
        apz.nchqbk.chequebookrequest.sChqLeaf = "25";
    } else if (lChequeNo == "3") {
        apz.nchqbk.chequebookrequest.sChqLeaf = "50";
    }
    apz.nchqbk.chequebookrequest.fnShowDetails();
}
apz.nchqbk.chequebookrequest.fnChoosigTenChqLvs = function() {
    $('#nchqbk__ChequeBookRequest__twentyfiveLeaves').attr('disabled', 'disabled');
    $('#nchqbk__ChequeBookRequest__fiftyLeaves').attr('disabled', 'disabled');
    apz.nchqbk.chequebookrequest.sChqLeaf = "10";
    apz.nchqbk.chequebookrequest.fnShowDetails();
};
apz.nchqbk.chequebookrequest.fnChoosigTwentyFiveChqLvs = function() {
    $('#nchqbk__ChequeBookRequest__tenLeaves').attr('disabled', 'disabled');
    $('#nchqbk__ChequeBookRequest__fiftyLeaves').attr('disabled', 'disabled');
    apz.nchqbk.chequebookrequest.sChqLeaf = "25";
    apz.nchqbk.chequebookrequest.fnShowDetails();
};
apz.nchqbk.chequebookrequest.fnChoosigFiftyChqLvs = function() {
    $('#nchqbk__ChequeBookRequest__tenLeaves').attr('disabled', 'disabled');
    $('#nchqbk__ChequeBookRequest__twentyfiveLeaves').attr('disabled', 'disabled');
    apz.nchqbk.chequebookrequest.sChqLeaf = "50";
    apz.nchqbk.chequebookrequest.fnShowDetails();
};
apz.nchqbk.chequebookrequest.fnShowDetails = function() {
    $("#nchqbk__ChequeBookRequest__checkHeading").text("New Check Book (Leaves)");
    apz.show("nchqbk__ChequeBookRequest__remarksRow");
    apz.show("nchqbk__ChequeBookRequest__buttonRow");
     apz.show("nchqbk__ChequeBookRequest__changereqrow");
};
apz.nchqbk.chequebookrequest.fnConfirm = function() {
    debugger;
    /* apz.hide("nchqbk__ChequeBookRequest__chequeBookRequest");
    apz.setElmValue("nchqbk__ChequeBookRequest__accNo", apz.getElmValue("nchqbk__ChequeBookRequest__fromAcc"));
    apz.setElmValue("nchqbk__ChequeBookRequest__chqLeaf", apz.nchqbk.chequebookrequest.sChqLeaf);
    apz.setElmValue("nchqbk__ChequeBookRequest__succRemarks", apz.getElmValue("nchqbk__ChequeBookRequest__remarks"));
    var lParam = {};
    lParam.appId = "authnv";
    lParam.scr = "TransactionAuthorize";
    lParam.div = "nchqbk__ChequeBookRequest__authenticationPage";
    lParam.userObj = {
        "lauthMethod": "BIOD",
        "aadhaar": "",
        "control": {
            "destroyDiv": "nchqbk__ChequeBookRequest__authenticationPage",
            "callBack": apz.nchqbk.chequebookrequest.fnChqBkReqEnCallBack
        }
    };
    apz.launchApp(lParam);
};
apz.nchqbk.chequebookrequest.fnChqBkReqEnCallBack = function(pResp) {*/
    debugger;
    //apz.hide("nchqbk__ChequeBookRequest__chequeBookRequest");
    apz.setElmValue("nchqbk__ChequeBookRequest__accNo", apz.getElmValue("nchqbk__ChequeBookRequest__fromAcc"));
    apz.setElmValue("nchqbk__ChequeBookRequest__chqLeaf", apz.nchqbk.chequebookrequest.sChqLeaf);
    apz.setElmValue("nchqbk__ChequeBookRequest__succRemarks", apz.getElmValue("nchqbk__ChequeBookRequest__remarks"));
    
    var lPar = {
        "ifaceName": "ChequeBookRequest",

    };
    apz.nchqbk.chequebookrequest.fnBeforeCallServer(lPar);
};
apz.nchqbk.chequebookrequest.fnBeforeCallServer = function(pParams) {
    // var lServerParams = {
    //     "ifaceName": pParams.ifaceName,
    //     "req": pParams.req,
    //     "paintResp": "N",
    //     "appId": "nchqbk",
    //     "callBack": apz.nchqbk.chequebookrequest.fnCallServerCallBack
    // };
    // apz.server.callServer(lServerParams);
    apz.data.loadJsonData(pParams.ifaceName,"nchqbk");
    apz.nchqbk.chequebookrequest.fnCallServerCallBack()
    
};
apz.nchqbk.chequebookrequest.fnCallServerCallBack = function() {
    debugger;

    apz.dispMsg({
        message:"The check book request has been placed successfully.",
        "type":"S",
        callBack : apz.nchqbk.chequebookrequest.fngoBack
    })
};

apz.nchqbk.chequebookrequest.fngoBack = function()
{
    debugger;
   
    apz.ACNR01.Navigator.launchApp("nchqbk", "ChequeBookRequest", "All", "ChequeBookRequest");

    
}

apz.nchqbk.chequebookrequest.fnOtpProcessCallBack = function(params) {
    debugger;
    if (params.chequeBookReq) {
        apz.show("nchqbk__ChequeBookRequest__statusRow");
        var lRefNo = "Your Reference no is " + params.chequeBookReq.txnRefNo;
        apz.setElmValue("nchqbk__ChequeBookRequest__finalRefNo", lRefNo);
    } else {
        apz.show("nchqbk__ChequeBookRequest__trancFailRow");
    }
};

apz.nchqbk.chequebookrequest.fnStatementRequest = function(){
    debugger;
      var params = {};
    params.appId = "smtreq";
    params.scr = "statementrequest";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
     params.userObj = {
            "from": "chequebookrequest"
        
        }
    //apz.launchSubScreen(params);
    apz.launchApp(params);
}
