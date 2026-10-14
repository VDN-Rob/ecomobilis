# Probleme 1: group autofill
Autofill de groupe utilise "locationIQ", et non le standard "streetCoordinate" -> rajout de POI insuffisant. Il m'est donc impossible de tester les fonctionnalites.


# Probleme 2: departure time validation
carpool, new ride -> departure time validation

Il est actuellement possible de creer/d'editer un trajet ayant une date de depart anterieure a la date actuelle - jusqu'a un jour dans le passe. En creeant ce trajet, le trajet est proprement stocke sous le denominateur de "Ancien", mais egalement sous le denominateur de "Prochains".

ex: creation de trajet pour le 13 octobre.

Resolution: voir branche "issueOldDate"

-> Addition de la validation (max une heure)
-> Addition d'un message d'erreur
-> Garder les anciens elements au lieu de faire un reset


# Probleme 3: latin

Il y a encore du latin dans la page de reservation de trajet.


# Probleme 4: traduction insuffisante
Une traduction est insuffisante a plusieurs endroits:
- 
- 
- 

