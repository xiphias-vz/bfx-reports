function createModal($modal) {
    if ($modal && typeof $modal.modal === 'function') {
        return {
            show: () => $modal.modal('show'),
            hide: () => $modal.modal('hide'),
        };
    }

    let BsModal = typeof window.Modal === 'function' ? window.Modal : null;

    if (BsModal) {
        const instance = new BsModal($modal[0]);
        return {
            show: () => instance.show(),
            hide: () => instance.hide(),
        };
    } else {
        let ready = loadBootstrap5().then(() => {
            const BS = window.bootstrap || window;
            BsModal = BS.Modal;
            if (!BsModal) throw new Error('Bootstrap 5 failed to provide Modal class');
            return new BsModal($modal[0]);
        });

        return {
            show: () => ready.then(instance => instance.show()),
            hide: () => ready.then(instance => instance.hide()),
        };
    }
}

function loadBootstrap5() {
    return new Promise((resolve, reject) => {
        if (document.querySelector('#__dynamic_bs5')) {
            resolve();
            return;
        }

        const script = document.createElement('script');
        script.id = '__dynamic_bs5';
        script.src = 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js';
        script.onload = () => resolve();
        script.onerror = () => reject(new Error('Failed to load Bootstrap 5'));
        document.head.appendChild(script);
    });
}

module.exports = { createModal };
