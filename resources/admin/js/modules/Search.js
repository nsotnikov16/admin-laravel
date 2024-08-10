import { request, getFormParameters, updateUrlParams } from "../tools/functions";
export default class Search {
    static attribute = 'data-search';

    constructor(element) {
        this.form = element;
        this.inputSearch = this.form.querySelector('input[name="search"]');
        this.inputsColumn = this.form.querySelectorAll('input[name="column"]');
        this.setListeners();
    }

    async search() {
        updateUrlParams(getFormParameters(this.form));
        const result = await request('GET', window.location.href, {});
        const tableContainer = document.querySelector('.rows__table');
        let table = document.querySelector('.table_rows');
        const templateTable = document.querySelector('#template-table');
        const templateEdit = document.querySelector('#template-cell-edit');
        const templateTrash = document.querySelector('#template-cell-trash');
        if (result.data && result.data.count > 0) {
            if (!table) {
                table = templateTable.content.querySelector('table').cloneNode(true);
                const thead = table.querySelector('thead');

                if (result.data.head.length) {
                    thead.innerHTML = '';
                    const tr = document.createElement('tr');
                    tr.classList.add('table__row');
                    result.data.head.forEach(cell => {
                        const td = document.createElement('td');
                        td.classList.add('table__cell');
                        td.textContent = cell;
                        tr.append(td);
                    })
                    const edit = templateEdit.content.cloneNode(true);
                    edit.innerHTML = '';
                    const trash = templateTrash.content.cloneNode(true)
                    trash.innerHTML = '';
                    tr.append(edit);
                    tr.append(trash);
                    thead.append(tr);
                }
                tableContainer.append(table);
            }
            if (table) {
                const tbody = table.querySelector('tbody');
                tbody.innerHTML = '';
                result.data.data.forEach(item => {
                    const tr = document.createElement('tr');
                    tr.classList.add('table__row');
                    Object.values(item).forEach(cell => {
                        const td = document.createElement('td');
                        td.classList.add('table__cell');
                        td.textContent = cell;
                        tr.append(td);
                    })
                    tr.append(templateEdit.content.cloneNode(true));
                    tr.append(templateTrash.content.cloneNode(true));
                    tbody.append(tr);
                })

            }
        } else {
            if (table) table.remove();
        }
    }

    setListeners() {
        this.inputSearch.addEventListener('input', this.search.bind(this));
        if (this.inputsColumn.length) {
            this.inputsColumn.forEach(item => item.addEventListener('change', (e) => updateUrlParams(getFormParameters(this.form))))
        }
    }

    start() {
        const forms = document.querySelectorAll(`[${Search.attribute}]`)
        document.addEventListener('DOMContentLoaded', () => {
            if (!forms.length) return;
            forms.forEach(form => new Search(form))
        })
    }
}
