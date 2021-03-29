/**
 * Created by A.J on 2017/7/14.
 */
$(document).ready(function(){
    var tmpeditor = "";
    var editor1;
    KindEditor.ready(function(K) {
        editor1 = K.create('textarea[name="neirong"]', {
            allowFileManager : true,
            width : '100%',
            height : '500px',
            cssData: 'body {font-family: "微软雅黑"; font-size: 16px}',
            afterCreate : function() {
                var self = this;
                K.ctrl(document, 13, function() {
                    self.sync();
                    $.zhaiyao();
                    K('form[name=writeForm]')[0].submit();
                });
                K.ctrl(self.edit.doc, 13, function() {
                    self.sync();
                    $.zhaiyao();
                    K('form[name=writeForm]')[0].submit();
                });
            },
            afterChange : function(){
                tmpeditor = this.html();
                $.record($("#pagename").text());
            }
        });
        prettyPrint();
    });
    $.extend({'getEditorContent':function(){
        return tmpeditor;
    }});
    $.extend({'setEditorContent':function(content){
        return editor1.html(content);
    }});
});
