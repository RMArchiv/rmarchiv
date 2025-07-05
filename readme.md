[![Stories in Ready](https://badge.waffle.io/rygos/rmarchiv.png?label=ready&title=Ready)](https://waffle.io/rygos/rmarchiv?utm_source=badge)
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
Installieren der Abhängigkeiten für vite (nachfolgende Befehle können auch npm statt yarn nutzen)
```bash
yarn install
```
Um während der Entwicklung mit Hot-Reload JS und SCSS zu testen
```bash
yarn run dev
```
Bündeln der JS und SCSS Files zum Hochladen
```bash
yarn run build
```
Angabe der Datenbank Verbindungsdaten
```bash
Anpassen der .env.example und speichern als .env
```
Tabellen in Datenbank erstellen
```bash
php artisan migrate
```
Um Datenablagen aufzurufen
```bash
php artisan storage:link
```
Language Tabellen füllen
```bash
php artisan db:seed
```
Key Generieren
```bash
php artisan key:generate
```
Lokalen Webserver starten
```bash
php artisan serv
```
Suche indexieren
```bash
php artisan scout:import "App\Models\Developer"
php artisan scout:import "App\Models\Game"
```

Nun kann das Script auf http://localhost:8000 im Browser geöffnet werden.