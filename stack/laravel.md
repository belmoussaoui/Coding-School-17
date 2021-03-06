﻿# Laravel
désactivation de l'antivirus car un fichier de laravel est considéré comme un virus.

https://laracasts.com/
https://laravel.sillo.org/

## installation
https://5balloons.info/how-to-install-laravel-with-mamp-on-mac-os/

### windows
- utilisation de [**laragon**](https://laragon.org/).
https://sourceforge.net/projects/laragon/files/releases/4.0/laragon-full.exe/download
- la dernière version de nodejs (binary zip!)
https://nodejs.org/en/download/
- version 7 de php
- la dernière version de composer: https://getcomposer.org/download/
- phpmyadmin: https://www.phpmyadmin.net/

dans le dossier bin de laragon (la racine du pc), il faut remplacer composer.phar, la version de node, la version de php
dans laragon/etc/apps mettre phpMyAdmin

### mac
- mamp: https://www.mamp.info/en/windows/

https://www.apprendre-laravel.fr/laraguide/2017-11-02-installation-d-un-projet-laravel-avec-macos

```
curl -sS [https://getcomposer.org/installer](https://getcomposer.org/installer "https://getcomposer.org/installer") | php
```
```
mv composer.phar /usr/local/bin/composer
```

```
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"
```
```
brew install php@7.4
echo 'export PATH="/usr/local/opt/php@7.4/bin:$PATH"' >> ~/.zshrc
echo 'export PATH="/usr/local/opt/php@7.4/sbin:$PATH"' >> ~/.zshrc
```

```
composer global require "laravel/installer"
```

***tous les projets laravel dans :
Applications ▹ MAMP ▹ htdocs***

`source ~/.bash_profile`

## introduction
### creation de projet
``laravel new mon-premier-projet``

## architecture
laravel a une architecture **MVC** (model view controller)
model : base de données
view :  l'interface
controller (gestion de la base de donnée et de ce qu'on voit)

chaque fichier fait une seule chose et c'est pour ca qu'il y a beaucoup de fichiers

- app
il va gérer tous , relation entre l'application et la base de données. c'est là ou se trouve les controllers et la base de données
	- console et exceptions
	pas utile (juste des messages d'erreurs
	- http
	on va utiliser les **controllers** (quoi faire) (des fonctions qui permettent la suppression, création et modification) et les middleware (qui peut exécuter les controllers).
	- model
	relation entre la base de données et les tables du projet
	- providers
	donne l'autorisation des middleware a être exécuté dans des parties du projet (les middleware seront principalement dans les routes)

- bootstrap
gestion de l'interface (on va pas utiliser car on utilisera des interfaces déjà faites)

- config
des paramètres pour notre application
(on peut change le nom du domaine et plein d'autres paramètres)

	- timezone
on peut modifier le fuseau horaire et le remplacer paf 
`timezone' => "utc-8",`
`'timezone' => "Europe/Brussels",`

- database
pour travaille sur la base de données. séparation de la création des tables et du contenue.
	- factories
	valeurs automatiquement (aléatoire) via une librairie "faker". c'est une usine pour donner des valeurs par défauts. pour éviter de créer des utilisateurs à la main via une libraire. c'est surtout pour tester.
	- migrations
	création de tables (petites parties de la base de données): une table c'est un objet avec des propriétés.
3 tables sont déjà faits

	- seeders
	création des valeurs manuellement (soit on utilise le seeders soit factories)

- public
	- index.php
	aller dans un dossier est grâce aux routes ce qu'il doit executer (il remplace index.html). on le laisse tel quel.

- resources
dossier de production (css, js, ...) il le met dans public par la suite.

	- views
	les views sont ce qui remplace le contenu html et *.blade.php* c'est comme du jsx en quelque sorte. c'est du html dans php.

- routes
ce sont les url. on indique la route `/...` et la vue attribuée.
le chemin et ce qu'il doit faire

	les *broadcast* sont les notifications et les popups (on va pas voir ca)

- storage
stockage des images
	- app
	- framework
	- logs

- tests
les tests unitaires (les requêtes) 

- vendor
c'est le node_modules de php

- fichiers
	- .env : la relation pour recevoir et envoyer des requêtes
	`DB_PORT=8889` a mettre sur mac
	`DB_PASSWORD=root`
	- artisan: permet d'executer des commandes
	- composer.json : c'est comme package.json
	composer i pour installer les dépendances
	- server.php: l'antivirus veut le supprimer (il est utiliser par php artisan serve)
	- webpack.mix: c'est pour indiquer quoi watch les ressources

## Fonctions
### dump and die
c'est comme un console.log
```php
dd($tableau); // affiche le tableau
```

## Routes
#### get
à besoin de deux paramètres, une url et une action (sous forme de fonction) qui retourne un rendu.

##### view
on peut retourner un fichier `.blade.php` avec la fonction `view`.

```php
Route::get("/", function  () {
	return  view("index");
});
```

pour passer des variables à view
```php
Route::get("/contact", function  () {
	return view("contact", ['name' => 'Victoria']);
});
```
ou 
https://www.php.net/manual/fr/function.compact.php
```php
Route::get("/contact", function  () {
$name = "Victor";
	return  view("contact",  compact("name"));
});
```

en laravel on préfère utiliser le `.` pour indiquer d'aller chercher le chemin dans le dossier au lieu de `/`. on fait une différence entre le chemin et ou se trouve les fichiers.
```php
Route::get("/contact", function  () {
$name = "Victor";
	return  view("pages.contact",  compact("name"));
});
```

on peut donner des noms à des routes pour éviter de mettre des url
```php
Route::get('/', function  () {
	return  "Bonjour chers utilisateurs";
})->name("pagePrincipale");
```
et ensuite
```php
<a  href={{ route("pagePrincipale") }}>à propos</a>
```

##### routes dynamiques
toujours mettre les routes dynamiques à la fin (après les routes normales.
```php
Route::get("/{chiffre}", function  ($x) {
	return  "Le chiffre que j'ai ajouté est $x";
});
```

#### post

#### delete

### Pattern
on peut définir des patterns pour les routes via les regex et un identifiant.
https://laravel.com/docs/4.2/routing#route-parameters

## blade.php
ce sont des fichiers  ou on peut mettre du html mélangé avec du php pour représenté une vue.

### variables
on utilise le doubles accolades qui est equivalent à une balise php.

### condition
if else
```php
@if ()
	...
@else
	...
@endif
```

le switch
```php
@switch($type)
	@case(1)
		...
		@break
	@case(2)
		...
		@break
	@default
		...
@endswitch
```

### for loop
```php
@foreach ($tableau  as  $elem)
	<h1>mon element = {{  $elem  }}!</h1>
@endforeach
```

```php
@for ($i = 0; $i < count($tableau); $i++)
	<h1>mon element = {{  $tableau[$i] }}!</h1>
@endfor
```

### divers
#### variables optionnels pour une vue
on utilise deux points d'interrogations `??` pour indiquer une valeur par défaut:
```php
<body>
	<span>Bonjour {{  $prenom ?? "bilal"  }}  {{  $nom ?? "el moussaoui"  }}</span>
</body>
```

## bootstrap
avant il y avait tout (vue, react, bootstrap) qui étaient pré-installés. maintenant il faut installer soit même ce qu'on a besoin (c'est mieux!)
https://www.itsolutionstuff.com/post/laravel-8-install-bootstrap-example-tutorialexample.html (bootstrap 4)
```
composer require laravel/ui
php artisan ui bootstrap
```
ensuite il faut modifier la version de bootstrap le package.json
```json
"bootstrap": "^5.0.0-beta3",
```
et pour finir
```
npm install @popperjs/core
npm install && npm run dev
```
la commande `npm run dev watch` permet de compiler tous ce que est dans le dossier ressource dans le public

et la vrai fin 
```
npm run dev
```

### les liens
`asset` va directement chercher dans le dossier public. on utilise pas `/js/main.js` car le `/` fait référent à un projet local. nous on veut faire référence au nom du domaine du site
```php
<link  rel="stylesheet"  href={{  asset("css/app.css")  }}>

<script  src={{  asset("js/app.js")  }}></script>
```

## utilitaires
laravel permet d'utiliser des fonctions pré-faites.
```
$fruits = Arr::shuffle(["pomme", "fraise", "banane", "ananas"]);
```

## template
on peut créer des template pour factoriser le code. on crée un dossier `layout` et un fichier `app.blade.php` . **layout c'est les structures de bases d'un fichiers**.

on peut aussi créer un dossier `partials` pour y mettre des composants. **les partials sont les sections, header, footer...**

### yield
le yield est une méthode qui permet d'injecter du code avec un nom qui permet de l'identifier. c'est pour indiquer quoi et ou injecter du code. c'est dans les fichiers qui se trouvent dans le `layout`
```php
@yield("content")

@section("test")
	<h1>hello world</h1>
@show
```

### extends
on peut étendre un layout qui comport un `yield` avec des composants avec le `@extends`. (directement dans la vue)
```php
@extends("layouts.app")

// section en relation avec le yield 
@section('content')
	@include("partials.nav")
	<h1>je suis un h1</h1>
	@include("partials.footer")
@endsection

// on peut faire extension d'une section du parent
@section('test')
	@parent // affiche le contenu du parent
	<p>lorem...</p>
@endsection
```

### include
permet d'injecter directement une view dans une autre
```php
@include("component")
```

## migrations

### introduction
créer une base de données sur phpmyadmins avec le même nom que le projet laravel.
`DB_PORT=8889` sur mac
`DB_USERNAME=username`
`DB_PASSWORD=password`

### migrations
prendre un table et la mettre dans la base de données

#### la commande migration
```
php artisan migrate
```
convention laravel
- **up** prendre ca et la mettre dans la base de données
- **down** supprime de la base de données
#### create user table
- `Schema::create` : nom de base de données et une action.
la variable `$table` permet de créer des colonnes.

- `id()` -> primary key auto_increment integer unsigned;
- `string(name, length=255) `-> c'est un **varchar**;
-  string("email")->unique() -> un seul mail identique dans la table pour éviter de s'inscrire plusieurs fois avec la même adresse.
- timestamp('email_verified_at')->nullable() -> mets une date pour la vérification du mail. donc par défaut elle est à null car pas encore vérifier.
- rememberToken() -> enregistrement pour identifier l'utilisateur
- timestamp() -> la dernière mise à jour du compte (changement photo de profil, description, etc)

## seeders
pour créer un seeder (insertion de données dans une table), on utilise la commande suivante:

```bash
php artisan // donne tous les commandes possibles
php artisan make:seeder UserSeeder // en singulier
```

### insertion de données
pour utiliser une base de donnée:
```php
use Illuminate\Support\Facades\DB;

//...

public function run() {
	// utilisateur 1
	DB::table("users")->insert([
		"name"  =>  "Bilal",
		"email"  =>  "bilal@molengeek.com",
		"password"  =>  "motDePasse",
		"created_at" =>  now()
	]);
	// utilisateur 2
	DB::table("users")->insert([
		"name"  =>  "Elias",
		"email"  =>  "elias@molengeek.com",
		"password"  =>  "testtest",
		"created_at"  =>  now()
	]);
}
```
et ensuite dans `DatabaseSeeder` pour appeler notre seeder :
```php
// ...
public function run() {
	$this->call(UserSeeder::class);
}
```

### db:seed (insertion)
pour insérer les données des seeders dans la base de donnée:
```
php artisan db:seed
```
exécute ce que trouve dans les seeders pour les insérer dans la base de données

### migrate:fresh (supprimer les tables)
si on a fait une erreur et qu'on a besoin de supprimer les tables et les recréer.
```
php artisan migrate:fresh
```
et ensuite pour la remplir
```
php artisan db:seed 
```

### make:migration (création de tables)
il faut respecter la convention pour le nom du fichier
``
php artisan make:migration create_personnes_table
``
cela va créer un fichier dans le dossier migration avec comme nom la date de création et le paramètre passé dans la commande précédente.

```php
public  function  up() {
	Schema::create('personnes', function  (Blueprint  $table) {
		$table->id();
		$table->string("name");
		$table->unsignedInteger("age");
		$table->date("ddn");
		$table->timestamps();
	});
}
```
et ensuite on lance la commande suivante:
```
php artisan migrate
```
cela ne va executer que les migrations qui n'ont pas été fait.

on crée le seeder:
```
php artisan make:seeder PersonneSeeder
```
et on réalise **l'insertion de données** (voir section correspondante)


## models
le but principal est de **communiquer** avec la base de données (mysql) et la vue (blade). c'est ce qui sera afficher dans la vue. il permet aussi de protéger les propriétés et les valeurs de la table.

chaque table à son propre modèle dans le dossier `app/Models/`.

### les propriétés
- **table**
la ligne suivante permet de protéger la table `users` et éviter d'appliquer des modifications en dehors de la classe. c'est la table associée avec le modèle.

```php
protected $table = "users";
```

- **fillable**
ce sont les données (colonnes) qui vont avoir beaucoup de valeurs (valeur en masse).
```php
protected $fillable = ['name', 'email', 'password'];
```

- **hidden**
ce sont les données (colonnes) qui doit être protégés
```php
protected  $hidden  = ['password', 'remember_token'];
``` 

- **casts**
ce sont pour les données de type `timestamp` (créer et update) qui n'ont pas de données par défaut. donc on doit spécifier un type (string, date, integer) dans ce tableau.
```php
protected  $casts  = ['email_verified_at'  => 'datetime'];
```

### php artisan make:model Name
pour la création d'une classe modèle. à chaque fois 
```
php artisan make:model Voiture
```
on peut aussi utiliser la commande suivante pour créer un modèle avec une migration et une factory/seeder
```
php artisan make:
```
pour avoir accès au model
```php
$users = User::all();
dd($users[2]->name);
```
on évitera d'utiliser les crochets (l'index) pour avoir accès à une données car elle ne permet pas d'identifier une donnée. car on peut supprimer les données est les index sont ré-attribuer mais pas les `id`. donc on utiliser les `id` pour avoir accès à une donnée:
```php
$users = User::first(); // [0]
$users = User::find(5); // selon l'id
$users = User::where('nom', 'bilal')->get(); // affiche les données qui respectent la condition sous forme de tableau
$users = User::where('id', 5)->first(); // équivalent à ::find(5);
```


## factory
permet de créer des données de manières automatique comme si c'était une usine. la classe factory a un attribut `faker` qui permet de générer des données.

### faker
c'est un librairie qui permet de générer des données et qui est accessible à partir de l'attribut `$faker`.
https://github.com/fzaninotto/Faker

pour générer un mot de passe par exemple on fait la ligne de code suivante
```php
'password'  =>  Hash::make($this->faker->password()),
```
la méthode `Hash::make(password)` permet de crypter un mot de passe.

### propriétés
- **$model**
le lien avec le modèle qui détient également la table.

### seeder
pour générer des données et les insérer dans la table liée à notre modèle
```php
\App\Models\User::factory(10)->create();
```
ou
```php
use App\Models\User;
// ...
User::factory(10)->create();
```
et ensuite on lance dans le terminal
```
php artisan db:seed
```

## controller
il y a un controller par table.
le back office permet la gestion des données pour le client qui n'as pas besoin de passer par `mysql` ou `phpmyadmins`.

ca se divise en 5 parties:
- afficher (read)
retourner tous les éléments qui sont dans une table spécifiée.
- afficher un seul élément (read)
pour afficher un élément précis (cliquer sur une image affiche une description est des informations supplémentaires par exemple)
- creer (create)
pour créer des nouveaux éléments dans la table (insertion de données).
- mise à jour (update)
pour mettre à jour les données d'un seul élément (une colonne) d'une table.
- suppression (delete)
la suppression d'un seul élément précis d'une table

Les CRUD sont des action qui se trouvent dans le Controller qui permettent d'agir sur les données d'une table. Dans un Controller, généralement il y a 7 fonctions (index, create, store, show, edit, update et destroy).

### crud (create, read, update, delete)
c'est en quelque sorte de "recréer" `phpmyadmins` directement dans le site pour les moldus (client) qui ne sait pas l'utiliser.

#### crud vs seeder/factory
on utiliser les seeder/factory pour créer des données préalablement pour la première livraison du site. le crud est utilisé lors de la durée de vie du site et pas à la naissance par le client.

### php artisan make:controller name
la commande pour créer un controller dans `app/Http/Controllers` :
```
php artisan make:controller UserController 
```

et maintenant on utilise la ligne de code suivante pour la gestion des routes:
```php
Route::get('/user', [UserController::class, 'index']);
```

### méthodes
#### index
prends tous les éléments du model et les envois dans une blade. elle doit donc retourner une `view`
La fonction index est une fonction qui permet prendre toutes les données que vous avez dans une table et les afficher dans la blade
Pour cette méthode, il vous faut créer la fonction index dans le controller, stocker tous les éléments que vous avez dans une table, et les passer à une blade.
```php
public  function  index() {
	$users = User::all();
	return  view("welcome", compact('users');
}
```
Puis, il vous faut le chemin pour communiquer avec cette fonction dans le controller
```php
Route::get('/user', [UserController::class, 'index']);
```

#### destroy
la fonction destroy est une fonction qui permet de supprimer un élément précis dans une table.
permet de supprimer un élément du model grâce à son id. on retourne  une vue car la suppression redirige vers une url (`user/3/delete` par exemple) et donc on souhaite revenir dans le back office. dans la route, on a envoyé une variable dynamique qui aura comme valeur l'id d'un élément précis dans la table, et on passera cette variable comme paramètre dans la fonction pour agir directement sur l’élément en question. On va le chercher dans la table, on va le supprimer grâce à la méthode **delete** et après on va revenir sur la blade où on était.
```php
public  function  destroy($id) {
	$user = User::find($id);
	$user->delete();
	return redirect()->back();
}
```
Pour cette fonction, il faut récupérer l'id qu'on va envoyer depuis la blade grâce à un form dont l'action sera le chemin avec l'id, et une méthode POST pour pouvoir faire des changements dans la table, ainsi qu'une méthode **@csrf** pour sécuriser les données.
```php
@foreach ($users  as  $user)
	<p>{{ $user->name . "  " . $user->email }}</p>
	<form  action="/user/{{ $user->id }}/delete" method="POST">
	@csrf
		<button  type="submit">delete</button>
	</form>
@endforeach
```

et enfin pour la route
```php
Route::post('/user/{id}/delete', [UserController::class, 'destroy']);
```

#### update
on a besoin d'un dossier `backoffice` dans laquelle on mets les fichiers qui permettent la gestion du `crud`.

on utilise tout simplement utiliser la balise `<a>` pour l'action de l'édition car on a juste besoin de l'action `get` d'un form.
```html
<a  class="btn btn-danger mx-1"  href="/batiment/{{  $b->id  }}/edit">Edit</a>
<!-- similaire à-->
<form  action="/batiment/{{ $b->id }}/edit" method="get" class="mx-1">
	@csrf
	<button type="submit" class="btn btn-danger">delete</button>
</form>
```
et sa route est la suivante
```php
Route::get('/batiment/{id}/edit', [BatimentController::class, 'edit']);
```

on crée la fonction `edit` dans le controller qui va renvoyer vers une blade `edit.blade.php` dans laquelle on met un formulaire .
```php
public function edit($id) {
	$batiment = Batiment::find($id);
	return view('backoffice.batiment.edit',  compact('batiment'));
}
```
son formulaire
```html
<form  method="POST"  action="/batiment/{{  batiment->id  }}/update">
	@csrf
	<!-- input et textarea... -->
	<input type="text" class="form-control" value="{{ $batiment->nom }}" name="nom">
</form>
```
on utilise l'attribut `name` pour récupérer les informations.
et sa route
```php
Route::post('/batiment/{id}/update', [BatimentController::class, 'update']);
```

on utilise les `Request` pour récupérer les données dans le controller et on redirige l'utilisateur dans la route bâtiment (`->name("")`)
```php
public function update($id, Request  $request) {
	$batiment = Batiment::find($id);
	$batiment->nom = $request->nom;
	$batiment->adresse = $request->adresse;
	$batiment->description = $request->description;
	$batiment->updated_at = now();
	$batiment->save();
	return redirect()->route("batiment");
}
``` 
#### create
similaire à `update` sauf qu'on a pas de données et que la fonction pour ajouter la donnée dans la base de donnée se nomme `store`.


## storage
filesystem permet d'indiquer ou on veut stocker ce qui est externe à notre projet (fichier et images). on doit modifier le fichier `config/filesystems.php` et on définit les valeurs suivantes :
```php
'public'  => [
	'driver' => 'local',
	'root' => public_path('') . "/",
	'url' => env('APP_URL') . '/public',
	'visibility' => 'public',
],
```
indique le chemin vers le repertoire `public`.

### create
dans le formulaire
```html
<form action="/image/{{ $image->id }}/update" method="post" enctype="multipart/form-data">
...
...
</form>
```
et on modifier le request pour stocker l'image dans le dossier `public`
```php
$image->path = $request->file('path')->hashName(); // pour ne pas afficher le nom de l'image
...
$image->save();
$request->file('path')->storePublicly('img', 'public');
```

dans le `all.blade.php`
```html
<td><img  style="width: 30%"  src="{{  asset("img/" . $image->path)  }}"  alt=""></td>
```

### delete
```php
public  function  delete($id) {
	$image  =  Image::find($id);
	Storage::disk('public')->delete('img/' . $image->path);
	$image->delete();
	return  redirect()->back();
}
```

### update
```php
public  function  update($id, Request  $request) {
	$image  =  Image::find($id);
	...
	// laisse l'image d'avant si pas de nouvelle image
	if ($request->file('lien') !== null) {
		Storage::disk('public')->delete('img/' . $image->path);
		$image->path  =  $request->file('path')->hashName();
		$request->file('path')->storePublicly('img', 'public');
	}
	...
	$image->save();
	
	return  redirect()->route('image');
}
```

### download image
pour télécharger une image
```php
public  function  download($id) {
	$photo = Photo::find($id);
	$filepath = public_path('img/') . $photo->lien;
	return response()->download($filepath);
}
```
```php
public  function  download($id) {
	$photo = Photo::find($id);
	return Storage::disk('public')->download('img/' . $photo->lien);
}
```

## validate
permet de valider un formulaire pour éviter d'afficher une erreur laravel. `validate` est une méthode de `$request`.

```php
public  function  store(Request  $request) {
	$request->validate([
	'nom' => 'required',
	'path' => 'required|max:255',
	'description' => 'required',
	]);
	...
}
```

### erreurs
pour afficher les erreurs d'un formulaire
```php
@foreach ($errors->all() as  $message)
	<li>{{ $message }}</li>
@endforeach
```

### succès
pour afficher un message de succès dans la blade suivante
```php
...
return  redirect()->route('photos')->with('message', 'The success message!');
```
et dans la blade ciblée
```php
@if (session()->has('message'))
<div class="alert alert-success">
	{{ session()->get('message') }}
</div>
@endif
```
ou
```php
@if (session('message'))
	<div  class="alert alert-success">{{ session('message') }}</div>
@endif
```

#### traduction française des erreurs
https://laravel.sillo.org/cours-laravel-8-les-bases-la-validation/

## pagination
dans la méthode `index` du controller:
```php
DB::table('cars')->paginate(10);
// ou tout simplement
Cars::paginate(10);
```
et ensuite dans la blade `all` en dessous de la table:
```php
{{ $cars->links() }}
```
et pour que la pagination utilise bootstrap il faut modifier le fichier `App\Providers\AppServiceProvider`
```php
use Illuminate\Pagination\Paginator;

public function boot()
{
    Paginator::useBootstrap();
}
```

## ressources
affiche toutes les routes est les actions associées
```
php artisan route:list
```

### web.php
on peut écrire toutes les routes en une fois sauf le download (car elle est pas commun à toutes les routes)
```php
Route::resource('/photos', PhotoController::class);
Route::post('/photos/{id}/download', [PhotoController::class, 'download']);
```

### controllers
il faut modifier aussi modifier le controller

on utilise plus l'`id` pour le controller mais directement l'objet comme l'exemple ci-dessous
```php
public function edit(Photo $photo) {
	return  view('backoffice.photo.edit',  compact('photo'));
}
```
il ne faut pas oublier de modifier les routes :
```php
redirect()->route('photos.index')
```

### views (all.blade.php)

### delete
on modifie le lien de l'action du formulaire et on ajoute `@method('delete')`
```php
<form action="/photos/{{  $photo->id }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('delete')
	<button  class="btn btn-danger text-white"  type="submit">Delete</button>
</form>
```

### create
pour le create on peut utiliser le nom de la route car on a pas besoin d'envoyer de données comme l'id par 
```php
<a  class="btn btn-success my-2"  href="{{  route("photo.create")  }}">Create</a>
```

dans le `create.blade.php`
```php
<form  action="{{  route("photos.store")  }}"  method="post"  enctype="multipart/form-data">
```

### edit
comme pour le `delete` on modifie l'action et on ajoute une méthode `put`
```php
<form  action="/photos/{{  $photo->id  }}"  method="post"  enctype="multipart/form-data">
	@csrf
	@method("put")
	//...
```

### show
```html
<td><a  href="/photos/{{  $photo->id  }}">{{  $photo->nom  }}</a></td>
```

### resources
on peut créer toutes les méthodes (vides) dans le controller avec le paramètre `-r` comme par exemple
```shell
php artisan make:model Personne -mfcr
```

## les relations
![](https://miro.medium.com/max/5656/1*-jP5kV0P5HxSaHxMfaaCrg.png)

il existe trois types de relations
	- one to one (1, 1)
	- one to many (1, n\*)
	- many to many (m\*, n*) (articles et catégories)

### one to many
role à des utilisateurs et donc ce n'est pas au role à indiquer les utilisateur qui possèdent. ce sont les utilisateurs qui indique leur role. donc dans la table `users`
```php
Schema::table('users', function(Blueprint  $table) {
	$table->foreignId('role_id')->constrained('roles');
});
```
la table `roles` doit donc être créée en premier.

on doit ajouter la fonction suivante dans le modèle `role``
```php
public  function  users() {
	return  $this->hasMany(User::class);
}
```
et dans le modèle `user` pour indiquer qu'il appartient à un seule `role` et la **méthode doit être en singulier**
```php
public  function  role() {
	return  $this->belongsTo(Role::class);
}
```

pour avoir accès au rôle à partir de `user` on fait appel à la méthode (attribut?) `role` :
```php
$user = User::first();
$user->role->nom;  // Administrateur
```
ici role c'est un seul élément (car en singulier `belongsTo`). 
```php
$role = Role::first();
$role->users;  // [user, user] retourne tous les utilisateur qui on le premier rôle
```

### one to one
```php
public function role() {
	return $this->hasOne(Role::class);
}
```
et
```php
public function user() {
	return  $this->belongsTo(User::class);
}
```

### many to many
https://www.youtube.com/watch?v=9aUvEgY6N_I&t=744s

pour delete :
```php
$article->tags()->detach();
$article->categories()->detach();
```

pour update :
```php
$article->categories()->sync($request->categories);
$article->tags()->sync($request->tags);
```

pour store :
```php
$article->categories()->attach($request->categories);
$article->tags()->attach($request->tags);
```

1 juillet 2021

## authentification
ce sont les autorisations pour avoir accès à la base de données ou a certains privilèges.
le passage de la blade (ce que le monde peut voir) aux éléments qui ne sont pas accessibles pour tous via une route.
il faudra se connecter avec un compte ou en créer un pour gérer les accès aux routes.
c'est le dévelopeur qui créer les comptes et pas le client

avant il y avait un seul système d'authentification qui était lourd et maintenant il en existe 3 selon les besoins du projet
3 systèmes d'authentification
	-  breeze (léger et blade)
	-  livewire/jetstream (lourd blade)
	- inertia javascript

### laravel breeze
https://laravel.com/docs/8.x/starter-kits#laravel-breeze
```bash
composer require laravel/breeze
php artisan breeze:install

npm install
npm run dev
php artisan migrate
```

site internet -> |auth| -> backoffice
le auth travaille avec seulement la table **users**.
il permet de donner accès au backoffice en identifiant l'utilisateur.
ensuite on peut ajouter une seconde couche en vérifiant le rôle de celui-ci.

on installe pas avec bootstrap car le système d'authentification utilise tawilwind

### controllers
les controllers sont séparés en plusieurs fichiers pour une raison de sécurité. il est plus difficile d'attaquer plusieurs fichier qu'un seul fichier.

### blade
xhtml permet de faire du html spécifique au backoffice.
web.php permet de faire communiquer les blades avec les controllers. 

#### if
la commande `@auth` est un sorte de if qu'on peut combiner avec un else et qui vérifie si on est authentifier.
```html
@auth
	<a  href="{{  url('/dashboard')  }}"  class="text-sm text-gray-700 underline">Dashboard</a>
@else
	<a  href="{{  route('login')  }}"  class="text-sm text-gray-700 underline">Log in</a>
@endauth
```

### providers
on peut modifier les variables d'environnement dans le fichier `RouteServiceProviders`
```php
public const HOME = '/dashboard';
```

### methodes
```php
Bonjour {{ Auth::user()->name }}, comment va?
Bonjour {{ Auth::id() }}, comment va?
Bonjour {{ Auth::check() }}, comment va? // return 1 ou 0 si on est identifier ou pas
```

## authorization
### middleware vs policy vs gate
- les middleware bloquent l'accès à une route et agissent directement dans le fichier `web.php`
- les policy bloquent directement un crud (action) spécifique dans le controller.
- les gates bloquent l'accès à une route spécifique comme le formulaire edit



### 1. middleware
auth vs middleware : authentification c'est une porte entre le backoffice et le front end et les middleware check s'il peut avoir accès au controller. **les middleware bloquent les routes de bases et agissent sur les routes de web.php**

#### if auth::check
on peut check dans les méthodes du controller si l'utilisateur est authentifier:
```php
if (Auth:check()) {
	...
} else {
	return redirect()->back();
}
```
mais il faut le faire à chaque méthode et c'est lourd

#### création d'un middleware
- étape 1: créer un middleware
```shell
php artisan make:middleware isConnected
```
- étape 2: ajouter la condition dans le middleware qui se trouve dans `app/Http/Middleware`
- étape 3: déclarer le middleware dans `app/Http/Kernel` dans l'array `$routeMiddleware`
```php
'isConnected' => \App\Http\Middleware\isConnected::class,
```
- étape 4: ajouter le middleware à la route dans le fichier `web.php`
```php
Route::get('/', 'HomeController')->middleware('isConnected');
```
ou dans le controller ajouter la méthode pour appliqué les middleware à des méthodes spécifiques
```php
public function __construct() {
	$this->middleware(['isConnected', 'isAdmin'])->only(['index', 'create']);
}
```

#### rôles
```php
if (Auth::user()->role_id === 3) {
	// is an admin
} else {
	// is not an admin
}
```

##### ne pas modifier une autre donnée à partir d'un form
https://youtu.be/umR2VbKW2so?t=462
on va créer un middleware `isRealUser`qui va check si l'id du formulaire est la même de celui qui se trouve dans la route.
```php
$id = $request->route()->parameters()['id'];
if ($request->user()->id === $id) {
	// ce n'est pas un hack!
} else {
	return redirect()->back();
}
```


on peut dissimuler le bouton create avec le mot clef `@can`
```php
@can('user-create', \App\Models\User::class)
	// button create
@endcan
```

### 2. policy
bloque directement un crud spécifique dans le controller.
on a accès au formulaire pour créer un modèle mais lorsqu'on submit on obtient une erreur 403.
```php
php artisan make:policy UserPolicy --model=User
```

la méthode suivante authorize l'utilisateur qui a le role 1 et 2 a créer un utilisateur
```php
public function create(User $user) {
	return in_array($user->role_id, [1, 2]);
}
```

et ensuite l'appel cette méthode dans le userController
```php
// dans UserController
public function create(Request $request) {
	$this->authorize("create", User::class);
}

public function destroy(User $user) {
	$this->authorize("delete", $user);
}
```

### 3. gate
bloque les routes pour avoir accès aux méthodes du crud

`AuthServiceProvider` dans `app/providers` pour bloquer certaines routes à certains utilisateurs (portes globales) dans la fonction boot

l'exemple suivante bloque la route `create` de `user`:

```php
Gate::define("user-create", function() {
	return in_array(Auth::user()->role_id, [1]);
});
```
ou tout simplement
```php
Gate::define("user-create", function(User $user) {
	return in_array($user->role_id, [1]);
});
```
et dans `UserController``
```php
public function create() {
	$this->authorize("user-create", User::class);
	// ...
}
```

## mail
https://mailtrap.io/
```php
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=a6805bf1c8afbf
MAIL_PASSWORD=538cccdaca16cd
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=bilal@test.com
MAIL_FROM_NAME="${APP_NAME}"
```

```
php artisan make:mail FormulaireContact
```
dans `app/mail/` on ajoute l'attribut suivante dans la classe
```php
public $contenuEmail;
```
et aussi le constructeur
```php
public function __construct($contenuEmail)
{
	$this->contenuEmail = $contenuEmail;
}
```
c'est dans la méthode `build` qu'on construit le mail, on doit construire une vue pour afficher l'email
```php
public function build()
{
	return $this->view('email');
}
```
```html
@extends('layouts.index')
@section('content')
	<h1>{{  $contenuEmail->name  }}</h1>
	<h2>{{  $contenuEmail->email  }}</h2>
	<h3>{{  $contenuEmail->subject  }}</h3>
	<p>{{  $contenuEmail->message  }}</p>
@endsection
```

et on doit créer un controleur pour le formulaire
```
php artisan make:controller FormulaireController
```

et dans ce controller on ajouter la méthode suivante :
```php
public  function  sendMail(Request  $request) {
	$contenuEmail  = [
		'name'  =>  $request->name,
		'email'  =>  $request->email,
		'subject'  =>  $request->subject,
		'message'  =>  $request->message
	];
	Mail::to('bilal@test.com')->send(new  FormulaireContact($contenuEmail));
	return  redirect('/#contact')->with('message', 'message sended!');
}
```
et on ajoute la route suivante (post)
```php
Route::post('/send-mail', [FormulaireController::class, 'sendMail']);
```
et dans le formulaire on utilise l'`action`suivant sans oublier le `@csrf`:
```php
<form  action="/send-mail"  method="post"  role="form"  class="php-email-form">
	@csrf
	// ...
</form>
```
## axios
traduction du js en php pour pouvoir utiliser react avec laravel
il faut avoir terminer son projet react entièrement avant de l'importer dans laravel

```
php artisan ui react
npm i && npm run dev
```

## erreurs et astuces
### error 500 server not found
Si vous avez une erreur 500 Server, c'est parce que vous n'avez pas de fichier .env

Vous devez créer ce fichier à la racine du projet, copier ce qu'il y a dans le fichier .env.example et le mettre dans le fichier .env

et puis lancer
```
php artisan key:generate
```
cela arrive lorsqu'on clone un projet avec github

### 1 ERROR child compilations
modifier les chemins dans le scss ou ajouter la ligne suivante dans webpack.mix.js (peut causer certains problèmes)
```js
mix.js('resources/js/app.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css')
	.options({processCssUrls: false})
	.sourceMaps();
```

### comment tuer un serveur créer par php artisan serve
https://stackoverflow.com/questions/38761354/stop-laravel-server-with-command-line-interface
```
sudo kill $(sudo lsof -t -i:port_number)
// par exemple
sudo kill $(sudo lsof -t -i:8000)
```

### navbar avec éléments en active
```php
<a  class="nav-link {{ "about" == Route::currentRouteName() ? 'active': '' }}" href={{ route("about") }}>About</a>
```
par passage de variable par la route
```php
<a class="nav-link {{ "about" == $page ? 'active' : '' }}" href={{ route("about") }}>About</a>
```

### utiliser du html dans une variable blade
```php
$title = "<h1>je suis un h1</h1>";
{!! $title !!}
```

### obtenir l'age avec la date
https://stackoverflow.com/a/19521323
```php
$date = $this->faker->date();
$from = new DateTime($date);
$now = new DateTime();
$age = $from->diff($now)->y;
```

### git clone project laravel
https://stackoverflow.com/a/39913449
- `composer i`
- copier `.env`
- `php artisan key:generate`
- créer une base de donnée avec le même nom que celui indiqué dans le `.env`
-  `php artisan migrate`

### destroy de relations
```php
foreach ($equipe->joueurs as joueur) {
	$joueur->equipe_id = Equipe::where('nom', 'sans equipe')->first()->id;
	$joueur->save();
}
$equipe->delete();
return redirect()->back();
```

### ne pas supprimé de données
ajouter une condition dans la méthode destroy de controller

### pagination
https://laravel.com/docs/8.x/pagination#customizing-the-pagination-view
https://adevait.com/laravel/laravel-overwriting-default-pagination-system
on peut modifier le style de la pagination
```php
php artisan vendor:publish --tag=laravel-pagination
```

### font awesome avec authentification
```js
mix.sass("resources/sass/app.scss", "public/css")
.js('resources/js/app.js', 'public/js').postCss('resources/css/app.css', 'public/css/tailwind.css', [
	require('postcss-import'),
	require('tailwindcss'),
	require('autoprefixer'),
]);
```
```sass
$fa-font-path: "~@fortawesome/fontawesome-free/webfonts"; @import "~@fortawesome/fontawesome-free/scss/fontawesome"; @import "~@fortawesome/fontawesome-free/scss/regular"; @import "~@fortawesome/fontawesome-free/scss/solid"; @import "~@fortawesome/fontawesome-free/scss/brands";
```

### newsletter
https://mailtrap.io/blog/laravel-notification-tutorial/
https://www.youtube.com/watch?v=gtMXs9a1e0Y

https://www.positronx.io/laravel-notification-example-create-notification-in-laravel/

### pagination avec recherche
https://github.com/laravel/framework/issues/19441#issuecomment-305491111
```php
<div  class="page-pagination">
{{  $posts->appends(request()->except('page')) }}
</div>
```

###  partage de ressource
appserviceproviders fonction boot
```php
View::share
```

### Mail
```
php artisan make:mail NewsSender --markdown=mail.newsletter
```
```php
Mail::to($request->mail)->send(new NewsSender($request));
```

```php
return $this->markdown('mail.newsletter');
// par
return $this->from('contact@labs.com')->markdown('mail.newsletter')->subject('Newsletter');
```

```php
$mails = Newsletter::all();
foreach ($mails as mail) {
	Mail::to...
}
```


### stripe
https://www.youtube.com/watch?v=1dt-g5Au6ZI&t=11s
https://laravel.com/docs/8.x/billing
https://github.com/ludoguenet/ecommerce-app-laravel-6
https://stripe.com/docs

1- création d'un controller (vue index)
2- installation de stripe



> Written with [StackEdit](https://stackedit.io/).
