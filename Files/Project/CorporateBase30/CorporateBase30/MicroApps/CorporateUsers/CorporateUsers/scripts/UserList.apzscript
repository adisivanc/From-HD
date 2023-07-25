apz.acus01.UserList = {};
apz.acus01.UserList.sCorporateName = "ABC Corp";
apz.acus01.UserList.sCustomerId = "Private Limited";
apz.acus01.UserList.sAction = "";
apz.app.onLoad_UserList = function() {
    debugger;
    apz.acus01.UserList.sCorporateId = apz.Login.sCorporateId;
    apz.acus01.UserList.userInfoQuery(apz.acus01.UserList.sCorporateId);
};
apz.app.onShown_UserList = function() {
debugger;
    $(".adr-ctr").addClass("sno");
  
};
apz.acus01.UserList.userInfoQuery = function(pCorporateId) {
    debugger;
    var lServerParams = {
        "ifaceName": "UsersList_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.UserList.userDetailsQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserMaster = {};
    req.tbDbmiCorpUserMaster.corporateId = pCorporateId;
    req.tbDbmiCorpUserRole = {};
    req.tbDbmiCorpUserRole.corporateId = pCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acus01.UserList.userDetailsQueryCB = function(pResp) {
    debugger;
    var lUserMaster = pResp.res.acus01__UsersList_Req.tbDbmiCorpUserMaster;
    var lUserMasterLength = lUserMaster.length;
    for (var i = 0; i < lUserMasterLength; i++) {
        pResp.res.acus01__UsersList_Req.tbDbmiCorpUserMaster[i].firstName = lUserMaster[i].firstName + " " + lUserMaster[i].lastName;
    }
    apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster = pResp.res.acus01__UsersList_Req.tbDbmiCorpUserMaster;
    apz.data.loadData("UsersList", 'acus01');
  var dataLength = apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster.length;
    for (var i = 0; i < dataLength; i++) {
        try {
            if (apz.isNull(apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster[i].logo)) {
                $("#acus01__UsersList__i__tbDbmiCorpUserMaster__logo_"+i).attr("src",
                    'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
            } else {
                var blob = convertBase64toBlob(apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster[i].logo);
                var blobUrl = URL.createObjectURL(blob);
                $("#acus01__UsersList__i__tbDbmiCorpUserMaster__logo_"+i).attr("src", blobUrl);
            }
        } catch (e) {
            $("#acus01__UsersList__i__tbDbmiCorpUserMaster__logo_"+i).attr("src",
                'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
        }
    }
    apz.currAppId = "acus01";
};
apz.acus01.UserList.searchKeyPress = function(event) {
    if (event.which == 13) {
        apz.acus01.UserList.search();
    }
};
apz.acus01.UserList.search = function() {
    var id = $("#acus01__UserList__Searchinput").val();
    apz.app.searchRecords("acus01__UserList__UsersList", id);
};
apz.acus01.UserList.addUser = function() {
    debugger;
    $("#acus01__UserList__MainRow").addClass("sno");
    $("#acus01__UserList__LaunchScreen").removeClass("sno");
    $("#acus01__UserList__User_Summary_Header").addClass("sno");
    var params = {};
    params.appId = "acus01";
    params.scr = "NewUser";
    params.layout = "All";
    params.div = "acus01__UserList__ModifyScreen";
     params.userObj = {
        "div": "acus01__UserList__ModifyScreen"
    };
    apz.launchSubScreen(params);
};
apz.acus01.UserList.userModification = function(pObj, event) {
    debugger;
    $("#acus01__UserList__MainRow").addClass("sno");
    $("#acus01__UserList__LaunchScreen").removeClass("sno");
    $("#acus01__UserList__User_Summary_Header").addClass("sno");
    var params = {};
    params.appId = "acus01";
    params.scr = "CorporateUsers";
    params.layout = "All";
    params.div = "acus01__UserList__ModifyScreen";
    params.userObj = {
        "CorpUserId": $(pObj).closest("li").find('.userID').text(),
        "div": "acus01__UserList__LaunchScreen"
    };
    apz.launchSubScreen(params);
    event.stopPropagation();
};
apz.acus01.UserList.fetchUserDetails = function(pObj) {
    debugger;
    var lUserId = $(pObj).closest('li').find('.userID').text();
    apz.acus01.UserList.fetchUserDetailsService(apz.acus01.UserList.sCorporateId, lUserId);
};
apz.acus01.UserList.fetchUserDetailsService = function(pCorporateId, pUserId) {
    debugger;
    var lServerParams = {
        "ifaceName": "UserDetails_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "async": "true",
        "callBack": apz.acus01.UserList.fetchUserDetailsQueryCB,
        "callBackObj": "",
    };
    var req = {};
    req.tbDbmiCorpUserMaster = {};
    req.tbDbmiCorpUserMaster.corporateId = pCorporateId;
    req.tbDbmiCorpUserMaster.userId = pUserId;
    req.tbDbmiCorpUserRole = {};
    req.tbDbmiCorpUserRole.corporateId = pCorporateId;
    req.tbDbmiCorpUserRole.userId = pUserId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acus01.UserList.fetchUserDetailsQueryCB = function(pResp) {
    debugger;
    $("#acus01__UserList__User_Summary_Header").addClass("sno");
    $("#acus01__UserList__MainRow").addClass("sno");
    $("#acus01__UserList__LaunchScreen").removeClass("sno");
    var params = {};
    params.appId = "acus01";
    params.scr = "UserDetails";
    params.layout = "All";
    params.div = "acus01__UserList__ModifyScreen";
    params.userObj = {};
    if (pResp.res.acus01__UserDetails_Res) {
        params.userObj.CorpViewUser = pResp.res.acus01__UserDetails_Res.tbDbmiCorpUserMaster;
        params.userObj.CorpUserRole = pResp.res.acus01__UserDetails_Res.tbDbmiCorpUserRole;
    } else {
        params.userObj.CorpViewUser = pResp.res.acus01__UserDetails_Req.tbDbmiCorpUserMaster;
        params.userObj.CorpUserRole = pResp.res.acus01__UserDetails_Req.tbDbmiCorpUserRole;
    }
    
    //  var dataLength = apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster.length;
    // for (var i = 0; i < dataLength; i++) {
    //     try {
    //         if (apz.isNull(apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster[i].logo)) {
    //             $("#acus01__UsersList__i__tbDbmiCorpUserMaster__logo_"+i).attr("src",
    //                 'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
    //         } else {
    //             var blob = convertBase64toBlob(apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster[i].logo);
    //             var blobUrl = URL.createObjectURL(blob);
    //             $("#acus01__UsersList__i__tbDbmiCorpUserMaster__logo_"+i).attr("src", blobUrl);
    //         }
    //     } catch (e) {
    //         $("#acus01__UsersList__i__tbDbmiCorpUserMaster__logo_"+i).attr("src",
    //             'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
    //     }
    // }
    apz.launchSubScreen(params);
};
apz.acus01.UserList.fnSearch = function(event) {
    if (event.keyCode == 13) {
        var lType = apz.getElmValue("acus01__UserList__SearchBy");
        var lInput = apz.getElmValue("acus01__UserList__SearchValue");
        var lSearchType;
        var flag = true;
        if (lType == "Search") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                flag = false;
                var lMsg = {};
                lMsg.code = "SEARCH_CHK";
                apz.dispMsg(lMsg);
            }
        } else if (lType == "Name") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "Name";
            }
        } else if (lType == "UserId") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "UserID";
            }
        } else if (lType == "Designation") {
            if (apz.isNull(lInput)) {
                lSearchType = "All";
            } else {
                lSearchType = "Designation";
            }
        }
        if (flag) {
            apz.acus01.UserList.sAction = "Search";
            var req = {
                "userDetails": {
                    "type": lSearchType,
                    "corpID": apz.Login.sCorporateId,
                    "value": lInput
                }
            };
            req.action = "Query";
            req.table = "tb_dbmi_user_list";
            var lParams = {
                "ifaceName": "UserService",
                "paintResp": "N",
                "appId": "acus01",
                "buildReq": "N",
                "lReq": req
            };
            apz.startLoader();
            apz.acus01.UserList.fnBeforCallServer(lParams);
        }
    }
};
apz.acus01.UserList.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acus01.UserList.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acus01.UserList.callServerCB = function(params) {
    if (apz.acus01.UserList.sAction == "Search") {
        apz.acus01.UserList.fnFetchUserDetailsCB(params);
    }
};
apz.acus01.UserList.fnFetchUserDetailsCB = function(params) {
    debugger;
    apz.stopLoader();
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        if (params.res.acus01__UserService_Res.userStatus) {
            apz.data.scrdata.acus01__UsersList_Req = {};
            apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster = [];
            apz.data.scrdata.acus01__UsersList_Req.tbDbmiCorpUserMaster = params.res.acus01__UserService_Res.tbDbmiCorpUserMaster;
            apz.data.loadData("UsersList", "acus01");
        } else {
            apz.data.clearMRMV("acus01__UserList__userLists");
            var msg = {};
            msg.message = "No Records found";
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
function convertBase64toBlob(content, contentType) {
    contentType = contentType || '';
    var sliceSize = 512;
    var byteCharacters = window.atob(content); //method which converts base64 to binary
    var byteArrays = [];
    for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
        var slice = byteCharacters.slice(offset, offset + sliceSize);
        var byteNumbers = new Array(slice.length);
        for (var i = 0; i < slice.length; i++) {
            byteNumbers[i] = slice.charCodeAt(i);
        }
        var byteArray = new Uint8Array(byteNumbers);
        byteArrays.push(byteArray);
    }
    var blob = new Blob(byteArrays, {
        type: contentType
    }); //statement which creates the blob
    return blob;
};
