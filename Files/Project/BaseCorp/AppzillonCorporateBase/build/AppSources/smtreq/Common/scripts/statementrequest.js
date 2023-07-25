apz.smtreq.statementrequest = {};
apz.app.onLoad_statementrequest = function(lParams) {
    debugger;
    apz.smtreq.statementrequest.lfrom = lParams.from;
     if(lParams.from == "chequebookrequest"){
        
        $("#smtreq__statementrequest__deliverymoderow").addClass("sno");
    }
}
apz.smtreq.statementrequest.fnChangeFrequency = function() {
    var lfreq = apz.getElmValue("smtreq__statementrequest__freqddl");
    if (lfreq == "Daily") {
        //$("#smtreq__statementrequest__dateddl").attr("disabled", "disabled");
        $("#smtreq__statementrequest__dateddl_ext").prop("disabled", true);
        apz.setElmValue("smtreq__statementrequest__dateddl", "");
    } else {
        $("#smtreq__statementrequest__dateddl_ext").prop("disabled", false);
    }
}
apz.smtreq.statementrequest.fnMail = function() {
    debugger;
    var lval = apz.getElmValue("smtreq__statementrequest__chkmail");
    if (lval == "y") {
        $("#smtreq__statementrequest__rowaddress").removeClass("sno");
    } else {
        $("#smtreq__statementrequest__rowaddress").addClass("sno");
    }
}
apz.smtreq.statementrequest.fnEmail = function() {
    debugger;
    var lval = apz.getElmValue("smtreq__statementrequest__chkemail");
    if (lval == "y") {
        $("#smtreq__statementrequest__rowemail").removeClass("sno");
    } else {
        $("#smtreq__statementrequest__rowemail").addClass("sno");
    }
}
apz.smtreq.statementrequest.fnvalidateZipcode = function(el) {
    var digits = el.value.match(/\d{1,5}/) || [""];
    el.value = digits[0];
}
apz.smtreq.statementrequest.fnSubmit = function() {
    var params = {};
    params.message = "Your request has been submitted successfully.";
    params.type = "S";
    params.callBack = apz.smtreq.statementrequest.fngoback;
    apz.dispMsg(params);
}

apz.smtreq.statementrequest.fngoback =function(params){
    debugger;
    // if( apz.smtreq.statementrequest.lfrom == "chequebookrequest"){
    //      var params = {};
    // params.appId = "nchqbk";
    // params.scr = "ChequeBookRequest";
    // params.div = "ACNR01__Navigator__launchPad";
    // params.layout = "All";
    
    // //apz.launchSubScreen(params);
    // apz.launchApp(params);
    // }
            apz.ACNR01.Navigator.launchApp("smtreq", "statementrequest", "All", "StatementRequest");

}
