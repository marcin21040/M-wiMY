const przyciskFiszki = document.querySelector('.guzik-fiszki');
const wrapperFiszki = document.querySelector('.kategorie-fiszek__wrapper');

przyciskFiszki.addEventListener('click', () => {
  wrapperFiszki.style.display = 'flex';
});

function showDick() {
    // document.getElementById("hiddentext").innerHTML = "In northern India, they celebrate the story of King Rama's return to Ayodhya after he defeated Ravana by lighting rows of clay lamps. Southern India celebrates it as the day that Lord Krishna defeated the demon Narakasura. Diwali symbolizes the victory of light over darkness and good over evil.";
    wrapperFiszki.style.display = 'flex';
    alert('twojstary');
}