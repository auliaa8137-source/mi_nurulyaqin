
document.addEventListener("DOMContentLoaded", function () {

    // MENU NAVIGASI RESPONSIF
    const menuToggle = document.getElementById("menuToggle");
    const menuUtama = document.getElementById("menuUtama");

    if (menuToggle && menuUtama) {

        menuToggle.addEventListener("click", function () {

            menuUtama.classList.toggle("active");

            const sedangTerbuka =
                menuUtama.classList.contains("active");

            menuToggle.setAttribute(
                "aria-expanded",
                sedangTerbuka
            );

            menuToggle.innerHTML = sedangTerbuka ? "✕" : "☰";

        });

    }

    console.log("JavaScript MI Nurul Yaqin berhasil dijalankan!");

});
