const searchInput = document.getElementById("buscador");
const cards = document.querySelectorAll(".card");

searchInput.addEventListener("input", function () {
    const searchTerm = searchInput.value.toLowerCase();

    cards.forEach((card) => {
        const cardTitle = card.querySelector("h1").textContent.toLowerCase();

        if (cardTitle.includes(searchTerm)) {
        card.style.display = "block";
        } else {
        card.style.display = "none";
        }
    });
});