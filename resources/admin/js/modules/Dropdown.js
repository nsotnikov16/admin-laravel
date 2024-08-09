import { isMobile } from "../tools/constants";
export default class Dropdown {
    static className = 'dropdown';
    static classNameOpened = 'dropdown_open';
    btnAttr = 'data-dropdown-show';
    btnAttrStart = 'data-start-text';
    constructor(element) {
        this.element = element;
        this.btn = this.element.querySelector(`[${this.btnAttr}]`);
        this.choices = Array.from(this.element.querySelectorAll('input[type="checkbox"], input[type="radio"]'));
        this.handleChange();
        this.setListeners();
    }
    handleOutput(target) {
        if (target.closest(`.${Dropdown.className}`)) return;
        const dropdownsOpen = document.querySelectorAll(`.${Dropdown.classNameOpened}`);
        if (!dropdownsOpen.length) return;
        dropdownsOpen.forEach(element => element.classList.remove(Dropdown.classNameOpened));
    }
    handleClick() {
        if (!this.btn.getAttribute(this.btnAttrStart)) this.btn.setAttribute(this.btnAttrStart, target.textContent);
        this.element.classList.toggle(Dropdown.classNameOpened);
    }
    handleChange() {
        const checkedArr = this.choices.filter(item => item.checked);
        const isRadio = this.choices.every(item => item.type === 'radio');
        const textChecked = (isRadio ? checkedArr?.[0]?.labels?.[0].textContent : ('Выбрано: ' + checkedArr.length));
        this.btn.textContent = checkedArr.length ? textChecked : this.btn.getAttribute(this.btnAttrStart);
    }
    setListeners() {
        if (isMobile) this.btn.addEventListener('click', this.handleClick.bind(this));
        this.choices.forEach(item => item.addEventListener('change', this.handleChange.bind(this)));
    }
    start() {
        const dropdwons = document.querySelectorAll(`.${Dropdown.className}`);
        if (dropdwons.length) dropdwons.forEach(element => new Dropdown(element));
        if (isMobile) document.addEventListener('click', (e) => Dropdown.prototype.handleOutput(e.target));
    }
}
