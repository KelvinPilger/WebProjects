<div id="loginDiv">
  <form id="loginForm" autocomplete="on">
    <label for="user">Usuário</label>
    <input type="text" placeholder="Preencha o usuário." id="user" name="user" required>

    <label for="password">Senha</label>
    <input type="password" placeholder="Informe sua senha." id="password" name="password" required>

    <label for="email">E-mail (opcional)</label>
    <input type="email" placeholder="Informe seu e-mail." id="email" name="email">

    <button type="submit" id="btnLogin">Entrar</button>

    <input type="text" id="token" value="" readonly placeholder="Token aparecerá aqui">
  </form>

  <pre id="respBox"></pre>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const form   = document.getElementById('loginForm');
  const tokenI = document.getElementById('token');
  const respBox= document.getElementById('respBox');

  form.addEventListener('submit', async (event) => {
    e.preventDefault();

    const user = document.getElementById('user').value.trim();
    const pswd = document.getElementById('password').value;
    const email= document.getElementById('email').value.trim();

    const body = { user, password: pswd, email };

    try {
      const resp = await fetch('<?= BASE_URL ?>/user/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(body)
      });

      const json = await resp.json();
      respBox.textContent = JSON.stringify(json, null, 2);

      if (json.status === 'success' && json.token) {
        tokenI.value = json.token;
      } else {
        tokenI.value = '';
      }
    } catch (err) {
      respBox.textContent = 'Erro na requisição: ' + err.message;
      tokenI.value = '';
    }
  });
});
</script>