require('./bootstrap');
require('tinymce/themes/silver'); // first selete thim from node_moduels
import tinymce from "tinymce";
require('tinymce/plugins/image');
require('tinymce/plugins/code');
tinymce.init({
    selector: 'textarea#content',
    height: 400,
    skin: false,
    content_css: false,
    image_title: true,
    plugins: "code image",



    images_upload_handler: function (blobInfo, success, failure) {
       let formData = new FormData();
        formData.append('file', blobInfo.blob());

        axios.post("/admin/tinymce/upload", formData)
            .then(function(response){
                success(response.data.location)
            });
    }

});
