// public\js\postannouncement.js
$(document).ready(function () {
    let selectedFiles = [];

    $('#media').on('change', function () {
        let files = Array.from(this.files);
        let previewContainer = $('#mediaPreview');

        // Append new files to the selectedFiles array
        files.forEach((file) => {
            if (
                !selectedFiles.some(
                    (f) =>
                        f.name === file.name &&
                        f.lastModified === file.lastModified
                )
            ) {
                selectedFiles.push(file);
            }
        });

        // Clear and rebuild the preview container
        previewContainer.html('');
        selectedFiles.forEach((file, index) => {
            let fileReader = new FileReader();
            fileReader.onload = function (event) {
                let fileType = file.type.split('/')[0];
                let mediaItem = `
                    <div class="media-item m-2 position-relative" data-index="${index}">
                        ${
                            fileType === 'image'
                                ? `<img src="${event.target.result}" alt="Image" class="img-thumbnail preview-image">`
                                : `<video src="${event.target.result}" controls class="img-thumbnail preview-video"></video>`
                        }
                        <button class="btn btn-sm btn-danger remove-media-btn">X</button>
                    </div>
                `;
                previewContainer.append(mediaItem);
            };
            fileReader.readAsDataURL(file);
        });

        // Clear the file input to allow selecting the same file again if needed
        $('#media').val('');
    });

    // Handle remove media button click
    $(document).on('click', '.remove-media-btn', function () {
        let mediaItem = $(this).closest('.media-item');
        let index = mediaItem.data('index');

        // Remove the file from the selectedFiles array
        selectedFiles.splice(index, 1);
        mediaItem.remove();

        // Rebuild the preview container with updated indices
        let previewContainer = $('#mediaPreview');
        previewContainer.html('');
        selectedFiles.forEach((file, newIndex) => {
            let fileReader = new FileReader();
            fileReader.onload = function (event) {
                let fileType = file.type.split('/')[0];
                let mediaItem = `
                    <div class="media-item m-2 position-relative" data-index="${newIndex}">
                        ${
                            fileType === 'image'
                                ? `<img src="${event.target.result}" alt="Image" class="img-thumbnail preview-image">`
                                : `<video src="${event.target.result}" controls class="img-thumbnail preview-video"></video>`
                        }
                        <button class="btn btn-sm btn-danger remove-media-btn">X</button>
                    </div>
                `;
                previewContainer.append(mediaItem);
            };
            fileReader.readAsDataURL(file);
        });
    });

    $('#postAnnouncementForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData();
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('caption', $('#caption').val());

        // Collect files from selectedFiles array
        selectedFiles.forEach(function (file) {
            formData.append('media[]', file);
        });

        console.log(selectedFiles);
        $.ajax({
            url: '/post-announcement',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                    $('#postAnnouncementForm')[0].reset();
                    $('#mediaPreview').html('');
                    selectedFiles = [];
                } else {
                    alert('Something went wrong!');
                }
            },
            error: function (xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errors = xhr.responseJSON.errors;
                    let errorMessages = Object.values(errors).flat().join('\n');
                    alert(errorMessages);
                } else {
                    alert('An error occurred while posting the announcement.');
                }
            },
        });
    });
});
