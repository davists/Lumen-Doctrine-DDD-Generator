# Lumen-Doctrine-DDD-Generator
Generates the basic files for a Domain Driven Design Application, based on Lumen and Doctrine. 

# Introduction:
There is some DDD concepts, that this tool does not implement as: ValueObject, multiple Entites per Domain and Domain Services.
The main purpose is to bootstrap the basic files and structure for the application.

#Assumptions:
For a given Domain compound by Entities the generated files are:
<b>
Domain/{DOMAIN_NAME}/Entities/{ENTITY_NAME}.php,
Domain/{DOMAIN_NAME}/Contracts/{ENTITY_NAME}RepositoryContract.php,
Infrastructure/Doctrine/Repositories/{DOMAIN_NAME}/{ENTITY_NAME}Repository.php,
Infrastructure/Doctrine/Mappings/Domain.{DOMAIN_NAME}.Entities.{ENTITY_NAME}.dcm.xml',

Application/Core/Http/Controllers/{DOMAIN_NAME}Controller.php
Application/Core/Services/{DOMAIN_NAME}Service.php
Application/Core/Providers/{DOMAIN_NAME}Provider.php

/routes/{LOWER_CASE_DOMAIN_NAME}.php 
</b><br/>
The Application Services are understood as Entrypoint for Domain.
There is one Controller, Service Application and Service Provider by Domain.
Providers map Contracts and Implementations.

#Usage
composer install <br/>
<b>check the configuration in config/ddd_generator.php </b> <br/>
<b>set the Domain definition. e.g ddd_generator/domain_defition_file_example.php </b><br/>

To generate the files:<br/>
<b>php artisan ddd:generator ddd_generator/domain_defition_file_example.php</b>

In your destination Application change composer.json as the example. <br />
```json 
  "autoload": {
    "psr-4": {
      "Application\\Core\\": "Application/core/",
      "Domain\\": "Domain/",
      "Infrastructure\\": "Infrastructure/"
    }
  },
```

#Requirements
"php": ">=5.6.4", <br />
"laravel/lumen-framework": "5.3.*", <br />
"laravel-doctrine/orm": "1.2.*",

#Application Example
https://github.com/davists/Lumen-Doctrine-DDD-Example

#References:

DDD <br/>
https://github.com/dddinphp <br/>
http://www.zankavtaskin.com/2013/09/applied-domain-driven-design-ddd-part-1.html <br/>
https://www.youtube.com/watch?v=pL9XeNjy_z4&list=PLx4mLirQvMeV0uNpo1UaculL-djjI8eTz <br/>
https://www.youtube.com/watch?v=yPvef9R3k-M <br/>
https://www.youtube.com/watch?v=dnUFEg68ESM <br/>

Hexagonal Architecture <br/>
http://fideloper.com/hexagonal-architecture <br/>
http://alistair.cockburn.us/Hexagonal+architecture <br/>
https://www.yordipauptit.com/hexagonal-architecture-in-php/ <br/>

Laravel Doctrine <br/>
http://www.laraveldoctrine.org/

XML Doctrine Mapping <br/>
http://docs.doctrine-project.org/projects/doctrine-orm/en/latest/reference/xml-mapping.html

Criteria Array to Doctrine Criteria <br/>
https://gist.github.com/jgornick/8671644

Foreign Key <br/>
https://maltronblog.wordpress.com/2015/02/15/fkrelation/
https://engineering.thetrainline.com/2015/07/23/foreign-keys-dont-go-there/
http://microservices.io/patterns/data/database-per-service.html

Generators <br/>
https://github.com/InfyOmLabs/laravel-generator
https://github.com/motamonteiro/gerador

#Author
Davi dos Santos - davi646@gmail.com
