function initDataTable(table, url, notsearchable, notsortable, fnserverparams , order_by_desc) {
    var default_order = 'asc';
    if ($(table).length == 0) {
        return;
    }
    if (order_by_desc){
        default_order = order_by_desc;
    }
    var length_options = [10,25, 50, 100];
    var length_options_names = [10 , 25, 50, 100];

    tables_pagination_limit = parseFloat(tables_pagination_limit);

    if ($.inArray(tables_pagination_limit, length_options) == -1) {
        length_options.push(tables_pagination_limit)
        length_options_names.push(tables_pagination_limit)
    }

    length_options.sort(function(a, b) {
        return a - b;
    });
    length_options_names.sort(function(a, b) {
        return a - b;
    });
    if (fnserverparams == 'undefined' || typeof(fnserverparams) == 'undefined') {
        fnserverparams = []
    }
    length_options.push(-1);
    length_options_names.push("All");
    table = $('body').find(table).dataTable({
        "processing": true,
        "retrieve": true,
        dom: 'Blfrtip',
        "serverSide": true,
        'paginate': true,
        'searchDelay': 700,
        "bDeferRender": true,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "stateSave": true,
        "order" :  [[0, default_order]],
        "lengthMenu": [length_options, length_options_names],
        "columnDefs": [{
            "searchable": false,
            "targets": notsearchable,
        }, {
            "sortable": false,
            "targets": notsortable
        }],
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
            // If tooltips found
            $(nRow).attr('data-title', aData.Data_Title)
            $(nRow).attr('data-toggle', aData.Data_Toggle)
        },
        "ajax": {
            "url": url,
            "type": "POST",
            "dataType":'json',
            "data": function(d) {
                for (var key in fnserverparams) {
                    d[key] = $(fnserverparams[key]).val();
                }
            }
        },

        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        // buttons: get_dt_export_buttons(table),
    });

    var tableApi = table.DataTable();

    return tableApi;
}
