document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById("message-modal");
  const messageEl = modal.querySelector(".modal__message");

  const MessageModal = {
    show(type, message) {
      if (!modal || !messageEl) return;

      messageEl.textContent = message;
      modal.classList.remove("hidden");
      modal.classList.add(type);

      setTimeout(() => {
        modal.classList.add("hidden");
        modal.classList.remove(type);
      }, 2000);
    }
  };

  window.MessageModal = MessageModal;
});