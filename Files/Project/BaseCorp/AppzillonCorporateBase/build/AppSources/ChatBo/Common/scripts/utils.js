// // // var html = '<div id="display__swift__gr_row_'+randNum+'" class="grb"><div id="display__swift__gr_col_'+randNum+'" class=" gcb-col12    " style=""><div id="display__swift__pl_pnl_'+randNum+'_div" style="" class="plt-simp "><div id="display__swift__ps_pls_'+randNum+'" class="pst-simp tsp pa0 chatbot-bot dialog" style=""><div id="display__swift__ct_frm_'+randNum+'" class="crt-form  hor pri"><span id="display__swift__sc_row_'+randNum+'" class="srb pri"><span id="display__swift__sc_col_'+randNum+'" class=" pri scb-col100"><ul id="display__swift__el_txt_'+randNum+'_ul" class="eoc srb"><li class="etw-0"><label id="display__swift__el_txt_'+randNum+'_grp_lbl" for="display__swift__el_txt_'+randNum+'" class="flb" style="" title="">&nbsp;</label></li><li id="display__swift__el_txt_'+randNum+'_li" class="eic etw-100"><p id="display__swift__el_txt_'+randNum+'" class="ett-para pri fs14"><span id="display__swift__el_txt_'+randNum+'_txtcnt"></span></p></li></ul></span></span></div></div></div></div></div>';
// // var html = '<div id="ChatBo__demo__gr_row_4" class="grb"><div id="ChatBo__demo__gr_col_4" class=" gcb-col12    " style=""><div id="ChatBo__demo__pl_pnl_4_div" style="" class="plt-simp "><div id="ChatBo__demo__ps_pls_4" class="pst-simp pri " style=""><div id="ChatBo__demo__ct_frm_3" class="crt-form  hor pri"><span id="ChatBo__demo__sc_row_5" class="srb pri"><span id="ChatBo__demo__sc_col_5" class=" pri scb-col100"><ul id="ChatBo__demo__el_dpd_2_ul" class="eoc srb"><li class="etw-0"><label id="ChatBo__demo__el_dpd_2_grp_lbl" for="ChatBo__demo__el_dpd_2" class="flb" style="" title="">&nbsp;</label></li><li id="ChatBo__demo__el_dpd_2_li" class="eic etw-100"><select id="ChatBo__demo__el_dpd_2" class="etb-slcn ett-slcn  pri etw-100" value="" enabled="enabled" style=""></select></li></ul></span></span></div></div></div></div></div>';
// // var html = '<div id="display__userinput__gr_row_' + randNum + '" class="grb"><div id="display__userinput__gr_col_' + randNum +
// //         '" class=" gcb-col12    " style=""><div id="display__userinput__pl_pnl_' + randNum +
// //         '_div" style="" class="plt-simp "><div id="display__userinput__ps_pls_' + randNum +
// //         '" class="pst-simp tsp pa0 chatbot-user dialog " style=""><div id="display__userinput__ct_frm_' + randNum +
// //         '" class="crt-form  hor pri"><ul id="display__userinput__el_txt_' + randNum +
// //         '_ul" class="eoc srb"><li id="display__userinput__el_txt_' + randNum +
// //         '_li" class="eic etw-100"><p id="display__userinput__el_txt_' + randNum + '" class="ett-para pri fs14"></p></li></ul></div></div></div></div></div>';
// // var html = '<ul id="ChatBo__demo__el_dpd_2_ul" class="eoc srb"><li id="ChatBo__demo__el_dpd_2_li" class="eic etw-100"><div class="etb-slct ett-slct acpt pri etw-100" enabled="enabled"><select id="ChatBo__demo__el_dpd_2" class="select2-hidden-accessible" value="" enabled="enabled" style="" tabindex="-1" aria-hidden="true"></select><span class="select2 select2-container select2-container--default select2-container--above" dir="ltr" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-labelledby="select2-ChatBo__demo__el_dpd_2-container"><span class="select2-selection__rendered" id="select2-ChatBo__demo__el_dpd_2-container" title="Text B">Text B</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span></div></li></ul>';
// apz.app.onLoad_ChatScreen = function(params) {
//     debugger;
//     document.getElementById("ChatBo__ChatScreen__chat_Area").style.height = "calc(100vh - 140px)";
//     var Mainid = "ChatBo__ChatScreen__chat_Area";
//     var botId = params.parentAppId;
//     chatBot = new Chatbot(Mainid, botId)
// };
// apz.app.onShown_ChatScreen = function() {;
//     $("#ChatBo__ChatScreen__chat_Area").scrollTop(200000000);
//     chatBot.handleStartUpEvent()
// };
// onEnter = function(e) {
//     debugger;
//     if (e.keyCode == 13) {
//         let msg = $("#ChatBo__ChatScreen__el_txa_1").val();
//         if (msg.length > 0) {
//             $("#ChatBo__ChatScreen__el_txa_1").val("");
//             chatBot.handleUserInput(msg)
//         } else {
//             apz.dispMsg({
//                 message: "Entered Message Cannot be Empty",
//                 type: "E"
//             })
//         }
//     }
// };
// goButtonClick = function() {;
//     let msg = $("#ChatBo__ChatScreen__el_txa_1").val();
//     if (msg.length > 0) {
//         $("#ChatBo__ChatScreen__el_txa_1").val("");
//         chatBot.handleUserInput(msg)
//     } else {
//         apz.dispMsg({
//             message: "Entered Message Cannot be Empty",
//             type: "E"
//         })
//     }
// };


//<img src="../../../../../preloader3.gif"  width="32" height="32">


//var s1 = s2.replace(/\S/gi, '*');