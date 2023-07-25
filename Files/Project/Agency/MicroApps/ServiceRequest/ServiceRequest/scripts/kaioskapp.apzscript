//variable decleration
apz.srvreq.kaioskapp = {};
apz.srvreq.kaioskapp.sParams = {};

//page onload function
apz.app.onLoad_kaioskapp = function(param) {
    debugger;
    apz.hide("srvreq__kaioskapp__rowAccounts");
    apz.hide("srvreq__kaioskapp__rowAmount");
    apz.hide("srvreq__kaioskapp__rowDD");
    apz.srvreq.kaioskapp.sParams = param;
    $('.next-to-acc').attr('disabled','disabled');
    $('.not-statement').attr('disabled','disabled');
    $('.bank-statement').attr('disabled','disabled');
    $('.next-to-amount').attr('disabled','disabled');
    $('.submit-bank-service').attr('disabled','disabled');
    
    //get deposit account json via mockserver
    var serverObject = {
        "ifaceName": "DepositAccount",
        "callBackObj": "",
        "callBack": apz.srvreq.kaioskapp.servercallback, 
        "buildReq": "Y",
        "paintResp": "Y"
    }
    //call the server here
    apz.server.callServer(serverObject)
    
}

//mock server callback function 
apz.srvreq.kaioskapp.servercallback=function(param){
    console.log(param);
}

//bank service button click function
apz.srvreq.kaioskapp.bankService=function(element,service){
    //debugger;
    $('.button-icon-round-corner').removeClass('add-service-border');
    $('.next-to-acc').removeAttr('disabled');
    $('.account-list').find('.check-img').addClass('sno');
    
    setTimeout(function(){
        $(element).addClass('add-service-border');
    },10)
    apz.srvreq.kaioskapp.sParams.serviceType = service;
    //add header to account page header
    if(service=='Bank Statement'){
        $('.account-page-header').html('Please select account for which you would want the Bank Statement')
    }
    else{
        $('.account-page-header').html('Please select the account  into which you would like to '+service);
    }
    //add amount page header 
    if(service=='Cash Withdrawal'){
        $('.amount-header').html('Please specify the amount you want to withdraw');
    }
    else{
       $('.amount-header').html('Please specify the amount you want to deposit');
    }
}

//selected bank account to proceess
apz.srvreq.kaioskapp.selectedAcc=function(element){
    $('.account-list').find('.check-img').addClass('sno');
    $('.not-statement').removeAttr('disabled');
    $('.bank-statement').removeAttr('disabled');
    
    setTimeout(function(){
        $(element).find('.check-img').removeClass('sno');
    },10)
    apz.srvreq.kaioskapp.sParams.toAcc = $(element).find('.acc-no>span').html();
}


//show account page
apz.srvreq.kaioskapp.fnShowAcc = function() {
    apz.hide("srvreq__kaioskapp__rowAppointment");
    apz.show("srvreq__kaioskapp__rowAccounts");
    apz.hide("srvreq__kaioskapp__rowAmount");
    apz.hide("srvreq__kaioskapp__rowDD");
    //check service type banck statement
    if(apz.srvreq.kaioskapp.sParams.serviceType=='Bank Statement'){
       $('.bank-statement').removeClass('sno');
       $('.not-statement').hide();
    }
    else{
       $('.bank-statement').addClass('sno');
       $('.not-statement').show(); 
    }
};

//show add amount page
apz.srvreq.kaioskapp.fnShowAmount = function() {
    apz.hide("srvreq__kaioskapp__rowAppointment");
    apz.hide("srvreq__kaioskapp__rowAccounts");
    if (apz.srvreq.kaioskapp.sParams.serviceType == "Demand Draft") {
        apz.show("srvreq__kaioskapp__rowDD");
    } else {
        apz.show("srvreq__kaioskapp__rowAmount");
    }
}

//show DD benefiacary page
apz.srvreq.kaioskapp.fnbeneficiary = function() {
    apz.hide("srvreq__kaioskapp__rowAppointment");
    apz.hide("srvreq__kaioskapp__rowAccounts");
    apz.show("srvreq__kaioskapp__rowAmount");
    apz.hide("srvreq__kaioskapp__rowDD");
};

//get amount
apz.srvreq.kaioskapp.fngetamount = function(element) {
    var amountValue=$(element).val();
    //validation for amount 
    if(amountValue==""||isNaN(amountValue)){
        $('.submit-bank-service').attr('disabled','disabled');
    }
    else{
        $('.submit-bank-service').removeAttr('disabled');
    }
}

//submit the bank service and check appointment
apz.srvreq.kaioskapp.fnShowAppointment = function() {

    apz.hide("srvreq__kaioskapp__rowAppointment");
    apz.hide("srvreq__kaioskapp__rowAccounts");
    apz.hide("srvreq__kaioskapp__rowDD");
    //apz.hide("srvreq__kaioskapp__rowAmount");
    var lData = {};
    lData.UserDtls = apz.srvreq.kaioskapp.sParams.data;
    lData.BranchDtls = {};
    lData.BranchDtls.branch = "HSR LAYOUT";
    lData.BranchDtls.toAcc = apz.srvreq.kaioskapp.sParams.toAcc;
    lData.BranchDtls.amount = apz.getElmValue("srvreq__kaioskapp__txtamount");
    lData.BranchDtls.serviceType = apz.srvreq.kaioskapp.sParams.serviceType;
    lData.BranchDtls.allocatedTo = apz.getElmValue("srvreq__kaioskapp__txtbeneficiary");
    lData.action = "ServiceRequest";
    //call server object 
    var lServerParams = {
        "ifaceName": "FixAppointment_New",
        "buildReq": "N",
        "req": {},
        "paintResp": "N",
        "async":false,
        "callBack": apz.srvreq.kaioskapp.fnCallback,
        "callBackObj": "",
    };
    apz.srvreq.kaioskapp.sParams.sRefNo = Math.floor(1000000 + Math.random() * 9000000);
    var params = {
        "fromFormat": "M/dd/yyyy",
        "toFormat": "dd-MMM-yyyy"
    };
    params.val = new Date().toString("M/dd/yyyy");
    var ltoday = apz.formatDate(params);
    
    //add request object to server object
    lServerParams.req = {
        "tbScheduleAppointment": {
            "customerId": lData.UserDtls.customerID,
            "toAcc": lData.BranchDtls.toAcc,
            "amount": lData.BranchDtls.amount,
            "referenceNo": apz.srvreq.kaioskapp.sParams.sRefNo,
            "name": lData.UserDtls.name,
            "date": ltoday,
            "time": "",
            "branchName": lData.BranchDtls.branch,
            "status": "Pending",
            "scheduled": "Arrived",
            "customerImage": "data:image/png;base64,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",
            "mobileNumber": lData.UserDtls.mobileNumber,
            "emailId": lData.UserDtls.emailId,
            "dateOfBirth": lData.UserDtls.dateOfBirth,
            "serviceType": lData.BranchDtls.serviceType,
            "allocatedTo": "",
            "remarks": ""
        }
    }
    // call the server here
    apz.server.callServer(lServerParams);
}

//benificery value 
apz.srvreq.kaioskapp.fnonlyNo = function(element) {
    var benificeryValue=$(element).val();
    if(benificeryValue==""){
        $('.next-to-amount').attr('disabled','disabled');
    }
    else{
        $('.next-to-amount').removeAttr('disabled');
    }
}

//appointment callback function 
apz.srvreq.kaioskapp.fnCallback = function(presp) {
    var params = {
        "code": "KIOSK-SUCC",
        "args": apz.srvreq.kaioskapp.sParams.sRefNo + "<#>" + apz.srvreq.kaioskapp.sParams.serviceType
    }
    apz.dispMsg(params);
}


//back to check appointment page
apz.srvreq.kaioskapp.fngotoServiceType = function() {
    apz.hide("srvreq__kaioskapp__rowAccounts");
    apz.show("srvreq__kaioskapp__rowAppointment");
}

//back to account page 
apz.srvreq.kaioskapp.fngotoAccount = function() {
    apz.hide("srvreq__kaioskapp__rowDD");
    apz.show("srvreq__kaioskapp__rowAccounts");
}

// back to beneficiary/account page
apz.srvreq.kaioskapp.fngotoAccBen = function() {
    apz.hide("srvreq__kaioskapp__rowAmount");
    if (apz.srvreq.kaioskapp.sParams.serviceType == "Demand Draft") {
        apz.show("srvreq__kaioskapp__rowDD");
    } else {
        apz.show("srvreq__kaioskapp__rowAccounts");
    }
}
