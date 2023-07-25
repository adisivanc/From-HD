apz.liquidityMgmt = {};
apz.app.onLoad_liquidityMgmt = function(params) {
    $("#sweptr__liquidityMgmt__btnClose").hide();
    debugger;
    apz.liquidityMgmt.fnSetdata(params);
}
apz.liquidityMgmt.fnSweep = function() {
    debugger;
    $("#sweptr__liquidityMgmt__btnSweep").hide();
    $("#sweptr__liquidityMgmt__btnClose").show();
    $("#sweptr__liquidityMgmt__btnClose").removeClass("sno");
    $(".line").remove();
    $(".lineR").remove();
    $("#sweptr__liquidityMgmt__child21_fin_txtcnt").text("");
    $("#sweptr__liquidityMgmt__child12_fin_txtcnt").text("");
    $("#sweptr__liquidityMgmt__child11_fin_txtcnt").text("");
    $("#sweptr__liquidityMgmt__headerNode_fin_txtcnt").text("");
    $("#sweptr__liquidityMgmt__child21_txtcnt").text($("#sweptr__liquidityMgmt__child21_bkp_txtcnt").text());
    $("#sweptr__liquidityMgmt__child12_txtcnt").text($("#sweptr__liquidityMgmt__child12_bkp_txtcnt").text());
    $("#sweptr__liquidityMgmt__child11_txtcnt").text($("#sweptr__liquidityMgmt__child11_bkp_txtcnt").text());
    $("#sweptr__liquidityMgmt__headerNode_txtcnt").text($("#sweptr__liquidityMgmt__headerNode_bkp_txtcnt").text());
    showLine("sweptr__liquidityMgmt__sc_col_18_li", "sweptr__liquidityMgmt__sc_col_3_li", "line11", parseInt(80000));
    setTimeout(function() {
        debugger;
        $("#sweptr__liquidityMgmt__headerNode_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__child11_bkp_txtcnt").text()) + parseInt($(
            "#sweptr__liquidityMgmt__headerNode_bkp_txtcnt").text()));
        $("#sweptr__liquidityMgmt__child11_txtcnt").text("0");
        showLine("sweptr__liquidityMgmt__sc_col_33_li", "sweptr__liquidityMgmt__sc_col_3_li", "line12", parseInt(20000));
        setTimeout(function() {
            debugger;
            $("#sweptr__liquidityMgmt__headerNode_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__child12_bkp_txtcnt").text()) + parseInt($(
                "#sweptr__liquidityMgmt__headerNode_txtcnt").text()));
            $("#sweptr__liquidityMgmt__child12_txtcnt").text("0");
            showLine("sweptr__liquidityMgmt__sc_col_48_li", "sweptr__liquidityMgmt__sc_col_3_li", "line21", parseInt(45000));
            setTimeout(function() {
                debugger;
                $("#sweptr__liquidityMgmt__headerNode_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__child21_bkp_txtcnt").text()) +
                    parseInt($("#sweptr__liquidityMgmt__headerNode_txtcnt").text()));
                $("#sweptr__liquidityMgmt__child21_txtcnt").text("0");
            }, 2000);
        }, 2000);
    }, 2000);
}

function showLine(from, to, id, txnVal) {
    debugger;
    var line = '';
    if (id.substring(0, 1).indexOf("R") > -1) {
        if (id === "Rline12") {
            line = '<div id="' + id + '" class="lineR lineR1"><span class="line-textR1">' + txnVal + '</span></div>';
        } else {
            line = '<div id="' + id + '" class="lineR"><span class="line-textR">' + txnVal + '</span></div>';
        }
    } else {
        if (id === "line12") {
            line = '<div id="' + id + '" class="line line1"><span class="line-text1">' + txnVal + '</span></div>';
        } else {
            line = '<div id="' + id + '" class="line"><span class="line-text">' + txnVal + '</span></div>';
        }
    }
    $('body').append(line);
    var a = $("#" + from),
        b = $("#" + to),
        dW = b.offset().left - (a.offset().left),
        dH = b.offset().top + $(b).height() - (a.offset().top),
        angle1 = Math.atan(dH / dW),
        length = Math.sqrt(dW * dW + dH * dH);
        
       
        
        
    if (id.substring(0, 1).indexOf("R") > -1) {
        dW = b.offset().left - (a.offset().left);
        dH = b.offset().top - $(b).height() - (a.offset().top);
        angle1 = Math.atan(dH / dW);
        length = Math.sqrt(dW * dW + dH * dH);
    }
    if (dW < 0) angle1 += Math.PI;
    if (angle1 > 1) 
    console.log(id, dW, dH, angle1, length);
    if (id.substring(0, 1).indexOf("R") > -1) {
        $("#" + id).css({
            top: a.offset().top + $(b).height() + 11,
            left: a.offset().left + ($(b).width() / 2) + 50,
            width: 0,
            transform: 'rotate(' + angle1 + 'rad)',
            transformOrigin: '0px 0px'
        }).stop().animate({
            width: length
        }, 2000, "swing");
    } else {
        $("#" + id).css({
            top: a.offset().top + 6,
            left: a.offset().left + ($(b).width() / 2) + (50 * -1),
            // width: 0,
            transform: 'rotate(' + angle1 + 'rad)',
            transformOrigin: '0px 0px'
        }).stop().animate({
            width: length
        }, 2000, "swing");
    }
};
apz.liquidityMgmt.fnClose = function() {
    $("#sweptr__liquidityMgmt__btnClose").hide();
    $("#sweptr__liquidityMgmt__btnSweep").show();
    showLine("sweptr__liquidityMgmt__sc_col_3_li", "sweptr__liquidityMgmt__sc_col_18_li", "Rline11", parseInt(80000));
    setTimeout(function() {
        $("#sweptr__liquidityMgmt__headerNode_fin_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__headerNode_txtcnt").text()) - (parseInt($(
            "#sweptr__liquidityMgmt__child11_bkp_txtcnt").text())));
        $("#sweptr__liquidityMgmt__child11_fin_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__child11_bkp_txtcnt").text()) + parseInt($(
            "#sweptr__liquidityMgmt__child11_txtcnt").text()));
        showLine("sweptr__liquidityMgmt__sc_col_3_li", "sweptr__liquidityMgmt__sc_col_33_li", "Rline12", parseInt(20000));
        setTimeout(function() {
            $("#sweptr__liquidityMgmt__headerNode_fin_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__headerNode_fin_txtcnt").text()) - (
                parseInt($("#sweptr__liquidityMgmt__child12_bkp_txtcnt").text())));
            $("#sweptr__liquidityMgmt__child12_fin_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__child12_bkp_txtcnt").text()) + parseInt(
                $("#sweptr__liquidityMgmt__child12_txtcnt").text()));
            showLine("sweptr__liquidityMgmt__sc_col_3_li", "sweptr__liquidityMgmt__sc_col_48_li", "Rline21", parseInt(45000));
            setTimeout(function() {
                $("#sweptr__liquidityMgmt__headerNode_fin_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__headerNode_fin_txtcnt").text()) -
                    (parseInt($("#sweptr__liquidityMgmt__child21_bkp_txtcnt").text())));
                $("#sweptr__liquidityMgmt__child21_fin_txtcnt").text(parseInt($("#sweptr__liquidityMgmt__child21_bkp_txtcnt").text()) +
                    parseInt($("#sweptr__liquidityMgmt__child21_txtcnt").text()));
            }, 2000)
        }, 2000)
    }, 2000);
}
apz.liquidityMgmt.fnSetdata = function(params) {
    debugger;
    if (params.length != undefined) {
        $("#sweptr__liquidityMgmt__bankimg1").attr("src", params[0].imgsrc);
        $("#sweptr__liquidityMgmt__bankimg2").attr("src", params[1].imgsrc);
        $("#sweptr__liquidityMgmt__bankimg3").attr("src", params[2].imgsrc);
        $("#sweptr__liquidityMgmt__bankimg4").attr("src", params[3].imgsrc);
        $("#sweptr__liquidityMgmt__acctno1").text(params[0].actno);
        $("#sweptr__liquidityMgmt__acctno2").text(params[1].actno);
        $("#sweptr__liquidityMgmt__acctno3").text(params[2].actno);
        $("#sweptr__liquidityMgmt__acctno4").text(params[3].actno);
    }
}
apz.liquidityMgmt.fnSweepRule = function(params) {
    var params = {};
    params.appId = "sweptr";
    params.scr = "sweepRule";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
    apz.launchSubScreen(params);
}
