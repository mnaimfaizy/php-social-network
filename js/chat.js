$(function () {

    $.fn.extend({
        LoadMessages: function () {

            var dataToSend = {
                task: "get",
                to_user_id: $("#to_user_id_hid").val()
            }

            $.ajax({
                url: "message_send.php",
                data: dataToSend,
                type: "post",
                success: function (data) {

                    if (data != "0") {
                        $("#chat-area").append(data);
                        document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
                    }
                    setTimeout($.fn.LoadMessages(), 1000);
                }

            });

        }
    });

    $("#msgForm").on('submit', function (e) {
        e.preventDefault();

        var dataToSend = {
            task: "send",
            to_user_id: $("#to_user_id_hid").val(),
            content: $("#userMessage").val()
        }

        $.ajax({
            url: "message_send.php",
            data: dataToSend,
            type: "post",
            success: function (data) {
                var content = $("#userMessage").val();
				var msgDATE = $("#msgDate").val();
				
                $("#chat-wrap #chat-area").append('<p class="from_msg">' + content + '</p>');
                $("#userMessage").val('');
				document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;
            }
        });
    });

    //$.fn.LoadMessages();

    setTimeout($.fn.LoadMessages(), 1000);

    $("#userMessage").on('keydown', function (e) {
        if (e.keyCode == 13) {
            $("#msgForm").trigger('submit');
        }
    });

});
