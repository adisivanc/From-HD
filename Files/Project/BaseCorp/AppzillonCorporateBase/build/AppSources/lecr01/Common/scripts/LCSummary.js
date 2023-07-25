apz.lecr01.LCSummary = {};
apz.app.onLoad_LCSummary = function(params) {
    //apz.show("lecr01__LCSummary__tradefinancerow");
    apz.hide("lecr01__LCSummary__tradeIcon");
    
    if(params.from == "ImportLC"){
         apz.lecr01.LCSummary.showImportLC();
    }
     if(params.from == "BillCollections"){
         apz.lecr01.LCSummary.showBillCollections();
    }
     if(params.from == "Guarantees"){
         apz.lecr01.LCSummary.showGuarantees();
    }
   
};
apz.lecr01.LCSummary.showImportLC = function() {
   
    var params = {};
    params.appId = "lecr01";
    params.scr = "ImportLC";
    params.layout = "All";
    params.div = "lecr01__LCSummary__tradeDivLauncher";
    $("#lecr01__LCSummary__tradefinancerow").removeClass("sno");
    $("#lecr01__LCSummary__Mobtradefinancerow").removeClass("sno");
    $("#lecr01__LCSummary__BCRow").addClass("sno");
    $("#lecr01__LCSummary__MobBCRow").addClass("sno");
    $("#lecr01__LCSummary__GuaranteesRow").addClass("sno");
    $("#lecr01__LCSummary__MobGuaranteesRow").addClass("sno");
    apz.launchInDiv(params);
};
apz.lecr01.LCSummary.showExportLC = function() {
    var params = {};
    params.appId = "lecr01";
    params.scr = "ExportLC";
    params.layout = "All";
    params.div = "lecr01__LCSummary__tradeDivLauncher";
    apz.launchInDiv(params);
};
apz.lecr01.LCSummary.showBillCollections = function() {
   
    /*var msg = {
            "code": 'APZ_BC01_NODATA'
        };
        apz.dispMsg(msg);*/
     var params = {};
     params.appId = "lecr01";
     params.scr = "BillCollections";
     params.layout = "All";
     params.div = "lecr01__LCSummary__tradeDivLauncher";
     $("#lecr01__LCSummary__tradefinancerow").addClass("sno");
      $("#lecr01__LCSummary__Mobtradefinancerow").addClass("sno");
     $("#lecr01__LCSummary__BCRow").removeClass("sno");
     $("#lecr01__LCSummary__MobBCRow").removeClass("sno");
     $("#lecr01__LCSummary__GuaranteesRow").addClass("sno");
     $("#lecr01__LCSummary__MobGuaranteesRow").addClass("sno");
     apz.launchInDiv(params);
};
apz.lecr01.LCSummary.showGuarantees = function() {
    
    var params = {};
    params.appId = "lecr01";
    params.scr = "Guarantees";
    params.layout = "All";
    params.div = "lecr01__LCSummary__tradeDivLauncher";
    $("#lecr01__LCSummary__tradefinancerow").addClass("sno");
    $("#lecr01__LCSummary__Mobtradefinancerow").addClass("sno");
    $("#lecr01__LCSummary__BCRow").addClass("sno");
    $("#lecr01__LCSummary__MobBCRow").addClass("sno");
    $("#lecr01__LCSummary__GuaranteesRow").removeClass("sno");
    $("#lecr01__LCSummary__MobGuaranteesRow").removeClass("sno");
    apz.launchInDiv(params);
};
