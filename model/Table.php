<?


// Создаст таблицу products
$obj->table('products')
->increments('id')
->string('name')
->string('href')
->create();

$products = file_get_contents("products.json");
$products = json_decode($products, true);

// Добавит содержимое из products.json  в таблицу
foreach ($products['data'] as $key => $value) {
    echo "$key $value[name] <br>";
}


// Создаcт таблицу Blog
$obj->table('blog')
->increments('id')
->string('href', 100)
->string('title')
->text('body')
->text('description')
->string('product')
->int('product_id')
->int('views')
->int('time_create')
->forEignKey('products', 'product_id', 'id') //Этот методот связывает таблицу внешним ключем с таблицей products
->create();


// Добавит содержимое из blog.json  в таблицу
$blog = file_get_contents("blog.json");
$blog = json_decode($blog, true);

foreach ($blog['data'] as $key => $value) {
    $obj->insert('blog')->value($value)->go();
}


// Добавит ключи для связки с products в blog-таблицу

$data = $obj->select('product')->from('blog')->go(true);

foreach ($data as $key => $value) {

   $id = $obj->select('id, name')->from('products')->where('name = :product',  $value)->limit(1)->go(true);

   $arg = [
       'id' => $id[0]['id'],
       'product' => $id[0]['name']
   ];
    $obj->update('blog')->set('product_id = :id')->where('product = :product',$arg)->go();   

} 