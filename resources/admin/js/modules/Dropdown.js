import { isMobile } from "../tools/constants";
class Dropdown {
    static className = 'dropdown';
    static classNameOpen = 'dropdown_open';
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
        const dropdownsOpen = document.querySelectorAll(`.${Dropdown.classNameOpen}`);
        if (!dropdownsOpen.length) return;
        dropdownsOpen.forEach(element => element.classList.remove(Dropdown.classNameOpen));
    }
    handleClick() {
        if (!this.btn.getAttribute(this.btnAttrStart)) this.btn.setAttribute(this.btnAttrStart, target.textContent);
        this.element.classList.toggle(Dropdown.classNameOpen);
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

export default Dropdown;
