$(document).ready(function(){


    //CHECK WHETHER ADMIN PASSWORD IS CORRECT OR NOT
    $("#currentPass").keyup(function(){
        var currentPass = $("#currentPass").val();
        //alert(currentPass);
 
        $.ajax({
            type: 'post',
            url: '/admin/check_current_pswd', 
            data: {currentPass:currentPass},
            success: function(resp){
                //alert(resp);
                if(resp=="false"){
                    $("#chkCurrentPass").html("<font color=red>Sorry, Current Password is Incorrect</font>");
                }else if(resp=="true"){
                    $("#chkCurrentPass").html("<font color=green>OK Friend, Your Current Password is Correct</font>");
                }
            },error: function(){
                alert("Error");
            }
        })
    });



        //UPDATE SECTION STATUS USING AJAX
        $(".updateSectionStatus").click(function(){
        var section_status = $(this).text();
        var section_id = $(this).attr("section_id");
        // alert(section_status);
        // alert(section_id);
        $.ajax({
            type: "post",
            url: "/admin/update_section_status",
            data:{section_status:section_status,section_id:section_id},
            success:function(resp){
                // alert(resp['section_status']);
                // alert(resp['section_id']);
                //Get Response and Change Status in HTML
                if(resp['section_status']==0){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['section_status']==1){
                    $("#section-"+section_id).html("<a class='updateSectionStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });



    //UPDATE BRANCH STATUS USING AJAX
    $(".updateBranchStatus").click(function(){
        var branch_status = $(this).text();
        var branch_id = $(this).attr("branch_id");
        // alert(status);
        // alert(branch_id);
        //console.log(branch_status);
        $.ajax({
            type: "post",
            url: "/admin/update_branch_status",
            data:{branch_status:branch_status,branch_id:branch_id},
            success:function(resp){
                // alert(resp['status']);
                // alert(resp['branch_id']);
                //Get Response and Change Status in HTML
                if(resp['branch_status']==0){
                    $("#branch-"+branch_id).html("<a class='updateBranchStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['branch_status']==1){
                    $("#branch-"+branch_id).html("<a class='updateBranchStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });




    //UPDATE USERS STATUS USING AJAX
    $(".updateUserStatus").click(function(){
        var user_status = $(this).text();
        var user_id = $(this).attr("user_id");
        // alert(status);
        // alert(user_id);
        // console.log(user_status);
        $.ajax({
            type: "post",
            url: "/admin/update_users_status",
            data:{user_status:user_status,user_id:user_id},
            success:function(resp){
                // alert(resp['status']);
                // alert(resp['user_id']);
                //Get Response and Change Status in HTML
                if(resp['user_status']==0){
                    $("#user-"+user_id).html("<a class='updateUserStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['user_status']==1){
                    $("#user-"+user_id).html("<a class='updateUserStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });




    //UPDATE CATEGORY STATUS USING AJAX
    $(".updateCategoryStatus").click(function(){
        var category_status = $(this).text();
        var category_id = $(this).attr("category_id");
        // alert(category_status);
        // alert(category_id);
        $.ajax({
            type: "post",
            url: "/admin/update_category_status",
            data:{category_status:category_status,category_id:category_id},
            success:function(resp){
                // alert(resp['category_status']);
                // alert(resp['category_id']);
                //Get Response and Change Status in HTML
                if(resp['category_status']==0){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['category_status']==1){
                    $("#category-"+category_id).html("<a class='updateCategoryStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Error");
            }
        });
    });


    //Append Categories Level
    $("#section_id").change(function(){
        // alert("OK");
        var section_id = $(this).val();
        $.ajax({
            type:'post',
            url:'/admin/append_categories_level',
            data:{section_id:section_id},
            success:function(resp){
                $("#appendCategoriesLevel").html(resp);
            },error:function(){
                alert("Sorry, there was an error");
            }
        });
    });




       //UPDATE SUPPLIER STATUS USING AJAX
       $(".updateSupplierStatus").click(function(){
        var supplier_status = $(this).text();
        var supplier_id = $(this).attr("supplier_id");
        // alert(supplier_status);
        // alert(supplier_id);
        $.ajax({
            type: "post",
            url: "/admin/update_supplier_status",
            data:{supplier_status:supplier_status,supplier_id:supplier_id},
            success:function(resp){
                // alert(resp['supplier_status']);
                // alert(resp['supplier_id']);
                //Get Response and Change Status in HTML
                if(resp['supplier_status'] == 0){
                    $("#supplier-"+supplier_id).html("<a class='updateSupplierStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['supplier_status'] == 1){
                    $("#supplier-"+supplier_id).html("<a class='updateSupplierStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Sorry, there was an error");
            }
        });
    });

 

    
    //UPDATE BANK STATUS USING AJAX
    $(".updateBankStatus").click(function(){
        var ac_status = $(this).text();
        var bank_id = $(this).attr("bank_id");
        // alert(ac_status);
        // alert(bank_id);
        $.ajax({
            type: "post",
            url: "/admin/update_bank_status",
            data:{ac_status:ac_status,bank_id:bank_id},
            success:function(resp){
                // alert(resp['category_status']);
                // alert(resp['category_id']);
                //Get Response and Change Status in HTML
                if(resp['ac_status']==0){
                    $("#bank-"+bank_id).html("<a class='updateBankStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['ac_status']==1){
                    $("#bank-"+bank_id).html("<a class='updateBankStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Sorry, there was an error");
            }
        });
    });

    


     //UPDATE MAINWAREHOUSE STATUS USING AJAX
     $(".updateMainWarehouseStatus").click(function(){
        var mainwarehouse_status = $(this).text();
        var mainwarehouse_id = $(this).attr("mainwarehouse_id");
        // alert(mainwarehouse_status);
        // alert(mainwarehouse_id);
        $.ajax({
            type: "post",
            url: "/admin/update_mainwarehouse_status",
            data:{mainwarehouse_status:mainwarehouse_status,mainwarehouse_id:mainwarehouse_id},
            success:function(resp){
                // alert(resp['mainwarehouse_status']);
                // alert(resp['mainwarehouse_id']);
                //Get Response and Change Status in HTML
                if(resp['mainwarehouse_status'] == 0){
                    $("#mainwarehouse-"+mainwarehouse_id).html("<a class='updateMainWarehouseStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['mainwarehouse_status'] == 1){
                    $("#mainwarehouse-"+mainwarehouse_id).html("<a class='updateMainWarehouseStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Sorry, there was an error");
            }
        });
    });



    //UPDATE PRODUCT STATUS USING AJAX
    $(".updateProductStatus").click(function(){
        var product_status = $(this).text();
        var product_id = $(this).attr("product_id");
        // alert(product_status);
        // alert(product_id);
        $.ajax({
            type: "post",
            url: "/admin/update_products_in_branches_status",
            data:{product_status:product_status,product_id:product_id},
            success:function(resp){
                // alert(resp['product_status']);
                // alert(resp['product_id']);
                //Get Response and Change Status in HTML
                if(resp['product_status'] == 0){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)' style='color:#ff0000'>Inactive</a>");
                }else if(resp['product_status'] == 1){
                    $("#product-"+product_id).html("<a class='updateProductStatus' href='javascript:void(0)' style='color:#007bff'>Active</a>");
                }
            },error:function(){
                alert("Sorry, there was an error");
            }
        });
    });



       //Take Decision On Stock Request
       $('#approveLowstockRequest').on('show.bs.modal',function(event){
        // alert('ok')
        var btn = $(event.relatedTarget)
        var request_status = btn.data('request_status')
        var request_id = btn.data('request_id')
    

        var modal = $(this)
        //modal.find('.modal-title').text("READY TO GO");
        modal.find('.modal-body #request_status').val(request_status);
        modal.find('.modal-body #request_id').val(request_id);

        
      });



    //Make Temporal Credit Payment
    $('#payCredit').on('show.bs.modal',function(event){
        // alert('ok')
        var btn = $(event.relatedTarget)
        var branch_id = btn.data('branch_id')
        var branch_name = btn.data('branch_name')
        var customer_id = btn.data('customer_id')
        var customer_name = btn.data('customer_name')
        var amt_owned = btn.data('amt_owned')
        var temporal_credit_id = btn.data('temporal_credit_id')
    

        var modal = $(this)
        //modal.find('.modal-title').text("READY TO GO");
        modal.find('.modal-body #branch_name').val(branch_name);
        modal.find('.modal-body #customer_name').val(customer_name);
        modal.find('.modal-body #amt_owned').val(amt_owned);
        modal.find('.modal-body #temporal_credit_id').val(temporal_credit_id);
        modal.find('.modal-body #branch_id').val(branch_id);
        modal.find('.modal-body #customer_id').val(customer_id);

  
      });



    //Make Credit Payment
    $('#makePayment').on('show.bs.modal',function(event){
        // alert('ok')
        var btn = $(event.relatedTarget)
        var branch_name = btn.data('branch_name')
        var customer_name = btn.data('customer_name')
        var amt_owed = btn.data('amt_owed')
        var payment_id = btn.data('payment_id')
        var sales_id = btn.data('sales_id')
        var branch_id = btn.data('branch_id')
    

        var modal = $(this)
        //modal.find('.modal-title').text("READY TO GO");
        modal.find('.modal-body #branch_name').val(branch_name);
        modal.find('.modal-body #amt_owed').val(amt_owed);
        modal.find('.modal-body #payment_id').val(payment_id);
        modal.find('.modal-body #sales_id').val(sales_id);
        modal.find('.modal-body #branch_id').val(branch_id);

  
      });



    //Confirm Before Deleting Any Record
    $(".confirmDelete").click(function(){
        
        //Normal Javascript to Confirm Deletion
        //var name = $(this).attr("name");
        // if(confirm("Are you sure you want to delete " + name + "?")){
        //     return true;
        // }
        // return false;

        //Using SweetAlert2 to Confirm Deletion
        var record = $(this).attr("record");
        var recordid = $(this).attr("recordid");

        Swal.fire({
            title: 'Are you sure you want to delete this record?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
            //   Swal.fire(
            //     'Record deleted successfully!',
            //     'Your file has been deleted.',
            //     'success'
            //   )
              window.location.href="/admin/delete_"+record+"/"+recordid;
            }
          });
    });




});