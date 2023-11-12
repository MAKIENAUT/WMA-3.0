function limitTextarea(element, maxLength) {
    let value = element.value;
    if (value.length > maxLength) {
        element.value = value.slice(0, maxLength);
    }
}

function handleFileSelect(event) {
    event.stopPropagation();
    event.preventDefault();

    var files = event.target.files || event.dataTransfer.files;

    if (files.length > 0) {
        previewThumbnail(files[0]);
    }
}

function handleDragOver(event) {
    event.stopPropagation();
    event.preventDefault();
    event.dataTransfer.dropEffect = 'copy';
}

function handleDrop(event) {
    event.stopPropagation();
    event.preventDefault();

    var files = event.dataTransfer.files;

    if (files.length > 0) {
        previewThumbnail(files[0]);
    }
}

function previewThumbnail(file) {
    var thumbnailContainer = document.getElementById('thumbnailContainer');
    var thumbnailLabel = document.getElementById('thumbnailLabel');

    if (file) {
        var reader = new FileReader();

        reader.onload = function (e) {
            thumbnailContainer.style.backgroundImage = 'url(' + e.target.result + ')';
            thumbnailLabel.style.display = 'none';
        };

        reader.readAsDataURL(file);
    } else {
        thumbnailContainer.style.backgroundImage = 'none';
        thumbnailLabel.style.display = 'block';
    }
}