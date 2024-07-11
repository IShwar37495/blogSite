document.addEventListener("DOMContentLoaded", function () {
    document
        .getElementById("postForm")
        .addEventListener("submit", async function (event) {
            event.preventDefault();

            var formData = new FormData(this);

            try {
                const response = await fetch("/addSinglePost", {
                    method: "POST",
                    body: formData,
                });

                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }

                const data = await response.json();
                console.log(data);

                // Show the popup
                document.getElementById("overlay").style.display = "block";
                document.getElementById("popup").style.display = "block";

                // Close the popup when Close button is clicked
                document
                    .getElementById("closePopup")
                    .addEventListener("click", function () {
                        document.getElementById("overlay").style.display =
                            "none";
                        document.getElementById("popup").style.display = "none";
                    });

                // Optionally redirect after a delay
                setTimeout(function () {
                    window.location.href = "/";
                }, 3000); // Redirect after 3 seconds (example)
            } catch (error) {
                console.error("Error:", error);
                alert("Something went wrong");
            }
        });
});
