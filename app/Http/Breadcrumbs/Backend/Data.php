<?php

Breadcrumbs::register('admin.data.index', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.dashboard');
    $breadcrumbs->push(trans('menus.backend.data.management'), route('admin.data.index'));
});

Breadcrumbs::register('admin.data.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admin.data.index');
    $breadcrumbs->push(trans('menus.backend.data.create'), route('admin.data.create'));
});

Breadcrumbs::register('admin.data.edit', function ($breadcrumbs, $id) {
    $breadcrumbs->parent('admin.data.index');
    $breadcrumbs->push(trans('menus.backend.data.edit'), route('admin.data.edit', $id));
});
