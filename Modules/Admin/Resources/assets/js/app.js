window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
//window.Sortable = require('sortablejs');
import Sortable from 'sortablejs/modular/sortable.complete.esm.js';
window.Sortable=Sortable;

require('bootstrap');
require("./jquery-ui.min");
require("jquery-ui-touch-punch");
require('jquery.scrollbar');
require("./datatables.min"); 
require('sweetalert');
require('bootstrap-notify');
require('select2');

require('./main');
require('./wysiwyg');

import Admin from './admin';
window.admin = new Admin();

import Form from './form';
window.form = new Form();

import DataTable from './datatable';
window.DataTable = DataTable;

import { notify, info, success, warning, error } from './notify';
window.notify = notify;
window.info = info;
window.success = success;
window.warning = warning;
window.error = error;


$.ajaxSetup({
    headers: {
        'Authorization': CI.apiToken,
        'X-CSRF-TOKEN': CI.csrfToken,
    },
});