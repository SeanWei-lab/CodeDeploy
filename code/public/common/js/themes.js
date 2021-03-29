/**
 * Created by A.J on 2021/1/26.
 */
$(document).ready(function(){
    $('#upload').uploadify({
        auto:true,
        fileTypeExts:'*.zip',
        multi:false,
        formData:{},
        fileSizeLimit:9999,
        buttonText:$('#buttonText').text(),
        showUploadedPercent:true,
        showUploadedSize:false,
        removeTimeout:3,
        uploader:'uploadtheme',
        onUploadComplete:function(file,data){
            if(data == "ok"){
                location.reload();
            }
            else{
                $.alert({
                    title: $('#chucuo').text(),
                    content: data,
                    confirmButton: $('#queding').text()
                });
            }
        }
    });
});