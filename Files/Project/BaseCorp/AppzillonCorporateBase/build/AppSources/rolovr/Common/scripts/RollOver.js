//8934612363297
apz.rolovr.RollOver = {};
apz.rolovr.RollOver.RollOverCompArr = [];
apz.app.onLoad_RollOver = function(userObj) {
    debugger;
    var lobj = {};
    lobj.ComponentName = "PRINCIPAL";
    apz.rolovr.RollOver.RollOverCompArr.push(lobj);
    apz.data.scrdata.rolovr__RolloverComp_Res = {}
    apz.data.scrdata.rolovr__RolloverComp_Res.ListItem = apz.rolovr.RollOver.RollOverCompArr;
    apz.data.loadData("RolloverComp", "rolovr");
    
    var today = new Date();
    var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
    var dateTime = date + ' ' + time;
    apz.setElmValue("rolovr__RollOver__inpDate", dateTime);
    var lAcctno = userObj.AccountNo;
    apz.setElmValue("rolovr__RollOver__inpAcctNo",lAcctno);
    apz.setElmValue("rolovr__RollOver__inpCustId",userObj.CustomerId);
    apz.setElmValue("rolovr__RollOver__inpCustName",userObj.CustomerName);
    apz.setElmValue("rolovr__RollOver__inpProduct",userObj.Product);
    apz.setElmValue("rolovr__RollOver__el_dpd_2",userObj.Branch);
};

apz.rolovr.RollOver.fnChangeType = function(pthis){
    debugger;
    var lval = apz.getElmValue("rolovr__RollOver__radRollType");
    if(lval == "Custom"){
        $("#rolovr__RollOver__gr_col_6").removeClass("sno");
    }
    
    else{
        $("#rolovr__RollOver__gr_col_6").addClass("sno");
    }
}
apz.rolovr.RollOver.fnAddRollComp = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    if (!apz.isNull(apz.getElmValue("rolovr__RolloverComp__o__ListItem__ComponentName_" + lrow))) {
        apz.rolovr.RollOver.RollOverCompArr[lrow].ComponentName = apz.getElmValue("rolovr__RolloverComp__o__ListItem__ComponentName_" + lrow);
        $("#rolovr__RollOver__delicon_" + lrow).parent().removeClass("sno");
        $("#rolovr__RollOver__addicon_" + lrow).parent().addClass("sno");
        var lobj = {};
        lobj.ComponentName = "";
        apz.rolovr.RollOver.RollOverCompArr.push(lobj);
        apz.data.scrdata.rolovr__RolloverComp_Res = {}
        apz.data.scrdata.rolovr__RolloverComp_Res.ListItem = apz.rolovr.RollOver.RollOverCompArr;
        apz.data.loadData("RolloverComp", "rolovr");
        setTimeout(function() {
            debugger;
            var lastrow = apz.rolovr.RollOver.RollOverCompArr.length - 1;
            $("#rolovr__RollOver__addicon_" + lastrow).parent().removeClass("sno");
            $("#rolovr__RollOver__delicon_" + lastrow).parent().addClass("sno");
        }, 100)
    }
}
apz.rolovr.RollOver.fnDeleteRollComp = function(pthis) {
    debugger;
    
    var lrow = $(pthis).attr("rowno");
    apz.rolovr.RollOver.RollOverCompArr.splice(lrow, 1);
   apz.data.scrdata.rolovr__RolloverComp_Res = {}
        apz.data.scrdata.rolovr__RolloverComp_Res.ListItem = apz.rolovr.RollOver.RollOverCompArr;
        apz.data.loadData("RolloverComp", "rolovr");
    setTimeout(function() {
        debugger;
        var lastrow = apz.rolovr.RollOver.RollOverCompArr.length - 1;
        $("#rolovr__RollOver__addicon_" + lastrow).parent().removeClass("sno");
        $("#rolovr__RollOver__delicon_" + lastrow).parent().addClass("sno");
    }, 100)
}

// apz.rolovr.RollOver.fnClickCustId = function(){
//     debugger;
//     // var custId = apz.getElmValue(pthis.id);
//     // if(custId != "Please Select"){
//     //      apz.setElmValue("rolovr__RollOver__inpCustName", "ACME Corp");
//     // }
   
// }





apz.rolovr.RollOver.fnClickCustId = function() {
    debugger;
    
    var params = {
        "targetId": "rolovr__RollOver__CustModal"
    }
    apz.toggleModal(params);
    apz.data.loadJsonData("CustomerDetails","rolovr");
    
}
apz.rolovr.RollOver.fnSelectCustId = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var lcustId = apz.getElmValue("rolovr__CustomerDetails__o__LIstItem__CustomerID_"+lrow);
    var lcustName = apz.getElmValue("rolovr__CustomerDetails__o__LIstItem__CustomerName_"+lrow);
    
    apz.setElmValue("rolovr__RollOver__inpCustId",lcustId);
    apz.setElmValue("rolovr__RollOver__inpCustName",lcustName);
    
    var params = {
        "targetId": "rolovr__RollOver__CustModal"
    }
    apz.toggleModal(params);
    
}
apz.rolovr.RollOver.fnClickProduct = function() {
    debugger;
    var params = {
        "targetId": "rolovr__RollOver__ProdModal"
    }
    apz.toggleModal(params);
    apz.data.loadJsonData("ProductList","rolovr");
}
apz.rolovr.RollOver.fnSelectProduct = function(pthis) {
    debugger;
    
    var lrow = $(pthis).attr("rowno");
    var lproduct = apz.getElmValue("rolovr__ProductList__o__LIstItem__ProductName_"+lrow);
   
    apz.setElmValue("rolovr__RollOver__inpProduct",lproduct);
    
    var params = {
        "targetId": "rolovr__RollOver__ProdModal"
    }
    apz.toggleModal(params);
}






// apz.rolovr.RollOver.fnSelectProduct = function(){
//     debugger;
//     var lval = apz.getElmValue("rolovr__RollOver__ddlproduct");
//     if(lval == "Working Capital"){
//         apz.setElmValue("rolovr__RollOver__inpAcctNo","8934612363297");
//     }
//     else {
//         apz.setElmValue("rolovr__RollOver__inpAcctNo","--");
//     }
// }

apz.rolovr.RollOver.fnCancel = function(){
    debugger;
    //  var llaunch = {};
    // llaunch.appId = "ACDB01";
    // llaunch.scr = "Dashboard";
    // llaunch.div = "ACNR01__Navigator__launchPad";
    // llaunch.layout = "All";
    // apz.launchApp(llaunch);
    
    var llaunch = {};
    llaunch.appId = "lonact";
    llaunch.scr = "Summary";
    llaunch.div = "ACNR01__Navigator__launchPad";
    llaunch.layout = "All";
    apz.launchApp(llaunch);
    
}
apz.rolovr.RollOver.fnSubmit = function(){
    var params = {};
        params.message = "Request has been submitted successfully";
        params.type = "S";
        params.callBack = apz.rolovr.RollOver.fnCancel;
        apz.dispMsg(params);
}
