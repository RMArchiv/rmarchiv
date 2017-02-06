[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/rygos/rmarchiv/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/rygos/rmarchiv/?branch=master)
[![StyleCI](https://styleci.io/repos/80870043/shield?branch=master)](https://styleci.io/repos/80870043)

## Quartier 2.5 - Laravel Edition
Es wird... Echtjetzt.

## Vorbereitung für Entwicklung
Klonen des Scripts
```bash
git clone URL zum Repo quartier
```
Installieren der PHP Abhängigkeiten
```bash
composer install [Installation]
```
Installieren der Abhängigkeiten für Gulp
```bash
npm install
```
Installieren der benötigten Javascript Komponenten
```bash
bower install
```
Kompilieren der JS und SCSS Files
```bash
gulp
```
Angabe der Datenbank Verbindungsdaten
```bash
Anpassen der .env.example und speichern als .env
```
Tabellen in Datenbank erstellen
```bash
php artisan migrate
```
Language Tabellen füllen
```bash
php artisan db:seed
```
Lokalen Webserver starten
```bash
php artisan serv
```

Nun kann das Script auf http://localhost:8000 im Browser geöffnet werden.