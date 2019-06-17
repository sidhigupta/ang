$(document).ready(function(){
    $('.data_table').DataTable(
        {"scrollX": true}
    );
    $('.user_table').DataTable(
        {
            "scrollX": true,
            "columnDefs": [ {
                "targets": [0,4],
                "orderable": false,
            } ]
        }
    );
    if($('.csv_table').length != 0) {
        var tbl = $('.csv_table').DataTable(
            {"scrollX": true}
        );
        var buttons = new $.fn.dataTable.Buttons(tbl, {
            buttons: [
            {
                extend: 'csv',
                text: 'Export CSV',
                exportOptions: {
                    modifier: {
                        search: 'none'
                    }
                }
            }
        ]
        }).container().appendTo($('.card-btns'));
    }
})