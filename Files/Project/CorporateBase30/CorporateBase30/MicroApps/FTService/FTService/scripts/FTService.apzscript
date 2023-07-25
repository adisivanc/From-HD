apz.ftserv.FTService = {};
apz.app.onLoad_FTService = function(params) {
    apz.ftserv.FTService.fnCallService(params);
}
apz.ftserv.FTService.fnCallService = function(params) {
    debugger;
    var lServerParams = {
        "ifaceName": "FTService",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "async": "true",
        "callBack": params.callBack,
        "callBackObj": {
            "userObj": params.Wfdetails
        }
    };
    var req = {};
    req.fundsTransferDetails = params.fundsTransferDetails;
    req.action = params.action;
    req.table = params.table;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
}