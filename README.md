# Împreună pentru sănătate

[![GitHub contributors](https://img.shields.io/github/contributors/code4romania/war-support-un-acoperis.svg?style=for-the-badge)](https://github.com/code4romania/war-support-un-acoperis/graphs/contributors) [![GitHub last commit](https://img.shields.io/github/last-commit/code4romania/war-support-un-acoperis.svg?style=for-the-badge)](https://github.com/code4romania/war-support-un-acoperis/commits/master) [![License: MPL 2.0](https://img.shields.io/badge/license-MPL%202.0-brightgreen.svg?style=for-the-badge)](https://opensource.org/licenses/MPL-2.0)

[See the project live](https://tbd/en)

TBD

[Contributing](#contributing) | [Built with](#built-with) | [Repos and projects](#repos-and-projects) | [Deployment](#deployment) | [Feedback](#feedback) | [License](#license) | [About Code4Ro](#about-code4ro)

## Contributing

This project is built by amazing volunteers and you can be one of them! Here's a list of ways in [which you can contribute to this project](.github/CONTRIBUTING.md). If you want to make any change to this repository, please **make a fork first**.

If you see something that doesn't quite work the way you expect it to, open an Issue. Make sure to describe what you _expect to happen_ and _what is actually happening_ in detail.

If you would like to suggest new functionality, open an Issue and mark it as a **[Feature request]**. Please be specific about why you think this functionality will be of use. If you can, please include some visual description of what you would like the UI to look like, if you are suggesting new UI elements.

## Built With

[Laravel](https://laravel.com) & [Bootstrap](https://getbootstrap.com)

### Programming languages

-   [PHP](https://php.com)
-   JavaScript

### Frontend framework

-   jQuery
-   Bootstrap CSS

### Package managers

-   Composer
-   NPM

### Database technology & provider

Mysql

## Repos and projects

https://github.com/code4romania/war-support-un-acoperis

## Deployment

See instruction from this [wiki page](https://github.com/code4romania/war-support-un-acoperis/wiki/Local-Development-Environment) [not available]

[Docker](https://docs.docker.com/get-docker/) & [Docker-Compose](https://docs.docker.com/compose/install/) should be used on the development environment.

### MacOS & Linux

If running on Linux, make sure to give proper permissions to the storage folder

```shell
	chmod -R 777 storage/
```

Run `make install` to build, start containers and run migration

Some other useful make commands:

-   `make start` - start an already installed application
-   `make shell` - open an bash inside the php container
-   `make npm-watch` - start npm hot-reloading for js files

### Windows

You can install `make` on windows using [GNUWin32](http://gnuwin32.sourceforge.net/packages/make.htm) or you can use WSL(Windows Subsystem for Linux).
Afterward you can use all the commands from the MacOS & Linux section

The application can be installed without using `make` by running the following commands:

```shell
	cp .env.example .env
	docker-compose up -d
	docker-compose exec php sh -c 'composer install'
	docker-compose exec php sh -c 'php artisan migrate --seed'
```

Some other useful commands:

-   `docker-compose up -d` - start an already installed application
-   `docker-compose exec php bash` - open an bash inside the php container
-   `docker-compose run --rm nodejs sh -c 'npm run watch'` - start npm hot-reloading for js files

### Access

The main application can be accessed via http://localhost:80.

The CMS can be accessed via http://localhost:80/cms.

PhpMyAdmin can be accessed via http://localhost:8080.

If custom hosts are required in any way, you can add the following entries in your local hosts file and use them accordingly.

```bash
127.0.0.1  un-acoperis.local
```

## Feedback

-   Request a new feature on GitHub.
-   Vote for popular feature requests.
-   File a bug in GitHub Issues.
-   Email us with other feedback contact@code4.ro

## License

This project is licensed under the MPL 2.0 License - see the [LICENSE](LICENSE) file for details

## About Code4Ro

Started in 2016, Code for Romania is a civic tech NGO, official member of the Code for All network. We have a community of over 500 volunteers (developers, ux/ui, communications, data scientists, graphic designers, devops, it security and more) who work pro-bono for developing digital solutions to solve social problems. #techforsocialgood. If you want to learn more details about our projects [visit our site](https://www.code4.ro/en/) or if you want to talk to one of our staff members, please e-mail us at contact@code4.ro.

Last, but not least, we rely on donations to ensure the infrastructure, logistics and management of our community that is widely spread across 11 timezones, coding for social change to make Romania and the world a better place. If you want to support us, [you can do it here](https://code4.ro/en/donate/).
