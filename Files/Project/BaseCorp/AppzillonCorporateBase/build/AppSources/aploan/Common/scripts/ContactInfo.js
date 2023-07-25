apz.ContactInfo = {};
apz.app.onLoad_ContactInfo = function() {
    $("#aploan__ContactInfo__comturnoverSlide").attr("step", "50000");
    var minVal = $("#aploan__ContactInfo__comturnoverSlide").attr("min");
    var fmin = apz.ContactInfo.fnFormatNumber(minVal);
    apz.setElmValue("aploan__ContactInfo__inpMin", fmin);
    var maxVal = $("#aploan__ContactInfo__comturnoverSlide").attr("max");
    var fmax = apz.ContactInfo.fnFormatNumber(maxVal);
    apz.setElmValue("aploan__ContactInfo__inpMax", fmax);
    apz.setElmValue("aploan__ContactInfo__comturnoverSlide", minVal);
    apz.setElmValue("aploan__ContactInfo__comturnovertxt", fmin);
}
apz.ContactInfo.fnSetTurnover = function() {
    debugger;
    var val = apz.getElmValue("aploan__ContactInfo__comturnoverSlide");
    var fval = apz.ContactInfo.fnFormatNumber(val);
    apz.setElmValue("aploan__ContactInfo__comturnovertxt", fval);
}
apz.ContactInfo.fnSetTurnoverSlide = function() {
    debugger;
    var val = apz.getElmValue("aploan__ContactInfo__comturnovertxt");
    var obj = {};
    obj.value = val;
    obj.decimalSep = ".";
    obj.displayAsLiteral = "N";
    var result = apz.unFormatNumber(obj);
    if (result < 20000000 || result > 1000000000) {
        var params = {};
        params.message = "Please enter an amount between 20,000,000.00 and 1,000,000,000.00";
        params.type = "s";
        //params.callBack = apz.ContactInfo.fnCancel;
        apz.dispMsg(params);
    } else {
        apz.setElmValue("aploan__ContactInfo__comturnoverSlide", result);
    }
}
apz.ContactInfo.fnValidateMobno = function() {
    debugger;
    var mobno = apz.getElmValue("aploan__ContactInfo__inpMobno");
    var str = mobno.replace(/[^0-9]/g, '');
    if (str.length > 12) {
        str = str.substr(0, 12);
    }
    apz.setElmValue("aploan__ContactInfo__inpMobno", str);
}
apz.ContactInfo.fnValidateRegno = function() {
    debugger;
    var str = apz.getElmValue("aploan__ContactInfo__inpRegno");
    if (str.length > 20) {
        str = str.substr(0, 20);
        apz.setElmValue("aploan__ContactInfo__inpRegno", str);
    }
}
apz.ContactInfo.fnSubmit = function() {
    var params = {};
    params.message = "Thank you for connecting with us. We will get back to you shortly.";
    params.type = "s";
    params.callBack = apz.ContactInfo.fnCancel;
    apz.dispMsg(params);
}
apz.ContactInfo.fnCancel = function() {
    var params = {};
    params.appId = "ACLI01";
    params.scr = "Login";
    apz.launchApp(params);
}
apz.ContactInfo.fnFormatNumber = function(pVal) {
    var obj = {};
    obj.value = pVal;
    obj.mask = "MILLION";
    obj.decimalPoints = 2;
    obj.decimalSep = "."
    return apz.formatNumber(obj);
}