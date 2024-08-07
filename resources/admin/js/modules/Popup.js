
class Popup {
    static className = 'popup';
    classNameOpened = 'popup_opened';
    classNameCloseBtn = 'popup__close'
    constructor(popupElement) {
        this.popupElement = popupElement;
        this.closeButton = this.popupElement.querySelector(`.${this.classNameCloseBtn}`);
        this._handleEscClose = this._handleEscClose.bind(this)
        this.openingLinks = document.querySelectorAll(`[data-pointer="${this.popupElement.id}"]`)
        this.setEventListeners()
    }

    open(callback) {
        document.body.style.overflow = "hidden";
        this.popupElement.classList.add(this.classNameOpened)
        document.addEventListener('keydown', this._handleEscClose);
        if (typeof callback === 'function') callback();
    }

    close(callback) {
        this.popupElement.classList.remove(this.classNameOpened);
        document.body.style.overflow = "visible";
        document.removeEventListener('keydown', this._handleEscClose);
        if (typeof callback === 'function') callback();
    }

    _handleEscClose(evt) {
        if (evt.keyCode === 27) this.close();
    }

    _handleOverlayClick(evt) {
        if (evt.target === evt.currentTarget) this.close();
    }

    setEventListeners() {
        this.openingLinks.forEach(link => link.addEventListener('click', (e) => {
            e.preventDefault();
            this.open(e.currentTarget)
        }))
        this.closeButton.addEventListener('click', () => this.close());
        this.popupElement.addEventListener('click', this._handleOverlayClick.bind(this));
    }

    start() {
        const popups = document.querySelectorAll(`.${Popup.className}`)
        window.popups = {};
        document.addEventListener('DOMContentLoaded', () => {
            if (!popups.length) return;
            popups.forEach(item => window.popups[item.id] = new Popup(item))
        })
    }
}

export default Popup;
