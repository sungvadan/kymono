Énoncé :
--------
Soit une liste de plages (d'entiers, d'adresses IP, de dates), écrire un algorithme permettant de factoriser ces plages (concaténer/fusionner les plages contiguës).

Contraintes :
-------------
 * A faire en PHP sans utiliser d'objet, ni de librairies externes (les fonctions PHP standards suffisent)
 * Le même script doit être capable de gérer des plages des 3 types indiqués (IPs, dates, entiers : un type à la fois, pas un mélange des trois)
 * Les plages doivent pouvoir être données dans n'importe quel ordre.
 * Nul besoin de valider les plages, elles sont supposées correctes

Exemple :
---------
Si on a la p
lage allant de 1 à 3, celle allant de 2 à 4 et celle allant de 7 à 8 en entrée, le script doit retourner la plage allant de 1 à 4 et celle allant de 7 à 8

Critères d'évaluation :
-----------------------
Le script sera jugé sur 3 critères :
 * Correction de l'algorithme (ie. le résultat doit être correct)
 * Maintenabilité / Extensibilité
 * Complexité algorithmique