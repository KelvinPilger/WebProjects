(function(window, document) {
  const container = document.getElementById('toast-container');

  function show(type, message, duration = 5000) {
    const toast = document.createElement('div');
    toast.classList.add('modal', type);
    toast.innerHTML = `
      <div class="modal__window">
        <p class="modal__message">${message}</p>
      </div>
    `;
    container.appendChild(toast);

    setTimeout(() => {
      toast.classList.add('hidden');
      toast.addEventListener('animationend', () => toast.remove());
    }, duration);
  }

  window.MessageModal = { show, hide: (toastEl) => {
    toastEl.classList.add('hidden');
    toastEl.addEventListener('animationend', () => toastEl.remove());
  }};
})(window, document);