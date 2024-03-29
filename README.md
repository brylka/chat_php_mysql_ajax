# Projekt Chat PHP MySQL AJAX

Ten projekt został stworzony w ramach zajęć z programowania aplikacji internetowych w Zespole Szkół Rzemiosł Artystycznych w Jeleniej Górze, dla klasy technik informatyk 4IR. Projekt składa się z kilku plików PHP, które po kolei pokazują rozwój aplikacji do chatowania.

## Pliki projektu

- `index.php` - Ten plik zawiera prostą funkcjonalność zapisującą nazwę użytkownika w cookie. Jest to początkowy punkt interakcji z użytkownikiem, gdzie może on wprowadzić swoje imię, które następnie jest wykorzystywane w aplikacji.

- `index2.php` - Implementacja chatu wykorzystująca tylko PHP. Umożliwia użytkownikom wysyłanie i odbieranie wiadomości w realnym czasie. Jest to prostsza wersja chatu, która nie wykorzystuje technologii AJAX.

- `index3.php`, `sendMessage.php`, `fetchMessages.php` - Te pliki razem tworzą ostateczną wersję chatu z wykorzystaniem AJAX. `index3.php` służy jako front-end aplikacji, `sendMessage.php` obsługuje wysyłanie wiadomości przez użytkowników, a `fetchMessages.php` jest odpowiedzialny za odbieranie wiadomości z bazy danych i przesyłanie ich do klienta.

- `chat.sql` - Plik z dumpem bazy danych, zawierający strukturę oraz ewentualne dane potrzebne do uruchomienia aplikacji chatu. Umożliwia szybkie skonfigurowanie środowiska bazodanowego.

## Uruchomienie projektu

Aby uruchomić projekt, należy skonfigurować serwer PHP oraz bazę danych MySQL. Plik `chat.sql` powinien być zaimportowany do bazy danych, co stworzy potrzebną strukturę oraz wstępne dane.

Uruchamiamy na serwerze kolejne wersje aplikacji, np:

```
http://localhost/chat/index.php
http://localhost/chat/index2.php
http://localhost/chat/index3.php
```

## Licencja

Projekt udostępniony na licencji MIT, co oznacza, że można go swobodnie modyfikować, dystrybuować, oraz wykorzystywać zarówno w celach prywatnych, jak i komercyjnych, pod warunkiem dołączenia oryginalnej licencji i praw autorskich.
