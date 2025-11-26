window.addEventListener('DOMContentLoaded', () => {

  /* --------------------------------------------------------------
     0. ÉTAT D'AUTH (localStorage)
  -------------------------------------------------------------- */
  const AUTH_KEY = 'tp5v5-logged-in';

  const isLoggedIn = () => localStorage.getItem(AUTH_KEY) === 'true';
  const setLoggedIn = (value) => {
    if (value) {
      localStorage.setItem(AUTH_KEY, 'true');
    } else {
      localStorage.removeItem(AUTH_KEY);
    }
  };


  /* --------------------------------------------------------------
     1. BURGER MENU (mobile)
  -------------------------------------------------------------- */
  const burger = document.querySelector('.burger');
  const nav = document.querySelector('.nav');

  if (burger && nav) {
    burger.addEventListener('click', () => {
      nav.classList.toggle('show');
    });
  }


  /* --------------------------------------------------------------
     2. SÉLECTEURS DES MODALES & FORMULAIRES
  -------------------------------------------------------------- */
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


  /* --------------------------------------------------------------
     3. PROFIL VERROUILLÉ (page profil)
  -------------------------------------------------------------- */
  const isProfilePage = document.body.classList.contains('page-profile');
  const profileLocked = document.querySelector('#profile-locked');
  const lockedLoginBtn = document.querySelector('#locked-login-btn');

  function lockProfilePage() {
    if (!isProfilePage || !profileLocked) return;
    document.body.classList.add('page-profile-locked');
    profileLocked.classList.add('show');
  }

  function unlockProfilePage() {
    if (!isProfilePage || !profileLocked) return;
    document.body.classList.remove('page-profile-locked');
    profileLocked.classList.remove('show');
  }

  // Init état profil à l'arrivée sur la page
  if (isProfilePage) {
    if (isLoggedIn()) {
      unlockProfilePage();
    } else {
      lockProfilePage();
    }
  }

  if (lockedLoginBtn) {
    lockedLoginBtn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(loginModal);
    });
  }

  const lockedBackBtn = document.querySelector('#locked-back-btn');

if (lockedBackBtn) {
  lockedBackBtn.addEventListener('click', (e) => {
    e.preventDefault();

    // Si on peut réellement revenir en arrière
    if (history.length > 1) {
      history.back();
    } else {
      // Sinon on retourne à l'accueil
      window.location.href = "index.html";
    }
  });
}



  /* --------------------------------------------------------------
     4. OUVERTURE / FERMETURE MODALES
  -------------------------------------------------------------- */
  function openModal(modal) {
    modal?.classList.add('open');
    modal?.setAttribute('aria-hidden', 'false');
  }

  function closeModal(modal) {
    modal?.classList.remove('open');
    modal?.setAttribute('aria-hidden', 'true');
  }

  /* Bouton Se connecter (navbar) */
  if (loginBtn) {
    loginBtn.addEventListener('click', (e) => {
      e.preventDefault();
      openModal(loginModal);
    });
  }

  /* Fermer modale login */
  loginClose?.addEventListener('click', () => closeModal(loginModal));
  loginBackdrop?.addEventListener('click', () => closeModal(loginModal));

  /* Fermer modale inscription */
  registerClose?.addEventListener('click', () => closeModal(registerModal));
  registerBackdrop?.addEventListener('click', () => closeModal(registerModal));


  /* --------------------------------------------------------------
     5. TRANSITION SLIDE ENTRE CONNEXION <-> INSCRIPTION
  -------------------------------------------------------------- */

  function showRegister() {
    if (!loginModal || !registerModal) return;
    loginModal.classList.add("slide-left");
    setTimeout(() => {
      closeModal(loginModal);
      loginModal.classList.remove("slide-left");
      openModal(registerModal);
    }, 200);
  }

  function showLogin() {
    if (!loginModal || !registerModal) return;
    registerModal.classList.add("slide-right");
    setTimeout(() => {
      closeModal(registerModal);
      registerModal.classList.remove("slide-right");
      openModal(loginModal);
    }, 200);
  }

  linkOpenRegister?.addEventListener('click', (e) => {
    e.preventDefault();
    showRegister();
  });

  linkOpenLogin?.addEventListener('click', (e) => {
    e.preventDefault();
    showLogin();
  });


  /* --------------------------------------------------------------
     6. FERMETURE AVEC LA TOUCHE ÉCHAP
  -------------------------------------------------------------- */
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
      closeModal(loginModal);
      closeModal(registerModal);
    }
  });


  /* --------------------------------------------------------------
     7. CALLBACK GÉNÉRAL APRÈS CONNEXION / INSCRIPTION
  -------------------------------------------------------------- */
  function afterLoginOrRegister() {
    setLoggedIn(true);
    if (isProfilePage) {
      unlockProfilePage();
    }
  }


  /* --------------------------------------------------------------
     8. VALIDATION FORMULAIRE DE CONNEXION + LOADER
  -------------------------------------------------------------- */
  if (loginForm) {
    loginForm.addEventListener('submit', (e) => {
      e.preventDefault();

      if (loginError) loginError.textContent = "";

      const email = loginForm.elements['email'].value.trim();
      const password = loginForm.elements['password'].value.trim();

      if (!email || !password) {
        if (loginError) loginError.textContent = "Merci de renseigner e-mail et mot de passe.";
        return;
      }

      // Loader animé
      const submitBtn = loginForm.querySelector('.auth-submit');
      if (submitBtn) {
        submitBtn.innerHTML = '<div class="loader"></div>';
      }

      setTimeout(() => {
        alert('Connexion réussie (simulation).');

        if (submitBtn) submitBtn.textContent = "Se connecter";
        closeModal(loginModal);
        loginForm.reset();

        afterLoginOrRegister();
      }, 1500);
    });
  }


  /* --------------------------------------------------------------
     9. VALIDATION FORMULAIRE D'INSCRIPTION
  -------------------------------------------------------------- */
  if (registerForm) {
    registerForm.addEventListener('submit', (e) => {
      e.preventDefault();

      if (registerError) registerError.textContent = "";
      const inputs = registerForm.querySelectorAll('input');
      inputs.forEach(i => i.classList.remove('input-error'));

      const email = registerForm.elements['email'].value.trim();
      const password = registerForm.elements['password'].value;
      const confirm = registerForm.elements['confirm'].value;

      let hasError = false;

      if (!email || !password || !confirm) {
        if (registerError) registerError.textContent = "Merci de remplir tous les champs.";
        inputs.forEach(i => {
          if (!i.value.trim()) i.classList.add('input-error');
        });
        hasError = true;
      }

      if (!hasError && password.length < 8) {
        if (registerError) registerError.textContent = "Le mot de passe doit faire au moins 8 caractères.";
        registerForm.elements['password'].classList.add('input-error');
        registerForm.elements['confirm'].classList.add('input-error');
        hasError = true;
      }

      if (!hasError && password !== confirm) {
        if (registerError) registerError.textContent = "Les mots de passe ne correspondent pas.";
        registerForm.elements['password'].classList.add('input-error');
        registerForm.elements['confirm'].classList.add('input-error');
        hasError = true;
      }

      if (hasError) return;

      alert("Compte créé avec succès (simulation).");

      closeModal(registerModal);
      registerForm.reset();

      afterLoginOrRegister();
    });
  }


  /* --------------------------------------------------------------
     10. ANIMATION D'APPARITION DES SECTIONS (fade-in)
  -------------------------------------------------------------- */
  const fadeElements = document.querySelectorAll('.fade-in');

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('visible');
      }
    });
  });

  fadeElements.forEach(el => observer.observe(el));

});
