apz.CDNApp = {}; 
apz.CDNApp.DocumentsArr = []; 
apz.app.onLoad_LandingPage = function(){
        var lobj = {};
        lobj.DocumentType = "0";
        lobj.DocumentName = ""
        lobj.Document = "";
        
        
        apz.CDNApp.DocumentsArr.push(lobj);
        apz.data.scrdata.CDNApp__DocumentsList_Res = {}
        apz.data.scrdata.CDNApp__DocumentsList_Res.ListItem = apz.CDNApp.DocumentsArr;
        apz.data.loadData("DocumentsList", "CDNApp");
}
apz.app.onShown_LandingPage = function(){
    var today = new Date(); 
    var dd = today.getDate(); 
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    today = dd + '-' + apz.CDNApp.GetMonthName(mm) + '-' + yyyy; 
    apz.setElmValue("CDNApp__LandingPage__lineStDt",today);
    apz.setElmValue("CDNApp__LandingPage__liabilityNo","0");
    apz.setElmValue("CDNApp__LandingPage__mainLineCode","0");
    apz.setElmValue("CDNApp__LandingPage__amtBasis","0");
    apz.setElmValue("CDNApp__LandingPage__categ","0");
    //apz.setElmValue("CDNApp__LandingPage__el_dpd_1","0");
    //apz.setElmValue("CDNApp__LandingPage__el_dpd_5","0");
    apz.setElmValue("CDNApp__LandingPage__branch","0");
    
    $("#CDNApp__LandingPage__liabilityNo").attr('maxlength', 10);
    $("#CDNApp__LandingPage__liabilityName").attr('maxlength', 35);
    $("#CDNApp__LandingPage__lineId").attr('maxlength', 9);
    $("#CDNApp__LandingPage__limitDesc").attr('maxlength', 35);
    $("#CDNApp__LandingPage__mainLineCode").attr('maxlength', 9);
    $("#CDNApp__LandingPage__categ").attr('maxlength', 9);
    $("#CDNApp__LandingPage__limitAmt").addClass("only-numeric");
    apz.CDNApp.onlyNumeric();
    apz.CDNApp.validateMandatory();
}
apz.CDNApp.gotoNext = function(){
    debugger;
    var err="";
    if(apz.getElmValue("CDNApp__LandingPage__branch")==0){ err = "Select Branch\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__liabilityNo")==0){ err += "Select Liability No\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__limitDesc")==""){ err += "Enter Limit Descrption\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__mainLineCode")==0){ err += "Select Main Line Code\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__lineCurr")==0){ err += "Select Line Currency\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__lineId")==""){ err += "Enter Line Id\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__limitAmt")==""){ err += "Enter Limit Amt\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__amtBasis")==0){ err += "Select Amount Basis\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__categ")==0){ err += "Select Category\n"; }
    if(apz.getElmValue("CDNApp__LandingPage__blockAmt")==0){ err += "Select Category\n"; }
    
    if(apz.getElmValue("CDNApp__LandingPage__blockAmt")==0){ err += "Select Category\n"; }
    
   // if(err!==""){
       // do nothing
   // } else {
         $("#CDNApp__LandingPage__landingRow").addClass("sno");
         $("#CDNApp__LandingPage__savebtnrow").addClass("sno");
         apz.launchSubScreen({
            appId: "CDNApp",
            scr: "PreviewPage",
            layout:"All",
            div:"CDNApp__LandingPage__launchdiv",
            userObj: {
                branch: apz.getElmValue("CDNApp__LandingPage__branch"),
                liabilityNo: apz.getElmValue("CDNApp__LandingPage__liabilityNo"),
                liabilityName: apz.getElmValue("CDNApp__LandingPage__liabilityName"),
                limitDesc: apz.getElmValue("CDNApp__LandingPage__limitDesc"),
                limitAmt: apz.getElmValue("CDNApp__LandingPage__limitAmt"),
                mainLineCode: apz.getElmValue("CDNApp__LandingPage__mainLineCode"),
                lineCurr: apz.getElmValue("CDNApp__LandingPage__lineCurr"),
                lineId: apz.getElmValue("CDNApp__LandingPage__lineId"),
                amtBasis: apz.getElmValue("CDNApp__LandingPage__amtBasis"),
                serialNo: apz.getElmValue("CDNApp__LandingPage__serialNo"),
                categ: apz.getElmValue("CDNApp__LandingPage__categ"),
                resolving: apz.getElmValue("CDNApp__LandingPage__radRevolve"),
                available: apz.getElmValue("CDNApp__LandingPage__radAvaiable"),
                netting: apz.getElmValue("CDNApp__LandingPage__radNetting"),
                funded: apz.getElmValue("CDNApp__LandingPage__radFund"),
                el_tgl_4: apz.getElmValue("CDNApp__LandingPage__radAdvised"),
                el_tgl_5: apz.getElmValue("CDNApp__LandingPage__radLocal"),
                blockAmt: apz.getElmValue("CDNApp__LandingPage__blockAmt"),
                effLineAmt: apz.getElmValue("CDNApp__LandingPage__effLineAmt"),
                lineStDt: apz.getElmValue("CDNApp__LandingPage__lineStDt"),
                lineExpDt: apz.getElmValue("CDNApp__LandingPage__lineExpDt"),
                documents:apz.CDNApp.DocumentsArr
                
            }
        });
   // }
   
   //documents:apz.data.scrdata.CDNApp__DocumentsList_Res.ListItem
   
   //docType1: apz.getElmValue("CDNApp__LandingPage__el_dpd_1"),
                //docType2: apz.getElmValue("CDNApp__LandingPage__el_dpd_5"),
       
}
apz.CDNApp.GetMonthName = function(monthNumber) {
      var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
      return months[monthNumber - 1];
}
apz.CDNApp.validateOnlyNo = function(onlyNo) {
    console.log(onlyNo.value)
}
apz.CDNApp.populateLiabilityName = function() { 
    var liabilityNo = apz.getElmValue("CDNApp__LandingPage__liabilityNo");
    var liabilityName;
    if(liabilityNo==1){
        liabilityName = "ABC Corporation Inc";
    } else if(liabilityNo==2){
        liabilityName = "Micromax Corporation";
    } else if(liabilityNo==3){
        liabilityName = "Helene Curtis Industries, Inc.";
    } else if(liabilityNo==4){
        liabilityName = "Samsung India";
    }
    apz.setElmValue("CDNApp__LandingPage__liabilityName",liabilityName);
}

apz.CDNApp.onlyNumeric = function() {
    $(".only-numeric").bind("keypress", function (e) {
          var keyCode = e.which ? e.which : e.keyCode
               
          if (!(keyCode >= 48 && keyCode <= 57)) {
            $(".error").css("display", "inline");
            return false;
          }else{
            $(".error").css("display", "none");
          }
      })
}

apz.CDNApp.toMillin = function(obj) {
    var v= obj.value;
    v=v.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    if(v=="" || v==0){
        apz.setElmValue(obj.id,v);
    } else {
        apz.setElmValue(obj.id,v+".00");
    }
    
}

apz.CDNApp.updateAmountBasis = function() {
    var p = apz.getElmValue("CDNApp__LandingPage__limitAmt");
    var val = p*0.8;
    val = val.toFixed();
    val=val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    apz.setElmValue("CDNApp__LandingPage__effLineAmt",val+".00");
    
};
apz.CDNApp.validateMandatory = function(){
    $('#CDNApp__LandingPage__branch_ul').removeClass("borderRed");
    $("#CDNApp__LandingPage__liabilityNo_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__liabilityName_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__limitDesc_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__mainLineCode_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__lineCurr_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__lineId_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__limitAmt_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__amtBasis_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__categ_ul").removeClass("borderRed");
    $("#CDNApp__LandingPage__blockAmt_ul").removeClass("borderRed");
    
    if(apz.getElmValue("CDNApp__LandingPage__branch")==0){
        $('#CDNApp__LandingPage__branch_ul').addClass("borderRed")
    }
    if(apz.getElmValue("CDNApp__LandingPage__liabilityNo")==0){ 
        $("#CDNApp__LandingPage__liabilityNo_ul").addClass("borderRed")
        $("#CDNApp__LandingPage__liabilityName_ul").addClass("borderRed")
    }
    if(apz.getElmValue("CDNApp__LandingPage__limitDesc")==""){ $("#CDNApp__LandingPage__limitDesc_ul").addClass("borderRed"); }
    if(apz.getElmValue("CDNApp__LandingPage__mainLineCode")==0){ 
        $("#CDNApp__LandingPage__mainLineCode_ul").addClass("borderRed");
    }
    if(apz.getElmValue("CDNApp__LandingPage__lineCurr")==0){ 
        $("#CDNApp__LandingPage__lineCurr_ul").addClass("borderRed")
    }
    if(apz.getElmValue("CDNApp__LandingPage__lineId")==""){ $("#CDNApp__LandingPage__lineId_ul").addClass("borderRed"); }
    if(apz.getElmValue("CDNApp__LandingPage__limitAmt")==""){ $("#CDNApp__LandingPage__limitAmt_ul").addClass("borderRed"); }
    if(apz.getElmValue("CDNApp__LandingPage__amtBasis")==0){ 
        $("#CDNApp__LandingPage__amtBasis_ul").addClass("borderRed")
    }
    if(apz.getElmValue("CDNApp__LandingPage__categ")==0){ 
        $("#CDNApp__LandingPage__categ_ul").addClass("borderRed")
    }
    if(apz.getElmValue("CDNApp__LandingPage__blockAmt")==""){ $("#CDNApp__LandingPage__blockAmt_ul").addClass("borderRed"); }
}

apz.CDNApp.fnSelectRevoiving = function(pthis, pval) {
    debugger;
    $("#CDNApp__LandingPage__revrow :button").removeClass("current");
    $("#" + pthis.id).addClass("current");
    apz.CDNApp.pRevolving = pval;
}

apz.CDNApp.fnSelectAvailable = function(pthis, pval) {
    debugger;
    $("#CDNApp__LandingPage__avlrow :button").removeClass("current");
    $("#" + pthis.id).addClass("current");
    apz.CDNApp.pAvailable = pval;
}

apz.CDNApp.fnSelectNetting = function(pthis, pval) {
    debugger;
    $("#CDNApp__LandingPage__netrow :button").removeClass("current");
    $("#" + pthis.id).addClass("current");
    apz.CDNApp.pNetting = pval;
}

apz.CDNApp.fnSelectFunded = function(pthis, pval) {
    debugger;
    $("#CDNApp__LandingPage__fundrow :button").removeClass("current");
    $("#" + pthis.id).addClass("current");
    apz.CDNApp.pFunded = pval;
}

apz.CDNApp.fnSelectUnadviced = function(pthis, pval) {
    debugger;
    $("#CDNApp__LandingPage__unadvrow :button").removeClass("current");
    $("#" + pthis.id).addClass("current");
    apz.CDNApp.pUnadviced = pval;
}

apz.CDNApp.fnSelectLocal= function(pthis, pval) {
    debugger;
    $("#CDNApp__LandingPage__localrow :button").removeClass("current");
    $("#" + pthis.id).addClass("current");
    apz.CDNApp.pLocal = pval;
}


apz.CDNApp.fnUpload = function(pthis,doctext){
    debugger;
    apz.CDNApp.prow = $(pthis).attr("rowno");
    $("#CDNApp__LandingPage__fileupload").trigger("click");
    
}

apz.CDNApp.fnBrowsefileUpload = function(pthis) {
    debugger;
    let fileObj = pthis.files[0];
    var fileName = fileObj.name;
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        let base64Str = btoa(binaryStr);
        // var encodedImage = binaryStr.split(",").pop();
        apz.CDNApp.DocumentsArr[apz.CDNApp.prow].DocumentType = apz.getElmValue("CDNApp__DocumentsList__o__ListItem__DocumentType_" + apz.CDNApp.prow);
        apz.CDNApp.DocumentsArr[apz.CDNApp.prow].DocumentName = fileName;
        apz.CDNApp.DocumentsArr[apz.CDNApp.prow].Document = base64Str;
      
       $("#CDNApp__LandingPage__delicon_" + apz.CDNApp.prow).parent().removeClass("sno");
        $("#CDNApp__LandingPage__uplicon_" + apz.CDNApp.prow).parent().addClass("sno");
      
      var lobj = {};
        lobj.DocumentType = "0";
        lobj.DocumentName = ""
        lobj.Document = "";
        
        
        apz.CDNApp.DocumentsArr.push(lobj);
        apz.data.scrdata.CDNApp__DocumentsList_Res = {}
        apz.data.scrdata.CDNApp__DocumentsList_Res.ListItem = apz.CDNApp.DocumentsArr;
        apz.data.loadData("DocumentsList", "CDNApp");
        
       setTimeout(function() {
           debugger;
            var lastrow = apz.CDNApp.DocumentsArr.length - 1;
        $("#CDNApp__LandingPage__uplicon_" + lastrow).parent().removeClass("sno");
        $("#CDNApp__LandingPage__delicon_" + lastrow).parent().addClass("sno");
       },100)
        
        $("#" + pthis.id).val("");
    }
    apzFileReader.readAsBinaryString(fileObj);
}


apz.CDNApp.fnDeleteDocument = function(pthis){
    debugger;
    var lrow = $(pthis).attr("rowno");
    // apz.CDNApp.DocumentsArr[apz.CDNApp.prow].DocumentName = "";
    // $("#CDNApp__LandingPage__delicon_" + lrow).addClass("sno");
    //     $("#CDNApp__LandingPage__uplicon_" + lrow).removeClass("sno");
    
    apz.CDNApp.DocumentsArr.splice(lrow, 1);
    apz.data.scrdata.CDNApp__DocumentsList_Res = {}
        apz.data.scrdata.CDNApp__DocumentsList_Res.ListItem = apz.CDNApp.DocumentsArr;
        apz.data.loadData("DocumentsList", "CDNApp");
        setTimeout(function() {
           debugger;
            var lastrow = apz.CDNApp.DocumentsArr.length - 1;
        $("#CDNApp__LandingPage__uplicon_" + lastrow).parent().removeClass("sno");
        $("#CDNApp__LandingPage__delicon_" + lastrow).parent().addClass("sno");
       },100)
        
}


apz.CDNApp.fnSelectDocType = function(pthis){
    debugger;
    var lrow = $(pthis).attr("rowno");
    apz.CDNApp.DocumentsArr[lrow].DocumentType = apz.getElmValue("CDNApp__DocumentsList__o__ListItem__DocumentType_" + lrow);
    
}

apz.CDNApp.fnCancel = function(){
    debugger;
    
    apz.ACNR01.Navigator.launchApp("ACDB01", "Dashboard", "All", "Dashboard");
    
}
