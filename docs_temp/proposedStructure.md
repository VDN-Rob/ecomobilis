
app/ 
├── Console 
│   ├── Commands 
│   │   └── CarpoolSendUserUpcomingRides.php 
│   └── Kernel.php 
├── Events 
│   ├── CarpoolRequestCancelled.php 
│   ├── CarpoolRequested.php 
│   ├── CarpoolReservationAccepted.php 
│   ├── CarpoolReservationRejected.php 
│   └── CarpoolRideCancelled.php 
├── Exceptions 
│   └── Handler.php 
├── Helpers 
│   └── BusinessApiClusterTraffic.php 
├── Http 
│   ├── Controllers 
│   │   ├── Admin 
│   │   │   ├── CarpoolController.php 
│   │   │   ├── CarpoolGroupsController.php 
│   │   │   ├── CarpoolMessagesController.php 
│   │   │   └── UserController.php 
│   │   ├── Api 
│   │   │   └── StreetController.php 
│   │   ├── ApiOpen 
│   │   │   ├── CarpoolCarController.php 
│   │   │   ├── CarpoolRideController.php 
│   │   │   ├── CarpoolRideReservationController.php 
│   │   │   ├── CarpoolStreetCoordinateController.php 
│   │   │   ├── MobileAppController.php 
│   │   │   ├── SharingOrgController.php 
│   │   │   └── UserController.php 
│   │   ├── Auth 
│   │   │   ├── ConfirmPasswordController.php 
│   │   │   ├── ForgotPasswordController.php 
│   │   │   ├── LoginController.php 
│   │   │   ├── RegisterController.php 
│   │   │   ├── ResetPasswordController.php 
│   │   │   └── VerificationController.php 
│   │   ├── Controller.php 
│   │   └── Web 
│   │       ├── BlogController.php 
│   │       ├── CarpoolController.php 
│   │       ├── CarpoolGroupsController.php 
│   │       ├── FaqController.php 
│   │       ├── PagesController.php 
│   │       ├── SharingController.php 
│   │       ├── SharingQuestionnaireController.php 
│   │       ├── TrafficController.php 
│   │       └── UserController.php 
│   ├── Kernel.php 
│   ├── Middleware 
│   │   ├── Authenticate.php 
│   │   ├── CheckApiKey.php 
│   │   ├── CheckGroupNeedsAuth.php 
│   │   ├── EncryptCookies.php 
│   │   ├── PreventRequestsDuringMaintenance.php 
│   │   ├── RedirectIfAuthenticated.php 
│   │   ├── TrimStrings.php 
│   │   ├── TrustHosts.php 
│   │   ├── TrustProxies.php 
│   │   ├── ValidateSignature.php 
│   │   └── VerifyCsrfToken.php 
│   ├── Requests 
│   │   ├── StoreCarpoolCarRequest.php 
│   │   ├── StoreCarpoolRideRequest.php 
│   │   ├── StoreCarpoolRideReservationRequest.php 
│   │   ├── StoreCarpoolStreetCoordinateRequest.php 
│   │   ├── StoreSharingOrgRequest.php 
│   │   ├── StoreUserRequest.php 
│   │   ├── UpdateCarpoolCarRequest.php 
│   │   ├── UpdateCarpoolRideRequest.php 
│   │   ├── UpdateCarpoolRideReservationRequest.php 
│   │   ├── UpdateCarpoolStreetCoordinateRequest.php 
│   │   ├── UpdateSharingOrgRequest.php 
│   │   └── UpdateUserRequest.php 
│   └── Resources 
│       ├── CarpoolCarResource.php 
│       ├── CarpoolRideReservationResource.php 
│       ├── CarpoolRideResource.php 
│       ├── CarpoolStreetCoordinateResource.php 
│       ├── SharingOrgResource.php 
│       └── UserResource.php 
├── Jobs 
│   └── CarpoolMessageAdded.php 
├── Listeners 
│   ├── RemoveCarpoolReservationInDatabase.php 
│   ├── SendCarpoolRequestNotification.php 
│   ├── SendCarpoolReservationAcceptedNotification.php 
│   ├── SendCarpoolReservationCancelledNotification.php 
│   ├── SendCarpoolReservationRejectedNotification.php 
│   ├── SendCarpoolRideCancelledNotification.php 
│   ├── StoreCarpoolRequestInDatabase.php 
│   ├── StoreCarpoolReservationAcceptedInDatabase.php 
│   └── StoreCarpoolReservationRejectedInDatabase.php 
├── Livewire 
│   ├── ShowMessages.php 
│   └── ShowSharingOrgs.php 
├── Mail 
│   ├── NotifyCarpoolAccepted.php 
│   ├── NotifyCarpoolCancelled.php 
│   ├── NotifyCarpoolRejected.php 
│   ├── NotifyCarpoolRequestCancelled.php 
│   ├── NotifyCarpoolRequested.php 
│   ├── NotifyCarpoolRidesUpcoming.php 
│   └── SendCarpoolMessages.php 
├── Models 
│   ├── ApiKey.php 
│   ├── Blog.php 
│   ├── CarpoolCar.php 
│   ├── CarpoolCarType.php 
│   ├── CarpoolGroup.php 
│   ├── CarpoolLuggage.php 
│   ├── CarpoolMessage.php 
│   ├── CarpoolRide.php 
│   ├── CarpoolRideReservation.php 
│   ├── CarpoolStreetCoordinate.php 
│   ├── Faq.php 
│   ├── PageBlock.php 
│   ├── Page.php 
│   ├── SharingDecisionEdge.php 
│   ├── SharingDecisionNode.php 
│   ├── SharingOrg.php 
│   └── User.php 
├── Providers 
│   ├── AppServiceProvider.php 
│   ├── AuthServiceProvider.php 
│   ├── BroadcastServiceProvider.php 
│   ├── EventServiceProvider.php 
│   └── RouteServiceProvider.php 
└── Services 
    └── QuestionnaireService.php 

Would become:


# Proposition - Architecture Carpool et intégration de providers

1. Structure proposée

app/
├── Console
├── Events
├── Exceptions
├── Helpers
├── Http
│   ├── Controllers
│   │   ├── Admin
│   │   ├── Api
│   │   ├── ApiOpen
│   │   ├── Auth
│   │   ├── Controller.php
│   │   └── Web
│   │       ├── BlogController.php
│   │       ├── CarpoolController.php          <- À modifier : voir Annexe 4
│   │       ├── CarpoolGroupsController.php
│   │       ├── FaqController.php
│   │       ├── PagesController.php
│   │       ├── SharingController.php
│   │       ├── SharingQuestionnaireController.php
│   │       ├── TrafficController.php
│   │       └── UserController.php
│   ├── Kernel.php
│   ├── Middleware
│   ├── Requests
│   └── Resources
├── Jobs
├── Listeners
├── Livewire
├── Mail
├── Models
├── Providers
└── Services
    ├── QuestionnaireService.php
    └── Carpool                                <- NOUVEAU
        ├── Contracts/
        │   └── CarpoolProvider.php             <- Définit les règles communes aux providers
        │
        ├── DTO/                                <- Données communes entre les providers et l'UI
        │   ├── CarpoolSearchRequest.php        <- Requête de recherche de l'utilisateur
        │   ├── CarpoolSearchResult.php         <- Résultat global d'une recherche
        │   └── CarpoolRideResult.php           <- Représentation unifiée d'un trajet
        │
        ├── Providers/
        │   ├── EcomobilisCarpoolProvider.php   <- Interface avec le système Ecomobilis existant
        │   └── BlaBlaCarDailyProvider.php      <- Interface avec BlaBlaCar Daily
        │
        ├── Clients/
        │   └── BlaBlaCarDailyClient.php        <- Communication avec l'API BlaBlaCar
        │
        └── CarpoolProviderManager.php          <- Sélectionne le provider à utiliser


2. Vue


resources/views/
├── web/
│   └── carpool/
│       ├── overview.blade.php                  <- Adapter au format de résultat commun
│       ├── show.blade.php                      <- Garder pour Ecomobilis dans un premier temps
│       ├── create.blade.php                    <- Garder pour Ecomobilis
│       └── ...
│
└── _includes/
    ├── carpool-search.blade.php                <- Peut être réutilisé en grande partie
    ├── carpool-dep-arr-autocomplete.blade.php  <- Peut être réutilisé en grande partie
    ├── carpool-ride-block.blade.php            <- Garder dans un premier temps
    └── carpool-result.blade.php                <- NOUVEAU, indépendant du provider


---

Autres changements

## 1. Découplage de l'UI

Les fichiers :


resources/views/web/carpool/overview.blade.php
resources/views/_includes/carpool-ride-block.blade.php


supposent actuellement que '$rides' contient des instances du modèle Eloquent 'CarpoolRide'.

Cela fonctionne pour le système Ecomobilis, mais pas directement pour BlaBlaCar Daily, puisque les trajets BlaBlaCar proviennent de l'API et ne sont pas des 'CarpoolRide' enregistrés dans notre base de données.

Je propose donc d'ajouter une nouvelle vue :


resources/views/_includes/carpool-result.blade.php


Cette vue fonctionnerait avec le nouveau 'CarpoolRideResult', indépendamment du provider.

Elle pourrait dans un premier temps afficher simplement :

* Departure
* Arrival
* Date/time
* Duration
* Distance
* Price
* Available seats
* Walking times
* [View ride]

Le bouton '[View ride]' pourrait alors pointer soit vers le détail Ecomobilis, soit vers le deep link fourni par BlaBlaCar Daily.

---

2. Nouvelle UI ?

Pour l'instant, je propose de modifier le moins possible l'interface existante et de nous concentrer sur le fonctionnement du backend.

L'objectif initial serait surtout de vérifier que :

1. une recherche peut être effectuée ;
2. le provider sélectionné est appelé ;
3. les résultats sont correctement transformés ;
4. les résultats peuvent être affichés ;
5. l'utilisateur peut continuer vers le provider concerné.

Une fois cette architecture fonctionnelle, nous pourrons revoir l'UI plus proprement.

Le nouveau 'carpool-result.blade.php' pourrait alors progressivement remplacer ou compléter resources/views/_includes/carpool-ride-block.blade.php


---

## 3. Events / Listeners

En ajoutant une couche permettant de choisir le provider, le provider BlaBlaCar Daily n'aura pas besoin d'utiliser les événements et listeners actuellement présents dans app/Events et app/Listeners.


Ces éléments sont liés au fonctionnement interne du carpooling Ecomobilis, notamment aux réservations, acceptations, refus, annulations, notifications et messages.

Ils peuvent donc rester en place et continuer à être utilisés par le provider Ecomobilis.

Il n'est pas nécessaire de les modifier pour introduire BlaBlaCar Daily dans un premier temps.

---

## 4. Coordonnées

La partie du système existant responsable pour la localisation (app/Models/CarpoolStreetCoordinate.php et resources/views/_includes/carpool-dep-arr-autocomplete.blade.php) peut être utilisée par les deux providers.

Nous ne devons donc pas construire un nouveau système de localisation spécifique à BlaBlaCar.

L'autocomplete fournit déjà les coordonnées nécessaires.

Le changement sera plutôt au niveau du traitement de la recherche : au lieu de transmettre directement ces coordonnées au système de matching Ecomobilis, elles seront utilisées pour construire un 'CarpoolSearchRequest'.

Le provider sélectionné pourra alors utiliser cette requête de la manière qui lui est propre.

---

## 5. Validation

BlaBlaCar Daily impose certaines contraintes sur la date de recherche, notamment une fenêtre maximale d'une semaine.

Je propose de gérer les contraintes spécifiques à BlaBlaCar dans le provider BlaBlaCar Daily, plutôt que de les imposer directement dans l'UI ou dans le contrôleur général.

Cela permet de ne pas limiter inutilement le provider Ecomobilis avec des règles qui ne lui sont pas propres.

Les validations réellement communes aux providers, comme la présence d'une origine, d'une destination et d'une date, peuvent naturellement rester au niveau général.

---

## 6. Administration

À terme, il faudra probablement également apporter des changements à 'ecomobilis-admin'afin de permettre la configuration du provider actif.

Je ne pense cependant pas que cette partie doive être développée en premier.

Dans un premier temps, le provider utilisé pourrait simplement être défini dans 'config/carpool.php'

Une interface d'administration pourrait ensuite être ajoutée lorsque l'architecture sera validée.

---

## 7. Base de données

Aucun changement de base de données ne serait nécessaire dans un premier temps.

Les trajets Ecomobilis continueraient d'utiliser les tables existantes :


carpool_rides
carpool_rides_reservations
carpool_messages
carpool_groups
...


Les trajets BlaBlaCar Daily ne seraient pas enregistrés dans 'carpool_rides'.

Ils seraient récupérés au moment de la recherche, transformés en 'CarpoolRideResult', puis affichés à l'utilisateur.

Cela évite de mélanger dans les mêmes tables des trajets dont la gestion appartient à deux systèmes différents.

Si un besoin de stockage des trajets externes apparaît plus tard, nous pourrons traiter ce besoin séparément.

---

# Annexe 1 - 'CarpoolRideResult'

L'objectif de 'CarpoolRideResult' est de définir une représentation commune d'un trajet provenant de n'importe quel provider.

Il ne s'agit pas de transformer le modèle Ecomobilis 'CarpoolRide' en un autre modèle, mais de permettre aux différents providers de **transformer leurs données respectives vers un format commun**.

Exemple :


provider
providerRideId
departure
arrival
departureTime
duration
distance
price
currency
availableSeats
walkingTimeToPickup
walkingTimeFromDropoff
externalUrl


Pour Ecomobilis :


CarpoolRide -> EcomobilisCarpoolProvider -> CarpoolRideResult


Pour BlaBlaCar :


BlaBlaCar JSON -> BlaBlaCarDailyProvider -> CarpoolRideResult


L'UI travaille ensuite avec 'CarpoolRideResult' plutôt qu'avec le modèle ou le format de données propre à un provider.

---

# Annexe 2 - Control Flow Ecomobilis

Le flow actuel est essentiellement :


CarpoolController -> CarpoolRide::getMatchingRides() -> Blade


Je propose de le remplacer progressivement par :


CarpoolController -> CarpoolProviderManager -> EcomobilisCarpoolProvider -> CarpoolRide -> CarpoolRideResult -> Blade


Cela permet deux choses importantes :

* nous ne devons pas modifier la base de données actuelle ni l'algorithme de recherche Ecomobilis ;
* nous ne devons pas modifier 'CarpoolRide::getMatchingRides()' simplement pour introduire BlaBlaCar Daily.

Le 'EcomobilisCarpoolProvider' joue donc principalement le rôle d'adaptateur entre le nouveau système de providers et le système Ecomobilis existant.

---

# Annexe 3 - 'BlaBlaCarDailyClient'

Le 'BlaBlaCarDailyClient' serait responsable de la communication technique avec l'API :

* construire la requête API ;
* ajouter le token d'accès ;
* envoyer la requête HTTP avec Guzzle ;
* gérer les erreurs HTTP/API ;
* décoder la réponse JSON.

Le 'BlaBlaCarDailyProvider' serait ensuite responsable de la logique propre au provider et de la transformation de la réponse en 'CarpoolRideResult'.

Le flow serait donc :


BlaBlaCarDailyProvider -> BlaBlaCarDailyClient -> BlaBlaCar Daily API -> JSON -> BlaBlaCarDailyProvider -> CarpoolRideResult


Le token d'accès resterait dans '.env'.

Nous pourrions également ajouter une configuration dans :


config/carpool.php


pour regrouper des éléments comme :


active provider
BlaBlaCar API URL
API token
search time window


Le token ne serait jamais exposé dans les vues Blade ou dans le JavaScript exécuté par le navigateur.

---

# Annexe 4 - 'CarpoolController'

Actuellement, 'matching()' fait essentiellement :


requête -> demande les coordonnées -> CarpoolRide::getMatchingRides() -> Blade


Je propose :


requête -> demande / valide les coordonnées -> création de CarpoolSearchRequest -> CarpoolProviderManager -> sélection du provider -> CarpoolRideResult[] -> Blade


Le 'CarpoolController' délègue donc la logique de recherche au nouveau système de providers.

Il conservera cependant dans un premier temps les méthodes liées aux fonctionnalités propres au système Ecomobilis :


create()
store()
edit()
update()
cancelRide()


Ces fonctionnalités ne seront donc pas supprimées.

À terme, la disponibilité de ces fonctionnalités pourra dépendre des capacités du provider actif.

Par exemple, Ecomobilis peut permettre de créer et modifier des trajets, tandis que BlaBlaCar Daily ne permet actuellement que la recherche et la redirection vers son propre système.

---

# Annexe 5 - 'CarpoolProviderManager'

Dans un premier temps, je propose de garder le provider actif dans :


config/carpool.php


Le 'CarpoolProviderManager' pourrait alors simplement lire cette configuration et sélectionner le provider correspondant.

Par exemple :


active provider = ecomobilis


ou :


active provider = blablacar_daily


Dans un second temps, nous pourrions ajouter une fonctionnalité permettant à l'administrateur de choisir le provider via 'ecomobilis-admin'.

La possibilité de laisser l'utilisateur choisir son provider pourrait également être étudiée plus tard si cela présente un intérêt fonctionnel.

---

## Résumé du changement

Le changement principal n'est donc pas de remplacer le système Ecomobilis, mais d'ajouter une couche entre le carpooling actuel et l'interface utilisateur.

Le système deviendrait progressivement :


                    Carpool UI
                         ↓
              CarpoolProviderManager
                    ↙          ↘
       Ecomobilis Provider    BlaBlaCar Provider
              ↓                      ↓
       Système existant        BlaBlaCar API
              ↓                      ↓
              └──── CarpoolRideResult ────┘
                         ↓
                       UI


L'intérêt principal est de pouvoir conserver le système Ecomobilis existant tout en ajoutant BlaBlaCar Daily, sans mélanger les deux modèles de données et sans rendre le code Ecomobilis dépendant de BlaBlaCar.
