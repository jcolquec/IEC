// script.js
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.map(item => item.ANIO),
        datasets: [{
            label: 'Indicador de Extremo Climático FD',
            data: chartData.map(item => item.DIAS_HELADOS),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 8
        }]
    },
    options: {
        responsive: true, // Permite que el gráfico sea responsivo
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

