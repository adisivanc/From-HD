apz.acru01.RuleBuilder = {};
apz.acru01.RuleBuilder.ruleText = "";
apz.acru01.RuleBuilder.sAction = "";
apz.acru01.RuleBuilder.sRecordNo = "";
apz.acru01.RuleBuilder.StageDetails = {};
apz.acru01.RuleBuilder.sQAction = "";
apz.acru01.RuleBuilder.sGroupRow = 0;
apz.acru01.RuleBuilder.taskvariables = "";
apz.acru01.RuleBuilder.sDiv = "";
var lArray = [];
apz.app.onLoad_RuleBuilder = function(params) {
    debugger;
    apz.acru01.RuleBuilder.sCurrentRow = 0;
    $("#acru01__RulesSummary__RulesSummaryHeader").addClass('sno');
    $("#acru01__MaintainRules__MaintainRHeader").addClass('sno');
    $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__nextStage_grp_lbl").addClass("req");
    apz.acru01.RuleBuilder.sAction = params.action;
    apz.acru01.RuleBuilder.sDiv = params.div;
    if (apz.acru01.RuleBuilder.sAction == "Modify Rule") {
        $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId").attr('disabled', true);
        apz.acru01.RuleBuilder.sRecordNo = params.RecordNo;
        apz.acru01.RuleBuilder.StageDetails = params.StageDetails;
        apz.data.scrdata.acru01__RuleDetailsDummy_Req = {};
        apz.data.scrdata.acru01__RuleDetailsDummy_Req.tbDbmiWorkflowRuleDetail = params.StageDetails;
        apz.acru01.RuleBuilder.StageDetails.functionId = params.StageDetails.functionId;
    } else if (apz.acru01.RuleBuilder.sAction == "New Function") {
        $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId").attr('disabled', false);
        apz.data.scrdata.acru01__RuleDetailsDummy_Req = {};
    }
    apz.data.loadData("RuleDetailsDummy", "acru01");
    apz.acru01.RuleBuilder.fnRenderFunction(params);
};
apz.app.onShown_RuleBuilder = function(params) {
    debugger;
    //$("#acru01__RuleBuilder__addGroupBtn").trigger('click');
};
apz.acru01.RuleBuilder.fetchRuleDetailsCB = function(pResp) {};
apz.acru01.RuleBuilder.addRule = function() {
    debugger;
    //$("#acru01__RuleBuilder__rule_list>ul").append($("#acru01__RuleBuilder__rule_template_row").clone().attr("id", "rule_row"));
    var lRuleHtml = apz.acru01.RuleBuilder.fnAddRuleTemplate();
    $("#acru01__RuleBuilder__rule_list>ul").append(lRuleHtml);
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__operator_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__join_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    //apz.populateDropdown(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)), lArray);
};
apz.acru01.RuleBuilder.addGroup = function() {
    debugger;
    var lUl = document.createElement("UL");
    lUl.setAttribute("id", "rule_group");
    var lGroupRow = apz.acru01.RuleBuilder.fnAddGroupTemplate();
    $(lUl).append(lGroupRow);
    var lRuleRow = apz.acru01.RuleBuilder.fnAddRuleTemplate();
    $(lUl).append(lRuleRow);
    $("#acru01__RuleBuilder__rule_list>ul").append(lUl);
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 2)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__operator_' + (apz.acru01.RuleBuilder.sCurrentRow - 2)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__join_' + (apz.acru01.RuleBuilder.sCurrentRow - 2)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__operator_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__join_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    //apz.populateDropdown(document.getElementById("acru01__RuleBuilder__variable_"+ (apz.acru01.RuleBuilder.sCurrentRow - 2)), lArray);
    //apz.populateDropdown(document.getElementById("acru01__RuleBuilder__variable_"+ (apz.acru01.RuleBuilder.sCurrentRow-1)), lArray);
};
apz.acru01.RuleBuilder.fnAddGroupTemplate = function() {
    lRow = apz.acru01.RuleBuilder.sCurrentRow++;
    var lHtml = '<li id="rule_group_row" class="srb pri wrapped" rowno=' + lRow +
        ' onclick="apz.data.selectRow(this, event); apz.data.rowClicked(this,event);"><span><span id="acru01__RuleBuilder__sc_col_35_li" class="scb-col25 pri "><button id="acru01__RuleBuilder__el_btn_28" type="button" onclick="apz.acru01.RuleBuilder.addRule(this)" class="ett-bttn sec min suc" enabled="enabled"><span id="acru01__RuleBuilder__el_btn_28_txtcnt">ADD CONDITION</span></button><button id="acru01__RuleBuilder__el_btn_29" type="button" onclick="apz.acru01.RuleBuilder.addGroup(this);" class="ett-bttn sec min suc tooltipcls" enabled="enabled" original-title="Add group"><span id="acru01__RuleBuilder__el_btn_29_txtcnt">ADD GROUP</span></button><button id="acru01__RuleBuilder__el_btn_15" type="button" onclick="apz.acru01.RuleBuilder.deleteGroup(this)" class="ett-bttn sec min err icl" enabled="enabled"><svg id="btn_icon_icon-close" aria-hidden="true" class="ett-icon icon-close px24 "><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg><span id="acru01__RuleBuilder__el_btn_15_txtcnt"></span></button></span></span><span><span id="acru01__RuleBuilder__sc_col_36_li" class="scb-col20 pri "><div id="acru01__RuleBuilder__join_' +
        lRow + '" class="ett-swch  pri etw-100 var1" apztype="toggleswitch" aria-labelledby="acru01__RuleBuilder__join_' + lRow +
        '_ctrl_div" style=""><input checked="checked" name="acru01__RuleBuilder__join_' + lRow + '" id="acru01__RuleBuilder__join_' + lRow +
        '_00" type="radio" value="&amp;&amp;" class=" etw-100" enabled="enabled"><label class=" etw-100" for="acru01__RuleBuilder__join_' + lRow +
        '_00">AND</label><input name="acru01__RuleBuilder__join_' + lRow + '" id="acru01__RuleBuilder__join_' + lRow +
        '_11" type="radio" value="||" class=" etw-100" enabled="enabled"><label class=" etw-100" for="acru01__RuleBuilder__join_' + lRow +
        '_11">OR</label><span class="tslide"></span></div></span><span id="acru01__RuleBuilder__sc_col_32_li" class="scb-col20 pri "><span id="acru01__RuleBuilder__variable_' +
        lRow + '_span_' + lRow + '" class="ecn etw-95"><div id="acru01__RuleBuilder__variable_' + lRow +
        '_ext" class="etb-slct ett-slct  pri lft etw-95" enabled="enabled" style=""><input id="acru01__RuleBuilder__variable_' + lRow +
        '" class="sub-elt" type="text" readonly="readonly" value="' + lArray[0].desc + '"><span id="acru01__RuleBuilder__variable_' + lRow +
        '_span" class="sub-elt1"><svg class="icon icon-down px34"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-down"></use></svg></span><div id="acru01__RuleBuilder__variable_' +
        lRow + '_div" class="sub-ctr" original-id="acru01__RuleBuilder__variable_' + lRow + '"><ul id="acru01__RuleBuilder__variable_' + lRow +
        '_so" role="menu">'
    var liList = "";
    for (var k = 0; k < lArray.length; k++) {
        liList = liList + '<li id="acru01__RuleBuilder__variable_' + lRow + '_option_' + lArray[k].desc + '" class="" value="' + lArray[k].desc +
            '" tabindex="0">' + lArray[k].desc + '</li>'
    }
    var AList =
        '</ul></div></div></span></span><span id="acru01__RuleBuilder__sc_col_33_li" class="scb-col15 pri "><span id="acru01__RuleBuilder__operator_' +
        lRow + '_span_' + lRow + '" class="ecn etw-95 opeDD"><div id="acru01__RuleBuilder__operator_' + lRow +
        '_ext" class="etb-slct ett-slct  pri lft etw-95" enabled="enabled" style=""><input id="acru01__RuleBuilder__operator_' + lRow +
        '" class="sub-elt" type="text" readonly="readonly" value="="><span id="acru01__RuleBuilder__operator_' + lRow +
        '_span" class="sub-elt1"><svg class="icon icon-down px34"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-down"></use></svg></span><div id="acru01__RuleBuilder__operator_' +
        lRow + '_div" class="sub-ctr" original-id="acru01__RuleBuilder__operator_' + lRow + '"><ul id="acru01__RuleBuilder__operator_' + lRow +
        '_so" role="menu"><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_=" class=" is-selected" value="==" tabindex="0" selected="selected">=</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_<" class="" value=">" tabindex="0">&lt;</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_>" class="" value="<" tabindex="0">&gt;</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_<=" class="" value="=<" tabindex="0">&lt;=</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_>=" class="" value="=>" tabindex="0">&gt;=</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_!=" class="" value="!=" tabindex="0">!=</li></ul></div></div></span></span><span id="acru01__RuleBuilder__sc_col_34_li" class="scb-col20 pri "><span class="ecn etw-95" style=""><input id="acru01__RuleBuilder__value_' +
        lRow +
        '" class="etw-100 ett-inpt pri lft" type="text" formula="" maxlength="" placeholder="Value" enabled="enabled" value=""></span></span></span></li>';
    return lHtml + liList + AList;
};
apz.acru01.RuleBuilder.fnAddRuleTemplate = function() {
    debugger;
    lRow = apz.acru01.RuleBuilder.sCurrentRow++;
    var lHtml = '<li id="rule_row" class="srb pri wrapped" rowno=' + lRow +
        ' onclick="apz.data.selectRow(this, event); apz.data.rowClicked(this,event);"><span id="acru01__RuleBuilder__sc_col_36_li" class="scb-col20 pri "><div id="acru01__RuleBuilder__join_' +
        lRow + '" class="ett-swch  pri etw-100 var1" apztype="toggleswitch" aria-labelledby="acru01__RuleBuilder__join_' + lRow +
        '_ctrl_div" style=""><input checked="checked" name="acru01__RuleBuilder__join_' + lRow + '" id="acru01__RuleBuilder__join_' + lRow +
        '_00" type="radio" value="&amp;&amp;" class=" etw-100" enabled="enabled"><label class=" etw-100" for="acru01__RuleBuilder__join_' + lRow +
        '_00">AND</label><input name="acru01__RuleBuilder__join_' + lRow + '" id="acru01__RuleBuilder__join_' + lRow +
        '_11" type="radio" value="||" class=" etw-100" enabled="enabled"><label class=" etw-100" for="acru01__RuleBuilder__join_' + lRow +
        '_11">OR</label><span class="tslide"></span></div></span><span id="acru01__RuleBuilder__sc_col_32_li" class="scb-col20 pri "><span id="acru01__RuleBuilder__variable_' +
        lRow + '_span_' + lRow + '" class="ecn etw-95"><div id="acru01__RuleBuilder__variable_' + lRow +
        '_ext" class="etb-slct ett-slct  pri lft etw-95" enabled="enabled" style=""><input id="acru01__RuleBuilder__variable_' + lRow +
        '" class="sub-elt" type="text" readonly="readonly" value="' + lArray[0].desc + '"><span id="acru01__RuleBuilder__variable_' + lRow +
        '_span" class="sub-elt1"><svg class="icon icon-down px34"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-down"></use></svg></span><div id="acru01__RuleBuilder__variable_' +
        lRow + '_div" class="sub-ctr" original-id="acru01__RuleBuilder__variable_' + lRow + '"><ul id="acru01__RuleBuilder__variable_' + lRow +
        '_so" role="menu">'
    var liList = "";
    for (var k = 0; k < lArray.length; k++) {
        liList = liList + '<li id="acru01__RuleBuilder__variable_' + lRow + '_option_' + lArray[k].desc + '" class="" value="' + lArray[k].desc +
            '" tabindex="0">' + lArray[k].desc + '</li>'
    }
    var AList =
        '</ul></div></div></span></span><span id="acru01__RuleBuilder__sc_col_33_li" class="scb-col15 pri "><span id="acru01__RuleBuilder__operator_' +
        lRow + '_span_' + lRow + '" class="ecn etw-95 opeDD"><div id="acru01__RuleBuilder__operator_' + lRow +
        '_ext" class="etb-slct ett-slct  pri lft etw-95" enabled="enabled" style=""><input id="acru01__RuleBuilder__operator_' + lRow +
        '" class="sub-elt" type="text" readonly="readonly" value="="><span id="acru01__RuleBuilder__operator_' + lRow +
        '_span" class="sub-elt1"><svg class="icon icon-down px34"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-down"></use></svg></span><div id="acru01__RuleBuilder__operator_' +
        lRow + '_div" class="sub-ctr" original-id="acru01__RuleBuilder__operator_' + lRow + '"><ul id="acru01__RuleBuilder__operator_' + lRow +
        '_so" role="menu"><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_=" class=" is-selected" value="==" tabindex="0" selected="selected">=</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_<" class="" value=">" tabindex="0">&lt;</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_>" class="" value="<" tabindex="0">&gt;</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_<=" class="" value="=<" tabindex="0">&lt;=</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_>=" class="" value="=>" tabindex="0">&gt;=</li><li id="acru01__RuleBuilder__operator_' + lRow +
        '_option_!=" class="" value="!=" tabindex="0">!=</li></ul></div></div></span></span><span id="acru01__RuleBuilder__sc_col_34_li" class="scb-col20 pri "><span class="ecn etw-95" style=""><input id="acru01__RuleBuilder__value_' +
        lRow +
        '" class="etw-100 ett-inpt pri lft" type="text" formula="" maxlength="" placeholder="Value" enabled="enabled" value=""></span></span><span id="acru01__RuleBuilder__sc_col_35_li" class="scb-col25 pri "><button id="acru01__RuleBuilder__el_btn_28" type="button" onclick="apz.acru01.RuleBuilder.addRuleInGroup(this)" class="ett-bttn sec min suc" enabled="enabled"><span id="acru01__RuleBuilder__el_btn_28_txtcnt">ADD CONDITION</span></button><button id="acru01__RuleBuilder__el_btn_29" type="button" onclick="apz.acru01.RuleBuilder.addGroupInGroup(this);" class="ett-bttn sec min suc tooltipcls" enabled="enabled" original-title="Add group"><span id="acru01__RuleBuilder__el_btn_29_txtcnt">ADD GROUP</span></button><button id="acru01__RuleBuilder__el_btn_15" type="button" onclick="apz.acru01.RuleBuilder.deleteRule(this)" class="ett-bttn sec min err icl" enabled="enabled"><svg id="btn_icon_icon-close" aria-hidden="true" class="ett-icon icon-close px24 "><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-close"></use></svg><span id="acru01__RuleBuilder__el_btn_15_txtcnt"></span></button></span></li>';
    return lHtml + liList + AList;
};
apz.acru01.RuleBuilder.deleteRule = function(pObj) {
    $(pObj).parents("li").remove();
};
apz.acru01.RuleBuilder.deleteGroup = function(pObj) {
    $(pObj).parent().closest("ul").remove();
};
apz.acru01.RuleBuilder.addRuleInGroup = function(pObj) {
    debugger;
    var lHtml = apz.acru01.RuleBuilder.fnAddRuleTemplate();
    $(pObj).parent().closest("ul").append(lHtml);
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__operator_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__join_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    //apz.populateDropdown(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)), lArray);
};
apz.acru01.RuleBuilder.addGroupInGroup = function(pObj) {
    var lUl = document.createElement("UL");
    lUl.setAttribute("id", "rule_group");
    var lGroupRow = apz.acru01.RuleBuilder.fnAddGroupTemplate();
    $(lUl).append(lGroupRow);
    var lRuleRow = apz.acru01.RuleBuilder.fnAddRuleTemplate();
    $(lUl).append(lRuleRow);
    $(pObj).parent().closest("ul").append(lUl);
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 2)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__operator_' + (apz.acru01.RuleBuilder.sCurrentRow - 2)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__join_' + (apz.acru01.RuleBuilder.sCurrentRow - 2)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__variable_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__operator_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    apz.dropdownApz(document.getElementById('acru01__RuleBuilder__join_' + (apz.acru01.RuleBuilder.sCurrentRow - 1)));
    //apz.populateDropdown(document.getElementById("acru01__RuleBuilder__variable_"+ (apz.acru01.RuleBuilder.sCurrentRow - 2)), lArray);
    //apz.populateDropdown(document.getElementById("acru01__RuleBuilder__variable_"+ (apz.acru01.RuleBuilder.sCurrentRow-1)), lArray);
};
apz.acru01.RuleBuilder.generateRule = function() {
    apz.acru01.RuleBuilder.ruleText = "";
    apz.acru01.RuleBuilder.buildRule($("#acru01__RuleBuilder__rule_list>ul"));
};
apz.acru01.RuleBuilder.buildRule = function(pObj) {
    debugger;
    var lStVariable = $("#acru01__RuleBuilder__stOperand").val();
    var lStOperator = $("#acru01__RuleBuilder__stOperator").val();
    if (lStOperator == "=") {
        lStOperator = "==";
    }
    var variableType;
    for (var i = 0; i < lArray.length; i++) {
        if (lArray[i].val == lStVariable) {
            variableType = lArray[i].type;
        }
    }
    var lStValue;
    if (variableType == "Number") {
        lStValue = $("#acru01__RuleBuilder__stValue").val();
    } else {
        lStValue = "'" + $("#acru01__RuleBuilder__stValue").val() + "'";
    }
    apz.acru01.RuleBuilder.ruleText = apz.acru01.RuleBuilder.ruleText + lStVariable + " " + lStOperator + " " + lStValue;
    apz.acru01.RuleBuilder.buildInnerRules(pObj);
};
apz.acru01.RuleBuilder.buildInnerRules = function(pObj) {
    debugger;
    $(pObj).children().each(function(pIndex) {
        if (this.tagName == "LI" && this.id == "rule_row") {
            debugger;
            var lVariable = $(this).find("input[id*='acru01__RuleBuilder__variable']").val();
            var lOperator = $(this).find("input[id*='acru01__RuleBuilder__operator']").val();
            if (lOperator == "=") {
                lOperator = "==";
            }
            var variableType;
            for (var i = 0; i < lArray.length; i++) {
                if (lArray[i].val == lVariable) {
                    variableType = lArray[i].type;
                }
            }
            var lValue;
            if (variableType == "Number") {
                lValue = $(this).find("input[id*='acru01__RuleBuilder__value']").val();
            } else {
                lValue = "'" + $(this).find("input[id*='acru01__RuleBuilder__value']").val() + "'";
            }
            // var lValue = "'" + $(this).find("input[id*='acru01__RuleBuilder__value']").val() + "'";
            var lJoinId = $(this).find("input[id*='acru01__RuleBuilder__join']").attr('name');
            var lJoin = apz.getElmValue(lJoinId);
            apz.acru01.RuleBuilder.ruleText = apz.acru01.RuleBuilder.ruleText + " " + lJoin + " " + lVariable + " " + lOperator + " " + lValue;
            if ($(this).closest("ul").attr("id") == "rule_group") {
                var lLastChild = $(pObj).children().length - 1;
                if (pIndex == lLastChild) {
                    var lJoinId = $(this).parent().closest("ul").find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__join']").attr(
                        'name');
                    var lJoin = apz.getElmValue(lJoinId);
                    $(this).parents("ul").each(function(index) {
                        if (this.id == "rule_group") {
                            var lInnerJoinId = $(this).find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__join']").attr('name');
                            var lInnerJoin = apz.getElmValue(lInnerJoinId);
                            apz.acru01.RuleBuilder.ruleText = apz.acru01.RuleBuilder.ruleText + ") ";
                        }
                    });
                }
            }
            $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__ruleEquation").val(apz.acru01.RuleBuilder.ruleText);
        } else if (this.tagName == "UL") {
            debugger;
            var lGroupJoinId = $(this).find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__join']").attr('name');
            var lGroupJoin = apz.getElmValue(lGroupJoinId);
            var lVariable = $(this).find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__variable']").val();
            var lOperator = $(this).find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__operator']").val();
            if (lOperator == "=") {
                lOperator = "==";
            }
            var variableType;
            for (var i = 0; i < lArray.length; i++) {
                if (lArray[i].val == lVariable) {
                    variableType = lArray[i].type;
                }
            }
            var lValue;
            if (variableType == "Number") {
                lValue = $(this).find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__value']").val();
            } else {
                lValue = "'" + $(this).find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__value']").val() + "'";
            }
            // var lValue = "'" + $(this).find("li:nth-child(1)").find("input[id*='acru01__RuleBuilder__value']").val() + "'";
            apz.acru01.RuleBuilder.ruleText = apz.acru01.RuleBuilder.ruleText + " " + lGroupJoin + " (" + lVariable + " " + lOperator + " " +
                lValue;
            apz.acru01.RuleBuilder.buildInnerRules(this);
        } else {
            $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__ruleEquation").val(apz.acru01.RuleBuilder.ruleText);
        }
    });
};
apz.acru01.RuleBuilder.Save = function() {
    debugger;
    if (apz.val.validateContainer("acru01__RuleBuilder__Rule_Detail_Form") && apz.val.validateContainer("acru01__RuleBuilder__nxtStage_Form") && $(
        "#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__ruleEquation").val() != "") {
        apz.acru01.RuleBuilder.StageDetails.ruleEquation = $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__ruleEquation").val();
        apz.acru01.RuleBuilder.StageDetails.stageId = apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__stageId")
        apz.acru01.RuleBuilder.StageDetails.nextStage = apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__nextStage")
        if (apz.acru01.RuleBuilder.sAction == "Modify Rule") {
            apz.acru01.MaintainRules.updateRuleData(apz.acru01.RuleBuilder.sRecordNo, apz.acru01.RuleBuilder.StageDetails);
        } else if (apz.acru01.RuleBuilder.sAction == "New Function") {
            apz.acru01.RuleBuilder.StageDetails.corporateId = apz.acru01.RulesSummary.sCorporateId;
            apz.acru01.RuleBuilder.StageDetails.functionId = apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId");
            apz.acru01.RuleBuilder.StageDetails.functionDesc = $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId").val();
            var lRuleMaster = {};
            lRuleMaster.corporateId = apz.acru01.RulesSummary.sCorporateId;
            lRuleMaster.functionId = apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId");
            lRuleMaster.functionDesc = $("#acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId").val();
            lRuleMaster.makerId = "USER001";
            lRuleMaster.makerTs = apz.acru01.RuleBuilder.convertToMySQLTS();
            var params = {};
            params.appId = "acru01";
            params.scr = "MaintainRules";
            params.layout = "All";
            params.div = "acru01__RulesSummary__RulesScreenLaunch";
            params.userObj = {
                "action": "New Function",
                "ruleMasterData": lRuleMaster,
                "stageDetails": apz.acru01.RuleBuilder.StageDetails,
                "div": apz.acru01.RuleBuilder.sDiv
            };
            apz.launchSubScreen(params);
        }
    }
};
apz.acru01.RuleBuilder.Cancel = function() {
    debugger
    if (apz.acru01.RuleBuilder.sAction == "Modify Rule") {
        $("#acru01__MaintainRules__Rule_Details_Row").removeClass("sno");
        $("#acru01__MaintainRules__Launch_Modify_Rule").addClass('sno');
        $("#acru01__MaintainRules__MaintainRHeader").removeClass('sno');
        $("#acru01__MaintainRules__MaintainRules_Header").removeClass('sno');
        $("#acru01__MaintainRules__MaintainRules_Sub_Header").removeClass('sno');
        apz.setTableHeight("acru01__MaintainRules__Rule_Summary_Table", false);
        var getRules = apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail;
        var getLastRule = getRules[getRules.length - 1];
        var getAllRules = [];
        if (getLastRule.ruleEquation == "" || getLastRule.ruleEquation == undefined) {
            for (var i = 0; i < getRules.length - 1; i++) {
                getAllRules.push(getRules[i]);
            }
        } else {
            getAllRules = getRules;
        }
        apz.data.scrdata.acru01__RuleDetails_Req.tbDbmiWorkflowRuleDetail = getAllRules;
        apz.data.loadData("RuleDetails");
    } else if (apz.acru01.RuleBuilder.sAction == "New Function") {
        $("#acru01__RulesSummary__RulesSummaryRow").removeClass('sno');
        $("#acru01__RulesSummary__RulesScreenLaunch").addClass('sno');
        $("#acru01__RulesSummary__RulesSummaryHeader").removeClass('sno');
        $("#acru01__RulesSummary__RulesSummarySubHeader").removeClass('sno');
        //$("#acru01__MaintainRules__MaintainRHeader").removeClass('sno');
    }
};
apz.acru01.RuleBuilder.convertToMySQLTS = function() {
    var starttime = new Date();
    // Get the iso time (GMT 0 == UTC 0)
    var isotime = new Date((new Date(starttime)).toISOString());
    // getTime() is the unix time value, in milliseconds.
    // getTimezoneOffset() is UTC time and local time in minutes.
    // 60000 = 60*1000 converts getTimezoneOffset() from minutes to milliseconds. 
    var fixedtime = new Date(isotime.getTime() - (starttime.getTimezoneOffset() * 60000));
    // toISOString() is always 24 characters long: YYYY-MM-DDTHH:mm:ss.sssZ.
    // .slice(0, 19) removes the last 5 chars, ".sssZ",which is (UTC offset).
    // .replace('T', ' ') removes the pad between the date and time.
    var formatedMysqlString = fixedtime.toISOString().slice(0, 19).replace('T', ' ');
    console.log(formatedMysqlString);
    return formatedMysqlString;
};
apz.acru01.RuleBuilder.fnRenderFunction = function(params) {
    debugger;
    /*if (apz.acru01.RuleBuilder.sAction == "Modify Rule") {
        var lArray = [];
        var lObj = {};
        lObj.val = params.StageDetails.functionId;
        lObj.desc = params.StageDetails.functionId;
        lArray.push(lObj);
        apz.populateDropdown(document.getElementById("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId"), lArray);
        apz.acru01.RuleBuilder.fnOnChangeFunction();
    } else if (apz.acru01.RuleBuilder.sAction == "New Function") {
    */
    apz.acru01.RuleBuilder.sQAction = "function";
    var req = {};
    var lParams = {
        "ifaceName": "FunctionQuery",
        "paintResp": "N",
        "appId": "acru01",
        "buildReq": "N",
        "lReq": req
    };
    apz.acru01.RuleBuilder.fnBeforCallServer(lParams);
    //}
};
apz.acru01.RuleBuilder.fnBeforCallServer = function(params) {
    var lReq = {
        "ifaceName": params.ifaceName,
        "paintResp": params.paintResp,
        "buildReq": params.buildReq,
        "req": params.lReq,
        "appId": params.appId,
        "async": false,
        "callBack": apz.acru01.RuleBuilder.callServerCB,
        "callBackObj": ""
    };
    apz.server.callServer(lReq);
};
apz.acru01.RuleBuilder.callServerCB = function(params) {
    if (apz.acru01.RuleBuilder.sQAction == "function") {
        apz.acru01.RuleBuilder.fnRenderFunctionCB(params);
    } else if (apz.acru01.RuleBuilder.sQAction == "stage") {
        apz.acru01.RuleBuilder.fnRenderStageCB(params);
    }
};
apz.acru01.RuleBuilder.fnRenderFunctionCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        var lArray = [];
        var lObj = {};
        lObj.val = "";
        lObj.desc = "Please Select";
        lArray.push(lObj);
        for (var i = 0; i < params.res.acru01__FunctionQuery_Res.length; i++) {
            var lObj = {};
            lObj.val = params.res.acru01__FunctionQuery_Res[i].WORKFLOW_ID;
            lObj.desc = params.res.acru01__FunctionQuery_Res[i].WORKFLOW_DESC;
            lArray.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId"), lArray);
        if (apz.acru01.RuleBuilder.sAction == "Modify Rule") {
            apz.setElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId", apz.acru01.RuleBuilder.StageDetails.functionId);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.acru01.RuleBuilder.fnOnChangeFunction = function() {
    debugger;
    if (!apz.isNull(apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId"))) {
        apz.acru01.RuleBuilder.sQAction = "stage";
        var req = {};
        req.functionID = apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId");
        var lParams = {
            "ifaceName": "StageQuery",
            "paintResp": "N",
            "appId": "acru01",
            "buildReq": "N",
            "lReq": req
        };
        apz.acru01.RuleBuilder.fnBeforCallServer(lParams);
    } else {
        var lArray = [];
        var lObj = {};
        lObj.val = "";
        lObj.desc = "Please Select";
        lArray.push(lObj);
        apz.populateDropdown(document.getElementById("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__stageId"), lArray);
        apz.populateDropdown(document.getElementById("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__nextStage"), lArray);
    }
};
apz.acru01.RuleBuilder.fnRenderStageCB = function(params) {
    debugger;
    if (params.status === true && params.resFull.appzillonHeader.status === true) {
        var lArray = [];
        var lObj = {};
        lObj.val = "";
        lObj.desc = "Please Select";
        lArray.push(lObj);
        for (var i = 0; i < params.res.acru01__StageQuery_Res.length; i++) {
            var lObj = {};
            lObj.val = params.res.acru01__StageQuery_Res[i].STAGE_ID;
            lObj.desc = params.res.acru01__StageQuery_Res[i].STAGE_DESC;
            lArray.push(lObj);
        }
        apz.populateDropdown(document.getElementById("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__stageId"), lArray);
        apz.populateDropdown(document.getElementById("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__nextStage"), lArray);
        if (apz.acru01.RuleBuilder.sAction == "Modify Rule") {
            apz.setElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__stageId", apz.acru01.RuleBuilder.StageDetails.stageId);
            apz.setElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__nextStage", apz.acru01.RuleBuilder.StageDetails.nextStage);
        }
    } else {
        lmsg = {
            "message": params.errors[0].errorMessage,
            "type": "E"
        };
        apz.dispMsg(lmsg);
    }
};
apz.acru01.RuleBuilder.fnGetTaskVariable = function(pObj) {
    debugger;
    var lServerParams = {
        "ifaceName": "FetchTaskVariable_Query",
        "buildReq": "N",
        "req": "",
        "appId": "acru01",
        "paintResp": "N",
        "async": "true",
        "callBack": apz.acru01.RuleBuilder.fnGetTaskVariableCB
    };
    var req = {};
    req.tbDbmiCorpTaskvariable = {};
    req.tbDbmiCorpTaskvariable.workflowId = apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__functionId");
    req.tbDbmiCorpTaskvariable.stageId = apz.getElmValue("acru01__RuleDetailsDummy__i__tbDbmiWorkflowRuleDetail__stageId");
    lServerParams.req = req;
    apz.server.callServer(lServerParams);
}
apz.acru01.RuleBuilder.fnGetTaskVariableCB = function(pResp) {
    debugger;
    lArray = [];
    if (pResp.res.acru01__FetchTaskVariable_Res.tbDbmiCorpTaskvariable) {
        for (var i = 0; i < pResp.res.acru01__FetchTaskVariable_Res.tbDbmiCorpTaskvariable.length; i++) {
            var lObj = {};
            lObj.val = pResp.res.acru01__FetchTaskVariable_Res.tbDbmiCorpTaskvariable[i].taskVariableName;
            lObj.desc = pResp.res.acru01__FetchTaskVariable_Res.tbDbmiCorpTaskvariable[i].taskVariableName;
            lObj.type = pResp.res.acru01__FetchTaskVariable_Res.tbDbmiCorpTaskvariable[i].taskVariableType;
            lArray.push(lObj);
        }
    }
    apz.populateDropdown(document.getElementById("acru01__RuleBuilder__stOperand"), lArray);
}