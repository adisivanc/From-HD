apz.nchqbk.positivePay = {};
apz.app.onLoad_PositivePay = function(){
    
};
apz.nchqbk.positivePay.submitReq = function(){
    apz.dispMsg({message:"Submitted successfully",type:"S", callBack : apz.nchqbk.positivePay.fngoBack});
}

apz.nchqbk.positivePay.fngoBack = function()
{
    debugger;
        apz.ACNR01.Navigator.launchApp("nchqbk", "PositivePay", "All", "PositivePay");

}
apz.nchqbk.positivePay.fnValidateCheckno = function(){
    debugger;
     var checkno = apz.getElmValue("nchqbk__PositivePay__el_inp_2");
    var str = checkno.replace(/[^0-9]/g, '');
    if (str.length > 6) {
        str = str.substr(0, 6);
    }
    apz.setElmValue("nchqbk__PositivePay__el_inp_2", str);
}
