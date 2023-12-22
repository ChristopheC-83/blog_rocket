
// les alertes s'effacent au bout de 3 secondes
const alerts = document.querySelectorAll(".alert");

alerts.forEach((alert, index) => {
  if (alert) {
    setTimeout(() => {
      alert.remove();
    }, 300000);
  }
});

// tooltip
var tooltipTriggerList = [].slice.call(
  document.querySelectorAll('[data-bs-toggle="tooltip"]')
);
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl);
});
