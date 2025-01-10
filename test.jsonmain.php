<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>JSON 데이터 처리</title>
    <script>
        // 데이터를 가져오는 함수
        function fetchData() {
            fetch('jsonprocess.php')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('네트워크 응답에 문제가 있습니다.');
                    }
                    return response.json(); // JSON 형식으로 변환
                })
                .then(data => {
                    // 데이터를 HTML에 반영
                    const resultDiv = document.getElementById('result');
                    resultDiv.innerHTML = `
                        <p>Status: ${data.status}</p>
                        <p>Message: ${data.message}</p>
                        <p>Data0: ${data.data0}</p>
                        <p>Data1: ${data.data1}</p>
                        <p>Data2: ${data.data2}</p>
                    `;
                })
                .catch(error => {
                    console.error('Fetch 오류:', error);
                    const resultDiv = document.getElementById('result');
                    resultDiv.innerHTML = '데이터를 불러오는 데 실패했습니다.';
                });
        }

        // 0.1초마다 fetchData 호출
        document.addEventListener('DOMContentLoaded', function() {
            fetchData(); // 첫 호출
            setInterval(fetchData, 100); // 0.1초 간격으로 호출
        });
    </script>
</head>
<body>
    <h1>실시간 데이터 결과</h1>
    <div id="result">데이터를 불러오는 중...</div>
</body>
</html>
