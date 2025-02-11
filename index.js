        let chart1, chart2, chart3;
        let data88, data99;

        function createChart(canvasId) {
            const ctx = document.getElementById(canvasId).getContext('2d');
            let borderColor;
        
            // 그래프에 따라 색상 설정
            switch (canvasId) {
                case 'Voltage':
                    borderColor = 'rgb(99, 167, 255)'; // 민트색
                    break;
                case 'Current':
                    borderColor = 'rgba(255, 99, 132, 1)'; // 핑크색
                    break;
                case 'Flow':
                    borderColor = 'rgb(235, 172, 54)'; // 파란색
                    break;
                default:
                    borderColor = '#7aba25'; // 기본 색상
            }
        
            return new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        '01', '02', '03', '04', '05',
                        '06', '07', '08', '09', '10',
                        '11', '12', '13', '14', '15',
                        '16', '17', '18', '19', '20',
                        '21', '22', '23', '24', '25',
                        '26', '27', '28', '29', '30'
                    ],
                    datasets: [{
                        label: `${canvasId}`,
                        data: Array(30).fill(0), // 초기 데이터 배열
                        borderColor: borderColor,
                        borderWidth: 2,
                        fill: false,
                        // pointRadius: 0, // 포인트 제거
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.9)',
                            borderColor: borderColor,
                            borderWidth: 1,
                        }
                    },
                    scales: {
                        x: {
                            display: true,
                            grid: {
                                display: false // X축 격자 숨기기
                            }
                        },
                        y: {
                            display: true,
                            beginAtZero: false,
                            min: 0,
                            max: 5000,
                            grid: {
                                display: false // Y축 격자 숨기기
                            }
                        }
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

                    // data88 = data.data8;
                    // data99 = data.data9;

                    // if (data88 == 1) {
                    //     const dd1 = document.getElementById('dd1');
                    //     dd1.play();
                    // }

                    // if (data99 == 1) {
                    //     const ng1 = document.getElementById('ng1');
                    //     ng1.play();
                    // }

                })
                .catch(error => {
                    console.error('Fetch 오류:', error);
                });
        }

        function get_data1() {
            $.ajax({
                url: '/get/get_data1.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    $('#dataBody1').empty(); // dataBody1 초기화
        
                    data.forEach((row) => {
                         // data2, data3, data4의 요소를 동적으로 생성
                         const voltageItems = row.data2.map(item => `<div class='data_item'>${item}</div>`).join(''); // 콤마 없이 연결
                         const currentItems = row.data3.map(item => `<div class='data_item'>${item}</div>`).join(''); // 콤마 없이 연결
                         const flowItems = row.data4.map(item => `<div class='data_item'>${item}</div>`).join(''); // 콤마 없이 연결
         
                        $('#dataBody1').append(`
                            <tr>
                                <td><div class='td_state'></div></td>
                                <td class='td_id'>${row.data1}</td>
                                <td class='td_title'>전압<br>전류<br>플로우</td>
                                <td>
                                    ${voltageItems}
                                    <br>
                                    ${currentItems}
                                    <br>
                                    ${flowItems}
                                </td>
                                <td class='td_time'>${row.data5}</td>
                            </tr>
                        `);
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }
        

        function get_data2() {
            $.ajax({
                url: '/get/get_data2.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // console.log('get_data2 응답:', data); // 추가된 로그
                    $('#dataBody2').empty(); // dataBody2로 수정

                    data.forEach((row) => {
                        $('#dataBody2').append(`
                    <tr>
                        <td>${row.data1}</td>
                        <td>${row.data2}<br>${row.data3}<br>${row.data4}</td> <!-- 하나의 열로 합침 -->
                        <td>${row.data5}</td>
                    </tr>
                `);
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }


        function get_plc_control() {
            $.ajax({
                url: '/get/get_plc_control.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    // 모든 status div의 색상을 초기화
                    $('.status').css('background-color', 'gray');
        
                    // 첫 번째 데이터 객체를 사용하여 색상 변경
                    if (data.length > 0) {
                        const plcData = data[0]; // 첫 번째 객체를 사용
        
                        // 각 데이터 값에 따라 색상 변경
                        for (let i = 1; i <= 20; i++) {
                            if (plcData[`data${i}`] == "1") {
                                $(`.status[data-index='${i}']`).css('background-color', '#0397bf');
                            }
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }
        
        

        // function get_count() {
        //     $.ajax({
        //         url: '/get/get_count.php',
        //         method: 'GET',
        //         dataType: 'json',
        //         success: function (data) {

        //             // 테이블 바디 초기화
        //             $('#countBody').empty();

        //             // 데이터를 5줄로 표시
        //             data.forEach((row, index) => {
        //                 $('#countBody').append(`
        //             <tr>
        //                 <td>${row.id}</td> <!-- Jig (여기서는 임의로 설정) -->
        //                 <td>${row.lot}</td> <!-- Point (여기서는 임의로 설정) -->
        //                 <td>${row.count}</td> // 현재 시간
        //             </tr>
        //         `);
        //             });
        //         },
        //         error: function (jqXHR, textStatus, errorThrown) {
        //             console.error('오류:', textStatus, errorThrown);
        //         }
        //     });
        // }

        document.getElementById('dataTable1').style.display = 'table'; // dataTable1 보이기
        document.getElementById('dataTable2').style.display = 'none';  // dataTable2 숨기기

        function get_state() {
            $.ajax({
                url: '/get/get_state.php',
                method: 'GET',
                dataType: 'json',
                success: function (data) {
                    if (data.length > 0) {
                        const stateValue = data[0].data9; // data9 값을 가져옴
        
                        // 테이블 표시 로직
                        if (stateValue == 1) {
                            document.getElementById('dataTable1').style.display = 'table'; // dataTable1 보이기
                            document.getElementById('dataTable2').style.display = 'none';  // dataTable2 숨기기
                        } else if (stateValue == 2) {
                            document.getElementById('dataTable1').style.display = 'none';  // dataTable1 숨기기
                            document.getElementById('dataTable2').style.display = 'table'; // dataTable2 보이기
                        } else if (stateValue == 0) {
                            // 이전 상태를 유지하도록 설정, 변화를 주지 않음
                        }
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('오류:', textStatus, errorThrown);
                }
            });
        }

        function update() {
            get_data1();
            get_data2();
            get_plc_control();
            // get_count();
            get_state()
        }

        document.addEventListener('DOMContentLoaded', function () {
            // 차트 초기화
            chart1 = createChart('Voltage');
            chart2 = createChart('Current');
            chart3 = createChart('Flow');

            setInterval(update, 1000);

            // 0.2초마다 fetchAndUpdateCharts 호출
            setInterval(fetchAndUpdateCharts, 200);
        });

        // 버튼 클릭 이벤트 핸들러
        document.getElementById('btndd1').addEventListener('click', function () {
            const dd1 = document.getElementById('dd1');
            dd1.play();
        });

        document.getElementById('btnng1').addEventListener('click', function () {
            const ng1 = document.getElementById('ng1');
            ng1.play();
        });
