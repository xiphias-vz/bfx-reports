'use strict';

export default class ParameterFormModal {
    reportIframe = null;

    async init() {
        this.paramFormModal = document.getElementById('parameter-form-modal')
        this.reportIframe = this.paramFormModal.querySelector('.parameter-form-iframe')

        await this.loadIframe()

        this.paramFormModal.addEventListener('click', () => {
            window.location.hash = '#';
        })
    }

    async loadIframe() {
        if (!this.canLoadIframe()) {
            return
        }

        const iframeUrl = await this.getIframeUrl();
        this.reportIframe.setAttribute('src', iframeUrl)
    }

    canLoadIframe() {
        const repId = this.getUrlParams('repId');

        return repId && this.isLocationHashValid();
    }

    isLocationHashValid() {
        return location.hash !== '#';
    }

    getUrlParams(paramName = null) {
        const searchParams = new URLSearchParams(location.search);

        if (paramName) {
            return searchParams.get(paramName);
        }

        return searchParams
    }

    async getIframeUrl() {
        const url = '/reports/index/report-iframe?' + this.getUrlParams()
        const response = await fetch(url)
        const responseJson = await response.json()

        return responseJson.iframeUrl;
    }
}
