 apz.ficl01.CreditLimitDetails = {};
 apz.app.onLoad_CreditLimitDetails = function(params) {
     //apz.show("ficl01__FCSummary__backIcon");
     //$("#ficl01__FCSummary__el_txt_1").text("CREDIT LIMIT");
     apz.ficl01.CreditLimitDetails.getCreditLimitDetails(params.refNo);
 };
 apz.ficl01.CreditLimitDetails.getCreditLimitDetails = function(pRef) {
     var req = {
         "CreditLimitDetails": {
             "limitId": pRef
         }
     };
     req.action = "Query";
     req.table = "tb_dbmi_corp_credit_limit";
     var lServerParams = {
         "ifaceName": "FetchCreditLimitService",
         "buildReq": "N",
         "appId": "ficl01",
         "req": req,
         "paintResp": "N",
         "async": "true",
         "callBack": apz.ficl01.CreditLimitDetails.getCreditLimitDetailsCB,
         "callBackObj": "",
     };
     apz.server.callServer(lServerParams);
 };
 apz.ficl01.CreditLimitDetails.getCreditLimitDetailsCB = function(pResp) {
     if (pResp.status === true && pResp.resFull.appzillonHeader.status === true) {
         if (pResp.res.ficl01__FetchCreditLimitService_Res.Status) {
             var lTasksArr = pResp.res.ficl01__FetchCreditLimitService_Res.CreditLimitDetails;
             lTasksArr.parentLimit = "2,00,000";
             lTasksArr.utilizeAmount  =  Number(lTasksArr.limitAmount) - Number(lTasksArr.availableAmount);
             apz.data.scrdata.ficl01__FetchCreditLimitService_Res.CreditLimitDetails = lTasksArr;
             apz.data.loadData("FetchCreditLimitService", "ficl01");
         } else {
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
 apz.ficl01.CreditLimitDetails.fnCancel = function() {
     // apz.hide("ficl01__FCSummary__backIcon");
     // apz.show("ficl01__FCSummary__liclrow");
     // $("#ficl01__FCSummary__subScreenLauncher").html("");
     // apz.ficl01.FCSummary.showCreditLimit();
     apz.show("ficl01__CreditLimitsList__limHeader");
     apz.show("ficl01__CreditLimitsList__MoblimHeader");
     apz.show("ficl01__CreditLimitsList__limchart");
     apz.hide("ficl01__CreditLimitsList__subScreenLauncher");
     apz.show("ficl01__CreditLimitsList__limListRow");
     apz.ficl01.CreditLimitsList.getCreditLimitList();
     apz.setElmValue("ficl01__CreditLimitsList__SearchValue", "");
     apz.setElmValue("ficl01__CreditLimitsList__SearchBy", "Search");
 };
