Voici le texte mis au propre en Markdown :

---

## Description

Une recette sera définie par :

-   Un nom
-   Un slug
-   Un temps (en minutes)
-   Un nombre de personnes
-   Une difficulté
-   Une liste d’étape à suivre / description
-   Un prix
-   La possibilité de définir la recette comme étant favorite ou non
-   Une date de création
-   Une date de mise à jour
-   Une liste d’ingrédients

### Contraintes

-   **Nom**
    -   Le nom sera obligatoire et ne pourra pas être vide.
    -   Il ne pourra également pas excéder plus de 50 caractères et devra faire au minimum 2 caractères.
-   **Slug**
    -   Le slug sera obligatoire et ne pourra pas être vide.
    -   Il ne pourra également pas excéder plus de 50 caractères et devra faire au minimum 2 caractères.
-   **Temps**
    -   Le temps n'est pas obligatoire. S’il est rempli, il ne pourra pas être inférieur à 1 minute et ne pourra pas dépasser les 24h.
-   **Nombre de personnes**
    -   Le nombre de personnes n’est pas obligatoire. S’il est rempli, il devra être inférieur à 50.
-   **Difficulté**
    -   La difficulté n’est pas obligatoire. Si elle est rentrée, elle sera comprise entre 1 et 5.
-   **Description**
    -   La description sera obligatoire et ne pourra pas être vide.
-   **Prix**
    -   Le prix non plus ne sera pas obligatoire. S'il est renseigné, le prix ne pourra pas être inférieur à 0 et supérieur à 1000. Le prix pourra contenir des décimales.
-   **Dates**
    -   La date de création et la date de mise à jour seront générées automatiquement une fois la recette créée et/ou modifiée.

---
