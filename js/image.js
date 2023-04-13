function iscookie() {
    return new Promise(function (resolve, reject) {
        $.post("../php/cookie.php", {},
            function (data, status) {
                if (!data)
                    window.location.href = 'login.html';
                else {
                    showImage().then(function () {
                        resolve()
                    })
                }
            })
    })
}

var image_data = [];
function showImage() {
    return new Promise(function (resolve, reject) {
        $.getJSON("../php/get_image.php",
            function (data) {
                image_data = data;
                resolve();
            }
        )
    })
}//展示图片

function imageChange() {
    $.post("../php/change_image.php",
        function (data) {
            console.log(data)
        }
    );
}

function changepage(n) {
    var ret = "<tr><td>序号</td><td>图片预览</td><td>标题</td><td>地址</td><td>上传时间</td></tr>";
    $('#all_images').html(ret)
    for (i in image_data) {
        if (i < 10 * n) continue;
        if (i > 10 * n + 9) break;
        var elements = image_data[i];
        var id = $('<td></td>').text(elements.id)
        var title = $('<td></td>').text(elements.title)
        // var image = $('<img src="..' + elements.address + '" alt="好像..读取失败了" width="150">')
        var image = $('<td></td>').text(elements.title)
        var address = $('<td></td>').text(elements.address)
        var addtime = $('<td></td>').text(elements.addtime)
        var tr = $('<tr></tr>').append(id, image, title, address, addtime)
        $('#all_images').append(tr)
    }
}

function createpage() {
    var pagenum = Math.ceil(image_data.length / 10);//向上取整
    for(var i = 0; i < pagenum; i++){
        $('#changepage').append("<span> " + i + " </span>")
    }
    $('#changepage>*').each(function (index,domEle) { 
        $(this).on('click', function(){
            console.log(index)
            changepage(index)
        })
        $(this).mouseenter(function(){
            $(this).css("cursor","Pointer");
        })
    });
}

iscookie().then(function () {
    $(document).ready(function () {
        $(document.body).show()
        changepage(0)
        createpage()
        $('#start_mes').click(function () {
            $('#all_images').html('')
            imageChange()
            showImage()
        })//按下上传图片
    });
});
