import Dropdown from "./modules/Dropdown";
import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
if (typeof Dropdown === 'function') Dropdown.prototype.start();
const editor = new EditorJS({
    holder: 'editor',
    tools: {
        header: Header,
        list: List
    },
});

