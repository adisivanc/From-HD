apz.dbtest.test = {}
apz.dbtest.test.iteration = 0;
apz.app.onLoad_Test = function() {
    debugger;
    var j=0;
apz.dbtest.test.custWidgetArr = [];
apz.dbtest.test.widget = []
apz.dbtest.test.mapps = []
apz.dbtest.test.custMicroappArr = [];

    var lResponse = 
        [{
            "sequence": 1,
            "widgetId": "test__te7654n2",
            "screenName": "Test2",
            "type": "widget",
            "userId": "Admin"
        }, {
            "sequence": 2,
            "widgetId": "test__t7654mn2",
            "screenName": "Test2",
            "type": "widget",
            "userId": "Admin"
        }, {
            "sequence": 1,
            "widgetId": "test__test_column2",
            "screenName": "Test2",
            "type": "microapp",
            "userId": "Admin"
        }, {
            "sequence": 2,
            "widgetId": "test__test_colu345",
            "screenName": "Test2",
            "type": "microapp",
            "userId": "Admin"
        }]
    for(i=0;i<lResponse.length;i++){
        if(lResponse[i].type == "widget"){
            apz.dbtest.test.custWidgetArr.push(lResponse[i].widgetId);
            
        }else if(lResponse[i].type == "microapp"){
            apz.dbtest.test.custMicroappArr.push(lResponse[i].widgetId);
        }
    }
    /* var lReq = {
        "tbCelerityCustomize": [{
            "userId": "Admin",
            "sequence": 9,
            "screenName": "Test1",
            "type" :"widget",
            "widgetId" : "test__test_column1"
        }, {
            "userId": "Admin",
            "sequence": 8,
            "screenName": "Test2",
            "type" :"MicroApp",
            "widgetId" : "test__test_column2"
        }, {
            "userId": "Admin",
            "sequence": 7,
            "screenName": "Test3",
            "type" :"widget",
            "widgetId" : "test__test_column3"
        } ]
    }
    //for(;apz.dbtest.test.iteration<lReq.tbCelerityCustomize.length;){
        var lServerParams = {
        "ifaceName": "UserDetails_New",
        "buildReq": "N",
        "req": lReq,
        "paintResp": "N",
        "callBack": apz.dbtest.test.fnInsertCallBack
    };
    debugger;
    apz.server.callServer(lServerParams);
    apz.dbtest.test.iteration++;
    //}
   */
};
apz.dbtest.test.fnQueryCallBack = function(params) {
    debugger;
    if (params.errors) {
        if (params.errors[0].errorMessage == "No Data Found.") {
            var lReq = {
                "tbCelerityCustomize": {
                    "userId": "Admin",
                    "order": 6,
                    "screenName": "Test"
                }
            }
            var lServerParams = {
                "ifaceName": "GetUserDetails_New",
                "buildReq": "N",
                "req": lReq,
                "paintResp": "N",
                "callBack": apz.dbtest.test.fnInsertCallBack
            };
            debugger;
            apz.server.callServer(lServerParams);
        }
    } else {
        var lServerParams = {
            "ifaceName": "InsertUserDetails_Modify",
            "buildReq": "N",
            "req": "",
            "paintResp": "N",
            "callBack": apz.dbtest.test.fnUpdateCallBack
        };
        debugger;
        apz.server.callServer(lServerParams);
    }
}
apz.dbtest.test.fnInsertCallBack = function(params) {
    debugger;
}
apz.dbtest.test.fnUpdateCallBack = function(params) {
    debugger;
}