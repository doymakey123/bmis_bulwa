fetch('../ajax/fetch_dashboard_population.php')
    .then(response => response.json())
    .then(data => {
        const labels = data.map(item => item.year);
        const population = data.map(item => item.population);

        // Update the chart data dynamically
        populationChart.data.labels = labels;
        populationChart.data.datasets[0].data = population;
        populationChart.update();
    });
