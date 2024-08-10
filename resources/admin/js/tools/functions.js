export function startModules() {
    Object.values(arguments).forEach(module => {
        if (typeof module !== 'function') return;
        if (!module.prototype.start) return;
        module.prototype.start();
    })
}

/**
 * Общий метод для работы с запросами
 * @param {string} method
 * @param {string} url
 * @param {object} data
 * @returns {object}
 */
export async function request(method = 'GET', url, data) {
    let result = {};
    try {
        if (!url) throw new Error('Отсутствует url адрес');
        let body;

        if (typeof data === 'object' && !(data instanceof FormData)) {
            body = JSON.stringify(data);
        } else {
            body = data;
        }

        const options = {
            method,
            ...method != 'GET' && data ? { body } : ''
        }

        if (data instanceof FormData === false) {
            options.headers = {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            }
        }

        const response = await fetch(url, options);

        result = await response.json();

    } catch (error) {
        result = { success: false, message: error.message };
    }

    return result;
}

export function formDataToJSON(formData) {
    const obj = {};
    formData.forEach((value, key) => {
        if (obj.hasOwnProperty(key)) {
            if (!Array.isArray(obj[key])) obj[key] = [obj[key]];
            obj[key].push(value);
        } else {
            obj[key] = value;
        }
    });
    return JSON.stringify(obj);
}

// Функция для получения GET параметров из инпутов формы
export function getFormParameters(formOrFormData) {
    const formData = formOrFormData instanceof FormData ? formOrFormData : new FormData(formOrFormData);
    const params = [];
    for (const [key, value] of formData.entries()) {
        params.push({ key, value });
    }
    return params;
}

export function updateUrlParams(params) {
    const currentUrl = new URL(window.location.href);
    const searchParams = currentUrl.searchParams;
    params.forEach(({ key, value }) => {
        searchParams.delete(key);
        searchParams.set(key, value);
        if (!value) searchParams.delete(key);
    })
    window.history.replaceState({}, '', currentUrl.toString());
}
