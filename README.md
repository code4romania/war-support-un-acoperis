# Împreună pentru sănătate

[![GitHub contributors](https://img.shields.io/github/contributors/code4romania/war-support-un-acoperis.svg?style=for-the-badge)](https://github.com/code4romania/war-support-un-acoperis/graphs/contributors) [![GitHub last commit](https://img.shields.io/github/last-commit/code4romania/war-support-un-acoperis.svg?style=for-the-badge)](https://github.com/code4romania/war-support-un-acoperis/commits/master) [![License: MPL 2.0](https://img.shields.io/badge/license-MPL%202.0-brightgreen.svg?style=for-the-badge)](https://opensource.org/licenses/MPL-2.0)

[See the project live](https://tbd/en)

TBD

[Contributing](#contributing) | [Built with](#built-with) | [Repos and projects](#repos-and-projects) | [Deployment](#deployment) | [Feedback](#feedback) | [License](#license) | [About Code4Ro](#about-code4ro)

## Contributing

This project is built by amazing volunteers and you can be one of them! Here's a list of ways in [which you can contribute to this project](.github/CONTRIBUTING.md). If you want to make any change to this repository, please **make a fork first**.

If you see something that doesn't quite work the way you expect it to, open an Issue. Make sure to describe what you _expect to happen_ and _what is actually happening_ in detail.

If you would like to suggest new functionality, open an Issue and mark it as a __[Feature request]__. Please be specific about why you think this functionality will be of use. If you can, please include some visual description of what you would like the UI to look like, if you are suggesting new UI elements. 

## Built With
[Laravel](https://laravel.com) & [Bootstrap](https://getbootstrap.com)
### Programming languages
- [PHP](https://php.com)
- JavaScript
### Frontend framework
- jQuery
- Bootstrap CSS
### Package managers
- Composer
- NPM
### Database technology & provider
Mysql
## Repos and projects
https://github.com/code4romania/war-support-un-acoperis 

## Deployment

See instruction from this [wiki page](https://github.com/code4romania/war-support-un-acoperis/wiki/Local-Development-Environment) [not available]

[Docker](https://docs.docker.com/get-docker/) & [Docker-Compose](https://docs.docker.com/compose/install/) should be used on the development environment.

### Makefile
You can use `docker` or `docker-compose` to start docker containers, or you make use of the `make` shorthands. The _Makefile_ can be found in the root of the repository, and it includes a set of common commands. 

The `make` util can be used on unix based machines, and it can be installed by running `apt install make` for wsl or linux or `brew install make` for mac.

After installing `make` you can run the commands defined in the Makefile (ex: `make start`). 

If you do not want to use the `make` util, you can still check the _Makefile_ for common used commands and execute them directly in your cli.

### First start up

Copy the .env.example to .env.

In order to start the development environment, either use the `make` util to start (ex: `make start`) or run `docker-compose up` in the project root directory.

The only thing that should be triggered manually is the migrations & seeds commands after running the docker containers:
```
### with make
make migrate && make seed

### without make
docker exec -it helpforhealth_web bash

#in the container
php artisan php artisan migrate --seed
```

### Access
The main application can be accessed via http://localhost:80.

The CMS can be accessed via http://localhost:80/cms.

PhpMyAdmin can be accessed via http://localhost:8080.

If custom hosts are required in any way, you can add the following entries in your local hosts file and use them accordingly.

```bash
127.0.0.1  helpforhealth.local
```

## Feedback

* Request a new feature on GitHub.
* Vote for popular feature requests.
* File a bug in GitHub Issues.
* Email us with other feedback contact@code4.ro

## License

This project is licensed under the MPL 2.0 License - see the [LICENSE](LICENSE) file for details

## About Code4Ro

Started in 2016, Code for Romania is a civic tech NGO, official member of the Code for All network. We have a community of over 500 volunteers (developers, ux/ui, communications, data scientists, graphic designers, devops, it security and more) who work pro-bono for developing digital solutions to solve social problems. #techforsocialgood. If you want to learn more details about our projects [visit our site](https://www.code4.ro/en/) or if you want to talk to one of our staff members, please e-mail us at contact@code4.ro.

Last, but not least, we rely on donations to ensure the infrastructure, logistics and management of our community that is widely spread across 11 timezones, coding for social change to make Romania and the world a better place. If you want to support us, [you can do it here](https://code4.ro/en/donate/).
