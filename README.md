# Nomics API call

# Prerequisites

You have to have `docker` and `docker-composer` installed on your machine in order to run this project.

---
# Up and Running
1. clone the repository
    - `git clone git@github.com:rasadeghnasab/nomics.git`

2. cd to the repository directory
    - `cd nomics
    
3. up and run the whole project
    - `make project` 
    - Note: You can use `sudo make project` if it gives you any permission error

---
# Useful make commands

Here we listed some useful commands that you can use to develop the application:

### Docker commands
- Run all the necessary containers to make project work and accessible through a URI and PORT
    - `make up`
    
- Stop all the containers and free resources and ports
    - `make down`

### Back-end commands

- Install laravel composer packages and create `.env` file from the `.env.example`
    - `make laravel-dep`

- Run all the tests
    - `make test`
    
- You can run a specific test by passing the `filter` argument to the command
    - `make test filter=TEST_FILE_OR_FUNCTION`
