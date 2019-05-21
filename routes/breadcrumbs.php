<?php

Breadcrumbs::macro('resource', function ($name, $title) {
    // Home > Blog
    Breadcrumbs::for("$name.index", function ($trail) use ($name, $title) {
        $trail->parent('admin.');
        $trail->push($title, route("$name.index"));
    });

    // Home > Blog > Новый
    Breadcrumbs::for("$name.create", function ($trail) use ($name) {
        $trail->parent("$name.index");
        $trail->push('Создать', route("$name.create"));
    });

    // Home > Blog > Post 123
    Breadcrumbs::for("$name.show", function ($trail, $model) use ($name) {
        $trail->parent("$name.index");
        $trail->push($model->name ?? ($model->title ?? $model->id), route("$name.edit", $model));
    });

    // Home > Blog > Post 123 > Edit
    Breadcrumbs::for("$name.edit", function ($trail, $model) use ($name) {
        $trail->parent("$name.show", $model);
        $trail->push('Редактировать', route("$name.edit", $model));
    });
});

/**
 * ==============
 */

// Главная
Breadcrumbs::for('admin.', function ($trail) {
    $trail->push('Главная', route('admin.'));
});

// Главная > Пользователи
Breadcrumbs::resource('admin.users', 'Пользователи');

// Главная > Страницы
Breadcrumbs::resource('admin.pages', 'Страницы');

// Главная > Сотрудники
Breadcrumbs::resource('admin.employees', 'Сотрудники');

// Главная > Настройки
Breadcrumbs::resource('admin.options', 'Настройки');
