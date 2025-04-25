https://github.com/rebing/graphql-laravel#eager-loading-relationships

http://127.0.0.1/graphql/default

```shell
query FetchUsers {
    users {
        id
        email
    }
}
```

```shell
mutation UpdateUserPassword {
    updateUserPassword(id: "1", password: "newpassword") {
        email
        id
    }
}
```
