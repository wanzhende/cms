function dayAdd(date_str, day_num) {
    var separator =  '-';
    d = date_str ?  new Date(date_str) : new Date(); 
    day_num = parseInt(day_num) || 0;
    d.setDate(d.getDate() + day_num);
    var year = d.getFullYear();
    var month = ('0' + (d.getMonth() + 1)).substr(-2,2);
    var day = ('0' + d.getDate()).substr(-2,2);
    var str = year + separator + month + separator + day;
    return str;
}