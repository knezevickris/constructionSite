document.addEventListener("DOMContentLoaded", function () {
    const forms = document.querySelectorAll(".php-email-form");

    forms.forEach(function (form) {
        const loading = form.querySelector(".loading");
        const errorMessage = form.querySelector(".error-message");
        const sentMessage = form.querySelector(".sent-message");

        form.addEventListener("submit", function (e) {
            e.preventDefault();

            loading.style.display = "block";
            errorMessage.style.display = "none";
            sentMessage.style.display = "none";

            const formData = new FormData(form);

            fetch(form.action, {
                method: "POST",
                body: formData,
            })
                .then((response) => response.text())
                .then((text) => {
                    loading.style.display = "none";

                    if (text.includes("Poruka je uspešno poslata")) {
                        sentMessage.style.display = "block";
                        form.reset();
                    } else {
                        errorMessage.innerHTML = text;
                        errorMessage.style.display = "block";
                        autoHide(errorMessage);
                    }
                })
                .catch(() => {
                    loading.style.display = "none";
                    errorMessage.innerHTML = "Greška pri slanju forme.";
                    errorMessage.style.display = "block";
                    autoHide(errorMessage);
                });
        });
    });

    function autoHide(element) {
        setTimeout(() => {
            element.style.display = "none";
        }, 5000);
    }
});