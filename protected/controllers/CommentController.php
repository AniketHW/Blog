<?php
class CommentController extends Controller {

    public function actionIndex() {
        echo "Enter Comment.";
    }

    public function actionCreate() {
        if(isset($_POST['Comment'])) {
            $comment = Comment::create($_POST['Comment']);
            if(!$comment->errors) {
                $this->renderSuccess(array('comment_id'=>$comment->id));
            } else {
                $this->renderError($this->getErrorMessageFromModelErrors($comment));
            }
        } else {
            $this->renderError('Invalid Comment.');
        }
    }
}