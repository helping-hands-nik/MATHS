document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent form from submitting normally

    // Basic Validation
    const name = document.getElementById("name").value.trim();
    const fatherName = document.getElementById("fatherName").value.trim();
    const motherName = document.getElementById("motherName").value.trim();
    const dob = document.getElementById("dob").value;
    const image = document.getElementById("image").files[0];
    const certificates = document.getElementById("certificates").files;

    if (!name || !fatherName || !motherName || !dob || !image || certificates.length === 0) {
        alert("Please fill all fields and upload files.");
        return;
    }

    // Success Message
    document.getElementById("successMessage").style.display = "block";
    
    // Reset Form
    document.getElementById("registrationForm").reset();
});
document.getElementById("registrationForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData(this);

    fetch("upload.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById("successMessage").textContent = "Registration Successful!";
            document.getElementById("successMessage").style.display = "block";
            document.getElementById("registrationForm").reset();
        } else {
            alert("Error: " + data.message);
        }
    })
    .catch(error => console.error("Error:", error));
});