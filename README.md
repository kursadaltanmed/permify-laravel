# Permify Laravel Library

![Permify Laravel](https://user-images.githubusercontent.com/39353278/158953771-471a5739-fd7f-4534-a10a-89875de2b114.png)

![Twitter URL](https://img.shields.io/twitter/url?url=https%3A%2F%2Ftwitter.com%2FGetPermify)

Use [Permify](https://permify.co) in Laravel Projects.

## What is Permify?
Permify is a plug-&-play authorization API that helps dev teams create granular access control and user management systems without breaking a sweat!

You can easily create complex and flexible RBAC and ABAC solutions without dealing with any learning curve.

## Installation
Require this package in the composer.json of your Laravel project. This will download the package.
```bash
composer require permify/permify-laravel
```

The Permify\PermifyLaravel\PermifyLaravelServiceProvider is auto-discovered and registered by default, but if you want to register it yourself:

Add the ServiceProvider in config/app.php
```php
'providers' => [
    // ...
    Permify\PermifyLaravel\PermifyLaravelServiceProvider::class,
],
```

The Permify facade is also auto-discovered, but if you want to add it manually:
```php
Add the Facade in config/app.php
'aliases' => [
    // ...
    'Permify' => Permify\PermifyLaravel\Facades\PermifyFacade::class,
],
```

To publish the config, run the vendor publish command:
```bash
php artisan vendor:publish --provider="Permify\PermifyLaravel\PermifyLaravelServiceProvider" --tag="config"
```

## Usage

To get started, create the Permify client using your workspace id and API private token:

Add workspace id and API private key in config/permify.php
```php
return [
    'workspace' => '<YOUR-WORKSPACE-ID>',
    'token'    => '<YOUR-PROVATE-TOKEN>',
];
```

### Create Group
This method creates a group entity in Permify.
```php
$res = Permify::CreateGroup("post-edit", ["id" => "1"])->wait();
```

### Create User
This method creates a user entity in Permify.
```php
$res = Permify::CreateUser("group_id", ["id" => "1", "name" => "user name", "role_names" => ["role name"],  "attributes" => ["custom attribute" => 3]])->wait();
```

### Create Resource
This method creates a resource entity in Permify.
```php
$res = Permify::CreateResource("group_id", "resource type", ["id" => "1", "attributes" => ["custom attribute" => 3]])->wait();
```

### Create Role
This method creates a role entity in Permify.
```php
Permify::CreateRole("name", "group_id", ["description" => "description"])->then(function ($response) {
    // Success.
})->otherWise(function ($error) {
    // Handle Exeption.
})->wait();
```

### Create Rule
This method creates a rule entity in Permify.

### Sample Rules

#### Is the user senior?
```
user.attributes.tenure > 8
```

#### Is the user manager?
```
"manager" in user.roles
```

#### Is the user admin?
```
"admin" in user.roles
```

#### Is the user the owner of the resource?
```
user.id == resource.attributes.owner_id
```

```php
$res = Permify::CreateRule("rule name", "condition")->wait();
```

### IsAuthorized
This method returns a decision about whether the user is authorized for this action with the given parameters.

### Parameters
* ```PolicyName``` **(mandatory)**

Custom [Permify Policy](https://docs.permify.co/docs/concepts/policies/intro) name.

* ```UserID``` **(mandatory)**

Id of the [User](https://docs.permify.co/docs/concepts/users)

* ```ResourceID``` **(optional)**

Id of the [Resource](https://docs.permify.co/docs/concepts/resources), mandatory if any resource used or accessed when creating [Rule/Rules](https://docs.permify.co/docs/concepts/policies/intro#sample-rules).

* ```ResourceType``` **(optional)**

Type or name of the [Resource](https://docs.permify.co/docs/concepts/resources), mandatory if any resource used or accessed when creating [Rule/Rules](https://docs.permify.co/docs/concepts/policies/intro#sample-rules).

```php
$res = Permify::IsAuthorized("post-edit", "user_id", ["resource_id" => "1", "resource_type" => "posts"])->wait();
```

## Using a middleware

This package comes with PermifyMiddleware. You can add them inside your app/Http/Kernel.php file.
```php
protected $routeMiddleware = [
    // ...
    'permify' => \Permify\PermifyLaravel\Middlewares\PermifyMiddleware::class,
];
```

## Basic Permify Middleware

Then you can protect your routes using middleware rules:
```php
Route::post('/posts', function (Request $request) {
    return "pass";
})->middleware(['auth.basic', 'permify:post-create']);
```

with resource:
```php
Route::put('/posts/{id}', function (Request $request) {
    return "pass";
})->middleware(['auth.basic', 'permify:post-edit,posts,id']);
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email tolga@permify.co instead of using the issue tracker.

## Credits

-   [Tolga Ozen](https://github.com/permify)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Need More, Check Out our API

Permify API is an authorization API which you can add complex rbac and abac solutions.

[<img src="https://user-images.githubusercontent.com/39353278/157747851-ea8462be-60a4-498e-872a-e44cf42411b0.png" width="419px" />](https://www.permify.co/get-started)

<h2 align="left">:heart: Let's get connected:</h2>

<p align="left">
<a href="https://twitter.com/GetPermify">
  <img alt="guilyx | Twitter" width="50px" src="https://user-images.githubusercontent.com/43545812/144034996-602b144a-16e1-41cc-99e7-c6040b20dcaf.png"/>
</a>
<a href="https://www.linkedin.com/company/permifyco">
  <img alt="guilyx's LinkdeIN" width="50px" src="https://user-images.githubusercontent.com/43545812/144035037-0f415fc7-9f96-4517-a370-ccc6e78a714b.png" />
</a>
</p>