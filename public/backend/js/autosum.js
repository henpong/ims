


function paidAmount() {
    // alert("OK");
  
    // sub total
    var subTotal = $("#subTotal").val();
    var subTotal = $("#subTotalValue").val();
    
    var cashPaid = $("#paid").val();
      if (cashPaid) {
          var amountDue = Number($("#subTotal").val()) - Number(cashPaid);
          amountDue = amountDue.toFixed(2);
          if(amountDue < 0){
              amountDue = '0.00';
          }
          $("#due").val(amountDue);
          $("#dueValue").val(amountDue);
      
      }else{
      
          $("#due").val($("#subTotal").val());
          $("#dueValue").val($("#subTotal").val());
      }
  
  
      var cashPaid = $("#paid").val();
  
        if(cashPaid) {
            var	changeAmt =  Number(cashPaid) - Number($("#subTotal").val());
            changeAmt = changeAmt.toFixed(2);
            if(changeAmt < 0){
                changeAmt = '0.00';
            }
            $("#change").val(changeAmt);
            $("#changeValue").val(changeAmt);
        } else {	
            $("#change").val($("#subTotal").val());
            $("#changeValue").val($("#subTotal").val());
        
        } // else
  
    } // /paid amount function
  
  
  
   
  
  
    function discountFunc() {
  
      // sub total
       var subTotal = $("#creditsubTotal").val();
       var subTotal = $("#creditsubTotalValue").val();
       var grandTotal = $("#creditgrandTotal").val();
       var discount = $("#creditDiscount").val();
          grandTotal = Number($("#creditsubTotal").val()) - Number(discount);
       grandTotal = grandTotal.toFixed(2);
       $("#creditgrandTotal").val(grandTotal);
     
       var amountDue;
       if(grandTotal) {  
         amountDue = Number($("#creditgrandTotal").val()) - Number($("#partpay").val());
         amountDue = amountDue.toFixed(2);
     
         $("#amtdue").val(amountDue);
         $("#amtdueValue").val(amountDue);
       } else {
     
         $("#amtdue").val($("#creditgrandTotal").val());
         $("#amtdueValue").val($("#creditgrandTotalValue").val());
       }
     
     
     
     } // /discount function
  
  
  
  
  
     function creditpartpayAmount() {
      var grandTotal = $("#creditgrandTotal").val();
    
      if(grandTotal) {
        var amountDue = Number($("#creditgrandTotal").val()) - Number($("#partpay").val());
        amountDue = amountDue.toFixed(2);
        $("#amtdue").val(amountDue);
        $("#amtdueValue").val(amountDue);
        
      } else{
    
        $("#amtdue").val($("creditgrandTotal").val());
        $("#amtdueValue").val($("creditgrandTotal").val());
      }// /else
    
    
     
    } // /paid amoutn function
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
  
    
  
  
  