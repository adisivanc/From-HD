const SearchChat = (function(){
    searchOBj = undefined;
    return {
        create : function(){
             
             if(searchOBj == undefined){
                 searchOBj = new SearchChatClass();
             }
             return  searchOBj;
        },

    }
    
})();


class SearchChatClass{
    constructor(){
        this._message = "";
    }
    get message(){
        return this._message;
    }
    set message(message){
        this._message = message;
        
    }
    fetch(message,callback){
        if(typeof message !== "string" || message === "" ){
                 throw new Error("Invalid string");
            }
            else{
                this._message = message;
            var lServerParams = {
            "appId": "omnise",
            "ifaceName": "SearchChat",
            "buildReq": "N",
            "paintResp": "N",
            "req": {
                "botId": "viola.search",
                "inputMessage": this._message
                },
            "async": true,
            "callBackObj": this,
            "callBack": callback
        };
      
        apz.server.callServer(lServerParams);
            }
           

    }
}
