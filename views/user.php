<?php
session_start();
if ($_SESSION['role'] !== 'user') {
    header('Location: login.php');
    exit;
}

include("../includes/header.php");
include("../includes/navuser.php");
?>




<div class="container">
    <div class="row">
        <div class="col-md-4">
            <canvas id="populationChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="voterStatusChart"></canvas>
        </div>
        <div class="col-md-4">
            <canvas id="employmentChart"></canvas>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-7">
            <canvas id="educationChart"></canvas>
        </div>
        <div class="col-md-5">
            <canvas id="vaccinationChart"></canvas>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-6">
            <canvas id="bloodTypeChart"></canvas>
        </div>
        <div class="col-md-6">
            <canvas id="beneficiaryProgramChart"></canvas>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-7">
            <canvas id="dwellingTypeChart"></canvas>
        </div>
        <div class="col-md-5">
            <canvas id="seniorCitizenChart"></canvas>
        </div>
    </div>

</div>



<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Fetch data dynamically from your backend using PHP or an AJAX request
    fetch('../ajax/fetch_dashboard_population.php')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.year);
            const population = data.map(item => item.population);

            // Get the context for the chart
            const ctx = document.getElementById('populationChart').getContext('2d');

            // Create the chart
            const populationChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Population Size',
                        data: population,
                        backgroundColor: 'rgba(54, 162, 235, 0.6)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>

<script>
    fetch('../ajax/fetch_dashboard_voters.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = [...new Set(data.map(item => item.year))];
            const registered = years.map(year => {
                const record = data.find(item => item.year == year && item.voter_status == "Registered");
                return record ? record.count : 0;
            });
            const unregistered = years.map(year => {
                const record = data.find(item => item.year == year && item.voter_status == "Unregistered");
                return record ? record.count : 0;
            });

            // Create the chart
            const ctx = document.getElementById('voterStatusChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years,
                    datasets: [
                        {
                            label: 'Registered Voters',
                            data: registered,
                            backgroundColor: 'rgba(75, 192, 192, 0.6)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Unregistered Voters',
                            data: unregistered,
                            backgroundColor: 'rgba(255, 99, 132, 0.6)',
                            borderColor: 'rgba(255, 99, 132, 1)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>



<script>
    fetch('../ajax/fetch_dashboard_employment_status.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = [...new Set(data.map(item => item.year))]; // Unique years
            const statuses = ['Employed', 'Unemployed', 'Retired', 'Student']; // Defined statuses

            // Prepare datasets for each status
            const datasets = statuses.map(status => {
                return {
                    label: status,
                    data: years.map(year => {
                        const record = data.find(item => item.year == year && item.employment_status == status);
                        return record ? record.count : 0; // Default to 0 if no data
                    }),
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                };
            });

            // Generate the chart
            const ctx = document.getElementById('employmentChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years, // Dynamic year labels
                    datasets: datasets // Dynamic datasets for statuses
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    // Helper function to generate random colors
    function getRandomColor() {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    }
</script>


<script>
    fetch('../ajax/fetch_dashboard_educational_attainment.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = [...new Set(data.map(item => item.year))]; // Extract unique years
            const categories = [
                'No Formal Education',
                'Elementary',
                'High School',
                'Vocational',
                'College Level',
                'College Graduate',
                'Postgraduate'
            ]; // Educational attainment categories

            // Prepare datasets for each year
            const datasets = years.map(year => {
                return {
                    label: `Year ${year}`,
                    data: categories.map(category => {
                        const record = data.find(item => item.year == year && item.educational_attainment == category);
                        return record ? record.count : 0; // Default to 0 if no data
                    }),
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                };
            });

            // Generate the horizontal bar chart
            const ctx = document.getElementById('educationChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: categories, // X-axis labels (educational levels)
                    datasets: datasets // Datasets for each year
                },
                options: {
                    indexAxis: 'y', // Horizontal bar chart
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    // Helper function to generate random colors
    function getRandomColor() {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    }
</script>



<script>
    fetch('../ajax/fetch_dashboard_vaccination_status.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = [...new Set(data.map(item => item.year))]; // Extract unique years
            const statuses = ['Fully Vaccinated', 'Partially Vaccinated', 'Not Vaccinated']; // Vaccination statuses

            // Prepare datasets for each year
            const datasets = years.map(year => {
                return {
                    label: `Year ${year}`,
                    data: statuses.map(status => {
                        const record = data.find(item => item.year == year && item.vaccination_status == status);
                        return record ? record.count : 0; // Default to 0 if no data
                    }),
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                };
            });

            // Generate the horizontal bar chart
            const ctx = document.getElementById('vaccinationChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: statuses, // X-axis labels (vaccination statuses)
                    datasets: datasets // Datasets for each year
                },
                options: {
                    indexAxis: 'y', // Horizontal bar chart
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    // Helper function to generate random colors
    function getRandomColor() {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    }
</script>

<script>
    fetch('../ajax/fetch_dashboard_blood_type.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = [...new Set(data.map(item => item.year))]; // Extract unique years
            const bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-', 'N/A']; // Blood types

            // Prepare datasets for each year
            const datasets = years.map(year => {
                return {
                    label: `Year ${year}`,
                    data: bloodTypes.map(type => {
                        const record = data.find(item => item.year == year && item.blood_type == type);
                        return record ? record.count : 0; // Default to 0 if no data
                    }),
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                };
            });

            // Generate the column chart
            const ctx = document.getElementById('bloodTypeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bloodTypes, // X-axis labels (blood types)
                    datasets: datasets // Datasets for each year
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    // Helper function to generate random colors
    function getRandomColor() {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    }
</script>


<script>
    fetch('../ajax/fetch_dashboard_beneficiary_program.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = [...new Set(data.map(item => item.year))]; // Extract unique years
            const programs = [
                '4Ps', 
                'Senior Citizen Pension', 
                'Scholarship', 
                'Livelihood Assistance', 
                'Calamity Assistance', 
                'PWD Assistance', 
                'Solo Parent Assistance', 
                'Other'
            ]; // Beneficiary program categories

            // Prepare datasets for each year
            const datasets = years.map(year => {
                return {
                    label: `Year ${year}`,
                    data: programs.map(program => {
                        const record = data.find(item => item.year == year && item.beneficiary_program == program);
                        return record ? record.count : 0; // Default to 0 if no data
                    }),
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                };
            });

            // Generate the column chart
            const ctx = document.getElementById('beneficiaryProgramChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: programs, // X-axis labels (beneficiary programs)
                    datasets: datasets // Datasets for each year
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    // Helper function to generate random colors
    function getRandomColor() {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    }
</script>


<script>
    fetch('../ajax/fetch_dashboard_type_of_dwelling.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = [...new Set(data.map(item => item.year))]; // Extract unique years
            const dwellingTypes = ['Owned', 'Rented', 'Government Housing', 'Other']; // Dwelling categories

            // Prepare datasets for each year
            const datasets = years.map(year => {
                return {
                    label: `Year ${year}`,
                    data: dwellingTypes.map(type => {
                        const record = data.find(item => item.year == year && item.type_of_dwelling == type);
                        return record ? record.count : 0; // Default to 0 if no data
                    }),
                    backgroundColor: getRandomColor(),
                    borderColor: 'rgba(0, 0, 0, 0.1)',
                    borderWidth: 1
                };
            });

            // Generate the column chart
            const ctx = document.getElementById('dwellingTypeChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: dwellingTypes, // X-axis labels (dwelling types)
                    datasets: datasets // Datasets for each year
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));

    // Helper function to generate random colors
    function getRandomColor() {
        const r = Math.floor(Math.random() * 255);
        const g = Math.floor(Math.random() * 255);
        const b = Math.floor(Math.random() * 255);
        return `rgba(${r}, ${g}, ${b}, 0.6)`;
    }
</script>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    fetch('../ajax/fetch_dashboard_senior_citizen_sixtyup.php')
        .then(response => response.json())
        .then(data => {
            // Process data for the chart
            const years = data.map(item => item.year); // Extract years
            const seniorCounts = data.map(item => item.senior_count); // Extract senior citizen counts

            // Generate the column chart
            const ctx = document.getElementById('seniorCitizenChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: years, // X-axis labels (years)
                    datasets: [{
                        label: 'Senior Citizen Population (60+)',
                        data: seniorCounts, // Y-axis data
                        backgroundColor: 'rgba(75, 192, 192, 0.6)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
</script>












<?php
include("../includes/footer.php");
?>
