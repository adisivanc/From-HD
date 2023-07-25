apz.acrl01.ModifyRole = {};
apz.app.onLoad_ModifyRole = function(params) {
    debugger;
    apz.acrl01.ModifyRole.sCorporateId = apz.Login.sCorporateId;
    apz.acrl01.ModifyRole.sUserId = apz.Login.sUserId;
    apz.acrl01.ModifyRole.sDiv = params.div;
    apz.acrl01.ModifyRole.sAction = "";
    apz.acrl01.ModifyRole.sRoleData = {};
    apz.acrl01.ModifyRole.sEntitiesModified = false;
    apz.acrl01.ModifyRole.sModifiedEntity;
    apz.acrl01.ModifyRole.sLovData = {};
    $("#acrl01__ModifyRole__Corporate_Id").val(apz.acrl01.ModifyRole.sCorporateId);
    $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__corporateId").val(apz.acrl01.ModifyRole.sCorporateId);
    if (params.currentTask) {
        apz.acrl01.ModifyRole.sCurrentTask = params.currentTask;
        apz.acrl01.ModifyRole.sCurrentWfDetails = params.currentWfDetails;
        apz.acrl01.ModifyRole.sDiv = params.div;
        var lScreenData = JSON.parse(params.currentWfDetails.screenData);
        apz.data.scrdata.acrl01__RoleDetailsDummy_Req = {};
        apz.data.scrdata.acrl01__RoleDetailsDummy_Req = lScreenData;
        apz.data.loadData("RoleDetailsDummy", "acrl01");
        apz.acrl01.ModifyRole.buildAccountsData();
        $('#acrl01__ModifyRole__ct_lst_1_row_0').addClass('selected');
        $("#acrl01__ModifyRole__ct_lst_1_row_0").trigger('click');
        apz.acrl01.ModifyRole.fetchEntityHierarchy();
    } else {
        apz.acrl01.ModifyRole.sAction = params.action;
        if (params.action == "modify role") {
            $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleId").attr('disabled', true);
            apz.acrl01.ModifyRole.fetchRoleDetails(params.RoleMaster);
        } else if (params.action == "new role") {
            $("#acrl01__ModifyRole__ps_pls_18_ul h4").text('New Role');
            //apz.acrl01.ModifyRole.sEntitiesModified = true;
            $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleId").attr('disabled', false);
            apz.data.scrdata.acrl01__RoleDetailsDummy_Req = {};
            apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity = [];
            apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount = [];
            apz.data.loadData('RoleDetailsDummy', "acrl01");
            apz.acrl01.ModifyRole.fetchEntityHierarchy();
        }
    }
};
apz.app.onShown_ModifyRole = function() {
    debugger;
    setTimeout(function() {
        apz.acrl01.ModifyRole.showSelectedEntities();
    }, 10);
    apz.acrl01.ModifyRole.getCurrencies();
};
apz.acrl01.ModifyRole.getCurrencies = function() {
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "GetCurrencies_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "callBack": apz.acrl01.ModifyRole.getCurrenciesCB,
        "callBackObj": {}
    };
    apz.server.callServer(lServerParams);
};
apz.acrl01.ModifyRole.getCurrenciesCB = function(pResp) {
    debugger;
    var lCurrencyArr = pResp.res.acrl01__GetCurrencies_Res.tbDbmiCorpCurrency;
    var lCurrencyLength = lCurrencyArr.length;
    var lArr = [];
    for (var i = 0; i < lCurrencyLength; i++) {
        var lObj = {
            "val": lCurrencyArr[i].currencyVal,
            "desc": lCurrencyArr[i].currencyDesc,
        };
        lArr.push(lObj);
    }
    apz.populateDropdown(document.getElementById("acrl01__ModifyRole__CurrencyDD"), lArr);
    if (apz.acrl01.ModifyRole.sAction = 'modify role') {
        //var lCurrency = $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleEntity__currency_0_txtcnt").text();
        var lCurrency = $("#acrl01__ModifyRole__ct_lst_1 .selected .currency").text();
        apz.setElmValue('acrl01__ModifyRole__CurrencyDD', lCurrency);
    }
};
apz.acrl01.ModifyRole.fetchRoleDetails = function(pRoleMasterObj) {
    var lRoleId = pRoleMasterObj.roleId;
    var lCorporateId = pRoleMasterObj.corporateId;
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "RoleDetails_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "callBack": apz.acrl01.ModifyRole.fetchRoleDetailsCB,
        "callBackObj": {
            "RoleMaster": pRoleMasterObj
        }
    };
    var req = {};
    req.tbDbmiCorpRoleEntity = {};
    req.tbDbmiCorpRoleEntity.corporateId = lCorporateId;
    req.tbDbmiCorpRoleEntity.roleId = lRoleId;
    req.tbDbmiCorpRoleAccount = {};
    req.tbDbmiCorpRoleAccount.corporateId = lCorporateId;
    req.tbDbmiCorpRoleAccount.roleId = lRoleId;
    req.tbDbmiCorpRoleOperations = {};
    req.tbDbmiCorpRoleOperations.corporateId = lCorporateId;
    req.tbDbmiCorpRoleOperations.roleId = lRoleId;
    req.tbDbmiCorpRoleFiles = {};
    req.tbDbmiCorpRoleFiles.corporateId = lCorporateId;
    req.tbDbmiCorpRoleFiles.roleId = lRoleId;
    req.tbDbmiCorpRoleScr = {};
    req.tbDbmiCorpRoleScr.corporateId = lCorporateId;
    req.tbDbmiCorpRoleScr.roleId = lRoleId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acrl01.ModifyRole.fetchRoleDetailsCB = function(pResp) {
    debugger;
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req = {};
    if (pResp.res.acrl01__RoleDetails_Req) {
        apz.data.scrdata.acrl01__RoleDetailsDummy_Req = pResp.res.acrl01__RoleDetails_Req;
    } else {
        apz.data.scrdata.acrl01__RoleDetailsDummy_Req = pResp.res.acrl01__RoleDetails_Res;
    }
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster = pResp.callBackObj.RoleMaster;
    apz.data.loadData("RoleDetailsDummy", "acrl01");
    apz.acrl01.ModifyRole.buildAccountsData();
    $('#acrl01__ModifyRole__ct_lst_1_row_0').addClass('selected');
    $("#acrl01__ModifyRole__ct_lst_1_row_0").trigger('click');
    apz.acrl01.ModifyRole.fetchEntityHierarchy();
};
apz.acrl01.ModifyRole.fetchEntityHierarchy = function() {
    debugger;
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "CorporateHierarchy_Query",
        "buildReq": "N",
        "req": "",
        "paintResp": "Y",
        "callBack": apz.acrl01.ModifyRole.fetchEntityHierarchyCB,
    };
    var req = {};
    req.tbDbmiCorpEntityMaster = {};
    req.tbDbmiCorpEntityMaster.corporateId = apz.acrl01.ModifyRole.sCorporateId;
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
};
apz.acrl01.ModifyRole.fetchEntityHierarchyCB = function(pResp) {
    debugger
    var lDataSource = pResp.resFull.appzillonBody.acrl01__CorporateHierarchy_Res.tbDbmiCorpEntityMaster;
    var lArrLength = lDataSource.length;
    var lChartArr = [];
    for (var i = 0; i < lArrLength; i++) {
        var lObj = {};
        lObj.id = lDataSource[i].entityId;
        lObj.name = lDataSource[i].entityName + "<br><h3>" + lDataSource[i].entityId + "</h3>";
        lObj.parent = lDataSource[i].parentEntity;
        lChartArr.push(lObj);
    }
    $(function() {
        org_chart = $('#acrl01__ModifyRole__drag_node_loader').orgChart({
            data: lChartArr, // your data
            showControls: false, // display add or remove node button.
            allowEdit: false, // click the node's title to edit
            onAddNode: function(node) {},
            onDeleteNode: function(node) {},
            onClickNode: function(node) {
                debugger;
                var lScreenData = apz.data.buildData("RoleDetailsDummy", "acrl01");
                apz.data.scrdata.acrl01__RoleDetailsDummy_Req = lScreenData.acrl01__RoleDetailsDummy_Req;
                var lClickedEntityId = node.data.id;
                var lNodes = $("#acrl01__ModifyRole__drag_node_loader").find(".node");
                var lNodesLength = lNodes.length;
                for (var i = 0; i < lNodesLength; i++) {
                    var lEntityId = $(lNodes[i]).attr('node-id');
                    if (lClickedEntityId == lEntityId) {
                        $(lNodes[i]).toggleClass('selnode');
                        if ($(lNodes[i]).hasClass('selnode')) {
                            var lEntityObj = {};
                            lEntityObj.corporateId = apz.acrl01.ModifyRole.sCorporateId;
                            lEntityObj.roleId = $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleId").val();
                            lEntityObj.entityId = lClickedEntityId;
                            lEntityObj.transactionLimit = "";
                            lEntityObj.authorizationLimit = "";
                            var lEntityArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
                            var lEntityLength = lEntityArr.length;
                            var lEntityNew = true;
                            for (var k = 0; k < lEntityLength; k++) {
                                debugger;
                                if (lEntityArr[k].entityId == lClickedEntityId) {
                                    lEntityNew = false;
                                    break;
                                }
                            }
                            if (lEntityNew) {
                                apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity.push(lEntityObj);
                            }
                        } else {
                            var lEntitiesArrLength = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity.length;
                            var lEntitiesArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
                            var lEntities = [];
                            for (var j = 0; j < lEntitiesArrLength; j++) {
                                if (lEntitiesArr[j].entityId != lClickedEntityId) {
                                    lEntities.push(lEntitiesArr[j]);
                                }
                            }
                            apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity = lEntities;
                            var lAccountsArrLength = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount.length;
                            var lAccountssArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount;
                            var lAccounts = [];
                            for (var j = 0; j < lAccountsArrLength; j++) {
                                if (lAccountssArr[j].entityId != lClickedEntityId) {
                                    lAccounts.push(lAccountssArr[j]);
                                }
                            }
                            apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount = lAccounts;
                        }
                    };
                };
                apz.data.loadData("RoleDetailsDummy", "acrl01");
                apz.acrl01.ModifyRole.buildAccountsData();
                $("#acrl01__ModifyRole__ct_lst_1_row_0").trigger('click');
            },
            newNodeText: 'Add Child' // text of add button
        });
    });
};
apz.app.preCreateRow = function(pContainerId) {
    debugger;
    var lRoleId = $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleId").val();
    if (apz.val.validateContainer("acrl01__ModifyRole__RoleMasterForm")) {
        if (pContainerId == "acrl01__ModifyRole__Accounts_Table") {
            if (apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity.length == 0) {
                var msg = {
                    "code": 'ENTITY_MIS',
                };
                apz.dispMsg(msg);
                return false;
            } else {
                return true;
            }
        }
        return true;
    } else {
        var msg = {
            "code": 'ROLE_MIS',
        };
        apz.dispMsg(msg);
        return false;
    }
};
apz.app.postCreateRow = function(pcontainerId) {
    debugger;
    var lRoleId = $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleId").val();
    if (pcontainerId == "acrl01__ModifyRole__Operations_Table") {
        var lRow = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleOperations.length - 1;
        lRow = lRow % 5;
        $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleOperations__corporateId_" + lRow).val(apz.acrl01.ModifyRole.sCorporateId);
        $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleOperations__roleId_" + lRow).val(lRoleId);
    } else if (pcontainerId == "acrl01__ModifyRole__Accounts_Table") {
        apz.acrl01.ModifyRole.sEntitiesModified = true;
        var lRow = apz.data.scrdata.acrl01__RoleAccountsDummy_Req.tbDbmiCorpRoleAccount.length - 1
        lRow = lRow % 5;
        $("#acrl01__RoleAccountsDummy__i__tbDbmiCorpRoleAccount__corporateId_" + lRow).val(apz.acrl01.ModifyRole.sCorporateId);
        $("#acrl01__RoleAccountsDummy__i__tbDbmiCorpRoleAccount__roleId_" + lRow).val(lRoleId);
        $("#acrl01__RoleAccountsDummy__i__tbDbmiCorpRoleAccount__entityId_" + lRow).val($("#acrl01__ModifyRole__entity_id_dummy").val());
        //$("#acrl01__RoleAccountsDummy__i__tbDbmiCorpRoleAccount__accessRights_" + lRow).val("BOTH");
    } else if (pcontainerId == "acrl01__ModifyRole__File_Type_Table") {
        var lRow = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleFiles.length - 1
        lRow = lRow % 5;
        $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleFiles__corporateId_" + lRow).val(apz.acrl01.ModifyRole.sCorporateId);
        $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleFiles__roleId_" + lRow).val(lRoleId);
    } else if (pcontainerId == "acrl01__ModifyRole__Menu_Table") {
        var lRow = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleScr.length - 1
        lRow = lRow % 5;
        $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleScr__corporateId_" + lRow).val(apz.acrl01.ModifyRole.sCorporateId);
        $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleScr__roleId_" + lRow).val(lRoleId);
    }
};
apz.acrl01.ModifyRole.editEntityDetails = function(pObj) {
    debugger;
    if (apz.acrl01.ModifyRole.sEntitiesModified == true) {
        apz.acrl01.ModifyRole.updateEntityJson(apz.acrl01.ModifyRole.sModifiedEntity);
    };
    $(pObj).parent().find(".selected").removeClass("selected");
    $(pObj).addClass("selected");
    var lEntityId = $(pObj).find('.entity').text();
    var lAuthlmt = $(pObj).find('.authLmt').text();
    var lTxnlmt = $(pObj).find('.txnLmt').text();
    var lCurrency = $(pObj).find('.currency').text();
    $("#acrl01__ModifyRole__entity_id_dummy").val(lEntityId);
    $("#acrl01__ModifyRole__txn_limit").val(lTxnlmt);
    $("#acrl01__ModifyRole__auth_limit").val(lAuthlmt);
    apz.setElmValue('acrl01__ModifyRole__CurrencyDD', lCurrency);
    apz.acrl01.ModifyRole.sModifiedEntity = lEntityId;
    apz.data.scrdata.acrl01__RoleAccountsDummy_Req = {};
    var lRoleEntityData = apz.acrl01.ModifyRole.sRoleData.entityArr;
    var lRoleEntityLength = lRoleEntityData.length;
    for (var i = 0; i < lRoleEntityLength; i++) {
        if (lRoleEntityData[i].entityId == lEntityId) {
            apz.data.scrdata.acrl01__RoleAccountsDummy_Req.tbDbmiCorpRoleAccount = lRoleEntityData[i].tbDbmiCorpRoleAccount;
            break;
        }
    }
    apz.data.loadData("RoleAccountsDummy", "acrl01");
};
apz.acrl01.ModifyRole.buildAccountsData = function() {
    debugger;
    apz.acrl01.ModifyRole.sRoleData.entityArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
    var lEntityArr = apz.acrl01.ModifyRole.sRoleData.entityArr;
    var lEntityArrLength = lEntityArr.length;
    for (var i = 0; i < lEntityArrLength; i++) {
        apz.acrl01.ModifyRole.sRoleData.entityArr[i].tbDbmiCorpRoleAccount = [];
        if (apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount != undefined && apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount
            .length != 0) {
            for (var j = 0; j < apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount.length; j++) {
                if (apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount[j].entityId == lEntityArr[i].entityId) {
                    apz.acrl01.ModifyRole.sRoleData.entityArr[i].tbDbmiCorpRoleAccount.push(apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleAccount[
                        j]);
                }
            }
        }
    }
};
apz.acrl01.ModifyRole.showSelectedEntities = function() {
    debugger;
    if (apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity != undefined && apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity
        .length != 0) {
        var lEntityArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
        var lEntityLen = lEntityArr.length;
        var lNodes = $("#acrl01__ModifyRole__drag_node_loader").find(".node");
        var lNodesLength = lNodes.length;
        for (var i = 0; i < lEntityLen; i++) {
            var Entity = lEntityArr[i].entityId;
            for (var j = 0; j < lNodesLength; j++) {
                var lEntityId = $(lNodes[j]).attr('node-id');
                if (Entity == lEntityId) {
                    $(lNodes[j]).toggleClass('selnode');
                }
            }
        };
    }
};
apz.acrl01.ModifyRole.updateTxnLimit = function() {
    debugger;
    var lActiveRow = apz.acrl01.ModifyRole.sEntitiesModified = true;
    var lRow = $("#acrl01__ModifyRole__ct_lst_1 .selected").attr('rowno');
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity[lRow].transactionLimit = $("#acrl01__ModifyRole__txn_limit").val();
    setTimeout(function() {
        var lTxnLmt = $("#acrl01__ModifyRole__txn_limit").val();
        $("#acrl01__ModifyRole__ct_lst_1 .selected .txnLmt").text(lTxnLmt);
    }, 500);
    //apz.data.loadData("RoleDetailsDummy",'acrl01');
};
apz.acrl01.ModifyRole.updateAuthLimit = function() {
    debugger;
    apz.acrl01.ModifyRole.sEntitiesModified = true;
    var lRow = $("#acrl01__ModifyRole__ct_lst_1 .selected").attr('rowno');
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity[lRow].authorizationLimit = $("#acrl01__ModifyRole__auth_limit").val();
    setTimeout(function() {
        var lAuthlmt = $("#acrl01__ModifyRole__auth_limit").val();
        $("#acrl01__ModifyRole__ct_lst_1 .selected .authLmt").text(lAuthlmt);
    }, 500);
    //apz.data.loadData("RoleDetailsDummy",'acrl01');
};
apz.acrl01.ModifyRole.updateCurrency = function() {
    debugger;
    apz.acrl01.ModifyRole.sEntitiesModified = true;
    var lRow = $("#acrl01__ModifyRole__ct_lst_1 .selected").attr('rowno');
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity[lRow].currency = apz.getElmValue("acrl01__ModifyRole__CurrencyDD");
    var lCurrency = apz.getElmValue("acrl01__ModifyRole__CurrencyDD");
    $("#acrl01__ModifyRole__ct_lst_1 .selected .currency").text(lCurrency);
};
apz.acrl01.ModifyRole.updateEntityJson = function(pEntityId) {
    debugger;
    var lScreenData = apz.data.buildData("RoleDetailsDummy", "acrl01");
    apz.data.scrdata.acrl01__RoleDetailsDummy_Req = lScreenData.acrl01__RoleDetailsDummy_Req;
    apz.acrl01.ModifyRole.sRoleData.entityArr = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity;
    apz.data.loadData("RoleDetailsDummy", 'acrl01');
    var lBuildData = apz.data.buildData("RoleAccountsDummy", 'acrl01');
    var lUpdatedData = lBuildData.acrl01__RoleAccountsDummy_Req;
    var lMaster = apz.acrl01.ModifyRole.sRoleData.entityArr;
    var lMasterLength = lMaster.length;
    for (var i = 0; i < lMasterLength; i++) {
        if (lMaster[i].entityId == pEntityId) {
            apz.acrl01.ModifyRole.sRoleData.entityArr[i].tbDbmiCorpRoleAccount = lUpdatedData.tbDbmiCorpRoleAccount;
            break;
        }
    }
};
apz.acrl01.ModifyRole.save = function() {
    if (apz.val.validateContainer("acrl01__ModifyRole__RoleMasterForm")) {
        var lEntitiesSelected = apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleEntity.length;
        if (lEntitiesSelected) {
            var lRoleScreenData = apz.data.buildData("RoleDetailsDummy", 'acrl01');
            var lRoleData = lRoleScreenData.acrl01__RoleDetailsDummy_Req;
            if (apz.acrl01.ModifyRole.sEntitiesModified) {
                var lActiveEntity = $("#acrl01__ModifyRole__ct_lst_1 .selected .entity").text();
                apz.acrl01.ModifyRole.updateEntityJson(lActiveEntity);
            }
            var lScreenData = {};
            if (apz.acrl01.ModifyRole.sAction == "new role") {
                lScreenData.tbDbmiCorpRoleMaster = {};
                lScreenData.tbDbmiCorpRoleMaster.corporateId = apz.acrl01.ModifyRole.sCorporateId;
                lScreenData.tbDbmiCorpRoleMaster.roleId = $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleId").val();
                lScreenData.tbDbmiCorpRoleMaster.roleDescription = $("#acrl01__RoleDetailsDummy__i__tbDbmiCorpRoleMaster__roleDescription").val();
                lScreenData.tbDbmiCorpRoleMaster.versionNo = "1";
                lScreenData.tbDbmiCorpRoleMaster.makerId = apz.acrl01.ModifyRole.sUserId;
                lScreenData.tbDbmiCorpRoleMaster.makerTs = apz.acrl01.ModifyRole.convertToMySQLTS();
                lScreenData.tbDbmiCorpRoleMaster.checkerId = "";
                lScreenData.tbDbmiCorpRoleMaster.checkerTs = "";
            } else if (apz.acrl01.ModifyRole.sAction == "modify role") {
                debugger;
                lRoleData.tbDbmiCorpRoleMaster.corporateId = apz.acrl01.ModifyRole.sCorporateId;
                lScreenData.tbDbmiCorpRoleMaster = lRoleData.tbDbmiCorpRoleMaster;
                lScreenData.tbDbmiCorpRoleMaster.makerId = apz.acrl01.ModifyRole.sUserId;
                lScreenData.tbDbmiCorpRoleMaster.makerTs = apz.acrl01.ModifyRole.convertToMySQLTS();
            };
            lScreenData.tbDbmiCorpRoleEntity = [];
            lScreenData.tbDbmiCorpRoleFiles = lRoleData.tbDbmiCorpRoleFiles;
            lScreenData.tbDbmiCorpRoleAccount = [];
            lScreenData.tbDbmiCorpRoleOperations = lRoleData.tbDbmiCorpRoleOperations;
            lScreenData.tbDbmiCorpRoleScr = lRoleData.tbDbmiCorpRoleScr;
            var lEntitiesDummy = [];
            for (var i = 0; i < apz.acrl01.ModifyRole.sRoleData.entityArr.length; i++) {
                lEntitiesDummy.push($.extend(true, {}, apz.acrl01.ModifyRole.sRoleData.entityArr[i]));
            }
            for (var i = 0; i < lEntitiesDummy.length; i++) {
                if (lEntitiesDummy[i].tbDbmiCorpRoleAccount.length > 0) {
                    lScreenData.tbDbmiCorpRoleAccount = $.merge(lScreenData.tbDbmiCorpRoleAccount, lEntitiesDummy[i].tbDbmiCorpRoleAccount);
                }
                delete lEntitiesDummy[i].tbDbmiCorpRoleAccount;
                lScreenData.tbDbmiCorpRoleEntity.push(lEntitiesDummy[i]);
            }
            debugger;
            console.log(JSON.stringify(lScreenData));
            if (!apz.mockServer) {
                var taskObj = {};
                taskObj.workflowId = "CPMR";
                //taskObj.stageId = "INPUT";
                taskObj.status = "U";
                //taskObj.userId = apz.acrl01.ModifyRole.sUserId;
                taskObj.taskType = "MODIFY ROLE";
                taskObj.versionNo = "1";
                //taskObj.appId = "acrl01";
                //taskObj.screenId = "ModifyRole";
                taskObj.screenData = JSON.stringify(lScreenData);
                //taskObj.stageSeqNo = 1;
                taskObj.action = "";
                //taskObj.createUserId = apz.acrl01.ModifyRole.sUserId;
                taskObj.referenceId = apz.acrl01.ModifyRole.sCorporateId + "__" + apz.data.scrdata.acrl01__RoleDetailsDummy_Req.tbDbmiCorpRoleMaster.roleId;
                taskObj.taskDesc = taskObj.referenceId + " role has been modified";
                var lUserObj = {};
                lUserObj.operation = "NEWWORKFLOW";
                lUserObj.taskDetails = taskObj;
                lUserObj.callBack = apz.acrl01.ModifyRole.modifyRoleCB;
                var lParams = {
                    "appId": "acwf01",
                    "scr": "WorkFlow",
                    "div": "acrl01__ModifyRole__launchMicroService",
                    "layout": "All",
                    "type": "CF",
                    "userObj": lUserObj
                };
                apz.launchApp(lParams);
            } else {
                var lObj = {};
                lObj.currentWfDetails = {};
                // lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                // lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                 lObj.currentTask = "";
                lObj.currentWfDetails.screenData = JSON.stringify(lScreenData);
                lObj.div = apz.acrl01.ModifyRole.sDiv;
                var lParams = {
                    "appId": "acrl01",
                    "scr": "ViewRole",
                    "userObj": lObj,
                    "div": apz.acrl01.ModifyRole.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            }
        } else {
            var msg = {
                "code": 'ENTITY_MIS',
            };
            apz.dispMsg(msg);
        }
    } else {
        var msg = {
            "code": 'ROLE_MIS',
        };
        apz.dispMsg(msg);
    }
};
apz.acrl01.ModifyRole.modifyRoleCB = function(pRespObj) {
    debugger;
    apz.currAppId = "acrl01";
    if (pRespObj.tbDbmiWorkflowMaster.status != "COMPLETED") {
        if (pRespObj.tbDbmiWorkflowMaster.stageType == "USERTASK") {
            if (pRespObj.stageAccess) {
                var lObj = {};
                lObj.currentTask = pRespObj.tbDbmiWorkflowMaster;
                lObj.currentWfDetails = pRespObj.tbDbmiWorkflowDetail;
                lObj.div = apz.acrl01.ModifyRole.sDiv;
                var lParams = {
                    "appId": lObj.currentWfDetails.appId,
                    "scr": lObj.currentWfDetails.screenId,
                    "userObj": lObj,
                    "div": apz.acrl01.ModifyRole.sDiv,
                    "layout": "All"
                };
                apz.launchSubScreen(lParams);
            } else {
                var lParams = {
                    "appId": "tscm01",
                    "scr": "TaskCompleted",
                    "div": "ACNR01__Navigator__launchPad",
                    "layout": "All",
                    "type": "CF",
                    "userObj": {
                        "referenceId": pRespObj.tbDbmiWorkflowMaster.referenceId
                    }
                };
                apz.launchApp(lParams);
            }
        }
    }
};
apz.acrl01.ModifyRole.convertToMySQLTS = function() {
    var starttime = new Date();
    var isotime = new Date((new Date(starttime)).toISOString());
    var fixedtime = new Date(isotime.getTime() - (starttime.getTimezoneOffset() * 60000));
    var formatedMysqlString = fixedtime.toISOString().slice(0, 19).replace('T', ' ');
    console.log(formatedMysqlString);
    return formatedMysqlString;
};
apz.acrl01.ModifyRole.Cancel = function() {
    //have to check  
    $("#acrl01__RolesList__RoleSummary").removeClass("sno");
    $("#acrl01__RolesList__search_row").removeClass('sno');
    $("#acrl01__RolesList__RoleScreensLaunch").addClass("sno");
    $("#acrl01__RolesList__Role_Summary_Header").removeClass('sno');
};
apz.acrl01.ModifyRole.fetchFileExtensions = function(pObj) {
    debugger;
    var lId = $(pObj).attr('id');
    var lFileValues = $(pObj).val();
    var lFileType = $(pObj).closest('tr').find('.filetype input').val();
    var lServerParams = {
        "appId": "acrl01",
        "ifaceName": "FileExtensionsQuery",
        "buildReq": "N",
        "req": "",
        "paintResp": "N",
        "callBack": apz.acrl01.ModifyRole.fetchFileExtensionsCB,
        "callBackObj": {
            "dropDownID": lId,
            "fileValues": lFileValues
        }
    };
    var lReq = {};
    lReq.fileType = lFileType;
    lServerParams.req = lReq;
    apz.server.callServer(lServerParams);
};
apz.acrl01.ModifyRole.fetchFileExtensionsCB = function(pResp) {
    debugger;
    if (!pResp.errors) {
        var lFileExtensions = pResp.res.acrl01__FileExtensionsQuery_Res;
        var lExtensionsLength = lFileExtensions.length;
        var lArr = [];
        for (var i = 0; i < lExtensionsLength; i++) {
            var lObj = {
                "val": lFileExtensions[i].extension,
                "desc": lFileExtensions[i].extension,
            };
            lArr.push(lObj);
        }
        apz.populateDropdown(document.getElementById(pResp.callBackObj.dropDownID), lArr);
        var lVal = pResp.callBackObj.fileValues.replace(/ /g, "");
        apz.setElmValue(pResp.callBackObj.dropDownID, lVal);
    }
};
apz.acrl01.ModifyRole.numberUnformat = function(pObj) {
    debugger;
    var lUnformattedNumber = $(pObj).val().replace(/,/g, "");
    try {
        lUnformattedNumber = lUnformattedNumber.split(".")[0];
        $("#" + pObj.id).val(lUnformattedNumber);
    } catch (e) {}
};