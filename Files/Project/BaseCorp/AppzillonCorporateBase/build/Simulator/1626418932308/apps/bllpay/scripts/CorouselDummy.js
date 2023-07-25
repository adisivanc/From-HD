// Corousel = (function(){
    
//       var data = [];
//       var commonId = "";
//       pointer  = 0 ;
      
//       return {
//           init : function(id){
//              commonId = id;  
//               $("#"+commonId+"left").attr("disabled","disabled");
//           },
//           setData : function(d,id){
//               data = d;
//           },
//           forward : function(){
//               if(pointer < data.length-1){
                   
//                   pointer++;
//                   if(pointer == data.length -1 ){
//                       $("#"+commonId+"right").attr("disabled","disabled");
//                       $("#"+commonId+"left").removeAttr("disabled","disabled");
//                   }else if(pointer > 0){
//                       $("#"+commonId+"left").removeAttr("disabled","disabled");
//                   }
//               }else{
//                   $("#"+commonId+"right").attr("disabled","disabled");
//               }
//               return pointer;
               
//           },
//           previous : function(){
//                 if(pointer >= 0){
                  
//                   pointer--;
//                   if(pointer ==0){
//                       $("#"+commonId+"left").attr("disabled","disabled");
//                         $("#"+commonId+"right").removeAttr("disabled","disabled");
//                   }else if(pointer < data.length -1 ){
//                          $("#"+commonId+"right").removeAttr("disabled","disabled");
//                   }
//               }else{
//                   $("#"+commonId+"left").attr("disabled","disabled");
//               }
//               return pointer;
//           },
//           getIndex : function(){
//               return pointer;
//           }
           
//       }
    
// })();
CorouselD = (function(){
    
         return {
             initialise : function(){
                 return new CorouselContainer();
             }
         };
    
})();
function CorouselContainer(){
     this.data = [];
     this.commonId = "";
     this.pointer  = 0 ;
}
CorouselContainer.prototype = {
    
           init : function(id){
             this.commonId = id;  
               $("#"+this.commonId+"left").attr("disabled","disabled");
           },
           setData : function(d,id){
               this.data = d;
           },
           forward : function(){
               if(this.pointer < this.data.length-1){
                   
                   this.pointer++;
                   if(this.pointer == this.data.length -1 ){
                       $("#"+this.commonId+"right").attr("disabled","disabled");
                       $("#"+this.commonId+"left").removeAttr("disabled","disabled");
                   }else if(this.pointer > 0){
                       $("#"+this.commonId+"left").removeAttr("disabled","disabled");
                   }
               }else{
                   $("#"+this.commonId+"right").attr("disabled","disabled");
               }
               return this.pointer;
               
           },
           previous : function(){
                if(this.pointer >= 0){
                  
                   this.pointer--;
                   if(this.pointer === 0){
                       $("#"+this.commonId+"left").attr("disabled","disabled");
                        $("#"+this.commonId+"right").removeAttr("disabled","disabled");
                   }else if(this.pointer < this.data.length -1 ){
                         $("#"+this.commonId+"right").removeAttr("disabled","disabled");
                   }
               }else{
                   $("#"+this.commonId+"left").attr("disabled","disabled");
               }
               return this.pointer;
           },
           getIndex : function(){
               return this.pointer;
           }
    
       };