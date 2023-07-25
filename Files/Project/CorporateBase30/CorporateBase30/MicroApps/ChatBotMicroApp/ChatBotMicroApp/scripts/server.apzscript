var ran = '';
var zoneId = Intl.DateTimeFormat().resolvedOptions().timeZone;

function ServerCall(parentObject, parentCallback) {
    this.parentObject = parentObject;
    this.responseCallback = parentCallback;
}
ServerCall.prototype.sendStartRequest = function() {
    var iface = 'Start';
    var lreq = {
        // "botId": this.parentObject.botID,
        "botId": "viola",
    }
    this.toCallServer(lreq, iface);
}
ServerCall.prototype.toCallServer = function(lreq, iface) {
    var lServerParams = {
        "ifaceName": iface,
        "buildReq": "N",
        "paintResp": "Y",
        "req": lreq,
        "async": true,
        "callBackObj": this,
        "callBack": this.serverCallBack,
    };
    apz.server.callServer(lServerParams);
}
ServerCall.prototype.serverCallBack = function(lparams) {
    if (lparams.ifaceName == "Start") {
        ran = lparams.resFull.appzillonBody.ChatBo__Start_Res.conversationId;
    }
    this.responseCallback.call(this.parentObject, lparams);
}
ServerCall.prototype.sendChatRequest = function(usrMsg, payload) {
    var iface = 'Chat';
    var lreq = {
        //  "botId": chatBot.botID,
        "botId": "viola",
        "conversationId": ran,
        "inputMessage": usrMsg,
        "optionPayload": payload,
        "zoneId": zoneId
    }
    this.toCallServer(lreq, iface);
}
apz.app.postGetHeader = function(header) {
    header.userId = '123456';
    return header;
}