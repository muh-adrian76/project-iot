import time
import pymysql
import RPi.GPIO as GPIO
from datetime import datetime

# Konfigurasi GPIO
SENSOR_PIN = 17
RELAY_PIN = 27
GPIO.setmode(GPIO.BCM)
GPIO.setup(SENSOR_PIN, GPIO.IN)
GPIO.setup(RELAY_PIN, GPIO.OUT)
GPIO.output(RELAY_PIN, GPIO.HIGH)

# Koneksi ke Database
conn = pymysql.connect(host='localhost', user='root', password='', database='smart_garden')
cursor = conn.cursor()

def baca_sensor():
    return GPIO.input(SENSOR_PIN)

def simpan_data(kelembapan):
    cursor.execute("INSERT INTO sensor_data (kelembapan) VALUES (%s)", (kelembapan,))
    conn.commit()

def penyiraman():
    print("Menyiram tanaman...")
    GPIO.output(RELAY_PIN, GPIO.LOW)
    time.sleep(300)
    GPIO.output(RELAY_PIN, GPIO.HIGH)
    print("Penyiraman selesai.")

try:
    while True:
        kelembapan = baca_sensor()
        simpan_data(kelembapan)
        jam_sekarang = datetime.now().hour

        if kelembapan == 0 or jam_sekarang in [6, 12, 18]:
            penyiraman()
        
        time.sleep(10) # Delay pembacaan sensor (detik)
        
except KeyboardInterrupt:
    GPIO.cleanup()
    conn.close()