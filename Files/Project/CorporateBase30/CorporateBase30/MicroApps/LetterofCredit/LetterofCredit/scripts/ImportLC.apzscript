apz.lecr01.ImportLC = {};
apz.lecr01.ImportLC.sAction = "";
apz.lecr01.ImportLC.sCorporateId = "000FTAC4321";
apz.lecr01.ImportLC.sWorkflowId = "ILOC";
apz.app.onLoad_ImportLC = function(params) {
    apz.lecr01.ImportLC.sCorporateId = apz.Login.sCorporateId;
    //apz.lecr01.ImportLC.fnFetchCreditDetails();
    apz.hide("lecr01__ImportLC__importLCTableul_ttl");
    var params = {
        "action": "LC Details"
    };
    apz.lecr01.ImportLC.fnRender(params);
};
apz.lecr01.ImportLC.fnRender = function(params) {
    apz.lecr01.ImportLC.fnRenderData(params);
};
apz.lecr01.ImportLC.fnRenderData = function(params) {
    if (params.action == "LC Details") {
        apz.lecr01.ImportLC.sAction = "LC Details";
        var req = {
            "letterSummary": {
                "corporateId": apz.lecr01.ImportLC.sCorporateId,
                "type": "All"
            }
        };
        req.action = "Query";
        req.table = "tb_dbmi_corp_letter_credit";
        var lParams = {
            "ifaceName": "FetchLetterofCreditsService",
            "paintResp": "N",
            "appId": "lecr01",
            "buildReq": "N",
            "lReq": req
        };
        apz.lecr01.ImportLC.fnBeforCallServer(lParams);
    }
};
apz.lecr01.ImportLC.fnBeforCallServer = function(params) {
    debugger;
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.lecr01.ImportLC.fnFetchCreditDetailsCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.lecr01.ImportLC.fnFetchCreditDetailsCB = function(params) {
    debugger;
    if (apz.lecr01.ImportLC.sAction == "LC Details") {
        apz.lecr01.ImportLC.fnImportLCCB(params);
        apz.lecr01.ImportLC.queryTasks();
    } else if (apz.lecr01.ImportLC.sAction == "Search") {
        apz.lecr01.ImportLC.fnImportLCCB(params);
    } else if (apz.lecr01.ImportLC.sAction == "AdvanceSearch") {
        apz.lecr01.ImportLC.fnImportLCCB(params);
    }
};
apz.lecr01.ImportLC.fnImportLCCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.lecr01__FetchLetterofCreditsService_Res.Status) {
            
            var letterSummary = params.res.lecr01__FetchLetterofCreditsService_Res.letterSummary;
            var pendingLC = [];
            var approvedLC = [];
            for(var i=0;i<letterSummary.length;i++){
                if(letterSummary[i].status == "Pending Rework"){
                    pendingLC.push(letterSummary[i]);
                }else{
                    approvedLC.push(letterSummary[i]);
                }
            }
            apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res = {};
            apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterSummary = approvedLC;
            apz.data.scrdata.lecr01__FetchLetterofCreditsServicePending_Res = {};
            apz.data.scrdata.lecr01__FetchLetterofCreditsServicePending_Res.letterSummary = pendingLC;
            apz.data.loadData("FetchLetterofCreditsService","lecr01");
            apz.data.loadData("FetchLetterofCreditsServicePending","lecr01");
            apz.data.scrdata.lecr01__FetchLetterofCreditTemplates_Res = {
                letterSummary: apz.data.scrdata.lecr01__FetchLetterofCreditsService_Res.letterSummary
            }
            apz.data.loadData("FetchLetterofCreditTemplates", "lecr01");
        } else {
            var msg = {};
            msg.message = "No Records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
// apz.lecr01.ImportLC.fnFetchCreditDetails = function(params) {
//     debugger;
//     apz.startLoader();
//     var req = {
//         "letterSummary": {
//             "corporateId": apz.lecr01.ImportLC.sCorporateId,
//              "type":"All"
//         }
//     };
//     req.action = "Query";
//     req.table = "tb_dbmi_corp_letter_credit";
//     var lServerParams = {
//         "ifaceName": "FetchLetterofCreditsService",
//         "buildReq": "N",
//         "appId": "lecr01",
//         "req": req,
//         "paintResp": "Y",
//         "async": "true",
//         "callBack": apz.lecr01.ImportLC.fnFetchCreditDetailsCB,
//         "callBackObj": "",
//     };
//     apz.server.callServer(lServerParams);
// };
apz.lecr01.ImportLC.fnAdd = function() {
    apz.hide("lecr01__LCSummary__lcRow");
    apz.hide("lecr01__LCSummary__tradefinancerow");
    apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    var params = {};
    params.appId = "lecr01";
    params.scr = "AddLC";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    apz.launchSubScreen(params);
};
apz.lecr01.ImportLC.fnLCDetails = function(pthis,pAction) {
    debugger;
    apz.show("lecr01__LCSummary__tradefinancerow");
    apz.show("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__lcRow");
    var lrowno = $(pthis).attr("rowno");
    var lrefno = $("#lecr01__FetchLetterofCreditsService__o__letterSummary__referenceNumber_" + lrowno + "_txtcnt").text();
    //var lrefno = apz.getObjValue(pthis);
    var params = {};
    params.appId = "lecr01";
    params.scr = "ImportLCDetails";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    if(pAction=="CLOSE"){
        params.userObj.close = true;
    }
    
          if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    
    apz.launchSubScreen(params);
};
apz.lecr01.ImportLC.fnPendingLCDetails = function(pthis) {
    debugger;
    apz.show("lecr01__LCSummary__tradefinancerow");
    apz.show("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__lcRow");
    var lrowno = $(pthis).attr("rowno");
    var lrefno = $("#lecr01__FetchLetterofCreditsServicePending__o__letterSummary__referenceNumber_" + lrowno + "_txtcnt").text();
    //var lrefno = apz.getObjValue(pthis);
    var params = {};
    params.appId = "lecr01";
    params.scr = "ImportLCDetails";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    apz.launchSubScreen(params);
};
apz.lecr01.ImportLC.fnLCEditDetails = function(pthis) {
    debugger;
    apz.hide("lecr01__LCSummary__tradefinancerow");
    apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__lcRow");
    var lrow = $(pthis).attr("rowno");
    var lrefno = apz.getElmValue("lecr01__LCDetailsList__i__tbDbmiCorpLetterCredit__referenceNumber_" + lrow);
    var params = {};
    params.appId = "lecr01";
    params.scr = "ModifyLC";
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    params.userObj = {
        "refNo": lrefno
    };
    apz.launchSubScreen(params);
};
apz.lecr01.ImportLC.fnSearch = function(event,LCSearchBy,LCSearch) {
    debugger;
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("lecr01__LCSummary__"+LCSearchBy);
        var lInput = apz.getElmValue("lecr01__LCSummary__"+LCSearch);
        var lSearchType;
        var flag = true;
        if (lType == "Search By") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "Reference Number") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "referenceNumber";
            }
        } else if (lType == "Beneficiary") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "beneficaryCompanyName";
            }
        } else if (lType == "Currency") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "currency";
            }
        }
        if (flag) {
            apz.lecr01.ImportLC.sAction = "Search";
            var req = {
                "letterSummary": {
                    "type": lSearchType,
                    "corporateId": apz.lecr01.ImportLC.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_corp_letter_credit";
            var lParams = {
                "ifaceName": "FetchLetterofCreditsService",
                "paintResp": "Y",
                "appId": "lecr01",
                "buildReq": "N",
                "lReq": req
            };
            apz.lecr01.ImportLC.fnBeforCallServer(lParams);
        }
    }
};
apz.lecr01.ImportLC.fnEditLC = function(pObj) {
    debugger;
    apz.hide("lecr01__LCSummary__tradefinancerow");
     apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    apz.hide("lecr01__LCSummary__lcRow");
    var lrow = $(pObj).attr("rowno");
    var lrefno = $("#lecr01__FetchLetterofCreditsService__o__letterSummary__referenceNumber_" + lrow + "_txtcnt").text();
    var req = {
        "letterDetails": {
            "referenceNumber": lrefno
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_letter_credit";
    var lServerParams = {
        "ifaceName": "FetchLetterofCreditsService",
        "buildReq": "N",
        "appId": "lecr01",
        "req": req,
        "paintResp": "N",
        "async": "true",
        "callBack": apz.lecr01.ImportLC.queryLCEditCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}
apz.lecr01.ImportLC.queryLCEditCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var result = pResp.res;
        result.sAction = "edit";
        var lParams = {
            "appId": "lecr01",
            "scr": "modifyImportLC",
            "div": "lecr01__LCSummary__subScreenLauncher",
            "layout": "All",
            "type": "CF",
            "userObj": result
        };
        apz.launchSubScreen(lParams);
    }
}
apz.lecr01.ImportLC.fnAdvSearch = function(event) {
    $("#lecr01__ImportLC__lcsearchrow").removeClass("sno");
    $("#lecr01__ImportLC__lcrow").addClass("sno");
}
apz.lecr01.ImportLC.fnSearchAdvance = function(event) {
    debugger;
    $("#lecr01__ImportLC__lcsearchrow").addClass("sno");
    $("#lecr01__ImportLC__lcrow").removeClass("sno");
    var lscreendata = apz.data.buildData("GetAdvanceSearchDetails", "lecr01");
    apz.lecr01.ImportLC.sAction = "AdvanceSearch";
    var req = {
        "letterSummary": {
            "type": "advancesearch",
            "corporateId": apz.lecr01.ImportLC.sCorporateId,
            "advsearchdata": lscreendata.lecr01__GetAdvanceSearchDetails_Req.advancSearchDetail
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_letter_credit";
    var lParams = {
        "ifaceName": "FetchLetterofCreditsService",
        "paintResp": "Y",
        "appId": "lecr01",
        "buildReq": "N",
        "lReq": req
    };
    apz.lecr01.ImportLC.fnBeforCallServer(lParams);
    //           var lParams = {
    //             "ifaceName": "Advancesearchdummy_Query",
    //             "paintResp": "Y",
    //             "appId": "lecr01",
    //             "buildReq": "N",
    //             "lReq": "",
    //             "callBack": apz.lecr01.ImportLC.fnSearchAdvanceCB,
    //         };
    //         var req = {};
    // req.tbDbmiCorpLetterCredit = {};
    // req.tbDbmiCorpLetterCredit.corporateId = apz.lecr01.ImportLC.sCorporateId;
    // req.tbDbmiCorpLetterCredit.applicantName = "testapplicant";
    //  lParams.req = req;
    //  apz.server.callServer(lParams);
}
apz.lecr01.ImportLC.fnSearchAdvanceCB = function(presp) {}
apz.lecr01.ImportLC.showTemplateModal = function() {
    apz.toggleModal({
        "targetId": "lecr01__ImportLC__lc_template"
    });
    apz.data.loadData("FetchLetterofCreditTemplates", "lecr01");
};
apz.lecr01.ImportLC.createLCFromTemplate = function(pObj) {
    var refNo = $(pObj).text();
    var req = {
        "letterDetails": {
            "referenceNumber": refNo
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_corp_letter_credit";
    var lServerParams = {
        "ifaceName": "FetchLetterofCreditsService",
        "buildReq": "N",
        "appId": "lecr01",
        "req": req,
        "paintResp": "N",
        "async": "true",
        "callBack": apz.lecr01.ImportLC.queryLCCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.lecr01.ImportLC.queryLCCB = function(params) {
    debugger;
    apz.hide("lecr01__LCSummary__lcRow");
    apz.hide("lecr01__LCSummary__tradefinancerow");
    apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    apz.lecr01.ImportLC.showTemplateModal();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.lecr01__FetchLetterofCreditsService_Res.Status) {
            params.res.lecr01__FetchLetterofCreditsService_Res.letterDetails.referenceNumber = $.now();
            var lLCDetailsObj = params.res;
            var params = {};
            params.appId = "lecr01";
            params.scr = "AddLC";
            params.layout = "All";
            params.div = "lecr01__LCSummary__subScreenLauncher";
            params.userObj = lLCDetailsObj;
            apz.launchSubScreen(params);
        }
    }
};
apz.lecr01.ImportLC.queryTasks = function() {
    apz.startLoader();
    var lServerParams = {
        "ifaceName": "FetchTaskFlowDetails",
        "appId": "lecr01",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "false",
        "callBack": apz.lecr01.ImportLC.taskFlowQueryCB,
        "callBackObj": "",
    };
    var req = {
        "TaskSummary": {
            "corporateId": apz.lecr01.ImportLC.sCorporateId
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_workflow_master";
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.lecr01.ImportLC.taskFlowQueryCB = function(pResp) {
    debugger;
    apz.stopLoader();
    if (pResp.status) {
        if (pResp.res.lecr01__FetchTaskFlowDetails_Res) {
            if (pResp.res.lecr01__FetchTaskFlowDetails_Res.TaskSummary) {
                apz.data.scrdata.lecr01__FetchTaskFlowDetails_Res = {};
                apz.data.scrdata.lecr01__FetchTaskFlowDetails_Res.TaskSummary = [];
                var taskSummary = pResp.res.lecr01__FetchTaskFlowDetails_Res.TaskSummary;
                for (var i = 0; i < taskSummary.length; i++) {
                    if (taskSummary[i].workflowId == "ILOC" && taskSummary[i].status != "COMPLETED" && taskSummary[i].stageId == "DETAILS") {
                        apz.data.scrdata.lecr01__FetchTaskFlowDetails_Res.TaskSummary.push(taskSummary[i]);
                    }
                }
                apz.data.loadData("FetchTaskFlowDetails", "lecr01");
            }
        }
    }
};
apz.lecr01.ImportLC.launchLCModifyScreen = function(pObj) {
    debugger;
    apz.hide("lecr01__LCSummary__lcRow");
    apz.hide("lecr01__LCSummary__tradefinancerow");
    apz.hide("lecr01__LCSummary__Mobtradefinancerow");
    var lRow = $(pObj).attr("rowno");
    var lRowObj = apz.data.scrdata.lecr01__FetchTaskFlowDetails_Res.TaskSummary[lRow];
    apz.lecr01.ImportLC.sCurrentTask = lRowObj;
    var lServerParams = {
        "ifaceName": "FetchWorkFlowDet_Query",
        "appId": "lecr01",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.lecr01.ImportLC.fetchDetailsQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiWorkflowDetail = {};
    req.tbDbmiWorkflowDetail.instanceId = lRowObj.instanceId;
    req.tbDbmiWorkflowDetail.stageSeqNo = lRowObj.stageSeqNo;
    req.tbDbmiWorkflowDetail.versionNo = lRowObj.versionNo;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.lecr01.ImportLC.fetchDetailsQueryCB = function(pResp) {
    debugger;
    var lUserObj = {};
    var lCurrentWfDetails = pResp.res.lecr01__FetchWorkFlowDet_Res.tbDbmiWorkflowDetail;
    var ltbAstpWorkflowDet = pResp.res.lecr01__FetchWorkFlowDet_Res.tbDbmiWorkflowDetail;
    
     lUserObj.scrData = JSON.parse(ltbAstpWorkflowDet.screenData);
    
    //lUserObj.scrData = ltbAstpWorkflowDet.screenData;
    lUserObj.callBack = apz.lecr01.ImportLC.microAppCB;
    lUserObj.currentTask = apz.lecr01.ImportLC.sCurrentTask;
    lUserObj.currentWfDetails = lCurrentWfDetails;
    lUserObj.div = "actf01__TaskFlow__LaunchMicroApp";
    var params = {};
    params.appId = "lecr01";
    params.scr = ltbAstpWorkflowDet.screenId;
    params.layout = "All";
    params.div = "lecr01__LCSummary__subScreenLauncher";
    params.userObj = lUserObj;
    apz.launchSubScreen(params);
};
apz.lecr01.ImportLC.microAppCB = function(params) {
    debugger;
    apz.launchApp({
        appId: "actf01",
        screenId: "TaskFlow",
        div: "ACNR01__Navigator__launchPad",
        layout: "All"
    });
};
