apz.loandt.loanPayment = {};
apz.loandt.loanPayment.sCache = {};

apz.app.onLoad_LoanPayment = function(params) {
    
    apz.loandt.loanPayment.sCache = params;
    apz.loandt.loanPayment.fnInitialize();
}

apz.loandt.loanPayment.fnInitialize = function(){
    debugger;
    $("#csmrbk__LandingPage__backCol p ").text("Account Details");
    $("#loandt__LoanPayment__name_txtcnt").text(apz.loandt.loanPayment.sCache.custInfo.customerNameLine1);
    $("#loandt__LoanPayment__custId_txtcnt").text("Customer Id :"+apz.loandt.loanPayment.sCache.custInfo.customerNbr);
    
};

apz.loandt.loanPayment.fnPayLoan = function(){
    debugger;
    var lServerParams = {
        "ifaceName": "PostLoanAccTransac",
        "buildReq": "N",
        "req": {},
        "paintResp": "N",
        "async": "",
        "callBack": apz.loandt.loanPayment.fnDbCallback,
        "callBackObj": "",
    };
    lServerParams.req = {
        "reqDetails": {
            "action": "postLoanAccount",
            "loanNumber": apz.loandt.loanAccDetails.sCache.accountDetails.loanAccNum,
            "token": apz.loandt.loanAccDetails.sCache.tokenObj.loans,
            "totalTransactionAmt":parseFloat($("#loandt__LoanPayment__el_inp_5").val().split(",").join("")),
            "transactionDescription":$("#loandt__LoanPayment__el_inp_7").val()
        }
    }
    apz.startLoader();
    apz.server.callServer(lServerParams);
};

apz.loandt.loanPayment.fnCancel = function(){
    var lParams = {
        "scr": "LoanAccDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj":{
                "customer":apz.csmrbk.landingpage.sCustomerToken,
                "loans":apz.csmrbk.landingpage.sLoanToken,
                "cards":apz.csmrbk.landingpage.sCardToken
            },
            "accountDetails":{
                "loanAccNum":apz.loandt.loanPayment.sCache.accountDetails.loanAccNum,
                "loanAccType":apz.loandt.loanPayment.sCache.accountDetails.loanAccType
            },
            "custInfo":apz.loandt.loanPayment.sCache.custInfo
        }
    };
    apz.launchSubScreen(lParams);
};

apz.loandt.loanPayment.fnDbCallback = function(params){
    apz.stopLoader();
    var lObj = {};
  lObj.targetId = "loandt__LoanPayment__confirmModal";
  apz.toggleModal(lObj);
  $(".modal-header").hide();
};

apz.loandt.loanPayment.fnOK = function(){
    var lObj = {};
  lObj.targetId = "loandt__LoanPayment__confirmModal";
  apz.toggleModal(lObj);
    var lLaunchParams = {
        "appId": "custdb",
        "scr": "Dashboard",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj":{
                "customer":apz.csmrbk.landingpage.sCustomerToken,
                "loans":apz.csmrbk.landingpage.sLoanToken,
                "cards":apz.csmrbk.landingpage.sCardToken
            }
        }
    };
    apz.launchApp(lLaunchParams);
    
    
};
apz.loandt.loanPayment.fnBack = function(){
    var lParams = {
        "scr": "LoanAccDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
           "accountDetails":{
                "loanAccNum":apz.loandt.loanPayment.sCache.accountDetails.loanAccNum,
                "loanAccType":apz.loandt.loanPayment.sCache.accountDetails.loanAccType
            },
            "custInfo":apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchSubScreen(lParams);
};


apz.loandt.loanPayment.fnFormatNumber = function(){
    var lAmt = $("#loandt__LoanPayment__el_inp_5").val();
    var lNewmt = lAmt.split(",").join("");
    lNewmt = lNewmt.split(".")[1];
    lNewmt = lNewmt.substring(0, 1);
    if(lNewmt == "0"){
        lAmt= lAmt.split(",").join("").split(".")[0];
    $("#loandt__LoanPayment__el_inp_5").val(lAmt);
    }
}

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