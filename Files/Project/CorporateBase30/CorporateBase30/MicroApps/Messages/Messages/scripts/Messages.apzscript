apz.messag.messages = {};
apz.messag.messages.sFirstTime = true;
apz.app.onLoad_Messages = function(params) {
    debugger;
    apz.messag.messages.sParams = params;
    apz.messag.messages.fnViewDraft();
    apz.messag.messages.fnViewInbox(params);
};
apz.messag.messages.fnViewInbox = function(params) {
    debugger;
    apz.messag.messages.sParams.MessageType = "I";
    apz.messag.messages.fnInitialise(params);
};
apz.messag.messages.fnsetNavi = function(params) {
    debugger;
};
apz.app.onShown_Messages = function(params) {
    debugger;
    /*Description length fixing for 140 charecter code */
    $("#messag__Messages__compose_msg").attr('maxlength', 140);
    messag__Messages__compose_msg.oninput = function() {
        this.value = this.value.slice(0, 140);
    };
    $("#messag__Messages__view_msg").css("word-wrap", "break-word");
    /*Description length fixing for 140 charecter code */
    $("#messag__Messages__messagesList li.srb").click(function(event) {
        if (!$("#" + event.target.id).hasClass("deleteIcon")) {
            var lRowNo = $(this).attr("rowno");
            var lMsgId = apz.getElmValue("messag__MsgInbox__i__Messages__MESSAGE_ID_" + lRowNo);
            var lFullTimestamp = apz.data.scrdata.messag__MsgInbox_Req.Messages[lRowNo].MODIFICATION_TS_FULL;
            apz.setElmValue("messag__Messages__view_msgId", lMsgId);
            apz.setElmValue("messag__Messages__view_txnRefNo", apz.getElmValue("messag__MsgInbox__i__Messages__TXN_REF_NO_" + lRowNo));
            apz.setElmValue("messag__Messages__view_subject", apz.getElmValue("messag__MsgInbox__i__Messages__SUBJECT_" + lRowNo));
            apz.setElmValue("messag__Messages__view_msg", apz.getElmValue("messag__MsgInbox__i__Messages__MESSAGE_" + lRowNo));
            //apz.setElmValue("messag__Messages__view_time", apz.getElmValue("messag__MsgInbox__i__Messages__MODIFICATION_TS_" + lRowNo));
            apz.setElmValue("messag__Messages__view_time", lFullTimestamp);
            apz.setElmValue("messag__Messages__view_msgType", apz.getElmValue("messag__MsgInbox__i__Messages__MESSAGE_TYPE_" + lRowNo));
            apz.setElmValue("messag__Messages__view_parentId", apz.getElmValue("messag__MsgInbox__i__Messages__PARENT_ID_" + lRowNo));
            apz.setElmValue("messag__Messages__view_adminUser", apz.getElmValue("messag__MsgInbox__i__Messages__ADMIN_USER_" + lRowNo));
            apz.hide("messag__Messages__Inbox_Sent_Draft");
            apz.hide("messag__Messages__draftDel_row");
            if (apz.messag.messages.sParams.MessageType == "I") {
                apz.show("messag__Messages__view_row");
                apz.hide("messag__Messages__compose_row");
                for (var i = 0; i < apz.messag.messages.sMessages.length; i++) {
                    if (apz.messag.messages.sMessages[i].MESSAGE_ID == lMsgId && apz.messag.messages.sMessages[i].READ_STATUS == "UNREAD") {
                        apz.messag.messages.sAction = "Read";
                        apz.messag.messages.fnQueryRecord();
                    }
                }
            } else if (apz.messag.messages.sParams.MessageType == "S") {
                apz.show("messag__Messages__view_row");
                apz.hide("messag__Messages__compose_row");
            } else if (apz.messag.messages.sParams.MessageType == "D") {
                for (var i = 0; i < apz.messag.messages.sMessages.length; i++) {
                    if (apz.messag.messages.sMessages[i].MESSAGE_ID == lMsgId) {
                        if (!apz.isNull(apz.messag.messages.sMessages[i].PARENT_ID)) {
                            apz.messag.messages.sAction = "Respond";
                            $("#messag__Messages__compose_msgType").attr("disabled", "disabled");
                            $("#messag__Messages__compose_subject").attr("disabled", "disabled");
                        } else {
                            apz.messag.messages.sAction = "New";
                            $("#messag__Messages__compose_msgType").removeAttr("disabled");
                            $("#messag__Messages__compose_subject").removeAttr("disabled");
                        }
                        apz.setElmValue("messag__Messages__draft_msgId", lMsgId);
                        apz.setElmValue("messag__Messages__draft_txnRefNo", apz.messag.messages.sMessages[i].TXN_REF_NO);
                        apz.setElmValue("messag__Messages__draft_parentId", apz.messag.messages.sMessages[i].PARENT_ID);
                        apz.setElmValue("messag__Messages__draft_adminUser", apz.messag.messages.sMessages[i].ADMIN_USER);
                        apz.setElmValue("messag__Messages__compose_msgType", apz.messag.messages.sMessages[i].MESSAGE_TYPE);
                        apz.setElmValue("messag__Messages__compose_subject", apz.messag.messages.sMessages[i].SUBJECT);
                        apz.setElmValue("messag__Messages__compose_msg", apz.messag.messages.sMessages[i].MESSAGE);
                    }
                }
                apz.hide("messag__Messages__view_row");
                apz.show("messag__Messages__compose_row");
                apz.show("messag__Messages__draftDel_row");
            }
        }
    });
    // $("#messag__Messages__messageType_List ul li").click(function() {
    //     apz.setElmValue("messag__Messages__compose_msgType", this.textContent);
    //     apz.setElmValue("messag__Messages__compose_subject", this.textContent);
    //     apz.toggleModal({
    //         "targetId": "messag__Messages__messageType_Modal"
    //     });
    // });
    apz.messag.messages.fnDraftsCount();
};
apz.messag.messages.fnInitialise = function(params) {
    debugger;
    apz.messag.messages.fnGotoStage1();
};
apz.messag.messages.fnGotoStage1 = function() {
    debugger;
    apz.messag.messages.fnGetMessages(apz.messag.messages.sParams.MessageType);
    apz.messag.messages.fnRenderStage1();
};
apz.messag.messages.fnGetMessages = function(pMsgType) {
    debugger;
    var lReq = {
        "corporateID": apz.Login.sCorporateId
    };
    if (apz.isNull(pMsgType)) {
        pMsgType = "I";
        apz.messag.messages.sParams.MessageType = "I";
    }
    if (pMsgType == "I") {
        var lIfaceName = "MessagesInbox";
    } else if (pMsgType == "S") {
        lReq.messageStatus = "SENT";
        var lIfaceName = "MessagesSentDraft";
    } else if (pMsgType == "D") {
        lReq.messageStatus = "DRAFT";
        var lIfaceName = "MessagesSentDraft";
    }
    var lServerParam = {
        "ifaceName": lIfaceName,
        "buildReq": "N",
        "req": lReq,
        "paintResp": "N",
    };
    apz.messag.messages.fnBeforeCallServer(lServerParam);
};
apz.messag.messages.fnRenderStage1 = function() {
    debugger;
    apz.messag.messages.sAction = "";
    apz.messag.messages.sFirstTime = false;
    apz.hide("messag__Messages__view_row");
    apz.hide("messag__Messages__compose_row");
    apz.show("messag__Messages__Inbox_Sent_Draft");
};
apz.messag.messages.fnClickCompose = function() {
    debugger;
    apz.messag.messages.sAction = "New";
    apz.hide("messag__Messages__view_row");
    apz.show("messag__Messages__compose_row");
    apz.hide("messag__Messages__NoDataFoundRow");
    apz.hide("messag__Messages__draftDel_row");
    apz.hide("messag__Messages__Inbox_Sent_Draft");
    $("#messag__Messages__compose_subject").removeAttr("disabled");
    var liList = $("#messag__Messages__messageType_List ul li");
    apz.setElmValue("messag__Messages__compose_msgType", liList[0].textContent);
    apz.setElmValue("messag__Messages__compose_subject", liList[0].textContent);
    $("#messag__Messages__compose_row input,textarea").not("#messag__Messages__compose_msgType").val("");
};
apz.messag.messages.fnViewDraft = function() {
    debugger;
    apz.hide("messag__Messages__NoDataFoundRow");
    apz.hide("messag__Messages__view_row");
    apz.hide("messag__Messages__compose_row");
    apz.show("messag__Messages__Inbox_Sent_Draft");
    apz.messag.messages.sParams.MessageType = "D";
    apz.messag.messages.fnGetMessages(apz.messag.messages.sParams.MessageType);
};
apz.messag.messages.fnViewSent = function() {
    debugger;
    apz.hide("messag__Messages__NoDataFoundRow");
    apz.hide("messag__Messages__view_row");
    apz.hide("messag__Messages__compose_row");
    apz.show("messag__Messages__Inbox_Sent_Draft");
    apz.messag.messages.sParams.MessageType = "S";
    apz.messag.messages.fnGetMessages(apz.messag.messages.sParams.MessageType);
};
apz.messag.messages.fnBeforeCallServer = function(params) {
    debugger;
    var lServerParam = {
        "ifaceName": params.ifaceName,
        "buildReq": params.buildReq,
        "req": params.req,
        "paintResp": params.paintResp,
        "callBack": apz.messag.messages.fnCallServerCallBack
    };
    apz.server.callServer(lServerParam);
};
apz.messag.messages.fnCallServerCallBack = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'message': params.errors[0].errorMessage
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
        if (params.errors[0].errorCode == "APZ-FM-EX-038") {
            apz.hide("messag__Messages__messagesList");
            apz.show("messag__Messages__NoDataFoundRow");
        }
    } else {
        apz.show("messag__Messages__messagesList");
        apz.data.scrdata.messag__MsgInbox_Req = {};
        if (apz.messag.messages.sParams.MessageType == "I") {
            $(".deleteIcon").addClass("sno");
            apz.data.scrdata.messag__MsgInbox_Req.Messages = params.res.messag__MessagesInbox_Res;
            apz.messag.messages.sMessages = params.res.messag__MessagesInbox_Res;
            //To Calculate the number of unread msgs in inbox
            var READ_STATUS = "UNREAD";
            apz.messag.messages.sParams.unreadMsgs = apz.data.scrdata.messag__MsgInbox_Req.Messages.filter((obj) => obj.READ_STATUS === READ_STATUS)
                .length;
            for (var i = 0; i < apz.data.scrdata.messag__MsgInbox_Req.Messages.length; i++) {
                if (apz.data.scrdata.messag__MsgInbox_Req.Messages[i].READ_STATUS == "READ") {
                    $("#messag__Messages__messagesList_row_" + i).addClass("unread");
                }
            }
            var lCount = apz.messag.messages.sParams.unreadMsgs;
            if (lCount !== undefined) {
                if (lCount > 0) {
                    apz.setElmValue("messag__Messages__inbox_count", "(" + lCount + ")");
                }
            }
        } else if (apz.messag.messages.sParams.MessageType == "S") {
            $(".deleteIcon").addClass("sno");
            apz.messag.messages.sMessages = params.res.messag__MessagesSentDraft_Res;
            apz.data.scrdata.messag__MsgInbox_Req.Messages = params.res.messag__MessagesSentDraft_Res;
        } else if (apz.messag.messages.sParams.MessageType == "D") {
            $(".deleteIcon").removeClass("sno");
            var lCount = params.res.messag__MessagesSentDraft_Res.length;
            if (lCount !== undefined) {
                if (lCount > 0) {
                    apz.setElmValue("messag__Messages__drafts_count", "(" + lCount + ")");
                }
            }
            apz.messag.messages.sMessages = params.res.messag__MessagesSentDraft_Res;
            apz.data.scrdata.messag__MsgInbox_Req.Messages = params.res.messag__MessagesSentDraft_Res;
        }
        var lRecs = apz.data.scrdata.messag__MsgInbox_Req.Messages;
        for (i = 0; i < lRecs.length; i++) {
            var lDate = lRecs[i].MODIFICATION_TS;
            var date = Date.parse(lDate);
            var hours = date.getHours();
            var minutes = date.getMinutes();
            var ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; // the hour '0' should be '12'
            minutes = minutes < 10 ? '0' + minutes : minutes;
            var lTime = hours + ':' + minutes + ' ' + ampm;
            var lToday = new Date().format("d-M-y");
            //var lTime = new Date(lDate.split(" ")[1]).format("h-m a");
            var lHrs = new Date(lDate).getHours().toString();
            var lMins = new Date(lDate).getHours().toString();
            var lDt = new Date(lDate.split(" ")[0]).format("d-M-y");
            var lDtScr = new Date(lDate.split(" ")[0]).format("d M y");
            var lTimeStamp = lDtScr + ", " + lTime;
            if (lToday == lDt) {
                if (lHrs !== "aN" && lMins !== "aN") {
                    lRecs[i].MODIFICATION_TS = lTime;
                    lRecs[i].MODIFICATION_TS_FULL = lTimeStamp;
                } else {
                    lRecs[i].MODIFICATION_TS = lDtScr;
                    lRecs[i].MODIFICATION_TS_FULL = lTimeStamp;
                }
            } else {
                lRecs[i].MODIFICATION_TS = lDtScr;
                lRecs[i].MODIFICATION_TS_FULL = lTimeStamp;
            }
            if (apz.messag.messages.sParams.MessageType == "D") {
                $("#messag__MsgInbox__i__Messages__MODIFICATION_TS_" + i).addClass("sno");
            } else {
                $("#messag__MsgInbox__i__Messages__MODIFICATION_TS_" + i).removeClass("sno");
            }
        }
        apz.data.scrdata.messag__MsgInbox_Req.Messages = lRecs;
        apz.data.loadData("MsgInbox", "messag");
    }
};
apz.messag.messages.fnInboxCount = function() {
    debugger;
    var lServerParam = {
        "ifaceName": "InboxUnreadCount",
        "buildReq": "N",
        "req": {
            "corporateID": apz.Login.sCorporateId
        },
        "paintResp": "N",
        "callBack": apz.messag.messages.fnInboxCountCB
    };
    apz.server.callServer(lServerParam);
};
apz.messag.messages.fnInboxCountCB = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
    } else {
        var lCount = params.res.messag__InboxUnreadCount_Res[0].count;
        if (lCount !== undefined) {
            if (lCount > 0) {
                apz.setElmValue("messag__Messages__inbox_count", "(" + lCount + ")");
            }
        }
    }
};
apz.messag.messages.fnDraftsCount = function() {
    debugger;
    var lServerParam = {
        "ifaceName": "DraftsCount",
        "buildReq": "N",
        "req": {
            "corporateID": apz.Login.sCorporateId
        },
        "paintResp": "N",
        "callBack": apz.messag.messages.fnDraftsCountCB
    };
    apz.server.callServer(lServerParam);
};
apz.messag.messages.fnDraftsCountCB = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
    } else {
        var lCount = params.res.messag__DraftsCount_Res[0].COUNT;
        if (lCount !== undefined) {
            if (lCount > 0) {
                apz.setElmValue("messag__Messages__drafts_count", "(" + lCount + ")");
            }
        }
    }
    if (pgSaveDraftAction) {
        pgSaveDraftAction = false;
        apz.messag.messages.fnGotoStage1();
    }
}
apz.messag.messages.fnQueryRecordForReadCB = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
    } else {
        var lRec = params.res.messag__MailMessageQuery_Res.tbDbtpMailMessage[0];
        lRec.readStatus = "READ";
        lRec.modificationTs = new Date().format("Y-m-d");
        var lServerParam = {
            "ifaceName": "MailMessage_Modify",
            "buildReq": "N",
            "req": {
                "tbDbtpMailMessage": lRec
            },
            "paintResp": "N",
            "callBack": apz.messag.messages.fnReadMsgCallBack
        };
        apz.server.callServer(lServerParam);
    }
};
apz.messag.messages.fnReadMsgCallBack = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
    } else {}
};
apz.messag.messages.fnClickSendBtn = function() {
    debugger;
    var lMsgDesc = apz.getElmValue("messag__Messages__compose_msg");
    if (apz.isNull(lMsgDesc)) {
        var param = {
            'code': "APP-MSG-SEND-VAL"
        };
        apz.dispMsg(param);
    } else {
        apz.startLoader();
        setTimeout(function() {
            // apz.messag.messages.sParams.MessageType = "S";
            if (apz.messag.messages.sAction == "New") {
                var lActionParams = {
                    "action": "NewSent"
                };
            } else if (apz.messag.messages.sAction == "Respond") {
                var lActionParams = {
                    "action": "RespondSent"
                };
            }
            apz.messag.messages.fnSaveMessage(lActionParams);
        }, 5);
    }
};
var pgSaveDraftAction = false;
apz.messag.messages.fnSaveDraftMdlBtn = function() {
    debugger;
    apz.startLoader();
    setTimeout(function() {
        apz.toggleModal({
            "targetId": "messag__Messages__draftMsg_modal"
        });
        //  apz.messag.messages.sParams.MessageType = "D";
        if (apz.messag.messages.sAction == "New") {
            var lActionParams = {
                "action": "NewDraft"
            };
        } else if (apz.messag.messages.sAction == "Respond") {
            var lActionParams = {
                "action": "RespondDraft"
            };
        }
        pgSaveDraftAction = true;
        apz.messag.messages.fnSaveMessage(lActionParams);
    }, 5);
};
var pgSaveMessageAction;
apz.messag.messages.fnSaveMessage = function(params) {
    debugger;
    pgSaveMessageAction = params.action;
    var lServerParam = {
        "ifaceName": "Messages",
        "buildReq": "N",
        "req": {
            "action": params.action,
            "MailMessage": {
                "corporateId": apz.Login.sCorporateId,
                "customerName": apz.Login.sUserId,
                "messageType": apz.getElmValue("messag__Messages__compose_msgType"),
                "subject": apz.getElmValue("messag__Messages__compose_subject"),
                "message": apz.getElmValue("messag__Messages__compose_msg"),
                "messageId": apz.getElmValue("messag__Messages__draft_msgId"),
                "txnRefNo": apz.getElmValue("messag__Messages__draft_txnRefNo"),
                "parentId": apz.getElmValue("messag__Messages__draft_parentId"),
                "adminUser": apz.getElmValue("messag__Messages__draft_adminUser")
            }
        },
        "paintResp": "N",
        "callBack": apz.messag.messages.fnSaveMsgCallBack
    };
    apz.server.callServer(lServerParam);
};
apz.messag.messages.fnSaveMsgCallBack = function(params) {
    debugger;
    apz.stopLoader();
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
    } else {
        if (pgSaveMessageAction == "NewSent" || pgSaveMessageAction == "RespondSent") {
            var lmsg = {
                "code": "APZ-MSG-SUCC"
            };
        } else {
            var lmsg = {
                "code": "APZ-DRAFT-SUCC"
            };
        }
        apz.dispMsg(lmsg);
        if (pgSaveDraftAction) {
            apz.messag.messages.fnDraftsCount();
        } else {
            apz.messag.messages.fnGotoStage1();
        }
    }
};
apz.messag.messages.fnClickDeleteBtn = function() {
    debugger;
    apz.toggleModal({
        "targetId": "messag__Messages__delMsg_modal"
    });
};
apz.messag.messages.fnDeleteConfirmMdlBtn = function() {
    debugger;
    apz.toggleModal({
        "targetId": "messag__Messages__delMsg_modal"
    });
    apz.messag.messages.sAction = "Delete";
    apz.messag.messages.fnQueryRecord();
};
apz.messag.messages.fnQueryRecord = function() {
    debugger;
    if (apz.messag.messages.sParams.MessageType == "D") {
        var lMsgId = apz.getElmValue("messag__Messages__draft_msgId");
    } else {
        var lMsgId = apz.getElmValue("messag__Messages__view_msgId");
    }
    //for (var i = 0; i < apz.messag.messages.sMessages.length; i++) {
    var lServerParam = {
        "ifaceName": "MailMessageQuery_Query",
        "buildReq": "N",
        "req": {
            "tbDbtpMailMessage": {
                "messageId": lMsgId
            }
        },
        "paintResp": "N"
    };
    if (apz.messag.messages.sAction == "Read") {
        lServerParam.callBack = apz.messag.messages.fnQueryRecordForReadCB;
    } else if (apz.messag.messages.sAction == "Delete") {
        lServerParam.callBack = apz.messag.messages.fnQueryRecordForDeleteCB;
    }
    apz.server.callServer(lServerParam);
    //}
};
apz.messag.messages.fnQueryRecordForDeleteCB = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
    } else {
        var lRec = params.res.messag__MailMessageQuery_Res.tbDbtpMailMessage[0];
        lRec.userMsgStatus = "DELETED";
        lRec.modificationTs = new Date().format("Y-m-d");
        var lServerParam = {
            "ifaceName": "MailMessage_Modify",
            "buildReq": "N",
            "req": {
                "tbDbtpMailMessage": lRec
            },
            "paintResp": "N",
            "callBack": apz.messag.messages.fnDeleteMsgCallBack
        };
        apz.server.callServer(lServerParam);
    }
};
apz.messag.messages.fnDeleteMsgCallBack = function(params) {
    debugger;
    if (params.errors) {
        var param = {
            'code': params.errors[0].errorCode
        };
        if (params.errors[0].errorCode !== "$APZ-SMS-EX-003" && params.errors[0].errorCode !== "APZ-FM-EX-038") {
            apz.dispMsg(param);
        }
    } else {
        var lmsg = {
            "code": "APZ-MSG-DEL-SUCC"
        };
        apz.dispMsg(lmsg);
        //apz.messag.messages.sParams.MessageType = "I";
        apz.messag.messages.fnGotoStage1();
    }
};
apz.messag.messages.fnClickCancelBtn = function() {
    debugger;
    var lMsgDesc = apz.getElmValue("messag__Messages__compose_msg");
    if (apz.isNull(lMsgDesc)) {
        // apz.messag.messages.fnGotoStage1();
        apz.messag.messages.fnViewInbox();
    } else {
        apz.toggleModal({
            "targetId": "messag__Messages__draftMsg_modal"
        });
    }
};
apz.messag.messages.fnClickCancelDelMdlBtn = function() {
    debugger;
    apz.toggleModal({
        "targetId": "messag__Messages__delMsg_modal"
    });
};
apz.messag.messages.fnClickDiscardDraftMdlBtn = function() {
    debugger;
    apz.toggleModal({
        "targetId": "messag__Messages__draftMsg_modal"
    });
    //apz.messag.messages.sParams.MessageType = "I";
    apz.messag.messages.fnGotoStage1();
};
apz.messag.messages.fnClickReplyBtn = function() {
    debugger;
    apz.messag.messages.sAction = "Respond";
    apz.hide("messag__Messages__view_row");
    apz.show("messag__Messages__compose_row");
    $("#messag__Messages__compose_subject").attr("disabled", "disabled");
    apz.setElmValue("messag__Messages__compose_msgType", apz.getElmValue("messag__Messages__view_msgType"));
    apz.setElmValue("messag__Messages__draft_adminUser", apz.getElmValue("messag__Messages__view_adminUser"));
    apz.setElmValue("messag__Messages__draft_parentId", apz.getElmValue("messag__Messages__view_msgId"));
    apz.setElmValue("messag__Messages__compose_msg", '');
    apz.setElmValue("messag__Messages__compose_subject", apz.getElmValue("messag__Messages__view_subject"));
    apz.setElmValue("messag__Messages__draft_txnRefNo", apz.getElmValue("messag__Messages__view_txnRefNo"));
};
apz.messag.messages.fnforwardMessage = function() {
    debugger;
    var email = {
        "mailId": "mail001",
        "recipientMailId": " ",
        "senderMailId": "",
        "ccIdList": "",
        "internal": "N",
        "subject": apz.getElmValue("messag__Messages__view_subject_txtcnt"),
        "body": apz.getElmValue("messag__Messages__view_msg_txtcnt")
    };
    email.internal = 'N';
    email.id = "MAIL_ID";
    email.callBack = apz.messag.messages.fnforwardMessageCB;
    apz.ns.sendMail(email);
};
apz.messag.messages.fnforwardMessageCB = function(successMsg) {
    debugger;
};
