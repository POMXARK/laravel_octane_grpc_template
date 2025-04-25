<?php

namespace App\GraphQL\Mutations;

use Closure;
use App\Models\User;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;
use Rebing\GraphQL\Support\Mutation;

class UpdateUserEmailMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateUserEmail'
    ];

    public function type(): Type
    {
        return GraphQL::type('User');
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
                'rules' => ['required', 'email']
            ]
        ];
    }

    protected function rules(array $args = []): array
    {
        return [
            // it's the same as 'required' => Type::nonNull(Type::string()), better use nonNull (GraphQL validation)
            'id' => ['required'],
            'password' => $args['id'] !== 1337 ? ['required'] : [],
        ];
    }

    public function resolve($root, array $args)
    {
        $user = User::query()->find($args['id']);
        if (!$user) {
            return null;
        }

        $user->email = $args['email'];
        $user->save();

        return $user;
    }

    public function validationErrorMessages(array $args = []): array
    {
        return [
            'email.exists' => 'Sorry, this email address is already in use',
        ];
    }

    public function validationAttributes(array $args = []): array
    {
        return [
            'email' => 'email address',
        ];
    }
}
