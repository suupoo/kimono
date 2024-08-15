import './bootstrap';
import 'modern-css-reset';
import 'preline';
import '@preline/overlay';
import '@popperjs/core';
import jQuery from 'jquery';
import Quill from 'quill';
import "quill/dist/quill.snow.css";

window.$ = jQuery;
window.Quill = Quill;

import.meta.glob([
    '../images/**',
]);
