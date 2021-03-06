<?php

// Home
Breadcrumbs::for('welcome', function ($trail) {
    $trail->push('Home', route('welcome'));
});

// Home > Wec
Breadcrumbs::for('wec', function ($trail) {
    $trail->parent('welcome');
    $trail->push('WEC', route('wec.index'));
});

// Home > Wec > Show 
Breadcrumbs::for('show', function ($trail) {
    $trail->parent('wec');
    $trail->push('Show', route('wec.show'));
});

// Home > Wec > Show > Filter 
Breadcrumbs::for('filter', function ($trail) {
    $trail->parent('show');
    $trail->push('Filter', route('wec.show.filter'));
});

// Home > Wec > Show  > Inspection 
Breadcrumbs::for('find', function ($trail) {
    $trail->parent('show');
    $trail->push('Inspection', route('wec.find'));
});

// Home > Wec > Inspection 
Breadcrumbs::for('inspection', function ($trail) {
    $trail->parent('wec');
    $trail->push('Inspection', route('wec.find'));
});

// Home > Wec Anonymous 
Breadcrumbs::for('wec_anonymous', function ($trail) {
    $trail->parent('welcome');
    $trail->push('WEC', route('anonymous/index'));
});

// Home > Wec Anonymous > Inspection Anonymous
Breadcrumbs::for('anonymous_inspection', function ($trail) {
    $trail->parent('wec_anonymous');
    $trail->push('Inspection', route('anonymous/inspect'));
});