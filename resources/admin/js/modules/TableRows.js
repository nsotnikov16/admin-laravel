export default class TableRows {
    constructor() {
        this.table = document.querySelector('.table_rows');
        this.tableContainer = document.querySelector('.rows__table');
        this.templateTable = document.querySelector('#template-table');
        this.templateEdit = document.querySelector('#template-cell-edit');
        this.templateTrash = document.querySelector('#template-cell-trash');
        this.resultElement = document.querySelector('[data-result-rows]')
    }

    create(headCells, bodyRows, total) {
        this.updateResult(bodyRows, total);
        if (!bodyRows.length) return this.remove();
        if (!this.table) {
            this.table = this.templateTable.content.querySelector('table').cloneNode(true);
            this.tableContainer.append(this.table);
        }
        this.createHead(headCells);
        this.createBody(bodyRows);

    }

    createHead(cells) {
        if (!cells.length) return;
        const thead = this.table.querySelector('thead');
        thead.innerHTML = '';
        const tr = document.createElement('tr');
        tr.classList.add('table__row');
        cells.forEach(cell => {
            const td = document.createElement('td');
            td.classList.add('table__cell');
            td.textContent = cell;
            tr.append(td);
        })
        const edit = this.templateEdit.content.querySelector('td').cloneNode(true);
        edit.innerHTML = '';
        const trash = this.templateTrash.content.querySelector('td').cloneNode(true)
        trash.innerHTML = '';
        tr.append(edit);
        tr.append(trash);
        thead.append(tr);
    }

    createBody(rows) {
        const tbody = this.table.querySelector('tbody');
        tbody.innerHTML = '';
        rows.forEach(row => {
            const tr = document.createElement('tr');
            tr.classList.add('table__row');
            Object.values(row).forEach(cell => {
                const td = document.createElement('td');
                td.classList.add('table__cell');
                td.textContent = cell;
                tr.append(td);
            })
            tr.append(this.templateEdit.content.cloneNode(true));
            tr.append(this.templateTrash.content.cloneNode(true));
            tbody.append(tr);
        })
    }

    remove() {
        if (this.table) this.table.remove();
    }

    updateResult(bodyRows, total) {
        if (!bodyRows.length) return this.resultElement.textContent = 'Ничего не найдено';
        this.resultElement.textContent = `Найдено ${bodyRows.length} из ${total}`;
    }
}
