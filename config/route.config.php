<? 
return [
    'post/([0-9]+)' => 'post/view/$1',
    'post/filter/([a-z_]+)/([0-9]+)' => 'post/filter/$1/$2', 
    'post' => 'post/all',
    '/' => 'post/index',
];