apz.duitnw.IDSuccessStage = {};
apz.app.onLoad_IDSuccessStage = function(){
    apz.data.loadData("AddID","duitnw");
};
apz.duitnw.IDSuccessStage.next=function(){
   apz.launchSubScreen({div:"duitnw__IDLauncher__launcher",scr:"IDSummary",layout:"All"});
};
