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
                'Content-Type': 'application/json'
            }
        }

        const response = await fetch(url, options);

        result = await response.json();

    } catch (error) {
        result = { success: false, message: error.message };
    }

    return result;
}
