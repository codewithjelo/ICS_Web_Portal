document.addEventListener("DOMContentLoaded", function () {
  // Default data to show when no section is selected
  function loadDefaultGraph() {
    const defaultChartData = {
      labels: ['Default Subject'], // Example subjects
      datasets: [
        {
          label: "First Quarter",
          data:  [60, 60, 60, 60], // Default data
          backgroundColor: "#FFE17A",
          borderWidth: 1,
        },
        {
          label: "Second Quarter",
          data: [60, 60, 60, 60], // Default data
          backgroundColor: "#FFCD4B",
          borderWidth: 1,
        },
        {
          label: "Third Quarter",
          data: [60, 60, 60, 60], // Default data
          backgroundColor: "#FFB500",
          borderWidth: 1,
        },
        {
          label: "Fourth Quarter",
          data: [60, 60, 60, 60], // Default data
          backgroundColor: "#B3892F",
          borderWidth: 1,
        },
      ],
    };

    updateChart(defaultChartData); // Show default graph
  }

  // Initial load with default data
  loadDefaultGraph();

  
  });
