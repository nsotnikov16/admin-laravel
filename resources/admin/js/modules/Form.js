import { request, formDataToJSON } from "../tools/functions";
export default class Form {
    static attribute = 'data-form';
    defaultError = 'Произошла ошибка при отправке формы'
    defaultSuccess = 'Успешно';
    validityClass = 'form__validity';

    constructor(element) {
        this.form = element;
        this.action = this.form.getAttribute('action');
        this.method = this.form.getAttribute('method');
        this.type = this.form.getAttribute(Form.attribute);
        this.button = this.form.querySelector('[type="submit"]');
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
            const json = formDataToJSON(new FormData(this.form));
            result = await request(this.method, this.action, json);
            if (!result.success) throw new Error(result.message || result.error || this.defaultError);
            this.removeValidityClasses();
            alert(result.message ?? this.defaultSuccess);
            if (typeof this.afterSuccess === 'function') this.afterSuccess(result);
        } catch (error) {
            result = { success: false, message: error.message };
            alert(error.message ?? this.defaultError);
        }
        if (typeof this.afterSubmit === 'function') this.afterSubmit(result);
        return result;
    }

    handleInput(field) {
        field.classList.add(this.validityClass);
    }

    removeValidityClasses() {
        this.fields.forEach(f => f.classList.remove(this.validityClass));
    }

    setListeners() {
        if (!this.fields.length) return;
        this.fields.forEach(field => field.addEventListener('input', () => this.handleInput(field)));
        this.form.addEventListener('submit', this.submit.bind(this));
    }

    afterSuccess(result) {
        if (this.type !== 'inserts') this.form.reset();
    }

    start() {
        const forms = document.querySelectorAll(`[${Form.attribute}]`)
        document.addEventListener('DOMContentLoaded', () => {
            if (!forms.length) return;
            forms.forEach(form => new Form(form))
        })
    }

}
