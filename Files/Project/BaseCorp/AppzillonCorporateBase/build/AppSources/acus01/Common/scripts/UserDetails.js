apz.acus01.UserDetails = {};
apz.app.onLoad_UserDetails = function(params) {
    debugger;
    apz.acus01.UserDetails.sCorporateId = apz.Login.sCorporateId;
    $("#acus01__UserList__UserSearch").hide();
    apz.data.scrdata.acus01__UserDetails_Req = {};
    apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster = params.CorpViewUser;
    apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserRole = params.CorpUserRole;
    var lName = params.CorpViewUser.firstName + " " + params.CorpViewUser.lastName;
    apz.setElmValue("acus01__UserDetails__UserName", lName);
    apz.data.loadData("UserDetails");
    apz.acus01.UserDetails.UserDetailsPersona(params.CorpViewUser.userId);
};
apz.app.onShown_UserDetails = function() {
    debugger;
    try {
        if (apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.logo == undefined || apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster
            .logo == "") {
            $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__logo").attr("src", 'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
        } else {
            var blob = convertBase64toBlob(apz.data.scrdata.acus01__UserDetails_Req.tbDbmiCorpUserMaster.logo);
            var blobUrl = URL.createObjectURL(blob);
            $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__logo").attr("src", blobUrl);
        }
    } catch (e) {
        $("#acus01__UserDetails__i__tbDbmiCorpUserMaster__logo").attr("src", 'apps/styles/themes/AppzillonCorporateBase/img/user-placeholder.png');
    }
};
apz.acus01.UserDetails.cancel = function() {
    debugger;
    apz.acus01.UserList.userInfoQuery(apz.acus01.UserList.sCorporateId);
    $("#acus01__UserList__UserSearch").show();
    $("#acus01__UserList__MainRow").removeClass("sno");
    $("#acus01__UserList__LaunchScreen").addClass("sno");
    $("#acus01__UserList__User_Summary_Header").removeClass("sno");
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
apz.acus01.UserDetails.UserDetailsPersona = function(pUserId) {
    apz.server.callServer({
        ifaceName: 'UserPersona_Query',
        appId: 'acus01',
        buildReq: 'N',
        req: {
            tbDbmiUserPersona: {
                userId: pUserId,
                corporateId: apz.Login.sCorporateId
            }
        },
        paintResp: 'Y',
        callBack: apz.acus01.UserDetails.UserDetailsPersonaCB
    });
};
apz.acus01.UserDetails.UserDetailsPersonaCB = function(pResp) {
    debugger;
    if (pResp.status) {
        if (pResp.res.acus01__UserPersona_Res.tbDbmiUserPersona.personaName) {
            apz.setElmValue("acus01__UserDetails__persona", pResp.res.acus01__UserPersona_Res.tbDbmiUserPersona.personaName);
        }
    }
};
