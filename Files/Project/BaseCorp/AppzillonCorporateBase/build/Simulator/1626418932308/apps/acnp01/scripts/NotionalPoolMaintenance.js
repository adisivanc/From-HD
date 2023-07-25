apz.acnp01.NotionalPoolMaintenance = {};
apz.acnp01.NotionalPoolMaintenance.sRoleAccounts = {};
apz.acnp01.NotionalPoolMaintenance.sAction = "";
apz.acnp01.NotionalPoolMaintenance.lAccount = "";
apz.app.onLoad_NotionalPoolMaintenance = function(params) {
    debugger;
    apz.acnp01.NotionalPoolMaintenance.sAction = params.action;
    
    
    if (params.action == "MODIFY") {
        apz.acnp01.NotionalPoolMaintenance.sparentAccount = params.PoolData.parentAccount;
        apz.acnp01.NotionalPoolMaintenance.spoolId = params.PoolData.poolId;
        $("#acnp01__NotionalPoolMaintenance__AccountsListRow").removeClass('sno');
        $("#acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__poolId").attr('disabled', true);
        apz.data.scrdata.acnp01__NotionalPoolInsert_Req = {};
        apz.data.scrdata.acnp01__NotionalPoolInsert_Req.tbDbmiCorpNotionalPool = params.PoolData;
        apz.data.loadData("NotionalPoolInsert", 'acnp01');
        //apz.acnp01.NotionalPoolMaintenance.getRoleAccounts();
        
        //apz.acnp01.NotionalPoolMaintenance.selectParentAcc();
        apz.acnp01.NotionalPoolMaintenance.getPoolAccDetails(params);
    } else if (params.action == "ADD") {
        $("#acnp01__NotionalPoolMaintenance__AccountsListRow").addClass('sno');
        apz.data.scrdata.acnp01__NotionalPoolInsert_Req = {};
        apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req = {};
        apz.acnp01.NotionalPoolMaintenance.getRoleAccounts();
    }
};
apz.app.onShown_NotionalPoolMaintenance = function() {
    //apz.acnp01.NotionalPoolMaintenance.selectParentAcc();
    if (apz.acnp01.NotionalPoolMaintenance.sAction == "MODIFY") {
        //apz.acnp01.NotionalPoolMaintenance.selectParentAcc();
    } else {
        apz.setElmValue('acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__corporateId',apz.acnp01.NotionalPooling.sCorporateId);
    }
};
apz.acnp01.NotionalPoolMaintenance.getPoolAccDetails = function(pPoolObj) {
    var lServerParams = {
        "ifaceName": "NotionalPoolAccInsert",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acnp01.NotionalPoolMaintenance.poolAccDetailsCB,
        "callBackObj": "",
    };
    
     var req = {};
    req.action = "Query";
    req.table = "tb_dbmi_corp_notional_pool_acc";
    req.tbDbmiCorpNotionalPoolAcc = {};
    req.tbDbmiCorpNotionalPoolAcc.corporateId = apz.acnp01.NotionalPooling.sCorporateId;
    req.tbDbmiCorpNotionalPoolAcc.poolId = apz.acnp01.NotionalPoolMaintenance.spoolId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acnp01.NotionalPoolMaintenance.poolAccDetailsCB = function(pResp) {
    debugger;
    apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req = {};
    apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc = pResp.res.acnp01__NotionalPoolAccInsert_Res.tbDbmiCorpNotionalPoolAcc;
    
    apz.data.loadData("NotionalPoolAccInsert", 'acnp01');
    apz.acnp01.NotionalPoolMaintenance.getRoleAccounts();
};
apz.acnp01.NotionalPoolMaintenance.getRoleAccounts = function() {
    debugger;
    var req = {
        "accountDetails": {
            "type": "All",
            "corporateId": apz.acnp01.NotionalPooling.sCorporateId,
            "roleId": apz.acnp01.NotionalPooling.sRoleId
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_role_account";
    var lParams = {
        "ifaceName": "GetRoleAccounts",
        "paintResp": "N",
        "appId": "acnp01",
        "buildReq": "N",
        "req": req,
        "callBack": apz.acnp01.NotionalPooling.getRoleAccountsCB,
    };
    apz.server.callServer(lParams);
};
apz.acnp01.NotionalPoolMaintenance.selectParentAcc = function(pObj) {
    debugger;
    var lAccountNo = apz.getElmValue('acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__parentAccount');
    if(lAccountNo != ""){
        $("#acnp01__NotionalPoolMaintenance__sc_row_11").removeClass("sno");
    var lAccountDetails = apz.acnp01.NotionalPoolMaintenance.getAccountDetails(lAccountNo);
    
     var param = {
            "decimalSep": ".",
            "value":  lAccountDetails.availableBalance,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    apz.setElmValue("acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__balance", apz.formatNumber(param));
    var lAccountsArr =  apz.acnp01.NotionalPoolMaintenance.sRoleAccounts;
   var lAccountsArrLength = lAccountsArr.length;
    var lArr = [{
        "val": "",
        "desc": "Please Select",
    }];
    for (var i = 0; i < lAccountsArrLength; i++) {
    if (lAccountsArr[i].accountNo != lAccountNo) {
        var strlen = lAccountsArr[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = lAccountsArr[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        var lfrmacc = {
            "val": lAccountsArr[i].accountNo,
            "desc": result
        };
        lArr.push(lfrmacc);
    }
}
 apz.populateDropdown(document.getElementById("acnp01__NotionalPoolMaintenance__AccountNo"), lArr);
apz.acnp01.NotionalPooling.toAccMob = lArr;
    apz.acnp01.NotionalPoolMaintenance.setBaseCurrency(lAccountNo);
    }
};
apz.acnp01.NotionalPooling.getRoleAccountsCB = function(pResp) {
    debugger;
    apz.acnp01.NotionalPoolMaintenance.sRoleAccounts = pResp.res.acnp01__GetRoleAccounts_Res.tbDbmiCorpRoleAccount;
    var lAccountsArr = pResp.res.acnp01__GetRoleAccounts_Res.tbDbmiCorpRoleAccount;
    var lAccountsArrLength = lAccountsArr.length;
    var lArr = [{
        "val": "",
        "desc": "Please Select",
    }];
    
    
    for (var i = 0; i < lAccountsArrLength; i++) {
        var strlen = lAccountsArr[i].accountNo;
        strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
        var laccNo = lAccountsArr[i].accountNo;
        var result = apz.getMaskedValue(strlen, laccNo);
        var lfrmacc = {
            "val": lAccountsArr[i].accountNo,
            "desc": result
        };
        lArr.push(lfrmacc);
    }
    
    
    // for (var i = 0; i < lAccountsArrLength; i++) {
    //     var lObj = {
    //         "val": lAccountsArr[i].accountNo,
    //         "desc": lAccountsArr[i].accountNo,
    //     };
    //     lArr.push(lObj);
    // }
    apz.populateDropdown(document.getElementById("acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__parentAccount"), lArr);
    apz.populateDropdown(document.getElementById("acnp01__NotionalPoolMaintenance__AccountNo"), lArr);
    apz.data.loadData("NotionalPoolInsert", 'acnp01');
   apz.acnp01.NotionalPooling.toAccMob = lArr;
   
   if(apz.acnp01.NotionalPoolMaintenance.sAction == "MODIFY"){
       apz.setElmValue("acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__parentAccount", apz.acnp01.NotionalPoolMaintenance.sparentAccount)
   }
    
    
};
apz.acnp01.NotionalPoolMaintenance.addAccount = function(pacctno) {
    debugger;
    $("#acnp01__NotionalPoolMaintenance__sc_row_11").removeClass("sno");
    var lAccountNumber = apz.getElmValue('acnp01__NotionalPoolMaintenance__AccountNo');
    if (apz.deviceGroup == "Mobile") {
        lAccountNumber = pacctno;
    }
    if (lAccountNumber != "") {
        if (!apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc) {
            apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc = [];
        }
        var lPoolAccArr = apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc;
        var lPoolAccLength = lPoolAccArr.length;
        var lNewAccount = true;
        for (var i = 0; i < lPoolAccLength; i++) {
            if (lAccountNumber == lPoolAccArr[i].accountNo) {
                lNewAccount = false;
            }
        }
        if (lNewAccount) {
            var lAccObj = {};
            lAccObj.poolId = $("#acnp01__NotionalPoolMaintenance__i__tbDbmiCorpNotionalPool__poolId").val();
            lAccObj.corporateId = apz.acnp01.NotionalPooling.sCorporateId;
            //lAccObj.accountNo = $("#acnp01__NotionalPoolMaintenance__AccountNo").val();
            lAccObj.accountNo = apz.getElmValue('acnp01__NotionalPoolMaintenance__AccountNo');
            if (apz.deviceGroup == "Mobile") {
        lAccObj.accountNo = pacctno;
    }
            var lAccountDetails = apz.acnp01.NotionalPoolMaintenance.getAccountDetails(lAccObj.accountNo);
            lAccObj.amount = lAccountDetails.availableBalance;
            lAccObj.accountType = lAccountDetails.accountType;
            apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc.push(lAccObj);
            apz.data.loadData("NotionalPoolAccInsert", 'acnp01');
            $("#acnp01__NotionalPoolMaintenance__AccountsListRow").removeClass('sno');
            var lAccArr = apz.data.scrdata.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc;
            var lAccArrLength = lAccArr.length;
            debugger;
           // var lTotalAmount = parseInt(apz.getElmValue("acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__balance"));
           var lTotalAmount = apz.acnp01.NotionalPoolMaintenance.unformatNumber(apz.getElmValue("acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__balance"));
            for (var i = 0; i < lAccArrLength; i++) {
                if (lTotalAmount) {
                    lTotalAmount = Number(lTotalAmount) + Number(lAccArr[i].amount);
                } else {
                    lTotalAmount = Number(lAccArr[i].amount);
                }
            };
            
            var param = {
            "decimalSep": ".",
            "value":  lTotalAmount,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
            $("#acnp01__NotionalPoolInsert__i__tbDbmiCorpNotionalPool__balance_txtcnt").text(apz.formatNumber(param));
        } else {
            var msg = {
                "code": 'ACC_ERR'
            };
            apz.dispMsg(msg);
        }
    } else {
        var msg = {
            "code": 'SEL_ACC'
        };
        apz.dispMsg(msg);
    }
};

apz.acnp01.NotionalPoolMaintenance.unformatNumber = function(value) {
    var params = {};
    params.value = value;
    params.decimalSep = apz.decimalSep;
    params.mask = apz.numberMask;
    params.displayAsLiteral = "N";
    debugger;
    params.decimalPoints = apz.getDecimalPoints();
    debugger;
    value = apz.unFormatNumber(params);
    return value;
}
apz.acnp01.NotionalPoolMaintenance.getAccountDetails = function(pAccountNo) {
    debugger;
    var lAccountNo = pAccountNo;
    var lAccountsArr = apz.acnp01.NotionalPoolMaintenance.sRoleAccounts;
    var lAccountsArrLength = lAccountsArr.length;
    for (var i = 0; i < lAccountsArrLength; i++) {
        if (lAccountsArr[i].accountNo == lAccountNo) {
            var lAccountDetails = lAccountsArr[i];
            break;
        }
    }
    return lAccountDetails;
};
apz.acnp01.NotionalPoolMaintenance.setBaseCurrency = function(pAccountNo) {
    debugger;
    var lAccountNo = pAccountNo;
    var lAccountsArr = apz.acnp01.NotionalPoolMaintenance.sRoleAccounts;
    var lAccountsArrLength = lAccountsArr.length;
    for (var i = 0; i < lAccountsArrLength; i++) {
        if (lAccountsArr[i].accountNo == lAccountNo) {
            var lBaseCurrency = lAccountsArr[i].accountCurrency;
            apz.setElmValue('acnp01__NotionalPoolMaintenance__AccountCurrency', lBaseCurrency);
            break;
        }
    }
};
apz.acnp01.NotionalPoolMaintenance.Save = function() {
    debugger;
    var lPoolMaster = apz.data.buildData('NotionalPoolInsert', 'acnp01');
    var lPoolAccs = apz.data.buildData('NotionalPoolAccInsert', 'acnp01');
     var lScreenData = {};
    lScreenData.tbDbmiCorpNotionalPool = lPoolMaster.acnp01__NotionalPoolInsert_Req.tbDbmiCorpNotionalPool;
    lScreenData.tbDbmiCorpNotionalPoolAcc = lPoolAccs.acnp01__NotionalPoolAccInsert_Req.tbDbmiCorpNotionalPoolAcc;
    
    for(var i=0; i<lScreenData.tbDbmiCorpNotionalPoolAcc.length;i++){
        lScreenData.tbDbmiCorpNotionalPoolAcc[i].poolId = lScreenData.tbDbmiCorpNotionalPool.poolId
    }
    
    if (!apz.mockServer) {
    
   
    var taskObj = {};
    taskObj.workflowId = "CNNP";
    taskObj.screenData = JSON.stringify(lScreenData);
    taskObj.referenceId = apz.acnp01.NotionalPooling.sCorporateId + "__" + lScreenData.tbDbmiCorpNotionalPool.poolId;
    var lUserObj = {};
    lUserObj.taskDetails = taskObj;
    lUserObj.callBack = apz.acnp01.NotionalPoolMaintenance.workflowMicroServiceCB;
    lUserObj.operation = "NEWWORKFLOW";
    var lParams = {
        "appId": "acwf01",
        "scr": "WorkFlow",
        "div": "acnp01__NotionalPoolMaintenance__LaunchMicroService",
        "layout": "All",
        "type": "CF",
        "userObj": lUserObj
    };
    apz.launchApp(lParams);
}

else{
    var lObj = {};
            lObj.currentWfDetails = {};
            lObj.scrData = {};
            
            
             lObj.currentTask = "";
            lObj.currentWfDetails.screenData = JSON.stringify(lScreenData);
            var lParams = {
                "appId": "acnp01",
                "scr": "ViewNotionalPool",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
}
};
apz.acnp01.NotionalPoolMaintenance.Cancel = function() {
    $("#acnp01__NotionalPooling__NotionalPoolLauncherRow").addClass('sno');
    $("#acnp01__NotionalPooling__NotionalPoolSummaryRow").removeClass('sno');
    $("#acnp01__NotionalPooling__mainHeader").removeClass('sno');
    $("#acnp01__NotionalPooling__newmainheader").removeClass('sno');
};

apz.acnp01.NotionalPoolMaintenance.workflowMicroServiceCB = function(pRespObj){
    debugger;
    apz.currAppId = "acnp01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "acnp01__NotionalPooling__NotionalPoolLauncher",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                 var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};

apz.acnp01.NotionalPoolMaintenance.fnOpenAcctModal= function(){
    debugger;
    // apz.toggleModal({
    //     "targetId": "acnp01__NotionalPoolMaintenance__acctModal"
    // });
    $("#acnp01__NotionalPoolMaintenance__acctModal").removeClass("sno");
    apz.acnp01.NotionalPoolMaintenance.lAccount = "";
      apz.data.scrdata.acnp01__GetTAacctsMob_Res = {};
      if(apz.acnp01.NotionalPooling.toAccMob[0].val ==""){
           apz.acnp01.NotionalPooling.toAccMob.splice(0,1);
      }
     
      //apz.acnp01.NotionalPooling.toAccMob = apz.acnp01.NotionalPooling.toAccMob.splice(0,1);
         apz.data.scrdata.acnp01__GetTAacctsMob_Res.AccountList = apz.acnp01.NotionalPooling.toAccMob;
          apz.data.loadData("GetTAacctsMob", 'acnp01');
}

apz.acnp01.NotionalPoolMaintenance.fnCheckAccount = function(element){
    debugger;
     var lid = $(element).attr("id");
    var cid = $("#" + lid + " input:checkbox")[0].id;
    var cval = apz.getElmValue(cid);
    //apz.acnp01.NotionalPoolMaintenance.lAccount = apz.getElmValue("taxdet__TaxDetails__el_txt_3");
    var lrowno = $(element).attr("rowno");
    if (cval == "n") {
        apz.setElmValue(cid, "y");
        if (apz.acnp01.NotionalPoolMaintenance.lAccount == "") {
            apz.acnp01.NotionalPoolMaintenance.lAccount = apz.getElmValue("acnp01__GetTAacctsMob__o__AccountList__val_" + lrowno);
        } else {
            if (apz.acnp01.NotionalPoolMaintenance.lAccount.indexOf(apz.getElmValue("acnp01__GetTAacctsMob__o__AccountList__val_" + lrowno)) == -1) {
                apz.acnp01.NotionalPoolMaintenance.lAccount = apz.acnp01.NotionalPoolMaintenance.lAccount + "," + apz.getElmValue("acnp01__GetTAacctsMob__o__AccountList__val_" + lrowno);
            }
        }
    }
    if (cval == "y") {
        apz.setElmValue(cid, "n");
        var items = apz.acnp01.NotionalPoolMaintenance.lAccount.split(",");
        var valueToRemove = apz.getElmValue("acnp01__GetTAacctsMob__o__AccountList__val_" + lrowno);
        apz.acnp01.NotionalPoolMaintenance.lAccount = items.filter(function(item) {
            return item !== valueToRemove
        });
    }
}


apz.acnp01.NotionalPoolMaintenance.fnAddAccountsMobile = function(){
    debugger;
    $("#acnp01__NotionalPoolMaintenance__acctModal").addClass("sno");
    
    if(apz.acnp01.NotionalPoolMaintenance.lAccount !=""){
        var lAccarr = apz.acnp01.NotionalPoolMaintenance.lAccount.split(",");
        for(var i=0;i<lAccarr.length;i++){
            apz.acnp01.NotionalPoolMaintenance.addAccount(lAccarr[i]);
        }
    }
}


apz.acnp01.NotionalPoolMaintenance.fnCloseAccountsMobile = function(){
    debugger;
    $("#acnp01__NotionalPoolMaintenance__acctModal").addClass("sno");
}
