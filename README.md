# Nomics API call

# Prerequisites

You have to have `docker` and `docker-composer` installed on your machine in order to run this project.

---
# Up and Running
1. clone the repository
    - `git clone git@github.com:rasadeghnasab/nomics.git`

2. cd to the repository directory
    - `cd nomics
    
3. initialize the project
    - `make project` 
    - Note: You can use `sudo make project` if it gives you any permission error

4. check databases to see if they are up or not using `make status`

5. run the project after all the services are OK
    - `make run`

---
# Clear all the containers

run `make purge` to clear all the runing containers and data