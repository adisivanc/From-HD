apz.srvreq.selectService = {};
apz.app.onLoad_SelectService = function(params) {
    debugger;
    apz.srvreq.selectService.fnInitialise(params);
    
};
apz.srvreq.selectService.fnInitialise = function(params) {
    debugger;
    apz.srvreq.selectService.sParams = params;
    $(".icon-check").addClass("sno");
  
   
};
apz.srvreq.selectService.fnSelectService = function(pthis) {
    debugger;
    apz.setElmValue("srvreq__SelectService__serviceType", $("#" + pthis.id).text().toUpperCase());
    apz.show("srvreq__SelectService__sc_row_10");
    $(".selectedele").removeClass("selectedele");
    $(pthis).addClass("selectedele");
    //apz.hide("srvreq__SelectService__Stage2");
   // $("#srvreq__SelectService__Stage2").parent("span").addClass("sno");
    //$("#srvreq__SelectService__Stage3").parent("span").addClass("sno");
    //apz.hide("srvreq__SelectService__Stage3");
    apz.show("srvreq__SelectService__serviceReqNav");
    $(".icon-check").addClass("sno");
    $("#" + pthis.id).find(".icon-check").removeClass("sno");
    $("#srvreq__SelectService__DepDetails").toggleClass("sno");
    if ($("#" + pthis.id).text().toUpperCase() == "DEMAND DRAFT REQUEST") {
        apz.show("srvreq__SelectService__favourOf_ul");
       // $("#srvreq__SelectService__beneficiaryname_ul").removeClass("sno");
    } else {
        apz.hide("srvreq__SelectService__favourOf_ul");
    }
    
    if(/Financial Advice/ig.test($("#" + pthis.id).text().toUpperCase())){
        $("#srvreq__SelectService__appointmentRemark_ul").removeClass("sno");
        $("#srvreq__SelectService__DepAmt_ul").addClass("sno")
    }else{
        $("#srvreq__SelectService__appointmentRemark_ul").addClass("sno");
        $("#srvreq__SelectService__DepAmt_ul").removeClass("sno");
    }
    //$("#srvreq__SelectService__favourOf").removeClass("sno");
};
apz.srvreq.selectService.fnBookAppointment = function() {
    debugger;
    var lVisibility = false;
    $(".icon-check").each(function(intIndex) {
        debugger;
        if (!$(this).hasClass("sno")) {
            lVisibility = true;
        }
    });
   // var lBranchName = apz.getElmValue("srvreq__SelectService__Branch");
    if (lVisibility ) {
        var lData = {};
        lData.UserDtls = apz.srvreq.selectService.sParams.data;
        lData.BranchDtls = {};
        lData.BranchDtls.serviceType = apz.getElmValue("srvreq__SelectService__serviceType");
        lData.BranchDtls.favourOf = apz.getElmValue("srvreq__SelectService__favourOf");
        lData.BranchDtls.remark = $("#srvreq__SelectService__appointmentRemark").val() || "";
        //lData.BranchDtls.branch = apz.getElmValue("srvreq__SelectService__Branch");
        lData.BranchDtls.toAcc = apz.getElmValue("srvreq__SelectService__ToAcc");
        lData.BranchDtls.amount = apz.getElmValue("srvreq__SelectService__DepAmt");
        lData.BranchDtls.beneficiary = apz.getElmValue("srvreq__SelectService__beneficiaryname")
        apz.srvreq.selectService.fnRenderBookAppointment();
        var lParams = {
            "scr": "BookAppointment",
            "div": "srvreq__SelectService__Stage2",
            "type": "CF",
            "userObj": {
                "destroyDiv": "srvreq__SelectService__Stage2",
                "data": lData,
                "callBack": apz.srvreq.selectService.fnRenderSelectService
            }
        };
        apz.launchSubScreen(lParams);
    } else {
        var params = {
            "code": "ERR_01",
        };
        apz.dispMsg(params);
    }
};
apz.srvreq.selectService.fnRenderSelectService = function() {
    debugger;
     apz.show("srvreq__SelectService__ServiceCol");
    //apz.show("srvreq__SelectService__Stage1");
    $("#srvreq__SelectService__Stage1").parent("span").removeClass("sno");
   // apz.hide("srvreq__SelectService__Stage2");
     $("#srvreq__SelectService__Stage2").parent("span").addClass("sno");
   // apz.hide("srvreq__SelectService__Stage3");
     $("#srvreq__SelectService__Stage3").parent("span").addClass("sno");
    apz.show("srvreq__SelectService__serviceReqNav");
};
apz.srvreq.selectService.fnRenderBookAppointment = function() {
    debugger;
    apz.hide("srvreq__SelectService__ServiceCol");
    apz.hide("srvreq__SelectService__sc_row_10");
    apz.hide("srvreq__SelectService__serviceReqNav");
   // apz.hide("srvreq__SelectService__Stage2");
     $("#srvreq__SelectService__Stage2").parent("span").removeClass("sno");
   // apz.show("srvreq__SelectService__Stage3");
    $("#srvreq__SelectService__Stage3").parent("span").addClass("sno");
    
};
apz.srvreq.selectService.fnBack = function() {
    debugger;
    apz.srvreq.selectService.sParams.callBack();
}


$( document ).ready(function() {
    var panelheight= $("#srvreq__SelectService__ps_pls_1").height();
$("#srvreq__SelectService__ps_pls_7").height(panelheight);  
});
