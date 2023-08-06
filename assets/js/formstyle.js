$(document).ready(function() {
  $('#loginLink').click(function(e) {
    e.preventDefault(); // Menghentikan aksi default link

    // Menggunakan AJAX untuk memuat konten form login
    $.ajax({
      url: 'users/login', // Ubah URL sesuai dengan endpoint yang menampilkan form login
      method: 'GET',
      success: function(response) {
        // Menampilkan konten form login sebagai popup
        $('#loginModal').remove(); // Hapus modal sebelumnya jika ada
        $('body').append(response);
        $('#loginModal').modal('show');
      },
      error: function() {
        alert('Error loading login form. Please try again.');
      }
    });
  });
});


$(document).ready(function() {
  $('#loginButton').click(function(e) {
    e.preventDefault(); // Menghentikan aksi default form submit

    // Mengambil nilai input username dan password
    var username = $('#username').val();
    var password = $('#password').val();
    var confirmPassword = $('#confpassword').val();

    // Mengirim data login ke endpoint yang ditentukan
    $.ajax({
      url: 'users/login', // Ubah URL sesuai dengan endpoint yang menangani proses login
      method: 'POST',
      data: {username: username, password: password, confirm_password: confirmPassword},
      success: function(response) {
        // Handle the response from the server
        console.log(response);
        // You can update the UI or redirect the user as needed
      },
      error: function(xhr, status, error) {
        // Handle any errors that occur during the AJAX request
        console.log(xhr.responseText);
      }
    });
  });
});



function openLoginModal() {
  showLoginForm();
  setTimeout(function() {
    $('#loginModal').modal('show');
  }, 230);
}



function showLoginForm() {
  $('#loginModal .modal-dialog').addClass('animated bounceInDown');
}

function shakeModal() {
  $('#loginModal .modal-dialog').addClass('shake');
  $('.error').addClass('alert alert-danger').html("Kombinasi email/password salah");
  $('input[type="password"]').val('');
  setTimeout(function() {
    $('#loginModal .modal-dialog').removeClass('shake');
  }, 1000);
}

$('#loginModal').on('shown.bs.modal', function() {
  $('.modal-content').addClass('animated fadeIn');
});

$('#loginModal').on('hide.bs.modal', function() {
  $('.modal-content').removeClass('animated fadeIn');
});

$('.btn-success').click(function() {
  $(this).addClass('animated bounce');
  setTimeout(function() {
    $('.btn-success').removeClass('animated bounce');
  }, 1000);
});

$('.toggle-password').click(function() {
  var input = $(this).prev('input');
  if (input.attr('type') === 'password') {
    input.attr('type', 'text');
    $(this).addClass('fa-eye-slash').removeClass('fa-eye');
  } else {
    input.attr('type', 'password');
    $(this).addClass('fa-eye').removeClass('fa-eye-slash');
  }
});

$('.toggle-form').click(function() {
  if ($('.loginBox').is(':visible')) {
    showRegisterForm();
  } else {
    showLoginForm();
  }
});