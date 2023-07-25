//declaration
apz.promtn.AddPromotion = {};
apz.promtn.AddPromotion.sCache = {};
//on load functon
apz.app.onShown_AddPromotion = function(params) {
    debugger;
    $("#"+params.div).removeClass("sno");
    apz.promtn.AddPromotion.sCache = params;
    if (params.id !== "") {
        apz.promtn.AddPromotion.fnGetEditPromotion(params.id);
        $('.createBtn').addClass('sno');
        $('.headerName').html('Edit Promotion');
    } else {
        $('.updateBtn').addClass('sno');
        $('.headerName').html('Create Promotion');
        apz.promtn.AddPromotion.promotionBase64="";
        $('#promtn__EditPromotion__i__tbDbmiPromotions__img').attr('title','Promotion Image');
        var promotionId='P'+Math.floor(1000000 + Math.random() * 9000000);
        $('#promtn__EditPromotion__i__tbDbmiPromotions__promotionId').val(promotionId);
        $('#promtn__EditPromotion__i__tbDbmiPromotions__createdBy').val(params.userId);
    }
    $('#promtn__AddPromotion__el_fil_1').attr('accept','image/*');
}
//get edit promotion function
apz.promtn.AddPromotion.fnGetEditPromotion = function(id) {
    console.log(id)
    var lServerParams = {
        "ifaceName": "EditPromotion_Query",
        "buildReq": "N",
        "paintResp": "Y",
        "appId":"promtn",
        "req": {
            "tbDbmiPromotions": {
                    "id":id,                }
        },
        "async": false,
        "callBack": apz.promtn.AddPromotion.fnGetEditPromotionCB
    };
    apz.server.callServer(lServerParams);
}
//get edit promotion function callback
apz.promtn.AddPromotion.fnGetEditPromotionCB = function(sParams) {
 if(sParams.error===undefined){
    if(apz.data.scrdata.promtn__EditPromotion_Req.tbDbmiPromotions.status==="Active"){
        apz.setElmValue('promtn__AddPromotion__EditPromotion__i__tbDbmiPromotions__status','on');
    }
    else{
       apz.setElmValue('promtn__AddPromotion__EditPromotion__i__tbDbmiPromotions__status','off'); 
    }
    apz.promtn.AddPromotion.promotionBase64=apz.data.scrdata.promtn__EditPromotion_Req.tbDbmiPromotions.img;
  }
}
//create/update promotion
apz.promtn.AddPromotion.fnAddPromotion = function(interfaceName) {
    apz.data.buildData('EditPromotion', 'promtn');
    var promotionValues = apz.data.scrdata.promtn__EditPromotion_Req.tbDbmiPromotions;
    var status = apz.getElmValue('promtn__AddPromotion__EditPromotion__i__tbDbmiPromotions__status');
    if (status === "off") {
        promotionValues.status = "Inactive"
    } else {
        promotionValues.status = "Active"
    }
    if(interfaceName==="PromotionsList_New"){
        delete promotionValues.id;
    }
    promotionValues.type="Generic"
    promotionValues.userId="";
    promotionValues.img=apz.promtn.AddPromotion.promotionBase64;
    var lServerParams = {
        "ifaceName": interfaceName,
        "buildReq": "N",
        "paintResp": "Y",
"appId":"promtn",
        "async": false,
        "req": {
            "tbDbmiPromotions": promotionValues
        },
        "callBack": apz.promtn.AddPromotion.fnAddPromotionCB
    };
    apz.server.callServer(lServerParams);
}
//create promotion callback
apz.promtn.AddPromotion.fnAddPromotionCB = function(sParams) {
    if(sParams.error===undefined){
        if(sParams.ifaceName==="PromotionsList_New"){
            apz.promtn.AddPromotion.fnBacktoPromotion('Promotion added Successfully');
        }
        else{
            apz.promtn.AddPromotion.fnBacktoPromotion('Promotion updated Successfully');
        }
    }
}
//back to promotion list page
apz.promtn.AddPromotion.fnBacktoPromotion = function(msg) {
    var lParams = {
        "appId": "promtn",
        "scr": "PromotionsList",
        "div":apz.promtn.AddPromotion.sCache.div,
        "userObj": {
            "dispMsg":msg,
            "userId":apz.promtn.AddPromotion.sCache.userId,
            "div":apz.promtn.AddPromotion.sCache.div
        }
    };
    apz.launchSubScreen(lParams);
}
//get promotion image
apz.promtn.AddPromotion.fnUploadImage=function(element){
    var uploadFile=$(element)[0].files[0];
    apz.promtn.AddPromotion.getBase64(uploadFile);
}
//get base64 for uploadimage
apz.promtn.AddPromotion.getBase64=function(file) {
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
       $('#promtn__EditPromotion__i__tbDbmiPromotions__img').attr('src',reader.result);
       var base64String=reader.result.replace(/^data:image\/[a-z]+;base64,/, "");
       apz.promtn.AddPromotion.promotionBase64=base64String;
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
   };
}
