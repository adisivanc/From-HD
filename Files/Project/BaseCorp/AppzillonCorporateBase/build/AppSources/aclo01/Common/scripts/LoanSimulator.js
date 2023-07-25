apz.aclo01.LoanSimulator = {};
apz.app.onLoad_LoanSimulator = function(params) {
    debugger;
    apz.aclo01.LoanSimulator.sParams=params;
    var lPrincipal = apz.getElmValue("aclo01__LoanSimulator__slider1");
    var lTenure = apz.getElmValue("aclo01__LoanSimulator__slider2");
    var lROI = apz.getElmValue("aclo01__LoanSimulator__slider3");
    
    apz.aclo01.LoanSimulator.AmountChange();
    apz.aclo01.LoanSimulator.TenureChange();
    apz.aclo01.LoanSimulator.InterestChange();
};
apz.app.onShown_LoanSimulator = function(params) 
{
    $("#aclo01__LoanSimulator__slider1").on("input",function(){apz.aclo01.LoanSimulator.AmountChange();});
    $("#aclo01__LoanSimulator__slider2").on("input",function(){apz.aclo01.LoanSimulator.TenureChange();});
    $("#aclo01__LoanSimulator__slider3").on("input",function(){apz.aclo01.LoanSimulator.InterestChange();});
};
apz.aclo01.LoanSimulator.AmountChange=function()
{
    var amt={
        "value":apz.getElmValue("aclo01__LoanSimulator__slider1"),
        "decimalSep": ".",
        "decimalPoints": "2",
        "displayAsLiteral": "N",
        "mask": "MILLION"
    }
   // apz.setElmValue("aclo01__LoanSimulator__amount",amt);
      $("#aclo01__LoanSimulator__amount").text(apz.formatNumber(amt));
    apz.aclo01.LoanSimulator.calculateEMI();
};
apz.aclo01.LoanSimulator.TenureChange=function()
{
    var tenure=apz.getElmValue("aclo01__LoanSimulator__slider2");
    apz.setElmValue("aclo01__LoanSimulator__Tenure",tenure);
    apz.aclo01.LoanSimulator.calculateEMI();
};

apz.aclo01.LoanSimulator.InterestChange=function()
{
    var interest=apz.getElmValue("aclo01__LoanSimulator__slider3");
    apz.setElmValue("aclo01__LoanSimulator__interest",interest);
    apz.aclo01.LoanSimulator.calculateEMI();
};

apz.aclo01.LoanSimulator.calculateEMI=function()
{
     debugger;
     var graphObj = [];
    var lPrincipal ={
        "value": apz.getElmValue("aclo01__LoanSimulator__slider1"),
        "decimalSep": ".",
        "decimalPoints": "2",
        "displayAsLiteral": "N",
        "mask": "MILLION"
    }
    var lTenure = apz.getElmValue("aclo01__LoanSimulator__slider2");
    var lROI = apz.getElmValue("aclo01__LoanSimulator__slider3");
    var lMonthlyTenure = lTenure * 12;
    var lMonthlyROI = lROI / (12 * 100);
     var lparams = {
        "value": apz.aclo01.LoanSimulator.valueEMI(apz.unFormatNumber(lPrincipal), lMonthlyROI, lMonthlyTenure).toString(),
        "decimalSep": ".",
        "decimalPoints": "2",
        "displayAsLiteral": "N",
        "mask": "MILLION"
    };
    $("#aclo01__LoanSimulator__emi").text(apz.formatNumber(lparams));
    lEmi=apz.unFormatNumber(lparams);
    
  // apz.setElmValue("ACLS01__LoanSimulator__emi",lEmi);
    var TotInterest=
    {
        "value":(lEmi * lMonthlyTenure) - apz.unFormatNumber(lPrincipal), 
        "decimalSep": ".",
        "decimalPoints": "2",
        "displayAsLiteral": "N",
        "mask": "MILLION"
    }
    $("#aclo01__LoanSimulator__Lamt").text(apz.formatNumber(lPrincipal));
    $("#aclo01__LoanSimulator__Totint").text(apz.formatNumber(TotInterest));
    var total=
    {
         "value":parseInt(apz.unFormatNumber(lPrincipal))+parseInt(apz.unFormatNumber(TotInterest)), 
        "decimalSep": ".",
        "decimalPoints": "2",
        "displayAsLiteral": "N",
        "mask": "MILLION"
    }
    $("#aclo01__LoanSimulator__total").text(apz.formatNumber(total));
    
     var lChartTotalInterest = {
        "type": "Total Interest ",
        "amount": apz.unFormatNumber(TotInterest)
    };
    graphObj.push(lChartTotalInterest);
    var lChartLoanAmount = {
        "amount": apz.unFormatNumber(lPrincipal),
        "type": "Loan Amount"
    };
     graphObj.push(lChartLoanAmount);
     
     var lChartTotalAmount = {
        "amount": apz.unFormatNumber(total),
        "type": "Total Amount"
    };
     graphObj.push(lChartTotalAmount);
     var lArmotScheduleJSON = [];
      apz.aclo01.LoanSimulator.calcAmortizationSchedule(apz.unFormatNumber(lparams), apz.unFormatNumber(lPrincipal), lMonthlyROI, lMonthlyTenure, 1, lArmotScheduleJSON);
    apz.data.scrdata.aclo01__AmountPayable_Req = {};
    apz.data.scrdata.aclo01__AmountPayable_Req.LoanAccount = graphObj;
    apz.data.scrdata.aclo01__AmountPayable_Req.Emi = lArmotScheduleJSON;
     apz.data.loadData("AmountPayable");
     setTimeout(function() {
        apz.aclo01.LoanSimulator.paintStackedChart();
    }, 2000);
     var lAmortResp = JSON.stringify(lArmotScheduleJSON);
};
apz.aclo01.LoanSimulator.valueEMI = function(pPrincipal, pMonthlyROI, pMonthlyTenure) {
     debugger;
    var lMonthyEMI = (pMonthlyROI * pPrincipal * Math.pow((1 + pMonthlyROI), pMonthlyTenure)) / (Math.pow((1 + pMonthlyROI), pMonthlyTenure) - 1);
    return Math.round((lMonthyEMI * 100) / 100);
};
apz.aclo01.LoanSimulator.calcAmortizationSchedule = function(pEmi, pPrincipal, pROI, pTenure, pCurrPeriod, pArmotScheduleJSON) {
    if (pCurrPeriod <= pTenure) {
        var lMonthInterest = Math.round((pPrincipal * pROI * 100) / 100);
        var lMonthPrincipal = Math.round(((pEmi - lMonthInterest) * 100) / 100);
        var lBalance = Math.round(((pPrincipal - lMonthPrincipal) * 100) / 100);
        var lCurrAmort = {};
        lCurrAmort.Interest = lMonthInterest;
        lCurrAmort.Principal = lMonthPrincipal;
        lCurrAmort.Balance = lBalance;
        lCurrAmort.Period = pCurrPeriod;
        pArmotScheduleJSON.push(lCurrAmort);
        pCurrPeriod = pCurrPeriod + 1;
        apz.aclo01.LoanSimulator.calcAmortizationSchedule(pEmi, lBalance, pROI, pTenure, pCurrPeriod, pArmotScheduleJSON);
    }
};
apz.aclo01.LoanSimulator.loanSummary=function()
{
    debugger;
   /* var iparam={
        "appId":"aclo01",
        "scr":"LoansSummary",
        "div":"aclo01__LoansSummary__LoansSummaryList",
        "layout":"All"
        
    };
    apz.launchSubScreen(iparam);*/
     apz.aclo01.LoanSimulator.sParams.callBack();
};
apz.aclo01.LoanSimulator.paintStackedChart = function() {
    debugger;
    var ldata = apz.data.scrdata.aclo01__AmountPayable_Req.Emi;
    var lcategory = [];
    var lPrincipal = [];
    var lInterest = [];
    var lBalance = [];
    var lPrincipalValue = 0,
        lInterestValue = 0,
        lBalanceValue = 0;
    var date = new Date();
    var year = date.getFullYear();
    for (var i = 0; i < ldata.length; i++) {
        lPrincipalValue += ldata[i].Principal;
        lInterestValue += ldata[i].Interest;
        lBalanceValue += ldata[i].Balance;
        if (Number.isInteger(ldata[i].Period / 12)) {
            var obj = {
                "label": year.toString()
            };
            lcategory.push(obj);
            var pobj = {
                "value": lPrincipalValue
            };
            lPrincipal.push(pobj);
            var iobj = {
                "value": lInterestValue
            };
            lInterest.push(iobj);
            var bobj = {
                "value": lBalanceValue
            };
            lBalance.push(bobj);
            lInterestValue = lBalanceValue = lPrincipalValue = 0;
            year++;
        }
    }
    debugger;
    var revenueChart = new FusionCharts({
        type: 'msstackedcolumn2dlinedy',
        renderAt: 'aclo01__LoanSimulator__stackedChart',
        width: '100%',
        height: '350',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "",
                "subcaption": "",
                "xAxisName": "Period",
                "pYAxisName": "EMI Payment",
                "sYAxisName": "Balance Amount",
                "numberPrefix": "",
                "numbersuffix": "",
                "sNumberSuffix": "",
                "sYAxisMaxValue": "",
                //Cosmetics
                "paletteColors": "#C8F5FF,#70CDE2,#FF0000",
                "baseFontColor": "#333333",
                "baseFont": "Helvetica Neue,Arial",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0",
                "showBorder": "0",
                "showValues": "0",
                "bgColor": "#ffffff",
                "showShadow": "0",
                "canvasBgColor": "#ffffff",
                "canvasBorderAlpha": "0",
                "divlineAlpha": "100",
                "divlineColor": "#999999",
                "divlineThickness": "1",
                "divLineIsDashed": "1",
                "divLineDashLen": "1",
                "divLineGapLen": "1",
                "usePlotGradientColor": "0",
                "showplotborder": "0",
                "valueFontColor": "#ffffff",
                "placeValuesInside": "1",
                "showXAxisLine": "1",
                "xAxisLineThickness": "1",
                "xAxisLineColor": "#999999",
                "showAlternateHGridColor": "0",
                "legendBgAlpha": "0",
                "legendBorderAlpha": "0",
                "legendShadow": "0",
                "legendItemFontSize": "10",
                "legendItemFontColor": "#666666"
            },
            "categories": [{
                "category": lcategory
            }],
            "dataset": [{
                "dataset": [{
                    "seriesname": "Principal Paid",
                    "data": lPrincipal
                }, {
                    "seriesname": "Interest Paid",
                    "data": lInterest
                }]
            }],
            "lineset": [{
                "seriesname": "Outstanding Loan Balance",
                "data": lBalance
            }]
        }
    });
    revenueChart.render();
};
