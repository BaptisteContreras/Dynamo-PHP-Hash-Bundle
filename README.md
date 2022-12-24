# Dynamo-PHP-Hash-Bundle

## Goal

This Symfony bundle is a bridge to use the [Dynamo-PHP-Hash Lib](https://github.com/BaptisteContreras/Dynamo-PHP-Hash) in a Symfony application.

The bundle provides an Interface (**Dynamophp\HashBundle\Service\DynamoHasherInterface**) to easily use a preconfigured [Hasher](https://github.com/BaptisteContreras/Dynamo-PHP-Hash/blob/master/src/Hasher.php).

## Usage

```composer require dynamophp/hash-bundle```

## Configuration
```yaml
dynamo_php_hash:
  start_selection: 3
  end_selection: 0
```

- **start_selection** : Selection the X first hexits from the result of the primary hash function.
- **end_selection** : Selection the X last hexits from the result of the primary hash function.

More information about this implementation can be found [here](https://github.com/BaptisteContreras/Dynamo-PHP-Hash).

For the moment the bundle only provides a **sha256** hasher version, which uses this algorithm as the primary hash function of the underlying hasher.

## Usage in your code

In your Controller : 

```php
DemoController.php

#[Route('/demo/', name: 'demo_')]
class DemoController extends AbstractController
{
    #[Route(name: 'index')]
    public function demoIndex(DynamoHasherInterface $dynamoHasher): Response
    {
        dump($dynamoHasher->hash('ob')); // 48
        dump($dynamoHasher->hash('oc')); // 32
        dump($dynamoHasher->hash('od')); // 23
        dump($dynamoHasher->hash('a')); // 38
        dump($dynamoHasher->hash('b')); // 22
        
        return new JsonResponse('ok');
    }
}
```

In your Service :

```php
DemoService.php

class DemoService extends AbstractController
{
    public __construct(private readonly DynamoHasherInterface $dynamoHasher){}
    
    public function doSmth(string $value): void
    {
        dd($dynamoHasher->hash($value)); 
    }
}
```

