var loader = "";
var loaderFlag = false;

function DialogDisplay(displayId, serverObj) {
    this.displayId = displayId;
    this.msgObjectID = "display_MessageObject_sc_row_";
    this.server = serverObj;
}
DialogDisplay.prototype.display = function(layoutCheck, chatResp) {
    if (loaderFlag) {
        document.getElementById(loader).remove();
        loaderFlag = false;
    }
    this.layoutCheck = layoutCheck;
    if (layoutCheck.swift) {
        this.displaySwift(chatResp);
    }
    switch (layoutCheck.layout) {
        case "PROMPT":
            this.displayPrompt(chatResp);
            break;
        case "EMPTY":
            break;
        case "PROMPT_MultiLine_BUTTON":
            this.displayPromptWithMultiLineButton(chatResp);
            break;
        case "PROMPT_SingleLine_BUTTON":
            this.displayPromptWithSingleLineButton(chatResp);
            break;
        case "PROMPT_List":
            this.displayList(chatResp);
            break;
        case "PROMPT_IMG_CONFIRM":
            this.displayConfirmation(chatResp);
            break;
    }
}
DialogDisplay.prototype.generateRandomNumber = function() {
    let randNum = Math.floor(Math.random() * 1000) + 1;
    return randNum;
}
DialogDisplay.prototype.addButton = function(title, payload) {
    let randNum = this.generateRandomNumber();
    var button = document.createElement('button');
    button.innerHTML = title;
    button.value = payload;
    button.id = "button" + randNum + "";
    button.onclick = (evt) => {
        this.btnClick(this.server, evt, title);
    };
    return button;
}
DialogDisplay.prototype.addHeader = function(randNum) {
    var rowStr = '<div id="display__swift__gr_row_' + randNum + '" class="grb"><div id="display__swift__gr_col_' + randNum +
        '" class=" gcb-col12    " style=""><div id="display__swift__pl_pnl_' + randNum +
        '_div" style="" class="plt-simp "><div id="display__swift__ps_pls_' + randNum +
        '" class="pst-simp tsp pa0 chatbot-bot dialog" style=""><div id="display__swift__ct_frm_' + randNum + '" class="crt-form  hor pri">';
    return rowStr;
}
DialogDisplay.prototype.addText = function(randNum) {
    var txtStr = '<ul id="display__swift__el_txt_' + randNum + '_ul" class=""><li id="display__swift__el_txt_' + randNum +
        '_li" class="eic etw-100"><p id="display__swift__el_txt_' + randNum + '" class="ett-para pri paragg fs14"></p></li></ul>';
    return txtStr;
}
DialogDisplay.prototype.endHeader = function() {
    return "</div></div></div></div></div>";
}
DialogDisplay.prototype.displaySwift = function(chatResp) {
    let randNum = this.generateRandomNumber();
    var addHeader = this.addHeader(randNum);
    var endHeader = this.endHeader();
    var addText = this.addText(randNum);
    var html = '';
    html += addHeader;
    html += addText;
    html += endHeader
    $("#" + this.displayId).append(html);
    let swifttxt = chatResp.dialog.prompt.swift;
    $("#display__swift__el_txt_" + randNum).text(swifttxt);
    //window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
}
DialogDisplay.prototype.displayPrompt = function(chatResp) {
    let randNum = this.generateRandomNumber();
    var addHeader = this.addHeader(randNum);
    var endHeader = this.endHeader();
    var addText = this.addText(randNum);
    var html = '';
    html += addHeader;
    html += addText;
    html += endHeader
    $("#" + this.displayId).append(html);
    let messagetxt = chatResp.dialog.prompt.message;
    $("#display__swift__el_txt_" + randNum).text(messagetxt);
    // window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
}
DialogDisplay.prototype.displayLoader = function() {
    let randNum = this.generateRandomNumber();
    var addHeader = this.addHeader(randNum);
    var endHeader = this.endHeader();
    var html = '';
    html += addHeader;
    html += '<div id="loader_' + randNum + '" class="chatBotLoader"></div>';
    html += endHeader;
    $("#" + this.displayId).append(html);
    $("#" + 'display__swift__ct_frm_' + randNum).removeClass("crt-form  hor pri");
    loader = 'display__swift__gr_row_' + randNum;
    loaderFlag = true;
}
DialogDisplay.prototype.displayUserInput = function(input) {
    let randNum = this.generateRandomNumber();
    var inputMsg = '';
    if (input && input.match(/\S/)) {
        inputMsg = input;
    } else {
        inputMsg = 'Sorry not able to understand. Please type again.'
    }
    if (hidden) {
        var inputMsg = inputMsg.replace(/\S/gi, '*');
        hidden = false;
    }
    var html = '<div id="display__userinput__gr_row_' + randNum + '" class="grb"><div id="display__userinput__gr_col_' + randNum +
        '" class=" gcb-col12    " style=""><div id="display__userinput__pl_pnl_' + randNum +
        '_div" style="" class="plt-simp "><div id="display__userinput__ps_pls_' + randNum +
        '" class="pst-simp tsp pa0 chatbot-user dialog " style=""><div id="display__userinput__ct_frm_' + randNum +
        '" class="crt-form  hor pri chatbot-user-dialog-userInput"><ul id="display__userinput__el_txt_' + randNum +
        '_ul" class="eoc srb"><li id="display__userinput__el_txt_' + randNum + '_li" class="eic etw-100"><p id="display__userinput__el_txt_' +
        randNum + '" class="ett-para pri paragg fs14"></p></li></ul></div></div></div></div></div>';
    $("#" + this.displayId).append(html);
    $("#display__userinput__el_txt_" + randNum).text(inputMsg);
    this.displayLoader();
    //window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
}
DialogDisplay.prototype.displayPromptWithMultiLineButton = function(chatResp) {
    let randNum = this.generateRandomNumber();
    var addHeader = this.addHeader(randNum);
    var endHeader = this.endHeader();
    var addText = this.addText(randNum);
    var html = '';
    html += addHeader;
    html += addText;
    html += '<span id="' + this.msgObjectID + randNum + '" class="srb pri">'
    html += '<ul id="PromptWithMultiLineButton' + randNum + '" class="chatbot-btndisplay"></ul>'
    html += '</span>'
    html += endHeader;
    $("#" + this.displayId).append(html);
    let messagetxt = chatResp.dialog.prompt.message;
    $("#display__swift__el_txt_" + randNum).text(messagetxt);
    var list = document.getElementById('PromptWithMultiLineButton' + randNum);
    for (var i = 0; i < chatResp.dialog.options.length; i++) {
        var btn = this.addButton(chatResp.dialog.options[i].title, chatResp.dialog.options[i].payload);
        var li = document.createElement('li');
        li.appendChild(btn);
        list.appendChild(li);
    }
    $("#PromptWithMultiLineButton" + randNum).find('button').addClass("ett-bttn pri med inf");
    //window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
}
DialogDisplay.prototype.displayPromptWithSingleLineButton = function(chatResp) {
    var optionLen = chatResp.dialog.options.length;
    let randNum = this.generateRandomNumber();
    var addHeader = this.addHeader(randNum);
    var endHeader = this.endHeader();
    var addText = this.addText(randNum);
    var html = '';
    html += addHeader;
    html += addText;
    html += '<span id="' + this.msgObjectID + randNum + '" class="srb pri">'
    html += '<ul id="PromptWithSingleLineButton' + randNum + '" class=""></ul>'
    html += '</span>'
    html += endHeader;
    $("#" + this.displayId).append(html);
    let messagetxt = chatResp.dialog.prompt.message;
    $("#display__swift__el_txt_" + randNum).text(messagetxt);
    var list = document.getElementById('PromptWithSingleLineButton' + randNum);
    for (var i = 0; i < chatResp.dialog.options.length; i++) {
        var btn = this.addButton(chatResp.dialog.options[i].title, chatResp.dialog.options[i].payload);
        var li = document.createElement('li');
        li.appendChild(btn);
        list.appendChild(li);
    }
    if (optionLen % 2 == 0) {
        $("#PromptWithSingleLineButton" + randNum).addClass("chatbot-singleline-btndisplay");
    } else {
        $("#PromptWithSingleLineButton" + randNum).addClass("chatbot-singleline-oddNum");
    }
    // window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
}
DialogDisplay.prototype.displayMessageObject = function(chatResp) {
    //swtich (this.layoutCheck.msgObjLayout)
}
DialogDisplay.prototype.displayList = function(chatResp) {
    let randNum = this.generateRandomNumber();
    var addHeader = this.addHeader(randNum);
    var addText = this.addText(randNum);
    var endHeader = this.endHeader();
    var html = '';
    html += addHeader;
    html += addText;
    html += '<ul id="display__List__el_dpd_' + randNum + '_ul" class="chatbot-dropDown"><li id="display__List__el_dpd_' + randNum +
        '_li" class="eic etw-100 etb-slct ett-slct acpt pri"><select id="display__List__el_dpd_' + randNum +
        '" class="select2-hidden-accessible" value="" enabled="enabled" style="" tabindex="-1" aria-hidden="true"></select></li></ul>';
    html += endHeader;
    $("#" + this.displayId).append(html);
    apz.dropdownAutocomplete($("#display__List__el_dpd_" + randNum)[0]);
    let messagetxt = chatResp.dialog.prompt.message;
    $("#display__swift__el_txt_" + randNum).text(messagetxt);
    var lobj = [];
    var lOption;
    for (var i = 0; i < chatResp.dialog.options.length; i++) {
        var title = chatResp.dialog.options[i].title;
        var payload = chatResp.dialog.options[i].payload;
        lOption = {
            "val": payload,
            "desc": title
        };
        lobj.push(lOption);
    }
    apz.populateDropdown(document.getElementById("display__List__el_dpd_" + randNum), lobj);
    var opt = document.createElement('option');
    opt.innerHTML = "Please Choose...";
    opt.id = "option" + randNum + "";
    var select = document.getElementById("display__List__el_dpd_" + randNum);
    select.insertBefore(opt, select.childNodes[0]);
    document.getElementById("option" + randNum + "").selected = "true";
    //window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
    document.getElementById("display__List__el_dpd_" + randNum).onchange = (ths) => {
        this.onChangeList(this.server, ths.target.value, ths.target.selectedOptions[0].innerText);
    }
}
DialogDisplay.prototype.displayConfirmation = function(chatResp) {
    debugger;
    let randNum = this.generateRandomNumber();
    var optionLen = chatResp.dialog.options.length;
    var entityLen = chatResp.dialog.entity.length;
    var addHeader = this.addHeader(randNum);
    var addText = this.addText(randNum);
    var endHeader = this.endHeader();
    var html = '';
    html += addHeader;
    html += addText;
    html += '<span id="' + this.msgObjectID + randNum + '" class="srb pri"></span>'
    html += '<span id="display__Confirmation__entity' + randNum + '_span" class="srb pri chatbot-entity-verform "></span>'
    html += '<span id="display__Confirmation__button' + randNum + '_span" class="srb pri chatbot-cancel-confirm-btn">'
    html += '<ul id="CancelandConfirmation' + randNum + '" class=""></ul></span>'
    html += endHeader;
    $("#" + this.displayId).append(html);
    let messagetxt = chatResp.dialog.prompt.message;
    $("#display__swift__el_txt_" + randNum).text(messagetxt);
    var span = document.getElementById('display__Confirmation__entity' + randNum + '_span');
    for (var j = 0; j < entityLen; j++) {
        var ul = document.createElement('ul');
        ul.id = "ul" + j + "";
        var li1 = document.createElement('li');
        li1.id = "li1" + j + "";
        var lable = document.createElement('label');
        lable.innerHTML = chatResp.dialog.entity[j].title;
        var li = document.createElement('li');
        li.id = "li" + j + "";
        var pTag = document.createElement('p');
        pTag.innerHTML = chatResp.dialog.entity[j].object;
        ul.appendChild(li1);
        li1.appendChild(lable);
        li.appendChild(pTag);
        ul.appendChild(li);
        span.appendChild(ul);
    }
    $("#display__Confirmation__entity" + randNum + "_span").find('p').addClass("chatbot-entity-value");
    var list = document.getElementById('CancelandConfirmation' + randNum);
    for (var i = 0; i < chatResp.dialog.options.length; i++) {
        var btn = this.addButton(chatResp.dialog.options[i].title, chatResp.dialog.options[i].payload);
        var li = document.createElement('li');
        li.appendChild(btn);
        list.appendChild(li);
    }
    $("#CancelandConfirmation" + randNum).find('button').addClass("chatbot-cancel-confirm-button");
    //window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
}
DialogDisplay.prototype.onChangeList = function(serverObj, selectedVal, title) {
    // window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
    $(".select2-hidden-accessible").attr("disabled", true);
    this.displayUserInput(title);
    var userMsg = '';
    var valSelected = [selectedVal];
    serverObj.sendChatRequest(userMsg, valSelected);
}
DialogDisplay.prototype.btnClick = function(serverObj, evnt, title) {
    //window.scrollTo(0,document.body.scrollHeight);
    document.getElementById('ChatBo__chatScreen__chat_Area').scrollTo(0, document.getElementById("ChatBo__chatScreen__chat_Area").scrollHeight);
    var clickedVal = evnt.target.value;
    $(evnt.target).parents("ul:first").children().find("button").attr("disabled", true);
    this.displayUserInput(title);
    var userMsg = '';
    var valClicked = [clickedVal];
    serverObj.sendChatRequest(userMsg, valClicked);
}
