export function startModules() {
    Object.values(arguments).forEach(module => {
        if (typeof module !== 'function') return;
        if (!module.prototype.start) return;
        module.prototype.start();
    })
}
