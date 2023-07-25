apz.card01 = {};
apz.card01.cards = {};
apz.card01.cards.sAction = "";
apz.app.onLoad_Cards = function(userObj) {
    apz.card01.cards.sCorporateID = apz.Login.sCorporateId;
    //  apz.card01.cards.sCorporateID = "000FTAC4321";
    var params = {
        "action": "Category"
    };
    apz.card01.cards.fnRender(params);
};
apz.card01.cards.fnRender = function(params) {
    apz.card01.cards.fnRenderData(params);
    apz.card01.cards.fnRenderActionButtons(params);
};
apz.card01.cards.fnRenderActionButtons = function(params) {
    if (params.action == "Category") {
        $("#card01__Cards__CategoryList").css("cursor", "pointer");
        $("#card01__Cards__BreadcrumbBtn2,#card01__Cards__BreadcrumbBtn3").parent().addClass("sno");
    }
};
apz.card01.cards.fnRenderData = function(params) {
    if (params.action == "Category") {
        apz.card01.cards.sAction = "Category Summary";
        var req = {};
        req.category = {
            "corporateID": apz.card01.cards.sCorporateID
        };
        req.action = "Query";
        req.table = "tb_dbmi_category_master";
        var lParams = {
            "ifaceName": "FetchCategory",
            "paintResp": "Y",
            "appId": "card01",
            "buildReq": "N",
            "lReq": req
        };
        apz.card01.cards.fnBeforCallServer(lParams);
    }
};
apz.card01.cards.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.card01.cards.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.card01.cards.callServerCB = function(params) {
    debugger;
    if (apz.card01.cards.sAction == "Category Summary") {
        apz.card01.cards.fnFetchCategoryCB(params);
    }
};
apz.card01.cards.fnFetchCategoryCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.card01__FetchCategory_Res.Status) {
            for (var i = 0; i < apz.data.scrdata.card01__FetchCategory_Res.category.length; i++) {
                var lCategory = apz.data.scrdata.card01__FetchCategory_Res.category[i].categoryDesc;
                switch (lCategory) {
                    case "Business Cards":
                        apz.setElmValue("card01__Cards__categoryImg_" + i, "apps/styles/themes/AppzillonCorporateBase/img/businesscard.png")
                        break;
                    case "Corporate Cards":
                        apz.setElmValue("card01__Cards__categoryImg_" + i, "apps/styles/themes/AppzillonCorporateBase/img/corpcard.png")
                        break;
                    case "Travel Cards":
                        apz.setElmValue("card01__Cards__categoryImg_" + i, "apps/styles/themes/AppzillonCorporateBase/img/travlcard.png")
                        break;
                    case "Virtual Cards":
                        apz.setElmValue("card01__Cards__categoryImg_" + i, "apps/styles/themes/AppzillonCorporateBase/img/virtualcard.png")
                        break;
                }
            }
            
            
             if (apz.deviceGroup != "Mobile") {
            var params = {};
            params.appId = "card01";
            params.scr = "CategoryDetails";
            params.userObj = {
                "data": {
                    "category": apz.getElmValue("card01__FetchCategory__o__category__categoryId_0"),
                    "corpID": apz.card01.cards.sCorporateID
                }
            };
            params.div = "card01__Cards__CardLauncher";
            params.layout = "All";
            apz.launchSubScreen(params);
             }
            
            
        } else {
            var msg = {};
            msg.message = "No records found";
            apz.dispMsg(msg);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.card01.cards.fnOnSelectCategory = function(pObj, event) {
    debugger;
     if (apz.deviceGroup == "Mobile") {
         $("#card01__Cards__cardlistrow").addClass("sno");
     }
    
    apz.card01.cards.sAction = "Category Details";
    var lRow = parseInt(pObj.id.split("_")[6]);
    var lCategory = $("#card01__FetchCategory__o__category__categoryId_" + lRow).text();
    var params = {};
    params.appId = "card01";
    params.scr = "CategoryDetails";
    params.userObj = {
        "data": {
            "category": lCategory,
            "corpID": apz.card01.cards.sCorporateID
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
apz.app.updateChartBeforeRender = function(gchartType, gchartData, gid, gchart) {
    debugger;
    if (gchart.id == "card01__CardAccountDetails__AccountDouhnutChart") {
        gchartData.chart.defaultCenterLabel = "Card Summary " + apz.data.scrdata.card01__FetchAccountDetails_Res.accountDetails.availableCreditLimit;
        gchartData.chart.centerLabelBold = "1";
    }else if (gchart.id == "card01__CategoryDetails__CategoryDetailsChart") {
        gchartData.chart.defaultCenterLabel = "Available Balance " + apz.data.scrdata.card01__FetchCategoryDetails_Res.categoryDetails.availableBalance;
        gchartData.chart.centerLabelBold = "1";
    }
};
apz.card01.cards.fnRenderCategory = function(lObj) {
    debugger;
    var params = {};
    params.appId = "card01";
    params.scr = "CategoryDetails";
    params.userObj = {
        "data": {
            "category": apz.card01.categoryDetails.sCategory,
            "corpID": apz.card01.cards.sCorporateID
        }
    };
    params.div = "card01__Cards__CardLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.card01.cards.fnRenderAccount = function(lObj) {
    debugger;
    var params = {};
    params.appId = "card01";
    params.scr = "CardAccountDetails";
    params.userObj = {
        "data": {
            "accountNo": apz.card01.accountDetails.sAccountNo,
            "category": apz.card01.categoryDetails.sCategory,
            "corporateID": apz.card01.categoryDetails.sCorporateID
        }
    };
    params.div = "card01__Cards__CardLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.card01.cards.fnRenderCard = function(lObj) {
    debugger;
    var params = {};
    params.appId = "card01";
    params.scr = "TransactionDetails";
    params.userObj = {
        "data": {
            "accountNo": apz.card01.transactionDetails.sAccountNo
        }
    };
    params.div = "card01__Cards__CardLauncher";
    params.layout = "All";
    apz.launchSubScreen(params);
};
apz.card01.cards.fnAdjustHeight = function() {
    if ($("#card01__Cards__CategoryList").height() > $("#card01__Cards__CardLauncher").height()) {
        $("#card01__Cards__cardCol1").height($("#card01__Cards__CategoryList").height());
    } else {
        if ($("#card01__Cards__CardLauncher").height() < window.innerHeight) {
            $("#card01__Cards__cardCol1").height(window.innerHeight);
        } else {
            $("#card01__Cards__cardCol1").height($("#card01__Cards__CardLauncher").height());
        }
    }
};
