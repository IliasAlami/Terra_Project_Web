window.addEventListener("DOMContentLoaded", () => {

  const avatarDisplay = document.querySelector("#avatar-display");
  const pseudoInput = document.querySelector("#pseudo-input");
  const rankSelect = document.querySelector("#rank-select");

  const kdInput = document.querySelector("#kd-input");
  const winInput = document.querySelector("#winrate-input");
  const gamesInput = document.querySelector("#games-input");
  const levelInput = document.querySelector("#level-input");

  const saveBtn = document.querySelector("#save-profile");

  /* -------- AVATAR MODAL -------- */
  const avatarModal = document.querySelector("#avatar-modal");
  const changeAvatar = document.querySelector("#change-avatar");
  const avatarOptions = document.querySelectorAll(".avatar-option");
  const closeAvatar = document.querySelector("#close-avatar");

  changeAvatar.addEventListener("click", () => {
    avatarModal.classList.add("open");
  });

  closeAvatar.addEventListener("click", () => {
    avatarModal.classList.remove("open");
  });

  avatarOptions.forEach(img => {
    img.addEventListener("click", () => {
      avatarDisplay.src = img.src;
      avatarModal.classList.remove("open");
      saveProfile(); 
    });
  });

  
  /* -------- Sauvegarde Profil -------- */
  function saveProfile() {
    const profile = {
      avatar: avatarDisplay.src,
      pseudo: pseudoInput.value,
      rank: rankSelect.value,
      kd: kdInput.value,
      winrate: winInput.value,
      games: gamesInput.value,
      level: levelInput.value
    };

    localStorage.setItem("tp5v5-profile", JSON.stringify(profile));
  }

  saveBtn.addEventListener("click", () => {
    saveProfile();
    alert("Profil enregistré !");
  });

  /* -------- Charger profil -------- */
  function loadProfile() {
    const data = localStorage.getItem("tp5v5-profile");
    if (!data) return;

    const p = JSON.parse(data);
    avatarDisplay.src = p.avatar;
    pseudoInput.value = p.pseudo;
    rankSelect.value = p.rank;
    kdInput.value = p.kd;
    winInput.value = p.winrate;
    gamesInput.value = p.games;
    levelInput.value = p.level;
  }

  loadProfile();

});
