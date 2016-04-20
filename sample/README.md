Sample Blog for Symfony Beginners
================================

Please view the raw file of README :  
https://raw.githubusercontent.com/wwwbbb8510/symfony_startup_sample/master/README.md
--------------------------------

This is a simple sample which I - who was blank to Symfony -
was making along with reading symfony documents during three days.
Now I pushed it here just as some materials for beginners,
and hope it will help you start your symfony career.

Download and install this project
-------------------------------
1). Install Composer
    Download and install composer from https://getcomposer.org/.
    Follow the steps to install composer

2). Download Souce Code of this project
    Use TortoiseGit Clone the link: https://github.com/wwwbbb8510/symfony_startup_sample
    Or use git clone to get it

3). Download and install dependencies
    Open a bash or windows cmd
    Go to the directory of symfony_startup_sample
    Execute the command: composer update

4). Clear symfony cache
    Execute the command: php app/console cache:clear --env=dev

5). Create Mysql user for this project
    The user used by this project is: (username: symfony_sample, password:symfony_sample_mysql, database: symfony)
    There are two ways to make it work. The first way is to create Mysql user as aforementioned.
    The second way is to create Mysql user as you want and then ajust the parameters in \app\config\parameters.yml

6). Run server by symfony console
    Execute the command: php app/console server:run

7). Enjoy the ugly but functional pages
    Open the url: http://localhost:8000/app_dev.php/login


Code Explanation
-------------------------------
1). How to use composer to integrate bootstrap
    First: add the following code in \composer.json require tag
    "require": {
        --------------------------
        "braincrafted/bootstrap-bundle": "~2.0",
        "twbs/bootstrap": "3.0.*",
        "jquery/jquery":  "1.10.*",
        "oyejorge/less.php": "~1.5",
    }
    Second: configure braincrafted_bootstrap referring to \app\config\config.yml
            add "new Braincrafted\Bundle\BootstrapBundle\BraincraftedBootstrapBundle()" in kenel
    Third: execute command: composer update

2). How to use composer to install phpunit
    Add following code in \composer.json require tag
    "require": {
        --------------------------
        "phpunit/phpunit": "4.2.*"
    }
    execute command: composer update

3). Steps of create basic pages
    a). Create Bundle
        php app/console generate:bundle --namespace=Stvn/UserBundle --format=yml
    b). Edit Stvn\UserBundle\Controller\DefalutController.php or copy and create your own
    c). Edit router in Stvn\UserBundle\Resources\config\routing.yml
    d). Create three-layer templates
        First Layer: app\Resources\views\base.html.twig
        Second Layer: Stvn\UserBundle\Resources\views\layout.html.twig
        Third Layer: Stvn\UserBundle\Resources\views\Default\login.html.twig
    e). Create form and set form validation without form class
        Refer to Stvn\UserBundle\Controller\DefaultController\loginAction
    f). Mysql Manipulation --- Persist an object with Doctrine
        Create Entity: Stvn\UserBundle\Entity\User.php
        Generate setters and getters: php app/console doctrine:generate:entities Stvn/UserBundle/Entity/User
        Refer to Stvn\UserBundle\Controller\DefaultController\loginAction
    g). Render a form
        Refer to Stvn\UserBundle\Resources\views\Default\login.html.twig

4). Create a form with form class
    a). Create a FormType: Stvn\UserBundle\Form\Type\UserType
    b). Create form: refer to Stvn\UserBundle\Controller\DefaultController\signAction
    c). Add validation for the Entity: Stvn\UserBundle\Resources\config\validation.yml

5). Using Doctrine with Custom Repository Class
    a). Create Repository: Stvn\BlogBundle\Entity\CategoryRepository.php
    b). Manipulating Mysql: Stvn\BlogBundle\Controller\DefaultController\indexAction

6). Entity associations
    a). Anotations for one-to-many entity: Stvn\BlogBundle\Entity\Category.php
    b). Anotations for many-to-one entity: Stvn\BlogBundle\Entity\Article.php
    c). Persist Associated Entities: Stvn\BlogBundle\Controller\DefaultController\addCategoryAction

7). Use phpunit to do functional test
    a). Edit app\phpunit.xml.dist
        Anotate test bundles and add what you need to test like <directory>../src/*/UserBundle/Tests</directory>
    b). Code php test code
        Refer to Stvn\UserBundle\Tests\Controller\DefaultControllerTest.php
    c). Execute command:
        php vendor/phpunit/phpunit/phpunit -c app/    
