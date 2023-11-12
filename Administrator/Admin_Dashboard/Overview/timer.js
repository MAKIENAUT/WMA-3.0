
let timerElement = document.getElementById('timer');
let timerInterval;
let timerDuration = 30 * 60; // 30 minutes in seconds

function updateTimer() {
   let minutes = Math.floor(timerDuration / 60);
   let seconds = timerDuration % 60;
   timerElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
}

function startTimer() {
   timerInterval = setInterval(function () {
      timerDuration--;
      if (timerDuration <= 0) {
         clearInterval(timerInterval);
         timerElement.textContent = 'Time\'s up!';
         window.location.href = '../../Admin_Commands/admin_logout.php';
      } else {
         updateTimer();
      }
   }, 1000);
}

function restartTimer() {
   clearInterval(timerInterval);
   timerDuration = 30 * 60;
   startTimer();
}

startTimer();
