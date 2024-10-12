import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import jQuery from 'jquery';
window.$ = jQuery;

import Swal from 'sweetalert2';
window.Swal = Swal;

import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css"; // Import CSS jika diperlukan