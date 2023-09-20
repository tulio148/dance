export default async function GooglePay(buttonEl) {
    //     const paymentRequest = window.payments.paymentRequest(
    //       // Use global method from sq-payment-flow.js
    //       window.getPaymentRequest()
    //     );
    //     const googlePay = await payments.googlePay(paymentRequest);
    //     await googlePay.attach(buttonEl);
    //     async function eventHandler(event) {
    //       // Clear any existing messages
    //       window.paymentFlowMessageEl.innerText = '';
    //       try {
    //         const result = await googlePay.tokenize();
    //         if (result.status === 'OK') {
    //           // Use global method from sq-payment-flow.js
    //           document.getElementById('token').value = result.token;
    //           // Submit the form
    //           document.getElementById('payment-form').submit();
    //         }
    //       } catch (e) {
    //         if (e.message) {
    //           window.showError(`Error: ${e.message}`);
    //         } else {
    //           window.showError('Something went wrong');
    //         }
    //       }
    //     }
    //     buttonEl.addEventListener('click', eventHandler);
}
