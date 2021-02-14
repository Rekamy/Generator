
// import 'jquery';
// import 'popper.js';
// import 'bootstrap';
// import 'bootstrap/dist/css/bootstrap.min.css'

// base component
import Badge from "@/components/base/badge/template.vue";
import Card from "@/components/base/card/template.vue";

import DropzoneFileUpload from "@/components/base/dropzone/DropzoneFileUpload.vue";
import 'dropzone/dist/min/basic.min.css'
import 'dropzone/dist/min/dropzone.min.css'
// import 'dropzone'

import DataTable from '@/core/components/datatable/template.vue';
import Select2 from '@/core/components/select2/template.vue';

// 3rd party components
import CKEditor from '@ckeditor/ckeditor5-vue';
import Editor from '@tinymce/tinymce-vue'
import flatPickr from 'vue-flatpickr-component';
import "flatpickr/dist/flatpickr.css";

// import { Datepicker, Timepicker, DatetimePicker, DateRangePicker } from '@livelybone/vue-datepicker';
// import vue2Dropzone from 'vue2-dropzone'
// import * as Dropzone from 'vue2-dropzone';

// import 'vue2-dropzone/dist/vue2Dropzone.min.css'

// Layout
import MainLayout from "@/components/layouts/main-layout.vue";
import MainHeader from "@/components/layouts/main-header.vue";
import Sidebar from "@/components/layouts/sidebar.vue";
import TopNav from "@/components/layouts/top-nav.vue";
import MainFooter from "@/components/layouts/main-footer.vue";
import LoginLayout from "@/components/layouts/login-layout.vue";
import LoginTopNav from "@/components/layouts/login-top-nav.vue";
import LoginHeader from "@/components/layouts/login-header.vue";
import LoginFooter from "@/components/layouts/login-footer.vue";


export default {
    install(Vue: any) {
        // layouts

        Vue.component(MainFooter.name, MainFooter);
        Vue.component(MainHeader.name, MainHeader);
        Vue.component(TopNav.name, TopNav);
        Vue.component(Sidebar.name, Sidebar);
        Vue.component(MainLayout.name, MainLayout);
        Vue.component(LoginLayout.name, LoginLayout);
        Vue.component(LoginTopNav.name, LoginTopNav);
        Vue.component(LoginHeader.name, LoginHeader);
        Vue.component(LoginFooter.name, LoginFooter);

        //   components
        Vue.component(Badge.name, Badge);
        Vue.component(Card.name, Card);
        Vue.component(DataTable.name, DataTable);
        Vue.component(Select2.name, Select2);
        // Vue.component(DatePicker.name, DatePicker);
        // Vue.component('datepicker', Datepicker);
        // Vue.component('timepicker', Timepicker);
        // Vue.component('datetime-picker', DatetimePicker);
        // Vue.component('date-range-picker', DateRangePicker);

        // 3rd Party Plugins
        Vue.component('editor', Editor);
        Vue.component('flat-pickr', flatPickr);
        Vue.component(DropzoneFileUpload.name, DropzoneFileUpload);
        Vue.use(CKEditor);
        // Vue.use(Datepicker);
        // Vue.use(vue2Dropzone);
        // Vue.use(Dropzone);
        // Vue.use(PerfectScrollbar2)
    }
};

