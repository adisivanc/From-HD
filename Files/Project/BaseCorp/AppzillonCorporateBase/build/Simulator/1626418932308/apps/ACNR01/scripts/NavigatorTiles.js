apz.ACNR01 = {};
apz.ACNR01.Navigator = {};
apz.ACNR01.Navigator.sMenuJSON = {};
apz.app.onLoad_Navigator = function() {
    debugger;
    if (apz.Login) {
        apz.ACNR01.Navigator.sCorporateId = apz.Login.sCorporateId;
        apz.ACNR01.Navigator.sUserId = apz.Login.sUserId;
    } else {
        apz.ACNR01.Navigator.sCorporateId = "000FTAC4321";
        apz.ACNR01.Navigator.sUserId = "CorpAdmin";
    }
    apz.setElmValue("ACNR01__Navigator__nameContent_txtcnt", "Welcome " + apz.ACNR01.Navigator.sUserId);
    apz.ACNR01.Navigator.fetchRolesScreens();
    //apz.ACNR01.Navigator.fetchUserFav();
    $("#ACNR01__Navigator__el_btn_2").click(function() {
        apz.data.loadData("FetchUserFavourites", "ACNR01");
    });
    $(document).on("click", function(event) {
        if ($(event.target).closest('#ACNR01__Navigator__dynamicMenu').length == 0 && event.target.nodeName != "use" && event.target.nodeName !=
            "svg") {
            if ($("#sidebar").hasClass('apz-nav-open')) {
                apz.closeSidebar();
            }
        }
    });
    $("#header").on("click", function(event) {
        if ($(event.target).closest('#ACNR01__Navigator__el_btn_1').length == 0) {
            if ($("#sidebar").hasClass('apz-nav-open')) {
                apz.closeSidebar();
            }
        }
    });
    new PerfectScrollbar(document.getElementById("sidebar"));
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
        var llResJSON = {};
        if (apz.ACNR01.Navigator.sUserId == "CorpUser") {
            var lResJSONStr = apz.getFile(apz.getDataFilesPath("ACNR01") + "/CORPUSER.json");
            llResJSON = JSON.parse(lResJSONStr);
        } else if (apz.ACNR01.Navigator.sUserId == "CorpUser2") {
            var lResJSONStr = apz.getFile(apz.getDataFilesPath("ACNR01") + "/CORPUSER2.json");
            llResJSON = JSON.parse(lResJSONStr);
        } else {
            var lResJSONStr = apz.getFile(apz.getDataFilesPath("ACNR01") + "/CORPADMIN.json");
            llResJSON = JSON.parse(lResJSONStr);
        }
        var lViewMenu = llResJSON.ACNR01__MenuList_Req.vwMenu;
        var lViewMenuGroup = []
        for (var lIndex in lViewMenu) {
            var lObj = lViewMenu[lIndex];
            if (lObj.groupName == "") {
                lViewMenuGroup.push(lObj);
            }
        }
        apz.data.scrdata.ACNR01__MenuList_Req = {};
        apz.data.scrdata.ACNR01__MenuList_Req.vwMenu = [];
        apz.data.scrdata.ACNR01__MenuList_Req.vwMenu = lViewMenuGroup;
        apz.data.loadData("MenuList", "ACNR01");
        $("#ACNR01__Navigator__td_menu_row_0").trigger("click");
        /*let menuTree = fnBuildChildJSON(apz.data.scrdata.ACNR01__MenuList_Res.vwMenu);
	        let menues = apz.ACNR01.Navigator.getDynamicMenues(menuTree);
	    	apz.ACNR01.Navigator.appendDynamicMenues(menues,"ACNR01__Navigator__dynamicMenu");*/
    }
    /* try {
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
    var listOfMenues = "<div class='crt-vmnu crt-list chl-ctr pointer tsp'> <ul class='tsp'>";
    for (var i = 0; i < menuArray.length; i++) {
        listOfMenues = generateDynamicMenu(menuArray[i], listOfMenues);
    }
    return listOfMenues + "</ul></div>";
}
//Add by Rahul
var generateDynamicMenu = function(element, listOfMenues) {
    listOfMenues += "<li id='" + apz.currAppId + "__Menu__ct_mnu_1_" + element.description +
        "_li' class= ' '><a href= 'javascript:;' class= ''><span><svg id='" + apz.currAppId + "__Menu__ct_mnu_1_" + element.description + "_menu_" +
        element.icon + " ' class='icon " + element.icon + " px20'><use xlink:href='#" + element.icon + "'></use></svg></span>" + element.description +
        "<span id='appId' class='sno'>" + element.appId + "</span><span id='screen_id' class='sno' >" + element.screenId + "</span>";
    if (element.child != null && element.child != "") {
        listOfMenues += "</a> <ul id='" + apz.currAppId + "__Menu__ct_mnu_1_" + element.description + "_ul' class='' style='display: none;'>";
        for (let i = 0; i < element.child.length; i++) {
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
        closedSign: "<svg class='icon icon-downarrow px12' aria-hidden='true'><use xlink:href='#icon-downarrow'></use></svg>",
        openedSign: "<svg class='icon icon-uparrow px12' aria-hidden='true'><use xlink:href='#icon-uparrow'></use></svg>",
        speed: 500
    });
    $("#" + parentId + " li").bind("click", apz.ACNR01.Navigator.menuClick);
    setTimeout(function() {
        if ($("#sidebar li:first").find('ul:first').length != 0) {
            $("#sidebar li:first").find('ul:first').find("li:first").trigger("click");
            $("#sidebar li:first").find('ul:first').slideDown('slow');
        } else $("#sidebar li:first").trigger("click");
    }, 200);
}
apz.ACNR01.Navigator.fetchRolesScreensQueryCB = function(pResp) {
    debugger;
    if (pResp.status) {
        if (pResp.resFull.appzillonHeader.status) {
            //$("#ACNR01__Navigator__MenuList_row_0").trigger('click');
            //$("#ACNR01__Navigator__subMenuList_row_0").trigger('click');
            try {
                var lFirstApp = pResp.res.ACNR01__FetchRoleScreens_Res.menuheader[0].submenu[0];
                var lAppId = lFirstApp.appId;
                var lScr = lFirstApp.screenId;
                var lLayout = "All";
                var lDesc = lFirstApp.description;
                //apz.ACNR01.Navigator.launchApp(lAppId, lScr, lLayout, lDesc);
            } catch (e) {
                console.log("Menu not available");
            }
            $("#ACNR01__Navigator__subMenuList li").attr("draggable", "true");
            $("#ACNR01__Navigator__subMenuList li").attr("ondragstart", "apz.ACNR01.Navigator.drag(event,this)");
        } else {}
        //add by Rahul
        if (pResp.res.ACNR01__MenuList_Res.vwMenu !== null) {
            let menuTree = fnBuildChildJSON(pResp.res.ACNR01__MenuList_Res.vwMenu);
            let menues = apz.ACNR01.Navigator.getDynamicMenues(menuTree);
            apz.ACNR01.Navigator.appendDynamicMenues(menues, "ACNR01__Navigator__dynamicMenu");
            debugger;
        }
    }
    // apz.ACNR01.Navigator.changeBtn($("#ACNR01__Navigator__MenuList_row_0"));
};
apz.ACNR01.Navigator.menuClick = function(pObj, event) {
    debugger
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
    var frstAnchor = $(this).find("a")[0];
    var lScr = $(frstAnchor).find("span[id*='screen_id']").text();
    var lAppId = $(frstAnchor).find("span[id*='appId']").text();
    var lLayout = "All";
    var lDesc = lScr;
    if (lAppId != "" && lScr != "") {
        apz.ACNR01.Navigator.launchApp(lAppId, lScr, lLayout, lDesc);
    } else {}
};
apz.ACNR01.Navigator.launchApp = function(lAppId, lScr, lLayout, lDesc) {
    var params = {};
    params.appId = lAppId;
    params.scr = lScr;
    params.layout = lLayout;
    params.description = lDesc;
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
apz.ACNR01.Navigator.launchSubMenu = function(pObj) {
    if ($("#sidebar").hasClass('apz-nav-open')) {
        apz.closeSidebar();
    }
    var lGroupName = $(pObj).find("p").text();
    var llResJSON = {};
    if (apz.ACNR01.Navigator.sUserId == "CorpUser") {
        var lResJSONStr = apz.getFile(apz.getDataFilesPath("ACNR01") + "/CORPUSER.json");
        llResJSON = JSON.parse(lResJSONStr);
    } else if (apz.ACNR01.Navigator.sUserId == "CorpUser2") {
        var lResJSONStr = apz.getFile(apz.getDataFilesPath("ACNR01") + "/CORPUSER2.json");
        llResJSON = JSON.parse(lResJSONStr);
    } else {
        var lResJSONStr = apz.getFile(apz.getDataFilesPath("ACNR01") + "/CORPADMIN.json");
        llResJSON = JSON.parse(lResJSONStr);
    }
    var lViewMenu = llResJSON.ACNR01__MenuList_Req.vwMenu;
    var lViewMenuGroup = []
    for (var lIndex in lViewMenu) {
        var lObj = lViewMenu[lIndex];
        if (lObj.groupName == lGroupName) {
            lViewMenuGroup.push(lObj);
        }
    }
    var lSubMenuObj = {};
    lSubMenuObj.vwMenu = [];
    lSubMenuObj.vwMenu = lViewMenuGroup;
    apz.launchSubScreen({
        div: "ACNR01__Navigator__launchPad",
        scr: "NavigatorSubmenu",
        userObj: lSubMenuObj,
        layout: "Web",
        appId: "ACNR01"
    });
};
