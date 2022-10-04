        $('#add_employees_page').validate({
                ignore: [],
                rules: {
                    name: "required",
                    department:"required",
                    email: {
                        required: true,
                        email: true
                    },
                    
                },
                messages: {
                   name: {
                    required: "Please enter name",
                   },
                   email: {
                    required: "Please enter email address",
                    email: "Please enter a valid email address.",
                   },
                   department: {
                    required: "Please select department",
                   },      
                },
                
            });


    function deleteClient(id){
        swal({
            title: "Are you sure you want to delete ?",
            text: "",
              type: "warning",
              showCancelButton: true,
              confirmButtonColor: "#07689f",
              confirmButtonText: "Yes",
              cancelButtonText: "No",
              closeOnConfirm: true,
              closeOnCancel: true
            },
            function(isConfirm){
              if (isConfirm) {
                var Url = baseurl+'/admin/delete_employees/'+id;	
                window.location.href = Url;
              } else {

              }
            });
    }