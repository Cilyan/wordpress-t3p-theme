import $ from 'jquery';

// https://github.com/uxitten/polyfill/blob/master/string.polyfill.js
// https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Global_Objects/String/padStart
if (!String.prototype.padStart) {
  String.prototype.padStart = function padStart(targetLength,padString) {
    targetLength = targetLength>>0; //truncate if number or convert non-number to 0;
    padString = String((typeof padString !== 'undefined' ? padString : ' '));
    if (this.length > targetLength) {
      return String(this);
    }
    else {
      targetLength = targetLength-this.length;
      if (targetLength > padString.length) {
        padString += padString.repeat(targetLength/padString.length); //append to original to ensure we are longer than needed
      }
      return padString.slice(0,targetLength) + String(this);
    }
  };
}

var t3p_counter_days = null;
var t3p_counter_hours = null;
var t3p_counter_minutes = null;
var t3p_counter_seconds = null;
var t3p_counter_interval = null;
var t3p_counter_label = null;
var t3p_start_timestamp = parseInt(countdown_props.start_timestamp, 10)

$(document).ready(function () {
  t3p_counter_days = $('#t3p-counter-days');
  t3p_counter_hours = $('#t3p-counter-hours');
  t3p_counter_minutes = $('#t3p-counter-minutes');
  t3p_counter_seconds = $('#t3p-counter-seconds');
  t3p_counter_label = $('#counter-label');

  t3p_counter_interval = setInterval(onCountdownTick, 500);
});

function onCountdownTick() {
  var days, hours, minutes, seconds;
  var now = $.now();
  var diff = t3p_start_timestamp - $.now() + 999; // Adding 1 second, because it is floored down

  if (diff < 1000) {
    hours = minutes = seconds = "00";
    days = 0;
    t3p_counter_label.text(countdown_props.label_started)
    clearInterval(t3p_counter_interval);
  }
  else {
    days = Math.floor(diff / (1000 * 60 * 60 * 24)).toString();
    hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)).toString().padStart(2, "0");
    minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60)).toString().padStart(2, "0");
    seconds = Math.floor((diff % (1000 * 60)) / 1000).toString().padStart(2, "0");
  }

  t3p_counter_days.text(days);
  t3p_counter_hours.text(hours);
  t3p_counter_minutes.text(minutes);
  t3p_counter_seconds.text(seconds);
}
