
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion</title>
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <link rel="stylesheet" href="log.css">
</head>

<body>

  <form id="loginForm">
    <h2>Se connecter</h2>
    <label>Nom d'utilisateur</label>
    <input type="text" id="username" name="username" required>

    <label>Mot de passe</label>
    <input type="password" id="password" name="password" required>

    <button type="submit" id="btnLogin">Connexion</button>

    <div class="signup-link">
      Don't have one ? <a href="logup_front.php">create one</a>
    </div>
  </form>

</body>

<script>
const form = document.getElementById('loginForm');
const btnLogin = document.getElementById('btnLogin');

form.addEventListener('submit', async (e) => {
  e.preventDefault();
  btnLogin.disabled = true;
  btnLogin.textContent = "Vérification...";

  const data = {
    username: document.getElementById('username').value.trim(),
    password: document.getElementById('password').value.trim()
  };

  try {
    const resp = await fetch('http://localhost/cv_project/login.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify(data)
    });

    // Always read raw text (helps debugging)
    const raw = await resp.text();
    console.log('HTTP', resp.status, resp.statusText);
    console.log('Response raw:', raw);

    let result;
    try {
      result = JSON.parse(raw);
    } catch (err) {
      alert('Server did not return valid JSON. See console (Network / Response).');
      btnLogin.disabled = false;
      btnLogin.textContent = "Connexion";
      return;
    }

    btnLogin.disabled = false;
    btnLogin.textContent = "Connexion";

    if (result.success) {
      alert("✅  connected ");
      window.location.href = "first.php";
    } else {
      alert("❌ " + result.message);
    }

  } catch (error) {
    console.error('Fetch error:', error);
    alert('⚠️ Network or server error. Check console and XAMPP (Apache).');
    btnLogin.disabled = false;
    btnLogin.textContent = "Connexion";
  }
});
</script>

</body>
</html>
