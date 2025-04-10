function validateCpfCnpj() {
     var cpf = document.getElementsByName('cpf')[0].value; 
     var cnpj = document.getElementsByName('cnpj')[0].value;  
     
     if(cpf) {   
          document.getElementsByName('cnpj')[0].disabled = true;
     } else {
          document.getElementsByName('cnpj')[0].disabled = false;
     }
 
     if (cnpj) {
          document.getElementsByName('cpf')[0].disabled = true;
     } else {
          document.getElementsByName('cpf')[0].disabled = false;
     }
 }
 
 function closeModal() {
     const modal = document.getElementById('modal');
     modal.classList.add('slice-out');
     // Após a transição, remova o modal da tela
     setTimeout(() => {
       document.getElementById('modalOverlay').classList.remove('active');
       modal.classList.remove('slice-out');
     }, 500);
   }
 
 function openModal(messageType) {
     const modal = document.getElementById('modal');
     document.getElementById('modalOverlay').classList.add('active');
     switch(messageType) {
       case "PC": // Process Concluded
         modal.style.backgroundColor = '#29c619';
         modal.style.color = '#fff';
         break;
       case "WA": // Warning
         modal.style.backgroundColor = '#e5a811';
         modal.style.color = '#fff';
         break;
       case "ERR": // Error
         modal.style.backgroundColor = '#e73519';
         modal.style.color = '#fff';
         break;
     }
   }