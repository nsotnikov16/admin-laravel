export default class Spoiler {
    static className = 'spoiler';
    classNameOpenend = 'spoiler_open';
    constructor(element) {
        this.element = element;
        this.top = this.element.querySelector('.spoiler__top');
        this.name = this.element.querySelector('.spoiler__name');
        this.setListeners();
        this.setDisabledName(!this.isOpen());
        this.element.spoiler = this;
    }

    isOpen() {
        return this.element.classList.contains(this.classNameOpenend);
    }

    open() {
        this.element.classList.add(this.classNameOpenend);
    }

    close() {
        this.element.classList.remove(this.classNameOpenend);
    }

    handleClick({target}) {
        if (this.isOpen() && target === this.name) return;
        this.element.classList.toggle(this.classNameOpenend);
        this.setDisabledName(!this.isOpen());
    }

    handleChange() {

    }

    setDisabledName(boolean) {
        if (boolean) return this.name.setAttribute('readonly', true);
        this.name.removeAttribute('readonly');
    }

    setListeners() {
        this.top.addEventListener('click', this.handleClick.bind(this));
        this.name.addEventListener('change', this.handleChange.bind(this));
    }

    start() {
        const spoilers = document.querySelectorAll(`.${Spoiler.className}`);
        if (!spoilers.length) return;
        spoilers.forEach(item => new Spoiler(item));
    }
}
