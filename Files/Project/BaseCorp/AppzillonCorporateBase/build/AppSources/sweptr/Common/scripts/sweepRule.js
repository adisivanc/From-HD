apz.sweepRule = {};
apz.sweepRule.selectedBank = [];
apz.app.onLoad_sweepRule = function() {
    $(".line").remove();
    $(".lineR").remove();
    // apz.sweepRule.droppable(
    //     '#sweptr__sweepRule__dragList,#sweptr__sweepRule__accrow_1_row,#sweptr__sweepRule__accrow_2_row,#sweptr__sweepRule__accrow_3_row,#sweptr__sweepRule__accrow_4_row,#sweptr__sweepRule__accrow_5_row,#sweptr__sweepRule__droprow_1_row,#sweptr__sweepRule__droprow_2_row,#sweptr__sweepRule__droprow_3_row,#sweptr__sweepRule__droprow_4_row'
    // );
    apz.sweepRule.droppable(
        '#sweptr__sweepRule__dragList,#sweptr__sweepRule__droprow_1_row,#sweptr__sweepRule__droprow_2_row,#sweptr__sweepRule__droprow_3_row,#sweptr__sweepRule__droprow_4_row'
    );
    apz.sweepRule.draggable(
        "#sweptr__sweepRule__accrow_1_row,#sweptr__sweepRule__accrow_2_row,#sweptr__sweepRule__accrow_3_row,#sweptr__sweepRule__accrow_4_row,#sweptr__sweepRule__accrow_5_row"
    );
}
apz.sweepRule.draggable = function(a) {
    $(a).draggable({
        helper: "clone",
        drag: function(a) {
            debugger;
            $("#" + a.target.id).addClass("setWidth");
        }
    })
};
apz.sweepRule.droppable = function(a) {
    debugger;
    $(a).droppable({
        drop: function(a, c) {
            debugger;
            $(this).append(c.draggable);
            var dropId = a.target.id;
            $(this).droppable('disable');
            setTimeout(function() {
                debugger;
                //$("#sweptr__sweepRule__sc_row_46_row").removeClass("sno");
                $("#" + $("#" + c.draggable[0].id).children().children()[1].id).removeClass("sno");
                $("#" + $("#" + c.draggable[0].id).children().children()[0].id).addClass("sno");
                $("#" + dropId).removeClass("rowborder");
                $("#" + dropId).addClass("rowborder1");
                $("#" + $("#" + dropId).children()[1].id).removeClass("setWidth");
            }, 500);
        }
    })
};
apz.sweepRule.fngotoLiqMgt = function() {
    debugger;
    //$("#sweptr__sweepRule__rowicon").addClass("sno");
    //$("#sweptr__sweepRule__rowdetails").addClass("sno");
    
    for (var i = 1; i <= 4; i++) {
        var obj = {};
        if($("#sweptr__sweepRule__droprow_" + i + "_row").children().length>1){
        var id = "#" + $("#sweptr__sweepRule__droprow_" + i + "_row").children()[1].id;
        obj.imgsrc = $(id + " img")[0].src;
        obj.actno = $(id + " p")[0].innerText;
        apz.sweepRule.selectedBank.push(obj);
        }
    }
    
    var params = {};
    params.appId = "sweptr";
    params.scr = "liquidityMgmt";
    //params.div = "sweptr__sweepRule__launchdiv";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
    params.userObj = apz.sweepRule.selectedBank;
    apz.launchSubScreen(params);
}
apz.sweepRule.fnReset = function() {
    var params = {};
    params.appId = "sweptr";
    params.scr = "sweepRule";
    params.div = "ACNR01__Navigator__launchPad";
    params.layout = "All";
    //apz.launchSubScreen(params);
    apz.launchApp(params);
}
apz.sweepRule.fnSave = function(){
     var params = {};
params.message = "The sweep setup has been saved successfully.";
params.type = "S";
params.callBack = apz.sweepRule.fnSaveCB;


    apz.dispMsg(params);
}

apz.sweepRule.fnSaveCB = function(params){
    apz.sweepRule.fngotoLiqMgt();
}