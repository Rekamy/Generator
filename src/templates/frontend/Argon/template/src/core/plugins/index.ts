// styling
import "@/core/plugins/default/assets/vendor/nucleo/css/nucleo.css";
import "select2/dist/css/select2.css";
import "@fortawesome/fontawesome-free/css/all.css";
import 'perfect-scrollbar/css/perfect-scrollbar.css'
import 'tinymce/skins/content/default/content.css'
import "@/core/plugins/default/assets/scss/argon.scss";
import "toastr/build/toastr.min.css";

// 3rd party
import jquery from 'jquery'
import Swal from "sweetalert2";
import axios from "axios";
import 'bootstrap/dist/js/bootstrap.bundle'
import globalComponents from "@/components/globalComponents";



export default {
  install(Vue: any) {
    Vue.config.globalProperties.jquery = jquery
    Vue.config.globalProperties.Swal = Swal
    Vue.config.globalProperties.http = axios
    Vue.use(globalComponents);
  }
};
