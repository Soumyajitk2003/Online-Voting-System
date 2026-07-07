function startTimers() {
  const loginButton = document.getElementById('login-btn');
  const loginTimer = document.getElementById('login-timer');
  const registerButton = document.getElementById('register-btn');
  const registerTimer = document.getElementById('register-timer');

  const now = new Date().getTime();
  const registerEndDate = new Date('june 25, 2024 14:18:00').getTime(); // Set your registration end date
  const loginEndDate = new Date('July 02, 2024 00:00:00').getTime(); // Set login end date

  function updateTimers() {
      const now = new Date().getTime();

      // Update registration timer
      const registerTimeLeft = registerEndDate - now;
      if (registerTimeLeft <= 0) {
          registerButton.disabled = true;
          registerTimer.innerHTML = "Registration End!";
          loginButton.disabled = false; // Enable the login button
      } else {
          const registerDays = Math.floor(registerTimeLeft / (1000 * 60 * 60 * 24));
          const registerHours = Math.floor((registerTimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const registerMinutes = Math.floor((registerTimeLeft % (1000 * 60 * 60)) / (1000 * 60));
          const registerSeconds = Math.floor((registerTimeLeft % (1000 * 60)) / 1000);
          registerTimer.innerHTML = `${registerDays}d ${registerHours}h ${registerMinutes}m ${registerSeconds}s`;
      }

      // Update login timer
      if (!registerButton.disabled) {
          loginButton.disabled = true; // Ensure login button is disabled while registration is open
      } else {
          const loginTimeLeft = loginEndDate - now;
          if (loginTimeLeft <= 0) {
              loginButton.disabled = true;
              loginTimer.innerHTML = "Vote End!";
          } else {
              const loginDays = Math.floor(loginTimeLeft / (1000 * 60 * 60 * 24));
              const loginHours = Math.floor((loginTimeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
              const loginMinutes = Math.floor((loginTimeLeft % (1000 * 60 * 60)) / (1000 * 60));
              const loginSeconds = Math.floor((loginTimeLeft % (1000 * 60)) / 1000);
              loginTimer.innerHTML = `${loginDays}d ${loginHours}h ${loginMinutes}m ${loginSeconds}s`;
          }
      }
  }

  // Initially disable the login button
  loginButton.disabled = true;

  // Start the timer updates
  setInterval(updateTimers, 1000);
}

window.onload = startTimers;
