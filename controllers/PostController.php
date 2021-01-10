<?
include_once ROOT.'/model/Post.php';

class PostController 
{
    private $post;

    function __construct () 
    {   
        $getPostClass  = new Post();
        $this->post= $getPostClass;
    }


    public function actionIndex() 
    {
        $res = $this->post->getAll();

        require_once ROOT.'/views/index.php';

        return true;
    }

    public function actionView($param) 
    {   
        $arg = [
            'id' => $param[1]
        ];
        $res = $this->post->getById(intval($param[1]));

        $this->post->UpdatePostView($arg);

        require_once ROOT.'/views/view.php';
        return true;
    }

    public function actionAll() 
    {
        $res = $this->post->getAll();
        echo json_encode($res,true);

        return true;
    }


    public function actionFilter($param) 
    {   
        $res = $this->post->getWithFilter($param);
        echo json_encode($res,true);

        return true;
    }
} 