/*
 Template Name: Fonik - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Datatable js
 */

$(document).ready(function() {
    $('#datatable').DataTable( {
        dom: 'Bfrtip',
        paging:   false,
        ordering: false,
        info:     false,
        buttons: [
            'csv', 'excel', 'pdf', 'print',
        ]
    } );
} );