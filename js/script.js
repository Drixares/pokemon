const form = document.getElementById("pokemons_form");
const errorMessage = document.getElementById("error-message");

form.addEventListener("submit", async (e) => {
  e.preventDefault();

  const formData = new FormData(form);
  const player_one = formData.get("player1");
  const player_two = formData.get("player2");

  if (!player_one) {
    errorMessage.textContent = "Veuillez choisir un Pokemon pour le joueur 1.";
    return;
  }

  if (!player_two) {
    errorMessage.textContent = "Veuillez choisir un Pokemon pour le joueur 2.";
    return;
  }

  fetch("combat.php", {
    method: "POST",
    body: formData,
  });
});
