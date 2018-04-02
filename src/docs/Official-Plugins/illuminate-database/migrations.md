### Migrations

This plugin also provides a migration engine.

This is **not** `artisan migrate` though; this is a completely different solution that uses Electro's migrations engine coupled to a Workman task runner interface.

Although the available commands are (purposefully) quite similar to Laravel's migration commands, there are some subtle differences.

#### Available commands

Command              | Description
---------------------|-----------------------------------------------------------------------------------------
`make:migration`     | Create a new database migration.
`make:seeder`        | Create a new database seeder.
`migrate`            | Runs all pending migrations of a module, optionally up to a specific version.
`migrate:refresh`    | Reset and re-run all migrations.
`migrate:reset`      | Rollback all database migrations.
`migration:rollback` | Reverts the last migration of a specific module, or optionally up to a specific version.
`migration:seed`     | Run all available seeders of a specific module, or just a specific seeder.
`migration:status`   | Print a list of all migrations of a specific module, along with their current status.

You can also type `workman` on the terminal to get a list of available commands.

Type `worman help xxx` (where `xxx` is the command name) to know which arguments and options each command supports.

