const alerts = document.querySelectorAll(".alert");

alerts.forEach((alert, index) => {
  if (alert) {
    setTimeout(() => {
      alert.remove();
    }, 4000);
  }
});
