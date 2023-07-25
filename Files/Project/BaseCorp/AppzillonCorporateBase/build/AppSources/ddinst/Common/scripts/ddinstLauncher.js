apz.ddinst.checkParams = function(params) {
    debugger;
    console.log("inside check params");
    params.userObj = {
         "data": {
            "customerID": "00001"
        }
    };
    console.log("out of check params"+ JSON.stringify(params));
};
