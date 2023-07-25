apz.permgt.editDashboardMap = {};
apz.permgt.editDashboardMap.ModifyDashboard = function() {
    apz.server.callServer({
        ifaceName: 'UserDashboard_Modify',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            'tbDbmiCorpUserDashboard': {
                'corporateId': apz.Login.sCorporateId,
                'userId': apz.Login.sUserId,
                'dashboardId': apz.getElmValue('permgt__PersonaDashboard__i__tbAsmiPersonaFunction__design')
            }
        },
        paintResp: 'N',
        callBack: apz.permgt.editDashboardMap.ModifyDashboardCB
    });
};
apz.permgt.editDashboardMap.ModifyDashboardCB = function(params) {
    apz.permgt.editDashboardMap.deleteExistingUserDashboardWidgets();
};
apz.permgt.editDashboardMap.deleteExistingUserDashboardWidgets = function() {
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
        callBack: apz.permgt.editDashboardMap.deleteExistingUserDashboardWidgetsCB
    });
};
apz.permgt.editDashboardMap.deleteExistingUserDashboardWidgetsCB = function(params) {
    apz.permgt.editDashboardMap.deleteCurrentPersonaDashboard();
};
apz.permgt.editDashboardMap.deleteCurrentPersonaDashboard = function() {
    apz.server.callServer({
        ifaceName: 'PersonaDashboard_Delete',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            'tbAsmiPersonaFunction': [{
                'personaName': apz.getElmValue('permgt__PersonaDashboard__i__tbAsmiPersonaFunction__personaName'),
                'functionId': 'Dashboard',
            }]
        },
        paintResp: 'N',
        callBack: apz.permgt.editDashboardMap.deleteCurrentPersonaDashboardCB
    });
};
apz.permgt.editDashboardMap.deleteCurrentPersonaDashboardCB = function(params) {
    apz.permgt.editDashboardMap.insertNewPersonaDashboard();
};
apz.permgt.editDashboardMap.insertNewPersonaDashboard = function(){
    apz.server.callServer({
        ifaceName: 'PersonaDashboard_New',
        appId: 'permgt',
        buildReq: 'N',
        req: {
            'tbAsmiPersonaFunction': [{
                'personaName': apz.getElmValue('permgt__PersonaDashboard__i__tbAsmiPersonaFunction__personaName'),
                'functionId': 'Dashboard',
                'design': apz.getElmValue('permgt__PersonaDashboard__i__tbAsmiPersonaFunction__design')
            }]
        },
        paintResp: 'N',
        callBack: apz.permgt.editDashboardMap.insertNewPersonaDashboardCB
    });
};
apz.permgt.editDashboardMap.insertNewPersonaDashboardCB = function(params){
    
}
