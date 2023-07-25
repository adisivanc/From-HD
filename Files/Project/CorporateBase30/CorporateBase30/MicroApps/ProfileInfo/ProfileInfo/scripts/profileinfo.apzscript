apz.prfinf = {};
apz.prfinf.profileinfo = {};
apz.prfinf.profileinfo.sParams = {};
apz.app.onLoad_profileinfo = function(params) {
    debugger;
    $('#prfinf__profileinfo__launch input').attr('readonly', true);
    $('#prfinf__profileinfo__launch input').attr('readonly', true);
    $("#prfinf__profileinformation__i__tbAsmiUser__language").attr("disabled", "disabled");
    $("#prfinf__profileinformation__i__tbAsmiUser__salutation").attr("disabled", "disabled");
    $("#prfinf__profileinfo__el_tgl_1").addClass("disabled");
    if (params.Navigation) {
        apz.prfinf.profileinfo.fnSetNavigation(params);
    }
    var lReq = {};
    lReq.tbAsmiUser = {};
    lReq.tbAsmiUser.userId = "admin";
    lReq.tbAsmiUser.appId = "prfinf";
    // var params = {
    //     "ifaceName": "profileinformation_Query",
    //     "paintResp": "Y",
    //     "req": lReq,
    // };
    
    var profilelist = JSON.parse(apz.getFile(apz.getDataFilesPath("prfinf") + "/profileinformation.json")).prfinf__profileinformation_Req.tbAsmiUser;
    let lfilterwArray = profilelist.filter(apz.prfinf.profileinfo.fnFilterprofile);
    
        // let lfilterwArray = jQuery.grep(profilelist, function(lObj) {
        //     alert("k");
        //     debugger;
        //     return (lObj.userId == apz.Login.sUserId);
        // });
    
    apz.data.scrdata.prfinf__profileinformation_Req = {
        tbAsmiUser: lfilterwArray
    }
    apz.data.loadData("profileinformation", "prfinf");
    
    
    $("#prfinf__profileinfo__Row1").removeClass("sno");
    $("#prfinf__profileinfo__Row2").removeClass("sno");
   // apz.prfinf.profileinfo.fnBeforeCallServer(params);
   $("body").removeClass("dbcls");
};

apz.prfinf.profileinfo.fnFilterprofile= function(lobj){
    debugger;
    return lobj.userId == apz.Login.sUserId;
}
apz.prfinf.profileinfo.fnSetNavigation = function(params) {
    apz.prfinf.profileinfo.Navigation = params.Navigation.setNavigation;
    var lParams = {};
    if (!apz.isNull(params.headerText)) {
        lParams.headerText = params.headerText;
    } else {
        lParams.headerText = "PROFILE DETAILS";
    }
    apz.prfinf.profileinfo.Navigation(lParams);
};
apz.prfinf.profileinfo.onlick = function() {
    debugger;
    //apz.prfinf.profileinfo("launch_area");
    var lObj = {
        "targetId": "prfinf__profileinfo__option"
    };
    apz.toggleModal(lObj);
    //apz.getElmValue("prfinf__profileinfo__el_tgl_1")
    //apz.ns.Opencamera = function() {
    var jsonobj = {
        "zoomLevel": "20",
        "targetWidth": "200",
        "targetHeight": "200",
        "crop": "Y", //Y or N 
        "flash": "N",
        "action": "base64_Save", // save,base64
        "fileName": 'Sample',
        "quality": "50",
        "encodingType": "JPG",
        "sourceType": "camera" // photo
    };
    jsonobj.id = "CAMERA_ID";
    jsonobj.callBack = cameraCallback;
    apz.ns.openCamera(jsonobj);
};
cameraCallback = function(pjson) {
    debugger;
    if (pjson.status) {
        document.getElementById("prfinf__profileinformation__i__tbAsmiUser__profilePic").src = "data:image/jpg;base64," + pjson.encodedImage;
        apz.prfinf.profileinfo.sParams.profilepicture = pjson.encodedImage;
    } else {
        // alert("Failure");
    }
}
apz.prfinf.profileinfo.Fnclick = function() {
    debugger;
    var lObj = {
        "targetId": "prfinf__profileinfo__option"
    }
    apz.toggleModal(lObj);
    var jsonobj = {
        "zoomLevel": "20",
        "targetWidth": "200",
        "targetHeight": "200",
        "crop": "Y", //Y or N 
        "flash": "N",
        "action": "base64_Save", // save,base64
        "fileName": 'Sample',
        "quality": "50",
        "encodingType": "JPG",
        "sourceType": "photo" // photo
    };
    jsonobj.id = "CAMERA_ID";
    jsonobj.callBack = cameraCallback;
    apz.ns.openCamera(jsonobj);
};
cameraCallback = function(pjson) {
    debugger;
    if (pjson.status) {
        $("#prfinf__profileinfo__update_row").removeClass("sno");
        document.getElementById("prfinf__profileinformation__i__tbAsmiUser__profilePic").src = "data:image/jpg;base64," + pjson.encodedImage;
        apz.prfinf.profileinfo.sParams.profilepicture = pjson.encodedImage;
    } else {
        // alert("Failure");
    }
}
//apz.getElmValue("prfinf__profileinfo__el_tgl_1")
/* var json = {
        "filter": "",
        "fileCategory": "Images",
        "location": "",
        "openFile": "N"
    };
    json.id = "FILEBROWSER_ID";
    json.callBack = fileBrowserCallback;
    apz.ns.filebrowser(json);
};
fileBrowserCallback = function(jsonObj) {
    alert("pen successfully:: The path of the selected file is: " + jsonObj.filePath);
}*/
apz.prfinf.profileinfo.upload = function() {
    debugger;
    $("#prfinf__profileinfo__browse").attr("accept", "image/*");
    if (apz.deviceGroup == "Web") {
        $("#prfinf__profileinfo__browse").trigger('click');
    } else {
        var lObj = {
            "targetId": "prfinf__profileinfo__option"
        };
        apz.toggleModal(lObj);
    }
};
$("#prfinf__profileinfo__browse").change(function() {
    debugger;
    //apz.prfinf.profileinfo.fileSelected(this);
    apz.prfinf.profileinfo.imageFileSected(this);
});
var binaryStr, base64Str, fileObj;
/*apz.prfinf.profileinfo.fileSelected = function(inputObj) {
    debugger;*/
apz.prfinf.profileinfo.imageFileSected = function(pthis, event) {
    debugger;
    var fileObj = pthis.files[0];
    var apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        var binaryStr = apzFileReader.result;
        var base64Str = btoa(binaryStr);
        // apz.admin.appglobals.base64Str = base64Str;
        apz.setElmValue("prfinf__profileinformation__i__tbAsmiUser__profilePic", base64Str);
        binaryStr = "";
        base64Str = "";
    };
    apzFileReader.readAsBinaryString(fileObj);
    $("#prfinf__profileinfo__update_row").removeClass("sno");
};

function converBase64toBlob(content, contentType) {
    debugger;
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
apz.prfinf.profileinfo.fnUpdateProfilePic = function() {
    $('#prfinf__profileinfo__launch input').attr('readonly', true);
    $("#prfinf__profileinformation__i__tbAsmiUser__language").attr("disabled", "disabled");
    $("#prfinf__profileinformation__i__tbAsmiUser__salutation").attr("disabled", "disabled");
    $("#prfinf__profileinfo__el_tgl_1").addClass("disabled")
    $('#prfinf__profileinfo__ct_frm_1 input').attr('readonly', true);
    var msg = {
        "code": 'profile_updtaed',
    };
    apz.dispMsg(msg);
};
apz.prfinf.profileinfo.fnUpdateProfile = function() {
    debugger;
    apz.data.buildData("profileinformation", "prfinf");
    var lReq = {};
    lReq.tbAsmiUser = apz.data.scrdata.prfinf__profileinformation_Req.tbAsmiUser;
    var param = {
        "ifaceName": "profileinformation_Modify",
        "paintResp": "N",
        "req": lReq,
    };
    //apz.prfinf.profileinfo.fnBeforeCallServer(param);
    apz.data.loadJsonData("profileinformation","prfinf");
};
apz.prfinf.profileinfo.fnBeforeCallServer = function(param) {
    debugger;
    var lServerParams = {
        "ifaceName": param.ifaceName,
        "buildReq": "N",
        "req": param.req,
        "paintResp": param.paintResp,
        "async": true,
        "callBack": apz.prfinf.profileinfo.fnCallServerCallBack,
    };
    apz.server.callServer(lServerParams);
};
apz.prfinf.profileinfo.fnCallServerCallBack = function(pResp) {
    debugger;
    //  var lPhNO = pResp.CallBackObj.PhNo;
    //apz.setElmValue("prfinf__profileinformation__i__tbAsmiUser__userPhno1", lPhNO);
};
apz.prfinf.profileinfo.fnEdit = function() {
    debugger;
    var lParams = {
        "appId": "phneno",
        "scr": "UpdatePhNo",
        "div": "prfinf__profileinfo__LaunchScreen",
        "type": "CF",
        "userObj": {
            "action": "Query",
            "data": apz.getElmValue("prfinf__profileinformation__i__tbAsmiUser__userPhno1"),
            "parentAppId": "prfinf",
            "Navigation": {
                "setNavigation": apz.prfinf.profileinfo.Navigation
            }
        }
    };
    $("#prfinf__profileinfo__update_row").addClass("sno");
    $("#prfinf__profileinfo__Row1").addClass("sno");
    $("#prfinf__profileinfo__Row2").addClass("sno");
    apz.launchApp(lParams);
};
apz.prfinf.profileinfo.fnEditForm = function() {
    $('#prfinf__profileinfo__launch input').attr('readonly', false);
    $("#prfinf__profileinformation__i__tbAsmiUser__language").removeAttr("disabled");
    $("#prfinf__profileinformation__i__tbAsmiUser__salutation").removeAttr("disabled");
    $("#prfinf__profileinfo__el_tgl_1").removeClass("disabled")
    $('#prfinf__profileinfo__ct_frm_1 input').attr('readonly', false);
}
