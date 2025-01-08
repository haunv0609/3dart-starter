<?php

return [
    'middleware' => ['auth', 'auth.session', 'role:admin'], //default middleware starter
    'name_route' => 'admin.',
    'prefix_route' => 'admin',
];
