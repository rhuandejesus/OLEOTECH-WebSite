// ===== Slider Autoplay =====
(function () {
  const slider = document.querySelector('.slider');
  if (!slider) return;

  const slidesTrack = slider.querySelector('.slides');
  if (!slidesTrack) return;

  const radios = slider.querySelectorAll('input[name="radio-btn"]');
  const total = radios.length;
  if (!total) return;

  const interval = parseInt(slider.getAttribute('data-interval'), 10) || 2500;

  let current = Array.from(radios).findIndex(r => r.checked);
  if (current < 0) current = 0;

  radios[current].checked = true;
  updatePosition(current);

  let timerId = null;

  function updatePosition(index) {
    const offset = -(100 / total) * index;
    slidesTrack.style.transform = `translateX(${offset}%)`;
    radios[index].checked = true;
  }

  function goTo(index) {
    current = (index + total) % total;
    updatePosition(current);
  }

  function next() { goTo(current + 1); }
  function prev() { goTo(current - 1); }

  function start() {
    stop();
    timerId = setInterval(next, interval);
  }

  function stop() {
    if (timerId) clearInterval(timerId);
    timerId = null;
  }

  radios.forEach((r, i) => r.addEventListener('change', () => goTo(i)));
  slider.addEventListener('mouseenter', stop);
  slider.addEventListener('mouseleave', start);
  slider.addEventListener('focusin', stop);
  slider.addEventListener('focusout', start);

  start();
  slider._goNext = next;
  slider._goPrev = prev;
})();

// ===== Read More =====
const readMoreBtns = document.querySelectorAll('.btn-read');
readMoreBtns.forEach(btn => {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    const cardContent = this.parentElement;
    cardContent.classList.toggle('expanded');
    this.textContent = cardContent.classList.contains('expanded') ? "Voltar" : "Ler Mais";
  });
});

// ===== Login Button com Loading =====
const loginButton = document.querySelector('.login-button');
const loadingScreen = document.getElementById('loading-screen');

if (loginButton) {
  loginButton.addEventListener('click', function (e) {
    e.preventDefault();
    loadingScreen.style.display = 'flex';
    sessionStorage.setItem("redirecting", "true");
    setTimeout(() => {
      window.location.href = loginButton.href;
    }, 1000);
  });
}

// ===== Smooth Scroll para Local Entrar =====
document.addEventListener('DOMContentLoaded', () => {
  const loginBtn = document.querySelector('.login-button');
  const target = document.getElementById('local-entrar');
  const header = document.querySelector('.header');

  if (loginBtn && target) {
    loginBtn.addEventListener('click', function (e) {
      e.preventDefault();
      const headerHeight = header ? header.getBoundingClientRect().height : 0;
      const top = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 10;
      window.scrollTo({ top, behavior: 'smooth' });
    });
  }
});




// ===== Menu Cadastro =====
const btnCadastrar = document.getElementById('btnCadastrar');
const cadastroOpcoes = document.getElementById('cadastroOpcoes');

btnCadastrar.addEventListener('click', function (e) {
  e.preventDefault();
  cadastroOpcoes.style.display = cadastroOpcoes.style.display === 'flex' ? 'none' : 'flex';
});





//== atualiza --header-height como no exemplo anterior ======
function updateHeaderHeight() {
  const header = document.querySelector('.header');
  document.documentElement.style.setProperty('--header-height', (header ? header.offsetHeight : 0) + 'px');
}
window.addEventListener('load', updateHeaderHeight);
window.addEventListener('resize', updateHeaderHeight);

// intercepta cliques nos links do nav e no login-button
document.querySelectorAll('.nav-links a, .login-button, .logo-container').forEach(link => {
  link.addEventListener('click', function (e) {
    const href = this.getAttribute('href');
    // permite links externos normais
    if (!href || !href.startsWith('#')) return;
    const target = document.querySelector(href);
    if (!target) return;

    e.preventDefault();
    const header = document.querySelector('.header');
    const headerHeight = header ? header.offsetHeight : 0;
    const gap = 8; // pequeno espaçamento extra
    const top = target.getBoundingClientRect().top + window.scrollY - headerHeight - gap;

    window.scrollTo({ top, behavior: 'smooth' });

    // se tiver menu mobile aberto, fecha aqui (exemplo)
    const menu = document.querySelector('.nav'); // ajuste se seu mobile menu tiver outra classe
    if (menu && menu.classList.contains('open')) {
      menu.classList.remove('open');
    }
  });
});


