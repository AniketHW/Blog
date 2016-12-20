<?php
class LikeController extends Controller {

    public function actionIndex() {
        echo "Default.";
    }

    public function actionCreate() {
        if(isset($_POST['Like'])) {
            $like = Like::create($_POST['Like']);
            if(!$like->errors) {
                $this->renderSuccess(array('blogpost_id'=>$like->blogpost_id,'user_id'=>$like->user_id));
            } else {
                $this->renderError($this->getErrorMessageFromModelErrors($like));
            }
        } else {
            $this->renderError('ERROR.');
        }
    }
}