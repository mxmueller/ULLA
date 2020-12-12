# Datenbank Dokumentation



### Datenbank Schema:
##### Origin: [Here](https://dbdesigner.page.link/iNfanE1b3qAowZmMA)

##### Erklärungen:
| Attributs Bezeichnung  | Erklärung
| ------------- |-------------| 
| Request     | Urlaubsantrag| 
| Request_periods     | Zeitspanne des Urlaubsantrags      |   
| Human_resources | Enthält den Ersteller, den Abnehmer bzw. Vorgesetzten und eine n:m an Vertretungen      |   

---

![alt text](https://github.com/mxmueller/ulla-foundation/blob/main/docs/database/db-schema/ulla-db-schema-mark3.png)

---

Alle User Permissions und Zugriffsoperatoren werden über das Laravel Package "Laratrust" gelöst.
[Dokumentation Laratrust](https://laratrust.santigarcor.me/docs/6.x/)

---

![alt text](https://github.com/mxmueller/ulla-foundation/blob/main/docs/database/example_data_sets/request.jpg)
![alt text](https://github.com/mxmueller/ulla-foundation/blob/main/docs/database/example_data_sets/rejected.jpg)
![alt text](https://github.com/mxmueller/ulla-foundation/blob/main/docs/database/example_data_sets/granted.jpg)
