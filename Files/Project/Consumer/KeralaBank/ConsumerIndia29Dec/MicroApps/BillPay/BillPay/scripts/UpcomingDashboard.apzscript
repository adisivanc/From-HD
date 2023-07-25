apz.bllpay.UpcomingDashboard = {};
apz.app.onLoad_UpcomingDashboard = function() {
    apz.data.loadJsonData("BillPaymentSummary", "bllpay");
    CorouselBill = CorouselD.initialise();

    
    CorouselBill.init("bllpay__UpcomingDashboard__");
    CorouselBill.setData(JSON.parse(JSON.stringify(apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary)));
    
    setTimeout(function() {
        $("#bllpay__UpcomingDashboard__ct_lst_1 > ul >li").addClass("sno");
        $("#bllpay__UpcomingDashboard__ct_lst_1 > ul >li").eq(0).removeClass("sno");
    }, 300);
}
apz.bllpay.UpcomingDashboard.fnForward = function() {
    debugger;
    index = CorouselBill.forward();
    $("#bllpay__UpcomingDashboard__ct_lst_1 > ul >li").addClass("sno");
    $("#bllpay__UpcomingDashboard__ct_lst_1 > ul >li").eq(index).removeClass("sno");
};
apz.bllpay.UpcomingDashboard.fnPrevious = function() {
    debugger;
    index = CorouselBill.previous();
    $("#bllpay__UpcomingDashboard__ct_lst_1 > ul >li").addClass("sno");
    $("#bllpay__UpcomingDashboard__ct_lst_1 > ul >li").eq(index).removeClass("sno");
};
apz.bllpay.UpcomingDashboard.fnPay = function() {
    debugger;
                    $("body").removeClass("landingtheme2");

    index = CorouselBill.getIndex();
    var paymentArr = [];
    paymentArr.push(apz.data.scrdata.bllpay__BillPaymentSummary_Res.summary[index]);
    $("#landin__Landing__heading").text("BILL PAYMENT");
    apz.launchApp({
        appId: "bllpay",
        div: "landin__Landing__launcher",
        scr: "Launcher",
        userObj: {
            data: {
                "actionscr": "BP"
            },
            summary: paymentArr,
            from: "UpcomingPayments",
            "control": {
                "exitApp": {
                    "appId": "landin",
                    "div": "landin__Landing__launcher",
                    "callBack": apz.landin.Landing.fnHome
                }
            }
        }
    });
    $("body").removeClass("loginby");
}
