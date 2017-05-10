layui.config({base: '/static/public/layui/extend/'}).use(['jquery', 'element', 'layer', 'layedit', 'form' ,'tree', 'navtab'], function() {
    var element = layui.element();
    var layedit = layui.layedit;
    var form = layui.form();
    var $ = layui.jquery;
    var navtab = layui.navtab;
    navtab.setBind('test', 'docDemoTabBrief');
    layedit.build("demo");
    //iframe自适应
    $(window).on('resize', function() {
      var $obj = $('div.layui-tab-content');
      $obj.height($(this).height() - 198);
      $obj.find("div.layui-tab-item:nth-child(1)>div").height($obj.height()).css('overflow-y', "auto");
      $obj.find('iframe').each(function() {
        $(this).height($obj.height());
      });
    }).resize();
    form.on('checkbox', function(data) {
      console.log(data);
    });
});