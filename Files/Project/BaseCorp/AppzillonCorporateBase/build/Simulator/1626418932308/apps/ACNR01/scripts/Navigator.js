apz.ACNR01 = {};
apz.ACNR01.Navigator = {};
searchObj = {};
apz.ACNR01.Navigator.speechToText = true;
apz.app.onLoad_Navigator = function() {
    debugger;
    
    $("#ACNR01__Navigator__themeElement").append('<div class="outerColourPl"> <div id="selectedColor"></div> <ul class="dropThemePl sno"><li id="defPlTheme" name="PlTheme" onclick="themeCallFun(0)" value="defPlTheme">Default</li><li id="GreyPlTheme" name="PlTheme" onclick="themeCallFun(2)" value="GreyPlTheme">Grey</li><li id="grnPlTheme" name="PlTheme" onclick="themeCallFun(3)" value="grnPlTheme">Green</li><li id="aquaPlTheme" name="PlTheme" onclick="themeCallFun(1)" value="aquaPlTheme">Aqua</li><li id="purpPlTheme" name="PlTheme" onclick="themeCallFun(4)" value="purpPlTheme">Purple</li></ul></div>');
    
    
    apz.dateFormat = "dd/MM/yyyy";
    if (apz.Login) {
        apz.ACNR01.Navigator.sCorporateId = apz.Login.sCorporateId;
        apz.ACNR01.Navigator.sUserId = apz.Login.sUserId;
    } else {
        apz.ACNR01.Navigator.sCorporateId = "000FTAC4321";
        apz.ACNR01.Navigator.sUserId = "CorpAdmin";
    }
    apz.setElmValue("ACNR01__Navigator__nameContent_txtcnt", "Welcome " + apz.ACNR01.Navigator.sUserId);
    if (apz.ACNR01.Navigator.sCorporateId == "WARBUCKS") {
        var src = $("#ACNR01__Navigator__corp_image").attr("src").replace("Acme-corp.png", "Warbucks-Industries1.png");
        $("#ACNR01__Navigator__corp_image").attr("src", src);
    }
    $("#ACNR01__Navigator__corp_user_txtcnt").text(apz.Login.sUserName);
    //apz.ACNR01.Navigator.testinterface();
    apz.ACNR01.Navigator.fetchRolesScreens();
    //apz.ACNR01.Navigator.fetchUserFav();
    $("#ACNR01__Navigator__el_btn_2").click(function() {
        apz.data.loadData("FetchUserFavourites", "ACNR01");
    });
    /*$(document).on("click", function(event) {
        if ($(event.target).closest('#ACNR01__Navigator__dynamicMenu').length == 0 && event.target.nodeName != "use" && event.target.nodeName !=
            "svg") {
            if ($("#sidebar").hasClass('apz-nav-open')) {
                apz.closeSidebar();
            }
        }
    });
    */
    $("#header").on("click", function(event) {
        if ($(event.target).closest('#ACNR01__Navigator__el_btn_1').length == 0) {
            if ($("#sidebar").hasClass('apz-nav-open')) {
                apz.closeSidebar();
            }
        }
    });
    new PerfectScrollbar(document.getElementById("sidebar"));
    $(".line").remove();
    $(".lineR").remove();
    searchObj = SearchChat.create();
};
/*apz.ACNR01.Navigator.changeBtn = function(pThis) {
    debugger;
    var lRow = $(pThis).attr('rowno');
    var lOpen = $(pThis).find(".iup").hasClass("sno");
    //apz.ACNR01.Navigator.deleteExtraRows(lRow);
    $("#ACNR01__Navigator__MenuList").find(".iup").addClass('sno');
    $("#ACNR01__Navigator__MenuList").find(".idown").removeClass('sno'); 
    if (lOpen) {
        $(pThis).find(".iup").removeClass("sno");
        $(pThis).find(".idown").addClass("sno");
       // var lSubmenuLength = apz.data.scrdata.ACNR01__FetchRoleScreens_Res.menuheader[lRow].submenu.length;
        for (var i = 0; i < lSubmenuLength; i++) {
            $("#ACNR01__Navigator__subMenuList_row_" + i).removeClass('sno');
        }
    } else {
        $(pThis).find(".iup").addClass("sno");
        $(pThis).find(".idown").removeClass("sno");
    }
};*/
/*apz.ACNR01.Navigator.deleteExtraRows = function(pRowno){
    debugger;
  //var lSubmenuLength = apz.data.scrdata.ACNR01__FetchRoleScreens_Res.menuheader[pRowno].submenu.length
    var length = $("#ACNR01__Navigator__subMenuList>ul>li").length;
        //alert("clear data "+length);
        //var lStartDeleteIdx = lSubmenuLength-1;
        if(lSubmenuLength<length){ 
        for (var i = lSubmenuLength; i < length; i++) {
            apz.data.deleteRow("ACNR01__Navigator__subMenuList", i);
        }
        }
}*/
apz.app.preRowClicked = function(containerId, rowNo, event) {
    event.stopPropagation();
    if (containerId == "ACNR01__Navigator__MenuList") {
        var length = $("#ACNR01__Navigator__subMenuList>ul>li").length;
        //alert("clear data "+length);
        for (var i = 0; i < length; i++) {
            apz.data.deleteRow("ACNR01__Navigator__subMenuList", i);
        }
    }
}
apz.ACNR01.Navigator.fetchRolesScreens = function() {
    debugger;
    if (!apz.mockServer) {
        var lReqJson = {};
        lReqJson.vwMenu = {};
        lReqJson.vwMenu.corporateId = "000FTAC4321";
        lReqJson.vwMenu.roleId = apz.Login.sRoleId;
        var lServerParams = {
            "ifaceName": "MenuList_Query",
            "buildReq": "N",
            "req": lReqJson,
            "paintResp": "Y",
            "async": "true",
            "callBack": apz.ACNR01.Navigator.fetchRolesScreensQueryCB,
            "callBackObj": "",
        };
        var req = {};
        lServerParams.req = lReqJson;
        apz.server.callServer(lServerParams);
    } else {
        var lScr = "Dashboard";
        if (apz.ACNR01.Navigator.sUserId == "CorpUser") {
            apz.data.loadJsonData("CORPUSER", 'ACNR01');
            lScr = "Dashboard";
        } else if (apz.ACNR01.Navigator.sUserId == "CorpUser2") {
            apz.data.loadJsonData("CORPUSER2", 'ACNR01');
            lScr = "Dashboard";
        } else if (apz.ACNR01.Navigator.sUserId == "bernard.wilkes" || apz.ACNR01.Navigator.sUserId == "josh.ackerman") {
            apz.data.loadJsonData("CORPADMIN", 'ACNR01');
            lScr = "AdminDashboard";
        } else if (apz.ACNR01.Navigator.sUserId == "robert.langford") {
            lScr = "Dashboard";
            apz.data.loadJsonData("CORPSNRMGT", 'ACNR01');
        } else if (apz.ACNR01.Navigator.sUserId == "mike.smith") {
            lScr = "Dashboard";
            apz.data.loadJsonData("CORPCASHMGMT", 'ACNR01');
        } else if (apz.ACNR01.Navigator.sUserId == "abdul.hamid") {
            apz.data.loadJsonData("CORPADMIN", 'ACNR01');
            lScr = "AdminDashboard";
        } else if (apz.ACNR01.Navigator.sUserId == "mohammad.nawaz") {
            apz.data.loadJsonData("CORPSNRMGT", 'ACNR01');
            lScr = "Dashboard";
        } else {
            apz.data.loadJsonData("CORPADMIN", 'ACNR01');
            lScr = "AdminDashboard";
        }
        debugger;
        let menuTree = fnBuildChildJSON(apz.data.scrdata.ACNR01__MenuList_Req.vwMenu);
        let menues = apz.ACNR01.Navigator.getDynamicMenues(menuTree);
        apz.ACNR01.Navigator.appendDynamicMenues(menues, "ACNR01__Navigator__dynamicMenu");
        apz.ACNR01.Navigator.fetchUserFav();
        apz.ACNR01.Navigator.queryTasks();
        try {
            // var lFirstApp = apz.data.scrdata.ACNR01__FetchRoleScreens_Res.menuheader[0].submenu[0];
            // var lAppId = lFirstApp.appId;
            // var lScr = lFirstApp.screenId;
            // var lLayout = "All";
            // var lDesc = lFirstApp.description;
            var lAppId = "ACDB01";
            //var lScr = "Dashboard";
            var lLayout = "All";
            var lDesc = "";
            apz.ACNR01.Navigator.launchApp(lAppId, lScr, lLayout, lDesc);
        } catch (e) {
            console.log("Menu not available");
        }
    }
    /*let menuTree = fnBuildChildJSON(apz.data.scrdata.ACNR01__MenuList_Res.vwMenu);
    let menues = apz.ACNR01.Navigator.getDynamicMenues(menuTree);
    apz.ACNR01.Navigator.appendDynamicMenues(menues, "ACNR01__Navigator__dynamicMenu");
    try {
        var lFirstApp = apz.data.scrdata.ACNR01__FetchRoleScreens_Res.menuheader[0].submenu[0];
        var lAppId = lFirstApp.appId;
        var lScr = lFirstApp.screenId;
        var lLayout = "All";
        var lDesc = lFirstApp.description;
        apz.ACNR01.Navigator.launchApp(lAppId, lScr, lLayout, lDesc);
    } catch (e) {
        console.log("Menu not available");
    }*/
    $("#ACNR01__Navigator__subMenuList li").attr("draggable", "true");
    $("#ACNR01__Navigator__subMenuList li").attr("ondragstart", "apz.ACNR01.Navigator.drag(event,this)");
    // }
};
apz.ACNR01.Navigator.fetchUserFav = function() {
    var lServerParams = {
        "ifaceName": "FetchUserFavourites",
        "appId": "ACNR01",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ACNR01.Navigator.fetchUserFavCB,
        "callBackObj": "",
    };
    var req = {};
    req.corporateId = apz.ACNR01.Navigator.sCorporateId;
    req.userId = apz.ACNR01.Navigator.sUserId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.ACNR01.Navigator.fetchUserFavCB = function(params) {
    debugger;
    if (params.status) {
        if (params.resFull.appzillonHeader.status) {
            apz.data.loadData("FetchUserFavourites", "ACNR01");
        } else {
            if (params.errors[0].errorMessage == "No Data Found.") {
                $("#ACNR01__Navigator__favList li").addClass("ssp");
                apz.data.scrdata.ACNR01__FetchUserFavourites_Res = [];
            }
        }
    }
    $("#ACNR01__Navigator__favList li").attr("draggable", "true");
    $("#ACNR01__Navigator__favList li").attr("ondragstart", "apz.ACNR01.Navigator.favdrag(event,this)");
    // apz.ACNR01.Navigator.changeBtn($("#ACNR01__Navigator__MenuList_row_0"));
};
// add by Rahul
var fnBuildChildJSON = function(lResult) {
    debugger;
    tree = listToTree(lResult, {
        idKey: 'description',
        parentKey: 'groupName',
        childrenKey: 'child'
    });
    debugger;
    return tree;
};
//add by rahul
var listToTree = function(data, options) {
    debugger;
    options = options || {};
    var ID_KEY = options.idKey || 'id';
    var PARENT_KEY = options.parentKey || 'parent';
    var CHILDREN_KEY = options.childrenKey || 'children';
    var item, id, parentId;
    var map = {};
    for (var i = 0; i < data.length; i++) {
        if (data[i][ID_KEY]) {
            map[data[i][ID_KEY]] = data[i];
            data[i][CHILDREN_KEY] = [];
        }
    }
    for (var i = 0; i < data.length; i++) {
        if (data[i][PARENT_KEY]) { // is a child
            if (map[data[i][PARENT_KEY]]) // for dirty data
            {
                map[data[i][PARENT_KEY]][CHILDREN_KEY].push(data[i]); // add child to parent
                data.splice(i, 1); // remove from root
                i--; // iterator correction
            } else {
                // 	data[i][PARENT_KEY] = 0; // clean dirty data
            }
        }
    };
    return data;
}
//add by Rahul 
apz.ACNR01.Navigator.getDynamicMenues = function(menuArray) {
    debugger;
    var listOfMenues = "<div class='menuTree'> <ul class='topnav crt-acmn crb-acmn pri  mic icp'>";
    for (var i = 0; i < menuArray.length; i++) {
        listOfMenues = generateDynamicMenu(menuArray[i], listOfMenues);
    }
    return listOfMenues + "</ul></div>";
}
//Add by Rahul
var generateDynamicMenu = function(element, listOfMenues) {
    debugger;
    listOfMenues += "<li id='" + apz.currAppId + "__Menu__ct_mnu_1_" + element.description +
        "_li' class= ' '><a href= 'javascript:;' class= ''><span><svg id='" + apz.currAppId + "__Menu__ct_mnu_1_" + element.description + "_menu_" +
        element.icon + " ' class='icon " + element.icon + " px20'><use xlink:href='#" + element.icon + "'></use></svg></span>" + element.description +
        "<span id='appId' class='sno'>" + element.appId + "</span><span id='screen_id' class='sno' >" + element.screenId + "</span>";
    if (element.child != null && element.child != "") {
        listOfMenues += "</a> <ul id='" + apz.currAppId + "__Menu__ct_mnu_1_" + element.description + "_ul' class='' style='display: none;'>";
        for (let i = 0; i < element.child.length; i++) {
            element.child[i].icon = "icon-TD-right-arrow";
            listOfMenues = generateDynamicMenu(element.child[i], listOfMenues);
        }
    } else {
        return listOfMenues += "</a></li>";
    }
    return listOfMenues += "</ul></li>";
}
//add by rahul
apz.ACNR01.Navigator.appendDynamicMenues = function(menues, parentId) {
    debugger;
    document.getElementById(parentId).innerHTML = menues;
    $("#" + parentId).accordion({
        accordion: false,
        closedSign: "<svg class='icon  icon-accordion-down px12' aria-hidden='true'><use xlink:href='#icon-accordion-down'></use></svg>",
        openedSign: "<svg class='icon  icon-accordion-down px12' aria-hidden='true'><use xlink:href='#icon-accordion-down'></use></svg>",
        speed: 500
    });
    $("#" + parentId + " li").bind("click", apz.ACNR01.Navigator.menuClick);
    /*setTimeout(function() {
        if ($("#sidebar li:first").find('ul:first').length != 0) {
            $("#sidebar li:first").find('ul:first').find("li:first").trigger("click");
            $("#sidebar li:first").find('ul:first').slideDown('slow');
        } else $("#sidebar li:first").trigger("click");
    }, 200);*/
}
apz.ACNR01.Navigator.fetchRolesScreensQueryCB = function(pResp) {
    debugger;
    if (pResp.status) {
        if (pResp.resFull.appzillonHeader.status) {
            //$("#ACNR01__Navigator__MenuList_row_0").trigger('click');
            //$("#ACNR01__Navigator__subMenuList_row_0").trigger('click');
            apz.ACNR01.Navigator.queryTasks();
            try {
                var lFirstApp = apz.data.scrdata.ACNR01__MenuList_Res.vwMenu[0];
                var lAppId = lFirstApp.appId;
                var lScr = lFirstApp.screenId;
                var lLayout = "All";
                var lDesc = lFirstApp.description;
                if (apz.ACNR01.Navigator.sUserId == "bernard.wilkes" && apz.deviceGroup == "Mobile") {
                    var lAppId = "actf01";
                    var lScr = "TaskFlow";
                    var lLayout = "All";
                    var lDesc = "My Task";
                }
                apz.ACNR01.Navigator.launchApp(lAppId, lScr, lLayout, lDesc);
            } catch (e) {
                console.log("Menu not available");
            }
            $("#ACNR01__Navigator__subMenuList li").attr("draggable", "true");
            $("#ACNR01__Navigator__subMenuList li").attr("ondragstart", "apz.ACNR01.Navigator.drag(event,this)");
        } else {}
        //add by Rahul
        if (pResp.res.ACNR01__MenuList_Res.vwMenu !== null) {
            if (apz.ACNR01.Navigator.sUserId == "mike.smith" && apz.deviceGroup != "Mobile") {
                var ldata = pResp.res.ACNR01__MenuList_Res.vwMenu;
                for (var i = 0; i < ldata.length; i++) {
                    if (ldata[i].appId == "chkdpt") {
                        ldata.splice(i, 1);
                        pResp.res.ACNR01__MenuList_Res.vwMenu = ldata;
                        break;
                    }
                }
            }
            if (apz.ACNR01.Navigator.sUserId == "bernard.wilkes") {
                var ldata = pResp.res.ACNR01__MenuList_Res.vwMenu;
                for (var i = 0; i < ldata.length; i++) {
                    if (ldata[i].appId == "subact") {
                        ldata.splice(i, 1);
                        pResp.res.ACNR01__MenuList_Res.vwMenu = ldata;
                        break;
                    }
                }
            }
            if (apz.ACNR01.Navigator.sUserId == "josh.ackerman") {
                var ldata = pResp.res.ACNR01__MenuList_Res.vwMenu;
                for (var i = 0; i < ldata.length; i++) {
                    if (ldata[i].appId == "authma") {
                        ldata.splice(i, 1);
                        pResp.res.ACNR01__MenuList_Res.vwMenu = ldata;
                    }
                }
            }
            
             if (apz.deviceGroup == "Mobile") {
                var ldata = pResp.res.ACNR01__MenuList_Res.vwMenu;
                for (var i = 0; i < ldata.length; i++) {
                    if (ldata[i].screenId == "CommitmentList" || ldata[i].screenId == "ACHInputPage" || ldata[i].screenId == "AddBiller" || ldata[i].screenId == "ScheduledPayments" || ldata[i].screenId == "liquidityMgmt" || ldata[i].screenId == "DemandDraft" || ldata[i].screenId == "ReversePositivePay" || ldata[i].screenId == "DocumentUpload" || ldata[i].screenId == "BulkTransfers") {
                        ldata.splice(i, 1);
                        i--;
                        pResp.res.ACNR01__MenuList_Res.vwMenu = ldata;
                       
                    }
                }
            }
            let menuTree = fnBuildChildJSON(pResp.res.ACNR01__MenuList_Res.vwMenu);
            let menues = apz.ACNR01.Navigator.getDynamicMenues(menuTree);
            apz.ACNR01.Navigator.appendDynamicMenues(menues, "ACNR01__Navigator__dynamicMenu");
            debugger;
        }
    }
    // apz.ACNR01.Navigator.changeBtn($("#ACNR01__Navigator__MenuList_row_0"));
};
apz.ACNR01.Navigator.menuClick = function(pObj, event) {
    $(".line").remove();
    $(".lineR").remove();
    debugger
    if (pObj.id) {
        if (pObj.id.indexOf("favList") > 0) {
            var popupParentid = $("#ACNR01__Navigator__favPopup").parents()[1];
            $("#" + popupParentid.id).attr("style", "display:none;");
        }
    }
    /*;
    if ($("#ACNR01__Navigator__favList").length == 1) {
       // $("#ACNR01__Navigator__el_btn_2").trigger("click");
    }
    $("#ACNR01__Navigator__launchPad").html("");
    if ($(pObj).attr("id").indexOf("favList") > -1) {
        var lType = "MICROAPP";
        var lAppId = $(pObj).find("span[id*='app_id']").text();
        var lScr = $(pObj).find("span[id*='screen_id']").text();
        var lLayout = "All";
        var lDesc = $(pObj).find("span[id*='description']").text();
    } else {
        var lType = "MICROAPP";
        var lAppId = $(pObj).find("span[id*='appId']").text();
        var lScr = $(pObj).find("span[id*='screenId']").text();
        var lLayout = "All";
        var lDesc = $(pObj).find("span[id*='description']").text();
    }*/
    // var lOrder = $(pObj).find("span[id*='displayOrder']").text();
    debugger;
    var frstAnchor = $(this).find("a")[0];
    var lScr = $(frstAnchor).find("span[id*='screen_id']").text();
    var lAppId = $(frstAnchor).find("span[id*='appId']").text();
    var lLayout = "All";
    var lDesc = lScr;
    try {
        if ($(pObj).attr("id").indexOf("favList") > -1) {
            $("#ACNR01__Navigator__launchPad").html("");
            var lType = "MICROAPP";
            lAppId = $(pObj).find("span[id*='app_id']").text();
            lScr = $(pObj).find("span[id*='screen_id']").text();
            lLayout = "All";
            lDesc = $(pObj).find("span[id*='description']").text();
        }
    } catch (e) {}
    if (lAppId != "" && lScr != "") {
        apz.ACNR01.Navigator.launchApp(lAppId, lScr, lLayout, lDesc);
    } else {}
};
apz.ACNR01.Navigator.launchApp = function(lAppId, lScr, lLayout, lDesc) {
    debugger;
    $("body").removeClass("dbcls");
    var params = {};
    params.appId = lAppId;
    params.scr = lScr;
    params.layout = lLayout;
    params.description = lDesc;
    if (apz.deviceGroup == "Mobile") {
        if (lScr == "Dashboard") {
            params.scr = "DashboardMobile";
        }
        if (lScr == "TaskFlow") {
            params.layout = "All";
            params.scr = "TaskFlowMobile";
        }
        if (lScr == "StandingInstructions" || lScr == "Messages" || lScr == "BillPaymentSummary" || lScr == "notification" || lScr == "Cards" || lScr ==
            "Beneficiary" || lScr == "ExchangeRate" || lScr == "CardlessCash" || lScr == "CreditLimitsList" || lScr == "Transfers" ||lScr == "FundTransferHistory") {
            params.layout = "Mobile";
        }
    }
    if (lScr == "ImportLC" || lScr == "Guarantees" || lScr == "BillCollections") {
        params.scr = "LCSummary";
        params.userObj = {
            "from": lScr
        }
    }
    if (lScr == "LoanCreation") {
        params.scr = "Summary";
    }
    if (lScr == "RollOver") {
        params.appId = "lonact";
        params.scr = "Summary";
    }
    //standingInstruction mobile layout to launch
    // if(lScr == "StandingInstructions"){
    //     delete params.layout;
    // }
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    if (apz.ACNR01.Navigator.sUserId == "CUST01" && params.scr == "Home") {
        $('body').addClass('bgcolor3')
        var lAppNo = Math.floor(Math.random() * 90 + 10);
        lAppNo = "000024554AA22" + lAppNo;
        params.userObj = {
            "appNo": lAppNo,
            "action": "New"
        }
    } else if (apz.ACNR01.Navigator.sUserId == "RM01" && params.scr == "Home") {
        $('body').addClass('bgcolor3')
        var lAppNo = Math.floor(Math.random() * 90 + 10);
        lAppNo = "000024554AA22" + lAppNo;
        params.userObj = {
            "appNo": lAppNo,
            "action": "New"
        }
    } else if (apz.ACNR01.Navigator.sUserId == "BR01" && params.scr == "Home") {
        $('body').addClass('bgcolor3')
        var lAppNo = Math.floor(Math.random() * 90 + 10);
        lAppNo = "000024554AA22" + lAppNo;
        params.userObj = {
            "appNo": lAppNo,
            "action": "New"
        }
    } else {
        $('body').removeClass('bgcolor3');
    }
    apz.launchApp(params);
    if ($("#sidebar").hasClass("apz-nav-open")) {
        apz.toggleSidebar(document.getElementById("ACNR01__Navigator__el_btn_1"));
    }
}
apz.ACNR01.Navigator.logout = function() {
    apz.data.scrdata = {};
    apz.ACNR01 = undefined;
    var params = {};
    params.appId = "ACLI01";
    params.scr = "Login";
    params.layout = "Web";
    params.userObj = {
        "language": apz.appLanguage
    }
    if (apz.deviceGroup == "Mobile") {
        params.layout = "Mobile";
    }
    apz.launchApp(params);
};
apz.ACNR01.Navigator.drag = function(pevent, pthis) {
    debugger;
    var lhtml = $(pthis).closest("li")[0].outerHTML;
    var lfavData = $($("#ACNR01__Navigator__favBtn").data("bs.popover").tip());
    var lText = $(pthis).closest("li")[0].innerText;
    var lFavAlreadyAdded = false;
    if (apz.data.scrdata.ACNR01__FetchUserFavourites_Res.length < 5) {
        for (var i = 0; i < lfavData.find("#ACNR01__Navigator__favList li").length; i++) {
            var lFavText = $(lfavData.find("#ACNR01__Navigator__favList li")[i]).find("span[id*='description']").text();
            if (lFavText == lText) {
                lFavAlreadyAdded = true;
                break;
            }
        }
        if (!lFavAlreadyAdded) {
            var lServerParams = {
                "ifaceName": "SaveUserFavourites_New",
                "buildReq": "N",
                "appId": "ACNR01",
                "req": "",
                "paintResp": "Y",
                "async": "true",
                "callBack": apz.ACNR01.Navigator.fnStoreUserFavouritesCB,
                "callBackObj": "",
            };
            var req = {};
            req.tbDbmiCorpUserFavourite = {};
            req.tbDbmiCorpUserFavourite.corporateId = apz.ACNR01.Navigator.sCorporateId;
            req.tbDbmiCorpUserFavourite.userId = apz.ACNR01.Navigator.sUserId;
            req.tbDbmiCorpUserFavourite.screenId = $(pthis).closest("li").find("span[id*='screenId']").text();
            req.tbDbmiCorpUserFavourite.appId = $(pthis).closest("li").find("span[id*='appId']").text();
            req.tbDbmiCorpUserFavourite.description = $(pthis).closest("li").find("span[id*='description']").text();
            lServerParams.req = req;
            apz.server.callServer(lServerParams);
        }
    } else {
        var msg = {
            'code': 'NAV-E-FAV'
        };
        apz.dispMsg(msg);
    }
    pevent.preventDefault();
};
apz.ACNR01.Navigator.fnStoreUserFavouritesCB = function(params) {
    debugger;
    if (params.status) {
        if (params.resFull.appzillonHeader.status) {
            apz.ACNR01.Navigator.fetchUserFav();
            $("#ACNR01__Navigator__favBtn").effect("shake", {
                "direction": "up",
                "times": 2
            }, 1500)
        } else {}
    }
};
apz.ACNR01.Navigator.favdrag = function(pevent, pthis) {
    debugger;
    var lServerParams = {
        "ifaceName": "SaveUserFavourites_Delete",
        "buildReq": "N",
        "appId": "ACNR01",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.ACNR01.Navigator.fnDeleteUserFavouritesCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserFavourite = {};
    req.tbDbmiCorpUserFavourite.corporateId = apz.ACNR01.Navigator.sCorporateId;
    req.tbDbmiCorpUserFavourite.userId = apz.ACNR01.Navigator.sUserId;
    req.tbDbmiCorpUserFavourite.screenId = $(pthis).closest("li").find("span[id*='screenId']").text();
    req.tbDbmiCorpUserFavourite.appId = $(pthis).closest("li").find("span[id*='appId']").text();
    req.tbDbmiCorpUserFavourite.description = $(pthis).closest("li").find("span[id*='description']").text();
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.ACNR01.Navigator.fnDeleteUserFavouritesCB = function(params) {
    debugger;
    if (params.status) {
        if (params.resFull.appzillonHeader.status) {
            apz.ACNR01.Navigator.fetchUserFav();
        } else {}
    }
};
apz.ACNR01.Navigator.queryTasks = function() {
    var lServerParams = {
        "ifaceName": "FetchTaskFlowDetails",
        "appId": "ACNR01",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.ACNR01.Navigator.taskFlowQueryCB,
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
};
apz.ACNR01.Navigator.taskFlowQueryCB = function(pResp) {
    debugger;
    try {
        var gtasklist = [];
        for (var i = 0; i < 7; i++) {
            gtasklist.push(apz.data.scrdata.ACNR01__FetchTaskFlowDetails_Res.TaskSummary[i]);
        }
        var lTaskArray = gtasklist;
        lTaskArray.unshift({
            referenceId: "Bill Payment",
            workflowName: "Payment is due for bill no. 4519872000 on 01/09/2019 for USD 245.00"
        }, {
            referenceId: "Credit Card Payment",
            workflowName: "Payment due for card no. XXXX-XXXX-XXXX-9876 on 04/09/2019 for USD 250.00"
        }, {
            referenceId: "Bill Payment",
            workflowName: "Payment due for bill no. 4519872321 on 05/09/2019 for USD 285.00"
        });
        apz.data.scrdata.ACNR01__FetchTaskFlowDetails_Res = {};
        apz.data.scrdata.ACNR01__FetchTaskFlowDetails_Res.TaskSummary = lTaskArray;
        apz.data.loadData("FetchTaskFlowDetails", "ACNR01");
        var lTasksArr = lTaskArray;
        var lTaskArrLength = lTasksArr.length;
        apz.setElmValue("ACNR01__Navigator__notif_count", lTaskArrLength);
    } catch (e) {}
    $("#ACNR01__Navigator__el_icn_1").on("click", function() {
        $("#ACNR01__Navigator__notif_count").addClass("sno")
    });
    apz.ACNR01.Navigator.fetchUserFav();
}
apz.ACNR01.Navigator.gotoDashboard = function() {
    var params = {};
    params.appId = "ACDB01";
    params.scr = "Dashboard";
    params.layout = "All";
    if (apz.deviceGroup == "Mobile") {
        params.scr = "DashboardMobile";
    }
    if (apz.ACNR01.Navigator.sUserId == "bernard.wilkes") {
        params.scr = "AdminDashboard";
    }
    //params.description = lDesc;
    // params.displayOrder = lOrder;
    params.div = "ACNR01__Navigator__launchPad";
    apz.launchApp(params);
}
apz.ACNR01.Navigator.testinterface = function() {
    debugger;
    var lServerParams = {
        "ifaceName": "GetRolescreen_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.ACNR01.Navigator.testinterfaceCB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}
apz.ACNR01.Navigator.testinterfaceCB = function(params) {
    debugger;
    var lServerParams = {
        "ifaceName": "GetBeneficiary_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.ACNR01.Navigator.testinterface1CB,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
}
apz.ACNR01.Navigator.testinterface1CB = function(parama) {
    debugger;
}
apz.ACNR01.Navigator.fnSearch = function() {
    debugger;
    $("#ACNR01__Navigator__omnisearchrow").addClass("sno");
    var message = $("#ACNR01__Navigator__searchbox").val();
    if (message != "" && message != undefined) {
        apz.startLoader();
        searchObj.fetch(message, apz.ACNR01.Navigator.fnSearchCB);
    } else {
        apz.dispMsg({
            "message": "Enter the text to search",
            type: "E"
        });
    }
}
apz.ACNR01.Navigator.fnSearchCB = function(resp) {
    debugger;
    apz.stopLoader();
    if (resp.status && resp.res.ACNR01__SearchChat_Res.status) {
        intentData = resp.res.ACNR01__SearchChat_Res.search;
        intent = resp.res.ACNR01__SearchChat_Res.search.intent;
        apz.ACNR01.Navigator.fnClear();
        apz.ACNR01.Navigator.fnLaunchOmniSearch(intent, intentData);
        //apz.ACNR01.Navigator.sparams.callBack(intent,intentData);
    } else {
        apz.dispMsg({
            message: "Please try again",
            type: "E"
        });
    }
};
apz.ACNR01.Navigator.fnClear = function() {
    debugger;
    // $(commonId+"mic_ul").removeClass("sno");
    //$(commonId+"clear_ul").addClass("sno");
    $("#ACNR01__Navigator__searchbox").val("");
};
apz.app.postGetHeader = function(header) {
    if (header.interfaceId == "ACNR01__SearchChat") {
        header.userId = '123456';
    } else {
        if (apz.Login.sUserId != "") {
            header.userId = "000FTAC4321__" + apz.Login.sUserId;
        }
    }
    return header;
}
apz.ACNR01.Navigator.fnLaunchOmniSearch = function(intent, intentData) {
    debugger;
    var appId, scr;
    var uerObj = {
        "entities": intentData,
        "from": "OmniSearch"
    };
    switch (intent) {
        case "billpayment":
            appId = "bllpay";
            scr = "BillPaymentSummary";
            break;
        case "transfer":
            appId = "acft01";
            scr = "Transfers";
            // userObj.message = searchObj.message;
            //userObj.userId = LandingCommon.getLoggedInUser();
            break;
        case "openaccount":
            appId = "acdp01";
            scr = "DepositLauncher";
            // userObj.message = searchObj.message;
            //userObj.userId = LandingCommon.getLoggedInUser();
            break;
    }
    var params = {};
    params.appId = appId;
    params.scr = scr;
    params.layout = "All";
    params.description = "";
    params.div = "ACNR01__Navigator__launchPad";
    params.userObj = uerObj;
    if (apz.deviceGroup == "Mobile") {
        if (scr == "BillPaymentSummary") {
            params.layout = "Mobile";
        }
    }
    apz.launchApp(params);
}
apz.ACNR01.Navigator.fnSpeechToText = function() {
    debugger;
    if (apz.ACNR01.Navigator.speechToText) {
        apz.ACNR01.Navigator.speechToText = false;
        var json = {};
        json.id = "NATIVE";
        json.action = "speechToText";
        json.callBack = apz.ACNR01.Navigator.fnSpeechToTextCB;
        apz.ns.nativeServiceExt(json);
    }
}
apz.ACNR01.Navigator.fnSpeechToTextCB = function(params) {
    debugger;
    apz.ACNR01.Navigator.speechToText = true;
    $("#ACNR01__Navigator__searchbox").val(params.speechResult);
    $("#ACNR01__Navigator__searchicon_ul").removeClass("sno");
    $("#ACNR01__Navigator__micicon_ul").addClass("sno");
    //$(commonId+"mic_ul").addClass("sno");
    //$(commonId+"clear_ul").removeClass("sno");
}
apz.ACNR01.Navigator.fnShowMobOmniSearchbox = function() {
    debugger;
    apz.dispMsg({
        "message": "Omnisearch service is not available",
        "type":"I"
    })
    // $("#ACNR01__Navigator__omnisearchrow").removeClass("sno");
    // $("#ACNR01__Navigator__searchicon_ul").addClass("sno");
    // $("#ACNR01__Navigator__micicon_ul").removeClass("sno");
}
apz.ACNR01.Navigator.fnShowHideIcons = function() {
    debugger;
    var plength = $("#ACNR01__Navigator__searchbox").val().length;
    if (plength == 0) {
        $("#ACNR01__Navigator__searchicon_ul").addClass("sno");
        $("#ACNR01__Navigator__micicon_ul").removeClass("sno");
    } else {
        $("#ACNR01__Navigator__searchicon_ul").removeClass("sno");
        $("#ACNR01__Navigator__micicon_ul").addClass("sno");
    }
}
