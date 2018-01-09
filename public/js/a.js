var a = new hehe();
function hehe() {
    this.sex = '女';
}
hehe.prototype.name = "function() {    this.dd=\"张三\";}";
var b = new hehe();
a.name="李四";
alert(a.name);
alert(b.name);
a.dj8 = function() {
    alert(this.sex);
}
a.dj8();