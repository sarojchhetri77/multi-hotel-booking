$(document).ready(function() {
    let Toast;
    Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 10000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
        customClass: {
            // popup: 'bg-success',
            // title: 'text-white',
            // icon: 'text-white',
          }
    });

    window.showSuccessToast = function(data){
        Toast.fire({
            icon:'success',
            title:data
        });
    }
    window.showErrorToast = function(data){
        Toast.fire({
            icon:'error',
            title:data
        });
    }

    window.showWarningToast = function(data){
        Toast.fire({
            icon:'warning',
            title:data
        });
    }
});
