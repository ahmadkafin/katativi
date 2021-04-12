// Charts
//-------------
//- DONUT CHART - 
//-------------
var color_donut =[];
for(var i = 0; i < (data.klik).length; i++) {
    color_donut.push('#' + Math.floor(Math.random()*16777215).toString(16));
}
var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
let chart_donut = new Chart(donutChartCanvas, {
    type: 'pie',
    data: {
        datasets: [
            {
                data: data.klik,
                backgroundColor : color_donut,
            }
        ],
        labels: data.label,
    },
    options: {
        responsive              : true,
        maintainAspectRatio     : false,
    }
});

var color_bar =[];
for(var i = 0; i < (data.count_vis_tot).length; i++) {
    color_bar.push('#' + Math.floor(Math.random()*16777215).toString(16));
}
//-------------
//- BAR CHART -
//-------------
var barChartCanvas = $('#barChart').get(0).getContext('2d')
var maxDataVis = Math.max(...data.count_vis_tot);
let chart = new Chart(barChartCanvas, {
    type: 'bar',
    data: {
        datasets: [
            {
                data: data.count_vis_tot,
                backgroundColor : color_bar,
                barThickness: 10,
                maxBarThickness: 15,
                minBarLength: 2,
            }
        ],
        labels:data.count_vis_kota,
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    suggestedMax: maxDataVis,
                }
            }]
        },
        base: 0,
        responsive              : true,
        maintainAspectRatio     : false,
        datasetFill             : true
    }
});


// MAPS
var latlng = [0.7893, 113.9213];
// var locations = [
//     ["LOCATION_1", -6.920818199999999,107.5874103],
//     ["LOCATION_2", -6.948764700352681,107.75323519013672],
//     ["LOCATION_3", -7.048949453944093,107.59702333710938],
//     ["LOCATION_4", -7.198164034656903,107.55479463837891]
// ]
var locations = data.loc;
var mymap = L.map('dashboard-map').setView(latlng, 3);
mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; ' + mapLink + ' Contributors',
    maxZoom: 18,
}).addTo(mymap);
for (var i = 0; i < locations.length; i++) {
    marker = new L.marker([locations[i]['lat'], locations[i]['lng']])
        .bindPopup(locations[i]['ip_visitor'] + '\r\n' + locations[i]['negara'])
        .addTo(mymap);
}