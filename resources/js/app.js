document.addEventListener("DOMContentLoaded", function () {
    // Sidebar Toggle untuk mobile
    const sidebarToggle = document.createElement("div");
    sidebarToggle.className = "sidebar-toggle";
    sidebarToggle.innerHTML = "☰";
    document.body.prepend(sidebarToggle);

    // Toggle sidebar di mobile
    sidebarToggle.addEventListener("click", function () {
        document.querySelector(".sidebar").classList.toggle("active");
        document
            .querySelector(".main-content")
            .classList.toggle("sidebar-active");
    });

    // Auto-close sidebar ketika memilih menu di mobile
    document.querySelectorAll(".sidebar-menu a").forEach((link) => {
        link.addEventListener("click", function () {
            if (window.innerWidth < 768) {
                document.querySelector(".sidebar").classList.remove("active");
                document
                    .querySelector(".main-content")
                    .classList.remove("sidebar-active");
            }
        });
    });

    // Active state untuk dropdown filter (jika ada)
    document.querySelectorAll(".filter-toggle").forEach((button) => {
        button.addEventListener("click", function () {
            this.nextElementSibling.classList.toggle("show");
        });
    });

    // Close dropdown ketika klik di luar
    window.addEventListener("click", function (e) {
        if (!e.target.matches(".filter-toggle")) {
            document
                .querySelectorAll(".filter-dropdown")
                .forEach((dropdown) => {
                    dropdown.classList.remove("show");
                });
        }
    });

    // Responsive behavior
    function handleResponsive() {
        const sidebar = document.querySelector(".sidebar");
        const mainContent = document.querySelector(".main-content");

        if (window.innerWidth < 768) {
            sidebar.classList.remove("active");
            mainContent.classList.remove("sidebar-active");
        } else {
            sidebar.classList.add("active");
            mainContent.classList.add("sidebar-active");
        }
    }

    // Jalankan saat load dan resize
    window.addEventListener("load", handleResponsive);
    window.addEventListener("resize", handleResponsive);
});

document.querySelectorAll(".delete-form").forEach((form) => {
    form.addEventListener("submit", function (e) {
        if (!confirm("Anda yakin ingin menghapus?")) {
            e.preventDefault();
        }
    });
});

document.querySelectorAll('input[name="population"]').forEach((input) => {
    input.addEventListener("blur", function () {
        if (this.value) {
            this.value = parseInt(this.value.replace(/\D/g, ""));
        }
    });
});
