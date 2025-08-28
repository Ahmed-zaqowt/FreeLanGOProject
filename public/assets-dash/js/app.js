document.addEventListener("DOMContentLoaded", function () {
    const resetForm = document.getElementById("resetForm");
    const resetBtn = document.getElementById("resetBtn");
    const successMessage = document.getElementById("successMessage");

    resetForm.addEventListener("submit", function (e) {
        const email = document.getElementById("email").value;

        // Basic email validation
        if (!isValidEmail(email)) {
            alert("الرجاء إدخال بريد إلكتروني صحيح");
            return;
        }

        // Show loading state
        resetBtn.classList.add("btn-reset-loading");
        resetBtn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            // Hide loading state
            resetBtn.classList.remove("btn-reset-loading");

            // Show success state
            resetBtn.classList.add("btn-reset-success");

            // Show success message
            successMessage.style.display = "block";

            // Reset form
            resetForm.reset();

            // Reset button after 3 seconds
            setTimeout(() => {
                resetBtn.classList.remove("btn-reset-success");
                resetBtn.disabled = false;
            }, 3000);
        }, 2000);
    });

    // Email validation
    function isValidEmail(email) {
        const re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const resetForm = document.getElementById("resetForm");
    const resetBtn = document.getElementById("resetBtn");
    const successMessage = document.getElementById("successMessage");

    resetForm.addEventListener("submit", function (e) {
        const email = document.getElementById("email").value;

        // Basic email validation
        if (!isValidEmail(email)) {
            alert("الرجاء إدخال بريد إلكتروني صحيح");
            return;
        }

        // Show loading state
        resetBtn.classList.add("btn-reset-loading");
        resetBtn.disabled = true;

        // Simulate API call
        setTimeout(() => {
            // Hide loading state
            resetBtn.classList.remove("btn-reset-loading");

            // Show success state
            resetBtn.classList.add("btn-reset-success");

            // Show success message
            successMessage.style.display = "block";

            // Reset form
            resetForm.reset();

            // Reset button after 3 seconds
            setTimeout(() => {
                resetBtn.classList.remove("btn-reset-success");
                resetBtn.disabled = false;
            }, 3000);
        }, 2000);
    });

    // Email validation
    function isValidEmail(email) {
        const re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("search");
    const categorySelect = document.getElementById("category");
    const budgetMin = document.getElementById("budgetMin");
    const budgetMax = document.getElementById("budgetMax");
    const durationSelect = document.getElementById("duration");
    const filterBtn = document.querySelector(".btn-filter");
    const resetBtn = document.querySelector(".reset-btn");
    const projectsList = document.getElementById("projectsList");
    const sortSelect = document.getElementById("sort");




   

    // Filter projects
    const filterProjects = () => {
        const keyword = searchInput.value.toLowerCase();
        const category = categorySelect.value;
        const min = parseInt(budgetMin.value) || 0;
        const max = parseInt(budgetMax.value) || Infinity;
        const duration = durationSelect.value;

        const filtered = projects.filter((proj) => {
            const matchesKeyword =
                proj.title.toLowerCase().includes(keyword) ||
                proj.desc.toLowerCase().includes(keyword);
            const matchesCategory =
                category === "الكل" || proj.category === category;
            const matchesBudget =
                proj.budgetMin >= min && proj.budgetMax <= max;
            const matchesDuration =
                duration === "الكل" ||
                (duration === "أقل من 3 أيام" && proj.duration < 3) ||
                (duration === "3 - 7 أيام" &&
                    proj.duration >= 3 &&
                    proj.duration <= 7) ||
                (duration === "أسبوع - أسبوعين" &&
                    proj.duration > 7 &&
                    proj.duration <= 14) ||
                (duration === "أكثر من أسبوعين" && proj.duration > 14);

            return (
                matchesKeyword &&
                matchesCategory &&
                matchesBudget &&
                matchesDuration
            );
        });

        renderProjects(filtered);
    };

    // Reset filters
    const resetFilters = () => {
        searchInput.value = "";
        categorySelect.value = "الكل";
        budgetMin.value = "";
        budgetMax.value = "";
        durationSelect.value = "الكل";
        renderProjects();
    };

    // Event listeners
    searchInput.addEventListener("input", filterProjects);
    filterBtn.addEventListener("click", filterProjects);
    resetBtn.addEventListener("click", resetFilters);
    sortSelect.addEventListener("change", filterProjects);

    // Initialize
    renderProjects();

    // Add hover effect to project cards
    document.querySelectorAll(".project-card").forEach((card) => {
        card.addEventListener("mouseenter", () => {
            card.style.transform = "translateY(-5px)";
        });
        card.addEventListener("mouseleave", () => {
            card.style.transform = "translateY(0)";
        });
    });
});

document.addEventListener("DOMContentLoaded", function () {
    // Form steps management
    const steps = document.querySelectorAll(".form-step");
    const progressSteps = document.querySelectorAll(".progress-step");
    const progressBar = document.getElementById("progressBar");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");
    const submitBtn = document.getElementById("submitBtn");
    let currentStep = 0;

    // Update form steps and progress bar
    function updateStep(n) {
        // Hide all steps
        steps.forEach((step) => {
            step.classList.remove("active");
        });

        // Show current step
        steps[n].classList.add("active");

        // Update progress steps
        progressSteps.forEach((step, index) => {
            if (index <= n) {
                step.classList.add("active");
                if (index < n) {
                    step.classList.add("completed");
                } else {
                    step.classList.remove("completed");
                }
            } else {
                step.classList.remove("active", "completed");
            }
        });

        // Update progress bar width
        const progressPercentage = (n / (steps.length - 1)) * 100;
        progressBar.style.width = progressPercentage + "%";

        // Update navigation buttons
        prevBtn.disabled = n === 0;
        nextBtn.style.display = n === steps.length - 1 ? "none" : "flex";
        submitBtn.style.display = n === steps.length - 1 ? "block" : "none";

        currentStep = n;
    }

    // Next button click
    nextBtn.addEventListener("click", function () {
        if (validateStep(currentStep)) {
            if (currentStep < steps.length - 1) {
                updateStep(currentStep + 1);
            }
        }
    });

    // Previous button click
    prevBtn.addEventListener("click", function () {
        if (currentStep > 0) {
            updateStep(currentStep - 1);
        }
    });

    // Validate current step before proceeding
    function validateStep(stepIndex) {
        let isValid = true;

        if (stepIndex === 1) {
            // Step 2 validation
            const fullname = document.getElementById("fullname").value;
            const email = document.getElementById("email").value;
            const password = document.getElementById("password").value;
            const confirmPassword =
                document.getElementById("confirmPassword").value;

            if (!fullname) {
                alert("الرجاء إدخال الاسم الكامل");
                isValid = false;
            } else if (!email || !isValidEmail(email)) {
                alert("الرجاء إدخال بريد إلكتروني صحيح");
                isValid = false;
            } else if (!password || password.length < 6) {
                alert("كلمة المرور يجب أن تحتوي على 6 أحرف على الأقل");
                isValid = false;
            } else if (password !== confirmPassword) {
                alert("كلمتا المرور غير متطابقتين");
                isValid = false;
            }
        } else if (stepIndex === 2) {
            // Step 3 validation
            const checkboxes = document.querySelectorAll(
                '#step3 input[type="checkbox"]'
            );
            let checkedCount = 0;

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) checkedCount++;
            });

        }

        return isValid;
    }

    // Email validation
    function isValidEmail(email) {
        const re =
            /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    // File upload handling
    const idUploadArea = document.getElementById("idUploadArea");
    const idUpload = document.getElementById("idUpload");
    const idPreview = document.getElementById("idPreview");
    const selfieUploadArea = document.getElementById("selfieUploadArea");
    const selfieUpload = document.getElementById("selfieUpload");
    const selfiePreview = document.getElementById("selfiePreview");
    const checkmark = document.querySelector(".checkmark");

    // Handle ID upload
    idUploadArea.addEventListener("click", () => idUpload.click());
    idUpload.addEventListener("change", function (e) {
        if (e.target.files.length) {
            const file = e.target.files[0];

            if (file.size > 5 * 1024 * 1024) {
                alert("حجم الملف يجب أن يكون أقل من 5MB");
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                idPreview.innerHTML = `
                            <p>${file.name}</p>
                            <img src="${event.target.result}" alt="صورة الهوية">
                            <button class="btn-remove" id="removeId">إزالة</button>
                        `;
                idPreview.style.display = "block";

                document
                    .getElementById("removeId")
                    .addEventListener("click", function () {
                        idPreview.style.display = "none";
                        idUpload.value = "";
                    });
            };

            reader.readAsDataURL(file);
        }
    });

    // Handle selfie upload
    selfieUploadArea.addEventListener("click", () => selfieUpload.click());
    selfieUpload.addEventListener("change", function (e) {
        if (e.target.files.length) {
            const file = e.target.files[0];

            if (file.size > 5 * 1024 * 1024) {
                alert("حجم الملف يجب أن يكون أقل من 5MB");
                return;
            }

            const reader = new FileReader();

            reader.onload = function (event) {
                selfiePreview.innerHTML = `
                            <p>${file.name}</p>
                            <img src="${event.target.result}" alt="صورة السيلفي">
                            <button class="btn-remove" id="removeSelfie">إزالة</button>
                        `;
                selfiePreview.style.display = "block";

                document
                    .getElementById("removeSelfie")
                    .addEventListener("click", function () {
                        selfiePreview.style.display = "none";
                        selfieUpload.value = "";
                    });

                // Show animation
                document.querySelector(".id-card").style.animation = "pulse 1s";
                document.querySelector(".selfie-card").style.animation =
                    "pulse 1s 0.5s";
                checkmark.style.animation = "checkmark 1s 1s forwards";
            };

            reader.readAsDataURL(file);
        }
    });

    // Form submission
    const registerForm = document.getElementById("registerForm");
    registerForm.addEventListener("submit", function (e) {
        if (!idUpload.files.length || !selfieUpload.files.length) {
            alert("يجب رفع كلا المستندين لإثبات الهوية");
            return;
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const resetForm = document.getElementById("resetForm");
    const resetBtn = document.getElementById("resetBtn");
    const successMessage = document.getElementById("successMessage");
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const passwordToggle = document.getElementById("passwordToggle");
    const confirmPasswordToggle = document.getElementById(
        "confirmPasswordToggle"
    );
    const passwordStrength = document.getElementById("passwordStrength");
    const passwordMatch = document.getElementById("passwordMatch");

    // Password strength meter
    passwordInput.addEventListener("input", function () {
        const password = this.value;
        let strength = 0;

        // Reset rules
        document.querySelectorAll(".password-rules li").forEach((rule) => {
            rule.classList.remove("valid", "invalid");
            rule.querySelector("i").className = "fas fa-circle";
        });

        // Check password rules
        if (password.length >= 8) {
            document.getElementById("rule-length").classList.add("valid");
            document.querySelector("#rule-length i").className =
                "fas fa-check-circle";
            strength += 25;
        } else {
            document.getElementById("rule-length").classList.add("invalid");
        }

        if (/[A-Z]/.test(password)) {
            document.getElementById("rule-uppercase").classList.add("valid");
            document.querySelector("#rule-uppercase i").className =
                "fas fa-check-circle";
            strength += 25;
        } else {
            document.getElementById("rule-uppercase").classList.add("invalid");
        }

        if (/\d/.test(password)) {
            document.getElementById("rule-number").classList.add("valid");
            document.querySelector("#rule-number i").className =
                "fas fa-check-circle";
            strength += 25;
        } else {
            document.getElementById("rule-number").classList.add("invalid");
        }

        if (/[!@#$%^&*(),.?":{}|<>]/.test(password)) {
            document.getElementById("rule-special").classList.add("valid");
            document.querySelector("#rule-special i").className =
                "fas fa-check-circle";
            strength += 25;
        } else {
            document.getElementById("rule-special").classList.add("invalid");
        }

        // Update strength meter
        passwordStrength.style.width = strength + "%";

        // Set color based on strength
        if (strength < 50) {
            passwordStrength.style.backgroundColor = "var(--warning)";
        } else if (strength < 75) {
            passwordStrength.style.backgroundColor = "#ffcc00";
        } else {
            passwordStrength.style.backgroundColor = "var(--success)";
        }
    });

    // Confirm password validation
    confirmPasswordInput.addEventListener("input", function () {
        if (passwordInput.value && this.value) {
            if (passwordInput.value === this.value) {
                passwordMatch.style.display = "block";
                passwordMatch.querySelector("p").innerHTML =
                    '<i class="fas fa-check-circle valid"></i> كلمتا المرور متطابقتان';
            } else {
                passwordMatch.style.display = "block";
                passwordMatch.querySelector("p").innerHTML =
                    '<i class="fas fa-times-circle invalid"></i> كلمتا المرور غير متطابقتان';
            }
        } else {
            passwordMatch.style.display = "none";
        }
    });

    // Toggle password visibility
    function togglePasswordVisibility(input, toggle) {
        const type =
            input.getAttribute("type") === "password" ? "text" : "password";
        input.setAttribute("type", type);
        toggle.innerHTML =
            type === "password"
                ? '<i class="fas fa-eye"></i>'
                : '<i class="fas fa-eye-slash"></i>';
    }

    passwordToggle.addEventListener("click", function () {
        togglePasswordVisibility(passwordInput, this);
    });

    confirmPasswordToggle.addEventListener("click", function () {
        togglePasswordVisibility(confirmPasswordInput, this);
    });

    // Form submission
    if (resetForm) {
        resetForm.addEventListener("submit", function (e) {
            const password = passwordInput.value;
            const confirmPassword = confirmPasswordInput.value;

            // Validation
            if (password.length < 8) {
                alert("يجب أن تكون كلمة المرور 8 أحرف على الأقل");
                return;
            }

            if (password !== confirmPassword) {
                alert("كلمتا المرور غير متطابقتان");
                return;
            }

            // Show loading state
            resetBtn.classList.add("btn-reset-loading");
            resetBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Hide loading state
                resetBtn.classList.remove("btn-reset-loading");

                // Show success state
                resetBtn.classList.add("btn-reset-success");

                // Show success message
                successMessage.style.display = "block";

                // Reset form
                resetForm.reset();
                passwordStrength.style.width = "0";
                passwordMatch.style.display = "none";

                // Reset rules
                document
                    .querySelectorAll(".password-rules li")
                    .forEach((rule) => {
                        rule.classList.remove("valid", "invalid");
                        rule.querySelector("i").className = "fas fa-circle";
                    });

                // Reset button after 3 seconds
                setTimeout(() => {
                    resetBtn.classList.remove("btn-reset-success");
                    resetBtn.disabled = false;
                }, 3000);
            }, 2000);
        });
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("verifyForm");
    const uploadInput = document.getElementById("uploadInput");
    const nextBtn = document.getElementById("nextBtn");
    const stepLabel = document.getElementById("step-label");
    const successBox = document.getElementById("successMessage");

    let currentStep = 1;
    let uploadedFiles = [];

    form.addEventListener("submit", (e) => {
        if (!uploadInput.files.length) {
            alert("يرجى رفع صورة قبل المتابعة.");
            return;
        }

        const file = uploadInput.files[0];
        uploadedFiles.push(file);

        if (currentStep === 1) {
            // الانتقال للخطوة 2
            currentStep = 2;
            uploadInput.value = "";
            stepLabel.textContent =
                "الخطوة 2: رفع صورة لك وبجانبك بطاقة الهوية";
        } else {
            // إرسال الملفات (محاكاة)
            console.log("تم رفع:", uploadedFiles);
            form.classList.add("hidden");
            successBox.classList.remove("hidden");
        }
    });
});
