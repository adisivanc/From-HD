apz.chkdpt.DepositCheck = {};
apz.chkdpt.DepositCheck.checklistArr = [];
apz.app.onLoad_DepositCheck = function(params) {
    debugger;
    if (params.screendata != undefined) {
        apz.setElmValue("chkdpt__DepositCheck__account", params.account);
        apz.setElmValue("chkdpt__DepositCheck__amount", params.amount);
        apz.chkdpt.DepositCheck.checklistArr = params.screendata.chkdpt__DepositCheck_Res.CheckList;
        apz.data.scrdata.chkdpt__DepositCheck_Res = {}
        apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = params.screendata.chkdpt__DepositCheck_Res.CheckList;
        apz.data.loadData("DepositCheck", "chkdpt");
        setTimeout(function() {
            for (var i = 0; i < apz.chkdpt.DepositCheck.checklistArr.length; i++) {
                $("#chkdpt__DepositCheck__addicon_" + i).addClass("sno");
            }
            var lastrow = apz.chkdpt.DepositCheck.checklistArr.length - 1;
            $("#chkdpt__DepositCheck__addicon_" + lastrow).removeClass("sno");
        }, 200);
    } else {
        var lobj = {};
        lobj.frontImage = "upimg25.png";
        lobj.backImage = "upimg25.png";
        lobj.frontName = "";
        lobj.backName = "";
        lobj.checkNo = "";
        lobj.Bank = "";
        lobj.AccountNo = "";
        lobj.Name = "";
        lobj.Amount = "";
        apz.chkdpt.DepositCheck.checklistArr.push(lobj);
        apz.data.scrdata.chkdpt__DepositCheck_Res = {}
        apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = apz.chkdpt.DepositCheck.checklistArr;
        apz.data.loadData("DepositCheck", "chkdpt");
        $("#chkdpt__DepositCheck__addicon_0").addClass("sno");
        $("#chkdpt__DepositCheck__delicon_0").addClass("sno");
    }
}
apz.chkdpt.DepositCheck.fnSubmit = function() {
    debugger;
    var lscrdata = apz.data.buildData("DepositCheck", "chkdpt");
    var totalAmt = 0;
   var ldata =  lscrdata.chkdpt__DepositCheck_Res.CheckList;
   for(var i=0;i< ldata.length;i++){
       if(ldata[i].Amount != "" && ldata[i].Amount != undefined){
           totalAmt = totalAmt + Number(ldata[i].Amount);
       }
   }
    
    var param = {
            "decimalSep": ".",
            "value": totalAmt,
            "mask": "MILLION",
            "decimalPoints":"2",
            "displayAsLiteral": "N"
        };
    //apz.setElmValue("dmddft__DemandDraft__Stage1Amount", apz.formatNumber(param));
    
    
    if(apz.getElmValue("chkdpt__DepositCheck__amount") == apz.formatNumber(param)){
         apz.chkdpt.DepositLauncher.fnNavigate("ReviewDeposit", {
        "amount": "",
        "account": "",
        "screendata": lscrdata
    });
    }
    
    else{
        apz.dispMsg({"message":"Totla amount is not equal to check amount","type":"E"});
    }
   
}
apz.chkdpt.DepositCheck.fnOnAmountChange = function() {
    debugger;
    apz.chkdpt.DepositLauncher.sCache.amount = apz.getElmValue("chkdpt__DepositCheck__amount");
}
apz.chkdpt.DepositCheck.fnOnAccountChange = function() {
    debugger;
    apz.chkdpt.DepositLauncher.sCache.account = apz.getElmValue("chkdpt__DepositCheck__account");
}

apz.chkdpt.DepositCheck.fnOnfrontImageClick = function(pthis, ptype, ptext) {
    debugger;
    var imagetxt = apz.getElmValue("chkdpt__DepositCheck__o__CheckList__" + ptype + "_" + $(pthis).attr("rowno"));
    if (imagetxt.indexOf("upimg25.png") == -1) {
        apz.chkdpt.DepositCheck.fnOnTextClick(pthis, ptype, ptext)
    } else {
        apz.chkdpt.DepositCheck.lrowno = $(pthis).attr("rowno");
        apz.chkdpt.DepositCheck.ltype = ptype;
        apz.chkdpt.DepositCheck.ltext = ptext;
        $("#chkdpt__DepositCheck__frontupload").trigger("click");
    }
}
apz.chkdpt.DepositCheck.fnOnfrontBrowse = function(pthis) {
    debugger;
    let fileObj = pthis.files[0];
    var fileName = fileObj.name;
    let apzFileReader = new FileReader();
    apzFileReader.onload = function() {
        debugger;
        let binaryStr = apzFileReader.result;
        let base64Str = btoa(binaryStr);
        // var encodedImage = binaryStr.split(",").pop();
        apz.chkdpt.DepositCheck.checklistArr[apz.chkdpt.DepositCheck.lrowno][apz.chkdpt.DepositCheck.ltype] = base64Str;
        apz.chkdpt.DepositCheck.checklistArr[apz.chkdpt.DepositCheck.lrowno][apz.chkdpt.DepositCheck.ltext] = fileName;
        apz.setElmValue("chkdpt__DepositCheck__o__CheckList__" + apz.chkdpt.DepositCheck.ltype + "_" + apz.chkdpt.DepositCheck.lrowno, base64Str);
        apz.setElmValue("chkdpt__DepositCheck__o__CheckList__" + apz.chkdpt.DepositCheck.ltext + "_" + apz.chkdpt.DepositCheck.lrowno, fileName);
        //$("#chkdpt__DepositCheck__o__CheckList__" + apz.chkdpt.DepositCheck.ltype + "_" + apz.chkdpt.DepositCheck.lrowno).addClass("sno");
        //$("#chkdpt__DepositCheck__o__CheckList__" + apz.chkdpt.DepositCheck.ltext + "_" + apz.chkdpt.DepositCheck.lrowno).removeClass("sno");
        if (apz.chkdpt.DepositCheck.lrowno == 0  && apz.chkdpt.DepositCheck.checklistArr.length == 1) {
            $("#chkdpt__DepositCheck__addicon_" + apz.chkdpt.DepositCheck.lrowno).removeClass("sno");
            $("#chkdpt__DepositCheck__delicon_" + apz.chkdpt.DepositCheck.lrowno).removeClass("sno");
        }
        
        if(apz.chkdpt.DepositCheck.ltype == "frontImage"){
             apz.chkdpt.DepositCheck.fngetOCRServiceData({
            "status": true,
            encodedImage: base64Str,
            filenames:fileName
        });
        }
       
    }
    apzFileReader.readAsBinaryString(fileObj);
}
apz.chkdpt.DepositCheck.fnOnTextClick = function(pthis, pimage, ptext) {
    debugger;
    apz.chkdpt.DepositCheck.lrowno = $(pthis).attr("rowno");
    apz.toggleModal({
        targetId: "chkdpt__DepositCheck__imagemodal"
    });
    //chkdpt__DepositCheck__o__CheckList__frontImage_0
    var imagetxt = apz.getElmValue("chkdpt__DepositCheck__o__CheckList__" + pimage + "_" + apz.chkdpt.DepositCheck.lrowno);
    apz.setElmValue("chkdpt__DepositCheck__previewimg", imagetxt);
}
apz.chkdpt.DepositCheck.fnAddRow = function(pthis) {
    debugger;
    var prow = Number($(pthis).attr("rowno")) + 1;
    ///$("#"+pthis.id).addClass("sno");
    var lobj = {};
    lobj.frontImage = "upimg25.png";
    lobj.backImage = "upimg25.png";
    lobj.frontName = "";
    lobj.backName = "";
    lobj.checkNo = "";
    lobj.Bank = "";
    lobj.AccountNo = "";
    lobj.Name = "";
    lobj.Amount = "";
    apz.chkdpt.DepositCheck.checklistArr.push(lobj);
    apz.data.scrdata.chkdpt__DepositCheck_Res = {}
    apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = apz.chkdpt.DepositCheck.checklistArr;
    apz.data.loadData("DepositCheck", "chkdpt");
    setTimeout(function() {
        $("#chkdpt__DepositCheck__o__CheckList__frontImage_" + prow).removeClass("sno");
        $("#chkdpt__DepositCheck__o__CheckList__backImage_" + prow).removeClass("sno");
        for (var i = 0; i < apz.chkdpt.DepositCheck.checklistArr.length; i++) {
            $("#chkdpt__DepositCheck__addicon_" + i).addClass("sno");
        }
        var lastrow = apz.chkdpt.DepositCheck.checklistArr.length - 1;
        $("#chkdpt__DepositCheck__addicon_" + lastrow).removeClass("sno");
    }, 200);
}
apz.chkdpt.DepositCheck.fnDeleteRow = function(pthis) {
    debugger;
    var drow = $(pthis).attr("rowno");
    apz.chkdpt.DepositCheck.checklistArr.splice(drow, 1);
    apz.data.scrdata.chkdpt__DepositCheck_Res = {}
    apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = apz.chkdpt.DepositCheck.checklistArr;
    apz.data.loadData("DepositCheck", "chkdpt");
    setTimeout(function() {
        for (var i = 0; i < apz.chkdpt.DepositCheck.checklistArr.length; i++) {
            $("#chkdpt__DepositCheck__addicon_" + i).addClass("sno");
        }
        var lastrow = apz.chkdpt.DepositCheck.checklistArr.length - 1;
        $("#chkdpt__DepositCheck__addicon_" + lastrow).removeClass("sno");
        if (apz.chkdpt.DepositCheck.checklistArr.length == 0) {
            var lobj = {};
            lobj.frontImage = "upimg25.png";
            lobj.backImage = "upimg25.png";
            lobj.frontName = "";
            lobj.backName = "";
            lobj.checkNo = "";
            lobj.Bank = "";
            lobj.AccountNo = "";
            lobj.Name = "";
            lobj.Amount = "";
            apz.chkdpt.DepositCheck.checklistArr.push(lobj);
            apz.data.scrdata.chkdpt__DepositCheck_Res = {}
            apz.data.scrdata.chkdpt__DepositCheck_Res.CheckList = apz.chkdpt.DepositCheck.checklistArr;
            apz.data.loadData("DepositCheck", "chkdpt");
            $("#chkdpt__DepositCheck__addicon_0").addClass("sno");
            $("#chkdpt__DepositCheck__delicon_0").addClass("sno");
            $("#chkdpt__DepositCheck__o__CheckList__frontImage_0").removeClass("sno");
            $("#chkdpt__DepositCheck__o__CheckList__backImage_0").removeClass("sno");
        }
    }, 200);
}
apz.chkdpt.DepositCheck.fngetOCRServiceData = function(params) {
    debugger;
    //apz.startLoader();
    var Random_digit = Math.floor(Math.random() * 1000000000);
    var today = new Date();
    var date = today.getFullYear() + "" + (today.getMonth() + 1) + "" + today.getDate();
    var time = today.getHours() + "" + today.getMinutes() + "" + today.getSeconds() + today.getMilliseconds();
    var dateTime = date + "" + time;
    var user_id = "ADMIN";
   // var txn_id_no = apz.appId + "_" + user_id + "_WEB_TRADE_LICENSE_" + Random_digit + "_" + dateTime;
    var ocrrequestjson = {
        "user_id": "ADMIN",
        "txn_id": String(+new Date),
        "document_type": "CHEQUE_SLIP",
        "document_id": "HDFC_Front",
        "data_format": "IMG_BASE64",
        "preprocessed_type": "COLOR",
        "device_type": "WEB",
        "data_text": "",
        "data_cord": "",
        "addtional_param": [],
        "data_base64": params.encodedImage
    };
   
    if(params.filenames == "HDFCFront.jpeg"){
        ocrrequestjson.document_id = "HDFC_Front";
    }
     if(params.filenames == "SBIFront.jpeg"){
        ocrrequestjson.document_id = "SBI_Front";
    }
     if(params.filenames == "AosFront.jpeg"){
        ocrrequestjson.document_id = "BoA_front";
    }
    
    
    var lParams = {
        "ifaceName": "CheckDepositOCR",
        "buildReq": "N",
        "appId": "chkdpt",
        "paintResp": "N",
        "req": ocrrequestjson,
        "async": false,
        "callBack": apz.chkdpt.DepositCheck.fngetOCRServiceDataCB
    };
    
    //  apz.dispMsg({
    //         "message": "OCR Service is down"
    //     });
  apz.server.callServer(lParams);
}
apz.chkdpt.DepositCheck.fngetOCRServiceDataCB = function(pResp) {
    debugger;
    apz.stopLoader();
    if (!pResp.res.chkdpt__CheckDepositOCR_Res.extracted_entities) {
        apz.dispMsg({
            "message": "Certificate Not Valid"
        });
    } else {
        var result = pResp.res.chkdpt__CheckDepositOCR_Res.extracted_entities;
        //var scrDetails = apz.data.scrdata.comdtl__corpInfo_Req.tbComiCorpInfo;
        apz.chkdpt.DepositCheck.checklistArr[apz.chkdpt.DepositCheck.lrowno].AccountNo = result.account_no;
        apz.chkdpt.DepositCheck.checklistArr[apz.chkdpt.DepositCheck.lrowno].Bank = result.bank_name;
        apz.chkdpt.DepositCheck.checklistArr[apz.chkdpt.DepositCheck.lrowno].Name = result.holder_name;
        apz.chkdpt.DepositCheck.checklistArr[apz.chkdpt.DepositCheck.lrowno].checkNo = result.cheque_no;
        apz.chkdpt.DepositCheck.checklistArr[apz.chkdpt.DepositCheck.lrowno].Amount = result.amount;
        apz.setElmValue("chkdpt__DepositCheck__o__CheckList__checkNo_" + apz.chkdpt.DepositCheck.lrowno, result.cheque_no);
        apz.setElmValue("chkdpt__DepositCheck__o__CheckList__Bank_" + apz.chkdpt.DepositCheck.lrowno, result.bank_name);
        apz.setElmValue("chkdpt__DepositCheck__o__CheckList__Amount_" + apz.chkdpt.DepositCheck.lrowno, result.amount);
        apz.setElmValue("chkdpt__DepositCheck__o__CheckList__AccountNo_" + apz.chkdpt.DepositCheck.lrowno, result.account_no);
        apz.setElmValue("chkdpt__DepositCheck__o__CheckList__Name_" + apz.chkdpt.DepositCheck.lrowno, result.holder_name);
       
        //apz.data.loadData("corpInfo", "comdtl")
    }
}
apz.chkdpt.DepositCheck.fnonKeyup = function(pthis, ptype) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    apz.chkdpt.DepositCheck.checklistArr[lrow][ptype] = apz.getElmValue(pthis.id);
}
