# Лимиты Telegram ([See in English](#telegram-limits))
Данный проект описывает всевозможные лимиты и ограничения в Telegram и отображает на странице [limits.tginfo.me](https://limits.tginfo.me).

## Как помочь проекту
### Сообщить о проблеме или предложить идею
- [Баг-трекер](https://github.com/tginfo/Telegram-Limits/issues/new)
- [Обратная связь](https://t.me/infowritebot)

# Telegram Limits
This project describes Telegram limitations and displays them on [limits.tginfo.me/en](https://limits.tginfo.me/en)

## How to contribute
### Report problem or make a suggestion
- [Bug Tracker](https://github.com/tginfo/Telegram-Limits/issues/new)
- [Feedback](https://t.me/infowritebot) 

### Add new language
0. Fork
1. Create folder in `/localization` named in according to [ISO 639-1](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) 
with `lang.json`, so it will be `/localization/es/lang.json` for Spanish
2. Create file in `/data/<code>.json`. Example: `es.json` for Spanish
3. Translate the files by using any other available language
4. Check out `/assets/images/previews/_templates` directory. It contains Illustrator files with templates for
OpenGraph and Twitter preview snippets images. Also it contains `fonts` folder with required fonts to render
the picture correctly
5. Translate the images and export them as PNGs to `/assets/images/previews/<code>` directory. 
Example: `/assets/images/previews/es/preview.png` and `/assets/images/previews/es/twitter.png` for Spanish
6. Add your language to the `/localization/languages.json` file. Example: `"es": ["Español"]` for Spanish
7. Don't forget to mention yourself at the end of README!
8. Well done! You can make a pull-request now.

### How to help translate
1. All the displayed data is located in `/data`, in `ru.json` and `en.json` etc.
2. File structure
```javascript
[
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

## Translators
- Turkish: cnpltdncsln
- Italian: DavideGalilei
- Indonesian: mubassari
- Polish: Sebek
- Arabic: Disk3
