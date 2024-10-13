import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jQuery from 'jquery';
window.$ = jQuery;

import Swal from 'sweetalert2';
window.Swal = Swal;

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";

import '@fortawesome/fontawesome-free/css/all.min.css';
import '@fortawesome/fontawesome-free/js/all.js';