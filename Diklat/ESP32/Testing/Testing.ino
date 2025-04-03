// Library
#include <WiFi.h>
#include <HTTPClient.h>

// Kredensial Wi-Fi/Access Point Ruangan
const char* ssid = "Hotspot DIklat Lt 1";
const char* password = "123@PetrokimiaJaya!";

// URL server
String host = "http://10.14.41.185:8076";   // <--- IP atau domain dari server
String path = "/";                          // <--- Direktori file api-tombol.php
String serverName = host + path + "api-tombol.php";   // <--- Sesuaikan dengan nama file php (API) jika ada perubahan

// Tombol
String ruang = "konsumsi";  // <--- Sesuaikan dengan ruangan yang akan diinstalasi (string = 1 hingga 25/konsumsi)
const int buttonPin = 15;   // <--- Sesuaikan dengan kaki yang tersolder dengan kabel relay NO/Normally Open (tombol)

void setup() {
  // Serial monitor
  Serial.begin(9600);

  // Wi-Fi
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println(".");
  }
  Serial.print("Connected to WiFi: ");
  Serial.println(ssid);
  Serial.print("ESP32 IP Address: ");
  Serial.println(WiFi.localIP());
  Serial.print("RSSI: ");
  Serial.println(WiFi.RSSI());

  // Tombol
  pinMode(buttonPin, INPUT_PULLUP);
}

void loop() {
  int buttonState = digitalRead(buttonPin);
  if (buttonState == LOW) {
    // Check WiFi connection status
    if (WiFi.status() == WL_CONNECTED) {
      HTTPClient http;
      // String serverPath = serverName + "?ruang=" + ruang + "&dll=" + dll;  <--- Jika ingin menambah parameter
      String serverPath = serverName + "?ruang=" + ruang;

      // POST request
      http.begin(serverPath.c_str());

      // GET request untuk monitoring via serial monitor
      int httpResponseCode = http.GET();
      if (httpResponseCode > 0) {
        Serial.print("HTTP Response code: ");
        Serial.println(httpResponseCode);
        String payload = http.getString();
        Serial.println(payload);
      } else {
        Serial.print("Error code: ");
        Serial.println(httpResponseCode);
      }      http.end();
    } else {
      Serial.println("WiFi Disconnected");
    }
  
    // Limit pesan 1 menit hanya 2 kali
    for (int i = 30; i > 0; i--) {
      Serial.print("Jeda tombol: ");
      Serial.print(i);
      Serial.println(" detik");
      delay(1000);
    }
  }
}
