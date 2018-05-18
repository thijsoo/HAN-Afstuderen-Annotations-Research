# HAN-Afstuderen-Annotations-Research
Repository for Labs  about Symfony 4 annotations.



To create new LAB follow these steps:

1. ```composer create-project symfony/skeleton {labname}```  
2. ``` cd {labname} ```  
3. ```composer require annotations asset orm-pack twig logger mailer form security translation validator```  
4. ```composer require --dev dotenv maker-bundle orm-fixtures profiler server```


To run a LAB:

1. ```cd {labname}```
2. ```composer install```
3. ```php bin/console server:start```
4. ```open route url for lab```
