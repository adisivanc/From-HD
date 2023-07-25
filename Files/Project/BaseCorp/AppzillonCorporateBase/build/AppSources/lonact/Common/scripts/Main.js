apz.lonact.Main = {};
apz.lonact.Main.EffectiveDateArr = [];
apz.app.onLoad_Main = function(userObj) {
    debugger;
    apz.lonact.continueFlag = "";
    var lobj = {};
    lobj.DateVal = "";
    lobj.EffectiveDateTbl = []
    apz.lonact.Main.EffectiveDateArr.push(lobj);
    apz.data.scrdata.lonact__EffectiveDate_Res = {}
    apz.data.scrdata.lonact__EffectiveDate_Res.ListItem = apz.lonact.Main.EffectiveDateArr;
    apz.data.loadData("EffectiveDate", "lonact");
    apz.data.scrdata.lonact__EffectiveDateTbl_Res = {}
    apz.data.loadData("EffectiveDateTbl", "lonact");
    
    if(apz.lonact.loanDetails.currency){
        apz.setElmValue("lonact__Main__Amount",apz.lonact.loanDetails.amount);
        apz.setElmValue("lonact__Main__Currency",apz.lonact.loanDetails.currency);
        apz.setElmValue("lonact__Main__ValueDate",apz.lonact.loanDetails.valueDate);
        apz.setElmValue("lonact__Main__MaturityDate",apz.lonact.loanDetails.maturityDate);
        apz.setElmValue("lonact__Main__inpCustName",apz.lonact.loanDetails.customerName);
    }
    
     if(apz.lonact.loanDetails.effectiveDateArr){
        apz.lonact.Main.EffectiveDateArr = apz.lonact.loanDetails.effectiveDateArr;
        apz.data.scrdata.lonact__EffectiveDate_Res = {}
        apz.data.scrdata.lonact__EffectiveDate_Res.ListItem = apz.lonact.Main.EffectiveDateArr;
        apz.data.loadData("EffectiveDate", "lonact");
        setTimeout(function() {
            debugger;
            for (var i = 0; i < apz.lonact.Main.EffectiveDateArr.length; i++) {
                $("#lonact__Main__addicon_" + i).parent().addClass("sno");
                 $("#lonact__Main__delicon_" + i).parent().removeClass("sno");
            }
            var lastrow = apz.lonact.Main.EffectiveDateArr.length - 1;
            $("#lonact__Main__addicon_" + lastrow).parent().removeClass("sno");
            $("#lonact__Main__delicon_" + lastrow).parent().addClass("sno");
        }, 100);
        
        apz.lonact.Main.fnShowEffectiveDate($("#lonact__Main__el_icn_1_0"));
        
    }
};
apz.lonact.Main.fnAddEffectiveDate = function(pthis) {
    debugger;
    
    $("#lonact__Main__ct_lst_1 li").removeClass("completed");
     
     for (var i = 0; i < apz.lonact.Main.EffectiveDateArr.length; i++) {
        $("#lonact__Main__el_icn_1_" + i).find("use").attr("xlink:href", "#icon-SucEmpty");
    }
    var lrow = $(pthis).attr("rowno");
    if (!apz.isNull(apz.getElmValue("lonact__EffectiveDate__o__ListItem__DateVal_" + lrow))) {
        apz.lonact.Main.EffectiveDateArr[lrow].DateVal = apz.getElmValue("lonact__EffectiveDate__o__ListItem__DateVal_" + lrow);
        apz.lonact.Main.EffectiveDateArr[lrow].EffectiveDateTbl = apz.data.buildData("EffectiveDateTbl", "lonact").lonact__EffectiveDateTbl_Res.Result;
        $("#lonact__Main__delicon_" + lrow).parent().removeClass("sno");
        $("#lonact__Main__addicon_" + lrow).parent().addClass("sno");
        var lobj = {};
        lobj.DateVal = "";
        lobj.EffectiveDateTbl = [];
        apz.lonact.Main.EffectiveDateArr.push(lobj);
        apz.data.scrdata.lonact__EffectiveDate_Res = {};
        apz.data.scrdata.lonact__EffectiveDate_Res.ListItem = apz.lonact.Main.EffectiveDateArr;
        apz.data.loadData("EffectiveDate", "lonact");
        setTimeout(function() {
            debugger;
            // for (var i = 0; i < apz.lonact.Main.EffectiveDateArr.length; i++) {
            //     $("#lonact__Main__addicon_" + i).parent().addClass("sno");
            // }
            var lastrow = apz.lonact.Main.EffectiveDateArr.length - 1;
            $("#lonact__Main__addicon_" + lastrow).parent().removeClass("sno");
            $("#lonact__Main__delicon_" + lastrow).parent().addClass("sno");
        }, 100);
    }
};
apz.lonact.Main.fnAddEffectiveTblValue = function(pthis) {
    debugger;
    var prow = $(pthis).attr("rowno");
    var ldate = $("#" + pthis.id).val();
    apz.lonact.Main.EffectiveDateArr[prow].DateVal = ldate;
    apz.lonact.Main.EffectiveDateArr[prow].EffectiveDateTbl = [];
    if (ldate == "01/01/2021") {
        var lobj = {};
        lobj.UDEID = "MAIN_INT";
        lobj.UDEValue = "4.5%";
        lobj.RateCode = "";
        lobj.CodeUsage = "";
        lobj.ResolvedValue = "4.5%";
        apz.lonact.Main.EffectiveDateArr[prow].EffectiveDateTbl.push(lobj);
        var lobj1 = {};
        lobj1.UDEID = "CHARGE";
        lobj1.UDEValue = "120";
        lobj1.RateCode = "";
        lobj1.CodeUsage = "";
        lobj1.ResolvedValue = "120";
        apz.lonact.Main.EffectiveDateArr[prow].EffectiveDateTbl.push(lobj1);
    } else if (ldate == "01/08/2021") {
        var lobj = {};
        lobj.UDEID = "MAIN_INT";
        lobj.UDEValue = "0.75%";
        lobj.RateCode = "FEDFUNDS";
        lobj.CodeUsage = "AUTO";
        lobj.ResolvedValue = "5.25%";
        apz.lonact.Main.EffectiveDateArr[prow].EffectiveDateTbl.push(lobj);
        var lobj1 = {};
        lobj1.UDEID = "CHARGE";
        lobj1.UDEValue = "120";
        lobj1.RateCode = "";
        lobj1.CodeUsage = "";
        lobj1.ResolvedValue = "120";
        apz.lonact.Main.EffectiveDateArr[prow].EffectiveDateTbl.push(lobj1);
    } else {
        var lobj = {};
        lobj.UDEID = "";
        lobj.UDEValue = "";
        lobj.RateCode = "";
        lobj.CodeUsage = "";
        lobj.ResolvedValue = "";
        apz.lonact.Main.EffectiveDateArr[prow].EffectiveDateTbl.push(lobj);
    }
    apz.data.scrdata.lonact__EffectiveDateTbl_Res = {}
    apz.data.scrdata.lonact__EffectiveDateTbl_Res.Result = apz.lonact.Main.EffectiveDateArr[prow].EffectiveDateTbl;
    apz.data.loadData("EffectiveDateTbl", "lonact");
}
apz.lonact.Main.fnDeleteEffectiveDate = function(pthis) {
    debugger;
     $("#lonact__Main__ct_lst_1 li").removeClass("completed");
     
     for (var i = 0; i < apz.lonact.Main.EffectiveDateArr.length; i++) {
        $("#lonact__Main__el_icn_1_" + i).find("use").attr("xlink:href", "#icon-SucEmpty");
    }
    var lrow = $(pthis).attr("rowno");
    apz.lonact.Main.EffectiveDateArr.splice(lrow, 1);
    apz.data.scrdata.lonact__EffectiveDate_Res = {}
    apz.data.scrdata.lonact__EffectiveDate_Res.ListItem = apz.lonact.Main.EffectiveDateArr;
    apz.data.loadData("EffectiveDate", "lonact");
    setTimeout(function() {
        debugger;
        
        // for (var i = 0; i < apz.lonact.Main.EffectiveDateArr.length; i++) {
        //     $("#chkdpt__DepositCheck__addicon_" + i).parent().addClass("sno");
        // }
        var lastrow = apz.lonact.Main.EffectiveDateArr.length - 1;
        $("#lonact__Main__addicon_" + lastrow).parent().removeClass("sno");
        $("#lonact__Main__delicon_" + lastrow).parent().addClass("sno");
    }, 100)
}
apz.lonact.Main.fnShowEffectiveDate = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    $("#lonact__Main__ct_lst_1 li").removeClass("completed");
    $("#lonact__Main__ct_lst_1_row_" + lrow).addClass("completed");
    for (var i = 0; i < apz.lonact.Main.EffectiveDateArr.length; i++) {
        $("#lonact__Main__el_icn_1_" + i).find("use").attr("xlink:href", "#icon-SucEmpty");
    }
    $("#lonact__Main__el_icn_1_" + lrow).find("use").attr("xlink:href", "#icon-SucIcn");
    apz.data.scrdata.lonact__EffectiveDateTbl_Res = {}
    apz.data.scrdata.lonact__EffectiveDateTbl_Res.Result = apz.lonact.Main.EffectiveDateArr[lrow].EffectiveDateTbl;
    apz.data.loadData("EffectiveDateTbl", "lonact");
}
