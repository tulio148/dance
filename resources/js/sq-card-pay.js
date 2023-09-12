export default async function CardPay(fieldEl, buttonEl) {
    // Create a card payment object and attach to page
    const card = await window.payments.card();
    await card.attach(fieldEl);

    async function eventHandler(event) {
      try {
          const result = await card.tokenize();
          if (result.status === 'OK') {
              // Set the token value in the hidden input field
              document.getElementById('token').value = result.token;
              
              // Submit the form
              document.getElementById('payment-form').submit();
          }
      } catch (e) {
          if (e.message) {
              window.showError(`Error: ${e.message}`);
          } else {
              window.showError('Something went wrong');
          }
      }
  }
  
    
    buttonEl.addEventListener('click', eventHandler);
  }