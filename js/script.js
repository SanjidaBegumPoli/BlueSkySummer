// Initialize Flatpickr for date selection
flatpickr("#datepicker", {
  dateFormat: "Y-m-d",
  allowInput: true,
  defaultDate: null,
  minDate: "today"
});

// Initialize Flatpickr for time selection
const tp = flatpickr("#timepicker", {
  enableTime: true,
  noCalendar: true,
  dateFormat: "h:i K",
  time_24hr: false,
  defaultDate: null,
  onReady: function(selectedDates, dateStr, instance) {
    instance.input.setAttribute('placeholder', 'Select time');
  }
});

// Clock icon opens the timepicker
document.addEventListener("DOMContentLoaded", function () {
  const clockIcon = document.getElementById("clockIcon");
  if (clockIcon) {
    clockIcon.addEventListener("click", function () {
      tp.open();
    });
  }
});