window.addEventListener("DOMContentLoaded", () => {
  const avatarDisplay = document.querySelector("#avatar-display");
  const pseudoInput   = document.querySelector("#pseudo-input");
  const rankSelect    = document.querySelector("#rank-select");

  const kdInput    = document.querySelector("#kd-input");
  const winInput   = document.querySelector("#winrate-input");
  const gamesInput = document.querySelector("#games-input");
  const levelInput = document.querySelector("#level-input");

  const saveBtn = document.querySelector("#save-profile");

  if (!avatarDisplay) return; // sécurité si pas sur la page profil

  /* -------- MODALE AVATAR -------- */
  const avatarModal   = document.querySelector("#avatar-modal");
  const changeAvatar  = document.querySelector("#change-avatar");
  const avatarOptions = document.querySelectorAll(".avatar-option");
  const closeAvatar   = document.querySelector("#close-avatar");

  function openAvatarModal() {
    avatarModal?.classList.add("open");
  }

  function closeAvatarModal() {
    avatarModal?.classList.remove("open");
  }

  changeAvatar?.addEventListener("click", openAvatarModal);
  closeAvatar?.addEventListener("click", closeAvatarModal);
  avatarModal?.addEventListener("click", (e) => {
    if (e.target === avatarModal || e.target === avatarModal.querySelector(".avatar-backdrop")) {
      closeAvatarModal();
    }
  });

  function setSelectedAvatar(src) {
    avatarOptions.forEach(img => {
      if (img.src === src) {
        img.classList.add("selected");
      } else {
        img.classList.remove("selected");
      }
    });
  }

  avatarOptions.forEach(img => {
    img.addEventListener("click", () => {
      avatarDisplay.src = img.src;
      setSelectedAvatar(img.src);
      closeAvatarModal();
      saveProfile();
    });
  });

  /* -------- Sauvegarde Profil -------- */
  function saveProfile() {
    const profile = {
      avatar:  avatarDisplay.src,
      pseudo:  pseudoInput?.value || "",
      rank:    rankSelect?.value || "",
      kd:      kdInput?.value || "",
      winrate: winInput?.value || "",
      games:   gamesInput?.value || "",
      level:   levelInput?.value || ""
    };

    localStorage.setItem("tp5v5-profile", JSON.stringify(profile));
  }

  saveBtn?.addEventListener("click", () => {
    saveProfile();
    alert("Profil enregistré !");
  });

  /* -------- Charger profil -------- */
  function loadProfile() {
    const data = localStorage.getItem("tp5v5-profile");
    if (!data) {
      // avatar par défaut sélectionné
      setSelectedAvatar(avatarDisplay.src);
      return;
    }

    try {
      const p = JSON.parse(data);
      if (p.avatar)  avatarDisplay.src = p.avatar;
      if (pseudoInput) pseudoInput.value = p.pseudo || "";
      if (rankSelect)  rankSelect.value  = p.rank   || "Bronze";
      if (kdInput)     kdInput.value     = p.kd     || "";
      if (winInput)    winInput.value    = p.winrate|| "";
      if (gamesInput)  gamesInput.value  = p.games  || "";
      if (levelInput)  levelInput.value  = p.level  || "";

      setSelectedAvatar(avatarDisplay.src);
    } catch (e) {
      console.error("Erreur de lecture du profil :", e);
    }
  }

  loadProfile();
});
