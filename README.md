# Command Bus 

> Simple Command Bus for Laravel framework

## Installation
    composer require rosamarsky/laravel-command-bus
    
Add the Service Provider to the providers array in `config/app.php`

```php
Rosamarsky\CommandBus\CommandBusServiceProvider::class,
```

## Example

```php
class UserController extends AbstractController
{
    public function store(Request $request)
    {
        $user = $this->dispatch(new RegisterUser(
            $request->input('email'),
            $request->input('password')
        ));
    
        return $user;
    }
}
```

## Usage

#### Command

```php
class RegisterUser implements \Rosamarsky\CommandBus\Command
{
    private $email;
    private $password;
    
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
    }
    
    public function email()
    {
        return $this->email;
    }
    
    public function password()
    {
        return $this->password;
    }
}
```

#### Handler

```php
class RegisterUserHandler implements \Rosamarsky\CommandBus\Handler
{
    private $userRepository;
    
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function handle(\Rosamarsky\CommandBus\Command $command)
    {
        $user = new User(
            $command->email(),
            $command->password()
        );
        
        $this->userRepository->store($user);
        
        return $user;
    }
}
```

#### Controllers 

```php
class AbsctractController extends \Illuminate\Routing\Controller
{
    private $dispatcher;
    
    public function __construct(\Rosamarsky\CommandBus\CommandBus $dispatcher) 
    {
        $this->dispatcher = $dispatcher;
    }
    
    public function dispatch(\Rosamarsky\CommandBus\Command $command)
    {
        return $this->dispatcher->execute($command);
    }
}
```

```php
class UserController extends AbstractController
{
    public function store(Request $request)
    {
        $user = $this->dispatch(new RegisterUser(
            $request->input('email'),
            $request->input('password')
        ));
    
        return $user;
    }
}
```