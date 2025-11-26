window.addEventListener('DOMContentLoaded', () => {
  /* ---------------------------------------------
     Burger menu (mobile)
  --------------------------------------------- */
  const burger = document.querySelector('.burger');
  const nav = document.querySelector('.nav');

  if (burger && nav) {
    burger.addEventListener('click', () => {
      nav.classList.toggle('show');
    });
  }

  /* ---------------------------------------------
     Sélecteurs modales / formulaires
  --------------------------------------------- */
  const loginBtn = document.querySelector('#btn-login');

  const loginModal = document.querySelector('#login-modal');
  const registerModal = document.querySelector('#register-modal');

  const loginClose = loginModal?.querySelector('.auth-close');
  const loginBackdrop = loginModal?.querySelector('.auth-modal-backdrop');

  const registerClose = registerModal?.querySelector('.auth-close');
  const registerBackdrop = registerModal?.querySelector('.auth-modal-backdrop');

  const loginForm = document.querySelector('#login-form');
  const registerForm = document.querySelector('#register-form');

  const loginError = document.querySelector('#login-error');
  const registerError = document.querySelector('#register-error');

  const linkOpenRegister = document.querySelector('#open-register');
  const linkOpenLogin = document.querySelector('#open-login');

  /* ---------------------------------------------
     Helpers ouverture / fermeture
  --------------------------------------------- */
  function openModal(modal) {
    if (!modal) return;
    modal.classList.add('open');
    modal.setAttribute('aria-hidden', 'false');
  }

  function closeModal(modal) {
    if (!modal) return;
    modal.classList.remove('open');
    modal.setAttribute('aria-hidden', 'true');
  }

  /* ---------------------------------------------
     Connexion : ouvrir / fermer
  --------------------------------------------- */
  if (loginBtn) {
    loginBtn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(loginModal);
    });
  }

  if (loginClose) {
    loginClose.addEventListener('click', () => closeModal(loginModal));
  }

  if (loginBackdrop) {
    loginBackdrop.addEventListener('click', () => closeModal(loginModal));
  }

  /* ---------------------------------------------
     Inscription : fermer (X / backdrop)
  --------------------------------------------- */
  if (registerClose) {
    registerClose.addEventListener('click', () => closeModal(registerModal));
  }

  if (registerBackdrop) {
    registerBackdrop.addEventListener('click', () => closeModal(registerModal));
  }

  /* ---------------------------------------------
     Switch Connexion <-> Inscription
  --------------------------------------------- */
  if (linkOpenRegister) {
    linkOpenRegister.addEventListener('click', (e) => {
      e.preventDefault();
      closeModal(loginModal);
      openModal(registerModal);
    });
  }

  if (linkOpenLogin) {
    linkOpenLogin.addEventListener('click', (e) => {
      e.preventDefault();
      closeModal(registerModal);
      openModal(loginModal);
    });
  }

  /* ---------------------------------------------
     Fermer avec la touche Echap
  --------------------------------------------- */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeModal(loginModal);
      closeModal(registerModal);
    }
  });

  /* ---------------------------------------------
     Validation formulaire de connexion (simple)
  --------------------------------------------- */
  if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();

      if (loginError) loginError.textContent = '';

      const email = loginForm.elements['email']?.value.trim();
      const password = loginForm.elements['password']?.value.trim();

      if (!email || !password) {
        if (loginError) loginError.textContent = 'Merci de renseigner e-mail et mot de passe.';
        return;
      }

      // Ici tu appelleras ton API de login
      alert('Connexion simulée (à remplacer par ton API).');
      closeModal(loginModal);
      loginForm.reset();
    });
  }

  /* ---------------------------------------------
     Validation formulaire de création de compte
  --------------------------------------------- */
  if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
      e.preventDefault();

      // Reset erreurs visuelles
      if (registerError) registerError.textContent = '';
      const inputs = registerForm.querySelectorAll('input');
      inputs.forEach((input) => input.classList.remove('input-error'));

      const email = registerForm.elements['email']?.value.trim();
      const password = registerForm.elements['password']?.value;
      const confirm = registerForm.elements['confirm']?.value;

      let hasError = false;

      // Champs vides
      if (!email || !password || !confirm) {
        if (registerError) registerError.textContent = 'Merci de remplir tous les champs.';
        inputs.forEach((input) => {
          if (!input.value.trim()) {
            input.classList.add('input-error');
          }
        });
        hasError = true;
      }

      // Longueur du mot de passe
      if (!hasError && password.length < 8) {
        if (registerError) registerError.textContent = 'Le mot de passe doit contenir au moins 8 caractères.';
        registerForm.elements['password'].classList.add('input-error');
        registerForm.elements['confirm'].classList.add('input-error');
        hasError = true;
      }

      // Correspondance des mots de passe
      if (!hasError && password !== confirm) {
        if (registerError) registerError.textContent = 'Les mots de passe ne correspondent pas.';
        registerForm.elements['password'].classList.add('input-error');
        registerForm.elements['confirm'].classList.add('input-error');
        hasError = true;
      }

      if (hasError) return;

      // Ici tu appelleras ton API d'inscription
      alert('Compte créé (simulation, à remplacer par ton API).');

      closeModal(registerModal);
      registerForm.reset();
    });
  }
});
