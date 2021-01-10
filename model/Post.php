<?

class Post
{

    function __construct()
    {
        global $obj;
        $this->obj = $obj;
    }

    // Получение всех записей из таблицы "blog"
    public function getAll()
    {
        return $this
            ->obj
            ->select('*')
            ->from('blog')
            ->go(true);
    }

    // Получение превью постов
    public function getWithFilter($args)
    {
        return $this
            ->obj
            ->select('id, title, description, href, views, time_create')
            ->from('blog')
            ->sort($args[1], 'DESC')->limit($args[2])->go(true);

    }

    // Получение одного поста
    public function getById($id)
    {
        $placeholder = ['id' => $id];

        return $this
            ->obj
            ->select('id, title, body, views, time_create')
            ->from('blog')
            ->where('id = :id', $placeholder)->go(true);

    }

    // Обновление счетчика просмотров
    public function UpdatePostView($placeholder = null)
    {
        return $this
            ->obj
            ->update('blog')
            ->set('views = views + 1')
            ->where('id = :id', $placeholder)->go();

    }

    // Обновление поста
    public function UpdatePost($arg, $arg2, $placeholder = null)
    {
        return $this
            ->obj
            ->update('blog')
            ->set($arg)->where($arg2, $placeholder)->go();

    }

}
?>
