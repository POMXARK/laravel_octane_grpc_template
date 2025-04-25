<?php

namespace App\GraphQL\Queries;

use Closure;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;

class UsersQuery extends Query
{
    protected $attributes = [
        'name' => 'users',
    ];

    public function type(): Type
    {
        return GraphQL::type('[User!]!');
    }

    public function args(): array
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::string(),
            ],
            'email' => [
                'name' => 'email',
                'type' => Type::string(),
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields): Collection
    {
        if (isset($args['id'])) {
            return User::query()->where('id' , $args['id'])->get();
        }

        if (isset($args['email'])) {
            return User::query()->where('email', $args['email'])->get();
        }

        return User::all();
    }
}

