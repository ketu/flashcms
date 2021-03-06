/* ------------------------------------------------------------------------------
 *
 *  # Responsive extension for Datatables
 *
 *  Specific JS code additions for datatable_responsive.html page
 *
 *  Version: 1.0
 *  Latest update: Aug 1, 2015
 *
 * ---------------------------------------------------------------------------- */




// Table setup
// ------------------------------

// Setting datatable defaults
$.extend(true, $.fn.dataTable.defaults, {
    autoWidth: true,
    responsive: true,
    dom: '<"datatable-header"fl><"datatable-scroll-wrap"t><"datatable-footer"ip>',
    language: {
        search: '<span>Filter:</span> _INPUT_',
        lengthMenu: '<span>Show:</span> _MENU_',
        paginate: {'first': 'First', 'last': 'Last', 'next': '&rarr;', 'previous': '&larr;'}
    },
    drawCallback: function () {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').addClass('dropup');
    },
    preDrawCallback: function () {
        $(this).find('tbody tr').slice(-3).find('.dropdown, .btn-group').removeClass('dropup');
    }
});


$(function () {
    // External table additions
    // ------------------------------
    // Add placeholder to the datatable filter option
    $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');


    // Select2 select

    $('.dataTables_length select').select2({
        minimumResultsForSearch: Infinity,
        // dropdownAutoWidth : true,
        width:'auto'
    });
});
