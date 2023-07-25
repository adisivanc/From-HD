function Chatbot(displayId, botID) {
    this.displayId = displayId;
    this.botID = botID;
    this.init()
}
Chatbot.prototype.handleUserInput = function(userMsg) {
    this.dialog.displayUserInput(userMsg);
    var payload = [];
    this.server.sendChatRequest(userMsg, payload)
};
Chatbot.prototype.handleStartUpEvent = function() {
    debugger;
    this.dialog.displayLoader();
    this.server.sendStartRequest();
};
Chatbot.prototype.handleResponseEvent = function(chatResp) {
    let resp;
    if (chatResp.ifaceName == "Start") {
        resp = chatResp.resFull.appzillonBody.ChatBo__Start_Res
    } else {
        resp = chatResp.resFull.appzillonBody.ChatBo__Chat_Res
    }
    let status = this.layoutCheck.getOption(resp);
    if (status == 0) {
        this.dialog.display(this.layoutCheck, resp)
    } else {
        apz.dispMsg({
                message: "Error in Condtion Check",
                type: "E"
            })
        
    }
};
Chatbot.prototype.init = function() {
    this.server = new ServerCall(this, this.handleResponseEvent);
    this.layoutCheck = new LayoutCheck();
    this.dialog = new DialogDisplay(this.displayId, this.server)
};
