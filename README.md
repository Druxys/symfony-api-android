# symfony-api-android
BDD

    Table :

Projet :
-    id (Primary key) int
-    titre Varchar(255)
-    presentation Text
-    montant_a_atteindre Float
-    montant_actuel Float
-    date_limite Date
Utilisateurs :
-    id (Primary Key) int
-    email DISTINCT Varchar(255)
-    password Varchar(255)
-    pseudo DISTINCT Varchar(255) 
Dons :
-    id  ( Primary Key) int
-    montant Float
-    id_projet ( Foreign Key ) int
-    id_utilisateur ( Foreign Key ) int
Media :
-    id (PRIMARY KEY) int 
-    url Varchar(255)
-    couverture Boolean
-    id_Projet(F) ( Foreign Key ) int
-    id_utilisateur(F) ( Foreign Key ) int
Contrepartie :
-    id (PRIMARY KEY) int 
-    montant Float
-    titre Varchar(255)
-    description Varchar(255)
-    id_contrepartie ( Foreign Key ) int


BDD Device

Tables :
Projet :
-    id (Primary key) INTEGER
-    titre TEXT
-    presentation TEXT
-    montant_a_atteindre REAL
-    montant_actuel REAL
-    date_limite NUMERIC
Media :
-    id (PRIMARY KEY) INTEGER
-    url TEXT
-    couverture NUMERIC
-    id_Projet(F) ( Foreign Key ) INTEGER
-    id_utilisateur(F) ( Foreign Key ) INTEGER
Contrepartie :
-    id (PRIMARY KEY) INTEGER
-    montant REAL
-    titre TEXT
-    description TEXT
-    id_contrepartie ( Foreign Key ) INTEGER

APP

Models:
Projet :
-    id int
-    titre String
-    presentation String
-    montant_a_atteindre Float
-    montant_actuel Float
-    photo_couverture String
-    photos Arraylist<String>
-    contreparties ArrayList<Contrepartie>
-    dons ArrayList<Don>
-    date_limite Date
Utilisateurs :
-    id int
-    email String
-    pseudo String 
-    Photo String
Dons :
-    id  int
-    montant Float
Contrepartie :
-    id int 
-    montant Float
-    titre String
-    description String
