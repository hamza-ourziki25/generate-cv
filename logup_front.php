
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="log.css">
    <title>Document</title>
</head>
<body>
    <form id="loginForm">
    <h2>LOG UP</h2>

    <label>full-name</label>
    <input type="text" id="fullname" name="fullname" required>

    <label>Username</label>
    <input type="text" id="username" name="username" placeholder="only No & letters" required>

    <label>Mot de passe</label>
    <input type="password" id="password" name="password" placeholder="most be more then 6 " required>

    <button type="submit" id="btnLogin">Logup</button>

    <div class="signup-link">
       you have one ? <a href="login_front.php">log in</a>
    </div>
  </form>


<script>
const form = document.getElementById('loginForm');
const btnLogin = document.getElementById('btnLogin');

form.addEventListener('submit', async (e) => {
    e.preventDefault();
    btnLogin.disabled = true;
    btnLogin.textContent = "Enregistrement...";

    const data = {
        fullname: document.getElementById('fullname').value.trim(),
        username: document.getElementById('username').value.trim(),
        password: document.getElementById('password').value.trim()
    };

    try {
        const resp = await fetch('logup.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const result = await resp.json();

        btnLogin.disabled = false;
        btnLogin.textContent = "Logup";

        if(result.success){
            alert("✅ " + result.message);
            window.location.href = 'login_front.php'; // redirect to login page
        } else {
            alert("❌ " + result.message);
        }

    } catch(err){
        console.error(err);
        alert("Erreur de connexion au serveur !");
        btnLogin.disabled = false;
        btnLogin.textContent = "Logup";
    }
});
</script>
</body>
</html>