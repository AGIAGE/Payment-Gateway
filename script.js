function createPayment() {
    const amount = document.getElementById("amount").value;
    
    fetch("create_payment.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({ amount: amount })
    })
    .then(response => response.json())
    .then(data => {
        if (data.id) {
            // Redirect to Stripe Checkout
            window.location = data.url;
        } else {
            alert("Error creating payment session");
        }
    })
    .catch(error => console.error("Error:", error));
}
