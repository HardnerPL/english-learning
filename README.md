# English Learning Website

A website project for learning english vocabulary in a simple, slightly gamified form, a bit like Duolingo or WordApp (the latter didn't exist at the time)

## Getting Started

The application is not in a usable state, but in a state good enough to display the overal premise. There could be some errors and some functionalities were never implemented, as well as certain things seem to have gone missing (like a Loader class which I'm pretty sure existed and features like saving that use it worked)

## Getting Started

The application is still in early works and is not functional. It might have errors, and a lot of functionalities don't work at all (for example a Loader class is missing, and it was used for certain functionalities that DID work, like saving! It could be that Loader got changed and renamed to Framework but certain views haven't been updated)

### Installing

To install the application you will only need a PHP server with MySQL support, like xampp. All you need to do is allow mod_rewrite and put the project in your server root folder. Then, you can access the website at:

```
http://localhost/english-learning/
```

The repository comes with a very small XML file that allows you to make and fill your database with one user and 2 words, that showcase some of the functionalities. The default created user has a username of 'admin' and a password 'asdfghjk'. You can create your own user, but it has to have a unique username shorter than 32 letters as well as at least 8 letter password.

To create words, you need to use your database directly, such functionality was meant to be implemented but it never got to that point.

## Built With

* My own "Framework" I wanted to create as an excercise and a form of getting familiar with MVC

## License

This project is licensed under the MIT License - see the [license.txt](license.txt) file for details

## Acknowledgments

Huge thanks to [PurpleBooth](https://gist.github.com/PurpleBooth/109311bb0361f32d87a2) for this README template.
