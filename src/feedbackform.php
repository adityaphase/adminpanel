<?php

session_start();

if(isset($_SESSION["form_submitted"])){
    header("Location: formexpired.php");
}
else{
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-pUA-Compatible" content="ie=edge" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
<title>Customer Feedback Form</title>
<link rel="stylesheet" href="fbform.css">
</head>
<body>
<div class="main-box">
    <div class="img-header-top">
        <img src="assets/feedback_banner.jpg" alt="Feedback banner">
    </div>
    <div class="form-section">
    <div class="form-section-sub">
        <h3 class="welcome-header"> We value your feedback.</h3>
        <p class="welcome-text">Please complete the following form and help us improve our customer experience.</p>
        <p class="imp-notes"> Fields marked with * are required. </p>
    </div>
    <form id="feedbackForm" action="submit_feedback.php" method="post">
        <div class="form-section-sub">
            <div class="sub-section-header">
                Personal Details
            </div>
            <label for="name">Name<span>*</span></label><br>
            <input class="text-box-fancy" type="text" id="name" name="name" placeholder="Please enter name" required><br>

            <label for="phone">Phone Number<span>*</span></label><br>
            <input class="text-box-fancy" type="tel" id="phone" name="phone" pattern="[6-9]{1}[0-9]{9}" 
            placeholder="Please enter valid 10 digit phone number" required><br>

            <label for="email">E-mail</label><br>
            <input class="text-box-fancy" type="email" id="email" name="email" placeholder="Please enter valid email address"><br>

            <label for="city">City of residence<span>*</span></label><br>
            <input class="text-box-fancy" type="text" id="city" name="city" placeholder="Enter your place of residence" required><br>
        </div>

        <div class="form-section-sub" style="margin-top: 25px;">
            <div class="sub-section-header">
                How would you rate your stay?
            </div>
            <label for="ambience">Ambience<span>*</span></label><br>
            <div class="rating-box">
                <div class="stars">
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                    <i id="am1" class="fa-solid fa-star"></i>
                </div>    
            </div>
            <input type="hidden" id="ambience" name="ambience">

            <label for="cleanliness">Cleanliness<span>*</span></label><br>
            <div class="rating-box">
                <div class="stars">
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                    <i id="c1" class="fa-solid fa-star"></i>
                </div>    
            </div>
            <input type="hidden" id="cleanliness" name="cleanliness">

            <label for="foodQuality">Food Quality<span>*</span></label><br>
            <div class="rating-box">
                <div class="stars">
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                    <i id="f1" class="fa-solid fa-star"></i>
                </div>    
            </div>
            <input type="hidden" id="foodQuality" name="foodQuality">

            <label for="service">Overall Service<span>*</span></label><br>
            <div class="rating-box">
                <div class="stars">
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                    <i id="s1" class="fa-solid fa-star"></i>
                </div>    
            </div>
            <input type="hidden" id="service" name="service">
        </div>

        <div class="form-section-sub" style="margin-top: 25px;">
            <div class="sub-section-header">
                Do you have any suggestions for us?
            </div>
            <p class="dis-claim"> Max 500 words. </p>
            <textarea class="suggest-box" id="suggestions" name="suggestions" maxlength="500"></textarea><br>
        </div>

        <div class="form-section-sub" style="margin-top: 25px;">
            <div class="sub-section-header">
                Please provide the name and phone number of reference(s).
            </div>
            <p class="dis-claim"> Atleast one reference required. </p>
            <label for="reference1">Reference - Name:<span>*</span></label><br>
            <input class="text-box-fancy" type="text" id="reference1Name" name="referenceName[]" maxlength="150" 
            placeholder="Name of the person" required><br>
            <label for="reference1Phone">Reference - Phone:<span>*</span></label><br>
            <input class="text-box-fancy" type="tel" id="reference1Phone" name="referencePhone[]" pattern="[6-9]{1}[0-9]{9}" 
            placeholder="Phone number of the person" maxlength="10" required><br>

            <label for="referenceCount" style="display: none;">Reference Count:</label>
            <input type="hidden" id="referenceCount" name="referenceCount" value="1">

            <div id="additionalReferences"></div>
            <button class="add-ref-btn" type="button" onclick="addReference()">Add more references</button><br>
        </div>

        <div class="form-section-sub btn-adjust">
            <input class="submit-btn" type="submit" value="Submit feedback">
        </div>
    </form>
    </div>
    <div class="footer-adjust">
        <?php include "footer.php";?>
    </div>
</div>
<script>
    const stars_am1 = document.querySelectorAll("#am1");
    const stars_c1 = document.querySelectorAll("#c1");
    const stars_f1 = document.querySelectorAll("#f1");
    const stars_s1 = document.querySelectorAll("#s1");

    document.addEventListener("DOMContentLoaded", function() {
        stars_am1.forEach((star, index1) => {
            star.addEventListener("click", () => {
                stars_am1.forEach((star, index2) => {
                    index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
                });
                var indexInput = document.getElementById("ambience");
                indexInput.value = index1;
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        stars_c1.forEach((star, index1) => {
            star.addEventListener("click", () => {
                stars_c1.forEach((star, index2) => {
                    index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
                });
                var indexInput = document.getElementById("cleanliness");
                indexInput.value = index1;
            });
        });
    });


    document.addEventListener("DOMContentLoaded", function() {
        stars_f1.forEach((star, index1) => {
            star.addEventListener("click", () => {
                stars_f1.forEach((star, index2) => {
                    index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
                });
                var indexInput = document.getElementById("foodQuality");
                indexInput.value = index1;
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        stars_s1.forEach((star, index1) => {
            star.addEventListener("click", () => {
                stars_s1.forEach((star, index2) => {
                    index1 >= index2 ? star.classList.add("active") : star.classList.remove("active");
                });
                var indexInput = document.getElementById("service");
                indexInput.value = index1;
            });
        });
    });

    document.getElementById('feedbackForm').addEventListener('submit', function(event) {
            var stars1 = document.querySelectorAll('#am1.active');
            var stars2 = document.querySelectorAll('#c1.active');
            var stars3 = document.querySelectorAll('#f1.active');
            var stars4 = document.querySelectorAll('#s1.active');

            var displayAlerts = [];

            if (stars1.length === 0) {
                displayAlerts.push('Please select Ambience star rating.');
            }
            if (stars2.length === 0) {
                displayAlerts.push('Please select Cleanliness star rating.');
            }
            if (stars3.length === 0) {
                displayAlerts.push('Please select Food quality star rating.');
            }
            if (stars4.length === 0) {
                displayAlerts.push('Please select Overall service star rating.');
            }

            if(displayAlerts.length > 0){
                alert(displayAlerts.join("\n"));
                event.preventDefault();
            }
        });

    function addReference() {
        var referenceCountInput = document.getElementById("referenceCount");
        var referenceCount = parseInt(referenceCountInput.value);

        if (referenceCount >= 15) {
            alert("You have reached the maximum limit of references (15).");
            return;
        }

        var additionalReferences = document.getElementById("additionalReferences");
        var referenceNumber = referenceCount + 1;

        var referenceDiv = document.createElement("div");
        referenceDiv.innerHTML = `
            <label for="reference${referenceNumber}">Reference ${referenceNumber} - Name:</label><br>
            <input class="text-box-fancy" type="text" id="reference${referenceNumber}Name" name="referenceName[]" maxlength="150 placeholder="Name of the person""><br>
            <label for="reference${referenceNumber}Phone">Reference ${referenceNumber} - Phone:</label><br>
            <input class="text-box-fancy" type="tel" id="reference${referenceNumber}Phone" name="referencePhone[]" pattern="[6-9]{1}[0-9]{9}" maxlength="10" placeholder="Phone number of the person"><br>
        `;
        additionalReferences.appendChild(referenceDiv);
        referenceCountInput.value = referenceNumber;
    }

    </script>
</body>
</html>

<?php } ?>