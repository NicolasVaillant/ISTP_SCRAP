# ISTP_SCRAP

![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)

```
Copyright 2022, Thérence FOROT and Nicolas VAILLANT, All rights reserved.
```

Scrap made with [Goutte](https://github.com/FriendsOfPHP/Goutte) (add it in the same folder : 2 Mo ~)

- scrap.php : returns a json file with the courses of the week

```json
[
   {
      "0":{
         "title":"Chaine d'Acquisition - Test RC1, FRAISSINETTE",
         "loc":null,
         "teacher":"SURVEILLANT FA 1",
         "start":"\"2022-06-16T10:30:00\"",
         "end":"\"2022-06-16T12:30:00\""
      },
      "1":{
         "title":"R\u00e9seaux TCP\/IP - Test 1-34 S, 1-46 S, COPERNIC",
         "loc":null,
         "teacher":"SURVEILLANT FA 10",
         "start":"\"2022-06-17T11:15:00\"",
         "end":"\"2022-06-17T12:15:00\""
      },
      "2":{
         "title":"TOEIC - Pr\u00e9paration ET1, FRAISSINETTE",
         "loc":null,
         "teacher":"DUPONT Dupont",
         "start":"\"2022-06-17T13:45:00\"",
         "end":"\"2022-06-17T17:45:00\"}];"
      }
   },
   {
      "taille":3
   }
]
```

## ⚠️ Important

Elements in json file are not formatted, need to be trimed or splited depending on use case


- formatted.php and formatted_next.php : return a formatted string with scraped elements like 

```
Cours de [nom] avec [intervenant] jusqu'à [heure]
```

- project.m5f : flow m5 project file, load it at https://flow.m5stack.com/

- project.py : corresponding m5 python code
