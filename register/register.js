// register.js

document.querySelector('.container_register form').addEventListener('submit', function(e) {
    e.preventDefault();
  
    const formData = new FormData(this);
    fetch('register.php', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        // Hiển thị modal
        const modal = document.getElementById('successModal');
        const span = document.getElementsByClassName('close')[0];
  
        modal.style.display = 'block';
  
        span.onclick = function() {
          modal.style.display = 'none';
          window.location.href = '../index.html';
        }
  
        window.onclick = function(event) {
          if (event.target === modal) {
            modal.style.display = 'none';
            window.location.href = '../index.html';
          }
        }
  
        // Tự động chuyển hướng sau 3 giây
        setTimeout(() => {
          modal.style.display = 'none';
          window.location.href = '../index.html';
        }, 3000);
  
      } else {
        alert('Error: ' + data.message);
      }
    })
    .catch(error => console.error('Error:', error));
  });
  