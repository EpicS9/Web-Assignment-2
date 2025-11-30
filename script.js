$(document).ready(function () {
    const $form = $("#regForm");
    const $msg = $("#form-msg");
    const $card = $(".card").first();  // first card = form card
    const $resultCard = $("#resultCard");

    $form.on("submit", function (e) {
        e.preventDefault(); // stop normal form submit

        let name = $("#name").val().trim();
        let usn = $("#usn").val().trim();
        let email = $("#email").val().trim();
        let course = $("#course").val();
        let pass = $("#password").val();
        let conf = $("#confirm").val();
        let error = "";

        // Basic validation
        if (name === "" || usn === "" || email === "" || course === "" || pass === "" || conf === "") {
            error = "All fields are required.";
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            error = "Enter a valid email address.";
        } else if (pass.length < 6) {
            error = "Password must be at least 6 characters.";
        } else if (pass !== conf) {
            error = "Passwords do not match.";
        }

        if (error !== "") {
            $msg
                .text(error)
                .removeClass("success")
                .addClass("error");
            $card.addClass("shake");
            setTimeout(() => $card.removeClass("shake"), 300);
            return;
        }

        // If valid: show success message + fill result card
        $msg
            .text("Registration successful!")
            .removeClass("error")
            .addClass("success");

        // Fill result card
        $("#res-name").text(name);
        $("#res-usn").text(usn);
        $("#res-email").text(email);
        $("#res-course").text(course);

        // Switch cards
        $form.addClass("hidden");
        $resultCard.removeClass("hidden");
    });

    // Back button: show form again, clear fields
    $("#backBtn").on("click", function () {
        $form[0].reset();
        $msg.text("").removeClass("error success");
        $resultCard.addClass("hidden");
        $form.removeClass("hidden");
    });

    // Label highlight on focus
    $("input, select").on("focus", function () {
        $(this).closest(".field").find("label").css("color", "#a855f7");
    }).on("blur", function () {
        $(this).closest(".field").find("label").css("color", "#e5e7eb");
    });
});
