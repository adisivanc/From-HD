Apz.Server = function(apz) {
   this.apz = apz;
};
///////////////////Prototype Definition///////////////////////
Apz.Server.prototype = {
   getLocation: function(addrReq) {
	   /* Params contains the below value
	       *** addrReq ***
	   */
		if (addrReq) {
			this.apz.fetchAddr = true;
		} else {
			this.apz.fetchAddr = false;
		}
		nsReq = {};
		nsReq.id = "GETLOCATION";
		nsReq.callBack = this.setLocation;
		nsReq.callBackObj = this;
		this.apz.ns.getLocation(nsReq);
	}, setLocation: function(params) {
		this.apz.latitude = params.latitude;
		this.apz.longitude = params.longitude;
		if (this.apz.fetchAddr && (params.latitude !== "0" || params.longitude !== "0")) {
			this.getAddress();
		} else {
			this.apz.location = {
				"lat": this.apz.latitude,
				"lng": this.apz.longitude
			};
		}
	}, getHeader : function(params) {
      if (this.apz.isNull(params.id)) {
         reqId = this.apz.getProcId();
      }else{
    	  reqId = params.id;
      }
      if (this.apz.isNull(params.async)) {
    	  params.async = false;
      }
      var getHeader = true;
      if(this.apz.isFunction(this.apz.app.preGetHeader)){
          getHeader = this.apz.app.preGetHeader(params);
         if (this.apz.isNull(getHeader)) {
            getHeader = true;
         }
      }
      if(getHeader){
         var header = {};
         header.appId = this.apz.appId;
         header.sessionId = this.apz.sessionId;
         header.deviceId = this.apz.deviceId;
         header.requestId = reqId;
         header.async = params.async;
         header.userId = this.apz.userId;
         header.screenId = params.scrName;
         header.status = true;
         header.source = "APPZILLON";
         ////InterfaceID manipulation for MicroApp 
         if(!params.internal){
        	 header.interfaceId = params.appId ? params.appId +"__"+ params.ifaceName : this.apz.currAppId+"__"+ params.ifaceName;
         }else{
        	 header.interfaceId = params.ifaceName;
         }
         header.os = this.apz.deviceType;
         header.location = this.apz.location;
         if(params.captchaRef && params.captchaString){
             header.captchaRef = params.captchaRef || '';
             header.captchaString = params.captchaString || '';
         }
      }
      if(this.apz.isFunction(this.apz.app.postGetHeader)){
         header = this.apz.app.postGetHeader(header);
      }
      return header;
   }, callServer : function(params) {
      /* Params  Contains the below attributes
       * id,callBackObj,callBack,ifaceName,scrName, buildReq, req, paintResp,appId
       * async(boolean),
       * Response Contains below
       * res, errCode
       */
      params.internal = params.internal ? params.internal : false;
      params.apzIfaceName = params.appId ? params.appId+"__"+params.ifaceName : this.apz.currAppId+"__"+params.ifaceName;
      var ifaceName = this.apz.getIfaceName(params.ifaceName);
      var ifaceDet = this.apz.getIfaceObj(params.apzIfaceName, params.appId);
      if(this.apz.isNull(ifaceDet)){
    	  params.ifaceDet = {};
      }else{
    	  params.ifaceDet = ifaceDet;
      }
         if (Apz.Audit) {
         var log = {};
         log.action = 'SERVER';
         log.startTimeStamp = this.apz.getCurrTimeStamp();
         params.auditLog = log;
         }
      /////Build Data
      if (params.buildReq == "Y") {
         var buildData = true;
         params.req = {};
         if(this.apz.isFunction(this.apz.app.preBuildData)){
            buildData = this.apz.app.preBuildData(params.req);
            if (this.apz.isNull(buildData)) {
               buildData = true;
            }
         }
         if(buildData){
            var dataIface = ifaceName + "_Req";
            params.req = this.apz.data.buildData(dataIface, params.appId);
            this.correctReq(params);
         }
         if(this.apz.isFunction(this.apz.app.postBuildData)){
            this.apz.app.postBuildData(params.req);
         }
      }
      ////Encryption
      params.decrypt = false;
      if ((!params.internal) && (params.ifaceDet.encrypt) && (!this.apz.mockServer)) {
         params.decrypt = true;
         params.encKey = this.apz.getEncryptionKey();
         var nsReq = {};
         nsReq.fwdData = params;
         nsReq.id = params.id + "_ENC";
         nsReq.callBackObj = this;
         nsReq.callBack = this.encryptReqCB;
         nsReq.key = params.encKey;
         nsReq.stringToEncrypt = JSON.stringify(params.req);
         this.apz.ns.encryptData(nsReq);
      } else {
         this.reqEncrypted(params);
      }
   }, encryptReqCB : function(nsParams) {
      var params = nsParams.fwdData;
      params.reqEnc = params.req;
      params.req = nsParams.text;
      ///Call reqEncrypted
      this.reqEncrypted(params);
   }, reqEncrypted : function(params) {
      this.sendReq(params);
   }, sendReq : function(params) {
      ////Populate URL
      params.url = this.apz.serverUrl;
      params.method = "POST";
      if (this.apz.deviceOs == "WEB") {
         params.url = "AppzillonWeb";
      }
      var reqFull = {};
      reqFull.appzillonHeader = this.getHeader(params);
      reqFull.appzillonBody = params.req ? params.req : {};
      params.reqFull = reqFull;
      ////Ajax Setup
      $.ajaxSetup({
         headers : {
            'cache-control' : 'no-cache', 'Access-Control-Allow-Origin' : '*'
         }
      });
      if(this.apz.isFunction(this.apz.app.preRequestCall)){
         this.apz.app.preRequestCall();
      }
      ////Ajax Call
      if (!this.apz.mockServer) {
         var reqStr = JSON.stringify(params.reqFull);
         var myObj = this;
         if(this.apz.sslPinning != "Y") {
            $.ajax({
               url : params.url, type : params.method, cache : false, data : reqStr, contentType : 'application/json', dataType : 'json', async : params.async, success : function(res) {
                  params.status = true;
                  params.resFull = res;
                  if(myObj.apz.isFunction(myObj.apz.app.postRequestCallSuccess)){
                     myObj.apz.app.postRequestCallSuccess(params);
                  }
                  myObj.receiveRes(params);
               }, error : function() {
                  params.status = false;
                  if(myObj.apz.isFunction(myObj.apz.app.postRequestCallFailure)){
                     myObj.apz.app.postRequestCallFailure(params);
                  }
                  myObj.receiveRes(params);
               }
            });
         } else {
         	var reqId = this.apz.getProcId();
            Apz.apzSSLDet[reqId] = this.apz.copyJSONObjectWithFilter(params,["callBack","callBackObj"]);
            Apz.apzSSLDet[reqId].callBack = params.callBack;
            Apz.apzSSLDet[reqId].callBackObj = params.callBackObj;
            params.callBack = null;
            params.callBackObj = null;
        	var nsParam = {params:params, reqId:reqId};
        	nsParam.callBack = this.receiveSslRes;
        	nsParam.callBackObj = this;
            this.apz.ns.sendReq(nsParam);
         }
      } else {
         params.status = true;
         var resJson = {};
         if (!apz.isNull(params.resCode)){
            resJson = this.apz.getFile(this.apz.getMockRespPath(params.appId) + "/" + params.resCode + ".json");
         } else {
            var ifaceName = this.apz.getIfaceName(params.ifaceName);
            resJson = this.apz.getFile(this.apz.getMockRespPath(params.appId) + "/" + ifaceName + ".json");
         }
         params.resFull = JSON.parse(resJson);
         this.receiveRes(params);
      }
   }, receiveSslRes : function(resp) {
      var params = Apz.apzSSLDet[resp.reqId];
      delete Apz.apzSSLDet[resp.reqId];
      params.resFull = resp.params.resFull;
      params.status = resp.params.status;
      this.receiveRes(params);
   },receiveRes : function(params) {
	   if (Apz.Audit && params.auditLog) {
		     var log = params.auditLog;
		     log.endTimeStamp = this.apz.getCurrTimeStamp();
	         log.field1 = params.appId ? params.appId+"__"+params.ifaceName : this.apz.currAppId+"__"+params.ifaceName;
	         log.field2 = '';
	         log.field3 = '';
	         log.field4 = '';
	         log.field5 = '';
	         this.apz.audit.auditLog(log);
	   }
      if (params.status) {
         ////Make Full Response for Mock
         if ((this.apz.mockServer)) {
            var resFullOrig = params.resFull;
            params.resFull = {};
            params.resFull.appzillonHeader = this.getHeader(params);
            params.resFull.appzillonBody = resFullOrig;
         } else {
             ////Take Session Id
             this.apz.sessionId = params.resFull.appzillonHeader.sessionId;
         }
         ////Populate Body/Errors
         params.res = params.resFull.appzillonBody;
         params.errors = params.resFull.appzillonErrors;
         ////Handle Decryption
         if (params.decrypt) {
            var nsReq = {};
            nsReq.fwdData = params;
            nsReq.id = params.id + "_DEC";
            nsReq.callBackObj = this;
            nsReq.callBack = this.decryptResCB;
            nsReq.key = params.encKey;
            nsReq.stringToDecrypt = JSON.stringify(params.res);
            this.apz.ns.decryptData(nsReq);
         } else {
            this.resDecrypted(params);
         }
      } else {
         params.code = "APZ-SVR-ERR";
         this.apz.dispMsg(params);
      }
   }, decryptResCB : function(nsParams) {
      var params = nsParams.fwdData;
      params.resDec = params.res;
      params.res = JSON.parse(nsParams.text);
      ///Call reqEncrypted
      this.resDecrypted(params);
   }, resDecrypted : function(params) {
      this.processRes(params);
   }, processRes : function(params) {
      if(params.errors){
         if(params.errors[0] && params.errors[0].errorCode == "APZ-SMS-EX-003"){
         	params.errors[0].errorCode = "$APZ-SMS-EX-003";
            var param = {"code":"APZ-SMS-EX-003"};
            param.callBack = this.apz.app.sessionTimeoutCallBack;
            this.apz.dispMsg(param);
         }
      } else if (!params.internal) {
         ////Correct Response
         this.correctRes(params);
         ////Update Response
         this.updateResponse(params);
         if (params.paintResp == 'Y') {
            var loadData = true;
            if(this.apz.isFunction(this.apz.app.preLoadData)){
               loadData = this.apz.app.preLoadData();
               if (this.apz.isNull(loadData)) {
                  loadData = true;
               }
            }
            if (loadData) {
               var ifaceName = this.apz.getIfaceName(params.ifaceName);
               this.apz.data.loadData(ifaceName, params.appId);
            }
            if(this.apz.isFunction(this.apz.app.postLoadData)){
               this.apz.app.postLoadData();
            }
         }
      }
      ////Call Callback..
      if (this.apz.isFunction(params.callBack)) {
         if (params.callBackObj) {
            params.callBack.call(params.callBackObj, params);
         } else {
            params.callBack(params);
         }
      }
   }, updateResponse : function(params) {
         var rowdatapointer = {};
         var updateRes = true;
         if(this.apz.isFunction(this.apz.app.preUpdateResponse)){
            updateRes = this.apz.app.preUpdateResponse(params);
            if (this.apz.isNull(updateRes)) {
               updateRes = true;
            }
         }
         if(updateRes){
             this.updateDataResponse(params.res);
         }
         if(this.apz.isFunction(this.apz.app.postUpdateResponse)){
            this.apz.app.postUpdateResponse();
         }
   }, login : function(params) {
	   /* Params contains the below attributes
	       *** id, userId, pwd, callBackObj,callBack ***
	       * Response contains below attributes
	       *** res, errCode ***
	   */
      params.internal = true;
      params.ifaceName = "appzillonReLoginRequest";
      ////Update global userId
      this.apz.userId = params.userId;
      ////Build Request
      var req = {};
      req.loginRequest = {};
      req.loginRequest.appId = this.apz.appId;
      req.loginRequest.userId = params.userId;
      req.loginRequest.pwd = params.pwd;
      req.loginRequest.deviceId = this.apz.deviceId;
      req.loginRequest.sysDate = this.apz.getCurrTimeStamp();
      ////Request For privs
      if (!params.scrsAccessType) {
         params.scrsAccessType = "N";
      }
      if (!params.ifacesAccessType) {
         params.ifacesAccessType = "N";
      }
      if (!params.controlsAccessType) {
         params.controlsAccessType = "N";
      }
      req.loginRequest.scrsAccessType = params.scrsAccessType;
      req.loginRequest.ifacesAccessType = params.ifacesAccessType;
      req.loginRequest.controlsAccessType = params.controlsAccessType;
      params.req = req;
      ////Hash Password
      if (this.apz.authenticationType == "#DeviceId") {
         var nsReq = {};
         nsReq.fwdData = params;
         nsReq.id = params.id + "_HASHPWD";
         nsReq.callBackObj = this;
         nsReq.callBack = this.hashPwdCB;
         nsReq.userId = params.userId;
         nsReq.pwd = params.pwd;
         nsReq.serverToken = this.apz.serverToken;
         nsReq.deviceId = this.apz.deviceId;
         nsReq.date = req.loginRequest.sysDate;
         this.apz.ns.hashPwd(nsReq);
      } else {
         this.pwdHashed(params);
      }
   }, hashPwdCB : function(nsParams) {
      var params = nsParams.fwdData;
      params.pwdOrig = params.pwd;
      params.req.loginRequest.pwd = nsParams.text;
      ///Call pwdHashed
      this.pwdHashed(params);
   }, pwdHashed : function(params) {
      this.processLogin(params);
   }, processLogin : function(params) {
      ////Backup User Call Back..
      params.userCallBackObj = params.callBackObj;
      params.userCallBack = params.callBack;
      params.callBackObj = this;
      params.callBack = this.loginCB;
      //NewlyAdded
      params.internal = true;
      this.sendReq(params);
   }, loginCB : function(params) {
      ////Populate User Data / Privileges
      if (params.res.loginResponse && params.res.loginResponse.status) {
    	  this.apz.store('LOGIN', this.apz.getCurrTimeStamp());
         ////User Data
         this.populateUserDet(params.res.loginResponse.userDet);
         ////Privileges
         if(!this.apz.isNull(params.res.loginResponse.userDet)){
        	 this.populatePrivs(params.res.loginResponse.userDet.privs); 
         }
      }
      /////Call User Callback..
      if (this.apz.isFunction(params.userCallBack)) {
         if (params.userCallBackObj) {
            params.userCallBack.call(params.userCallBackObj, params);
         } else {
            params.userCallBack(params);
         }
      }
   }, populateUserDet : function(userDet) {
      if (userDet) {
         this.apz.userId = userDet.id;
         this.apz.userName = userDet.name;
         this.apz.userExtId = userDet.extId;
         this.apz.userProfilePic = userDet.profilePic;
         this.apz.lastLogin = userDet.lastLogin;
         this.apz.loadUserPrefs(userDet);
      }
   }, populatePrivs : function(privs) {
      if (privs) {
         this.apz.privs.scrsAccessType = privs.scrsAccessType;
         this.apz.privs.ifacesAccessType = privs.ifacesAccessType;
         this.apz.privs.controlsAccessType = privs.controlsAccessType;
         this.apz.privs.scrs = privs.scrs;
         this.apz.privs.ifaces = privs.ifaces;
         this.apz.privs.controls = privs.controls;
         ////Check and Init
         if (!this.apz.privs.scrsAccessType) {
            this.apz.privs.scrsAccessType = "N";
         }
         if (!this.apz.privs.ifacesAccessType) {
            this.apz.privs.ifacesAccessType = "N";
         }
         if (!this.apz.privs.controlsAccessType) {
            this.apz.privs.controlsAccessType = "N";
         }
         if (!this.apz.privs.scrs) {
            this.apz.privs.scrs = [];
         }
         if (!this.apz.privs.ifaces) {
            this.apz.privs.ifaces = [];
         }
         if (!this.apz.privs.controls) {
            this.apz.privs.controls = [];
         }
      }
   },
   applyPrivileges : function(){
	   var proceed = true;
	      if(this.apz.isFunction(this.apz.app.preapplyPrivileges)){
            proceed = this.apz.app.preapplyPrivileges()
            if (this.apz.isNull(proceed)) {
               proceed = true;
            } 
         }
	      if (proceed) {
	         //// To Hide if Control is Container and Disable if Control is Element	        
             var serverObj = this;
	         $("[apzcontrol]").filter(function(){
	            var controlID = this.attributes['apzcontrol'].value;
					if(!serverObj.apz.isNull(controlID)){
					   if(!serverObj.accessControl(controlID)){ ////APZCHANGE
						  serverObj.blockControl(this);
					   }              
					}
	            });	         
	      }
	      if(this.apz.isFunction(this.apz.app.postapplyPrivileges)){
	        this.apz.app.postapplyPrivileges();
	      }
	},
	accessControl : function (ctrlId){
		return this.hasPrivs(ctrlId,'controls');
	},
	accessInterfaces : function (ctrlId){
		return this.hasPrivs(ctrlId,'ifaces');
	},
	accessScreen : function (appId, scrId){
      appId = appId ? appId : this.apz.currAppId;
		return this.hasPrivs(appId+"__"+scrId,'scrs');
	},
	hasPrivs : function(objId, objType){
      var alwdOrDisalowd;
	   var grant = true;
	   var type = "9";
	   if(objType == 'scrs'){
	      alwdOrDisalowd = 'scrsAccessType';
	   }else if(objType == 'controls'){
	      alwdOrDisalowd = 'controlsAccessType';
	   }else if(objType == 'ifaces'){
		  alwdOrDisalowd = 'ifacesAccessType';
	   }
	   try{
	      type = this.apz.privs[alwdOrDisalowd];
	   }catch(err) {
	      type = "9";
	   }
	   
	   if (type == "D" ){
	      if(this.containsArrayElm(this.apz.privs[objType],objId)){
	         grant = false;         
	      }     
	      
	   }else if (type == "A" ){
	      grant = false;
	      if(this.containsArrayElm(this.apz.privs[objType],objId)){
	         grant = true;       
	      }     
	   }
	   return grant;
	},
	containsArrayElm : function(obj,key) {
	   var exists = false;
	   try{
		  if($.inArray(key,obj) > -1) {
			 exists = true;
		  }
	   }catch(e){
		  if(obj.includes(key)) {
			 exists = true;
		  }
	   }
	   return exists;
	},
    blockControl : function (obj){
        var tagName = obj.tagName;
        ////APZCHANGES Starts
        var lObj = $(obj);
        if(lObj.parent().hasClass("tabs")){
            lObj.addClass("sno");
          if(lObj.index() == 0 || (lObj.prev() && !lObj.siblings().hasClass('current'))){
           if(lObj.next()){
               lObj.siblings().removeClass("current");
               lObj.removeClass("current");
               lObj.next().addClass("current");
           }
          }
        } else if(lObj.hasClass("tabcontent")){
            lObj.addClass("sno");
            lObj.removeClass('visible');
          if(!lObj.siblings().hasClass('visible') && lObj.next()){
              lObj.next().addClass("visible");
          }
           ////APZCHANGES ENDS
        } else if((obj.hasAttribute("readonly") || obj.hasAttribute('disabled') || tagName == 'DIV' || tagName == 'LI' || tagName == 'SPAN' )){
            lObj.addClass("sno");
        } else {
            lObj.attr('disabled','disabled');
            lObj.css('pointer-events','none');
        }
    }, logout : function(params) {
     /* Params contains the below attributes
         *** userId,callBackObj,callBack ***
         * Response contains below attributes
         *** res, errCode ***
     */
      if (Apz.Audit) {
         this.apz.audit.clearAuditDetails();
      }
      params.internal = true;
      params.ifaceName = "appzillonLogoutRequest";
      ////Update global userId
      this.apz.userId = params.userId;
      ////Build Request
      var req = {};
      req.logoutRequest = {};
      req.logoutRequest.appId = this.apz.appId;
      req.logoutRequest.userId = params.userId;
      req.logoutRequest.deviceId = this.apz.deviceId;
      params.req = req;
       //Newly Added
      params.internal = true;
      this.sendReq(params);
   }, changePassword : function(params) {
	   /* Params contains the below attributes
        *** userId, callBack, oldPassword, newPassword, confirmPassword ***
        * Response contains below attributes
        *** res, errCode ***
    */
      if (apz.val.validatePassword(params)) {
         var req = {};
         req.changePasswordReq = {};
         req.changePasswordReq.userId = params.userId;
         req.changePasswordReq.oldPassword = params.oldPassword;
         req.changePasswordReq.newPassword = params.newPassword;
         req.changePasswordReq.confirmPassword = params.confirmPassword;
         req.changePasswordReq.callBack = params.callBack;
         params.req = req;
	     params.ifaceName = "appzillonChangePassword";
         this.encryptPassword(params);
      }
   }, encryptPassword : function(params) {
      var encryptJSON = {};
      encryptJSON.fwdData = params
      encryptJSON.id = "1";
      encryptJSON.key = this.apz.serverToken;
      encryptJSON.encryptionId="XYZ";
      encryptJSON.stringToEncrypt = params.newPassword;
      encryptJSON.callBack = this.encryptPasswordCB;
       encryptJSON.callBackObj = this;
      this.apz.ns.encryptData(encryptJSON);
   }, encryptPasswordCB : function(arg) {
         var params = arg.fwdData;
       if(arg.status){
           var serverToken = this.apz.serverToken;
           var userId = params.userId;
           var salt = userId + serverToken;
           params.newPassword = arg.text;
           params.salt=salt;
           params.date=this.apz.getCurrTimeStamp();
           var os = this.apz.deviceType;
    	   var nsReq = {};
           nsReq.fwdData = params;
           if (this.apz.authenticationType == "#DeviceId") {
               nsReq.id = params.id + "_HASHPWD";
               nsReq.callBackObj = this;
               nsReq.callBack = this.processChangePassword;
               nsReq.serverToken = serverToken;
         	   nsReq.deviceId = this.apz.deviceId;
               nsReq.salt=salt;
               nsReq.userId = params.userId;
               nsReq.pwd = params.oldPassword;
               nsReq.date = params.date;
               if ( os == 'IOS' ) {
                   this.apz.tempUserId = userId;
                   this.apz.ns.changePassword(nsReq);
               } else {
            	   this.apz.ns.hashPwd(nsReq);
               }
           } else {
           	   nsReq.status=true;
        	   this.processChangePassword(nsReq);
           }
       }else{
            params.callBack("failure");
       }
     
   }, processChangePassword : function(arg) {
	   var params = arg.fwdData;
	   if(arg.status){
		  var otp = arg.text;
	      var deviceId = this.apz.deviceId;
	      var oldPin = params.oldPassword;
	      var os = this.apz.deviceType;
         if (this.apz.authenticationType == "#DeviceId") {
            oldPin = otp;
         }
	      var body = {};
	      body.changePasswordRequest = {};
	      body.changePasswordRequest.appId = this.apz.appId;
	      body.changePasswordRequest.deviceId = deviceId;
	      body.changePasswordRequest.userId = params.userId;
	      body.changePasswordRequest.sysDate = params.date;
	      body.changePasswordRequest.pwd = oldPin;
	      body.changePasswordRequest.hashKey1 = this.apz.hashkey1;
	      body.changePasswordRequest.hashKey2 = this.apz.hashkey2;
	      body.changePasswordRequest.newPassword = params.newPassword;
	      params.req = body;
	      params.buildReq = "N";
         //Newly Added
         params.internal = true;
         this.sendReq(params);
	   }else{
            params.callBack(arg);
       }
   },
   /////////////////Correction Functions///////////////////////////////
   correctReq : function(params) {
	  var ifaceName = this.apz.getIfaceName(params.apzIfaceName);
      var reqRoot = this.apz.getReqRoot(ifaceName);
      if (params.ifaceDet.type == "ISO8583") {
         this.apz.iso = new Apz.Iso(this.apz);
         this.apz.iso.convertRequest(params);
      } else {
         var reqd = params.ifaceDet.correctReq;
         if (reqd) {
            for (var node in params.req) {
               if (!this.apz.isNull(node)) {
                  var childNode = params.req[node];
                  this.correctReqNode(ifaceName, params.req, reqRoot, childNode, node, params.appId);
               }
            }
         }
      }
      ////Remove Root Node
      params.req = params.req[reqRoot];
   }, correctReqNode : function(ifaceName, parentNode, parentName, node, name, appId) {
      var type = this.apz.getDataType(node);
      var ifaceObj = this.apz.getIfaceObj(ifaceName, appId);
      if ((type == "Object") || (type == "Array")) {
         var extName = "";
         var newObjStr = "";
         var params = {};
         params.iface = ifaceName;
         params.dml = "REQ";
         params.node = name;
         var nodeId = this.apz.getNodeId(params);
         var nodeData = ifaceObj.nodesMap[nodeId];
         var newName = nodeData.extName;
         var nsAlias = nodeData.nsAlias;
         if (this.apz.isNull(newName)) {
            newName = name;
         }
         /*if (!this.apz.isNull(nsAlias)) {  TBC - Not required anymore as extName is coming with extension?
            newName = nsAlias + ":" + newName;
         }*/
         ///Rename
         var args = {};
         args.parentNode = parentNode;
         args.node = node;
         args.oldName = name;
         args.newName = newName;
         node = this.apz.renameNode(args);
         var noOfRecs = 0;
         if (type == "Array") {
            noOfRecs = node.length;
         } else {
            noOfRecs = 1;
         }
         for (var r = 0; r < noOfRecs; r++) {
            var arrMember = null;
            if (type == "Array") {
               arrMember = node[r];
            } else {
               arrMember = node;
            }
            var memType = this.apz.getDataType(arrMember);
            if ((memType == "Object") || (memType == "Array")) {
               var childNode = null;
               for (var lnode in arrMember) {
                  if (!this.apz.isNull(lnode)) {
                     childNode = arrMember[lnode];
                     this.correctReqNode(ifaceName, arrMember, name, childNode, lnode, appId);
                  }
               }
            }
         }
      } else {
         ///Element Processing
         var params = {};
         params.iface = ifaceName;
         params.dml = "REQ";
         params.node = parentName;
         var nodeId = this.apz.getNodeId(params);
         var elmId = this.apz.getElmId(nodeId, name);
         var nodeData = ifaceObj.nodesMap[nodeId];
         var newName = nodeData.elmsMap[elmId].extName;
         var nsAlias = nodeData.elmsMap[elmId].nsAlias;
         if (this.apz.isNull(newName)) {
            newName = name;
         }
         /*if (this.apz.isNull(nsAlias)) {   TBC - Not required anymore as extName is coming with extension?
            newName = nsAlias + ":" + newName;
         }*/
         var args = {};
         args.parentNode = parentNode;
         args.node = node;
         args.oldName = name;
         args.newName = newName;
         this.apz.renameNode(args);
      }
   }, correctRes : function(params) {
   	  if(!this.apz.isNull(params.res)){
		  var ifaceName = this.apz.getIfaceName(params.apzIfaceName);
	      var resRoot = this.apz.getResRoot(ifaceName);
	      ////Add DML Node
	      var copy = this.apz.copyJSONObject(params.res);
	      this.apz.clearJSONObject(params.res);
	      params.res[resRoot] = copy;
	      /////////
	      if (params.ifaceDet.type == "ISO8583") {
			  if(apz.isNull(this.apz.iso)){
			   this.apz.iso = new Apz.Iso(this.apz);
			  }
	         this.apz.iso.convertResponse(params);
	      } else {
	         var reqd = params.ifaceDet.correctRes;
	         if (reqd) {
	            for (var node in params.res) {
	               if (!this.apz.isNull(node)) {
	                  var childNode = params.res[node];
	                  this.correctResNode(ifaceName, params.res, resRoot, childNode, node, null, params.appId);
	               }
	            }
	         }
	      }
      }
   }, correctResNode : function(ifaceName, parentNode, parentName, node, name, parents, appId) {
      var type = this.apz.getDataType(node);
      var extName = "";
      //var lparents = pparents;
      if (this.apz.isNull(parents)) {
         parents = node;
      } else {
         parents = parents + "~" + node;
      }
      var apzName = null;
      var ifaceObj = this.apz.getIfaceObj(ifaceName, appId);
      try {
         apzName = ifaceObj.extMap[parents];
      } catch (err) {
         apzName = null;
      }
      if (!this.apz.isNull(apzName)) {
         ////Rename if Required
         if (node != apzName) {
            var newObjStr = JSON.stringify(node);
            parentNode[apzName] = JSON.parse(newObjStr);
            delete parentNode[node];
            node = parentNode[apzName];
         }
         if ((type == "Object") || (type == "Array")) {
            var params = {};
            params.iface = ifaceName;
            params.dml = "RES";
            params.node = apzName;
            var nodeId = this.apz.getNodeId(params);
            ////Convert to Multi Record..
            if (ifaceObj.nodesMap[nodeId].relType == "1:N") {
               if (type == "Object") {
                  var newObjStr = JSON.stringify(node);
                  var newArr = [];
                  newArr[0] = JSON.parse(newObjStr);
                  delete parentNode[apzName];
                  parentNode[apzName] = newArr;
                  node = parentNode[apzName];
                  type = "Array";
               }
            }
            var noOfRecs = 0;
            if (type == "Array") {
               noOfRecs = node.length;
            } else {
               noOfRecs = 1;
            }
            for (var r = 0; r < noOfRecs; r++) {
               var arrMemeber = null;
               if (type == "Array") {
                  arrMemeber = node[r];
               } else {
                  arrMemeber = node;
               }
               var memType = this.apz.getDataType(arrMemeber);
               if ((memType == "Object") || (memType == "Array")) {
                  var childNode = null;
                  for (var lnode in arrMemeber) {
                     if (!this.apz.isNull(lnode)) {
                        childNode = arrMemeber[lnode];
                        var childType = this.apz.getDataType(childNode);
                        //if ((lchildtype == "Object") || (lchildtype ==
                        // "Array")) {
                        this.correctResNode(ifaceName, arrMemeber, name, childNode, lnode, parents, appId);
                        //}
                     }
                  }
               }
            }
         } else {
            ////Element Processing.. No Childs ..
         }
      } else {
         ////Should we delete???
      }
   }, updateDataResponse : function(res) {
      for (key in res) {
         this.apz.data.scrdata[key] = res[key];
      }
   }, fetchBeaconDetails : function(params) {
	   /* Params contains the below attributes
	       *** appId ***
	       * Response contains below attributes
	       *** res, errCode ***
	   */
      params.internal = true;
      params.ifaceName = "appzillonFetchBeaconDetails";
      var req = {};
      req.appzillonBeaconFetchRequest = {};
      req.appzillonBeaconFetchRequest.appId = params.appId;
      params.req = req;
      this.sendReq(params);
   }, insertBeaconDetails : function(params) {
	   /* Params contains the below attributes
	       *** appId, deviceId ***
	       * Response contains below attributes
	       *** res, errCode ***
	   */
      params.internal = true;
      params.ifaceName = "appzillonInsertBeacon";
      var req = {};
      req.appzillonBeaconInsertRequest = {};
      req.appzillonBeaconInsertRequest.appId = params.appId;
      req.appzillonBeaconInsertRequest.deviceId = params.deviceId;
      params.req = req;
      this.sendReq(params);
   }, updateBeaconDetails : function(params) {
	   /* Params contains the below attributes
	       *** id, status ***
	       * Response contains below attributes
	       *** res, errCode ***
	   */
      params.internal = true;
      params.ifaceName = "appzillonUpdateBeaconDetails";
      var req = {};
      req.appzillonBeaconUpdateRequest = {};
      req.appzillonBeaconUpdateRequest.id = params.id;
      req.appzillonBeaconUpdateRequest.status = params.status;
      params.req = req;
      this.sendReq(params);
   },fetchPreviligeDetails : function(params){
	   /* Params contains the below attributes
	       *** screensreqd, interfacesreqd, controlsreqd ***
	       * Response contains below attributes
	       *** res, errCode ***
	   */
       params.internal = true;
       params.ifaceName = "appzillonFetchPrivilegeService";
       var req = {};
       req.authorizationRequest = {};
       req.authorizationRequest.appId = this.apz.appId;
       req.authorizationRequest.deviceId = this.apz.deviceId;
       req.authorizationRequest.userId = this.apz.userId;
       req.authorizationRequest.scrsAccessType = params.screensreqd;
       req.authorizationRequest.ifacesAccessType = params.interfacesreqd;
       req.authorizationRequest.controlsAccessType = params.controlsreqd;
       params.req = req;
       this.sendReq(params);
   },validateOTP : function(params){
	   /* Params contains the below attributes
	       *** otp ***
	       * Response contains below attributes
	       *** res, errCode ***
	   */
	    params.internal = true;
	    params.ifaceName = "appzillonValidateOTP";
		var req = {};
		req.validateOtpRequest = {};
		req.validateOtpRequest.otp = params.otp;
		params.req = req;
      this.sendReq(params);
   },validateandProcessOTP : function(params){
	   /* Params contains the below attributes
	       *** otp, refno ***
	       * Response contains below attributes
	       *** res, errCode ***
	   */
	    params.internal = true;
	    params.ifaceName = "appzillonValNProcessIface";
	    var req = {};
	    req.validateNProcessRequest = {};
	    req.validateNProcessRequest.RefNo = params.refno;
	    req.validateNProcessRequest.otp = params.otp;
	    params.req = req;
       this.sendReq(params);
   },fetchAugumentedRealityDetails : function(params){
	    params.internal = true;
	    params.ifaceName = "appzillonFetchARDetails";
	    var req = {};
	    req.fetchARDetails = params.ardetailsobj;
	    req.fetchARDetails.appId = this.apz.appId;
	    params.req = req;
       this.sendReq(params);
   },getAddress : function(){ //Method to get the complete address of a user by passing the lat & lng
 	  var reqStr = {
 		"latlng": parseFloat(this.apz.latitude) + "," + parseFloat(this.apz.longitude),
 		"key": apz.googleMapsKey
 	  }
 	  var myObj = this;
 	  $.ajax({
        url : "https://maps.googleapis.com/maps/api/geocode/json", 
        data : reqStr,
        dataType : 'json',
        success : function(res,status) {
     	   myObj.apz.location = {
                "latitude" : myObj.apz.latitude,
               	"longitude" : myObj.apz.longitude
           };
           if(res.status == "OK"){
              var firstResult = res.results[0].address_components;
              for (var k = 0; k < firstResult.length; k++) {
                 if (firstResult[k].types.indexOf("sublocality") > -1) {
                     myObj.apz.location.sublocality = firstResult[k].long_name;
                 } else if (firstResult[k].types.indexOf("administrative_area_level_2") > -1) {
                     myObj.apz.location.admin_area_lvl_2 = firstResult[k].long_name;
                 } else if (firstResult[k].types.indexOf("administrative_area_level_1") > -1) {
                     myObj.apz.location.admin_area_lvl_1 = firstResult[k].long_name;
                 } else if (firstResult[k].types.indexOf("country") > -1) {
                     myObj.apz.location.country = firstResult[k].long_name;
                 }
             }
             if(res.results[0].formatted_address){
                 myObj.apz.location.formattedAddress = res.results[0].formatted_address;
             }
           }else{
            	console.log("Google Map returned with status:-"+res.status);
           }
        },
        error : function(obj,type) {	
		   console.log("Google Maps Error:"+ type);
         	  myObj.apz.location = {
         		"latitude" : myObj.apz.latitude,
         		"longitude" : myObj.apz.longitude
         	  };
           }
        });
   }

}
