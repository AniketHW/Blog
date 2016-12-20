<?php
class UserController extends Controller {

    public function actionIndex() {
        echo "Enter User Data.";
    }

    public function actionCreate() {
        if(isset($_POST['User'])) {
            $new_user = User::create($_POST['User']);
            if(!$new_user->errors) {
                $this->renderSuccess(array('user_id'=>$new_user->id,'name'=>$new_user->name,'password'=>$new_user->password,'email'=>$new_user->email));
            } else {
                $this->renderError($this->getErrorMessageFromModelErrors($new_user));
            }
        } else {
            $this->renderError('Please send post data!');
        }
    }

    public function actionLogin($id) {
        $user = User::model()->findbyPK($id);
        if(!$user) {
            echo "Account does not exist.";
        }
        else {
           $this->renderSuccess(array('user_name'=>$user->name,'status'=>'SUCCESS'));
       }
   }

    public function actionProfile($id) {
        $user = User::model()->findbyPK($id);
        if(!$user) {
            echo "Account does not exist.";
        }
        else {
           $this->renderSuccess(array('user_id'=>$user->id,'name'=>$user->name,'password'=>$user->password,'email'=>$user->email,'status'=>'SUCCESS'));
       }
   }

    public function actionHistory($id) {
        $posts = Blogpost::model()->findAllByAttributes(
            array('user_id'=>$id));
        $posts_data = array();
        foreach ($posts as $post) {
            $posts_data[] = array('id'=>$post->id, 'content'=>$post->content);
        
        }
        $this->renderSuccess(array('status'=>'SUCCESS','posts_data'=>$posts_data));
        }
    }


