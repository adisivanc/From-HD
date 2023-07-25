apz.benf01.OtherBankBeneficaryDetails = {};
apz.app.onLoad_OtherBankBeneficaryDetails = function(params) {
    debugger;
    apz.benf01.OtherBankBeneficaryDetails.sCorporateId = apz.Login.sCorporateId;
    $("#benf01__Beneficiary__OBHead").addClass("sno");
    apz.benf01.OtherBankBeneficaryDetails.lScrData = params.data.OBData;
    // var req = {};
    // req.beneficiaryDetails = {
    //     "corporateId": apz.benf01.OtherBankBeneficaryDetails.sCorporateId,
    //     "beneficaryType": "Other",
    //     "accountNumber": params.accountNumber
    // };
    // req.action = "Query";
    // req.table = "tb_dbmi_corp_role_beneficary";
    // var lServerParams = {
    //     "ifaceName": "FetchBeneficaryService",
    //     "buildReq": "N",
    //     "appId": "benf01",
    //     "req": "",
    //     "paintResp": "Y",
    //     "async": "true",
    //     "callBack": apz.benf01.OtherBankBeneficaryDetails.fetchBeneficaryDetailsQueryCB,
    //     "callBackObj": "",
    // };
    // lServerParams.req = req;
    // apz.server.callServer(lServerParams);
    apz.data.scrdata.benf01__BeneficaryDetails_Req = {};
    apz.data.scrdata.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = {};
    apz.data.scrdata.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = apz.benf01.OtherBankBeneficaryDetails.lScrData;
    apz.data.loadData("BeneficaryDetails", "benf01");
};
// apz.benf01.OtherBankBeneficaryDetails.fetchBeneficaryDetailsQueryCB = function(params) {
//     debugger;
//     if (params.status === true && params.resFull.appzillonHeader.status === true) {
//         if (params.res.benf01__FetchBeneficaryService_Res.Status) {
//             apz.data.scrdata.benf01__BeneficaryDetails_Req = {};
//             apz.data.scrdata.benf01__BeneficaryDetails_Req.tbDbmiCorpRoleBeneficary = params.res.benf01__FetchBeneficaryService_Res.beneficiaryDetails;
//             apz.data.loadData("BeneficaryDetails", "benf01");
//         }
//     }
// };
apz.benf01.OtherBankBeneficaryDetails.fnCancel = function() {
    apz.show("benf01__Beneficiary__beneficaryRow");
    apz.show("benf01__Beneficiary__benfRow");
    apz.show("benf01__Beneficiary__rowdom_intbtn");
    $("#benf01__Beneficiary__benLaunchRow").html("");
    apz.benf01.Beneficiary.otherBankDOM();
};
