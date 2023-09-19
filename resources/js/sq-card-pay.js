export default async function CardsPay(
    cardContainerRef,
    cardButtonRef,
    tokenInputRef
) {
    // Create a card payment object and attach to page
    if (
        !cardContainerRef.current ||
        !cardButtonRef.current ||
        !tokenInputRef.current
    ) {
        // Ensure that the refs are defined
        return;
    }

    const card = await window.payments.card();
    await card.attach(cardContainerRef.current);
    return card;

    // async function eventHandler(event) {
    //     try {
    //         const result = await card.tokenize();
    //         if (result.status === "OK") {
    //             // Set the token value in the hidden input field
    //             tokenInputRef.current.value = result.token;

    //             // Submit the form
    //             // document.getElementById("payment-form").submit();
    //         }
    //     } catch (e) {
    //         if (e.message) {
    //             window.showError(`Error: ${e.message}`);
    //         } else {
    //             window.showError("Something went wrong");
    //         }
    //     }
    // }

    // cardButtonRef.current.addEventListener("click", eventHandler);
}
