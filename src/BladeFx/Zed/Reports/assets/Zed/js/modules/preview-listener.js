'use strict';

var reportTab = document.querySelector('#tab-content-report');


function initialize() {
    const listenerAdder = new PreviewListenerAdder();
    listenerAdder.addListenerToReportsTable();
}

function PreviewListenerAdder() {
    function addListenerToReportsTable() {
        setTimeout(() => {
            const tableContainer = reportTab.querySelector('div.dataTables_scrollBody')
            var $reportsTable = $(tableContainer.querySelector('table')).DataTable();

            $reportsTable.on('draw', function () {
                let tableRows = tableContainer.querySelectorAll('tr')
                tableRows.forEach((row) => {
                    if (row.classList.contains('odd') || row.classList.contains('even')){
                        row.addEventListener('dblclick', () => {
                            window.location = row.querySelector('a.btn-preview').href
                        });
                    }

                });
            });
        }, 100);
    }

    return {
        addListenerToReportsTable: addListenerToReportsTable,
    }
}

module.exports = {
    initialize: initialize,
}
