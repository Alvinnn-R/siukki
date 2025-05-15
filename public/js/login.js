const loginForm = document.getElementById('loginForm');
const npmInput    = document.getElementById('npm');
const pwdInput    = document.getElementById('password');
const errorMsg    = document.getElementById('errorMsg');

loginForm.addEventListener('submit', function(e) {
  // Ambil nilai
  const npm      = npmInput.value.trim();
  const password = pwdInput.value.trim();

  // Bersihkan error
  errorMsg.classList.remove('show');
  npmInput.classList.remove('invalid');
  pwdInput.classList.remove('invalid');

  // Validasi sederhana (contoh)
  const VALID_NPM      = '23081010021';
  const VALID_PASSWORD = 'password123';

  if (npm !== VALID_NPM || password !== VALID_PASSWORD) {
    e.preventDefault(); // cegah submit
    npmInput.classList.add('invalid');
    pwdInput.classList.add('invalid');
    errorMsg.classList.add('show');
  }
  // Kalau valid, biarkan form submit ke backend
});
