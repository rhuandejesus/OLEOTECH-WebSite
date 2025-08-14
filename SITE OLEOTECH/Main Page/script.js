// ===== Slider Autoplay =====
(function () {
  const slider = document.querySelector('.slider');
  if (!slider) return;

  const slidesTrack = slider.querySelector('.slides');
  if (!slidesTrack) return;

  // Radios que já existem no seu HTML
  const radios = slider.querySelectorAll('input[name="radio-btn"]');
  const total = radios.length;
  if (!total) return;

  // Intervalo do autoplay configurável via atributo data-interval no .slider
  const interval = parseInt(slider.getAttribute('data-interval'), 10) || 4000;

  // Posição atual
  let current = Array.from(radios).findIndex(r => r.checked);
  if (current < 0) current = 0; // fallback se nenhum estiver checado

  // Garante estado inicial sincronizado
  radios[current].checked = true;
  updatePosition(current);

  let timerId = null;

  function updatePosition(index) {
    // calcula o offset com base na quantidade de slides (4 => 0, -25, -50, -75)
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
    stop(); // evita múltiplos timers
    timerId = setInterval(next, interval);
  }

  function stop() {
    if (timerId) {
      clearInterval(timerId);
      timerId = null;
    }
  }

  // Manual: quando o usuário clica num label e muda o radio
  radios.forEach((r, i) => {
    r.addEventListener('change', () => goTo(i));
  });

  // Pausa no hover/foco e retoma ao sair
  slider.addEventListener('mouseenter', stop);
  slider.addEventListener('mouseleave', start);
  slider.addEventListener('focusin', stop);
  slider.addEventListener('focusout', start);

  // Inicia
  start();

  // Exponho prev/next se quiser criar botões depois:
  slider._goNext = next;
  slider._goPrev = prev;
})();

// Evita erro do onresize inline no <body>
function mudouTamanho() {
  // Se precisar, coloque lógica responsiva aqui.
}


// Seleciona todos os botões Read More
const readMoreBtns = document.querySelectorAll('.btn-read');

readMoreBtns.forEach(btn => {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    const cardContent = this.parentElement;
    cardContent.classList.toggle('expanded');

    if (cardContent.classList.contains('expanded')) {
      this.textContent = "Voltar";
    } else {
      this.textContent = "Ler Mais";
    }
  });
});