$(function() {
    tinymce.init({
        selector: 'textarea#content',
        height: 500,
        menubar: false,
        statusbar: false,
        relative_urls: false,
        remove_script_host : false,
        image_title: true,
        file_picker_types: 'image',
        automatic_uploads: false,
        convert_urls : true,
        images_upload_handler: function (blobInfo, success, failure) {
            var xhr, formData,
                csrfToken = document.getElementById("_token").value;
            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'uploadImage');
            xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
            xhr.onload = function () {
                var json;
                if (xhr.status != 200) {
                    failure('HTTP ERROR: ' + xhr.status);
                    return;
                }
                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.location != 'string') {
                    failure('Invalid JSON ' + xhr.responseText);
                    return;
                }
                success(json.location);
            };
            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());
            xhr.send(formData);
        },
        file_picker_callback: function (cb, value, meta) {
            var input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');
            input.onchange = function() {
                var file = this.files[0],
                    reader = new FileReader();

                reader.onload = function () {
                    var id = 'blobid' + (new Date()).getTime();
                    var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    var base64 = reader.result.split(',')[1];
                    var blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    // call the callback and populate the Title field with the file name
                    cb(blobInfo.blobUri(), { title: file.name });
                };
                reader.readAsDataURL(file);
            };
            input.click();
        },
        plugins: [
            'autolink link image preview anchor textcolor',
            'image imagetools',
            'template',
            'insertdatetime media table paste code'
        ],
        templates: [
            {title: 'Sample Template', description: 'Sample Template for Signup', url: 'templates/signup'}
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | image | imageupload | template',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '//www.tinymce.com/css/codepen.min.css']
    });
});