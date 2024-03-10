function toast(message, status = 'success', duration = 3000){
    Toastify({
        text: message,
        duration,
        destination: "https://github.com/apvarun/toastify-js",
        newWindow: true,
        stopOnFocus: true, // Prevents dismissing of toast on hover
        style: {
            background: status === 'success' ? "#3b5d50" : "#721c24",
            color: '#fff'
        },

    }).showToast();
}
