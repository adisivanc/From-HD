//declaration
apz.promtn.PromotionsList = {};
apz.promtn.PromotionsList.sCache = {};
//onload function
apz.app.onLoad_PromotionsList = function(params) {
    debugger;
    $("#"+params.div).removeClass("sno");
    apz.stopLoader();
    apz.promtn.PromotionsList.fnGetPromtionList();
    apz.promtn.PromotionsList.sCache=params;
    if(params.dispMsg!==""){
        apz.dispMsg({'message':params.dispMsg,'type':'success'});
    }
}
//get all the promotions
apz.promtn.PromotionsList.fnGetPromtionList = function() {
    var lServerParams = {
        "ifaceName": "PromotionsList_Query",
        "buildReq": "Y",
        "paintResp": "Y",
        "async": false,
        "callBack": apz.promtn.PromotionsList.fnGetPromtionListCB
    };
    apz.server.callServer(lServerParams);
}
//get all the promotions callback
apz.promtn.PromotionsList.fnGetPromtionListCB = function(sParams) {
    var promotionList = apz.data.scrdata.promtn__PromotionsList_Req.tbDbmiPromotions;
    if (promotionList.length > 0) {
        for (var i = 0, len = promotionList.length; i < len; i++) {
            if (promotionList[i].status === 'Inactive') {
                $('#promtn__PromotionsList__i__tbDbmiPromotions__status_' + i).removeClass('suc').addClass('err')
            }
        }
    }
}
//add/Edit promotion
apz.promtn.PromotionsList.fnAddEditPromtion = function(element) {
    var id = "";
    if (element !== undefined) {
        var rowNo = $(element).attr('rowno');
        id = apz.data.scrdata.promtn__PromotionsList_Req.tbDbmiPromotions[rowNo].id;
    }
    var lParams = {
        "appId": "promtn",
        "scr": "AddPromotion",
        "div":apz.promtn.PromotionsList.sCache.div,
        "userObj": {
            "id": id,
            "div":apz.promtn.PromotionsList.sCache.div,
            "userId":apz.promtn.PromotionsList.sCache.userId
        }
    };
    apz.launchSubScreen(lParams);
}
//show promotion
apz.promtn.PromotionsList.fnShowPromtion = function(element) {
    var rowNo = $(element).attr('rowno');
    var header = apz.data.scrdata.promtn__PromotionsList_Req.tbDbmiPromotions[rowNo].header;
    $('#promtn__PromotionsList__pu_mdl_1_window>.modal-header').find('h1').html(header);
    var imageBase64 = 'data:image/png;base64,' + apz.data.scrdata.promtn__PromotionsList_Req.tbDbmiPromotions[rowNo].img;
    $('.promotionImage').attr('src', imageBase64);
    $('.promotionDescription').html(apz.data.scrdata.promtn__PromotionsList_Req.tbDbmiPromotions[rowNo].msg)
    apz.toggleModal({
        "targetId": "promtn__PromotionsList__pu_mdl_1"
    })
}
//view promotion details in seperate screen
apz.promtn.PromotionsList.fnViewPromotion = function() {
    var lParams = {
        "appId": "promtn",
        "scr": "ViewPromotion",
        "div":apz.promtn.PromotionsList.sCache.div,
        "userObj": {
            "div":apz.promtn.PromotionsList.sCache.div
        }
    };
    apz.launchSubScreen(lParams);
}
//delete promotion
apz.promtn.PromotionsList.fnDeletePromtion = function(element) {
    apz.startLoader();
    var rowNo = $(element).attr('rowno');
    var id = apz.data.scrdata.promtn__PromotionsList_Req.tbDbmiPromotions[rowNo].id;
    var lServerParams = {
        "ifaceName": "EditPromotion_Delete",
        "buildReq": "N",
        "paintResp": "Y",
        "appId": "promtn",
        "async": false,
        "req": {
            "tbDbmiPromotions": {
                "id": id
            }
        },
        "callBack": apz.promtn.PromotionsList.fnDeletePromtionCB
    };
    apz.server.callServer(lServerParams);
}
//callback function delete promotion 
apz.promtn.PromotionsList.fnDeletePromtionCB = function(sparams) {
    apz.promtn.PromotionsList.fnGetPromtionList();
    apz.stopLoader();
}
