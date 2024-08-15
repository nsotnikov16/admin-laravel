import { request, formDataToJSON, updateUrlParams, getFormParameters } from "../tools/functions";
export default class Form {
    static attribute = 'data-form';
    defaultError = 'Произошла ошибка при отправке формы'
    defaultSuccess = 'Успешно';
    validityClass = 'form__validity';

    constructor(element) {
        this.form = element;
        this.action = this.form.getAttribute('action');
        if (!this.action) this.action = window.location.pathname;
        this.method = this.form.getAttribute('method');
        this.type = this.form.getAttribute(Form.attribute);
        this.button = this.form.querySelector('[type="submit"]');
        this.resetButton = this.form.querySelector('[data-reset-btn]');
        this.fields = Array.from(this.form.querySelectorAll('input:not([type="hidden"]), textarea'));
        this.form.object = this;
        this.setListeners();
    }

    isValid() {
        return this.form.checkValidity();
    }

    async submit(e) {
        e.preventDefault();
        let result = {};
        try {
            if (!this.isValid()) return;
            if (typeof this.beforeSubmit === 'function') this.beforeSubmit();

            if (this.getMethod() !== 'GET') {
                const json = formDataToJSON(new FormData(this.form));
                result = await request(this.method, this.action, json);
                if (!result.success) throw new Error(result.message || result.error || this.defaultError);
                if (!(this.isFilter() || this.isSort)) alert(result.message ?? this.defaultSuccess);
                if (result.redirect) return window.location.href = result.redirect;
            } else {
                updateUrlParams(getFormParameters(this.form));
            }

            this.removeValidityClasses();
            window.location.reload();
            //if (typeof this.afterSuccess === 'function') this.afterSuccess(result);
        } catch (error) {
            result = { success: false, message: error.message };
            alert(error.message ?? this.defaultError);
        }


        //if (typeof this.afterSubmit === 'function') this.afterSubmit(result);
        return result;
    }

    handleInput(field) {
        field.classList.add(this.validityClass);
        if (this.isFilter() || this.isSort()) updateUrlParams(getFormParameters(this.form))
    }

    removeValidityClasses() {
        this.fields.forEach(f => f.classList.remove(this.validityClass));
    }

    handleReset() {
        this.removeValidityClasses();
        this.form.reset();
    }

    setListeners() {
        if (!this.fields.length) return;
        this.fields.forEach(field => field.addEventListener('input', () => this.handleInput(field)));
        this.form.addEventListener('submit', this.submit.bind(this));
        if (this.resetButton) this.resetButton.addEventListener('click', this.handleReset.bind(this))
    }

    start() {
        const forms = document.querySelectorAll(`[${Form.attribute}]`)
        document.addEventListener('DOMContentLoaded', () => {
            if (!forms.length) return;
            forms.forEach(form => new Form(form))
        })
    }

    getMethod() {
        if (!this.method) this.method = 'GET';
        return this.method.toUpperCase();
    }

    isFilter() {
        return this.type === 'filter';
    }

    isSort() {
        return this.type === 'sort';
    }
}
