// Function to update chart
function updateChart(chartData) {
    const ctx = document.getElementById('averageSubjectBarChart').getContext('2d');
    if (window.myChart) window.myChart.destroy();

    window.myChart = new Chart(ctx, {
        type: 'bar',
        data: chartData,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        color: 'white', // Legend label color
                        font: {
                            size: 12
                        }
                    }
                },
                title: {
                    display: true,
                    text: 'Quarterly Subject Averages', // Graph title
                    font: {
                        size: 20 // Enlarged title
                    },
                    color: 'white' // Title color
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Subjects',
                        font: {
                            weight: 'bold', // Bold label
                            size: 15
                        },
                        color: 'white' // Label color
                    },
                    ticks: {
                        color: 'white' // Tick labels color
                    },
                    grid: {
                        color: 'gray' // Grid lines color
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Average Grade',
                        font: {
                            weight: 'bold', // Bold label
                            size: 15
                        },
                        color: 'white' // Label color
                    },
                    ticks: {
                        color: 'white' // Tick labels color
                    },
                    grid: {
                        color: 'gray' // Grid lines color
                    },
                    min: 65, // Define the minimum value
                    max: 100, // Define the maximum value
                    beginAtZero: false // Ensure the axis doesn't start at 0
                }
            }
        }
    });
}
