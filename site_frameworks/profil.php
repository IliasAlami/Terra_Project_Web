<?php
session_start();
if (empty($_SESSION["user_id"])) {
  header("Location: connexion.php");
  exit;
}
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Mon Profil — Terra Tactics</title>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800&family=Rajdhani:wght@500;600;700&display=swap"
    rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>

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
          letterSpacing: {
            tactic: '0.32em'
          }
        }
      }
    }
  </script>

  <style>
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .fade-in {
      animation: fadeInUp 0.5s ease forwards;
    }
  </style>
</head>

<body class="min-h-screen flex flex-col bg-ink-950 text-white antialiased selection:bg-ember-500/30 selection:text-white">

  <div class="pointer-events-none fixed inset-0 overflow-hidden -z-10">
    <div class="absolute inset-0 bg-[radial-gradient(1200px_700px_at_50%_30%,rgba(255,255,255,0.06),transparent_60%)]"></div>
    <div class="absolute -left-24 top-24 h-[520px] w-[520px] rounded-full bg-[radial-gradient(circle_at_30%_30%,rgba(255,59,59,0.12),transparent_60%)] blur-3xl"></div>
    <div class="absolute right-0 bottom-0 h-[620px] w-[620px] rounded-full bg-[radial-gradient(circle_at_60%_80%,rgba(15,42,54,0.4),transparent_65%)] blur-3xl"></div>
    <div class="absolute inset-0 opacity-[0.08] bg-[linear-gradient(90deg,rgba(255,255,255,0.02)_1px,transparent_1px)] bg-[length:10px_10px]"></div>
  </div>

  <header class="sticky top-0 z-50">
    <div class="backdrop-blur-xl bg-ink-950/55 border-b border-white/5">
      <div class="mx-auto max-w-6xl px-4">
        <div class="flex h-16 items-center justify-between">
          <a href="index.html" class="group flex items-center gap-0">
            <div class="leading-tight ml-2">
              <div class="font-display font-bold tracking-[0.18em] text-sm text-white/90">TERRA</div>
              <div class="font-display font-bold tracking-[0.35em] text-[11px] text-flare-500/90">TACTICS</div>
            </div>
          </a>

          <nav class="hidden md:flex items-center gap-8 text-sm text-white/70">
            <a class="hover:text-white transition" href="index.html">Accueil</a>
            <a class="hover:text-white transition" href="actualites.html">Actualités</a>
            <a class="hover:text-white transition" href="le_jeu.html">Le jeu</a>
            <a class="text-white border-b border-flare-500 pb-0.5" href="profil.php">Profil</a>
          </nav>

          <div class="flex items-center gap-3">
            <a href="logout.php" class="hidden sm:inline-flex items-center justify-center rounded-full px-5 py-2 text-sm font-semibold border border-white/10 bg-white/5 hover:bg-white/10 hover:text-flare-500 transition shadow-soft">
              Déconnexion
            </a>
            <button id="menuBtn" class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl border border-white/10 bg-white/5 hover:bg-white/10 transition">
              <span class="text-white/80">≡</span>
            </button>
          </div>
        </div>

        <div id="mobileMenu" class="md:hidden hidden pb-4">
          <div class="grid gap-2 text-sm text-white/70">
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="index.html">Accueil</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="actualites.html">Actualités</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="le_jeu.html">Le jeu</a>
            <a class="rounded-xl px-3 py-2 bg-white/5 text-white" href="profil.php">Profil</a>
            <div class="pt-2">
              <a class="inline-flex w-full items-center justify-center rounded-full px-5 py-2 text-sm font-semibold border border-white/10 bg-white/5 hover:bg-white/10 transition text-flare-500" href="logout.php">
                Déconnexion
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="relative flex-grow flex items-center justify-center py-12 px-4">
    <div class="w-full max-w-2xl fade-in">
      
      <div class="text-center mb-8">
        <p class="font-display font-semibold tracking-tactic text-xs text-flare-500/80 uppercase mb-3">Centre de Commandement</p>
        <h1 class="font-display font-extrabold uppercase tracking-tactic text-[26px] sm:text-[36px] leading-[1.25]">
          Dossier Agent
        </h1>
      </div>

      <div class="rounded-[28px] border border-white/10 bg-ink-900/60 shadow-glow overflow-hidden backdrop-blur-md relative">
        <div class="absolute -top-24 -right-24 h-48 w-48 bg-flare-600/10 rounded-full blur-2xl"></div>

        <div class="p-8 sm:p-12 relative z-10">
          <div class="flex flex-col sm:flex-row items-center gap-6 mb-10">
            <div class="h-24 w-24 rounded-[22px] border border-flare-500/30 bg-gradient-to-br from-flare-600/20 to-ink-900 grid place-items-center text-flare-500 text-3xl shadow-soft shrink-0">
              ⬡
            </div>
            <div class="text-center sm:text-left">
              <p class="text-xs font-bold uppercase tracking-widest text-flare-500/70 mb-1">Identité confirmée</p>
              <h2 class="font-display font-bold text-3xl mb-1 text-white/95">
                <?= htmlspecialchars($_SESSION["username"]) ?>
              </h2>
              <div class="inline-flex items-center gap-2 mt-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 text-xs text-white/50">
                <span class="h-2 w-2 rounded-full bg-green-500 animate-pulse"></span>
                En ligne
              </div>
            </div>
          </div>

          <div class="space-y-4 mb-10">
            <div class="rounded-[18px] border border-white/8 bg-white/3 p-5 transition-colors hover:bg-white/5">
              <p class="text-xs text-white/40 uppercase tracking-widest mb-2 font-semibold">Canal de communication (Email)</p>
              <p class="font-mono text-white/80 text-sm"><?= htmlspecialchars($_SESSION["email"]) ?></p>
            </div>
            
            <div class="grid grid-cols-2 gap-4">
              <div class="rounded-[18px] border border-white/8 bg-white/3 p-5 text-center opacity-50">
                <p class="text-2xl mb-1">0</p>
                <p class="text-xs text-white/40 uppercase tracking-widest">Heures de jeu</p>
              </div>
              <div class="rounded-[18px] border border-white/8 bg-white/3 p-5 text-center opacity-50">
                <p class="text-2xl mb-1">-</p>
                <p class="text-xs text-white/40 uppercase tracking-widest">Rang actuel</p>
              </div>
            </div>
          </div>

          <div class="flex flex-col sm:flex-row gap-4 justify-center sm:justify-start pt-6 border-t border-white/10">
            <a href="logout.php" class="inline-flex items-center justify-center rounded-full px-8 py-3 text-sm font-extrabold bg-gradient-to-r from-flare-600 to-ember-500 hover:opacity-95 transition shadow-cta text-white">
              Déconnexion du serveur
            </a>
            <a href="index.html" class="inline-flex items-center justify-center rounded-full px-8 py-3 text-sm font-semibold border border-white/10 bg-white/5 hover:bg-white/10 transition text-white/70 hover:text-white">
              Retour à l'accueil
            </a>
          </div>
        </div>
      </div>
    </div>
  </main>

  <footer class="border-t border-white/5 bg-ink-950/60 backdrop-blur-xl mt-auto">
    <div class="mx-auto max-w-6xl px-4 py-8 text-sm text-white/50 flex flex-col sm:flex-row gap-3 items-center justify-between">
      <p>© <span id="year"></span> Terra Tactics — Tous droits réservés</p>
      <div class="flex gap-5">
        <a class="hover:text-white transition" href="#">Mentions légales</a>
        <a class="hover:text-white transition" href="#">Assistance</a>
      </div>
    </div>
  </footer>

  <script>
    document.getElementById('year').textContent = new Date().getFullYear();

    const btn = document.getElementById('menuBtn');
    const menu = document.getElementById('mobileMenu');
    btn?.addEventListener('click', () => menu.classList.toggle('hidden'));
  </script>
</body>
</html>