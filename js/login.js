$(document).ready(function () {
    $("#login").click(function () {
        var name = $("#login_name").val();
        var key = $("#login_key").val();
        if (name && key) {
            $.post("../php/login.php", {
                name: name,
                key: key
            },
                function (data, status) {
                    if (!data) {
                        $("#login_return").text("登陆失败,请检查你的账号密码");
                    }
                    else{
                        window.location.href = "image.html";
                    }
                }
            )
        }
        else{
            $("#login_return").text("请输入账号密码2");
        }
    });
});