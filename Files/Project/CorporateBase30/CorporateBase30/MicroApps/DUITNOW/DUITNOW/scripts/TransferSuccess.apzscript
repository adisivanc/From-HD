apz.duitnw.TransferSuccess = {};
apz.app.onLoad_TransferSuccess = function() {
    apz.data.loadData("Transfer", "duitnw");
};
apz.duitnw.TransferSuccess.next = function() {
    apz.launchSubScreen({
        div: "duitnw__TransferLauncher__launcher",
        scr: "TransferInput",
        layout: "All"
    });
};
apz.duitnw.TransferSuccess.saveToFav = function() {
    apz.dispMsg({
        'type': 'P',
        'message': 'Please give a nickname of your choice to the recepient',
        'callBack': apz.duitnw.TransferSuccess.favSaveCB
    });
};
apz.duitnw.TransferSuccess.favSaveCB = function(){
     apz.dispMsg({
        'type': 'I',
        'message': 'Recepient added to your favourite list'
    });
};