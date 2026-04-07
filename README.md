# symfony graffiti

A small Symfony test project built to try out [Graffiti UI](https://graffiti-ui.com/) in a real CRUD setup.

It includes a blog with create/read/update/delete flows, a dashboard, and a settings page for testing theme behavior so
you can quickly experiment with Graffiti UI components and utility classes in a practical app context.

## What do you need this for?

Have a local php install, using sqlite. If you want you can use any doctrine supported database, but you will need to
change the database configuration in `.env` and install the relevant php extension.

You also nee a local [symfony cli](https://symfony.com/download) install, to run the server and execute console
commands.

## Installation

1. Clone the repository:

```
git clone git@github.com:disjfa/symfony-graffity.git
```

2. Install dependencies with Composer:

```
composer install
```

3. Set up your database and run migrations:

```
bin/console doctrine:database:create
bin/console doctrine:schema:update --force
bin/console doctrine:fixtures:load
```

4. Start the Symfony server:

```
symfony server:start
```

5. Access the app at `http://localhost:8000` and explore the blog, dashboard, and settings pages to see Graffiti UI in
   action!
