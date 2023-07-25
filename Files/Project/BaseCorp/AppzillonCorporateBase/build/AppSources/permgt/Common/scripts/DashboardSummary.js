apz.app.onLoad_DashboardSummary = function() {
    apz.server.callServer({
        ifaceName: 'PersonaDashboard_Query',
        appId: 'permgt',
        buildReq: 'Y',
        paintResp: 'Y'
    })
}
