<?php
declare(strict_types=1);
session_start();
require_once "pdo.php";

$errors = [];
$success = false;

$username = "";
$email = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = trim($_POST["username"] ?? "");
  $email = trim($_POST["email"] ?? "");
  $password = $_POST["password"] ?? "";
  $password2 = $_POST["password2"] ?? "";

  // Validations
  if ($username === "" || mb_strlen($username) < 3 || mb_strlen($username) > 50) {
    $errors[] = "Le pseudo doit contenir entre 3 et 50 caractères.";
  }

  if ($email === "" || !filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 255) {
    $errors[] = "Adresse email invalide.";
  }

  if ($password === "" || strlen($password) < 8) {
    $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
  }

  if ($password !== $password2) {
    $errors[] = "Les mots de passe ne correspondent pas.";
  }

  // Unicité username/email
  if (!$errors) {
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :u OR email = :e LIMIT 1");
    $stmt->execute([":u" => $username, ":e" => $email]);
    if ($stmt->fetch()) {
      $errors[] = "Ce pseudo ou cet email est déjà utilisé.";
    }
  }

  // Insert
  if (!$errors) {
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("
      INSERT INTO users (username, email, password_hash, created_at, updated_at)
      VALUES (:u, :e, :p, NOW(), NOW())
    ");
    $stmt->execute([
      ":u" => $username,
      ":e" => $email,
      ":p" => $hash
    ]);

    // redirige vers connexion avec message OK
    header("Location: connexion.php?ok=1");
    exit;
  }
}
?>
<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Terra Tactics — Inscription</title>

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
            ember: { 500: '#FF8A00', 600: '#FF6A2B' },
            flare: { 500: '#FF3B3B', 600: '#FF2A6D' }
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
    <div class="absolute inset-0 bg-[radial-gradient(1200px_700px_at_50%_30%,rgba(255,255,255,0.06),transparent_60%)]"></div>

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
          <a href="index.html" class="group flex items-center gap-0">
            <img src="image/TERRA_TACTICS.png" alt="Logo Terra Project"
              class="h-16 w-auto object-contain transition-transform duration-200 group-hover:scale-110" />
            <div class="leading-tight">
              <div class="font-display font-bold tracking-[0.18em] text-sm text-white/90">TERRA</div>
              <div class="font-display font-bold tracking-[0.35em] text-[11px] text-flare-500/90">TACTICS</div>
            </div>
          </a>

          <nav class="hidden md:flex items-center gap-8 text-sm text-white/70">
            <a class="hover:text-white transition" href="index.html">Accueil</a>
            <a class="hover:text-white transition" href="actualites.html">Actualités</a>
            <a class="hover:text-white transition" href="le_jeu.html">Le jeu</a>
            <a class="hover:text-white transition" href="faq.html">FAQ</a>
          </nav>

          <div class="flex items-center gap-3">
            <a href="connexion.php"
              class="hidden sm:inline-flex items-center justify-center rounded-full px-5 py-2 text-sm font-semibold
                     border border-white/10 bg-white/5 hover:bg-white/10 transition shadow-soft">
              Se connecter
            </a>
            <a href="#"
              class="inline-flex items-center justify-center rounded-full px-5 py-2 text-sm font-extrabold
                     bg-gradient-to-r from-flare-600 to-ember-500 hover:opacity-95 transition shadow-cta">
              Télécharger
            </a>

            <button id="menuBtn"
              class="md:hidden inline-flex h-10 w-10 items-center justify-center rounded-xl
                     border border-white/10 bg-white/5 hover:bg-white/10 transition"
              aria-label="Ouvrir le menu">
              <span class="text-white/80">≡</span>
            </button>
          </div>
        </div>

        <div id="mobileMenu" class="md:hidden hidden pb-4">
          <div class="grid gap-2 text-sm text-white/70">
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="index.html">Accueil</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="actualites.html">Actualités</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="le_jeu.html">Le jeu</a>
            <a class="rounded-xl px-3 py-2 hover:bg-white/5 hover:text-white transition" href="faq.html">FAQ</a>
            <div class="pt-2">
              <a class="inline-flex w-full items-center justify-center rounded-full px-5 py-2 text-sm font-semibold
                        border border-white/10 bg-white/5 hover:bg-white/10 transition shadow-soft"
                href="connexion.php">
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

                <h1 class="mt-4 font-display font-extrabold uppercase tracking-tactic text-[22px] sm:text-[34px] leading-[1.2]">
                  INSCRIPTION
                </h1>

                <p class="mt-4 max-w-xl text-white/65 text-sm sm:text-base leading-relaxed">
                  Crée ton compte Terra Tactics pour accéder à ton profil, suivre tes stats et jouer en compétitif.
                </p>

                <div class="mt-8 space-y-3">
                  <div class="rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                    <p class="font-semibold text-white/90">Compte sécurisé</p>
                    <p class="text-sm text-white/60">Mot de passe hashé, connexion via session.</p>
                  </div>
                  <div class="rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                    <p class="font-semibold text-white/90">Accès au profil</p>
                    <p class="text-sm text-white/60">Pseudo, email, stats, progression.</p>
                  </div>
                </div>

                <div class="mt-6 rounded-2xl border border-white/10 bg-ink-900/40 p-5">
                  <p class="text-sm text-white/70">
                    Déjà un compte ?
                    <a href="connexion.php" class="font-semibold text-white hover:text-ember-500 transition">Se connecter</a>.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <!-- RIGHT -->
          <div class="rounded-[28px] border border-white/10 bg-ink-900/60 shadow-glow overflow-hidden flex">
            <div class="p-10 sm:p-12 w-full flex flex-col justify-center">

              <h2 class="font-display font-extrabold text-3xl">
                Créer un compte
              </h2>

              <p class="mt-3 text-white/55 text-sm">
                Remplis les informations ci-dessous.
              </p>

              <?php if ($errors): ?>
                <div class="mt-6">
                  <div class="rounded-2xl border border-flare-500/20 bg-flare-600/10 px-4 py-3 shadow-soft">
                    <p class="font-semibold text-white/90 text-sm">Impossible de créer le compte</p>
                    <ul class="mt-1 text-sm text-white/60 list-disc pl-5 space-y-1">
                      <?php foreach ($errors as $e): ?>
                        <li><?= htmlspecialchars($e) ?></li>
                      <?php endforeach; ?>
                    </ul>
                  </div>
                </div>
              <?php endif; ?>

            <?php if (!empty($_GET["ok"])): ?>
            <div class="mt-6 rounded-2xl border border-ember-500/20 bg-ember-500/10 px-4 py-3 shadow-soft">
                <p class="font-semibold text-white/90 text-sm">Compte créé</p>
                <p class="text-sm text-white/60">Tu peux maintenant te connecter.</p>
            </div>
            <?php endif; ?>

              <form class="mt-10 space-y-6" action="inscription.php" method="post" novalidate>
                <div>
                  <label for="username" class="block text-sm font-semibold text-white/80 mb-2">
                    Pseudo
                  </label>
                  <input id="username" name="username" type="text" autocomplete="username" required
                    value="<?= htmlspecialchars($username) ?>"
                    placeholder="ex: AgentTactics"
                    class="w-full rounded-2xl border border-white/10 bg-white/5
                           px-5 py-4 text-sm text-white placeholder:text-white/35
                           outline-none focus:border-ember-500/50 focus:ring-2 focus:ring-ember-500/25 transition" />
                </div>

                <div>
                  <label for="email" class="block text-sm font-semibold text-white/80 mb-2">
                    Email
                  </label>
                  <input id="email" name="email" type="email" autocomplete="email" required
                    value="<?= htmlspecialchars($email) ?>"
                    placeholder="ex: agent@terra.com"
                    class="w-full rounded-2xl border border-white/10 bg-white/5
                           px-5 py-4 text-sm text-white placeholder:text-white/35
                           outline-none focus:border-ember-500/50 focus:ring-2 focus:ring-ember-500/25 transition" />
                </div>

                <div>
                  <label for="password" class="block text-sm font-semibold text-white/80 mb-2">
                    Mot de passe
                  </label>
                  <input id="password" name="password" type="password" autocomplete="new-password" required
                    placeholder="Au moins 8 caractères"
                    class="w-full rounded-2xl border border-white/10 bg-white/5
                           px-5 py-4 text-sm text-white placeholder:text-white/35
                           outline-none focus:border-ember-500/50 focus:ring-2 focus:ring-ember-500/25 transition" />
                </div>

                <div>
                  <label for="password2" class="block text-sm font-semibold text-white/80 mb-2">
                    Confirmer le mot de passe
                  </label>
                  <input id="password2" name="password2" type="password" autocomplete="new-password" required
                    placeholder="Répète le mot de passe"
                    class="w-full rounded-2xl border border-white/10 bg-white/5
                           px-5 py-4 text-sm text-white placeholder:text-white/35
                           outline-none focus:border-ember-500/50 focus:ring-2 focus:ring-ember-500/25 transition" />
                </div>

                <div class="pt-2">
                  <button type="submit"
                    class="w-full py-4 rounded-full font-extrabold tracking-widest uppercase text-sm
                           bg-gradient-to-r from-flare-600 to-ember-500 shadow-cta hover:opacity-95 transition">
                    Inscription
                  </button>
                </div>

                <p class="text-xs text-white/40 text-center pt-2 leading-relaxed">
                  En créant un compte, tu acceptes nos
                  <a href="#" class="underline hover:text-white">Conditions</a>
                  et notre
                  <a href="#" class="underline hover:text-white">Politique de confidentialité</a>.
                </p>
              </form>

            </div>
          </div>

        </div>
      </div>
    </section>

    <footer class="border-t border-white/5 bg-ink-950/60 backdrop-blur-xl">
      <div class="mx-auto max-w-6xl px-4 py-10 text-sm text-white/50 flex flex-col sm:flex-row gap-3 items-center justify-between">
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
  </script>
</body>
</html>