apz.fthist.ScheduledPayments = {};
apz.fthist.ScheduledPayments.workflowdata = [];
apz.app.onLoad_ScheduledPayments = function() {
    debugger;
    apz.fthist.ScheduledPayments.fnGetScheduledPayments();
};
apz.fthist.ScheduledPayments.fnGetScheduledPayments = function() {
    debugger;
    
    apz.startLoader();
    // var lServerParams = {
    //     "ifaceName": "GetScheduledPayments_Query",
    //     "buildReq": "N",
    //     "req": "",
    //     "paintResp": "N",
    //     "async": "true",
    //     "callBack": apz.fthist.ScheduledPayments.fnGetScheduledPaymentsCB,
    // };
    
     var lServerParams = {
        "ifaceName": "GetTransferHistory_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.fthist.ScheduledPayments.fnGetTransferHistoryCB,
    };
    apz.server.callServer(lServerParams);
}

apz.fthist.ScheduledPayments.fnGetTransferHistoryCB = function(params){
    debugger;
    apz.fthist.ScheduledPayments.workflowdata=[];
    var ldata = params.res.fthist__GetTransferHistory_Res.tbDbtpFundsTransfer;
    
      for (var i = 0; i < ldata.length; i++) {
          if (ldata[i].isScheduled == "Schedule Payment"  && new Date(ldata[i].scheduledDate) >= new Date()) {
          
        var lobj = {};
        lobj.refNo = ldata[i].txnId;
        lobj.actorId = ldata[i].initiatedBy;
        lobj.scheduledDate = ldata[i].scheduledDate;
        if (ldata[i].transferType == "FTOA") {
            lobj.workflowId = "Own Account Transfer";
        } else if (ldata[i].transferType == "FTDOM" || ldata[i].transferType == "FTDM") {
            lobj.workflowId = "Domestic Transfer";
        } else if (ldata[i].transferType == "FTWB") {
            lobj.workflowId = "Within Bank Transfer";
        } else if (ldata[i].transferType == "FTINT") {
            lobj.workflowId = "International Transfer";
        }
        
        lobj.fromAcct = apz.fthist.ScheduledPayments.fnGetMaskedAcct(ldata[i].fromAccount);
        //lobj.fromAcct = ldata[i].fromAccount;
        if (ldata[i].beneficaryName != undefined) {
            lobj.toAcct = ldata[i].beneficaryName + "-" + apz.fthist.ScheduledPayments.fnGetMaskedAcct(ldata[i].toAccount);
        } else {
            lobj.toAcct = apz.fthist.ScheduledPayments.fnGetMaskedAcct(ldata[i].toAccount);
        }
        
        lobj.amount = ldata[i].amount;
        lobj.drcr = "Dr";
        apz.fthist.ScheduledPayments.workflowdata.push(lobj);
          }
        
    }
    apz.data.scrdata.fthist__ScheduledpaymentsDummy_Res = {};
    apz.data.scrdata.fthist__ScheduledpaymentsDummy_Res.Details = apz.fthist.ScheduledPayments.workflowdata;
    apz.data.loadData("ScheduledpaymentsDummy", "fthist");
    apz.stopLoader();
    
}


apz.fthist.ScheduledPayments.fnGetMaskedAcct = function(Account) {
    var strlen = Account;
    strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(/[0-9]/g, '9');
    var laccNo = Account;
    return apz.getMaskedValue(strlen, laccNo);
}

apz.fthist.ScheduledPayments.fnGetScheduledPaymentsCB = function(params) {
    debugger;
    var ldata = params.res.fthist__GetScheduledPayments_Res.tbDbmiWorkflowDetail;
    var ldata1 = apz.fthist.ScheduledPayments.removeDuplicateRecords(ldata, 'instanceId');
    for (var i = 0; i < ldata1.length; i++) {
        var scrdata = JSON.parse(ldata1[i].screenData);
        for (var j in scrdata) {
            var nodedata = scrdata[j];
            for (var k in nodedata) {
                var objdata = nodedata[k];
                if (objdata.type == "Schedule Payment"  && new Date(objdata.transactionDate) >= new Date()) {
                    var lobj = {};
                    lobj.refNo = ldata1[i].instanceId;
                    lobj.actorId = ldata1[i].actorId;
                    lobj.scheduledDate = objdata.transactionDate;
                    if (ldata1[i].workflowId == "FTOA") {
                        lobj.workflowId = "Own Account Transfer";
                    } else if (ldata1[i].workflowId == "FTDOM") {
                        lobj.workflowId = "Domestic Transfer";
                    } else if (ldata1[i].workflowId == "FTWB") {
                        lobj.workflowId = "Within Bank Transfer";
                    } else if (ldata1[i].workflowId == "FTINT") {
                        lobj.workflowId = "International Transfer";
                    }
                    if (objdata.fromaccount) {
                        lobj.fromAcct = objdata.fromaccount;
                    } else {
                        lobj.fromAcct = objdata.fromAccount;
                    }
                    if (objdata.toaccount) {
                        if (objdata.beneficiaryName != undefined) {
                            lobj.toAcct = objdata.beneficiaryName + "-" + objdata.toaccount;
                        } else {
                            lobj.toAcct = objdata.toaccount;
                        }
                    } else {
                        if (objdata.beneficiaryName != undefined) {
                            lobj.toAcct = objdata.beneficiaryName + "-" + objdata.toAccount;
                        } else {
                            lobj.toAcct = objdata.toAccount;
                        }
                    }
                    lobj.amount = objdata.amount;
                    apz.fthist.ScheduledPayments.workflowdata.push(lobj);
                }
            }
        }
    }
    apz.data.scrdata.fthist__ScheduledpaymentsDummy_Res = {};
    apz.data.scrdata.fthist__ScheduledpaymentsDummy_Res.Details = apz.fthist.ScheduledPayments.workflowdata;
    apz.data.loadData("ScheduledpaymentsDummy", "fthist");
    apz.stopLoader();
}
apz.fthist.ScheduledPayments.removeDuplicateRecords = function(arr, comp) {
    debugger;
    // store the comparison  values in array
    const unique = arr.map(e => e[comp])
    // store the indexes of the unique objects
    .map((e, i, final) => final.indexOf(e) === i && i)
    // eliminate the false indexes & return unique objects
    .filter((e) => arr[e]).map(e => arr[e]);
    return unique;
}
