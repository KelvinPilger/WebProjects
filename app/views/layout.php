<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>ServFácil (SF)</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/layout.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/modal.css">
  <?php if (!empty($style) && is_array($style)): ?>
    <?php foreach ($style as $href): ?>
      <link rel="stylesheet" href="<?= htmlspecialchars($href)?>">
    <?php endforeach; ?>
  <?php endif; ?>
  <script src="<?= BASE_URL ?>/assets/js/modal.js"></script>
</head>

<body>
  <div class="general-nav">
    <nav class="general" id="main-nav">
      <div id="toast-container">
        <div id="message-modal" class="modal hidden">
          <div class="modal__window">
            <p class="modal__message"></p>
          </div>
        </div>
      </div>
    </nav>
  </div>
  <nav id="sidebarNav">
    <div id="accessButtons">
      <a type="button" id="btnCliente" class="navButtons" href="<?= BASE_URL ?>/client/index">
        <svg xmlns="http://www.w3.org/2000/svg" id="svgClient" height="22" width="22" fill="currentColor" viewBox="0 0 24 24" data-name="svgClient">
          <path d="m7.5 13a4.5 4.5 0 1 1 4.5-4.5 4.505 4.505 0 0 1 -4.5 4.5zm6.5 11h-13a1 1 0 0 1 -1-1v-.5a7.5 7.5 0 0 1 15 0v.5a1 1 0 0 1 -1 1zm3.5-15a4.5 4.5 0 1 1 4.5-4.5 4.505 4.505 0 0 1 -4.5 4.5zm-1.421 2.021a6.825 6.825 0 0 0 -4.67 2.831 9.537 9.537 0 0 1 4.914 5.148h6.677a1 1 0 0 0 1-1v-.038a7.008 7.008 0 0 0 -7.921-6.941z" />
        </svg>
        <span class="btn-text">Clientes</span>
      </a>
      <a id="btnProdutos" class="navButtons" href="<?= BASE_URL ?>/product/index">
        <svg xmlns="http://www.w3.org/2000/svg" id="svgProduto" data-name="svgProduto" fill="currentColor" viewBox="0 0 24 24" height="22" width="22">
          <path d="M11,13H3c-1.657,0-3,1.343-3,3v5c0,1.657,1.343,3,3,3H11V13Zm-7.5,4h0c0-.552,.448-1,1-1h2c.552,0,1,.448,1,1h0c0,.552-.448,1-1,1h-2c-.552,0-1-.448-1-1Zm17.5-4H13v11h8c1.657,0,3-1.343,3-3v-5c0-1.657-1.343-3-3-3Zm-1.5,5h-2c-.552,0-1-.448-1-1h0c0-.552,.448-1,1-1h2c.552,0,1,.448,1,1h0c0,.552-.448,1-1,1ZM15,0h-6c-1.657,0-3,1.343-3,3V11h12V3c0-1.657-1.343-3-3-3Zm-2,5h-2c-.552,0-1-.448-1-1h0c0-.552,.448-1,1-1h2c.552,0,1,.448,1,1h0c0,.552-.448,1-1,1Z" />
        </svg>
        <span class="btn-text">Produtos</span>
      </a>
      <a id="btnFinanceiro" class="navButtons">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24" id="money" class="icon glyph">
          <path d="M20,4H4A2,2,0,0,0,2,6V18a2,2,0,0,0,2,2H20a2,2,0,0,0,2-2V6A2,2,0,0,0,20,4Zm-8.5,7h1A2.5,2.5,0,0,1,13,16V16a1,1,0,0,1-2,0H10a1,1,0,0,1,0-2h2.5a.5.5,0,0,0,0-1h-1A2.5,2.5,0,0,1,11,8.05V8a1,1,0,0,1,2,0h1a1,1,0,0,1,0,2H11.5a.5.5,0,0,0,0,1Z" />
        </svg>
        <span class="btn-text">Financeiro</span>
      </a>
      <a id="btnOs" class="navButtons" href="">
        <svg xmlns="http://www.w3.org/2000/svg" id="svgOs" version="1.0" fill="currentColor" width="22" height="22" viewBox="0 0 512.000000 512.000000">
          <g transform="translate(0.000000,512.000000) scale(0.100000,-0.100000)" stroke="none">
            <path d="M2338 5110 c-138 -13 -171 -49 -187 -205 -13 -124 -37 -197 -96 -285 -105 -158 -264 -242 -452 -241 -158 1 -278 45 -398 146 -88 75 -143 93 -198 63 -56 -29 -189 -149 -327 -294 -176 -185 -186 -235 -68 -363 100 -107 148 -233 148 -383 0 -306 -212 -524 -547 -560 -118 -13 -157 -31 -179 -83 -46 -110 -44 -610 3 -681 24 -37 107 -74 165 -74 150 0 313 -80 416 -203 95 -114 138 -245 129 -392 -9 -145 -48 -236 -153 -360 -97 -114 -95 -157 11 -284 78 -93 239 -254 320 -321 94 -77 157 -74 250 10 105 95 229 148 365 157 166 10 302 -39 420 -153 110 -106 164 -227 176 -397 8 -106 20 -137 66 -165 85 -53 602 -56 690 -5 49 29 66 67 77 178 13 124 37 197 96 285 105 158 264 242 452 241 158 -1 278 -45 398 -146 88 -75 143 -93 198 -63 84 44 416 369 455 445 35 68 18 127 -60 212 -101 109 -148 232 -148 389 0 160 57 290 175 401 107 100 217 145 378 157 151 11 180 40 196 203 21 202 7 507 -25 555 -26 41 -81 67 -163 76 -184 21 -271 60 -382 170 -125 123 -176 256 -166 425 9 143 49 237 153 360 97 114 95 157 -11 284 -78 93 -239 254 -320 321 -93 76 -159 74 -245 -6 -60 -56 -146 -108 -229 -136 -88 -31 -268 -33 -350 -4 -173 60 -312 206 -365 384 -8 30 -18 95 -22 145 -8 106 -20 137 -68 166 -58 36 -357 52 -578 31z m427 -1091 c562 -72 1050 -494 1210 -1045 65 -224 76 -483 30 -711 -29 -140 -105 -343 -163 -431 -15 -23 -18 -21 -338 299 l-322 322 19 54 c109 316 35 666 -190 905 -224 239 -517 335 -836 276 -106 -20 -135 -44 -135 -114 0 -36 12 -50 230 -269 263 -264 242 -224 215 -412 -19 -138 -34 -191 -54 -197 -35 -11 -195 -36 -271 -42 l-80 -7 -228 226 c-125 124 -240 231 -255 236 -59 22 -114 -24 -131 -109 -64 -318 30 -628 256 -846 160 -156 351 -239 573 -251 125 -6 218 5 332 42 l78 25 323 -323 c177 -177 321 -326 319 -332 -6 -17 -220 -120 -317 -152 -573 -189 -1193 -19 -1583 432 -533 617 -467 1546 148 2078 326 282 731 402 1170 346z" />
          </g>
        </svg>
        <span class="btn-text">Ordens de Serviço</span>
      </a>
    </div>
  </nav>
  </div>
  <main class="pre-slide"><?= $content ?></main>
  <footer>
  </footer>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const main = document.querySelector('main');

      requestAnimationFrame(() => {
        setTimeout(() => {
          main.classList.remove('pre-slide');
          main.classList.add('slide-in');
        }, 20);
      });
    });

    function toggleDropdown(id) {
      const menu = document.getElementById(id);
      menu.classList.toggle('show');

    }
  </script>
  <script src="<?= BASE_URL ?>/assets/js/modal.js"></script>
</body>

</html>