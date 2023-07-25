apz.carddt.cardTransaction = {};
apz.carddt.cardTransaction.sCache = {};
apz.carddt.cardTransaction.sTransactions = [];
apz.carddt.cardTransaction.sActiveCardIndex = 0;
apz.carddt.cardTransaction.sFirstLoad = true;
apz.app.onLoad_CardTransaction = function(params) {
    apz.initCarousels();
    apz.carddt.cardTransaction.sCache = params;
    apz.carddt.cardTransaction.sFirstLoad = true;
    apz.carddt.cardTransaction.fnInitialize();
}
apz.app.onShown_CardTransaction = function(params) {}
apz.carddt.cardTransaction.fnInitialize = function() {
    debugger;
    var lSelectedIndex = 0,
        lIndex = 0;
    $("#csmrbk__LandingPage__backCol p ").text("Account Details");
    $("#carddt__CardTransaction__fromDate").attr("onblur", "");
    $("#carddt__CardTransaction__toDate").attr("onblur", "");
    $(".swiper-button-next,.swiper-button-prev").hide();
    $("#carddt__CardTransaction__cardNum_txtcnt").text(apz.carddt.cardTransaction.sCache.cardDetails.cardNbr);
    $("#carddt__CardTransaction__cardName_txtcnt").text(apz.carddt.cardTransaction.sCache.cardDetails.embossNameLine1);
    if (apz.carddt.cardTransaction.sFirstLoad) {
        $("#carddt__CardTransaction__pl_csl_1_ul > li").each(function() {
            lIndex = $(this).index();
            $(this).find(".cardNbr").text(apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex].cardNbr);
            $(this).find(".cardName").text(apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex].embossNameLine1);
            $(this).find(".cardType").text(apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex].cardTypeCd);
            var lDate= apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex].expirationDt;
            lDate = lDate.split("-");
            apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex].expirationDt = lDate[1]+"/"+lDate[2]+"/"+lDate[0];
            $(this).find(".cardDate").text(apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex].expirationDt);
            if (apz.data.scrdata.carddt__CardSummary_Res.cardInfo[lIndex].cardNbr == apz.carddt.cardTransaction.sCache.cardDetails.cardNbr) {
                lSelectedIndex = lIndex + 1;
                apz.carddt.cardTransaction.sCurrentCard = apz.carddt.cardTransaction.sCache.cardDetails.cardNbr;
            }
        });
        apz.carddt.cardTransaction.sActiveCardIndex = lSelectedIndex - 1;
    }
    setTimeout(function() {
        if (apz.carddt.cardTransaction.sFirstLoad) {
            debugger;
            $("#carddt__CardTransaction__ps_pls_3_pagination span:nth-child(" + lSelectedIndex + ")").trigger("click");
            apz.carddt.cardTransaction.sFirstLoad = false;
        }
    }, 300);
    var lServerParams = {
        "ifaceName": "GetCardAccTransac",
        "buildReq": "N",
        "req": {},
        "paintResp": "N",
        "async": "",
        "callBack": apz.carddt.cardTransaction.fnDbCallback,
        "callBackObj": "",
    };
    lServerParams.req = {
        "reqDetails": {
            "action": "getCardTransactions",
            "cardNumber": apz.carddt.cardTransaction.sCache.cardDetails.cardNbr,
            "token": apz.carddt.cardTransaction.sCache.tokenObj.cards
        }
    }
    apz.startLoader();
    apz.server.callServer(lServerParams);
}
apz.carddt.cardTransaction.fnDbCallback = function(params) {
    debugger;
    apz.stopLoader();
    var lCardTransaction = [];
    apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet = params.res.carddt__GetCardAccTransac_Res.getCardTransacDet.transactionInfo;
    for (i = 0; i < apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet.length; i++) {
        var lCardNbr = apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet[i].cardNbr;
        if (lCardNbr == apz.carddt.cardTransaction.sCache.cardDetails.cardNbr) {
            lCardTransaction.push(apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet[i]);
        }
    }
    apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet = lCardTransaction;
    for (i = 0; i < apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet.length; i++) {
        var lTransDate = apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet[i].transactionDt;
        lTransDate = lTransDate.split("-");
        apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet[i].transactionDt = lTransDate[1] + "/" + lTransDate[2] + "/" + lTransDate[0];
    }
    apz.data.loadData("GetCardAccTransac", "carddt");
}
apz.carddt.cardTransaction.fnBack = function() {
    var lParams = {
        "scr": "CardAccDetails",
        "div": "csmrbk__LandingPage__microappLauncherCol",
        "type": "CF",
        "userObj": {
            "destroyDiv": "csmrbk__LandingPage__microappLauncherCol",
            "tokenObj": {
                "customer": apz.csmrbk.landingpage.sCustomerToken,
                "loans": apz.csmrbk.landingpage.sLoanToken,
                "cards": apz.csmrbk.landingpage.sCardToken
            },
            "accountDetails": {
                "cardAccNum": apz.carddt.cardTransaction.sCache.accNumber
            },
            "custInfo": apz.custdb.dashboard.sCustInfo
        }
    };
    apz.launchSubScreen(lParams);
}
apz.carddt.cardTransaction.fnFilterTransac = function() {
    debugger;
    var lFilteredArr = [];
    var lFromDate = $("#carddt__CardTransaction__fromDate").val();
    var lToDate = $("#carddt__CardTransaction__toDate").val();
    var params = {
        "fromFormat": "dd-MMM-yyyy",
        "toFormat": "MM/dd/yyyy"
    }
    if (lFromDate != "") {
        params.val = lFromDate;
        lFromDate = apz.formatDate(params);
        $("#carddt__CardTransaction__fromDate").val(lFromDate);
    }
    if (lToDate != "") {
        params.val = lToDate;
        lToDate = apz.formatDate(params);
        $("#carddt__CardTransaction__toDate").val(lToDate);
    }
    if (lFromDate != "" && lToDate != "") {
        apz.carddt.cardTransaction.sTransactions = $.extend(true, [], apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet);
        lFromDate = new Date(lFromDate).getTime();
        lToDate = new Date(lToDate).getTime();
        if (lFromDate < lToDate) {
            for (i = 0; i < apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet.length; i++) {
                var lTransDate = new Date(apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet[i].transactionDt).getTime();
                if (lTransDate >= lFromDate && lTransDate <= lToDate) {
                    lFilteredArr.push(apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet[i]);
                }
            }
            apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet = lFilteredArr;
            apz.data.loadData("GetCardAccTransac", "carddt");
            apz.data.scrdata.carddt__GetCardAccTransac_Res.getCardTransacDet = apz.carddt.cardTransaction.sTransactions;
            if (lFilteredArr.length == 0) {
                var params = {
                    "code": "CARD-002",
                };
                apz.dispMsg(params);
            }
        } else {
            var params = {
                "code": "CARD-001",
            };
            apz.dispMsg(params);
        }
    }
}
apz.carddt.cardTransaction.fnChangeData = function() {
    debugger;
    $("#carddt__CardTransaction__fromDate").val("");
    $("#carddt__CardTransaction__toDate").val("");
    if ($(".swiper-slide-active").find(".cardNbr").text() != apz.carddt.cardTransaction.sCache.cardDetails.cardNbr) {
        apz.carddt.cardTransaction.sActiveCardIndex = $(".swiper-slide-active").index();
        apz.carddt.cardTransaction.sCache.cardDetails.cardNbr = $(".swiper-slide-active").find(".cardNbr").text();
        apz.carddt.cardTransaction.sCache.cardDetails.embossNameLine1 = $(".swiper-slide-active").find(".cardName").text();
        apz.carddt.cardTransaction.fnInitialize();
    }
}
apz.initCarousels = function() {
    debugger;
    $('.swiper-container').each(function() {
        var loop = $(this).attr('data-loop') == "y" ? true : false;
        var swiper = new Swiper('#' + this.id, {
            pagination: '.swiper-pagination',
            nextButton: '.swiper-button-next',
            prevButton: '.swiper-button-prev',
            slidesPerView: 1,
            paginationClickable: true,
            spaceBetween: 30,
            loop: loop,
            autoplay: false,
            autoHeight: false,
            observer: true,
            observeParents: true
        });
        swiper.on('slideChangeEnd', function() {
            apz.carddt.cardTransaction.fnChangeData();
        });
    });
}
apz.carddt.cardTransaction.fnSendMail = function() {
    debugger;
    var email = {
        "mailId": "mail001",
        "recipientMailId": "anshuman.nayyar@i-exceed.com",
        "senderMailId": "vinodha.samiraja@gmail.com",
        "ccIdList": "",
        "internal": "Y",
        "subject": "Appzillon Bank account statement for card number "+apz.carddt.cardTransaction.sCache.cardDetails.cardNbr,
        "body": "Hi "+apz.carddt.cardTransaction.sCache.cardDetails.embossNameLine1+",\n"+"Please find your statement for card number "+apz.carddt.cardTransaction.sCache.cardDetails.cardNbr
    };
    email.id = "MAIL_ID";
    email.callBack = apz.carddt.cardTransaction.mailCallback;
    apz.ns.sendMail(email);
}
apz.carddt.cardTransaction.mailCallback = function(successMsg) {
    var params = {
                "code": "CARD-003",
            };
            apz.dispMsg(params);
}
