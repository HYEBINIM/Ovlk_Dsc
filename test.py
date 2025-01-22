import MySQLdb
import time
from datetime import datetime

def get_db_connection():
    try:
        return MySQLdb.connect(
            host='localhost',
            user='server',
            passwd='dltmxm1234',
            db='dataset',
            autocommit=False  # 수동 커밋
        )
    except MySQLdb.Error as err:
        print(f"Error: {err}")
        return None

previous_data9_value = None  # 이전 data9 값을 저장할 변수
last_inserted_table = None  # 마지막으로 데이터가 추가된 테이블
last_lh_id = None  # 마지막으로 삽입된 plc_data_lh ID
last_rh_id = None  # 마지막으로 삽입된 plc_data_rh ID

try:
    while True:
        conn = get_db_connection()  # DB 연결 생성

        if conn is None:
            print("DB 연결 실패. 재시도 중...")
            time.sleep(5)  # 5초 대기 후 재시도
            continue

        cursor = conn.cursor()

        # SQL 쿼리 실행
        query = "SELECT data9, data3, data4, data5 FROM guide1 WHERE id = 1"
        cursor.execute(query)

        # 결과 가져오기
        result = cursor.fetchall()

        if result:
            data9_value, data3_value, data4_value, data5_value = result[0]  # data9, data3, data4, data5 컬럼 값

            # data9 값이 바뀌었을 때만 처리
            if data9_value != previous_data9_value:
                # data9가 문자열 "1"일 때
                if data9_value == "1":
                    # 현재 날짜와 시간 가져오기
                    current_datetime = datetime.now()
                    date_value = current_datetime.date()
                    time_value = current_datetime.time()

                    # data9 값이 1일 때 plc_data_lh에 한 행 추가
                    insert_query = "INSERT INTO plc_data_lh (date, time) VALUES (%s, %s)"
                    print(f"Executing query: {insert_query} with values: ({date_value}, {time_value})")
                    
                    try:
                        cursor.execute(insert_query, (date_value, time_value))
                        conn.commit()  # 즉시 커밋
                        last_inserted_table = 'plc_data_lh'  # 마지막으로 추가된 테이블 기록

                        # MAX(id) 가져오기
                        cursor.execute("SELECT MAX(id) FROM plc_data_lh")
                        last_lh_id = cursor.fetchone()[0]
                        print(f"Last inserted ID (plc_data_lh): {last_lh_id}")
                    except MySQLdb.Error as err:
                        print(f"Insert Error: {err}")

                # data9가 문자열 "2"일 때
                elif data9_value == "2":
                    # 현재 날짜와 시간 가져오기
                    current_datetime = datetime.now()
                    date_value = current_datetime.date()
                    time_value = current_datetime.time()

                    # data9 값이 2일 때 plc_data_rh에 한 행 추가
                    insert_query = "INSERT INTO plc_data_rh (date, time) VALUES (%s, %s)"
                    print(f"Executing query: {insert_query} with values: ({date_value}, {time_value})")
                    
                    try:
                        cursor.execute(insert_query, (date_value, time_value))
                        conn.commit()  # 즉시 커밋
                        last_inserted_table = 'plc_data_rh'  # 마지막으로 추가된 테이블 기록

                        # MAX(id) 가져오기
                        cursor.execute("SELECT MAX(id) FROM plc_data_rh")
                        last_rh_id = cursor.fetchone()[0]
                        print(f"Last inserted ID (plc_data_rh): {last_rh_id}")
                    except MySQLdb.Error as err:
                        print(f"Insert Error: {err}")

                # data9가 1이나 2가 아닐 경우
                else:
                    print("data9의 값이 1이나 2가 아닙니다. 업데이트를 중지합니다.")
                    previous_data9_value = data9_value  # 이전 값을 업데이트하여 반복에서 계속 확인할 수 있도록
                    last_inserted_table = None  # 마지막 추가된 테이블 초기화
                    continue  # 업데이트 중단

                # 이전 data9 값을 현재 값으로 업데이트
                previous_data9_value = data9_value
                print(f"data9의 현재 값: {data9_value}")

            # data9가 바뀌지 않았을 경우, 마지막 추가된 행 업데이트
            if last_inserted_table is not None:
                if last_inserted_table == 'plc_data_lh':
                    update_query = f"""
                    UPDATE {last_inserted_table} 
                    SET data22 = %s, data23 = %s, data24 = %s 
                    WHERE id = {last_lh_id};
                    """
                    print(f"Updating last inserted row in {last_inserted_table} with values: ({data3_value}, {data4_value}, {data5_value})")
                    try:
                        cursor.execute(update_query, (data3_value, data4_value, data5_value))
                        conn.commit()  # 수동으로 커밋
                        print(f"Updated last inserted row in {last_inserted_table}.")
                    except MySQLdb.Error as err:
                        print(f"Update Error: {err}")

                elif last_inserted_table == 'plc_data_rh':
                    update_query = f"""
                    UPDATE {last_inserted_table} 
                    SET data22 = %s, data23 = %s, data24 = %s 
                    WHERE id = {last_rh_id};
                    """
                    print(f"Updating last inserted row in {last_inserted_table} with values: ({data3_value}, {data4_value}, {data5_value})")
                    try:
                        cursor.execute(update_query, (data3_value, data4_value, data5_value))
                        conn.commit()  # 수동으로 커밋
                        print(f"Updated last inserted row in {last_inserted_table}.")
                    except MySQLdb.Error as err:
                        print(f"Update Error: {err}")

        # 커서와 연결 종료
        cursor.close()
        conn.close()

        # 1초 대기 후 다시 실행
        time.sleep(1)

except KeyboardInterrupt:
    print("프로그램이 종료되었습니다.")

finally:
    # 마지막 커넥션 종료
    if 'cursor' in locals():
        cursor.close()
    if 'conn' in locals():
        conn.close()
