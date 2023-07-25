apz.acwf01.WorkflowDef = {};
apz.app.onLoad_WorkflowDef = function(pUserObj) {
    apz.setElmValue("acwf01__WorkflowDef__workflowId",pUserObj.workflowId);
    apz.setElmValue("acwf01__WorkflowDef__appId",pUserObj.appId);
    apz.setElmValue("acwf01__WorkflowDef__description",pUserObj.desc);
    apz.acwf01.WorkflowDef.fetchWorkflows(pUserObj);
};
apz.acwf01.WorkflowDef.fetchWorkflows = function(pUserObj) {
    apz.server.callServer({
        ifaceName: 'WorkFlow_Query',
        appId: 'acwf01',
        buildReq: 'N',
        req: {
            tbDbmiWorkflow: [
                {
                    workflowId: pUserObj.workflowId,
                    appId: pUserObj.appId
                }
            ]
        },
        paintResp: 'Y',
        callBack: apz.acwf01.WorkflowDef.fetchWorkflowsCB
    });
};
apz.acwf01.WorkflowDef.fetchWorkflowsCB = function(pResp) {
    debugger;
};
apz.acwf01.WorkflowDef.saveChanges = function() {
    apz.data.buildData("WorkFlow", "acwf01");
    apz.server.callServer({
        ifaceName: 'WorkFlow_Modify',
        appId: 'acwf01',
        buildReq: 'N',
        req: apz.data.scrdata.acwf01__WorkFlow_Req,
        paintResp: 'N',
        callBack: apz.acwf01.WorkflowDef.saveChangesCB
    });
};
apz.acwf01.WorkflowDef.saveChangesCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        apz.dispMsg({
            message: "Workflow changes saved",
            type: "S"
        });
    }
};
apz.acwf01.WorkflowDef.back = function() {
    apz.launchSubScreen({
        scr: "WorkflowMaster",
        div: "ACNR01__Navigator__launchPad",
        layout: "All",
        appId: "acwf01"
    });
};