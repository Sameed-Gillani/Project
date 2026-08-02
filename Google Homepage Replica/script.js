const searchForm = document.getElementById('searchForm');
const searchInput = document.getElementById('searchInput');
const luckyBtn = document.getElementById('luckyBtn');
const appsIcon = document.getElementById('appsIcon');
const avatar = document.getElementById('avatar');
searchForm.addEventListener('submit', function (e) {
  e.preventDefault();
  const query = searchInput.value.trim();
  if (query) {
    window.open('https://www.google.com/search?q=' + encodeURIComponent(query), '_blank');
  } else {
    searchInput.focus();
  }
});
luckyBtn.addEventListener('click', function () {
  const query = searchInput.value.trim();
  if (query) {
    window.open('https://www.google.com/search?q=' + encodeURIComponent(query) + '&btnI=1', '_blank');
  } else {
    searchInput.focus();
  }
});
appsIcon.addEventListener('click', function () {
  alert('Google apps (for reference only)');
});
avatar.addEventListener('click', function () {
  alert('Account (for reference only)');
});