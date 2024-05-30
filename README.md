## ABOUT
Twórcy projektu:
  - Wojciech Machała(https://github.com/wojtek20032)
  - Anton Prykhodzka(https://github.com/medant79)
  - Miłosz Kuraciński(https://github.com/Kuracin)



Projekt miał na celu rozwiązanie problemu optymalizacji czasu dla studentów Politechniki Łódzkiej przez aplikację do jego organizowania.
Projekt, będący podstawą do zaliczenia przedmiotu "Podstawy Inżynierii Oprogramowania", jest aplikacją internetową, zawierającą komponenty do ułatwienia organizacji czasu, w tym:
  - tworzenie i uwierzytelnianie użytkownika,
  - dodawanie i usuwanie wydarzeń w terminarzu wydarzeń,
  - sekcja powiadomień, pozwalająca efektywnie przypomnieć użytkownikowi o najważniejszych wydarzeniach.
    


## PREREQUISITES
- [XAMPP](https://www.apachefriends.org/) 

## HOW TO RUN THE APP

### 1. Pobranie xampp

 ![image](https://github.com/wojtek20032/free_time_application/assets/115218143/9ee474c3-f628-4cbb-be3c-b1ad65388ee9)


  Kliknięcie na tą ikonkę otworzy nowe okno w przeglądarce, trzeba na nie kliknąć i poczekać na pobranie narzędzia
  ![image](https://github.com/wojtek20032/free_time_application/assets/115218143/63c93e5a-2e98-42d2-8dd6-058c2f13d004)

  Po uruchomieniu instalatora można przeklikać wszystkie monity

  
### 2. Kroki po instalacji 

Należy wejść w eksplorator plików do ścieżki: 

```

C:\xampp\htdocs

```

(Przy założeniu, że nie zmieniono domyślnej ścieżki instalacyjnej)
![image](https://github.com/wojtek20032/free_time_application/assets/115218143/59bbe8ad-c99c-4291-9dcf-fc78f267f728)

Potem w pasku eksploratora plików wpisujemy cmd i kolejno klonujemy repozytorium z githuba:


```

https://github.com/wojtek20032/free_time_application

```
 ![image](https://github.com/wojtek20032/free_time_application/assets/115218143/4cb00c24-806b-40e5-be13-7ac8ac360f05)
 

 ![image](https://github.com/wojtek20032/free_time_application/assets/115218143/9d06000c-a68f-4bf4-ac19-3dfd9317ee94)


 ### 3. Konfiguracja XAMPP
 
Po tej operacji wchodzimy w panel sterowania xampp i wciskamy start na serwer apache i mysql

 ![image](https://github.com/wojtek20032/free_time_application/assets/115218143/5a128020-a7b3-4827-afc0-f3517f173a57)

 ![image](https://github.com/wojtek20032/free_time_application/assets/115218143/577b286c-6bcb-442c-bd93-1a887cf254c5)


Tak wygląda panel po uruchomieniu usług:

![image](https://github.com/wojtek20032/free_time_application/assets/115218143/449a9d9a-b4ff-46d5-aac5-b73b82eab61c)


### 4. Uruchomienie aplikacji

Po uruchomieniu XAMPP wchodzimy w okno przeglądarki i wpisujemy w nagłówek:
```

localhost:80/free_time_application/login-register/index.php

```

Uruchomiony zostaje panel logowania, w którym można założyć użytkownika i zalogować się do aplikacji
