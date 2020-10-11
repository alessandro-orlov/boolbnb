var $ = require( "jquery" );

$(document).ready(function() {
  moment.locale('it');

  // TEST!!! - Visite Settimanali ======================================
  // Variables periods
//   var weekVisits = document.getElementById('weekly-visits').innerHTML;
var thisDay = document.getElementById('this-day').innerHTML;
var yesterday = document.getElementById('yesterday').innerHTML;
var twoDaysAgo = document.getElementById('two-days-ago').innerHTML;
var threeDaysAgo = document.getElementById('three-days-ago').innerHTML;
var fourDaysAgo = document.getElementById('four-days-ago').innerHTML;
var fiveDaysAgo = document.getElementById('five-days-ago').innerHTML;
var sixDaysAgo = document.getElementById('six-days-ago').innerHTML;

// console.log('thisDay: ' + thisDay);
// console.log('yesterday: ' + yesterday);
// console.log('threeDaysAgo: ' + threeDaysAgo);
// console.log('fourDaysAgo: ' + fourDaysAgo);
// console.log('fiveDaysAgo: ' + fiveDaysAgo);
// console.log('sixDaysAgo: ' + sixDaysAgo);

var dayToday = moment().format('dddd');
var dayYesterday = moment().day(-1).format('dddd');
var dayTwoDaysAgo = moment().day(-2).format('dddd');
var dayThreeDaysAgo = moment().day(-3).format('dddd');
var dayFoueDaysAgo = moment().day(-4).format('dddd');
var dayFiveDaysAgo = moment().day(-5).format('dddd');
var daySixDaysAgo = moment().day(-6).format('dddd');


  var ctx = document.getElementById('myChartWeekly').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: [
            daySixDaysAgo,
            dayFiveDaysAgo,
            dayFoueDaysAgo,
            dayThreeDaysAgo,
            dayTwoDaysAgo,
            dayYesterday,
            dayToday,
          ],
          datasets: [{
              label: '# Ultimi 7 giorni',
              data: [
                  sixDaysAgo,
                  fiveDaysAgo,
                  fourDaysAgo,
                  threeDaysAgo,
                  twoDaysAgo,
                  yesterday,
                  thisDay,
              ],
              backgroundColor: [
                'rgba(255, 48, 92, 0)',
                //   'rgba(255, 99, 132, 0.2)',
                //   'rgba(54, 162, 235, 0.2)',
                //   'rgba(255, 206, 86, 0.2)',
                //   'rgba(75, 192, 192, 0.2)',
                //   'rgba(153, 102, 255, 0.2)',
                //   'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                'rgba(241, 0, 49, 1)',
                //   'rgba(54, 162, 235, 1)',
                //   'rgba(255, 206, 86, 1)',
                //   'rgba(75, 192, 192, 1)',
                //   'rgba(153, 102, 255, 1)',
                //   'rgba(255, 159, 64, 1)'
              ],
              pointBackgroundColor:'rgba(241, 0, 49, 1)',
              borderWidth: 3
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });


  // Visite Mensili ======================================
  // Variables periods
  // var monthVisits = document.getElementById('monthly-visits').innerHTML;
  var jan = document.getElementById('january').innerHTML;
  var feb = document.getElementById('february').innerHTML;
  var mar = document.getElementById('march').innerHTML;
  var apr = document.getElementById('april').innerHTML;
  var may = document.getElementById('may').innerHTML;
  var jun = document.getElementById('june').innerHTML;
  var jul = document.getElementById('july').innerHTML;
  var aug = document.getElementById('august').innerHTML;
  var sep = document.getElementById('september').innerHTML;
  var oct = document.getElementById('october').innerHTML;
  var nov = document.getElementById('november').innerHTML;
  var dec = document.getElementById('december').innerHTML;

//   console.log(monthVisits);
  var ctx = document.getElementById('myChartMonths').getContext('2d');
  var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno', 'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'],
          datasets: [{
              label: '# Visite dell\'anno',
              data: [
                  jan,
                  feb,
                  mar,
                  apr,
                  may,
                  jun,
                  jul,
                  aug,
                  sep,
                  oct,
                  nov,
                  dec,
                ],
              backgroundColor: [
                  'rgba(255, 48, 92, 0)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
                //   'rgba(255, 48, 92, 0.6)',
              ],
              borderColor: [
                'rgba(241, 0, 49, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
                //   'rgba(255, 99, 132, 1)',
              ],
              pointBackgroundColor:'rgba(241, 0, 49, 1)',
              borderWidth: 3
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });


}); // End document ready
