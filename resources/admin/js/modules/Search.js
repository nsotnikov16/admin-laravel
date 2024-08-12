import { request, getFormParameters, updateUrlParams } from "../tools/functions";
import TableRows from "./TableRows";
export default class Search {
    static attribute = 'data-search';
    callback = () => { };
    timeout = null;

    constructor(element) {
        this.form = element;
        this.inputSearch = this.form.querySelector('input[name="search"]');
        this.inputsColumn = this.form.querySelectorAll('input[name="column"]');
        this.setListeners();
        this.logicListPage();
    }

    async search() {
        updateUrlParams(getFormParameters(this.form));
        clearTimeout(this.timeout);
        this.timeout = setTimeout(async () => {
            const result = await request('GET', window.location.href, {});
            if (typeof this.callback === 'function') this.callback(result);
        }, 500);
    }

    onChange() {
        updateUrlParams(getFormParameters(this.form));
    }

    setListeners() {
        this.inputSearch.addEventListener('input', this.search.bind(this));
        if (this.inputsColumn.length) {
            this.inputsColumn.forEach(item => item.addEventListener('change', this.onChange.bind(this)))
        }
    }

    start() {
        const forms = document.querySelectorAll(`[${Search.attribute}]`)
        document.addEventListener('DOMContentLoaded', () => {
            if (!forms.length) return;
            forms.forEach(form => new Search(form))
        })
    }

    logicListPage() {
        const getRowsBottom = () => document.querySelector('.rows__bottom');
        if (!getRowsBottom()) return;
        this.callback = (result) => getRowsBottom().innerHTML = result.data.html
    }
}
