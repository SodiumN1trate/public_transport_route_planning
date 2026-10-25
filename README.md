# Public Transport Route Planning

Sabiedriskā transporta maršrutu plānošanas web lietotne, kas izstrādāta, balstoties uz vienu no **SkillsLatvia Web tehnoloģiju konkursa uzdevumiem**.

Šis projekts bija mana **pirmā praktiskā pieredze ar Laravel un Vue.js**, apgūstot REST API izstrādi, lietotāja saskarnes veidošanu un frontend un backend savstarpējo integrāciju.

## Projekta zari

Projekta frontend un backend daļas atrodas atsevišķos Git zaros:

- **[Frontend](https://github.com/SodiumN1trate/public_transport_route_planning/tree/frontend)** — Vue.js 2 lietotāja saskarne.
- **[Backend](https://github.com/SodiumN1trate/public_transport_route_planning/tree/backend)** — Laravel 8 REST API.

## Funkcionalitāte

### Frontend
- Sākuma un galamērķa pieturvietu izvēle.
- Sabiedriskā transporta maršrutu meklēšana un attēlošana.
- Autentifikācijas un datu importēšanas saskarne.

### Backend
- Transporta un pieturvietu pārvaldība.
- Maršrutu meklēšanas loģika, tostarp pārsēšanās iespēju apstrāde.
- REST API un datu validācija.
- Autentifikācija ar Laravel Passport.
- Datu imports no JSON failiem.

## Izmantotās tehnoloģijas

**Frontend:** Vue.js 2, Vue Router, Vuex, JavaScript, Axios.

**Backend:** PHP, Laravel 8, Eloquent ORM, Laravel Passport, REST API.

## Par projektu

Projekts tika izstrādāts kā praktisks mācību uzdevums, lai apgūtu pilna cikla web lietotnes izstrādi.

Tas atspoguļo manu sākotnējo pieredzi darbā ar Laravel un Vue.js, kā arī pirmos mēģinājumus realizēt maršrutu meklēšanas loģiku un savienot frontend ar backend API.
