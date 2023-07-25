var xyz;

function themeCallFun(themeCl) {
        debugger;
        //alert(themeCl);
        $(".dropThemePl").addClass("sno");
        switch(themeCl){
            case 0:{
                $("body").removeClass("aquaTheme greyTheme greenTheme purpleTheme defPlTheme");
                $("body").addClass("defPlTheme");
                localStorage.setItem("corpThemeName","defPlTheme");
                break;
            }
            case 1:{
                $("body").removeClass("aquaTheme greyTheme greenTheme purpleTheme defPlTheme");
                $("body").addClass("aquaTheme");
                localStorage.setItem("corpThemeName","aquaTheme");
                break;
            }
            case 2:{
                $("body").removeClass("aquaTheme greyTheme greenTheme purpleTheme defPlTheme");
                $("body").addClass("greyTheme");
                localStorage.setItem("corpThemeName","greyTheme");
                break;
            }
            case 3:{
                $("body").removeClass("aquaTheme greyTheme greenTheme purpleTheme defPlTheme");
                $("body").addClass("greenTheme");
                localStorage.setItem("corpThemeName","greenTheme");
                break;
            }
            case 4:{
                $("body").removeClass("aquaTheme greyTheme greenTheme purpleTheme defPlTheme");
                $("body").addClass("purpleTheme");
                localStorage.setItem("corpThemeName","purpleTheme");
                break;
            }
            default:{
                $("body").removeClass("aquaTheme greyTheme greenTheme purpleTheme defPlTheme");
                $("body").addClass("defPlTheme");
                localStorage.setItem("corpThemeName","defPlTheme");
                break;
            }
        }
}
    
$('body').on('click', '#selectedColor', function() {
    $(".dropThemePl").toggleClass("sno");
});


$(document).ready(function(){
    debugger;
   $("body").addClass("xyz");
   xyz = localStorage.getItem("corpThemeName");
    $("body").addClass(xyz);
});


