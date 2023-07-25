 apz.acsf01.scfTemplate = {};
 apz.app.onLoad_SCFTemplate = function() {
     debugger;
     if (apz.Login) {
         apz.acsf01.scfTemplate.sCorporateId = apz.Login.sCorporateId;
     } else {
         apz.acsf01.scfTemplate.sCorporateId = "000FTAC4321";
     }
     $("#acsf01__SCFTemplateSummary__SCFrow").hide();
      $("#acsf01__SCFTemplateSummary__MobSCFrow").hide();
     apz.data.scrdata.acsf01__SCFTemplate_Req = {};
     apz.data.scrdata.acsf01__SCFTemplate_Req.MappingTable = [];
     var lJson = {};
     lJson.fieldname = "";
     lJson.dbcolumn = "";
     lJson.datatype = "";
     lJson.datalength = "";
     lJson.sourcefield = "";
     apz.data.scrdata.acsf01__SCFTemplate_Req.MappingTable.push(lJson);
     apz.data.loadData("SCFTemplate", "acsf01");
 };
 apz.acsf01.scfTemplate.saveData = function() {
     debugger;
     var lScreenData = apz.data.buildData("SCFTemplate", "acsf01");
     var lMapTableObj = lScreenData.acsf01__SCFTemplate_Req.MappingTable;
     var lMapTableLength = lMapTableObj.length;
     var lReqTemplateObj = {};
     for (var i = 0; i < lMapTableLength; i++) {
         var lCurrRowObj = {};
         var lCurrRow = lMapTableObj[i];
         lCurrRowObj = {};
         var lFieldName = lCurrRow.fieldname;
         lCurrRowObj.dbcolumn = "col" + (i + 1);
         lCurrRowObj.datatype = lCurrRow.datatype;
         lCurrRowObj.datalength = lCurrRow.datalength;
         lCurrRowObj.sourcefield = lCurrRow.sourcefield;
         //.split(' ').join('_');
         lReqTemplateObj[lFieldName] = {};
         lReqTemplateObj[lFieldName] = lCurrRowObj;
     }
     // var lScreenData = apz.data.buildData("SCFTemplate", "acsf01");
     //     var ljson = {};
     // var lTabLength = apz.data.scrdata.acsf01__SCFTemplate_Req.MappingTable.length;
     // for(var i=0; i< lTabLength; i++) {
     //   var lobj = {};
     //   var lId = 'select2-acsf01__SCFTemplate__i__MappingTable__sourceField_' + i +'-container';
     //   var lselValue = document.getElementById(lId).innerHTML.trim();
     //   lobj.dbcolumn = 'col'+i;
     //   lobj.sourcefield = lselValue.split(' ').join('_');
     //   ljson[lselValue] = lobj;
     // }
     var lServerParams = {
         "ifaceName": "TemplateQuery",
         "buildReq": "N",
         "appId": "acsf01",
         "req": "",
         "paintResp": "Y",
         "async": "true",
         "callBack": apz.acsf01.scfTemplate.saveDataCB,
         "callBackObj": "",
     };
     var lReqJson = {};
     lReqJson.addTemplateDetails = {};
     lReqJson.addTemplateDetails.template = JSON.stringify(lReqTemplateObj);
     lReqJson.addTemplateDetails.corporateId = apz.acsf01.scfTemplate.sCorporateId;
     lReqJson.addTemplateDetails.extension = lScreenData.acsf01__SCFTemplate_Req.tbDbmiCorpFileTemplate.extension;
     lReqJson.addTemplateDetails.templateName = lScreenData.acsf01__SCFTemplate_Req.tbDbmiCorpFileTemplate.templateName;
     lReqJson.addTemplateDetails.templateType = lScreenData.acsf01__SCFTemplate_Req.tbDbmiCorpFileTemplate.templateType;
     //  lReqJson.action = "Query";
     //  lReqJson.table = "tb_dbmi_corp_file_template";
     lReqJson.importFunction = "TemplateSummary";
     lServerParams.req = lReqJson;
     apz.server.callServer(lServerParams);
 };
 apz.acsf01.scfTemplate.saveDataCB = function(params) {
     debugger;
     if (params.status === true && params.resFull.appzillonHeader.status === true) {
         if (params.res.acsf01__TemplateQuery_Res.Status) {
             var lMsg = {};
             lMsg.code = "TEMP_SUCS";
             lMsg.callBack = apz.acsf01.scfTemplate.showSummary;
             apz.dispMsg(lMsg);
         } else {}
     } else {
         lmsg = {
             "message": params.errors[0].errorMessage,
             "type": "E"
         };
         apz.dispMsg(lmsg);
         
     }
 };
 apz.acsf01.scfTemplate.showSummary = function() {
     debugger;
     $("#acsf01__SCFTemplateSummary__SCFrow").show();
     $("#acsf01__SCFTemplateSummary__MobSCFrow").show();
     $("#acsf01__SCFTemplateSummary__SummaryRow").removeClass('sno');
     $("#acsf01__SCFTemplateSummary__launchScreenRow").addClass('sno');
 };
 apz.acsf01.scfTemplate.fnCancel = function() {
     $("#acsf01__SCFTemplateSummary__SCFrow").show();
     $("#acsf01__SCFTemplateSummary__MobSCFrow").show();
     $("#acsf01__SCFTemplateSummary__SummaryRow").removeClass('sno');
     $("#acsf01__SCFTemplateSummary__launchScreenRow").addClass('sno');
 };
