$('#form-add-user').validate({
    rule:{
        txtname:"required",
        email:"required",
        password:{
            required:true,
            minlenght:6
        },
        repass:{
            required:true,
            equalTo:"#addpassword"
        },
        group_role:"required"   
    },
    messages:{

    }
});