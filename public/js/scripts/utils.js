const messageFlash = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 1500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});


window.addEventListener('mensaje', event => {
    messageFlash.fire({
        icon: event.detail.icono,
        title: event.detail.mensaje
    });
})