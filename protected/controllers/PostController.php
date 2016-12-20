<?php
class PostController extends Controller {

    public function actionIndex() {
        echo "Enter Post Data.";
    }

    public function actionCreate() {
        if(isset($_POST['Post'])) {
            $post = Post::create($_POST['Post']);
            if(!$post->errors) {
                $this->renderSuccess(array('post_id'=>$post->id));
            } else {
                $this->renderError($this->getErrorMessageFromModelErrors($post));
            }
        } else {
            $this->renderError('Please send post data!');
        }
    }

}
