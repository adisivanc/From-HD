apz.permgt.personaSummary = {};
apz.app.onLoad_PersonaSummary = function() {
    apz.permgt.personaSummary.fetchPersonas();
}
apz.permgt.personaSummary.fetchPersonas = function() {
    apz.server.callServer({
        ifaceName: 'PersonaMasterView_Query',
        appId: 'permgt',
        buildReq: 'Y',
        paintResp: 'Y',
        callBack: apz.permgt.personaSummary.fetchPersonasCB
    });
};
apz.permgt.personaSummary.fetchPersonasCB = function(pResp) {debugger;};
apz.permgt.personaSummary.showPersonaDetails = function(pObj) {
    var lIndex = $(pObj).attr("rowno");
    var lPersonaObj = apz.data.scrdata.permgt__PersonaMasterView_Req.tbAsmiPersonaMaster[lIndex];
    apz.launchSubScreen({
        div: "permgt__PersonaLauncher__persona_launcher",
        scr: "PersonaDetails",
        appId: "permgt",
        layout: "All",
        userObj: lPersonaObj
    });
};
apz.permgt.personaSummary.addNewPersona = function() {
    apz.launchSubScreen({
        div: "permgt__PersonaLauncher__persona_launcher",
        scr: "PersonaDetails",
        appId: "permgt",
        layout: "All"
    });
};