import './bootstrap';

import App from './App.vue'
import router from './router'

import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import Moment from 'moment'
import Swal from 'sweetalert2'
import { Form } from 'vform'

import {
  HasError,
  AlertError,
  AlertErrors,
  AlertSuccess
} from 'vform/src/components/bootstrap5'


import { createApp } from 'vue';

let Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000,
  timerProgressBar: true,
  onOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})

window.Swal = Swal;
window.Toast = Toast;
window.Form = Form;

const app = createApp(App);

app.config.globalProperties.$filters = {
  	dateFormat(value) {
  		return Moment(value).format('MMM D, YYYY');
  	},
  	subString(string) {
	    return `${string.split(/\s+/).slice(0,5).join(" ")}...`;
	}
}

app.use(router)
app.mount("#app")
