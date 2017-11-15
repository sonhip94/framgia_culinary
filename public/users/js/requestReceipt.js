$(function(){
    privateChat = '';
    var pusher = new Pusher('31b9214bf8a1aae0c524', {
        cluster: 'ap1',
        encrypted: true
    });
    id_request_receipt = $('#id_request_receipt').val();
    receive_id = $('#receive_id').val();
    name = $('#nameUser').val();
    $('#create-request').on('click',function(){
        if ($('#nameReceipt').val() != '' && $('#rationReceipt').val() != '' && $('#descReceipt').val() != '' && ($('#imageReceipt').val() != '')) {
            var form_data = new FormData();
            form_data.append('name', $('#nameReceipt').val());
            form_data.append('ration', $('#rationReceipt').val());
            form_data.append('description', $('#descReceipt').val());
            form_data.append('image', $('#imageReceipt')[0].files[0]);
            $.ajax({
                url: 'request-receipt',
                type: 'post',
                processData: false,
                contentType: false,
                data: form_data,
                success: function (data) {
                    swal('Tạo yêu cầu thanh công','','success');
                    alertify.notify('Gửi yêu cầu thành công', 'success', 5, function() {});
                    window.location.href = document.location.origin + '/request-receipt/detail/' + data.id;
                },

                error: function(data) {
                    alertify.notify('Gửi yêu cầu thất bại', 'error', 5, function() {});
                }
            });
        }
        else {
            swal('Không tốt rồi!', 'Bạn hãy nhập đầy đủ thông tin nha', 'warning');
            alertify.notify('Gửi yêu cầu thất bại', 'error', 5, function() {});
        }
    });
    var chanel = pusher.subscribe('request-notify');
     chanel.bind('App\\Events\\NotifyRequest', function(data) {
         var request_user_name = data.request_user_name;
         $('.notify-widget').html('<a href="'+ document.location.origin + '/request-receipt/detail/' + data.request_id +'">'+data.request_user_name + ' vừa tạo yêu cầu</a>');
     });

    $('#input-message').on('keypress', function(event){
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            content = $(this).val();
            user_id = $(this).data('user_id');
            id = $(this).data('id');
            name = $(this).data('name_user');
            $.ajax({
                url: '/request-receipt/detail/'+id+'/livechat',
                type: 'post',
                data: {'content':content, 'user_id':user_id, 'id': id,'name':name},
                success: function(data){
                    console.log(data);
                }
            });
            $(this).val('');
        }
    });


    var chanelRequestReceiptChat = pusher.subscribe('request-receipt-chat'+id_request_receipt);
    chanelRequestReceiptChat.bind('App\\Events\\LiveChat', function(data) {
        var user = data.user_id;
        var curUser = $('#input-message').data('user_id');

        if (user == curUser) {
            var li = $('<li class="mess-by-me"></li><br>');
        } else {
            var li = $('<li class="mess-by-you"></li><br>');
        }

        li.html('<a href="'+document.location.origin+'/myprofile/'+data.user_id+'">'+data.name+'</a>:'+data.content);
        $('.show-all-messages').append(li);
    });
    //////////////////////--------------------------

    
    privateChanel = id_request_receipt+receive_id;

    $('#receive'+privateChanel).on('click',function(){
        $.post('/request-receipt/detail/'+id_request_receipt+'/getReceiveId',{'id':id_request_receipt,'receive_id':receive_id},function(data){
            console.log(data);
        });
    });

   
    $('#receive'+privateChanel).on('click',function(){
        $('#myModal'+privateChanel).css('display','block');
    });

    $('#private-message'+privateChanel).on('keypress',function(){
        
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if (keycode == '13') {
            privateMessage = $(this).val();
            $.ajax({
                url:'/request-receipt/detail/'+id_request_receipt+'/chatPrivate',
                type:'post',
                data:{'privateMessage':privateMessage,'receive_id':receive_id,'name':name,'privateChanel':privateChanel},
                success:function(data){
                    console.log(data);
                }
            })
            $(this).val('');
        }
    });

    var chanelChatPrivate = pusher.subscribe('chat-private'+privateChanel);
    chanelChatPrivate.bind('App\\Events\\ChatPrivate', function(data) {
        var user = data.receive_id;
        var curUser = $('#private-message'+privateChanel).data('user_id');
        var li = $('<li class="mess"></li>');
        $('#myModal'+privateChanel).css('display','block');

        li.html(data.name+':'+data.privateMessage);
        $('.show-message').append(li);
    });



    $('.close'+privateChanel).on('click',function(){
        $('#myModal'+privateChanel).css('display','none');
    });
});