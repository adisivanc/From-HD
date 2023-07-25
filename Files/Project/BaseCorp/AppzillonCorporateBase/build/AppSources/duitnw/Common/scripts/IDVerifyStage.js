apz.duitnw.IDVerifyStage = {};
apz.app.onLoad_IDVerifyStage = function(){
    apz.data.loadData("AddID","duitnw");
};
apz.duitnw.IDVerifyStage.next=function(){
   apz.launchSubScreen({div:"duitnw__IDLauncher__launcher",scr:"IDSuccessStage",layout:"All"});
};
apz.duitnw.IDVerifyStage.cancel=function(){
    apz.launchSubScreen({div:"duitnw__IDLauncher__launcher",scr:"IDInputStage",layout:"All"});
}