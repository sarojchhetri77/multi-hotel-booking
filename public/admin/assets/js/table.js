"use strict";

var KTUsersList = function () {
    // Define shared variables
    var table = document.getElementById('kt_table_users');
    var datatable;
    var initUserTable = function () {
        const tableRows = table.querySelectorAll('tbody tr');

        tableRows.forEach(row => {
            const dateRow = row.querySelectorAll('td');
        });

        datatable = $(table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                { orderable: false, targets: 0 },
                { orderable: false, targets: 6 },                
            ]
        });

    }
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }


    return {
        // Public functions  
        init: function () {
            if (!table) {
                return;
            }

            initUserTable();
            handleSearchDatatable();

        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTUsersList.init();
});
