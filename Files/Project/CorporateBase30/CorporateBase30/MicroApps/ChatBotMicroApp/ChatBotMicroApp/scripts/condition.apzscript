var hidden = false;

function LayoutCheck() {
    this.layoutOption = {
        Prompt: "PROMPT",
        Empty: "EMPTY",
        Prompt_List: "PROMPT_LIST",
        Prompt_Carousel: "PROMPT_CAROUSEL",
        Prompt_MultiLine_Btn: "PROMPT_MultiLine_BUTTON",
        Prompt_SingleLine_Btn: "PROMPT_SingleLine_BUTTON",
        Prompt_Msg_List: "PROMPT_List",
        PROMPt_Txt_Img_Btn: "PROMPT_TEXT_IMG_BUTTON",
        Prompt_Img_Btn: "PROMPT_IMG_BUTTON",
        Prompt_Img_Confirm: "PROMPT_IMG_CONFIRM"
    };
    this.swift = false;
    this.layout = "";
    this.msgObj = {
        Empty: "None",
        Text: "Text",
        Image: "Image",
        Map: "Map"
    }
}
LayoutCheck.prototype.getOption = function(chatResp) {
    var status = 0;
    this.swift = false;
    if (chatResp.status && chatResp.dialog && chatResp.dialog.prompt) {
        if (chatResp.dialog.prompt.swift && chatResp.dialog.prompt.swift.length > 0) {
            this.swift = true
        }
        if (chatResp.dialog.options && chatResp.dialog.options.length > 0) {
            status = this.getPromptOptions(chatResp)
        } else {
            if (chatResp.dialog.prompt.object) {
                status = this.getMessageObjectOption(chatResp)
            } else {
                if (chatResp.dialog.prompt.message.length > 0) {
                    this.layout = this.layoutOption.Prompt
                    if (chatResp.dialog.prompt.objectFormat == "HIDDEN") {
                        hidden = true;
                    }
                }
            }
        }
    } else {
        status = -1
    }
    return status
};
LayoutCheck.prototype.getPromptOptions = function(chatResp) {
    var optionLen = chatResp.dialog.options.length;
    var isMessage = false;
    var objectStyle = 0;
    var optionStyle = 0;
    var style = "";
    if (chatResp.dialog.prompt.message && chatResp.dialog.prompt.message.length > 0) {
        isMessage = true
    }
    if (chatResp.dialog.prompt.object && chatResp.dialog.prompt.objectType == "TEXT") {
        objectStyle = 1
    }
    if (chatResp.dialog.entity && chatResp.dialog.entity.length > 0) {
        this.layout = this.layoutOption.Prompt_Img_Confirm;
        return 0
    }
    var maxLen = 0;
    var mediaObject = false;
    for (var i = 0; i < optionLen; i++) {
        var temp = chatResp.dialog.options[i];
        if (temp.objectType == "IMAGE") {
            mediaObject = true
        }
        if (maxLen < temp.title.length) {
            maxLen = temp.title.length
        }
    }
    if (mediaObject == true) {} else {
        if (maxLen > 48) {} else {
            if (optionLen >= 5) {
                if (maxLen < 10 && optionLen <= 9) {
                    this.layout = this.layoutOption.Prompt_SingleLine_Btn;
                    return 0
                } else {
                    this.layout = this.layoutOption.Prompt_Msg_List;
                    return 0
                }
            } else {
                if (maxLen > 8) {
                    this.layout = this.layoutOption.Prompt_MultiLine_Btn;
                    return 0
                } else {
                    this.layout = this.layoutOption.Prompt_SingleLine_Btn;
                    return 0
                }
            }
        }
    }
};