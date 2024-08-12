import { request } from "../tools/functions";

export default class TableRows {
    static selector = '.table_rows'
    static selectorDelete = '.table__cell_trash'
    constructor() {
        this.table = document.querySelector(TableRows.selector);
    }

    async handleClickDelete({ target }) {
        const element = target.closest(TableRows.selectorDelete);
        if (!element) return;
        const key = 'loadingDelete-' + element.dataset.id;
        const ok = confirm('Вы уверены что хотите удалить запись?');
        if (window[key] || !ok) return;
        const url = element.dataset.template.replace('#id#', element.dataset.id);
        window[key] = true;
        const result = await request('DELETE', url, { _token: document.querySelector('meta[name="csrf-token"]').content });
        delete window[key];
        if (!result.success) return alert('Произошла ошибка при удалении')
        window.location.reload();
    }

    start() {
        window.tableRows = new TableRows();
        document.addEventListener('click', TableRows.prototype.handleClickDelete)
    }
}
