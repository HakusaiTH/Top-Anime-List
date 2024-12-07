document.addEventListener("DOMContentLoaded", () => {
    // Add animation to anime cards on hover
    const animeCards = document.querySelectorAll(".anime-card");

    animeCards.forEach(card => {
        card.addEventListener("mouseover", () => {
            card.style.transform = "scale(1.05)";
            card.style.transition = "transform 0.2s";
        });

        card.addEventListener("mouseout", () => {
            card.style.transform = "scale(1)";
        });
    });
});
