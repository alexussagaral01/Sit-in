document.addEventListener("DOMContentLoaded", function() {
    const registerForm = document.getElementById("registerForm");
    if (registerForm) {
        registerForm.addEventListener("submit", function (e) {
            e.preventDefault(); 

            let formData = new FormData(this);

            fetch("registration.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: data.status === "success" ? "Success!" : "Error!",
                    text: data.message,
                    icon: data.status,
                    timer: data.status === "success" ? 2000 : null,
                    showConfirmButton: true, 
                    confirmButtonText: "Okay" 
                }).then(() => {
                    if (data.status === "success") {
                        registerForm.reset();
                        document.getElementById("signup").style.display = "none";
                        document.getElementById("signIn").style.display = "block";
                    }
                });
            })
            .catch(error => {
                console.error("Error:", error);  
            });
        });
    }

    const loginForm = document.getElementById("loginForm");
    if (loginForm) {
        loginForm.addEventListener("submit", function (e) {
            e.preventDefault(); 
            let formData = new FormData(this);

            fetch("login.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: data.status === "success" ? "Success!" : "Error!",
                    text: data.message,
                    icon: data.status,
                    showConfirmButton: true, 
                    confirmButtonText: "Okay" 
                }).then((result) => {
                    if (result.isConfirmed && data.status === "success") {
                        window.location.href = "dashboard.php";  
                    }
                });
            })
            .catch(error => {
                console.error("Error:", error);  
            });
        });
    }

    const logoutLink = document.querySelector("a[href='login.php']");
    if (logoutLink) {
        logoutLink.addEventListener("click", function(e) {
            e.preventDefault();
            fetch("logout.php", {
                method: "POST"
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = "login.php";
                } else {
                    console.error("Logout failed");
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        });
    }

    const editForm = document.getElementById("editForm");
    if (editForm) {
        const profileImage = document.querySelector(".profile-image");
        const fileInput = document.getElementById("fileInput");

        profileImage.addEventListener("click", function() {
            fileInput.click();
        });

        fileInput.addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profileImage.src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });

        editForm.addEventListener("submit", function (e) {
            e.preventDefault(); 

            let formData = new FormData(this);

            fetch("edit.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                Swal.fire({
                    title: data.status === "success" ? "Success!" : "Error!",
                    text: data.message,
                    icon: data.status,
                    showConfirmButton: true, 
                    confirmButtonText: "Okay" 
                }).then(() => {
                    if (data.status === "success") {
                        window.location.href = "profile.php";
                    }
                });
            })
            .catch(error => {
                console.error("Error:", error);  
            });
        });
    }
});

