'use strict';

export default class ModalCreator {
    hasModalBeenShown = false;
    modal;

    init() {
        this.createModalHtml();
        this.modal = document.querySelector('.user-requirement-information-modal');

        this.initializeListeners();
    }

    initializeListeners() {
        this.addListenerToGroupCheckbox();
        this.addEventListenerToCloseIcon();
        this.addListenerToModalBackground();
        this.addEventListenerToCloseIcon();
    }

    addListenerToModalBackground() {
        this.modal.addEventListener('click', (event) => {
            if (event.target === this.modal) {
                this.closeModal();
            }
        })
    }


    addListenerToGroupCheckbox() {
        const groups = document.querySelector('#user_group');
        groups.childNodes.forEach((group) => {
            group.addEventListener('click', () => {
                if (group.innerText === 'BLADEFX-REPORTS-MP' || group.innerText === 'BLADEFX-REPORTS') {
                    if (!this.hasModalBeenShown) {
                        this.showModal();
                        this.hasModalBeenShown = true;
                    }
                }
            })
        });
    }

    showModal() {
       this.modal.style.display = 'block';
    }

    closeModal() {
        this.modal.style.display = 'none';
    }

    addEventListenerToCloseIcon() {
        const icon = this.modal.querySelector('.user-requirement-information-modal-header__close-icon');
        icon.addEventListener('click', () => {
            this.closeModal();
        })
    }

    createModalHtml() {
        const modal = document.createElement('div');
        modal.classList.add('modal', 'user-requirement-information-modal');
        modal.role = 'dialog';

        const modalContent = document.createElement('div');
        modalContent.classList.add('modal-content', 'user-requirement-information-modal__content');

        const modalHeader = document.createElement('div');
        modalHeader.classList.add('modal-header', 'user-requirement-information-modal__header');

        const modalTitle = document.createElement('h5')
        modalTitle.innerText = "To add or remove the user from BladeFx the password and confirm password fields must be filled. No changes will be registered on BladeFx side otherwise";

        const flexHelper = document.createElement('div');
        flexHelper.classList.add('flex-helper');

        const closeIcon = document.createElement('i');
        closeIcon.classList.add('fa', 'fa-times', 'user-requirement-information-modal-header__close-icon');
        closeIcon.dataset.dismiss = 'modal';

        modalHeader.append(modalTitle, flexHelper, closeIcon);
        modalContent.append(modalHeader);
        modal.append(modalContent);
        document.querySelector('#page-wrapper').append(modal)
    }
}

