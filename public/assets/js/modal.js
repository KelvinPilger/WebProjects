;(function(window, document) {
  const modal = document.getElementById('message-modal');
  const msg   = modal.querySelector('.modal__message');

  function showModal(type, message, duration = 3000) {
    console.log('showModal', type, message);
    modal.classList.remove('success','error','warning','hidden');
    modal.classList.add(type);
    msg.textContent = message;
    if (duration > 0) setTimeout(hideModal, duration);
  }

  function hideModal() {
    modal.classList.add('hidden');
  }

  window.MessageModal = { show: showModal, hide: hideModal };
})(window, document);