// EditorJS
import Dropdown from "./modules/Dropdown";
import Popup from "./modules/Popup";

if (typeof Dropdown === 'function') Dropdown.prototype.start();
if (typeof Popup === 'function') Popup.prototype.start();
