apz.custpr = {};
apz.custpr.profile = {};
apz.custpr.profile.sCache = {};
apz.app.onLoad_Profile = function(params) {
    debugger;
    apz.custpr.profile.sCache = params;
    apz.custpr.profile.fnInitialize();
}
apz.custpr.profile.fnInitialize = function() {
    debugger;
    $("#csmrbk__LandingPage__backCol").css("visibility","visible");
    $("#csmrbk__LandingPage__backCol p ").text("Dashboard");
    apz.data.scrdata.custpr__CustProfile_Res = {};
    apz.data.scrdata.custpr__CustProfile_Res.custDetails = {};
    apz.data.scrdata.custpr__CustProfile_Res.custDetails = apz.data.scrdata.custdb__GetCustInfo_Res.custDetails.customerInfo;
    var lCustName = apz.data.scrdata.custpr__CustProfile_Res.custDetails.customerNameLine1;
    apz.data.scrdata.custpr__CustProfile_Res.custDetails.firstName = lCustName.split(" ")[0];
    apz.data.scrdata.custpr__CustProfile_Res.custDetails.lastName = lCustName.split(" ")[1];
    if (apz.data.scrdata.custpr__CustProfile_Res.custDetails.maritalStatusCd == "M") {
        apz.data.scrdata.custpr__CustProfile_Res.custDetails.maritalStatusCd = "Married";
    } else if (apz.data.scrdata.custpr__CustProfile_Res.custDetails.maritalStatusCd == "U") {
        apz.data.scrdata.custpr__CustProfile_Res.custDetails.maritalStatusCd = "Unmarried";
    } else if (apz.data.scrdata.custpr__CustProfile_Res.custDetails.maritalStatusCd == "S") {
        apz.data.scrdata.custpr__CustProfile_Res.custDetails.maritalStatusCd = "Single";
    }
    if (apz.data.scrdata.custpr__CustProfile_Res.custDetails.genderCd == "M") {
        apz.data.scrdata.custpr__CustProfile_Res.custDetails.genderCd = "Male";
    } else if (apz.data.scrdata.custpr__CustProfile_Res.custDetails.genderCd == "F") {
        apz.data.scrdata.custpr__CustProfile_Res.custDetails.genderCd = "Female";
    }
    if (apz.data.scrdata.custpr__CustProfile_Res.custDetails.nationalityCd == "US") {
        apz.data.scrdata.custpr__CustProfile_Res.custDetails.nationalityCd = "U.S. citizen";
    }
    if (apz.data.scrdata.custpr__CustProfile_Res.custDetails.customerLanguageCd == "ENU") {
        apz.data.scrdata.custpr__CustProfile_Res.custDetails.customerLanguageCd = "English US";
    }
    var lDate = apz.data.scrdata.custpr__CustProfile_Res.custDetails.birthDt;
    if(lDate.indexOf("-") != -1){
    lDate = lDate.split("-");
    apz.data.scrdata.custpr__CustProfile_Res.custDetails.birthDt = lDate[1]+"/"+lDate[2]+"/"+lDate[0];
    }
    apz.data.loadData("CustProfile", "custpr");
    var lCustNum = $("#custpr__CustProfile__o__custDetails__customerNbr_txtcnt").text();
    $("#custpr__CustProfile__o__custDetails__customerNbr_txtcnt").text("Customer ID : " + lCustNum);
    $("#custpr__Profile__mobile_txtcnt").text("Mob: " + apz.data.scrdata.custpr__CustProfile_Res.custDetails.homePhoneNbr);
    $("#custpr__Profile__email").text("Email: " + apz.data.scrdata.custpr__CustProfile_Res.custDetails.emailAddress);
    var lState = $("#custpr__CustProfile__o__custDetails__customerState_txtcnt").text();
    var lPostalcode = apz.data.scrdata.custpr__CustProfile_Res.custDetails.customerPostalCd;
    $("#custpr__CustProfile__o__custDetails__customerState_txtcnt").text(lState + "-" + lPostalcode);
};
