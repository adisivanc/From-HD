apz.permgt.personaDetails = {};
apz.app.onLoad_PersonaDetails = function(pUserObj) {
    apz.permgt.personaDetails.paintPersonaDetails(pUserObj);
    apz.data.loadJsonData("PersonaDetail","permgt");
}
apz.permgt.personaDetails.paintPersonaDetails = function(pUserObj) {
    if (pUserObj.name) {
        $("#permgt__PersonaMaster__i__tbAsmiPersonaMaster__name").attr("disabled", "disabled")
        apz.data.scrdata.permgt__PersonaMaster_Req = {};
        apz.data.scrdata.permgt__PersonaMaster_Req.tbAsmiPersonaMaster = [];
        apz.data.scrdata.permgt__PersonaMaster_Req.tbAsmiPersonaMaster.push(pUserObj);
        apz.data.loadData("PersonaMaster", "permgt");
        apz.permgt.personaDetails.fetchPersonaFuntions();
    }
};
apz.permgt.personaDetails.fetchPersonaFuntions = function() {
    apz.server.callServer({
        ifaceName: 'PersonaFunction_Query',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            tbAsmiPersonaFunction: [{
                personaName: apz.getElmValue("permgt__PersonaMaster__i__tbAsmiPersonaMaster__name")
            }]
        },
        paintResp: 'Y',
        callBack: apz.permgt.personaDetails.fetchPersonaFuntionsCB
    });
};
apz.permgt.personaDetails.fetchPersonaFuntionsCB = function(pResp) {};
apz.permgt.personaDetails.addPersonaDetails = function() {
    apz.permgt.personaDetails.deletePersonaDetails();
};
apz.permgt.personaDetails.deletePersonaDetails = function() {
    apz.server.callServer({
        ifaceName: 'PersonaMaster_Delete',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            tbAsmiPersonaMaster: [{
                name: apz.getElmValue("permgt__PersonaMaster__i__tbAsmiPersonaMaster__name")
            }]
        },
        paintResp: 'N',
        callBack: apz.permgt.personaDetails.deletePersonaDetailsCB
    });
};
apz.permgt.personaDetails.deletePersonaDetailsCB = function(pResp) {
    apz.permgt.personaDetails.newPersonaDetails();
};
apz.permgt.personaDetails.newPersonaDetails = function() {
    apz.server.callServer({
        ifaceName: 'PersonaMaster_New',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            tbAsmiPersonaMaster: [{
                name: apz.getElmValue("permgt__PersonaMaster__i__tbAsmiPersonaMaster__name"),
                description: apz.getElmValue("permgt__PersonaMaster__i__tbAsmiPersonaMaster__description"),
                createdBy: apz.Login.sUserId,
            }]
        },
        paintResp: 'N',
        callBack: apz.permgt.personaDetails.newPersonaDetailsCB
    });
};
apz.permgt.personaDetails.newPersonaDetailsCB = function(pResp) {
    apz.permgt.personaDetails.deletePersonaFunctions();
};
apz.permgt.personaDetails.deletePersonaFunctions = function() {
	apz.data.buildData('PersonaFunction','permgt');
	var personaFunctions = apz.data.scrdata.permgt__PersonaFunction_Req.tbAsmiPersonaFunction;
	for(var i=0;i<personaFunctions.length;i++){
		personaFunctions[i].personaName = apz.getElmValue("permgt__PersonaMaster__i__tbAsmiPersonaMaster__name");
	}
    apz.server.callServer({
        ifaceName: 'PersonaFunction_Delete',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            tbAsmiPersonaFunction: [{
                personaName: apz.getElmValue("permgt__PersonaMaster__i__tbAsmiPersonaMaster__name")
            }]
        },
        paintResp: 'N',
        callBack: apz.permgt.personaDetails.deletePersonaFunctionsCB,
		callBackObj: personaFunctions
    });
};
apz.permgt.personaDetails.deletePersonaFunctionsCB = function(pResp) {
    apz.permgt.personaDetails.addPersonaFunctions(pResp.callBackObj);
};
apz.permgt.personaDetails.addPersonaFunctions = function(personaFunctions) {
	
    apz.server.callServer({
        ifaceName: 'PersonaFunction_New',
        appId: 'permgt',
        buildReq: 'N',
		req:{
            tbAsmiPersonaFunction:personaFunctions
		},
        paintResp: 'N',
        callBack: apz.permgt.personaDetails.addPersonaFunctionsCB
    });
};
apz.permgt.personaDetails.addPersonaFunctionsCB = function(pResp) {
    debugger;
    apz.data.buildData("PersonaFunction", "permgt");
    var lFunctions = apz.data.scrdata.permgt__PersonaFunction_Req.tbAsmiPersonaFunction;
    for (var i = 0; i < lFunctions.length; i++) {
		if(lFunctions[i]!=undefined){
        if (lFunctions[i].functionId == "Dashboard") {
            apz.permgt.personaDetails.ModifyDashboard(lFunctions[i].design);
        }
		}
    }
    apz.permgt.personaDetails.back();
};
apz.permgt.personaDetails.ModifyDashboard = function(pDesign) {
    apz.server.callServer({
        ifaceName: 'UserDashboard_Modify',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            'tbDbmiCorpUserDashboard': {
                'corporateId': apz.Login.sCorporateId,
                'userId': apz.Login.sUserId,
                'dashboardId': pDesign
            }
        },
        paintResp: 'N',
        callBack: apz.permgt.personaDetails.ModifyDashboardCB
    });
};
apz.permgt.personaDetails.ModifyDashboardCB = function(params) {
    apz.permgt.personaDetails.deleteExistingUserDashboardWidgets();
};
apz.permgt.personaDetails.deleteExistingUserDashboardWidgets = function() {
    apz.server.callServer({
        ifaceName: 'UserDashboardWidget_Delete',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            'tbDbmiCorpUserDashboardWidget': {
                'corporateId': apz.Login.sCorporateId,
                'userId': apz.Login.sUserId,
            }
        },
        paintResp: 'N',
        callBack: apz.permgt.personaDetails.deleteExistingUserDashboardWidgetsCB
    });
};
apz.permgt.personaDetails.deleteExistingUserDashboardWidgetsCB = function(params) {};
apz.permgt.personaDetails.back = function() {
    apz.launchSubScreen({
        div: "permgt__PersonaLauncher__persona_launcher",
        scr: "PersonaSummary",
        appId: "permgt",
        layout: "All"
    });
};
/*apz.app.postCreateRow = function(id) {
    if (id == "permgt__PersonaDetails__PersonaFunction__i__tbAsmiPersonaFunction") {
        var latestRow = apz.scrMetaData.containersMap["permgt__PersonaDetails__PersonaFunction__i__tbAsmiPersonaFunction"].pageRows - 1;
        $("#permgt__PersonaFunction__i__tbAsmiPersonaFunction__personaName_" + latestRow).val(apz.getElmValue(
            "permgt__PersonaMaster__i__tbAsmiPersonaMaster__name"));
    } else if (id == "permgt__PersonaDetails__user_persona") {
        var latestRow = apz.scrMetaData.containersMap["permgt__PersonaDetails__user_persona"].pageRows - 1;
        $("#permgt__UserPersona__i__tbDbmiUserPersona__personaName_" + latestRow).val(apz.getElmValue(
            "permgt__PersonaMaster__i__tbAsmiPersonaMaster__name"));
        $("#permgt__UserPersona__i__tbDbmiUserPersona__corporateId_" + latestRow).val(apz.Login.sCorporateId);
    }
};*/
