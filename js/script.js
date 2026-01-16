function initPayPalButton() {
  paypal.Buttons({
    style: {
      shape: 'rect',
      color: 'gold',
      layout: 'vertical',
      label: 'paypal',
    },

    createOrder: function (data, actions) {
      // Obtener y validar el total
      var total_price = parseFloat(document.getElementById("total_price").value).toFixed(2);

      if (!total_price || isNaN(total_price) || total_price <= 0) {
        console.error("Invalid total_price:", total_price);
        alert("Invalid amount.");
        return;
      }

      console.log("Creating order with total:", total_price);

      return actions.order.create({
        purchase_units: [{
          amount: {
            currency_code: "AUD",
            value: total_price
          }
        }]
      });
    },

    onApprove: function (data, actions) {
      return actions.order.capture().then(function (orderData) {
        console.log('Capture result', orderData);

        if (orderData.status === 'COMPLETED') {
          // Redirigir solo si el pago fue exitoso
          window.location.replace("save_order.php");
        } else {
          alert("Payment was not completed. Please try again.");
        }
      });
    },

    onError: function (err) {
      console.error("PayPal error:", err);
      const element = document.getElementById('paypal-button-container');
      element.innerHTML = '<h3>Unable to process the payment</h3>';
    }

  }).render('#paypal-button-container');
}

initPayPalButton();
