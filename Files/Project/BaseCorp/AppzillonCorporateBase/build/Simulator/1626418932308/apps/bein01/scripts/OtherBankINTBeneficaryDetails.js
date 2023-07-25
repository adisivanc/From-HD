apz.bein01.OtherBankINTBeneficaryDetails = {};
apz.app.onLoad_OtherBankINTBeneficaryDetails = function(params) {
    debugger;
    apz.bein01.OtherBankINTBeneficaryDetails.sCorporateId = apz.Login.sCorporateId;
    $("#benf01__Beneficiary__INTHead").addClass("sno");
    apz.bein01.OtherBankINTBeneficaryDetails.lScrData = params.data.INTData;
    // var req = {};
    // req.beneficiaryDetails = {
    //     "corporateId": apz.bein01.OtherBankINTBeneficaryDetails.sCorporateId,
    //     "beneficaryType": "International",
    //     "accountNumber": params.accountNumber
    // };
    // req.action = "Query";
    // req.table = "tb_dbmi_corp_role_beneficary";
    // var lServerParams = {
    //     "ifaceName": "FetchBeneficaryService",
    //     "buildReq": "N",
    //     "appId": "bein01",
    //     "req": "",
    //     "paintResp": "Y",
    //     "async": "true",
    //     "callBack": apz.bein01.OtherBankINTBeneficaryDetails.fetchBeneficaryDetailsQueryCB,
    //     "callBackObj": "",
    // };
    // lServerParams.req = req;
    // apz.server.callServer(lServerParams);
    apz.data.scrdata.bein01__BeneficaryDetails_Req = {};
    apz.data.scrdata.bein01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = {};
    apz.data.scrdata.bein01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = apz.bein01.OtherBankINTBeneficaryDetails.lScrData;
   apz.data.loadData("BeneficaryDetails", "bein01");
};
// apz.bein01.OtherBankINTBeneficaryDetails.fetchBeneficaryDetailsQueryCB = function(params) {
//     debugger;if (params.status === true && params.resFull.appzillonHeader.status === true) {
//         if (params.res.bein01__FetchBeneficaryService_Res.Status) {
//             apz.data.scrdata.bein01__BeneficaryDetails_Req = {};
//             apz.data.scrdata.bein01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = params.res.bein01__FetchBeneficaryService_Res.beneficiaryDetails;
//             apz.data.loadData("BeneficaryDetails", "bein01");
//         }
//     }
// };
apz.bein01.OtherBankINTBeneficaryDetails.fnCancel = function() {
    apz.show("benf01__Beneficiary__beneficaryRow");
    apz.show("benf01__Beneficiary__benfRow");
    apz.show("benf01__Beneficiary__rowdom_intbtn");
    
    $("#benf01__Beneficiary__benLaunchRow").html("");
    apz.benf01.Beneficiary.otherBankINT();
};


apz.bein01.OtherBankINTBeneficaryDetails.fnSelectBenCountry = function(){
    debugger;
    var benCountry = apz.getElmValue("bein01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__benCountry");
    apz.setElmValue("bein01__BeneficaryDetails__i__tbDbmiCorpRoleBeneficary__transferCurrency",benCountry)
}
