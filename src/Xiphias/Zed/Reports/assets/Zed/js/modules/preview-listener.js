'use strict';

import { createModal } from './preview-modal-wrapper';


export default class PreviewListener {
    constructor() {
        this.reportTab = document.querySelector('#tab-content-report');
        this.reportBlock = document.querySelector('#reports');
        this.$previewModal = $('.preview-modal');
        this.$loader = $('.loader');
    }

    initialize() {
        this.addListenerToReportsTable();
        this.addListenerToModalCloseButton();
    }

    addListenerToModalCloseButton() {
        this.$previewModal[0].querySelector('.modal-close').addEventListener('click', (e) => {
            this.bootstrapModalObject.hide();
        })
    }

    addListenerToReportsTable() {
        const interval = setInterval(() => {
            const instance = this
            let tableContainer = this.getTableContainer();
            if (tableContainer) {
                if (!$.fn.DataTable.isDataTable(tableContainer)) {
                    return
                }

                this.bootstrapModalObject = createModal(this.$previewModal)
                var $reportsTable = $(tableContainer).DataTable();
                $reportsTable.on('draw', function() {
                    let tableRows = tableContainer.querySelectorAll('tr')
                    tableRows.forEach((row) => {
                        let button = row.querySelector('a.btn-edit');
                        if (!button) {
                            button = row.querySelector('a.btn-preview');
                        }

                        if (button !== null) {
                            button.addEventListener('click', async (e) => {
                                e.preventDefault();
                                await instance.handleReportPreview(button);
                            });

                            row.addEventListener('dblclick', async () => {
                                await instance.handleReportPreview(button);
                            });
                        }
                    });

                    instance.goToFirstPageIfCurrentPageEmpty(tableContainer, $reportsTable)
                });
                clearInterval(interval)
            }
        }, 100)
    }

    async getIframeUrl(url) {
        const response = await fetch(url)
        const responseJson = await response.json()

        return responseJson.iframeUrl
    }

    async handleReportPreview(button) {
        this.displayModal();
        const iframeUrl = await this.getIframeUrl(button.href)
        this.$loader.addClass('hidden');
        $('.modal-body').attr('src', iframeUrl);

        if (!iframeUrl) {
            this.bootstrapModalObject.hide();
        }
    }

    displayModal() {
        $('.modal-body').attr('src', null);
        this.bootstrapModalObject.show();
        this.$loader.removeClass('hidden');
    }

    getTableContainer() {
        if (this.reportTab) {
            return this.reportTab.querySelector('.bfx-reports-table[id]')
        }

        if (this.reportBlock) {
            return this.reportBlock.querySelector('.bfx-reports-table[id]')
        }

        return document.querySelector('.bfx-reports-table[id]')
    }

    goToFirstPageIfCurrentPageEmpty(tableContainer, $reportsTable) {
        if (tableContainer.querySelector('.dt-empty') || tableContainer.querySelector('.dataTables_empty')) {
            $reportsTable.page('first').draw('false');
        }
    }
}
