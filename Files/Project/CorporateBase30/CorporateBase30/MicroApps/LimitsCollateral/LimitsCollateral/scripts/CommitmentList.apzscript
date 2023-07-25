apz.ficl01.CommitmentList = {};
apz.app.onLoad_CommitmentList = function(params){
    apz.ficl01.CommitmentList.getCommitmentList();
    $("#ficl01__CommitmentList__commListRow").css({"paddingTop":"15px","paddingLeft":"15px","paddingRight":"10px"});
};
apz.ficl01.CommitmentList.getCommitmentList = function(){
     var req = {
        "CommitmentList": {
            "corporateId": apz.Login.sCorporateId,
            "type":"All"
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_commitment";
    var lServerParams = {
        "ifaceName": "FetchCommitment",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.CommitmentList.getCommitmentListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.ficl01.CommitmentList.getCommitmentListCB = function(pResp){
    debugger;
    if (pResp.status === true && pResp.resFull.appzillonHeader.status === true) {
        if (pResp.res.ficl01__FetchCommitment_Res.Status) {} else {
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

apz.ficl01.CommitmentList.getDetails = function(pthis) {
    debugger;
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    // apz.hide("ficl01__FCSummary__commHeader");
    
    apz.hide("ficl01__CommitmentList__commListRow");
    apz.show("ficl01__CommitmentList__subScreenLauncher");
    apz.hide("ficl01__CommitmentList__commHeader");
    apz.hide("ficl01__CommitmentList__MobcommHeader");
    
    var lRow = parseInt(pthis.id.split("_")[7]);
   
    var lrefno = $("#ficl01__FetchCommitment__o__CommitmentList__commitmentId_"+ lRow).text();
    //var lrefno = apz.getObjValue(pthis);
    var params = {};
    params.appId = "ficl01";
    params.scr = "CommitmentDetail";
    params.layout = "All";
    params.div = "ficl01__CommitmentList__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    apz.launchSubScreen(params);
};

apz.ficl01.CommitmentList.addCommitment = function() {
    debugger;
    // apz.hide("ficl01__FCSummary__liclrow");
    // apz.hide("ficl01__FCSummary__limitsHeaderRow");
    // apz.show("ficl01__FCSummary__subScreenLauncher");
    // apz.hide("ficl01__FCSummary__commHeader");
    
    apz.hide("ficl01__CommitmentList__commListRow");
    apz.show("ficl01__CommitmentList__subScreenLauncher");
    apz.hide("ficl01__CommitmentList__commHeader");
    apz.hide("ficl01__CommitmentList__MobcommHeader");
    
    var params = {};
    params.appId = "ficl01";
    params.scr = "AddCommitment";
    params.layout = "All";
    params.div = "ficl01__CommitmentList__subScreenLauncher";
    apz.launchSubScreen(params);
};

apz.ficl01.CommitmentList.fnSearch = function(event,SearchBy,SearchValue) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("ficl01__CommitmentList__"+SearchBy);
        var lInput = apz.getElmValue("ficl01__CommitmentList__"+SearchValue);
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
        } else if (lType == "CommitmentId") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "CommitmentId";
            }
        } else if (lType == "All") {
            lSearchType = "All";
        }
        
        if (flag) {
     
     var req = {
        "CommitmentList": {
            "corporateId": apz.Login.sCorporateId,
             "type": lSearchType,
            "value": lInput
        }
    };
   req.action = "Query";
    req.table = "tb_dbmi_corp_commitment";
    var lServerParams = {
        "ifaceName": "FetchCommitment",
        "buildReq": "N",
        "appId": "ficl01",
        "req": req,
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ficl01.CommitmentList.getCommitmentListCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
        }
    }
}
