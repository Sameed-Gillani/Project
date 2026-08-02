const daySelect = document.getElementById('birthDay');
const monthSelect = document.getElementById('birthMonth');
const yearSelect = document.getElementById('birthYear');
for (let d = 1; d <= 31; d++) {
  const opt = document.createElement('option');
  opt.value = d;
  opt.textContent = d;
  if (d === 25) opt.selected = true;
  daySelect.appendChild(opt);
}
const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
months.forEach((m, i) => {
  const opt = document.createElement('option');
  opt.value = i + 1;
  opt.textContent = m;
  if (m === 'May') opt.selected = true;
  monthSelect.appendChild(opt);
});
const currentYear = new Date().getFullYear();
for (let y = currentYear; y >= currentYear - 100; y--) {
  const opt = document.createElement('option');
  opt.value = y;
  opt.textContent = y;
  if (y === 2005) opt.selected = true;
  yearSelect.appendChild(opt);
}
const loginForm = document.getElementById('loginForm');
loginForm.addEventListener('submit', function (e) {
  e.preventDefault();
  const email = document.getElementById('loginEmail').value.trim();
  const password = document.getElementById('loginPassword').value.trim();
  if (!email || !password) {
    alert('Please fill in both Email/Phone and Password.');
    return;
  }
  alert('Login Successful .');
});
const signupForm = document.getElementById('signupForm');
signupForm.addEventListener('submit', function (e) {
  e.preventDefault();
  const firstName = document.getElementById('firstName').value.trim();
  const surname = document.getElementById('surname').value.trim();
  const contact = document.getElementById('contact').value.trim();
  const password = document.getElementById('newPassword').value.trim();
  const gender = document.querySelector('input[name="gender"]:checked');
  if (!firstName || !surname || !contact || !password) {
    alert('Please fill in all required fields.');
    return;
  }
  const birthday = `${daySelect.value}/${monthSelect.value}/${yearSelect.value}`;
  alert(
    'Account Created:\n' +
    `Name: ${firstName} ${surname}\n` +
    `Contact: ${contact}\n` +
    `Birthday: ${birthday}\n` +
    `Gender: ${gender ? gender.value : 'Not specified'}`
  );
});