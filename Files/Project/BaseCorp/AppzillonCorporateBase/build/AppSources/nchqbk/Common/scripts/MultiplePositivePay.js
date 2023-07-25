apz.nchqbk.multiplepositivePay = {};
apz.app.onLoad_MultiplePositivePay = function(){
    debugger;
    apz.data.loadJsonData("ChequeBookRequest","nchqbk");
    apz.data.createRow("nchqbk__MultiplePositivePay__ct_tbl_1");
};
apz.nchqbk.multiplepositivePay.submitReq = function(){
    apz.dispMsg({message:"Submitted successfully",type:"S", callBack : apz.nchqbk.multiplepositivePay.fngoBack});
}

apz.nchqbk.multiplepositivePay.fngoBack = function()
{
    debugger;
        apz.ACNR01.Navigator.launchApp("nchqbk", "MultiplePositivePay", "All", "MultiplePositivePay");

}
apz.nchqbk.multiplepositivePay.fnValidateCheckno = function(){
    debugger;
     var checkno = apz.getElmValue("nchqbk__MultiplePositivePay__el_inp_2");
    var str = checkno.replace(/[^0-9]/g, '');
    if (str.length > 6) {
        str = str.substr(0, 6);
    }
    apz.setElmValue("nchqbk__MultiplePositivePay__el_inp_2", str);
}
