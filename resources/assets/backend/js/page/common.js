/**
 * Created by ketu on 17-4-2.
 */

$(function () {

    $('.confirm-delete-action').click(function () {

        if (confirm('Are you sure to delete?')){
            return true;
        }
        return false;
    });
});