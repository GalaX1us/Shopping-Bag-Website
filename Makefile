

default: all

.PHONY: update
update:: ## fais les modifications git (git pull, git commit puis git push et enfin git status)

	git pull
	@read -p "Entrez le commentaire de la modification : " commentaire; \
	git commit -m "$$commentaire" -a
	git push
	git status



