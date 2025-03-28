<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-12">
            <h3>Reservas por Mes</h3>
            <div class="chart-container" style="position: relative; width: 80vw; height: 60vh;">
                <canvas id="graficaReservas"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Script para Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('graficaReservas').getContext('2d');
    var reservasData = @json($reservasPorMes);

    var meses = reservasData.map(function(reserva) {
        return reserva.mes + '/' + reserva.ano;
    });

    var totales = reservasData.map(function(reserva) {
        return reserva.total;
    });

    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(54, 162, 235, 0.7)');
    gradient.addColorStop(1, 'rgba(54, 162, 235, 0.1)');

    var chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: meses,
            datasets: [{
                label: 'Total de dinero por mes',
                data: totales,
                backgroundColor: gradient,
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            animation: {
                duration: 1500,
                easing: 'easeInOutBounce'
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 14
                        },
                        color: '#333'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(200, 200, 200, 0.3)'
                    },
                    ticks: {
                        font: {
                            size: 14
                        },
                        color: '#333'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    labels: {
                        font: {
                            size: 16
                        },
                        color: '#333'
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.7)',
                    titleFont: {
                        size: 16
                    },
                    bodyFont: {
                        size: 14
                    },
                    padding: 12
                }
            }
        }
    });
</script>
