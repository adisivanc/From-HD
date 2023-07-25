apz.CDNApp.Preview = {}; 
apz.app.onLoad_PreviewPage = function(param){
    
    apz.setElmValue("CDNApp__PreviewPage__branch",param.branch);
    apz.setElmValue("CDNApp__PreviewPage__liabilityNo",param.liabilityNo);
    apz.setElmValue("CDNApp__PreviewPage__liabilityName",param.liabilityName);
    apz.setElmValue("CDNApp__PreviewPage__limitDesc",param.limitDesc);
    apz.setElmValue("CDNApp__PreviewPage__limitAmt",param.limitAmt);
    apz.setElmValue("CDNApp__PreviewPage__mainLineCode",param.mainLineCode);
    apz.setElmValue("CDNApp__PreviewPage__lineCurr",param.lineCurr);
    apz.setElmValue("CDNApp__PreviewPage__lineId",param.lineId);
    apz.setElmValue("CDNApp__PreviewPage__amtBasis",param.amtBasis);
    apz.setElmValue("CDNApp__PreviewPage__serialNo",param.serialNo);
    apz.setElmValue("CDNApp__PreviewPage__categ",param.categ);
    apz.setElmValue("CDNApp__PreviewPage__resolving",param.resolving);
    apz.setElmValue("CDNApp__PreviewPage__available",param.available);
    apz.setElmValue("CDNApp__PreviewPage__netting",param.netting);
    apz.setElmValue("CDNApp__PreviewPage__funded",param.funded);
    apz.setElmValue("CDNApp__PreviewPage__el_tgl_4",param.el_tgl_4);
    apz.setElmValue("CDNApp__PreviewPage__el_tgl_5",param.el_tgl_5);
    apz.setElmValue("CDNApp__PreviewPage__blockAmt",param.blockAmt);
    apz.setElmValue("CDNApp__PreviewPage__effLineAmt",param.effLineAmt);
    apz.setElmValue("CDNApp__PreviewPage__lineStDt",param.lineStDt);
    apz.setElmValue("CDNApp__PreviewPage__lineExpDt",param.lineExpDt);
    //apz.setElmValue("CDNApp__PreviewPage__el_dpd_3",param.docType1);
    //apz.setElmValue("CDNApp__PreviewPage__el_dpd_4",param.docType2);
    
    var DocArr = param.documents;
    var lastrow = DocArr.length - 1;
    if(DocArr[lastrow].DocumentType == "0"){
        DocArr.splice(lastrow, 1);
    }
    
    
    apz.data.scrdata.CDNApp__DocumentListPreview_Res = {}
        apz.data.scrdata.CDNApp__DocumentListPreview_Res.ListItem = DocArr;
        apz.data.loadData("DocumentListPreview", "CDNApp");
    
}
apz.CDNApp.Preview.gotoBack = function(){
    // apz.launchApp({
    //   appId: "CDNApp",
    //     scr: "LandingPage"
    // });
    $("#CDNApp__LandingPage__landingRow").removeClass("sno");
    $("#CDNApp__LandingPage__savebtnrow").removeClass("sno");
    $("#CDNApp__LandingPage__launchdiv").html("");
}
apz.CDNApp.Preview.clickConfirm = function(){
    apz.toggleModal({
        targetId: "CDNApp__PreviewPage__confirmToggle"
    });
    $("#CDNApp__PreviewPage__confirmToggle_window .modal-header").hide();
}
apz.CDNApp.Preview.closePopup = function(){
    apz.toggleModal({
        targetId: "CDNApp__PreviewPage__confirmToggle"
    });
    
    apz.launchApp({
            appId: "CDNApp",
            scr: "LandingPage",
            layout:"All",
            div : "ACNR01__Navigator__launchPad"
            
        });
}
