# Lucrare de laborator Nr8: Integrare continua cu Github Actions

## Scopul lucrarii
In cadrul acestei lucrari am invatat cum sa configuram integrarea continua (CI) cu ajutorul GitHub Actions pentru o aplicatie Web PHP rulata in containere Docker.

## Sarcina
- Crearea unei aplicatii Web in PHP cu SQLite.
- Scrierea de teste pentru aplicatie.
- Configurarea CI cu GitHub Actions folosind containere Docker.

## Descrierea lucrarii

1. Am creat un proiect nou `containers08` si am adaugat structura aplicatiei in directorul `./site/`:
```
site
├── modules/
│ ├── database.php
│ └── page.php
├── templates/
│ └── index.tpl
├── styles/
│ └── style.css
├── config.php
└── index.php
```
3. Am creat o baza de date SQLite si scriptul `schema.sql` pentru a popula initial baza de date cu 3 pagini.

4. Am scris teste unitare pentru toate metodele claselor `Database` si `Page` in fisierele din directorul `./tests`.

5. Am configurat un fisier `Dockerfile` care:
   - Instaleaza extensia `pdo_sqlite`
   - Construieste baza de date
   - Copiaza aplicatia in container

6. Am configurat GitHub Actions in `.github/workflows/main.yml` pentru a:
   - Rula build-ul Docker
   - Crea containerul
   - Copia testele
   - Rula testele
   - Sterge containerul

7. Am facut commit si push pe GitHub, apoi am verificat in fila **Actions** ca toate testele ruleaza cu succes.

## Intrebari

**1. Ce este integrarea continua?**  
Integrarea continua (CI) este o practica DevOps care presupune rularea automata a build-ului si testelor de fiecare data cand este facut un commit sau un pull request. Aceasta ajuta la identificarea rapida a erorilor si la mentinerea calitatii codului.

**2. Pentru ce sunt necesare testele unitare? Cat de des trebuie sa fie executate?**  
Testele unitare verifica daca functiile individuale din cod functioneaza corect. Ele trebuie rulate:
- La fiecare modificare de cod (commit)
- Automat in pipeline-ul CI
- Optional, si manual in faza de dezvoltare

**3. Care modificari trebuie facute in fisierul `.github/workflows/main.yml` pentru a rula testele la fiecare solicitare de trage (Pull Request)?**  
In sectiunea `on`, trebuie adaugat:
```yaml
on:
  push:
    branches:
      - main
  pull_request:
    branches:
      - main

```
4. Ce trebuie adaugat in fisierul .github/workflows/main.yml pentru a sterge imaginile create dupa testare?  
Se adauga un pas nou la finalul workflow-ului:
```
name: Remove Docker image
run: docker rmi containers08
```
Concluzie  
Am invatat cum sa creez o aplicatie web in PHP, sa scriu teste pentru aceasta si sa configurez integrarea continua folosind GitHub Actions. Procesul automatizat ajuta la identificarea rapida a problemelor si creste fiabilitatea aplicatiei.


