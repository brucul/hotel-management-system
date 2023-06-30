function readURLUtama(input) {
	if (input.files && input.files[0]) {

		var reader = new FileReader();

		reader.onload = function(e) {
			$('#image-upload-wrap-utama').hide();

			$('#file-upload-image-utama').attr('src', e.target.result);
			$('#file-upload-content-utama').show();

			// $('#image-title-utama').html('Remove '+input.files[0].name);
		};

		reader.readAsDataURL(input.files[0]);

	} else {
		removeUploadUtama();
	}
}

function removeUploadUtama() {
	$('#file-upload-input-utama').replaceWith($('#file-upload-input-utama').clone());
	$('#file-upload-content-utama').hide();
	$('#image-upload-wrap-utama').show();
}
$('#image-upload-wrap-utama').bind('dragover', function () {
	$('#image-upload-wrap-utama').addClass('image-dropping');
});

$('#image-upload-wrap-utama').bind('dragleave', function () {
	$('#image-upload-wrap-utama').removeClass('image-dropping');
});
