apz.nchqbk.ReversePositivePay = {};
apz.app.onLoad_ReversePositivePay = function() {
    debugger;
    $("#nchqbk__ReversePositivePay__ct_tbl_1_add_btn").addClass("sno");
    $("#nchqbk__ReversePositivePay__ct_tbl_1_rem_btn").addClass("sno");
    apz.nchqbk.ReversePositivePay.fnFetchAccounts();
}
apz.nchqbk.ReversePositivePay.fnFetchAccounts = function() {
    debugger;
    var lAcctArr = [{
        "val": "",
        "desc": "Please Select"
    }, {
        "val": "8903452385",
        "desc": "XXXXXX2385"
    }, {
        "val": "3451890348",
        "desc": "XXXXXX0348"
    }, {
        "val": "7812094782",
        "desc": "XXXXXX4782"
    }, {
        "val": "6723891736",
        "desc": "XXXXXX1736"
    }, {
        "val": "4561298347",
        "desc": "XXXXXX8347"
    }]
    apz.populateDropdown(document.getElementById("nchqbk__ReversePositivePay__ddlAcctNo"), lAcctArr);
    apz.nchqbk.ReversePositivePay.lData = JSON.parse(apz.getFile(apz.getDataFilesPath("nchqbk") + "/ReversePositivePay.json"));
    apz.setElmValue("nchqbk__ReversePositivePay__ddlAcctNo", "8903452385");
}
apz.nchqbk.ReversePositivePay.fnSelectAcctNo = function() {
    debugger;
    var lAcct = apz.getElmValue("nchqbk__ReversePositivePay__ddlAcctNo");
    var result = apz.nchqbk.ReversePositivePay.lData.filter(obj => obj.AccountNumber == lAcct);
    apz.data.scrdata.nchqbk__ReversePositivePay_Res = {
        ListItem: result
    }
    apz.data.loadData("ReversePositivePay", "nchqbk");
}
apz.nchqbk.ReversePositivePay.fnSubmit = function() {
    debugger;
    apz.dispMsg({
        message: "Submitted successfully",
        type: "S",
        callBack: apz.nchqbk.ReversePositivePay.fnSubmitCB
    });
}

apz.nchqbk.ReversePositivePay.fnSubmitCB = function(params){
    debugger;
    apz.ACNR01.Navigator.launchApp("nchqbk", "ReversePositivePay", "All", "ReversePositivePay");
}
