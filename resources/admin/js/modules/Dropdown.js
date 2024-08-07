import { isMobile } from "../tools/constants";
export default class Dropdown {
    static className = 'dropdown';
    static classNameOpened = 'dropdown_open';
    btnAttr = 'data-dropdown-show';
    btnAttrStart = 'data-start-text';
    constructor(element) {
        this.element = element;
        this.btn = this.element.querySelector(`[${this.btnAttr}]`);
        this.checkboxes = Array.from(this.element.querySelectorAll('input[type="checkbox"]'));
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
        const checkedLength = this.checkboxes.filter(cbx => cbx.checked).length;
        this.btn.textContent = checkedLength ? ('Выбрано: ' + checkedLength) : this.btn.getAttribute(this.btnAttrStart);
    }
    setListeners() {
        if (isMobile) this.btn.addEventListener('click', this.handleClick.bind(this));
        this.checkboxes.forEach(cbx => cbx.addEventListener('change', this.handleChange.bind(this)));
    }
    start() {
        const dropdwons = document.querySelectorAll(`.${Dropdown.className}`);
        if (dropdwons.length) dropdwons.forEach(element => new Dropdown(element));
        if (isMobile) document.addEventListener('click', (e) => Dropdown.prototype.handleOutput(e.target));
    }
}
