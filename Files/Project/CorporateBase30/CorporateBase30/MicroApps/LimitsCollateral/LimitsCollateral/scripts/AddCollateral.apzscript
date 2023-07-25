apz.ficl01.AddCollateral = {};
apz.app.onLoad_AddCollateral = function(params) {
    $("#ficl01__AddCollateral__documents_ul a:last").addClass("sno");
    apz.ficl01.AddCollateral.sCorporateId = apz.Login.sCorporateId;
    apz.ficl01.AddCollateral.sUserId = apz.Login.sUserId;
    apz.ficl01.AddCollateral.sFrom = params.from;
    apz.setElmValue("ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__corporateId", apz.ficl01.AddCollateral.sCorporateId);
    apz.setElmValue("ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__userId", apz.ficl01.AddCollateral.sUserId);
};
apz.ficl01.AddCollateral.saveDetails = function() {
    debugger;
    if (apz.val.validateContainer('ficl01__AddCollateral__colAddform') == false) {
        apz.dispMsg({
            "message": "Please provide value for mandatory field(s)",
            "type": "E"
        });
    } else {
        var lscreenData = apz.data.buildData("AddCollaterals", "ficl01");
        if (!apz.mockServer) {
            var taskObj = {};
            taskObj.workflowId = "LCNC";
            //taskObj.stageId = "INPUT";
            taskObj.status = "U";
            //taskObj.userId = "USER001";
            taskObj.taskType = "NEW_COLLATERAL_REQUEST";
            taskObj.versionNo = "1";
            //taskObj.appId = "ficl01";
            //taskObj.screenId = "AddCollateral";
            taskObj.screenData = JSON.stringify(lscreenData);
            //taskObj.stageSeqNo = 1;
            taskObj.action = "";
            taskObj.referenceId = lscreenData.ficl01__AddCollaterals_Req.tbDbmiCorpCollaterals.corporateId + "__" + lscreenData.ficl01__AddCollaterals_Req
                .tbDbmiCorpCollaterals.collateralCode;
            taskObj.taskDesc = "New collateral request has been added with referenceId" + taskObj.referenceId;
            //taskObj.createUserId = apz.Login.sUserId;
            var lUserObj = {};
            lUserObj.taskDetails = taskObj;
            lUserObj.callBack = apz.ficl01.AddCollateral.workflowMicroServiceCB;
            lUserObj.operation = "NEWWORKFLOW";
            var lParams = {
                "appId": "acwf01",
                "scr": "WorkFlow",
                "div": "ficl01__AddCollateral__LaunchMicroService",
                "layout": "All",
                "type": "CF",
                "userObj": lUserObj
            };
            apz.launchApp(lParams);
        } else {
            var lObj = {};
            //lObj.scrData = {};
            lObj.currentWfDetails ={};
            // lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
            // lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
            // lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
           
            lObj.currentTask = "";
            lObj.currentWfDetails.screenData = JSON.stringify(lscreenData);
            var lParams = {
                "appId": "ficl01",
                "scr": "VerifyCollateral",
                "userObj": lObj,
                "div": "ACNR01__Navigator__launchPad",
                "layout": "All"
            };
            apz.launchSubScreen(lParams);
        }
    }
};
apz.ficl01.AddCollateral.workflowMicroServiceCB = function(pRespObj) {
    debugger;
    apz.currAppId = "ficl01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.scrData = {};
                lObj.scrData = JSON.parse(pRespObj.tbDbmiWorkflowDetail.screenData);
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                // var msg = {
                //     "code": 'benfo1_approve',
                //     //"callBack": apz.ficl01.AddCollateral.Confirmation
                // };
                // apz.dispMsg(msg);
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
apz.ficl01.AddCollateral.fnCancel = function() {
    // apz.show("ficl01__FCSummary__liclrow");
    // apz.show("ficl01__FCSummary__limitsHeaderRow");
    // apz.hide("ficl01__FCSummary__subScreenLauncher");
    // apz.ficl01.FCSummary.showCollaterals();
    if(apz.ficl01.AddCollateral.sFrom == "taskflow"){
      apz.ACNR01.Navigator.launchApp("actf01", "TaskFlow", "All", "");
    }else{
    apz.show("ficl01__CollateralList__colHeader");
     apz.show("ficl01__CollateralList__MobcolHeader");
    apz.hide("ficl01__CollateralList__subScreenLauncher");
    apz.show("ficl01__CollateralList__colListRow");
    }
};
apz.ficl01.AddCollateral.collateralStDateChange = function(obj, event) {
    var selectedDate = apz.getObjValue(obj);
    for (var date of apz.scrMetaData.uiInits.date) {
        if (date[0] == "ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__endDate") {
            var params = {};
            params.id = date[0];
            params.dataType = date[1];
            params.lookAndFeel = date[2];
            params.parentDisplay = date[3];
            params.style = date[4];
            params.parentPreset = date[5];
            params.parentMinDate = selectedDate;
            params.parentMaxDate = date[7];
            params.closeOnSel = date[8];
            params.multiSel = date[9];
            params.parentStartYear = date[10];
            params.parentEndYear = date[11];
            params.parentRangePick = date[12];
            apz.initDates(params);
        }
    }
};
apz.ficl01.AddCollateral.collateralEnDateChange = function(obj, event) {
    var selectedDate = apz.getObjValue(obj);
    for (var date of apz.scrMetaData.uiInits.date) {
        if (date[0] == "ficl01__AddCollaterals__i__tbDbmiCorpCollaterals__startDate") {
            var params = {};
            params.id = date[0];
            params.dataType = date[1];
            params.lookAndFeel = date[2];
            params.parentDisplay = date[3];
            params.style = date[4];
            params.parentPreset = date[5];
            params.parentMinDate = date[6];
            params.parentMaxDate = selectedDate;
            params.closeOnSel = date[8];
            params.multiSel = date[9];
            params.parentStartYear = date[10];
            params.parentEndYear = date[11];
            params.parentRangePick = date[12];
            apz.initDates(params);
        }
    }
};
