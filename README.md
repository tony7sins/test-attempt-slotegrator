План:

1. Создать полное WEB-приложение
2. Создать Дефолтный контроллер главной страницы
3. Создать Форму игры
   1. кнопка старт
   2. кнопка отображение результата

4. Создание сущностей Prize
   1. Money
   2. Balls
   3. Thing
5. Ограничить доступ к странице с игрой


SUDO
1. Пользователь попадает на гравную страницу
   1. Если зарегистрирован - на /game
   2. Иначе /login
2. /game - кнопка играть

3. Игра - генератор случайных значений от 0-2
   1. 0 - Balls - генератор от 0-100
      1. перевести в Money
      2. перевести в Balls
   2. 1 - Money - проверка банка
      1. если да - контроллер SendModey
      2. - если нет то на генератор
   3. 2 - Thing - проверка warehouse - если нет то на генератор
      1. если да - контроллер SendThing
      2. если нет то на генератор