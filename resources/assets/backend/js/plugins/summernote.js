/* ------------------------------------------------------------------------------
*
*  # Summernote editor
*
*  Specific JS code additions for editor_summernote.html page
*
*  Version: 1.0
*  Latest update: Aug 1, 2015
*
* ---------------------------------------------------------------------------- */

$(function() {

    // Basic editors
    // ------------------------------


    $('.summernote, .summernote-height').each( function() {
        $(this).val($(this).summernote('code'));
    });



    // Related form components
    // ------------------------------

    // Styled checkboxes/radios
    $(".link-dialog input[type=checkbox], .note-modal-form input[type=radio]").uniform({
        radioClass: 'choice'
    });


    // Styled file input
    $(".note-image-input").uniform({
        fileButtonClass: 'action btn bg-warning-400'
    });

});
