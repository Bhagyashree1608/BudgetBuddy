// Toggle Password Visibility for Main Password
const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    // Toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);

    // Toggle the eye icon
    this.classList.toggle("fa-eye-slash");
});

// Toggle Password Visibility for Confirm Password
const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
const confirmPassword = document.querySelector("#confirm_password");

toggleConfirmPassword.addEventListener("click", function () {
    // Toggle the type attribute
    const type = confirmPassword.getAttribute("type") === "password" ? "text" : "password";
    confirmPassword.setAttribute("type", type);

    // Toggle the eye icon
    this.classList.toggle("fa-eye-slash");
});

