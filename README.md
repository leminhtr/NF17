git log	//historique des actions
git config credential.helper store //stocker id -> permet de rester logger


//Démarrer/Configurer une session
git config --global user.name "pseudo"	//pseudo pour la session
git config --global user.email mail@email.com	//mail
git init //créer dépot Git

git config --global color.diff auto	//environnement
git config --global color.status auto	//environnement
git config --global color.branch auto	//environnement





dossier local ->  dossier temp INIT -> dossier validation HEAD -> SERVEUR

local vers INIT
git add file.txt // add file.txt au commit
git add -A	// add all file au commit


valider INIT vers HEAD
git commit -m "commentaire info obligatoire sur git" // msg d'info
git commit --amend -m "Here the new comment" // modifier commentaire


Déposer COMMIT (HEAD) sur dépot distant :
git push origin master


Annuler COMMIT (INIT vers HEAD):
git reset HEAD // annuler le COMMIT
git reset HEAD file.txt //annuler COMMIT de file.txt


Récupérer dossier distant :
git pull	//mettre à jour local par dossier distant


Récupération en cas de problème :
git checkout -- file.txt //remplace le file.txt local par le file.txt de HEAD, en cas d'erreur en local
git fetch origin et ensuite faire git reset --hard origin/master //supprimer TOUS les changements et validations (local, INIT, HEAD) et remplacer par dossier distant.



