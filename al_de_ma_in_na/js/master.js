//js
document.querySelector('.logout').addEventListener('click', (e) => {
  e.preventDefault()
  console.log('me')
  window.location = 'http://localhost/bowen/al_de_ma_in_na/action.php?logout=1&jsDoc=bowen'
});
