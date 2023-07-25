 apz.ficl01.CommitmentDetails = {};
 apz.app.onLoad_CommitmentDetail = function(params) {
     //apz.show("ficl01__FCSummary__backIcon");
     //$("#ficl01__FCSummary__el_txt_1").text("COMMITMENT");
     apz.ficl01.CommitmentDetails.getCommitmentDetails(params.refNo);
 };
 apz.ficl01.CommitmentDetails.getCommitmentDetails = function(pRef) {
     var req = {
         "CommitmentDetails": {
             "commitmentId": pRef
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
         "callBack": apz.ficl01.CommitmentDetails.getCommitmentDetailsCB,
         "callBackObj": "",
     };
     apz.server.callServer(lServerParams);
 };
 apz.ficl01.CommitmentDetails.getCommitmentDetailsCB = function(pResp) {
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
 apz.ficl01.CommitmentDetails.fnCancel = function() {
     debugger;
    //  apz.hide("ficl01__FCSummary__backIcon");
    //  apz.show("ficl01__FCSummary__liclrow");
    //  $("#ficl01__FCSummary__subScreenLauncher").html("");
    //  apz.ficl01.FCSummary.showCommitment();
     
     apz.show("ficl01__CommitmentList__commListRow");
    apz.hide("ficl01__CommitmentList__subScreenLauncher");
    apz.show("ficl01__CommitmentList__commHeader");
     apz.show("ficl01__CommitmentList__MobcommHeader");
    apz.ficl01.CommitmentList.getCommitmentList();
    apz.setElmValue("ficl01__CommitmentList__SearchValue","");
    apz.setElmValue("ficl01__CommitmentList__SearchBy","Search");
    
 };
 
