apz.ficl01.CollateralList = {};
apz.app.onLoad_CollateralList = function(params) {
    apz.ficl01.CollateralList.fetchCollateralsList();
    $("#ficl01__CollateralList__colListRow").css({"paddingTop":"15px","paddingLeft":"15px","paddingRight":"10px"});
};
apz.ficl01.CollateralList.fetchCollateralsList = function() {
    var req = {
        "CollateralsList": {
            "corporateId": apz.Login.sCorporateId,
            "type": "All"
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
        "callBack": apz.ficl01.CollateralList.fetchCollateralsListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.ficl01.CollateralList.fetchCollateralsListCB = function(pResp) {
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
apz.ficl01.CollateralList.getDetails = function(pthis) {
    debugger;
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    //   apz.hide("ficl01__FCSummary__colHeader");
      
      apz.hide("ficl01__CollateralList__colHeader");
      apz.hide("ficl01__CollateralList__MobcolHeader");
     apz.show("ficl01__CollateralList__subScreenLauncher");
     apz.hide("ficl01__CollateralList__colListRow");
    //var lrefno = apz.getObjValue(pthis);
    var test = pthis.id.split("_")
      var lRow = parseInt(pthis.id.split("_")[7]);
    var lrefno = $("#ficl01__FetchCollateralsService__o__CollateralsList__collateralCode_"+ lRow).text();
    var params = {};
    params.appId = "ficl01";
    params.scr = "CollateralDetails";
    //params.layout = "All";
    params.div = "ficl01__CollateralList__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    apz.launchSubScreen(params);
};
apz.ficl01.CollateralList.addCollaterals = function() {
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.hide("ficl01__FCSummary__limitsHeaderRow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    // apz.hide("ficl01__FCSummary__colHeader");
    
     apz.hide("ficl01__CollateralList__colHeader");
     apz.hide("ficl01__CollateralList__MobcolHeader");
     apz.show("ficl01__CollateralList__subScreenLauncher");
     apz.hide("ficl01__CollateralList__colListRow");
    var params = {};
    params.appId = "ficl01";
    params.scr = "AddCollateral";
    //params.layout = "All";
    params.div = "ficl01__CollateralList__subScreenLauncher";
    apz.launchSubScreen(params);
};

apz.ficl01.CollateralList.fnSearch = function(event,SearchBy,SearchValue) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("ficl01__CollateralList__"+SearchBy);
        var lInput = apz.getElmValue("ficl01__CollateralList__"+SearchValue);
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "CollateralCode") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "CollateralCode";
            }
        } else if (lType == "All") {
            lSearchType = "All";
        }
        
        if (flag) {
      
     var req = {
        "CollateralsList": {
            "corporateId": apz.Login.sCorporateId,
            "type": lSearchType,
            "value": lInput
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
        "callBack": apz.ficl01.CollateralList.fetchCollateralsListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
        }
    }
}
