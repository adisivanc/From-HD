apz.dashboard = {};
var lDashboardAction = "Edit";
var gmsline, gcolumn2d, gLine2d, gSpendChart;
var datearray = [];
apz.app.onLoad_Dashboard = function() {
    debugger;
    apz.dragdrop.initTouch();
    gmsline = gcolumn2d = gLine2d = gSpendChart = {};
    $("#ACDB01__Dashboard__selected_widget_section").find(".dragContent,.chscroller").removeClass("sno");
    var ldiv = "<div class='lrow dash-l2 emptywidget draggable_widget'></div>";
    $("#ACDB01__Dashboard__available_widget_section").append(ldiv);
    $("#ACDB01__Dashboard__available_widget_section").append(ldiv);
    $("#ACDB01__Dashboard__selected_widget_section, #ACDB01__Dashboard__available_widget_section").sortable({
        connectWith: ".drag_pad",
        cancel: '.emptywidget,input',
        cursorAt: {
            right: -5,
            top: -5
        },
        beforeStop: function(event, ui) {
            debugger;
            var ldiv = "<div class='lrow dash-l2 emptywidget draggable_widget'></div>";
            if ($(event.target).attr("id") == "ACDB01__Dashboard__available_widget_section" && $(ui.helper).parent().attr("id") ==
                "ACDB01__Dashboard__selected_widget_section") {
                $(ui.helper).addClass("wopen");
            }
            if ($(ui.helper).parent().attr("id") == "ACDB01__Dashboard__selected_widget_section") {
                
                // var getids = "";
                // var getElements = $("#"+$(ui.helper)[0].id).find('.dragContent,.chscroller ,.widgettools');
                // for(var i=0;i<getElements.length;i++){
                //     getids = getids +",#"+  getElements[i].id;
                // }
                
              
                // var getelm = $('#ACDB01__Dashboard__selected_widget_section').find('.dragContent,.chscroller ,.widgettools');
                // for(var i=0;i<getelm.length;i++){
                //     $("#"+getelm[i].id).fadeIn(6000, function() {
                //     $('#ACDB01__Dashboard__selected_widget_section').find('.dragContent,.chscroller ,.widgettools').removeClass('sno');
                // });
                // }
                
                   
                // $('#ACDB01__Dashboard__selected_widget_section').find('.dragContent,.chscroller ,.widgettools').fadeIn(6000, function() {
                //     $("#ACDB01__Dashboard__gr_row_22, #ACDB01__Dashboard__sc_col_36").removeClass('sno');
                // });
                
                $('#ACDB01__Dashboard__selected_widget_section').find('.dragContent,.chscroller ,.widgettools').fadeIn(6000, function() {
                    $('#ACDB01__Dashboard__selected_widget_section').find('.dragContent,.chscroller ,.widgettools').removeClass('sno');
                 });
                
                
                //$("#ACDB01__Dashboard__selected_widget_section").find(".dragContent,.chscroller ,.widgettools").removeClass("sno");
                $("#ACDB01__Dashboard__selected_widget_section").find('.dispNoneLabel').addClass("sno");
            } else {
                $("#ACDB01__Dashboard__available_widget_section").find(".dragContent,.chscroller ,.widgettools").addClass("sno");
                $('#ACDB01__Dashboard__available_widget_section').append($('.emptywidget'));
            }
            var llength = $("#ACDB01__Dashboard__available_widget_section .draggable_widget").not(".ui-sortable-placeholder").length;
            if (llength < 8) {
                debugger
                $("#ACDB01__Dashboard__available_widget_section").append(ldiv);
            } else if (llength > 6) {
                debugger;
                $('#ACDB01__Dashboard__available_widget_section .emptywidget:last').remove();
            }
            debugger;
            $("#ACDB01__Dashboard__available_widget_section .draggable_widget").not(".ui-sortable-placeholder")
            debugger;
            if (lDashboardAction == "Create") {
                apz.dashboard.fnSaveDashboardWidgetsDetails();
            } else {
                apz.dashboard.fnModifyDashboardWidgetsDetails();
            }
            setTimeout(function() {
                $(ui.helper).removeClass("wopen");
            }, 2000);
            apz.dashboard.calculateWidgetHeight();
        },
        stop: function(event, ui) {
            debugger;
            // $('#ACDB01__Dashboard__selected_widget_section').find('.draggable_widget').css('width', '49%').css('float', 'left');
            var elementTouching = document.elementFromPoint(event.clientX, event.clientY);
            if ($(elementTouching).closest(".drag_pad").attr("id") == "ACDB01__Dashboard__available_widget_section") {
                var gclone = $(ui.item).clone();
                var gwidgetid = $(ui.item).attr("id");
                $(gclone).removeAttr("style");
                $(gclone).removeClass("ui-sortable-helper");
                $("#ACDB01__Dashboard__available_widget_section #" + gwidgetid).remove();
                $("#ACDB01__Dashboard__available_widget_section").append(gclone);
                //gclone.fadeIn("slow");
                $("#ACDB01__Dashboard__available_widget_section").find(".dragContent,.chscroller,.widgettools").addClass("sno");
                $("#ACDB01__Dashboard__selected_widget_section #" + gwidgetid).remove();
                $('#ACDB01__Dashboard__available_widget_section').append($('.emptywidget'));
                if ($("#ACDB01__Dashboard__available_widget_section .draggable_widget").length > 6) {
                    $('#ACDB01__Dashboard__available_widget_section .emptywidget:last').remove();
                }
            }
            if ($(event.toElement).hasClass("removeWidget")) {
                debugger;
                apz.dashboard.closeWidget($(ui.item).attr("id"));
            }
        }
    }).disableSelection();
    // apz.dashboard.fnGetDetails();
    apz.dashboard.getCorpUserDashboard();
};
apz.app.onShown_Dashboard = function() {
    debugger;
    $(".dash-lc .drag_pad > div > div > div > .pst-simp.pri p").each(function() {
        var hgtPara = $(this).height();
        if (hgtPara < 20) {
            $(this).css("line-height", (hgtPara * 2.37) + "px");
        } else {
            $(this).css("line-height", "12px");
        }
    });
    $('#ACDB01__Dashboard__selected_widget_section').css('height', "auto");
    //$('#ACDB01__Dashboard__available_widget_section').css('height', "700px");
    $('#ACDB01__Dashboard__selected_widget_section').css('background-color', "#ffffff");
    $("#ACDB01__Dashboard__available_widget_section").find(".dragContent,.chscroller,.widgettools").addClass("sno");
    $("#ACDB01__Dashboard__selected_widget_section").find('.dispNoneLabel').addClass("sno");
    var lWindowWidth = $(window).width();
    $(document).mousemove(function(event) {
        if (event.pageX > lWindowWidth - 30) {
            if (!$("#ACDB01__Dashboard__WidgetSidebar").hasClass('apz-nav-open')) {
                apz.app.openSidebar("ACDB01__Dashboard__WidgetSidebar");
                setTimeout(function() {
                    apz.app.closeSidebar("ACDB01__Dashboard__WidgetSidebar");
                }, 5000);
            }
        }
    });
    // have to check mobile 
    if (apz.deviceGroup == "Mobile") {
        $(".shownonemc").each(function() {
            $($(this).closest("table").find("th")[$(this).index()]).hide();
        });
        $("#ACDB01__Dashboard__sliderImg").swipe({
            swipe: function(event, direction, distance, duration, fingerCount, fingerData) {
                if (direction == "right") {
                    $('#ACDB01__Dashboard__widgetColumn').addClass('showsdbar');
                    $('#ACDB01__Dashboard__sliderImg').removeClass('active');
                    apz.dashboard.disableSortableLists();
                } else if (direction == "left") {
                    $('#ACDB01__Dashboard__widgetColumn').removeClass('showsdbar');
                    $('#ACDB01__Dashboard__sliderImg').addClass('active');
                    apz.dashboard.enableSortableLists();
                }
            },
            threshold: 0
        });
        apz.dashboard.disableSortableLists();
        $(".draggable_widget").on("taphold", function() {
            $(this).addClass("pulse");
            apz.dashboard.enableSortableLists();
        });
        $(".draggable_widget").on("touchend", function() {
            $(this).removeClass("pulse");
            apz.dashboard.disableSortableLists();
        });
        $('#ACDB01__Dashboard__sliderImg').on('touchstart', function(event) {
            apz.dashboard.toggleWidget(event);
        });
    } else {
        apz.dashboard.enableSortableLists();
    }
};
apz.dashboard.fnSaveDashboardWidgetsDetails = function() {
    // apz.mockServer = false;
    var lwidgetsid = '';
    $("#ACDB01__Dashboard__selected_widget_section .draggable_widget").each(function() {
        if (this.id != "") {
            lwidgetsid = lwidgetsid + this.id + ",";
        }
    });
    var lwidgetsstr = lwidgetsid.substr(0, lwidgetsid.length - 1);
    var lServerParams = {
        "ifaceName": "DashboardWidgets_New",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.fnSaveDashboardWidgetsDetailsCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserDashboardWidget = {};
    req.tbDbmiCorpUserDashboardWidget.widgets = lwidgetsstr;
    if (apz.Login) {
        req.tbDbmiCorpUserDashboardWidget.userId = apz.Login.sUserId;
        req.tbDbmiCorpUserDashboardWidget.corporateId = apz.Login.sCorporateId;
    } else {
        req.tbDbmiCorpUserDashboardWidget.corporateId = "000FTAC4321";
        req.tbDbmiCorpUserDashboardWidget.userId = "CorpUser";
    }
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.fnSaveDashboardWidgetsDetailsCB = function(params) {
    // apz.mockServer = true;
    if (params.status) {
        if (apz.isNull(params.errors)) {
            lDashboardAction = "Edit";
        } else {
            if (params.errors[0].errorCode[0] !== "$") {
                // var msg = {
                //     "code": params.errors[0].errorCode
                // }
                // apz.dispMsg(msg);
            }
        }
    } else {
        // msg = {
        //     'code': 'APZ-SVR-ERR'
        // };
        // apz.dispMsg(msg);
    }
};
apz.dashboard.fnModifyDashboardWidgetsDetails = function() {
    debugger;
    // apz.mockServer = false;
    var lwidgetsid = '';
    $("#ACDB01__Dashboard__selected_widget_section .draggable_widget").each(function() {
        if (this.id != "") {
            lwidgetsid = lwidgetsid + this.id + ",";
        }
    });
    var lwidgetsstr = lwidgetsid.substr(0, lwidgetsid.length - 1);
    var lServerParams = {
        "ifaceName": "DashboardWidgets_Modify",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.fnModifyDashboardWidgetsDetailsCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserDashboardWidget = {};
    if (apz.Login) {
        req.tbDbmiCorpUserDashboardWidget.userId = apz.Login.sUserId;
        req.tbDbmiCorpUserDashboardWidget.corporateId = apz.Login.sCorporateId;
    } else {
        req.tbDbmiCorpUserDashboardWidget.corporateId = "000FTAC4321";
        req.tbDbmiCorpUserDashboardWidget.userId = "CorpUser";
    }
    req.tbDbmiCorpUserDashboardWidget.widgets = lwidgetsstr;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.fnModifyDashboardWidgetsDetailsCB = function(params) {
    debugger;
    // apz.mockServer = true;
    if (params.status) {
        if (apz.isNull(params.errors)) {} else {
            if (params.errors[0].errorCode[0] !== "$") {
                // var msg = {
                //     "code": params.errors[0].errorCode
                // }
                // apz.dispMsg(msg);
            }
        }
    } else {
        // msg = {
        //     'code': 'APZ-SVR-ERR'
        // };
        // apz.dispMsg(msg);
    }
};
apz.dashboard.calculateWidgetHeight = function() {
    if ($("#ACDB01__Dashboard__selected_widget_section .draggable_widget").length <= 6) {
        $("#ACDB01__Dashboard__selected_widget_section").css("min-height", "1200px");
        if (apz.deviceGroup == "Mobile") {
            $("#ACDB01__Dashboard__selected_widget_section").css("min-height", "430px");
        }
    } else {
        $("#ACDB01__Dashboard__selected_widget_section").css("min-height", "");
    }
};
apz.dashboard.deleteDashboardWidgetsDetails = function(dashboardId) {
    // apz.mockServer = false;
    var lServerParams = {
        "ifaceName": "DashboardWidgets_Delete",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.deleteDashboardWidgetsDetailsCB,
        "callBackObj": {
            "dashboardId": dashboardId
        },
    };
    var req = {};
    req.tbDbmiCorpUserDashboardWidget = {};
    if (apz.Login) {
        req.tbDbmiCorpUserDashboardWidget.userId = apz.Login.sUserId;
        req.tbDbmiCorpUserDashboardWidget.corporateId = apz.Login.sCorporateId;
    } else {
        req.tbDbmiCorpUserDashboardWidget.corporateId = "000FTAC4321";
        req.tbDbmiCorpUserDashboardWidget.userId = "CorpUser";
    }
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.deleteDashboardWidgetsDetailsCB = function(pResp) {
    apz.dashboard.modifyUserDashboard(pResp.callBackObj.dashboardId);
};
apz.dashboard.modifyUserDashboard = function(dashboardId) {
    // apz.mockServer = false;
    var lServerParams = {
        "ifaceName": "GetCorpUserDashboard_Modify",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.deleteUserDashboardCB,
        "callBackObj": {
            dashboardId: dashboardId
        },
    };
    var req = {};
    req.tbDbmiCorpUserDashboard = {};
    if (apz.Login) {
        req.tbDbmiCorpUserDashboard.userId = apz.Login.sUserId;
        req.tbDbmiCorpUserDashboard.corporateId = apz.Login.sCorporateId;
        req.tbDbmiCorpUserDashboard.dashboardId = dashboardId;
    } else {
        req.tbDbmiCorpUserDashboard.corporateId = "000FTAC4321";
        req.tbDbmiCorpUserDashboard.userId = "CorpUser";
    }
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.deleteUserDashboardCB = function(pResp) {
    debugger;
    apz.dashboard.getCorpDashboard(pResp.callBackObj.dashboardId);
}
apz.dashboard.fnQueryDashboardWidgetsDetails = function() {
    // apz.mockServer = false;
    var lServerParams = {
        "ifaceName": "DashboardWidgets_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.fnQueryDashboardWidgetsDetailsCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserDashboardWidget = {};
    if (apz.Login) {
        req.tbDbmiCorpUserDashboardWidget.userId = apz.Login.sUserId;
        req.tbDbmiCorpUserDashboardWidget.corporateId = apz.Login.sCorporateId;
    } else {
        req.tbDbmiCorpUserDashboardWidget.corporateId = "000FTAC4321";
        req.tbDbmiCorpUserDashboardWidget.userId = "CorpUser";
    }
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.fnQueryDashboardWidgetsDetailsCB = function(params) {
    debugger;
    // apz.mockServer = true;
    //apz.data.loadJsonData("DashboardStaticData", "ACDB01");
    if (params.status) {
        if (apz.isNull(params.errors)) {
            //apz.data.loadJsonData("DashboardStaticData", "ACDB01");
            if (params.res.ACDB01__DashboardWidgets_Res.tbDbmiCorpUserDashboardWidget.widgets) {
                var lwidgetsarr = params.res.ACDB01__DashboardWidgets_Res.tbDbmiCorpUserDashboardWidget.widgets.split(",");
                apz.dashboard.fnShowSelectedWidgets(lwidgetsarr);
            } else {
                if (params.res.ACDB01__DashboardWidgets_Res.tbDbmiCorpUserDashboardWidget.widgets == "") {
                    lDashboardAction = "Edit";
                } else {
                    lDashboardAction = "Create";
                }
                var lwidgetsarr = apz.data.scrdata.ACDB01__GetCorpDashboard_Res.tbDbmiCorpDashboard.defaultWidgetList.split(",");
                apz.dashboard.fnShowSelectedWidgets(lwidgetsarr);
            }
            debugger;
            apz.dashboard.FetchTaskFlowDetails();
        } else {
            lDashboardAction = "Create";
            if (params.errors[0].errorCode[0] !== "$") {
                // var msg = {
                //     "code": params.errors[0].errorCode
                // }
                // apz.dispMsg(msg);
            }
            if (params.errors[0].errorCode == "APZ_FM_EX_038") {
                var lwidgetsarr = apz.data.scrdata.ACDB01__GetCorpDashboard_Res.tbDbmiCorpDashboard.defaultWidgetList.split(",");
                apz.dashboard.fnShowSelectedWidgets(lwidgetsarr);
            }
        }
    } else {
        // msg = {
        //     'code': 'APZ-SVR-ERR'
        // };
        // apz.dispMsg(msg);
    }
};
apz.dashboard.FetchTaskFlowDetails = function() {
    var lServerParams = {
        "ifaceName": "FetchTaskFlowDetails",
        "appId": "ACDB01",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.dashboard.FetchTaskFlowDetailsCB,
        "callBackObj": "",
    };
    var req = {
        "TaskSummary": {
            "corporateId": apz.ACNR01.Navigator.sCorporateId
        }
    };
    req.action = "Query";
    req.table = "tb_dbmi_workflow_master";
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
}
apz.dashboard.FetchTaskFlowDetailsCB = function(params) {
    debugger;
    if (params.res) {
        var taskarr = params.res.ACDB01__FetchTaskFlowDetails_Res.TaskSummary;
        for (var i = 0; i < taskarr.length; i++) {
            taskarr[i].startTs = taskarr[i].startTs.split(" ")[0]
        }
        apz.data.scrdata.ACDB01__FetchTaskFlowDetails_Res.TaskSummary = taskarr.slice(0, 5);
        apz.data.loadData("FetchTaskFlowDetails");
        $("#ACDB01__Dashboard__taskSummaryContent_pagination_ul").addClass("sno");
    }
}
apz.dashboard.fnShowSelectedWidgets = function(lwidgetsarr) {
    
    debugger;
   
    for (var i = 0; i < lwidgetsarr.length; i++) {
        debugger;
        var lclone = $("#" + lwidgetsarr[i]).clone();
        $("#ACDB01__Dashboard__selected_widget_section").append(lclone);
        $("#ACDB01__Dashboard__available_widget_section #" + lwidgetsarr[i]).remove();
        var ldiv = "<div class='lrow dash-l2 emptywidget draggable_widget'></div>";
        if ($("#ACDB01__Dashboard__available_widget_section .draggable_widget").length < 6) {
            $("#ACDB01__Dashboard__available_widget_section").append(ldiv);
        }
    }
    $("#ACDB01__Dashboard__selected_widget_section").find(".dragContent,.chscroller , .widgettools").removeClass("sno");
    /*$('#ACDB01__Dashboard__selected_widget_section').find('.draggable_widget').css({
        width: '49%',
        float: 'left'
    });*/
    setTimeout(function() {
        debugger;
        apz.data.loadJsonData("DashboardStaticData", "ACDB01");
        //Updating CashBalance with static data as per Ushant.
        apz.data.scrdata.ACDB01__Dashboard_Req.balanceMovement = gCashBalance.balanceMovement;
        //End of changes.
        
        // var ldata = apz.data.scrdata.ACDB01__Dashboard_Req.transactionsSummary;
        
        // for(var j=0;j<ldata.length;j++){
        //     var strlen = apz.getElmValue("ACDB01__Dashboard__i__transactionsSummary__account_"+j);
        //   strlen = strlen.substr(0,strlen.length-4).replace(/[0-9]/g, 'X') + strlen.substr(strlen.length-4,strlen.length).replace(/[0-9]/g, '9');
        //     var result = apz.getMaskedValue('XXXXXXXXX9999',ldata[j].account);
        //     apz.setElmValue("ACDB01__Dashboard__i__transactionsSummary__account_"+j,result);
        // }
        
        apz.dashboard.exposuretbldata = apz.data.scrdata.ACDB01__Dashboard_Req;
        // apz.data.scrdata.ACDB01__Dashboard_Req.exposureoverviewtbl = apz.dashboard.exposuretbldata.cashlimitTbl;
        //apz.data.loadData("Dashboard");
        apz.dashboard.fngetdates(30, 5);
        var rowlength = apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable.length;
        for (var i = 0; i < rowlength; i++) {
            apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable[i].date = apz.dashboard.formatdate(datearray[i].date);
        }
        
         var params = {};
    params.appId = "Calend";
    params.scr = "demonew";
    //params.layout = "All";
    params.div = "ACDB01__Dashboard__launchcol";
   
    apz.launchApp(params);
      
        
        //apz.data.loadData("Dashboard");
    }, 300)
    apz.dashboard.calculateWidgetHeight();
}
apz.dashboard.fnGetDetails = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "Dashboard_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "",
        "callBack": apz.dashboard.fnGetDetailsCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
/*** Have To check ***/
apz.dashboard.fnGetDetailsCB = function(params) {
    debugger;
    var lAccountArr = apz.dashboard.removeDuplicates(apz.data.scrdata.ACDB01__Dashboard_Req.balanceMovement, ['account']);
    var larr = [
        /*{
        "val": "select",
        "desc": "Select Account Number"
    }*/
    ];
    for (var i = 0; i < lAccountArr.length; i++) {
        var lObj = {
            "val": lAccountArr[i].account,
            "desc": lAccountArr[i].account,
        };
        larr.push(lObj);
    }
    debugger;
    apz.populateDropdown(document.getElementById("ACDB01__Dashboard__accountCashFlowNumber"), larr);
    // $("#ACDB01__Dashboard__accountCashFlowNumber_div li:eq(1)").trigger("click");
    // $("#ACDB01__Dashboard__accountCashFlowNumber_ext").removeClass("is-open");
    // apz.dropdownToggle(document.getElementById("ACDB01__Dashboard__accountCashFlowNumber"));
    apz.data.loadData("Dashboard");
    apz.dashboard.changeAmountFormat();
    apz.dashboard.showSpendAnalyser();
    apz.dashboard.paintAccountCashFlowChart();
    apz.dashboard.fnQueryDashboardWidgetsDetails();
};
apz.dashboard.removeDuplicates = function(originalArray, properties) {
    var newArray = [];
    var index = 0;
    var lookupObject = {};
    var totalProperties = properties.length;
    for (var i = 0; i < originalArray.length; i++) {
        var exists = false;
        for (var a = 0; a < newArray.length; a++) {
            var propsFound = 0;
            for (var b = 0; b < totalProperties; b++) {
                if (originalArray[i][properties[b]] == newArray[a][properties[b]]) {
                    propsFound++;
                }
            }
            //If there is a match then break the for loop
            if (propsFound == totalProperties) {
                exists = true;
                break;
            }
        } //End of New Array
        if (!exists) {
            newArray[index] = originalArray[i];
            index++;
        }
    } //End of originalArray
    return newArray;
};
apz.dashboard.enableSortableLists = function() {
    $("#ACDB01__Dashboard__selected_widget_section, #ACDB01__Dashboard__available_widget_section").sortable("enable");
};
// have to check for mobile.
apz.dashboard.disableSortableLists = function() {
    if (apz.deviceGroup == "Mobile") {
        if ($('#widgetColumn').hasClass("showsdbar")) {
            $("#selected_widget_section, #available_widget_section").sortable("disable");
        }
    }
};
apz.dashboard.changeAmountFormat = function() {
    //have to check if required or not
};
apz.dashboard.showSpendAnalyser = function() {
    var ltransArr = apz.data.scrdata.ACDB01__Dashboard_Req.transactionsSummary;
    /* if (ltransArr.length > 0) {
        for (var j = 0; j < ltransArr.length; j++) {
            sTotSpentAmnt = ltransArr[j].amount + sTotSpentAmnt;
           // var ltip = ltransArr[j].hashtag;
            //$("#hashbtn_" + j).attr("title", ltip);
        }
    }*/
    var lTempSpendCategoryArray = {};
    lTempSpendCategoryArray[ltransArr[0].hashtag] = parseFloat(ltransArr[0].amount);
    for (var i = 0; i < ltransArr.length - 1; i++) {
        if (ltransArr[i].hashtag == ltransArr[i + 1].hashtag) {
            if (lTempSpendCategoryArray[ltransArr[i].hashtag]) {
                lTempSpendCategoryArray[ltransArr[i].hashtag] = lTempSpendCategoryArray[ltransArr[i].hashtag] + parseFloat(ltransArr[i + 1].amount);
            } else {
                lTempSpendCategoryArray[ltransArr[i + 1].hashtag] = parseFloat(ltransArr[i].amount);
            }
        } else {
            if (lTempSpendCategoryArray[ltransArr[i + 1].hashtag]) {
                lTempSpendCategoryArray[ltransArr[i + 1].hashtag] = lTempSpendCategoryArray[ltransArr[i + 1].hashtag] + parseFloat(ltransArr[i + 1].amount);
            } else {
                lTempSpendCategoryArray[ltransArr[i + 1].hashtag] = parseFloat(ltransArr[i + 1].amount);
            }
        }
    }
    apz.data.scrdata.ACDB01__FundAnalyser_Req = {};
    apz.data.scrdata.ACDB01__FundAnalyser_Req.transactionAnalyser = [];
    $.each(lTempSpendCategoryArray, function(hashtag, amount) {
        var lTempCategoryObj = {};
        lTempCategoryObj.amount = amount;
        lTempCategoryObj.hashtag = hashtag;
        console.log(amount + hashtag);
        apz.data.scrdata.ACDB01__FundAnalyser_Req.transactionAnalyser.push(lTempCategoryObj);
    });
    apz.data.loadData("FundAnalyser");
};
apz.dashboard.paintAccountCashFlowChart = function() {
    var laccount = $("#ACDB01__Dashboard__accountCashFlowNumber").val();
    apz.data.scrdata.ACDB01__AccountCashFlow_Req = {};
    apz.data.scrdata.ACDB01__AccountCashFlow_Req.accountCashFlow = [];
    for (var i = 0; i < apz.data.scrdata.ACDB01__Dashboard_Req.balanceMovement.length; i++) {
        if (apz.data.scrdata.ACDB01__Dashboard_Req.balanceMovement[i].account == laccount) {
            apz.data.scrdata.ACDB01__AccountCashFlow_Req.accountCashFlow.push(apz.copyJSONObject(apz.data.scrdata.ACDB01__Dashboard_Req.balanceMovement[
                i]));
        }
    }
    for (var i = 0; i < apz.data.scrdata.ACDB01__AccountCashFlow_Req.accountCashFlow.length; i++) {
        var params = {};
        params.val = apz.data.scrdata.ACDB01__AccountCashFlow_Req.accountCashFlow[i].date;
        params.fromFormat = "dd-MM-yyyy",
        params.toFormat = "dd-MMM",
        apz.data.scrdata.ACDB01__AccountCashFlow_Req.accountCashFlow[i].date = apz.formatDate(params);
    }
    apz.data.loadData("AccountCashFlow");
};
apz.dashboard.movewidgetsup = function() {
    var widget = $("#ACDB01__Dashboard__available_widget_section .draggable_widget").hasClass("emptywidget");
    if (!widget) {
        $("#ACDB01__Dashboard__available_widget_section").append($("#ACDB01__Dashboard__available_widget_section .draggable_widget:first"));
    } else {
        $("#ACDB01__Dashboard__available_widget_section .draggable_widget:first").insertAfter($(
            "#ACDB01__Dashboard__available_widget_section .emptywidget:first").prev());
    }
};
apz.dashboard.movewidgetsdown = function() {
    var widget = $("#ACDB01__Dashboard__available_widget_section .draggable_widget").hasClass("emptywidget");
    if (!widget) {
        $("#ACDB01__Dashboard__available_widget_section").prepend($("#ACDB01__Dashboard__available_widget_section .draggable_widget:last"));
    } else {
        $("#ACDB01__Dashboard__available_widget_section").prepend($("#ACDB01__Dashboard__available_widget_section .emptywidget:first").prev());
    }
};
apz.dashboard.toggleWidget = function(event) {
    debugger;
    $("#widgettoggleicon").toggleClass();
    if ($('#ACDB01__Dashboard__widgetColumn').hasClass('showsdbar')) {
        $('#ACDB01__Dashboard__widgetColumn').removeClass('showsdbar');
        $('#ACDB01__Dashboard__sliderImg').addClass('active');
        apz.dashboard.enableSortableLists();
    } else {
        $('#ACDB01__Dashboard__widgetColumn').addClass('showsdbar');
        $('#ACDB01__Dashboard__sliderImg').removeClass('active');
        apz.dashboard.disableSortableLists();
    }
    event.stopPropagation();
};
apz.dashboard.openWidgetDiv = function() {
    $('#ACDB01__Dashboard__widgetDiv').removeClass('sno');
};
apz.dashboard.closeWidgetDiv = function() {
    $('#ACDB01__Dashboard__widgetDiv').addClass('sno');
};
apz.dashboard.closeWidget = function(pid) {
    debugger;
    var lclone = $("#ACDB01__Dashboard__" + pid).clone();
    $("#ACDB01__Dashboard__available_widget_section #ACDB01__Dashboard__" + pid).remove();
    $("#ACDB01__Dashboard__available_widget_section").append(lclone);
    $("#ACDB01__Dashboard__available_widget_section").find(".dragContent,.chscroller,.widgettools").addClass("sno");
    $("#ACDB01__Dashboard__available_widget_section #ACDB01__Dashboard__" + pid).addClass("wclose");
    //$("#ACDB01__Dashboard__available_widget_section #ACDB01__Dashboard__" + pid).css('width', '100%');
    setTimeout(function() {
        $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid).remove();
        apz.dashboard.fnModifyDashboardWidgetsDetails();
    }, 500);
    $('#ACDB01__Dashboard__available_widget_section').append($('.emptywidget'));
    if ($("#ACDB01__Dashboard__available_widget_section .draggable_widget").length > 6) {
        $('#ACDB01__Dashboard__available_widget_section .emptywidget:last').remove();
    }
    apz.dashboard.calculateWidgetHeight();
};
// have to check from here.
apz.dashboard.showFullScreenWidget = function(pid, event) {
    debugger;
    if ($("#ACDB01__Dashboard__" + pid + " .icon-minimize").hasClass("fullScreenWidget")) {
        apz.dashboard.removeFullScreenWidget(pid);
        $("#ACDB01__Dashboard__widgetbarbtn").removeClass('sno');
    } else {
        $("#ACDB01__Dashboard__gr_row_9").addClass('expandWid');
        $("#ACDB01__Dashboard__widgetbarbtn").addClass('sno');
        if ($("#ACDB01__Dashboard__WidgetSidebar").hasClass('open')) {
            $("#ACDB01__Dashboard__WidgetSidebar").removeClass('open');
        };
        $("#ACDB01__Dashboard__" + pid + " .icon-fullscreen").addClass("fullScreenWidget");
        $("#ACDB01__Dashboard__" + pid + " .icon-fullscreen").addClass("icon-minimize");
        $("#ACDB01__Dashboard__" + pid + " .icon-fullscreen").removeClass("icon-fullscreen");
        $("#ACDB01__Dashboard__selected_widget_section .draggable_widget").addClass("sno");
        $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid).css("width", "100%");
        //$("#ACDB01__Dashboard__" + pid + " .icon-close").css('pointer-events', 'none');
        $("#ACDB01__Dashboard__" + pid + " .icon-close").addClass('sno');
        $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .icon-remove-circle").parent().attr("onclick", "");
        $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .icon-resize-full").addClass("icon-resize-small");
        $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid).removeClass("sno");
        if (apz.deviceGroup == "All") {
            $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .dispNoneLabel").removeClass("sno");
        }
        if (pid == "balance_movement_row") {
            $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .chscroller").addClass("fullscrrenWidgetHeight");
            gmsline.height = "435px";
            //  gmsline.render();
        } else if (pid == "relationship_summary_row") {
            $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .chscroller").addClass("fullscrrenWidgetHeight");
            gcolumn2d.height = "435px";
            //  gcolumn2d.render();
        } else if (pid == "spendrow") {
            $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .chscroller").addClass("fullscrrenWidgetHeight");
            gSpendChart.height = "435px";
            //  gSpendChart.render();
        } else {
            for (var i = 0; i < apz.scrMetaData.containers.length; i++) {
                debugger;
                if (pid == "recent_transactions_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__recentTransactionsContent") {
                    apz.scrMetaData.containersMap['ACDB01__Dashboard__recentTransactionsContent'].pageSize = 8;
                    $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid).removeClass("recTrans");
                    $(".icon-plus").addClass("sno");
                } else if (pid == "task_summary_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__taskSummaryContent") {
                    apz.scrMetaData.containersMap["ACDB01__Dashboard__taskSummaryContent"].pageSize = 10;
                } else if (pid == "information_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__informationContent") {
                    apz.scrMetaData.containersMap["ACDB01__Dashboard__taskSummaryContent"].pageSize = 10;
                } else if (pid == "balance_summary_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__balanceSummaryContent") {
                    apz.scrMetaData.containersMap["ACDB01__Dashboard__taskSummaryContent"].pageSize = 10;
                } else if (pid == "account_cash_flow_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__accountCashFlowListContent") {
                    apz.scrMetaData.containers["ACDB01__Dashboard__taskSummaryContent"].pageSize = 10;
                    $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .shdbox").removeClass("accountcashflowshdbox");
                }
            }
            $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .shdbox").addClass("fullscrrenWidgetHeight");
            apz.data.loadData("Dashboard");
            apz.data.loadData("AccountCashFlow");
            if (pid == "ACDB01__Dashboard__recent_transactions_row") {
                $(".hashtag").removeClass("sno");
            }
        }
        if (pid == "exposure_overview_row") {
            //$("#ACDB01__Dashboard__exposuretblrow").removeClass("sno");
        }
    }
    event.stopPropagation();
};
apz.dashboard.removeFullScreenWidget = function(pid) {
     $("#ACDB01__Dashboard__gr_row_9").removeClass('expandWid');
    $("#ACDB01__Dashboard__" + pid + " .icon-minimize").removeClass("fullScreenWidget");
    $("#ACDB01__Dashboard__" + pid + " .icon-minimize").addClass("icon-fullscreen");
    $("#ACDB01__Dashboard__" + pid + " .icon-minimize").removeClass("icon-minimize");
    $("#ACDB01__Dashboard__selected_widget_section .draggable_widget").removeClass("sno");
    $("#ACDB01__Dashboard__selected_widget_section #" + pid + " .icon-resize-full").removeClass("icon-resize-small");
    //$("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid).css("width", "49%");
    $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid).removeAttr("style");
    //$("#ACDB01__Dashboard__" + pid + " .icon-close").css('pointer-events', 'all');
    $("#ACDB01__Dashboard__" + pid + " .icon-close").removeClass('sno');
    if (apz.deviceGroup == "All") {
        $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .dispNoneLabel").addClass("sno");
    }
   
    
    if (pid == "balance_movement_row") {
        $("#ACDB01__Dashboard__selected_widget_section #" + pid + " .chscroller").removeClass("fullscrrenWidgetHeight");
        gmsline.height = "255px";
        // gmsline.render();
    } else if (pid == "relationship_summary_row") {
        $("#ACDB01__Dashboard__selected_widget_section #" + pid + " .chscroller").removeClass("fullscrrenWidgetHeight");
        gcolumn2d.height = "255px";
        //  gcolumn2d.render();
    } else if (pid == "spendrow") {
        $("#ACDB01__Dashboard__selected_widget_section #" + pid + " .chscroller").removeClass("fullscrrenWidgetHeight");
        gSpendChart.height = "255px";
        //  gSpendChart.render();
    } else {
        for (var i = 0; i < apz.scrMetaData.containers.length; i++) {
            if (pid == "recent_transactions_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__recentTransactionsContent") {
                apz.scrMetaData.containersMap["ACDB01__Dashboard__recentTransactionsContent"].pageSize = 5;
                $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid).addClass("recTrans");
                $(".icon-plus").removeClass("sno");
                $(".hashtag").addClass("sno");
                apz.dashboard.removeExtraRows("recentTransactionsContent");
            } else if (pid == "task_summary_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__taskSummaryContent") {
                apz.scrMetaData.containersMap["ACDB01__Dashboard__taskSummaryContent"].pageSize = 5;
                apz.dashboard.removeExtraRows("taskSummaryContent");
            } else if (pid == "information_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__informationContent") {
                apz.scrMetaData.containersMap["ACDB01__Dashboard__informationContent"].pageSize = 5;
                apz.dashboard.removeExtraRows("informationContent");
            } else if (pid == "balance_summary_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__balanceSummaryContent") {
                apz.scrMetaData.containersMap["ACDB01__Dashboard__balanceSummaryContent"].pageSize = 5;
                apz.dashboard.removeExtraRows("balanceSummaryContent");
            } else if (pid == "account_cash_flow_row" && apz.scrMetaData.containers[i].id == "ACDB01__Dashboard__accountCashFlowListContent") {
                apz.scrMetaData.containersMap["ACDB01__Dashboard__accountCashFlowListContent"].pageSize = 3;
                apz.dashboard.removeExtraRows("accountCashFlowListContent");
                $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .shdbox").addClass("accountcashflowshdbox");
            }
        }
        $("#ACDB01__Dashboard__selected_widget_section #ACDB01__Dashboard__" + pid + " .shdbox").removeClass("fullscrrenWidgetHeight");
        apz.data.loadData("Dashboard");
        apz.data.loadData("AccountCashFlow");
    }
};
apz.dashboard.removeExtraRows = function(pid) {
    debugger;
    var lrowno = pid == "accountCashFlowListContent" ? 1 : 4;
    var totalRec = $("#ACDB01__Dashboard__" + pid + " li").length - 1
    $("#ACDB01__Dashboard__" + pid + " li").each(function(i) {
        if (i < totalRec) {
            if (i > lrowno) {
                $(this).remove();
            }
        }
    });
    $("#ACDB01__Dashboard__" + pid + " tr").each(function(i) {
        if (i > lrowno) {
            $(this).remove();
        }
    });
};
apz.dashboard.showInputCategory = function(obj, event) {
    debugger;
    var id = obj.id;
    var i = id.split("_")[5];
    if ($("#ACDB01__Dashboard__recent_transactions_row").hasClass("recTrans")) {
        $(".hashtag").addClass("sno");
        $("#ACDB01__Dashboard__i__transactionsSummary__hashtag_" + i).parent().toggleClass("sno");
        $("#ACDB01__Dashboard__i__transactionsSummary__hashtag_" + i).focus();
    }
    event.stopPropagation();
};
apz.dashboard.showToolTip = function(pthis) {
    var id = pthis.id.split("_")[5];
    var lTip = $("#ACDB01__Dashboard__hashbtn_" + id).parent().parent().siblings().find("input").val();
    $("#ACDB01__Dashboard__hashbtn_" + id).attr("title", lTip);
};
apz.dashboard.spendCategorizer = function(prow) {
    var id = prow.id;
    debugger;
    var i = id.split("_")[9];
    apz.data.buildData("Dashboard");
    var ltransArr = apz.data.scrdata.ACDB01__Dashboard_Req.transactionsSummary;
    var ltip = $("#Dashboard__i__transactionsSummary__hashtag_" + i).val();
    $("#ACDB01__Dashboard__hashbtn_" + i).attr("title", ltip);
    if ($("#ACDB01__Dashboard__recent_transactions_row").hasClass("recTrans")) {
        $(".hashtag").addClass("sno");
    }
    //var lAnalArr=apz.data.scrdata.FundAnalyser_Req.transactionAnalyser;
    var lTempSpendCategoryArray = {};
    lTempSpendCategoryArray[ltransArr[0].hashtag] = parseFloat(ltransArr[0].amount);
    for (var i = 0; i < ltransArr.length - 1; i++) {
        debugger;
        if (ltransArr[i].hashtag == ltransArr[i + 1].hashtag) {
            if (lTempSpendCategoryArray[ltransArr[i].hashtag]) {
                lTempSpendCategoryArray[ltransArr[i].hashtag] = lTempSpendCategoryArray[ltransArr[i].hashtag] + parseFloat(ltransArr[i + 1].amount);
            } else {
                lTempSpendCategoryArray[ltransArr[i + 1].hashtag] = parseFloat(ltransArr[j].amount);
            }
        } else {
            if (lTempSpendCategoryArray[ltransArr[i + 1].hashtag]) {
                lTempSpendCategoryArray[ltransArr[i + 1].hashtag] = lTempSpendCategoryArray[ltransArr[i + 1].hashtag] + parseFloat(ltransArr[i + 1].amount);
            } else {
                lTempSpendCategoryArray[ltransArr[i + 1].hashtag] = parseFloat(ltransArr[i + 1].amount);
            }
        }
    }
    apz.data.scrdata.ACDB01__FundAnalyser_Req = {};
    apz.data.scrdata.ACDB01__FundAnalyser_Req.transactionAnalyser = [];
    $.each(lTempSpendCategoryArray, function(hashtag, amount) {
        debugger;
        var lTempCategoryObj = {};
        lTempCategoryObj.amount = amount;
        lTempCategoryObj.hashtag = hashtag;
        console.log(amount + hashtag);
        apz.data.scrdata.ACDB01__FundAnalyser_Req.transactionAnalyser.push(lTempCategoryObj);
    });
    apz.data.loadData("FundAnalyser");
};
apz.dashboard.removeDuplicates = function(originalArray, properties) {
    var newArray = [];
    var index = 0;
    var lookupObject = {};
    var totalProperties = properties.length;
    for (var i = 0; i < originalArray.length; i++) {
        var exists = false;
        for (var a = 0; a < newArray.length; a++) {
            var propsFound = 0;
            for (var b = 0; b < totalProperties; b++) {
                if (originalArray[i][properties[b]] == newArray[a][properties[b]]) {
                    propsFound++;
                }
            }
            //If there is a match then break the for loop
            if (propsFound == totalProperties) {
                exists = true;
                break;
            }
        } //End of New Array
        if (!exists) {
            newArray[index] = originalArray[i];
            index++;
        }
    } //End of originalArray
    return newArray;
};
apz.dashboard.getCorpUserDashboard = function() {
    // apz.mockServer = false;
    var lServerParams = {
        "ifaceName": "GetCorpUserDashboard_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.getCorpUserDashboardCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserDashboard = {};
    if (apz.Login) {
        req.tbDbmiCorpUserDashboard.userId = apz.Login.sUserId;
        req.tbDbmiCorpUserDashboard.corporateId = apz.Login.sCorporateId;
    } else {
        req.tbDbmiCorpUserDashboard.corporateId = "000FTAC4321";
        req.tbDbmiCorpUserDashboard.userId = "CorpUser";
    }
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.getCorpUserDashboardCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        /*var lServerParams = {
            "ifaceName": "GetCorpDashboard_Query",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "async": "true",
            "callBack": apz.dashboard.getCorpDashboardCB,
            "callBackObj": "",
        };
        var req = {};
        req.tbDbmiCorpDashboard = {};
        req.tbDbmiCorpDashboard.dashboardId = pResp.res.ACDB01__GetCorpUserDashboard_Res.tbDbmiCorpUserDashboard.dashboardId;*/
        apz.dashboard.getPersonaDashboard(pResp.res.ACDB01__GetCorpUserDashboard_Res.tbDbmiCorpUserDashboard.dashboardId);
        /*if (apz.Login) {
            req.tbDbmiCorpDashboard.userId = apz.Login.sUserId;
            if(apz.Login.sPersona){
                req.tbDbmiCorpDashboard.userId = apz.Login.sPersona;
            }
            req.tbDbmiCorpDashboard.corporateId = apz.Login.sCorporateId;
        } else {
            req.tbDbmiCorpDashboard.corporateId = "000FTAC4321";
            req.tbDbmiCorpDashboard.userId = "CorpUser";
        }
        lServerParams.req = req;
        apz.server.callServer(lServerParams);*/
    }
};
apz.dashboard.getCorpDashboard = function(dashboardId) {
    var lServerParams = {
        "ifaceName": "GetCorpDashboard_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.getCorpDashboardCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpDashboard = {};
    req.tbDbmiCorpDashboard.dashboardId = dashboardId;
    if (apz.Login) {
        req.tbDbmiCorpDashboard.userId = apz.Login.sUserId;
        if (apz.Login.sPersona) {
            req.tbDbmiCorpDashboard.userId = apz.Login.sPersona;
        }
        req.tbDbmiCorpDashboard.corporateId = apz.Login.sCorporateId;
    } else {
        req.tbDbmiCorpDashboard.corporateId = "000FTAC4321";
        req.tbDbmiCorpDashboard.userId = "CorpUser";
    }
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.getCorpDashboardCB = function(pResp) {
    debugger;
    // apz.mockServer = true;
    if (!pResp.errors) {
        var larr = pResp.res.ACDB01__GetCorpDashboard_Res.tbDbmiCorpDashboard.widgetsList.split(",");
        for (var i = 0; i < larr.length; i++) {
            apz.show(larr[i]);
        }
        apz.dashboard.fnQueryDashboardWidgetsDetails();
    }
};
apz.dashboard.getPersonaDashboard = function(dashboardId) {
    var lServerParams = {
        "ifaceName": "GetPersonaDashboard",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.dashboard.getPersonaDashboardCB,
        "callBackObj": {
            "dashboardId": dashboardId
        },
    };
    var req = {};
    req.userId = apz.Login.sUserId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.dashboard.getPersonaDashboardCB = function(pResp) {
    try {
        if (!pResp.errors) {
            var lDesign = pResp.res.ACDB01__GetPersonaDashboard_Res[0].design;
            if (lDesign == pResp.callBackObj.dashboardId) {
                //apz.data.loadJsonData("DashboardStaticData", "ACDB01");
                apz.dashboard.getCorpDashboard(lDesign);
            } else {
                apz.dashboard.deleteDashboardWidgetsDetails(lDesign);
            }
        }
    } catch (e) {
        apz.dashboard.getCorpDashboard(pResp.callBackObj.dashboardId);
    }
};
apz.dashboard.openWidgetsBar = function() {
    $("#ACDB01__Dashboard__WidgetSidebar").toggleClass('open');
};
apz.app.updateChartBeforeRender = function(gChartType, gChartData, gId, gChart) {
    debugger;
    gChartData.chart.captionFontBold = 0;
    gChartData.chart.baseFont = "Roboto";
    gChartData.chart.usePlotGradientColor = 0;
    if (gId == "ACDB01__Dashboard__chartHigh") {
        gChartData.chart.defaultCenterLabel = "10 <br/> High";
        // gChart.removeEventListener("centerLabelClick",apz.dashboard.drilldownchart);
        // gChart.addEventListener("centerLabelClick", apz.dashboard.drilldownchart);
        gChart.removeEventListener("chartClick", apz.dashboard.drilldownchart);
        gChart.addEventListener("chartClick", apz.dashboard.drilldownchart);
        // gChart.removeEventListener("dataPlotClick",apz.dashboard.drilldownchart);
        // gChart.addEventListener("dataPlotClick", apz.dashboard.drilldownchart);
        setTimeout(function() {
            $("#ACDB01__Dashboard__chartHigh tspan:nth-child(1)").attr('style', 'font-size:15px;font-weight:bold;');
        }, 1000);
    }
    if (gId == "ACDB01__Dashboard__chartMedium") {
        gChartData.chart.defaultCenterLabel = "8 <br/> Medium";
        //   gChart.removeEventListener("centerLabelClick",apz.dashboard.drilldownchart);
        //     gChart.addEventListener("centerLabelClick", apz.dashboard.drilldownchart);
        gChart.removeEventListener("chartClick", apz.dashboard.drilldownchart);
        gChart.addEventListener("chartClick", apz.dashboard.drilldownchart);
        //     gChart.removeEventListener("dataPlotClick",apz.dashboard.drilldownchart);
        //     gChart.addEventListener("dataPlotClick", apz.dashboard.drilldownchart);
        setTimeout(function() {
            $("#ACDB01__Dashboard__chartMedium tspan:nth-child(1)").attr('style', 'font-size:15px;font-weight:bold;');
        }, 1000);
    }
    if (gId == "ACDB01__Dashboard__chartLow") {
        gChartData.chart.defaultCenterLabel = "7 <br/> Low";
        // gChart.removeEventListener("centerLabelClick",apz.dashboard.drilldownchart);
        // gChart.addEventListener("centerLabelClick", apz.dashboard.drilldownchart);
        gChart.removeEventListener("chartClick", apz.dashboard.drilldownchart);
        gChart.addEventListener("chartClick", apz.dashboard.drilldownchart);
        // gChart.removeEventListener("dataPlotClick",apz.dashboard.drilldownchart);
        // gChart.addEventListener("dataPlotClick", apz.dashboard.drilldownchart);
        setTimeout(function() {
            $("#ACDB01__Dashboard__chartLow tspan:nth-child(1)").attr('style', 'font-size:15px;font-weight:bold;');
        }, 1000);
    }
    if (gId == "ACDB01__Dashboard__exposurechart" || gId == "ACDB01__Dashboard__exposurenocashchart" || gId ==
        "ACDB01__Dashboard__exposureoverallchart") {
        gChart.removeEventListener("chartClick", apz.dashboard.fnExposureOverview);
        gChart.addEventListener("chartClick", apz.dashboard.fnExposureOverview);
    }
}
apz.dashboard.chartDetails = function() {
    debugger;
    var taskPriority
    taskPriority = "high";
    // setTimeout(function() {
    var params = {};
    params.appId = "actf01";
    params.scr = "TaskFlow";
    params.layout = "All";
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = {
        "taskid": taskPriority,
    }
    apz.launchApp(params);
}
apz.dashboard.drilldownchart = function(ev, props) {
    debugger;
    ev.stopPropagation();
    var taskPriority
    if (ev.sender.id == "ACDB01__Dashboard__chartHigh") {
        taskPriority = "high";
    } else if (ev.sender.id == "ACDB01__Dashboard__chartMedium") {
        taskPriority = "medium";
    } else if (ev.sender.id == "ACDB01__Dashboard__chartLow") {
        taskPriority = "low";
    }
    // setTimeout(function() {
    var params = {};
    params.appId = "actf01";
    params.scr = "TaskFlow";
    params.layout = "All";
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = {
        "taskid": taskPriority,
    }
    apz.launchApp(params);
    //}, 200);
}
apz.dashboard.fngotoTaskSummary = function(pthis) {
    debugger;
    //var workflowId = pthis.text.split("_")[2];
    var workflowId = pthis.text;
    var params = {};
    params.appId = "actf01";
    params.scr = "TaskFlow";
    params.layout = "All";
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = {
        "taskid": workflowId,
    }
    apz.launchApp(params);
}
apz.dashboard.fnExposureOverview = function(ev, props) {
    debugger;
    ev.stopPropagation();
    if (ev.sender.id == "ACDB01__Dashboard__exposurechart") {
        apz.data.scrdata.ACDB01__Dashboard_Req.exposureoverviewtbl = {};
        apz.data.scrdata.ACDB01__Dashboard_Req.exposureoverviewtbl = apz.dashboard.exposuretbldata.cashlimitTbl;
    }
    if (ev.sender.id == "ACDB01__Dashboard__exposurenocashchart") {
        apz.data.scrdata.ACDB01__Dashboard_Req.exposureoverviewtbl = {};
        apz.data.scrdata.ACDB01__Dashboard_Req.exposureoverviewtbl = apz.dashboard.exposuretbldata.nocashlimitTbl;
    }
    if (ev.sender.id == "ACDB01__Dashboard__exposureoverallchart") {
        apz.data.scrdata.ACDB01__Dashboard_Req.exposureoverviewtbl = {};
        apz.data.scrdata.ACDB01__Dashboard_Req.exposureoverviewtbl = apz.dashboard.exposuretbldata.overalllimitTbl;
    }
    apz.data.loadData("Dashboard");
}
apz.dashboard.fnOnSelectDays = function() {
    debugger;
    var days = apz.getElmValue("ACDB01__Dashboard__ddl_days");
    if (days == "30 days") {
        apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable = {};
        apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable = apz.dashboard.exposuretbldata.onemonthdata;
        apz.dashboard.fngetdates(30, 5);
        var rowlength = apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable.length;
        for (var i = 0; i < rowlength; i++) {
            apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable[i].date = apz.dashboard.formatdate(datearray[i].date);
        }
    }
    if (days == "90 days") {
        apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable = {};
        apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable = apz.dashboard.exposuretbldata.threemonthdata;
        apz.dashboard.fngetdates(90, 10);
        var rowlength = apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable.length;
        for (var i = 0; i < rowlength; i++) {
            apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable[i].date = apz.dashboard.formatdate(datearray[i].date);
        }
    }
    if (days == "180 days") {
        apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable = {};
        apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable = apz.dashboard.exposuretbldata.sixmonthdata;
        apz.dashboard.fngetdates(180, 20);
        var rowlength = apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable.length;
        for (var i = 0; i < rowlength; i++) {
            apz.data.scrdata.ACDB01__Dashboard_Req.payableandreceivable[i].date = apz.dashboard.formatdate(datearray[i].date);
        }
    }
    apz.data.loadData("Dashboard");
}
apz.dashboard.fngetdates = function(selected, noofdays) {
    datearray = [];
    var startdate = new Date();
    var enddate = new Date(new Date().setDate(new Date().getDate() - selected));
    //var enddate = new Date(new Date().setDate(new Date().getDate()));
    var previousdate = "";
    do {
        previousdate = new Date(startdate.setDate(startdate.getDate() - noofdays));
        //previousdate = new Date(startdate.setDate(startdate.getDate()));
        var obj = {};
        obj.date = previousdate;
        datearray.push(obj);
    }
    while (previousdate >= enddate);
}
apz.dashboard.formatdate = function(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [month, day, year].join('/');
}
