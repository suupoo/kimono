import './bootstrap';
import 'modern-css-reset';
import 'preline';
import '@preline/overlay';
import '@preline/carousel';
import '@preline/remove-element'
import '@preline/toggle-password';
import '@popperjs/core';
import jQuery from 'jquery';
import Quill from 'quill';
import "quill/dist/quill.snow.css";
import { Calendar } from 'fullcalendar';

window.$ = jQuery;
window.Quill = Quill;
window.Calendar = Calendar

import.meta.glob([
    '../images/**',
]);
