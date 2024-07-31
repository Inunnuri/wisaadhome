import "./bootstrap";
import "flowbite";

window.addEventListener("scroll", function () {
    var navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        // Adjust this value as needed
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});

// Function to check login status
function checkLoginStatus() {
    // Simulate a login check. Replace with actual login check logic.
    return localStorage.getItem("loggedIn") === "true";
}

// Function to update navbar buttons
function updateNavbar() {
    const loggedIn = checkLoginStatus();
    const loginBtn = document.getElementById("login-btn");
    const logoutBtn = document.getElementById("logout-btn");

    if (loggedIn) {
        loginBtn.classList.add("hidden");
        logoutBtn.classList.remove("hidden");
    } else {
        loginBtn.classList.remove("hidden");
        logoutBtn.classList.add("hidden");
    }
}

// Event listener for scroll to change navbar background
window.addEventListener("scroll", function () {
    const navbar = document.querySelector(".navbar");
    if (window.scrollY > 50) {
        navbar.classList.add("scrolled");
    } else {
        navbar.classList.remove("scrolled");
    }
});

//edit dan hapus product
document.addEventListener("DOMContentLoaded", function () {
    const editProductBtns = document.querySelectorAll(".editProductBtn");
    const productCancelBtns = document.querySelectorAll(".productCancelBtn");
    const modals = document.querySelectorAll(".editProductForm");
    const deleteBtns = document.querySelectorAll(".deleteBtn");

    if (editProductBtns && productCancelBtns && modals) {
        editProductBtns.forEach(function (btn, index) {
            btn.addEventListener("click", function () {
                const productId = btn.getAttribute("data-product-id");
                const modal = document.querySelector(
                    `.editProductForm[data-product-id="${productId}"]`
                );
                if (modal) {
                    modal.classList.toggle("hidden");
                    if (!modal.classList.contains("hidden")) {
                        modal.classList.add("flex");
                    } else {
                        modal.classList.remove("flex");
                    }
                }
            });
        });

        productCancelBtns.forEach(function (btn) {
            btn.addEventListener("click", function () {
                const productId = btn.getAttribute("data-product-id");
                const modal = document.querySelector(
                    `.editProductForm[data-product-id="${productId}"]`
                );
                if (modal) {
                    modal.classList.add("hidden");
                }
            });
        });

        // Close the modal when the user clicks anywhere outside of the modal
        window.addEventListener("click", function (event) {
            modals.forEach(function (modal) {
                if (event.target === modal) {
                    modal.classList.add("hidden");
                }
            });
        });
    } else {
        console.error("Some elements are missing in the DOM");
    }

    if (deleteBtns) {
        deleteBtns.forEach(function (btn) {
            btn.addEventListener("click", function () {
                const productId = btn.getAttribute("data-product-id");
                if (productId) {
                    // Tampilkan konfirmasi kepada pengguna
                    if (
                        confirm("Apakah Anda yakin ingin menghapus produk ini?")
                    ) {
                        // Cari elemen .post yang sesuai dengan productId
                        const postToDelete = document.querySelector(
                            `.post[data-product-id="${productId}"]`
                        );

                        if (postToDelete) {
                            // Hapus elemen dari DOM
                            postToDelete.remove();
                            // Lakukan juga permintaan DELETE ke server di sini
                            deleteProduct(productId);
                        } else {
                            alert("Gagal menghapus produk");
                        }
                    }
                }
            });
        });
    }

    function deleteProduct(productId) {
        console.log("Deleting product with ID:", productId);
        fetch(`/product/delete/${productId}`, {
            method: "DELETE",
            headers: {
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
        })
            .then((response) => response.json())
            .then((data) => {
                console.log("Response data:", data);
                if (!data.success) {
                    alert("Gagal menghapus produk dari server");
                } else {
                    alert("Produk berhasil dihapus");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("Terjadi kesalahan saat menghapus produk.");
            });
    }
});
