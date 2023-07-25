apz.card01.categoryDetails = {};
apz.card01.categoryDetails.sAction = "";
apz.app.onLoad_CategoryDetails = function(userObj) {
    debugger;
    apz.card01.categoryDetails.sCategory = userObj.data.category;
    apz.card01.categoryDetails.sCorporateID = userObj.data.corpID;
    var params = {
        "action": "Category Details"
    };
    apz.card01.categoryDetails.fnRender(params);
};
apz.app.onShown_CategoryDetails = function(userObj) {
    debugger;
    apz.card01.cards.fnAdjustHeight();
};
apz.card01.categoryDetails.fnRender = function(params) {
    apz.card01.categoryDetails.fnRenderData(params);
    apz.card01.categoryDetails.fnRenderActionButtons(params);
};
apz.card01.categoryDetails.fnRenderActionButtons = function(params) {
    debugger;
    if (params.action == "Category Details") {
        $("#card01__CategoryDetails__AccountSummaryList").css("cursor", "pointer");
        $("#card01__Cards__BreadcrumbBtn2,#card01__Cards__BreadcrumbBtn3").parent().addClass("sno");
        $(".active").removeClass("active");
        $("#card01__Cards__BreadcrumbBtn1").parent().addClass("active");
        $("#card01__Cards__BreadcrumbBtn1").text(apz.card01.categoryDetails.sCategory);
    }
};
apz.card01.categoryDetails.fnRenderData = function(params) {
    if (params.action == "Category Details") {
        apz.card01.categoryDetails.sAction = "Category Details";
        var req = {
            "accountDetails": {
                "categoryID": apz.card01.categoryDetails.sCategory,
                "corpID": apz.card01.categoryDetails.sCorporateID
            },
            "categoryDetails": {
                "categoryID": apz.card01.categoryDetails.sCategory,
                "corpID": apz.card01.categoryDetails.sCorporateID
            }
        };
        req.action = "Query";
        req.table = "tb_dbmi_card_account_details";
        var lParams = {
            "ifaceName": "FetchCategoryDetails",
            "paintResp": "N",
            "appId": "card01",
            "buildReq": "N",
            "lReq": req
        };
        apz.card01.categoryDetails.fnBeforCallServer(lParams);
    }
};
apz.card01.categoryDetails.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.card01.categoryDetails.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.card01.categoryDetails.callServerCB = function(params) {
    if (apz.card01.categoryDetails.sAction == "Category Details") {
        apz.card01.categoryDetails.fnFetchCategoryDetailsCB(params);
    }
};
apz.card01.categoryDetails.fnFetchCategoryDetailsCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.card01__FetchCategoryDetails_Res.AccountStatus) {
            apz.card01.categoryDetails.fnRenderCategoryDetailsChart(params);
            if (params.res.card01__FetchCategoryDetails_Res.accountDetails.length > 3) {
                $("#card01__CategoryDetails__AccountSummaryList_pagination_ul").removeClass("sno");
            } else {
                $("#card01__CategoryDetails__AccountSummaryList_pagination_ul").addClass("sno");
            }
            apz.data.scrdata.card01__FetchCategoryDetails_Res = {};
            apz.data.scrdata.card01__FetchCategoryDetails_Res.accountDetails = [];
            apz.data.scrdata.card01__FetchCategoryDetails_Res.accountDetails = params.res.card01__FetchCategoryDetails_Res.accountDetails;
            apz.data.scrdata.card01__FetchCategoryDetails_Res.categoryDetails = params.res.card01__FetchCategoryDetails_Res.categoryDetails;
            for (var i = 0; i < params.res.card01__FetchCategoryDetails_Res.accountDetails.length; i++) {
                var strlen = params.res.card01__FetchCategoryDetails_Res.accountDetails[i].cardAccountNo;
                strlen = strlen.substr(0, strlen.length - 4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length - 4, strlen.length).replace(
                    /[0-9]/g, '9');
                var laccNo = params.res.card01__FetchCategoryDetails_Res.accountDetails[i].cardAccountNo;
                var result = apz.getMaskedValue(strlen, laccNo);
                apz.data.scrdata.card01__FetchCategoryDetails_Res.accountDetails[i].maskAccNo = result;
            }
            apz.data.loadData("FetchCategoryDetails", "card01");
            
            if (apz.deviceGroup == "Mobile") {
                CorouselBill = CorouselD.initialise();
                CorouselBill.init("card01__CategoryDetails__");
                CorouselBill.setData(JSON.parse(JSON.stringify(apz.data.scrdata.card01__FetchCategoryDetails_Res.accountDetails)));
                setTimeout(function() {
                    $("#card01__CategoryDetails__AccountSummaryList > ul >li").addClass("sno");
                    $("#card01__CategoryDetails__AccountSummaryList > ul >li").eq(0).removeClass("sno");
                }, 300);
            }
            
        } else {
            var msg = {};
            msg.message = "No Records found";
            apz.dispMsg(msg);
            $("#card01__CategoryDetails__AccountSummaryList_pagination_ul").addClass("sno");
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
        $("#card01__CategoryDetails__AccountSummaryList_pagination_ul").addClass("sno");
    }
};

apz.card01.categoryDetails.fnForward = function() {
    debugger;
    index = CorouselBill.forward();
    $("#card01__CategoryDetails__AccountSummaryList > ul >li").addClass("sno");
    $("#card01__CategoryDetails__AccountSummaryList > ul >li").eq(index).removeClass("sno");
};
apz.card01.categoryDetails.fnPrevious = function() {
    debugger;
    index = CorouselBill.previous();
    $("#card01__CategoryDetails__AccountSummaryList > ul >li").addClass("sno");
    $("#card01__CategoryDetails__AccountSummaryList > ul >li").eq(index).removeClass("sno");
};

apz.card01.categoryDetails.fnRenderCategoryDetailsChart = function(params) {
    apz.data.scrdata.card01__CategoryDetailsChart_Res = {};
    apz.data.scrdata.card01__CategoryDetailsChart_Res.accountDetails = [];
    apz.data.scrdata.card01__CategoryDetailsChart_Res.accountDetails = params.res.card01__FetchCategoryDetails_Res.accountDetails;
    apz.data.loadData("CategoryDetailsChart", "card01");
};
apz.card01.categoryDetails.fnOnSelectAccount = function(pObj, event) {
    debugger;
    apz.card01.cards.sAction = "Account Details";
    var lRow = parseInt(pObj.id.split("_")[6]);
    var lAccount = $("#card01__FetchCategoryDetails__o__accountDetails__cardAccountNo_" + lRow).text();
    var params = {};
    params.appId = "card01";
    params.scr = "CardAccountDetails";
    params.userObj = {
        "data": {
            "accountNo": lAccount,
            "category": apz.card01.categoryDetails.sCategory,
            "corporateID": apz.card01.categoryDetails.sCorporateID
        }
    };
    params.div = "card01__Cards__CardLauncher";
    
    if (apz.deviceGroup == "Mobile") {
         params.layout = "Mobile";
    }
    else {
         params.layout = "All";
    }
    apz.launchSubScreen(params);
};
apz.card01.categoryDetails.blockAllCards = function() {
    apz.dispMsg({
        message: "Do you want to block all the cards under the selected account?",
        type: "C",
        callBack: apz.card01.categoryDetails.blockAllCardsCB
    });
};
apz.card01.categoryDetails.blockAllCardsCB = function(pStatus) {
    if (pStatus) {
        if(pStatus.choice)
    {
        apz.dispMsg({
            message: "We have blocked all the listed cards under the current account. To unblock/receive a new card please contact the bank.",
            type: "S"
        });
    }
    }
};
