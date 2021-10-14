ready((event) => {
    
    let mediaUploader;

    document.querySelector('#upload-button').addEventListener('click', (e) => {
        e.preventDefault();
        if ( mediaUploader ) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose a Profile Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });

        mediaUploader.on('select', () => {
            const attachment = mediaUploader.state().get('selection').first().toJSON();
            document.querySelector('#profile-image').value = attachment.url;
            document.querySelector('#profile-image-preview').style.backgroundImage = 'url(' + attachment.url + ')';
        })

        mediaUploader.open();

    });

})


/*
    ==============================
    |   Document Ready Function
    ==============================
*/
function ready(callbackFunction){
    if(document.readyState != 'loading') {
        callbackFunction(event);
    } else {
        document.addEventListener("DOMContentLoaded", callbackFunction);
    }
}