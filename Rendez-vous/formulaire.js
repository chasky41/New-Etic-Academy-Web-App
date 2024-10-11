document.addEventListener("DOMContentLoaded", function () {
    var form = document.getElementById("rendezvous-form");

    form.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevent the default form submission

        // Collect form data
        var formData = {
            nom: form.nom.value,
            prenom: form.prenom.value,
            email: form.email.value,
            date: form.date.value,
            heure: form.heure.value,
        };

        // Send email using EmailJS
        emailjs.send("service_0655p1j", "template_d8h7gam", formData)
            .then(function(response) {
                console.log("SUCCESS!", response.status, response.text);
                window.location.href = "confirmation.php";
            }, function(error) {
                console.log("FAILED...", error);
                alert("Une erreur est survenue lors de l'envoi de l'e-mail. Veuillez réessayer.");
            });
    });
});
