document.addEventListener("DOMContentLoaded", function () {

    const button = document.getElementById("darkModeBtn");

    function updateTheme() {

        if (localStorage.getItem("theme") === "dark") {

            document.body.classList.add("dark-mode");

        } else {

            document.body.classList.remove("dark-mode");

        }

        if (button) {

            button.innerHTML = document.body.classList.contains("dark-mode")
                ? "☀️ Light Mode"
                : "🌙 Dark Mode";

        }

    }

    updateTheme();

    if (button) {

        button.addEventListener("click", function () {

            if (document.body.classList.contains("dark-mode")) {

                document.body.classList.remove("dark-mode");
                localStorage.setItem("theme", "light");

            } else {

                document.body.classList.add("dark-mode");
                localStorage.setItem("theme", "dark");

            }

            updateTheme();

        });

    }

});