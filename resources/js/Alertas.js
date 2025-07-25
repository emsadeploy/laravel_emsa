

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import Swal from 'sweetalert2'
import toastr from 'toastr'
import 'toastr/build/toastr.min.css';



export default {
  data()
  {
      return {
          
      }
  },
    methods: 
    {
      
    toastAlert(resp)
    {
        let tp_option   = resp.icon
        const position  = {positionClass: "toast-bottom-right"}

        if(tp_option == 'error')
        toastr.error(resp.text, resp.title,position)

        if (tp_option == 'success')
        toastr.success(resp.text, resp.title,position)

        if (tp_option == 'info')
        toastr.info(resp.text, resp.title,position)

        if (tp_option == 'warning')
        toastr.warning(resp.text, resp.title,position)
    },
    modalSweetAlert(resp)
    {
        Swal.fire({
                    title             : resp.title,
                    text              : resp.text,
                    icon              : resp.icon,
                    confirmButtonText : 'Cerrar'
                    })
    }, 

    }
}