//apz.lonact = {};
apz.lonact.Components = {};
apz.lonact.Components.sAction = "new";
apz.app.onLoad_Components = function(userObj) {
    debugger;
    apz.lonact.continueFlag = "Components";
    if (!apz.isNull(apz.lonact.componentListArray)) {
        apz.data.scrdata.lonact__componentNameList_Res = {};
        apz.data.scrdata.lonact__componentNameList_Res.Name = apz.lonact.componentListArray;
        apz.data.loadData("componentNameList", "lonact");
        var lObj = document.getElementById("lonact__ComponentDetails__o__componentDetails__componentName");
        apz.populateDropdown(lObj, apz.lonact.componentDDValues);
        for (var i = 0; i < apz.lonact.componentDDValues.length; i++) {
            for (var j = 0; j < apz.lonact.componentListArray.length; j++) {
                if (apz.lonact.componentDDValues[i].val == apz.lonact.componentListArray[j].componentName) {
                    apz.lonact.componentDDValues.splice(i, 1);
                    break;
                }
            }
        }
        apz.populateDropdown(lObj, apz.lonact.componentDDValues);
        apz.data.scrdata.lonact__ComponentDetails_Res = {};
        apz.data.loadData("ComponentDetails", "lonact");
        $("#lonact__Components__ct_lst_1").removeClass("sno");
        //$("#lonact__Components__ct_lst_1_row_0").trigger("click");
    }
    apz.data.loadJsonData("ScheduleData", "lonact");
};
apz.lonact.Components.fnSaveRecord = function() {
    debugger;
    $("#lonact__Components__ct_lst_1").removeClass("sno");
    $("#lonact__ComponentDetails__o__componentDetails__componentName").attr("disabled", false);
    apz.data.buildData("ComponentDetails", "lonact");
    var liquidation = $("#lonact__Components__el_btn_1").hasClass("current");
    if (liquidation == true) {
        apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails.liquidationMode = "Auto";
    } else {
        apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails.liquidationMode = "Manual";
    }
    let currentComponent = "";
    if (apz.lonact.Components.sAction == "update") {
        currentComponent = apz.lonact.componentName;
        apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails.componentName = currentComponent;
    } else {
        currentComponent = apz.getElmValue("lonact__ComponentDetails__o__componentDetails__componentName");
    }
    if (!apz.isNull(currentComponent)) {
        var result = apz.lonact.componentDDValues.filter(obj => obj.val !== currentComponent);
        var lObj = document.getElementById("lonact__ComponentDetails__o__componentDetails__componentName");
        apz.lonact.componentDDValues = result;
        apz.populateDropdown(lObj, apz.lonact.componentDDValues);
        if (apz.lonact.Components.sAction == "new") {
            apz.lonact.loanDetails.components.push(apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails);
            apz.lonact.componentListArray = [];
            for (let i = 0; i < apz.lonact.loanDetails.components.length; i++) {
                var componentListName = {};
                componentListName.componentName = apz.lonact.loanDetails.components[i].componentName;
                apz.lonact.componentListArray.push(componentListName);
            }
            apz.lonact.Components.fnClearData();
            apz.data.scrdata.lonact__componentNameList_Res = {};
            apz.data.scrdata.lonact__componentNameList_Res.Name = apz.lonact.componentListArray;
            apz.data.loadData("componentNameList", "lonact");
        } else if (apz.lonact.Components.sAction == "update") {
            apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails.componentName = apz.lonact.componentName;
            apz.lonact.loanDetails.components[apz.lonact.Components.rowNo] = apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails;
            apz.lonact.Components.fnClearData();
            $("#lonact__Components__deleteButton").addClass("sno");
        }
    }
    $("#lonact__Components__ct_lst_1 .current").removeClass("current");
    apz.lonact.Components.sAction = "new";
};
// apz.lonact.Components.fnChangeComponent = function(){
//     apz.lonact.Components.sAction = "new";
//     $("#lonact__Components__deleteButton").addClass("sno");
//     $("#lonact__Components__ct_lst_1 .current").removeClass("current");
// };
apz.lonact.Components.fnClearData = function() {
    $(".DropdownCheck04 .current").removeClass("current");
    apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails = {};
    apz.data.loadData("ComponentDetails", "lonact");
};
apz.lonact.Components.fnShowSaveButton = function() {
    $("#lonact__Components__saveButton").removeClass("sno");
};
apz.lonact.Components.fnPopulateRecord = function(pResp) {
    debugger;
    apz.lonact.Components.sAction = "update";
    $("#lonact__Components__addRecordButton").addClass("sno");
    $("#lonact__Components__deleteButton").removeClass("sno");
    $("#lonact__Components__saveButton").removeClass("sno");
    apz.lonact.Components.rowNo = $(pResp).attr("rowNo");
    apz.lonact.componentName = apz.data.scrdata.lonact__componentNameList_Res.Name[apz.lonact.Components.rowNo].componentName;
    var result = apz.lonact.loanDetails.components.filter(obj => obj.componentName === apz.lonact.componentName);
    apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails = result[0];
    if (apz.data.scrdata.lonact__ComponentDetails_Res.componentDetails.liquidationMode == "Auto") {
        $("#lonact__Components__sc_col_28 > ul >li>button").removeClass("current");
        $("#lonact__Components__el_btn_1").addClass("current");
    } else {
        $("#lonact__Components__sc_col_28 > ul >li>button").removeClass("current");
        $("#lonact__Components__el_btn_2").addClass("current");
    }
    apz.data.loadData("ComponentDetails", "lonact");
    $("#lonact__Components__ct_lst_1 > ul >li").removeClass("current");
    $("#lonact__Components__ct_lst_1_row_" + apz.lonact.Components.rowNo).addClass("current");
};
apz.lonact.Components.fnDeleteData = function() {
    $("#lonact__Components__sc_col_28 > ul >li>button").removeClass("current");
    $("#lonact__ComponentDetails__o__componentDetails__componentName").attr("disabled", false);
    apz.lonact.loanDetails.components = apz.lonact.loanDetails.components.filter(obj => obj.componentName !== apz.lonact.componentName);
    apz.lonact.componentListArray = apz.lonact.componentListArray.filter(obj => obj.componentName !== apz.lonact.componentName);
    apz.lonact.Components.fnClearData();
    apz.data.scrdata.lonact__componentNameList_Res = {};
    apz.data.scrdata.lonact__componentNameList_Res.Name = apz.lonact.componentListArray;
    apz.data.loadData("componentNameList", "lonact");
    apz.lonact.componentDDValues.push({
        "val": apz.lonact.componentName,
        "desc": apz.lonact.componentName
    });
    var lObj = document.getElementById("lonact__ComponentDetails__o__componentDetails__componentName");
    apz.populateDropdown(lObj, apz.lonact.componentDDValues);
    apz.lonact.Components.sAction = "new";
    $("#lonact__Components__deleteButton").addClass("sno");
    $("#lonact__Components__ct_lst_1 .current").removeClass("current");
};
apz.lonact.Components.fnAddButton1Class = function() {
    $("#lonact__Components__sc_col_28 > ul >li>button").removeClass("current");
    $("#lonact__Components__el_btn_1").addClass("current");
}
apz.lonact.Components.fnAddButton2Class = function() {
    $("#lonact__Components__sc_col_28 > ul >li>button").removeClass("current");
    $("#lonact__Components__el_btn_2").addClass("current");
}
apz.lonact.Components.fnShowSchedule = function() {
    $("#lonact__Components__ScheduleRow").removeClass("sno");
}
apz.lonact.Components.fnClickServiceAcct = function() {
    debugger;
    var params = {
        "targetId": "lonact__Components__ServiceAcctModal"
    }
    apz.toggleModal(params);
    apz.data.scrdata.lonact__ServiceAccountsList_Res = {};
    apz.data.scrdata.lonact__ServiceAccountsList_Res.LIstItem = [{
        "AccountNo": "0984561234"
    }, {
        "AccountNo": "9034568912"
    }, {
        "AccountNo": "7834576232"
    }, {
        "AccountNo": "8903458722"
    }];
    apz.data.loadData("ServiceAccountsList", "lonact");
}
apz.lonact.Components.fnSelectAcct = function(pthis) {
    debugger;
    var lrow = $(pthis).attr("rowno");
    var lServiceAcct = apz.getElmValue("lonact__ServiceAccountsList__o__LIstItem__AccountNo_" + lrow);
    apz.setElmValue("lonact__ComponentDetails__o__componentDetails__serviceAccount", lServiceAcct);
    var params = {
        "targetId": "lonact__Components__ServiceAcctModal"
    }
    apz.toggleModal(params);
}
