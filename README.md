# Лимиты Telegram ([See in English](#telegram-limits)) ([See in Turkish](#telegram-sınırları))
Данный проект описывает всевозможные лимиты и ограничения в Telegram и отображает на странице [limits.tginfo.me](https://limits.tginfo.me).

## Как помочь проекту
### Сообщить о проблеме или предложить идею
- [Баг-трекер](https://github.com/tginfo/Telegram-Limits/issues/new)
- [Обратная связь](https://t.me/infowritebot) 

### Как работать с данными
1. Все данные находятся в `/data`, в файлах `ru.js` и `en.js` соответственно
2. Структура файла
```javascript
// Присваивание данных в ожидаемую переменную
window.data = [
    // Секция
    {
        // Название секции
        "name": "Учётные записи",

        // Название иконки из material.io/icons
        "icon": "account_circle",

        // RGB акцентного цвета секции
        "color": "110, 80, 200",

        // Содержимое секции
        "items": [
            {
                // Описываемый элемент
                "name": "Имя пользователя",

                // Уточнение (серый текст после назвния)
                "hint": "(например, @cameraman)",

                // Собственно, лимит
                "text": "от 5 до 32 символов",

                // Название иконки из material.io/icons
                "icon": "alternate_email"
            },

            {
                ...
            }
        ]
    },
    {
        ...
    }
];
```
3. Pull запросы приветствуются

# Telegram Limits
This project describes Telegram limitations and displays them on [limits.tginfo.me/en](https://limits.tginfo.me/en)

## How to contribute
### Report problem or make a suggestion
- [Bug Tracker](https://github.com/tginfo/Telegram-Limits/issues/new)
- [Feedback](https://t.me/infowritebot) 

### How to work with data
1. All the data is located in `/data`, in `ru.js` and `en.js` files accordingly
2. File structure
```javascript
// Присваивание данных в ожидаемую переменную
window.data = [
    // Секция
    {
        // Section name
        "name": "Accounts",

        // Icon name from material.io/icons
        "icon": "account_circle",

        // RGB of the section accent color
        "color": "110, 80, 200",

        // Section contents
        "items": [
            {
                // Element that's being described
                "name": "Username",

                // Clarification (gray text after the name)
                "hint": "(e.g. @cameraman)",

                // The limitation
                "text": "5 to 32 symbols",

                // Icon name from material.io/icons
                "icon": "alternate_email"
            },

            {
                ...
            }
        ]
    },
    {
        ...
    }
];
```
3. Pull requests are welcomed

# Telegram Sınırları
Bu proje, Telegram sınırlamalarını açıklar ve onları [limits.tginfo.me/tr](https://limits.tginfo.me/tr) sayfasında gösterir

## Nasıl katkıda bulunuruz
### Sorun bildirin veya öneri yapın
- [Hata Takibi](https://github.com/tginfo/Telegram-Limits/issues/new)
- [Geri bildirim](https://t.me/infowritebot) 

### Veriler nasıl çalışıyor
1. Tüm veriler `/data` klasöründe `en.js` ve `tr.js` dosyalarına göre bulunur
2. Dosya yapısı
```javascript
// Присваивание данных в ожидаемую переменную
window.data = [
    // Секция
    {
        // Bölüm adı
        "name": "Hesaplar",

        // material.io/icons'dan ikon ismi
        "icon": "account_circle",

        // RGB olarak bölüm rengi
        "color": "110, 80, 200",

        // Bölüm içeriği
        "items": [
            {
                // Element adı
                "name": "Kullanıcı Adı",

                // Açıklama (isimden sonraki gri yazı)
                "hint": "(örn. @kameraman)",

                // Sınır
                "text": "5 ila 32 sembol",

                // material.io/icons'dan ikon adı
                "icon": "alternate_email"
            },

            {
                ...
            }
        ]
    },
    {
        ...
    }
];
```
3. PR kabul edilir
