window.oldDefineAmd = define.amd;
define.amd = false;
var gCashBalance=[];
apz.data.readJSONToGlobalVar = function(appId,fileName){
	var filePath = apz.getDataFilesPath(appId) + "/"+fileName+".json";
	var content = apz.getFile(filePath);
	if (!apz.isNull(content)) 
		return JSON.parse(content);
}
gCashBalance = apz.data.readJSONToGlobalVar("acbase","GlobalCashFlow");