<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Terra Tactics — Connexion</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Rajdhani:wght@500;600;700&display=swap"
    rel="stylesheet">

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Tailwind config -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            display: ['Rajdhani', 'system-ui', 'sans-serif'],
            sans: ['Montserrat', 'system-ui', 'sans-serif'],
          },
          colors: {
            ink: {
              950: '#070714',
              900: '#0B0B16',
              850: '#0E0E1D',
              800: '#121227',
              700: '#1A1A36',
            },
            steel: '#0F2A36',
            ember: {
              500: '#FF8A00',
              600: '#FF6A2B',
            },
            flare: {
              500: '#FF3B3B',
              600: '#FF2A6D',
            }
          },
          boxShadow: {
            glow: '0 0 0 1px rgba(255,255,255,0.06), 0 20px 60px rgba(0,0,0,0.55)',
            soft: '0 0 0 1px rgba(255,255,255,0.06), 0 10px 30px rgba(0,0,0,0.45)',
            cta: '0 0 0 1px rgba(255,138,0,0.35), 0 20px 60px rgba(255,106,43,0.25)',
          },
          letterSpacing: { tactic: '0.32em' }
        }
      }
    }
  </script>
</head>

<body class="min-h-screen bg-ink-950 text-white antialiased selection:bg-ember-500/30 selection:text-white">

  <!-- BACKDROP -->
  <div class="pointer-events-none fixed inset-0 overflow-hidden">
    <div class="absolute inset-0 bg-[radial-gradient(1200px_700px_at_50%_30%,rgba(255,255,255,0.06),transparent_60%)]">
    </div>

    <div class="absolute -left-24 top-24
                h-[520px] w-[520px]
                sm:h-[640px] sm:w-[640px]
                lg:h-[820px] lg:w-[1220px]
                rounded-full
                bg-[radial-gradient(circle_at_30%_30%,rgba(255,59,59,0.25),transparent_60%)]
                blur-2xl"></div>

    <div class="absolute -right-28 top-36 h-[620px] w-[620px] rounded-full
                bg-[radial-gradient(circle_at_60%_30%,rgba(15,42,54,0.55),transparent_65%)] blur-2xl"></div>

    <div class="absolute inset-0 opacity-[0.10]
                bg-[linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)]
                bg-[length:10px_10px]"></div>
  </div>

  <!-- NAVBAR -->
  <header class="sticky top-0 z-50">
    <div class="backdrop-blur-xl bg-ink-950/55 border-b border-white/5">
      <div class="mx-auto max-w-6xl px-4">
        <div class="flex h-16 items-center justify-between">
          <!-- Brand -->
          <a href="index.html" class="group flex items-center gap-0">
            <img src="image/TERRA_TACTICS.png" alt="Logo Terra Project"
              class="h-16 w-auto object-contain transition-transform duration-200 group-hover:scale-110" />
            <div class="leading-tight">
              <div class="font-display font-bold tracking-[0.18em] text-sm text-white/90">TERRA</div>
              <div class="font-display font-bold tracking-[0.35em] text-[11px] text-flare-500/90">TACTICS</div>
            </div>
          </a>

          <!-- Links -->
          <nav class="hidden md:flex items-center gap-8 text-sm text-white/70">
            <a class="hover:text-white transition" href="index.html">Accueil</a>
            <a class="hover:text-white transition" href="actualites.html">Actualités</a>
            <a class="hover:text-white transition" href="le_jeu.html">Le jeu</a>
            <a class="hover:text-white transition" href="faq.html">FAQ</a>
          </nav>

          <!-- Actions -->
          <div class="flex items-center gap-3">
            <a href="connexion.html" aria-current="page" class="hidden sm:inline-flex items-center justify-center rounded-full px-5 py-2 text-sm font-semibold
                     border border-white/15 bg-white/10 hover:bg-white/15 transition shadow-soft">
              Se connecter
            </a>
            <a href="#" class="inline-flex items-center justify-center rounded-full px-5 py-2 text-sm font-extrabold
                     bg-gradient-to-r from-flare-600 to-ember-500 hover:opacity-95 transition shadow-cta">
              Télécharger
            </a>

            <button id="menuBtn" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl
                     border border-white/10 bg-white/5 hover:bg-white/10 transition" aria-label="Ouvrir le menu">
              <span class="text-white/80">≡</span>
            </button>
          </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobileMenu" class="md:hidden hidden pb-4">
          <div class="grid gap-2 text-sm text-white/70">
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="index.html">Accueil</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition"
              href="actualites.html">Actualités</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="le_jeu.html">Le jeu</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="faq.html">FAQ</a>
            <div class="pt-2">
              <a class="inline-flex w-full items-center justify-center rounded-full px-5 py-2 text-sm font-semibold
                        border border-white/10 bg-white/5 hover:bg-white/10 transition shadow-soft"
                href="connexion.html">
                Se connecter
              </a>
            </div>
          </div>
        </div>

      </div>
    </div>
  </header>

  <!-- MAIN -->
  <main class="relative">
    <section class="relative py-12 sm:py-16">
      <!-- overlay (léger, pas “bizarre” côté droit) -->
      <div class="pointer-events-none absolute inset-0 -z-10">
        <div class="absolute inset-0 bg-gradient-to-r from-flare-600/12 via-transparent to-steel/22"></div>
      </div>

      <div class="mx-auto max-w-7xl px-4">
        <div class="grid lg:grid-cols-2 gap-8 items-stretch">

          <!-- LEFT -->
          <div class="rounded-[28px] border border-white/10 bg-white/5 shadow-glow overflow-hidden">
            <div class="relative h-full p-8 sm:p-10">
              <div class="absolute inset-0 bg-gradient-to-br from-flare-600/16 via-transparent to-steel/18"></div>

              <div class="relative">
                <p class="inline-flex items-center gap-2 text-xs font-semibold tracking-widest uppercase text-white/60">
                  <span class="h-2 w-2 rounded-full bg-ember-500 shadow-[0_0_30px_rgba(255,138,0,0.35)]"></span>
                  ESPACE JOUEUR
                </p>

                <h1
                  class="mt-4 font-display font-extrabold uppercase tracking-tactic text-[22px] sm:text-[34px] leading-[1.2]">
                  CONNEXION
                </h1>

                <p class="mt-4 max-w-xl text-white/65 text-sm sm:text-base leading-relaxed">
                  Une fois connecté, tu retrouveras tout ce dont tu as besoin pour suivre ta progression et jouer en
                  compétitif.
                </p>

                <!-- LIST (sans emojis) -->
                <div class="mt-8 space-y-3">
                  <div class="rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                    <div class="flex items-start gap-3">
                      <span
                        class="mt-1 inline-grid h-9 w-9 place-items-center rounded-xl bg-white/5 border border-white/10">
                        <!-- user icon -->
                        <svg class="h-4 w-4 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2">
                          <path d="M20 21a8 8 0 0 0-16 0"></path>
                          <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                      </span>
                      <div>
                        <p class="font-semibold text-white/90">Profil & identité</p>
                        <p class="text-sm text-white/60">Pseudo, avatar, informations de compte.</p>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                    <div class="flex items-start gap-3">
                      <span
                        class="mt-1 inline-grid h-9 w-9 place-items-center rounded-xl bg-white/5 border border-white/10">
                        <!-- chart icon -->
                        <svg class="h-4 w-4 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2">
                          <path d="M3 3v18h18"></path>
                          <path d="M7 14l3-3 4 4 6-7"></path>
                        </svg>
                      </span>
                      <div>
                        <p class="font-semibold text-white/90">Statistiques</p>
                        <p class="text-sm text-white/60">K/D, précision, matchs joués, performances.</p>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                    <div class="flex items-start gap-3">
                      <span
                        class="mt-1 inline-grid h-9 w-9 place-items-center rounded-xl bg-white/5 border border-white/10">
                        <!-- trophy icon -->
                        <svg class="h-4 w-4 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2">
                          <path d="M8 21h8"></path>
                          <path d="M12 17v4"></path>
                          <path d="M7 4h10v3a5 5 0 0 1-10 0V4z"></path>
                          <path d="M7 7H5a2 2 0 0 0 2 2"></path>
                          <path d="M17 7h2a2 2 0 0 1-2 2"></path>
                        </svg>
                      </span>
                      <div>
                        <p class="font-semibold text-white/90">Classement & saisons</p>
                        <p class="text-sm text-white/60">Rang actuel, historique, récompenses saisonnières.</p>
                      </div>
                    </div>
                  </div>

                  <div class="rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                    <div class="flex items-start gap-3">
                      <span
                        class="mt-1 inline-grid h-9 w-9 place-items-center rounded-xl bg-white/5 border border-white/10">
                        <!-- target icon -->
                        <svg class="h-4 w-4 text-white/70" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                          stroke-width="2">
                          <circle cx="12" cy="12" r="9"></circle>
                          <circle cx="12" cy="12" r="5"></circle>
                          <path d="M12 12l4-4"></path>
                        </svg>
                      </span>
                      <div>
                        <p class="font-semibold text-white/90">Progression & défis</p>
                        <p class="text-sm text-white/60">Objectifs, défis, suivi de progression.</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="mt-6 rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                  <p class="text-sm text-white/70">
                    Pas de compte ?
                    <a href="inscription.php" class="font-semibold text-white hover:text-ember-500 transition">Créer un
                      compte</a>.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- RIGHT -->
          <div class="rounded-[28px] border border-white/10 bg-ink-900/60 shadow-glow overflow-hidden flex">
            <div class="p-10 sm:p-12 w-full flex flex-col justify-center">

              <h2 class="font-display font-extrabold text-3xl">
                Se connecter
              </h2>

              <p class="mt-3 text-white/55 text-sm">
                Entre tes identifiants pour continuer.
              </p>

              <?php if (!empty($_GET["err"])): ?>
                <div class="mt-6">
                  <div class="flex items-start gap-3 rounded-2xl border border-flare-500/20 bg-flare-600/10 px-4 py-3 shadow-soft">
                    <span class="mt-1 h-2.5 w-2.5 shrink-0 rounded-full bg-flare-500 shadow-[0_0_24px_rgba(255,42,109,0.35)]"></span>
                    <div class="text-sm">
                      <p class="font-semibold text-white/90">Connexion refusée</p>
                      <p class="text-white/60">Email / pseudo ou mot de passe incorrect.</p>
                    </div>
                  </div>
                </div>
              <?php endif; ?>

              <form class="mt-10 space-y-6" action="login.php" method="post">

                <!-- EMAIL -->
                <div>
                  <label for="login" class="block text-sm font-semibold text-white/80 mb-2">
                    Email ou pseudo
                  </label>

                  <input id="login" name="login" type="text" autocomplete="username" required
                    placeholder="ex: agent.tactique@terra.com" class="w-full rounded-2xl border border-white/10 bg-white/5
                 px-5 py-4 text-sm text-white
                 placeholder:text-white/35
                 outline-none
                 focus:border-ember-500/50
                 focus:ring-2 focus:ring-ember-500/25
                 transition" />
                </div>

                <!-- PASSWORD -->
                <div>
                  <label for="password" class="block text-sm font-semibold text-white/80 mb-2">
                    Mot de passe
                  </label>

                  <div class="relative">

                    <input id="password" name="password" type="password" autocomplete="current-password" required
                      placeholder="••••••••" class="w-full rounded-2xl border border-white/10 bg-white/5
                   px-5 py-4 pr-28 text-sm text-white
                   placeholder:text-white/35
                   outline-none
                   focus:border-ember-500/50
                   focus:ring-2 focus:ring-ember-500/25
                   transition" />

                    <button type="button" id="togglePw" class="absolute right-3 top-1/2 -translate-y-1/2
                   h-9 px-4 rounded-xl
                   border border-white/10 bg-white/5
                   hover:bg-white/10 transition
                   text-xs text-white/70">
                      Afficher
                    </button>

                  </div>
                </div>

                

                <!-- BUTTON -->
                <div class="pt-2">
                  <button type="submit" class="w-full py-4 rounded-full
                 font-extrabold tracking-widest uppercase text-sm
                 bg-gradient-to-r from-flare-600 to-ember-500
                 shadow-cta
                 hover:opacity-95
                 transition">
                    Connexion
                  </button>
                </div>

              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- FOOTER -->
    <footer class="border-t border-white/5 bg-ink-950/60 backdrop-blur-xl">
      <div
        class="mx-auto max-w-6xl px-4 py-10 text-sm text-white/50 flex flex-col sm:flex-row gap-3 items-center justify-between">
        <p>© <span id="year"></span> Terra Tactics — Tous droits réservés</p>
        <div class="flex gap-5">
          <a class="hover:text-white transition" href="#">Mentions légales</a>
          <a class="hover:text-white transition" href="#">Politique de confidentialité</a>
        </div>
      </div>
    </footer>
  </main>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();

    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    btn?.addEventListener('click', () => menu.classList.toggle('hidden'));

    const togglePw = document.getElementById('togglePw');
    const pw = document.getElementById('password');
    togglePw?.addEventListener('click', () => {
      const isPw = pw.type === 'password';
      pw.type = isPw ? 'text' : 'password';
      togglePw.textContent = isPw ? 'Masquer' : 'Afficher';
    });
  </script>
</body>

</html>