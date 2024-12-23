<?php
$cardHeight = '450px';
?>
<div class="d-flex justify-content-between gap-3">
    <div class="card p-3 shadow" style="height: <?= $cardHeight ?>; width: 40%">
        <canvas id="gender-chart" style="height: 100%" ></canvas>
    </div>
    <div class="card flex-grow-1 p-3 shadow" style="height: <?= $cardHeight ?>">
        <canvas id="designation-chart" style="height: 100%"></canvas>
    </div>
</div>

<div class="row mt-3">
    <div class="search-form w-100">
        <input class="p-3 w-100" type="text" id="department-filter" placeholder="Filter by Designation">
    </div>
    <div id="grid-container">
        <?= \yii\grid\GridView::widget([
            'id' => 'department-grid',
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'name',
                    'label' => 'Department',
                    'format' => 'raw',
                    'value' => function($model){
                        return \yii\helpers\Html::a($model['name'], ['/employee/index', 'EmployeeSearch' => ['department' => $model['id']]]);
                    }
                ],
                [
                    'attribute' => 'count',
                    'label' => 'Total Employees',
                ],
            ],
        ]); ?>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.js"
        integrity="sha256-/tanOfjQ8GhxdN5s0UdF/A/HgJFEqxE9IpCKJr8Nf+o=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


<script>

    const designationChart = document.getElementById('designation-chart').getContext('2d');
    const designationData = <?= json_encode($designationData) ?>;
    const designationLabels = designationData.map(item => {
        return item.name;
    });
    const designationCount = designationData.map(item => {
        return item.count;
    });

    new Chart(designationChart, {
        type: 'bar',
        data: {
            labels: designationLabels,
            datasets: [
                {
                    label: 'Designations',
                    data: designationCount,
                    backgroundColor: ['#9aa88c', '#8ca8a8', '#9a8ca8', '#aaaaaa', '#697f85', '#7a7290', '#497c9d'],
                    borderColor: '#4549ff',
                    borderWidth: 0,
                },
            ]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                datalabels: {
                    anchor: 'end', // Position at the top of the bar
                    align: 'end', // Align the label above the top
                    offset: 0, // Move label slightly above the top of the bar
                    clip: false, // Ensure label is not clipped (visible outside chart area)
                    color: 'rgba(0,0,0,0.38)', // Color of the labels
                    font: {
                        weight: 'bold',
                    },
                    formatter: function (value) {
                        return value; // Display the actual data value
                    }
                },
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                y: {
                    stacked: false,
                    barPercentage: 0.3, // Adjust width of bars
                    categoryPercentage: 0.8 // Adjust width of groups
                },
                x: {
                    stacked: false,
                    beginAtZero: true,
                    max: function () {
                        const maxValue = Math.max(...designationCount);
                        const roundedMax = Math.ceil((maxValue + 40) / 10) * 10;
                        return roundedMax;
                    }(),
                }
            }
        },
        plugins: [ChartDataLabels] // Add this line to include the plugin
    });




    const papersByStatus = document.getElementById('gender-chart').getContext('2d');
    const statusData = <?= json_encode($genderData) ?>;
    let genderData = [];
    statusData.forEach(item => {
        switch (item.gender) {
            case 'Male':
                genderData[0] = item.count;
                break;
            case 'Female':
                genderData[1] = item.count;
                break;
            case 'Other':
                genderData[2] = item.count;
                break;
            default:
                break;
        }
    })
    new Chart(papersByStatus, {
        type: 'bar',
        data: {
            labels: ['Male', 'Female', 'Other'],
            datasets: [
                {
                    label: 'Gender',
                    data: genderData,
                    backgroundColor: ['#9aa88c', '#8ca8a8', '#9a8ca8', '#aaaaaa', '#697f85', '#7a7290', '#497c9d'],
                    borderColor: '#4549ff',
                    borderWidth: 0,
                },
            ]
        },
        options: {
            indexAxis: 'x',
            responsive: true,
            plugins: {
                datalabels: {
                    anchor: 'end', // Position at the top of the bar
                    align: 'end', // Align the label above the top
                    offset: 0, // Move label slightly above the top of the bar
                    clip: false, // Ensure label is not clipped (visible outside chart area)
                    color: 'rgba(0,0,0,0.38)', // Color of the labels
                    font: {
                        weight: 'bold',
                    },
                    formatter: function (value) {
                        return value; // Display the actual data value
                    }
                },
                legend: {
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function (context) {
                            let label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.parsed.y !== null) {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    stacked: false,
                    barPercentage: 0.3, // Adjust width of bars
                    categoryPercentage: 0.8 // Adjust width of groups
                },
                y: {
                    stacked: false,
                    beginAtZero: true,
                    max: function () {
                        const maxValue = Math.max(...genderData);
                        const roundedMax = Math.ceil((maxValue + 40) / 10) * 10;
                        return roundedMax;
                    }(),
                }
            }
        },
        plugins: [ChartDataLabels] // Add this line to include the plugin
    });




    document.addEventListener('DOMContentLoaded', function () {
        const fullData = <?= json_encode($fullDataProvider->getModels()) ?>;
        const gridContainer = document.getElementById('grid-container');

        // keeping original data of gridview to revert back if search filter is empty
        let originalHtml = gridContainer.innerHTML;

        function filterGridView() {
            const filterValue = document.getElementById('department-filter').value.toLowerCase();

            // putting paginated gridview data back into the table
            if (filterValue === '') {
                gridContainer.innerHTML = originalHtml;
                return;
            }

            // preparing filtered data
            const filteredData = fullData.filter(item => {
                const designation = item['name']; // Ensure this matches the correct key in your data
                return typeof designation === 'string' && designation.toLowerCase().includes(filterValue);
            });

            // putting filtered data into the table
            const filteredHtml = generateGridViewHtml(filteredData);
            gridContainer.innerHTML = filteredHtml;
        }

        function generateGridViewHtml(data) {
            let html = '<table class="table table-striped"><thead><tr>';
            html += '<th>Name</th><th>Total</th></tr></thead><tbody>';
            data.forEach(item => {
                html += '<tr>';
                html += `<td>${item['name']}</td>`;
                html += `<td>${item['count']}</td>`;
                html += '</tr>';
            });
            html += '</tbody></table>';
            return html;
        }

        document.getElementById('department-filter').addEventListener('input', filterGridView);

    });


</script>