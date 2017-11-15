$(document).ready(function () {
    $('#tabs').tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
    $(".btn-pref .btn").click(function () {
        $(".btn-pref .btn").removeClass("btn-primary").addClass("btn-default");
        $(this).removeClass("btn-default").addClass("btn-primary");
    });


    $("#updateInfo").on("click",function(){
        var form_data = new FormData();
        id = $(this).attr("data-id");
        form_data.append("name", $("#name").val());
        form_data.append("phone", $("#phone").val());
        form_data.append("address", $("#address").val());
        form_data.append("id", $(this).attr("data-id"));
        form_data.append("avatar", $('#avatar')[0].files[0]);
        $.ajax({
            url: "/myprofile/"+id+"/updateProfile",
            type: "post",
            processData: false,
            contentType: false,
            data: form_data,
            success: function (data) {
                $("#name").val(data.name);
                $("#phone").val(data.phone);
                $("#address").val(data.address);
                $(".profile-userpic img").attr("src","/upload/images/"+data.avatar);
                $(".useravatar img").attr("src",'/upload/images/'+data.avatar);
                alertify.notify('Thay đổi thành công', 'success', 5, function() {});
            },

            error: function(data) {
                alertify.notify('Thay đổi thất bại', 'error', 5, function() {});
            }
        });
    });
});
