var chatBot;
apz.ChatBo = {};
apz.app.onLoad_chatScreen = function(params) {
    apz.mockServer = false;
    apz.ChatBo.sCache = params;
     var isMobile = /iPhone|iPad|iPod|Android|Mozilla|Chrome|Safari/i.test(navigator.userAgent);
    if (!isMobile) {
        $("#ChatBo__chatScreen__gr_row_8").addClass("sno");
    }
    document.getElementById("ChatBo__chatScreen__chat_Area").style.height = "calc(85vh - 250px)";
    var mainId = "ChatBo__chatScreen__chat_Area";
    var botId = params.parentAppId;
    var html = '<div id="loader_9" class="chatBotLoader"></div>';
    $("#ChatBo__chatScreen__chat_Area").append(html);
    $("#loader_9").hide();
    chatBot = new Chatbot(mainId, botId)
};
apz.app.onShown_chatScreen = function() {
    chatBot.handleStartUpEvent();
};
apz.chatBotBack = function(){
debugger;
    apz.ChatBo.sCache.callBack();
    
}

function chatBotInputEvent(e) {
    if (e.keyCode == 13) {
        let msg = $("#ChatBo__chatScreen__el_txa_1").val();
        msg = msg.replace("\n", "");
        if (msg && msg.match(/\S/)) {
            $("#ChatBo__chatScreen__el_txa_1").val("");
            chatBot.handleUserInput(msg)
        } else {
            apz.dispMsg({
                message: "Entered Message Cannot be Empty",
                type: "E"
            })
        }
    }
}

function chatBotUserEvent() {
    let msg = $("#ChatBo__chatScreen__el_txa_1").val();
    if (msg && msg.match(/\S/)) {
        $("#ChatBo__chatScreen__el_txa_1").val("");
        chatBot.handleUserInput(msg)
    } else {
        apz.dispMsg({
            message: "Entered Message Cannot be Empty",
            type: "E"
        })
    }
}
// To check the spelling mistake
$("#ChatBo__chatScreen__el_txa_1").on('input', function() {
    var att = document.createAttribute("spellcheck");
    att.value = "false";
    document.getElementById("ChatBo__chatScreen__el_txa_1").setAttributeNode(att);
});

function chatBotCloseEvent() {
    $("#ChatBo__chatScreen__gr_row_1").removeClass("scale-in-br");
    $("#ChatBo__chatScreen__gr_row_1").addClass("scale-out-br");
    $("#chatba__Base__gr_row_3").show();
}

function chatBotminEvent() {
    $("#ChatBo__chatScreen__gr_row_7").toggleClass("maxim");
    $("#ChatBo__chatScreen__gr_row_7").toggleClass("minim ");
    $("#chatba__Base__gr_row_3").hide();
    var iconlen = $("#ChatBo__chatScreen__sc_col_10")[0].innerHTML;
    if (iconlen.indexOf("minus") > -1) {
        $("#ChatBo__chatScreen__sc_col_10")[0].innerHTML =
            '<svg aria-hidden="true" id="ChatBo__chatScreen__el_icn_5" class="ett-icon icon-stop pri px20" onclick="chatBotminEvent();"><use xlink:href="#icon-stop"></use></svg>';
    } else if (iconlen.indexOf("stop") > -1) {
        $("#ChatBo__chatScreen__sc_col_10")[0].innerHTML =
            '<svg aria-hidden="true" id="ChatBo__chatScreen__el_icn_5" class="ett-icon icon-minus pri px20" onclick="chatBotminEvent();"><use xlink:href="#icon-minus"></use></svg>';
    }
}
