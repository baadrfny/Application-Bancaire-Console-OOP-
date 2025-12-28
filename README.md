🏦 LMBANK – Application Bancaire Console

PHP OOP & PDO

📌 Description

LMBANK est une application bancaire en mode console développée en PHP Orienté Objet
Le projet
OOP و séparation des responsabilités

L’application permet de gérer :

Clients

Comptes bancaires

Transactions financières sécurisées

🏗️ Architecture Technique

Le projet est structuré selon une architecture claire et maintenable

Entities

Client

Compte (abstraite)

Transaction

Repositories

Gestion CRUD

Accès base de données via PDO

Requêtes préparées pour la sécurité

Config

Connexion PDO

Paramètres base de données

Concepts utilisés

Encapsulation

Héritage

Classes abstraites

Transactions SQL (Commit / Rollback)

🚀 Fonctionnalités & Règles Métier
👤 Gestion des Clients

Ajouter un client

Modifier les informations

Supprimer un client

Vérification unicité de l’email

Suppression interdite si le client possède des comptes actifs

💳 Gestion des Comptes (Héritage)
🔹 Compte Courant

Découvert autorisé jusqu’à -500 $

Frais de dépôt : 1 $ à chaque dépôt

🔹 Compte Épargne

Aucun découvert autorisé

Solde minimum : 0

Aucun frais de dépôt

❌ Suppression d’un compte

Autorisée uniquement si le solde est exactement 0 $

💸 Transactions

Dépôt

Retrait

Virement entre deux comptes

Gestion atomique des virements avec beginTransaction

Historique complet des transactions par compte

📊 Modélisation UML
Diagramme de Classes

Compte est une classe abstraite

CompteCourant et CompteEpargne héritent de Compte

Un Client peut posséder plusieurs comptes

Un Compte possède plusieurs Transactions



1 Configurer la connexion PDO
2 Importer la base de données
3 Lancer le script principal en ligne de commande

🎯 Objectif Pédagogique

Maîtriser PHP OOP

Comprendre PDO et la sécurité SQL

Appliquer une architecture professionnelle

Se préparer à des projets Back End réels
