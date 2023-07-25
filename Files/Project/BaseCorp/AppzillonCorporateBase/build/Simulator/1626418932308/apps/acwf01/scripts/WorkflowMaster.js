apz.acwf01.WorkflowMaster = {};
apz.app.onLoad_WorkflowMaster = function() {
    apz.acwf01.WorkflowMaster.fetchWorkflows();
}
apz.acwf01.WorkflowMaster.fetchWorkflows = function() {
    apz.server.callServer({
        ifaceName: 'WorkflowMaster',
        appId: 'acwf01',
        buildReq: 'Y',
        paintResp: 'N',
        callBack: apz.acwf01.WorkflowMaster.fetchWorkflowsCB
    });
};
apz.acwf01.WorkflowMaster.fetchWorkflowsCB = function(pResp) {
    debugger;
    var wArr = [];
    for(var i=0;i<pResp.res.acwf01__WorkflowMaster_Res.length;i++){
        var lobj = {};
        lobj.APP_ID = pResp.res.acwf01__WorkflowMaster_Res[i].app_id;
        lobj.WORKFLOW_ID = pResp.res.acwf01__WorkflowMaster_Res[i].workflow_id;
        lobj.WORKFLOW_DESC = pResp.res.acwf01__WorkflowMaster_Res[i].workflow_desc;
        wArr.push(lobj);
    }
    
    apz.data.scrdata.acwf01__WorkflowMaster_Res = {};
    apz.data.scrdata.acwf01__WorkflowMaster_Res = wArr;
    apz.data.loadData("WorkflowMaster","acwf01");
    
};
apz.acwf01.WorkflowMaster.launchWorkflowDetails = function(pObj) {
    var rowno = $(pObj).attr("rowno");
    var wf_id = $(pObj).parent().parent().children().find("span[id*='WORKFLOW_ID']").text();
    var app_id = $(pObj).parent().parent().children().find("span[id*='APP_ID']").text()
    var desc = $(pObj).parent().parent().children().find("span[id*='WORKFLOW_DESC']").text()
    var userObj = {
        workflowId: wf_id,
        appId: app_id,
        desc:desc
    };
    apz.launchSubScreen({
        scr: "WorkflowDef",
        div: "ACNR01__Navigator__launchPad",
        userObj: userObj,
        layout: "All",
        appId: "acwf01"
    });
};
