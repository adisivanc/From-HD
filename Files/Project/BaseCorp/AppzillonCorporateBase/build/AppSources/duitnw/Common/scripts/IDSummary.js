apz.duitnw.IDSummary = {};
apz.app.onLoad_IDSummary = function(){
    apz.data.loadJsonData("IDSummary","duitnw");
};
apz.duitnw.IDSummary.next = function(){
    apz.launchSubScreen({div:"duitnw__IDLauncher__launcher",scr:"IDInputStage",layout:"All"});
};