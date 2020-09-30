Dropzone.options.dropzoneFrom = {
    autoProcessQueue: false,
    acceptedFiles: ".png,.jpg,.gif,.jpeg",
    maxFilesize: 1.0, //1 MB
    maxFiles: 20,
    maxThumbnailFilesize: 1, // MB

    init: function () {
        var submitButton = document.querySelector('#submit_all');
        myDropzone = this;

        submitButton.addEventListener("click", function () {

            myDropzone.processQueue();

         });

        this.on("complete", function () {

            if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                var _this = this;
                _this.removeAllFiles();
                window.location.replace("photos-all");
            }
            //list_image();

        });

    },
};