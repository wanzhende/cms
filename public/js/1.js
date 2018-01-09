var lay = function() {
    this.name="layer";
}

lay.prototype.open = function() {
    var str = "<div class=\"layui-layer\">\
            <div class=\"layui-layer-title\">\
                <span>提示</span>\
                <span class=\"layui-layer-setwin\">\
                    <a class=\"layui-layer-close\"></a>\
                </span>\
            </div>\
            <div class=\"layui-layer-content\">\
                <p>这是一段测试内容</p>\
            </div>\
        </div>\
        <div class=\"layui-shade\"></div>";
    var div = document.createElement('div');
    div.className = "shade";
    
    document.body.appendChild(div);
    document.body.innerHTML += str;
    var layuiShade = document.getElementsByClassName('layui-shade')[0];
    layuiShade.style.zIndex = 999;
    console.log(document.head);
    var link = document.createElement('link');
    link.rel = "stylesheet";
    link.href = "ui.css";
    link.type = "text/css";
    document.head.appendChild(link);
}

var a = new lay();
a.open();