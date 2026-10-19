document.addEventListener("DOMContentLoaded", function() {
    console.log("Sistem Inventaris PHP Native siap digunakan!");

    const alertBox = document.querySelector('.alert');
    if (alertBox) {
        setTimeout(function() {
            alertBox.style.transition = "opacity 0.5s ease";
            alertBox.style.opacity = 0;
            setTimeout(() => alertBox.remove(), 500);
        }, 4000);
    }
});