git log	//historique des actions

1) commit local -> 2) commit distant 



COMMIT fichier :
git add file.txt // add file.txt au commit
git add -A	// add all file au commit


Déposer le commit sur git LOCAL :
git commit -m "commentaire info obligatoire sur git" // msg d'info
git commit --amend -m "Here the new comment" // modifier commentaire

Annuler COMMIT :
git reset HEAD // annuler le COMMIT
git reset HEAD file.txt //annuler COMMIT de file.txt

Récupérer un fichier distant :
git checkout -- file.txt //récupérer dernière version de file.txt

Déposer COMMIT sur dépot distant :
git push origin master
