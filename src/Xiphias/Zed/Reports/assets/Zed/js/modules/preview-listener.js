'use strict';

var reportTab = document.querySelector('#tab-content-report');
var reportBlock = document.querySelector('#reports');
var $previewModal = $('.preview-modal');
var $loader = $('.loader');

function initialize() {
    const listenerAdder = new PreviewListenerAdder();
    listenerAdder.addListenerToReportsTable();
}

function PreviewListenerAdder() {
    function addListenerToReportsTable() {
        setTimeout(() => {
            let tableContainer = getTableContainer();
            var $reportsTable = $(tableContainer.querySelector('table')).DataTable();

            $reportsTable.on('draw', function () {
                let tableRows = tableContainer.querySelectorAll('tr')
                tableRows.forEach((row) => {
                    if (row.classList.contains('odd') || row.classList.contains('even')) {
                        let button = row.querySelector('a.btn-edit');

                        if (!button) {
                            button = row.querySelector('a.btn-preview');
                        }

                        if (button !== null) {
                            button.addEventListener('click', async (e) => {
                                e.preventDefault();
                                displayModal();
                                const iframeUrl = await getIframeUrl(button.href)
                                $('.modal-body').attr('src', iframeUrl);
                                $loader.addClass('hidden');
                            });

                            row.addEventListener('dblclick', async () => {
                                displayModal();
                                const iframeUrl = await getIframeUrl(button.href)
                                $('.modal-body').attr('src', iframeUrl);
                                $loader.addClass('hidden');
                            });
                        }
                    }
                });
            });
        }, 10);
    }

    async function getIframeUrl(url) {
        const response = await fetch(url)
        const responseJson = await response.json()

        return responseJson.iframeUrl
    }

    function displayModal() {
        $('.modal-body').attr('src', null);
        $previewModal.modal('show');
        $loader.removeClass('hidden');
    }

    function getTableContainer() {
        let tableContainer;
        if (reportTab) {
            return reportTab.querySelector('div.dataTables_scrollBody')
        }

        if (reportBlock) {
            return reportBlock.querySelector('div.dataTables_scrollBody')
        }

        return document.querySelector('div.dataTables_scrollBody')
    }

    return {
        addListenerToReportsTable: addListenerToReportsTable,
    }
}

module.exports = {
    initialize: initialize,
}
