apz.crdles.CardlessCash = {};
apz.app.onLoad_CardlessCash = function(params) {
    debugger;
    // apz.crdles.CardlessCash.fnSetNavigation(params);
    var acctArr = [{
        "val": "47585936513712",
        "desc": "XXXXXXXXXX3712"
    },
    {
        "val": "47585936514239",
        "desc": "XXXXXXXXXX4239"
    },
    {
        "val": "5785936513734",
        "desc": "XXXXXXXXX3734"
    },
    {
        "val": "5785936519021",
        "desc": "XXXXXXXXX9021"
    },
    {
        "val": "7356329872264",
        "desc": "XXXXXXXXX2264"
    },
    {
        "val": "7356329878742",
        "desc": "XXXXXXXXX8742"
    },
    {
        "val": "8274239480885",
        "desc": "XXXXXXXXX0885"
    },
    {
        "val": "8274239482711",
        "desc": "XXXXXXXXX2711"
    },
    {
        "val": "8274239489012",
        "desc": "XXXXXXXXX9012"
    }];
    apz.populateDropdown(document.getElementById("crdles__CardlessCash__el_dpd_1"), acctArr);
};
apz.app.onShown_CardlessCash = function() {
    $("#crdles__CardlessCash__el_inp_2").attr("type", "tel");
}
apz.crdles.CardlessCash.fnSubmit = function() {
    debugger;
    $("#crdles__CardlessCash__mainScreen").addClass("sno");
     $("#crdles__CardlessCash__rowBtns").addClass("sno");
    $("#crdles__CardlessCash__otp").removeClass("sno");
    apz.crdles.CardlessCash.fnSubmitCallBack();
}
apz.crdles.CardlessCash.fnSubmitCallBack = function() {
    var lLaunchParams = {
        "appId": "crdles",
        "scr": "SuccessScreen",
        "div": "crdles__CardlessCash__otp"
    };
    apz.launchSubScreen(lLaunchParams);
}
apz.crdles.CardlessCash.fnShowHideRow = function(pthis,rowid){
    debugger;
    $("#crdles__CardlessCash__rowOwnAcct").addClass("sno");
    $("#crdles__CardlessCash__rowThirdParty").addClass("sno");
    $("#crdles__CardlessCash__" + rowid).removeClass("sno");
    
    $("#crdles__CardlessCash__sectionList li").removeClass("current");
    $(pthis).parent().addClass("current");
}