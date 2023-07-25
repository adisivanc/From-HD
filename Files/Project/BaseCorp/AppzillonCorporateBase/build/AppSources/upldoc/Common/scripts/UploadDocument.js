apz.upldoc.UploadDocument = {};
apz.upldoc.UploadDocument.sCache = {};
var counter = 1;
apz.app.onLoad_UploadDocument = function(params) {
    apz.upldoc.UploadDocument.sCache = params;
    debugger;
    if (apz.upldoc.UploadDocument.sCache.action == "fromExaminee") {
        $("#upldoc__UploadDocument__uploadDocForm_title").text(apz.upldoc.UploadDocument.sCache.medicalexamType);
        apz.setElmValue("upldoc__UploadDocument__customerId", apz.upldoc.UploadDocument.sCache.data.detailsInsurerAppnum);
        apz.setElmValue("upldoc__UploadDocument__type", apz.upldoc.UploadDocument.sCache.medicalexamType);
        apz.hide("upldoc__UploadDocument__docUpldCancelBtn");
    } else if (apz.upldoc.UploadDocument.sCache.action == "fromCustomerImage") {
        apz.hide("upldoc__UploadDocument__ct_nav_6");
        apz.setElmValue("upldoc__UploadDocument__uploadTypeRadio", "capture");
        apz.hide("upldoc__UploadDocument__uploadTypeDefRow");
        apz.hide("upldoc__UploadDocument__docUpldCancelBtn");
    } else {
        $(".filebox").next().addClass("sno");
        $("#upldoc__UploadDocument__uploadDocForm_title").text("Upload Document");
    }
    $("#PMTS01__ExamineeDetails__uploadDoc_close").click(function() {
        Webcam.reset()
    });
    var isMobile = /iPhone|iPad|iPod|Android/i.test(navigator.userAgent);
    if (isMobile) {
        apz.show("upldoc__UploadDocument__CaptureBtn");
    }
    apz.upldoc.UploadDocument.fnOnChangeUploadType();
};
apz.upldoc.UploadDocument.fnOnChangeUploadType = function() {
    if (apz.getElmValue("upldoc__UploadDocument__uploadTypeRadio") == "files") {
        $("#upldoc__UploadDocument__filesColumn").removeClass("sno");
        $("#upldoc__UploadDocument__CaptureColumn").addClass("sno");
        Webcam.reset();
        $("#upldoc__UploadDocument__captureImg1").attr("src", "");
    } else {
        $("#upldoc__UploadDocument__filesColumn").addClass("sno");
        $("#upldoc__UploadDocument__CaptureColumn").removeClass("sno");
        //alert(apz.deviceType);
        if (apz.deviceType === "ANDROID" || apz.deviceType === "IOS") {
            $("#upldoc__UploadDocument__cameraPreview").addClass("sno");
            apz.upldoc.UploadDocument.mobcamera();
        } else {
            Webcam.set({
                width: 320,
                height: 240,
                image_format: 'jpeg',
                jpeg_quality: 90
            });
            Webcam.attach('#upldoc__UploadDocument__cameraPreview');
        }
    }
}
apz.upldoc.UploadDocument.fnDocumentScanner = function() {
    Webcam.snap(function(data_uri) {
        document.getElementById("upldoc__UploadDocument__captureImg" + counter).src = data_uri;
        $("#upldoc__UploadDocument__captureImg1_ul").removeClass("sno");
    });
};
apz.upldoc.UploadDocument.fnDocumentScannerCB = function(params) {
    debugger;
    if (params.status) {
        document.getElementById("upldoc__UploadDocument__captureImg" + counter).src = "data:image/jpg;base64," + params.encodedImage;
        $("#upldoc__UploadDocument__captureImg" + counter).removeClass("sno");
        $("#upldoc__UploadDocument__captureIcon" + counter).removeClass("sno");
        counter++;
    } else {
        alert("Failure");
    }
};
apz.upldoc.UploadDocument.fnSubmitDetails = function() {
    debugger;
    if (apz.getElmValue("upldoc__UploadDocument__ocrTextUploadCheck") == "y") {
        apz.upldoc.UploadDocument.OCRParse();
    } else if (apz.getElmValue("upldoc__UploadDocument__uploadTypeRadio") == "files" && apz.getElmValue("upldoc__UploadDocument__ocrTextUploadCheck") ==
        "n") {
        apz.upldoc.UploadDocument.fnUploadDocuments();
    } else if (apz.upldoc.UploadDocument.sCache.action == "fromCustomerImage") {
        var lreq = {};
        lreq.data_uri = $("#upldoc__UploadDocument__captureImg1").attr("src").replace("data:image/jpeg;base64,", "");
        Webcam.reset();
        apz.upldoc.UploadDocument.sCache.onSubmitCB(lreq);
    } else if (apz.getElmValue("upldoc__UploadDocument__uploadTypeRadio") == "capture" && apz.getElmValue(
        "upldoc__UploadDocument__ocrTextUploadCheck") == "n") {
        apz.upldoc.UploadDocument.fnGetSelectedTestDetails();
    }
};
apz.upldoc.UploadDocument.fnCancelDetails = function() {
    apz.upldoc.UploadDocument.sCache.onOCRUPloadCBmethod(apz.upldoc.UploadDocument.sCache.scrdata);
}
apz.upldoc.UploadDocument.fnUploadDocuments = function() {
    //apz.upldoc.UploadDocument.fnGetSelectedTestDetails();
    if ($("#upldoc__UploadDocument__fileUpload").prop("files").length > 0) {
        var json = {};
        json.fieldID = "upldoc__UploadDocument__fileUpload";
        json.callBack = apz.upldoc.UploadDocument.fnUploadDocumentsCB;
        json.fileName = "";
        json.overWrite = "Y";
        json.destination = "Test";
        apz.ns.uploadFile(json);
    } else {
        var msg = {};
        msg.code = "APZ-CNT-009";
        apz.dispMsg(msg);
    }
};
apz.upldoc.UploadDocument.fnUploadDocumentsCB = function(params) {
    debugger;
};
apz.upldoc.UploadDocument.fnGetSelectedTestDetails = function() {
    var lreq = {};
    //lreq.temp = {};
    lreq.insuredId = apz.getElmValue("upldoc__UploadDocument__customerId");
    lreq.testReportType = apz.getElmValue("upldoc__UploadDocument__type");
    lreq.destination = "/home/i-exceed.com/hari.prasad/Music/upload/Test";
    lreq.base64image = $("#upldoc__UploadDocument__captureImg1").attr("src").replace("data:image/jpeg;base64,", "");
    var lActionParams = {
        "ifaceName": "CaputredImages",
        "req": lreq,
        "paintResp": "Y",
        "async": false
    };
    apz.upldoc.UploadDocument.fnBeforeCallServer(lActionParams);
};
apz.upldoc.UploadDocument.fnBeforeCallServer = function(params) {
    debugger;
    var lServerParams = {
        "ifaceName": params.ifaceName,
        "buildReq": "N",
        "req": params.req,
        "paintResp": params.paintResp,
        "async": false,
        "callBack": apz.upldoc.UploadDocument.fnCallServerCallBack,
        "callBackObj": "",
    };
    apz.server.callServer(lServerParams);
};
apz.upldoc.UploadDocument.fnCallServerCallBack = function(params) {
    debugger;
    if (params.status == true) {
        var msg = {};
        msg.code = "APZ-SUC-IMG01";
        apz.dispMsg(msg);
    }
};
apz.upldoc.UploadDocument.OCRParse = function() {
    debugger;
    if ($("#upldoc__UploadDocument__fileUpload").prop("files").length > 0) {
        apz.upldoc.UploadDocument.getBase64($("#upldoc__UploadDocument__fileUpload").prop("files")[0]);
    } else if (apz.getElmValue("upldoc__UploadDocument__uploadTypeRadio") == "capture") {
        apz.upldoc.UploadDocument.fnOCRServerCall($("#upldoc__UploadDocument__captureImg1").attr("src").replace("data:image/jpeg;base64,", ""));
    } else {
        var msg = {};
        msg.code = "APZ-CNT-009";
        apz.dispMsg(msg);
        apz.upldoc.UploadDocument.sCache.onOCRUPloadCBmethod(apz.upldoc.UploadDocument.sCache.scrdata);
    }
};
apz.upldoc.UploadDocument.getBase64 = function(file) {
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function() {
        var res = reader.result;
        var n = res.indexOf(",");
        var res1 = res.substring(n + 1);
        apz.upldoc.UploadDocument.fnOCRServerCall(res1);
    };
    reader.onerror = function(error) {
        console.log('Error: ', error);
    };
};
apz.upldoc.UploadDocument.fnOCRServerCall = function(response) {
    // if(apz.getElmValue("upldoc__UploadDocument__ocrTextOnlineCheck") == "y"){
    //apz.mockServer = false;
    //apz.mockServer = true;
    // }
    var file = "";
    var filetype = "";
    if ($("#upldoc__UploadDocument__fileUpload").prop("files").length > 0) {
        file = $("#upldoc__UploadDocument__fileUpload").prop("files")[0];
        filetype = file.name.split('.').pop();
    } else if (apz.getElmValue("upldoc__UploadDocument__uploadTypeRadio") == "capture") {
        filetype = "jpeg";
    }
    //var drdnVal = apz.getObjValue($("#SOAPFU__soapFileUpload__i__GetExtratedText__language")[0]); 
    var str = '{ "ns1:GetExtratedText": {"ns1:Key":"IEXEEDKEY1109lvc","ns1:file":"' + response + '","ns1:f":"' + filetype + '","ns1:language":"' +
        "English" + '"}}';
    var req1 = JSON.parse(str);
    /*var req1 = str;
    var req1 = str;
    */
	apz.startLoader();
    var params = {};
    params.callBackObj = this;
    params.buildReq = 'N';
    params.paintResp = 'N';
    params.req = req1;
    params.ifaceName = 'soapFileUpload';
    params.async = true;
    params.callBack = apz.upldoc.UploadDocument.fnOCRServerCallCB;
    params.internal = false;
    apz.server.callServer(params);
};
apz.upldoc.UploadDocument.fnOCRServerCallCB = function(params) {
    debugger;
    try {
        var response = params.res.upldoc__soapFileUpload_Res.GetExtratedTextResponse.GetExtratedTextResult;
        var extrText = JSON.parse(response).ExtractedText;
        //var extrText = response.ExtractedText;
        //var htmlData = JSON.parse(response).HTMLData;
        // if(apz.getElmValue("upldoc__UploadDocument__ocrTextOnlineCheck") == "y"){
        //apz.mockServer = true;
        // }
        apz.stopLoader();
        if (params.status) {
            var lobj = {
                "extrText": extrText
            }
            apz.upldoc.UploadDocument.parseAndPaintData(lobj);
        } else if (params.errorMessage) {
            var msg = {};
            msg.code = "FL-UPL-FLDLOC";
            apz.dispMsg(msg);
        }
    } catch (e) {
        apz.upldoc.UploadDocument.sCache.onOCRUPloadCBmethod(apz.upldoc.UploadDocument.sCache.scrdata);
    }
};
apz.upldoc.UploadDocument.parseAndPaintData = function(params) {
    debugger;
    var extractedText = params.extrText; // Input text
    var lines = extractedText.split("\n");
    var numLines = lines.length;
    var i;
    var currentSection;
    var lDetails = [];
    var sections = Array();
    var secValues = Array();
    /*for (var j = 0; j < apz.upldoc.UploadDocument.sCache.scrdata.length; j++) {
        for (var k = 0; k < apz.upldoc.UploadDocument.sCache.scrdata[j].medicalExamTests.length; k++) {
            for (var i = 0; i < numLines; i++) {
                var line = lines[i];
                if (line.indexOf(apz.upldoc.UploadDocument.sCache.scrdata[j].medicalExamTests[k].medicalExamTestName) > -1) {
                    // start of next section, handled in nex loop
                    currentSection = line;
                    secValues = currentSection.split(" ");
                    // console.log(secValues[1]);
                    var examNameArray = Array();
                    examNameArray = apz.upldoc.UploadDocument.sCache.scrdata[j].medicalExamTests[k].medicalExamTestName.split(" ");
                    console.log(apz.upldoc.UploadDocument.sCache.scrdata[j].medicalExamTests[k].medicalExamTestName+" : "+secValues[examNameArray.length]);
                    //apz.upldoc.UploadDocument.sCache.scrdata[j].medicalExamTests[k].medicalExamTestValue = secValues[1];
                    apz.upldoc.UploadDocument.sCache.scrdata[j].medicalExamTests[k].medicalExamTestValue = secValues[examNameArray.length];
                }
            }
        }
    }
    apz.upldoc.UploadDocument.sCache.onOCRUPloadCBmethod(apz.upldoc.UploadDocument.sCache.scrdata);*/
    /*for (i = 0; i < lines.length; i++) {
        if (lines[i] == "FULL NAME") {
            lDetails.fullName = lines[i + 2];
        } else if (lines[i] == "DATE OF BIRTH J gd) fou UG") {
            lDetails.dateOfBirth = lines[i + 2];
        } else if (lines[i] == "NATIONALITY") {
            lDetails.nationality = (lines[21]).split("|")[0].trim();
        } else if (lines[i] == "PLACE OF BIRTH") {
            lDetails.placeOfBirth = lines[i + 2];
        } 
    }*/
    for (i = 1; i < lines.length; i++) {
        var larray = lines[i].split(",");
        if (larray.length > 4) {
            lDetails.push({
                "fromAccount": larray[0].trim(),
				"type": larray[1].trim(),
                "toAccount": larray[2].trim(),
                "currency": larray[4].trim(),
                "amount": larray[5].trim()			
            });
        }
    }
    apz.upldoc.UploadDocument.sCache.callBack(lDetails)
};
apz.upldoc.UploadDocument.mobcamera = function() {
    var jsonobj = {
        "zoomLevel": "20",
        "targetWidth": "200",
        "targetHeight": "200",
        "crop": "Y", //Y or N  
        "flash": "N",
        "action": "base64_Save", // save,base64 
        "fileName": "Sample",
        "quality": "50",
        "encodingType": "JPG",
        "sourceType": "camera" // photo 
    };
    jsonobj.id = "CAMERA_ID";
    jsonobj.callBack = apz.upldoc.UploadDocument.mobcameraCallback;
    apz.ns.openCamera(jsonobj);
}
apz.upldoc.UploadDocument.mobcameraCallback = function(pjson) {
    if (pjson.status) {
        document.getElementById("upldoc__UploadDocument__captureImg1").src = "data:image/jpg;base64," + pjson.encodedImage;
        $("#upldoc__UploadDocument__captureImg1_ul").removeClass("sno");
    } else {
        //alert("Failure");
    }
};
apz.upldoc.UploadDocument.fnBack = function() {
    apz.upldoc.UploadDocument.sCache.backFunction();
}
