apz.funtra.transferDetails = {};
apz.funtra.transferDetails.sCache = {};
apz.app.onLoad_TransferDetails = function(params) {
    debugger;
    apz.funtra.transferDetails.sCache = params;
    $("#funtra__TransferDetails__name_txtcnt").text(apz.funtra.transferDetails.sCache.custInfo.customerNameLine1);
    $("#funtra__TransferDetails__custId").text("Customer Id: " + apz.funtra.transferDetails.sCache.custInfo.customerNbr);
    var lFromAcc = [];
    var lToAcc = [];
    $("#csmrbk__LandingPage__backCol").css("visibility", "visible");
    $("#csmrbk__LandingPage__backCol p").text("Home");
    for (i = 0; i < apz.custdb.dashboard.sDDAAcc.length; i++) {
        var lObj = {
            "val": apz.custdb.dashboard.sDDAAcc[i].accountType + "-" + apz.custdb.dashboard.sDDAAcc[i].accountNbr,
            "desc": apz.custdb.dashboard.sDDAAcc[i].accountNbr
        };
        lFromAcc.push(lObj);
    };
    apz.populateDropdown(document.getElementById("funtra__TransferDetails__fromAcc"), lFromAcc);
    var lToAcc = [];
    for (i = 0; i < apz.custdb.dashboard.sRSVAcc.length; i++) {
        var lObj = {
            "val": apz.custdb.dashboard.sRSVAcc[i].accountType + "-" + apz.custdb.dashboard.sRSVAcc[i].accountNbr,
            "desc": apz.custdb.dashboard.sRSVAcc[i].accountNbr
        };
        lToAcc.push(lObj);
    };
    apz.populateDropdown(document.getElementById("funtra__TransferDetails__toAcc"), lToAcc);
    if (apz.funtra.transferDetails.sCache.transferDetails != undefined) {
        $("#funtra__TransferDetails__fromAcc").val(apz.funtra.transferDetails.sCache.transferDetails.fromAcc);
        $("#funtra__TransferDetails__toAcc").val(apz.funtra.transferDetails.sCache.transferDetails.toAcc);
        $("#funtra__TransferDetails__amt").val(apz.funtra.transferDetails.sCache.transferDetails.amt);
        $("#funtra__TransferDetails__remarks").val(apz.funtra.transferDetails.sCache.transferDetails.remarks);
    }
};
apz.funtra.transferDetails.fnConfirmDetails = function() {
    var lParams = {
        "scr": "ConfirmDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "parentAppId": "csmrbk",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "transferDet": {
                "fromAcc": $("#funtra__TransferDetails__fromAcc").val(),
                "toAcc": $("#funtra__TransferDetails__toAcc").val(),
                "amt": $("#funtra__TransferDetails__amt").val(),
                "remarks": $("#funtra__TransferDetails__remarks").val(),
            }
        }
    };
    apz.launchSubScreen(lParams);
}
apz.funtra.transferDetails.fnFormatNumber = function() {
    debugger;
    var lAmt = $("#funtra__TransferDetails__amt").val();
    var lNewmt = lAmt.split(",").join("");
    lNewmt = lNewmt.split(".")[1];
    lNewmt = lNewmt.substring(0, 1);
    if(lNewmt == "0"){
        lAmt= lAmt.split(",").join("").split(".")[0];
    $("#funtra__TransferDetails__amt").val(lAmt);
    }
};


apz.formatNumberUIControl = function(obj) {
    debugger;
      var id = obj.id;
      var elmData = null;
      var recNo = -1;
      recNo = this.getObjRowNumber(obj);
      id = this.getObjIdWORowNumber(obj);
      try {
         elmData = this.scrMetaData.elmsMap[id];
      } catch (e) {
         elmData = null;
      }
      var value = this.getObjValue(obj);
      if (!this.isNull(value)) {
         //RADS - Unformat and Format Number..Chekc Should be based on whether
         // the value is Changed or Not..
         //If its not Changed, we shouldnot format because its alreay formatted
        /// TBC - onfocus set obj.oldval = obj.value to find previous value?
         if (apz.val.isNumber(value)) {
           var decimalPoints = this.getDecimalPoints(elmData,recNo);
            var params = {};
            params.value = value;
            params.decimalSep = this.decimalSep;
            params.decimalPoints = decimalPoints;
            params.mask = this.numberMask;
            params.displayAsLiteral = elmData.displayAsLiteral;
           value = this.unFormatNumber(params);
            value = this.formatNumber(params);
           this.setObjValue(obj,value);
         } 
      }
   }