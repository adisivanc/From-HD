apz.ddinst.ecssummary = {};
apz.ddinst.ecssummary.sParams = {};
apz.app.onLoad_EcsSummary = function(params) {
    debugger;
    apz.ddinst.ecssummary.sParams = params;
   
    apz.ddinst.ecssummary.fnInitialise(params);
}

apz.ddinst.ecssummary.fnInitialise = function(params) {
    
     jsondata   = JSON.parse(apz.getFile(apz.getDataFilesPath("ddinst") + "/ecsMandate.json"));
     apz.data.scrdata.ddinst__ecsMandate_Res = {};
        apz.data.scrdata.ddinst__ecsMandate_Res = jsondata;
        apz.data.loadData("ecsMandate", "ddinst");
     apz.ddinst.ecssummary.fetchEcsListCB(jsondata);

};
apz.ddinst.ecssummary.fetchEcsListCB = function(params) {
    debugger;
}
apz.ddinst.ecssummary.fnClickView = function(pthis) {
    debugger;
    var lrow = parseInt($(pthis).attr("rowno"));
    apz.hide("ddinst__EcsSummary__summ1");
    apz.hide("ddinst__EcsSummary__summ2");
    apz.show("ddinst__EcsSummary__summ3");
    var lLaunchParams = {
        "appId": "ddinst",
        "scr": "EcsMandateDetails",
        "div": "ddinst__EcsLauncher__row1",
        "layout":"All",
        "userObj": {
            "action": "view",
            "data": apz.data.scrdata.ddinst__ecsMandate_Res.EcsMandateRes.data[lrow],
        }
    }
    if (apz.ddinst.ecssummary.sParams.Navigation) {
        lLaunchParams.userObj.Navigation = apz.ddinst.ecssummary.sParams.Navigation
    }
    apz.launchSubScreen(lLaunchParams);
}
apz.ddinst.ecssummary.fnClickEdit = function(pthis) {
    debugger;
    var lrow = parseInt($(pthis).attr("rowno"));
    apz.hide("ddinst__EcsSummary__summ1");
    apz.hide("ddinst__EcsSummary__summ2");
    apz.show("ddinst__EcsSummary__summ3");
    var lLaunchParams = {
        "appId": "ddinst",
        "scr": "EcsMandateDetails",
        "div": "ddinst__EcsLauncher__row1",
        "userObj": {
            "action": "edit",
            "data": apz.data.scrdata.ddinst__ecsMandate_Res.EcsMandateRes.data[lrow],
             
        }
        }
         lLaunchParams.userObj.data.customerID ="00001" 
    
    if (apz.ddinst.ecssummary.sParams.Navigation) {
        lLaunchParams.userObj.Navigation = apz.ddinst.ecssummary.sParams.Navigation
    }
    apz.launchSubScreen(lLaunchParams);
}
apz.ddinst.ecssummary.fnAdd = function() {
    debugger;
    var Params = {
        "appId": "ddinst",
        "scr": "EcsMandateDetails",
        "div": "ddinst__EcsLauncher__row1",
        "layout":"All",
        "userObj": {
             "data": {
                "customerID": "00001",
            }
        
        }
    }
    if (apz.ddinst.ecssummary.sParams.Navigation) {
        Params.userObj.Navigation = apz.ddinst.ecssummary.sParams.Navigation
    }
    apz.launchSubScreen(Params);
}
apz.ddinst.ecssummary.fnClickDelete = function(pthis) {
    debugger;
    var lrow = parseInt($(pthis).attr("rowno"));
    apz.hide("ddinst__EcsSummary__summ1");
    apz.hide("ddinst__EcsSummary__summ2");
    apz.show("ddinst__EcsSummary__summ3");
    var lLaunchParams = {
        "appId": "ddinst",
        "scr": "EcsMandateDetails",
        "div": "ddinst__EcsLauncher__row1",
        "userObj": {
            "action": "delete",
            "data": apz.data.scrdata.ddinst__ecsMandate_Res.EcsMandateRes.data[lrow]
        }
    }
    if (apz.ddinst.ecssummary.sParams.Navigation) {
        lLaunchParams.userObj.Navigation = apz.ddinst.ecssummary.sParams.Navigation
    }
    apz.launchSubScreen(lLaunchParams);
}
