<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>실시간 차트 업데이트</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let chart1, chart2, chart3;

        // 차트 생성 함수
        function createChart(canvasId) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['00', '01', '02', '03', '04'],
                    datasets: [{
                        label: `Data for ${canvasId}`,
                        data: [0, 0, 0, 0, 0],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                        }
                    },
                    scales: {
                        x: { display: true },
                        y: { display: true, beginAtZero: true }
                    }
                }
            });
        }

        // 차트를 업데이트하는 함수
        function updateChart(chart, newData) {
            chart.data.datasets[0].data.shift(); // 가장 오래된 데이터 제거
            chart.data.datasets[0].data.push(newData); // 새로운 데이터 추가
            chart.update(); // 차트 갱신
        }

        // 1초마다 데이터를 가져와 차트를 업데이트
        function fetchAndUpdateCharts() {
            fetch('jsonprocess.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('네트워크 응답에 문제가 있습니다.');
                    }
                    return response.json(); // JSON 형식으로 변환
                })
                .then(data => {
                    updateChart(chart1, data.data0); // 차트 1 업데이트
                    updateChart(chart2, data.data1); // 차트 2 업데이트
                    updateChart(chart3, data.data2); // 차트 3 업데이트
                })
                .catch(error => {
                    console.error('Fetch 오류:', error);
                });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // 차트 초기화
            chart1 = createChart('lineChart1');
            chart2 = createChart('lineChart2');
            chart3 = createChart('lineChart3');

            // 1초마다 fetchAndUpdateCharts 호출
            setInterval(fetchAndUpdateCharts, 1000);
        });
    </script>
</head>
<body>
    <h1>실시간 차트</h1>
    <div style="display: flex; gap: 20px;">
        <canvas id="lineChart1" width="400" height="200"></canvas>    
    </div>
    <div style="display: flex; gap: 20px;">        
        <canvas id="lineChart2" width="400" height="200"></canvas>        
    </div>
    <div style="display: flex; gap: 20px;">        
        <canvas id="lineChart3" width="400" height="200"></canvas>
    </div>

</body>
</html>
