```mermaid

classDiagram

    class Client {
        -int id
        -string nom
        -string email
        -string telephone
        -datetime date_creation
        +create()
        +getAll()
        +getById()
        +update()
        +delete()
    }

    class Compte {
        <<abstract>>
        -int id
        -int client_id
        -float solde
        -datetime date_creation
        +deposer()
        +retirer()
        +getSolde()
    }

    class CompteCourant {
        -float fraisDepot
        -float decouvertMax
    }

    class CompteEpargne {
        +calculInteret()
    }

    class Transaction {
        -int id
        -int compte_id
        -string type
        -float montant
        -float frais
        -datetime date
        +create()
        +getByCompte()
    }

    %% Héritage
    Compte <|-- CompteCourant
    Compte <|-- CompteEpargne

    %% Relations
    Client "1" --> "*" Compte : possède
    Compte "1" --> "*" Transaction : génère
