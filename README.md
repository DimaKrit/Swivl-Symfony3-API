Symfony Demo Api
========================

Installation
------------

```bash
$ composer create-project DimaKrit/Swivl-Symfony3-API
```

Usage
-----

```bash
@Rest\Get("/classroom")
<domain>/app_dev.php/classroom

----------
Rest\Get("/classroom/{id}")
<domain>/app_dev.php/classroom/<id>

----------
Rest\Post("/classroom/")
<domain>/app_dev.php/classroom/

----------
Rest\Put("/classroom/{id}/")
<domain>/app_dev.php/classroom/<id>/

---------
Rest\Delete("/classroom/{id}")
<domain>/app_dev.php/classroom/<id>

```

MySQL Database Backup
------------------
```bash
swivlSymfony.sql
```
