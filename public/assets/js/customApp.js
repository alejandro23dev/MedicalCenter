function showToast(icon, title) {

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 5000,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: icon,
        title: title
    });
}

function showToastCenter(icon, title) {

    const Toast = Swal.mixin({
        positionClass: 'toast-center',
        preventDuplicates: true,
        showDuration: 1000,
        hideDuration: 1000,
        timeOut: 5000,
        extendedTimeOut: 1000,
    })

    Toast.fire({
        icon: icon,
        title: title
    });
}