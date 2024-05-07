MIGRATE=vendor/bin/phinx

# make migrate_create name=CreateUserMigration
migrate_create:
	${MIGRATE} create $(name)

migrate_up:
	${MIGRATE} migrate

migrate_down:
	${MIGRATE} rollback