<?php
class BlogpostController extends Controller {

	public function actionIndex() {
		echo "Enter Post Data.";
	}

	public function actionCreate() {
		if(isset($_POST['Blogpost'])) {
			$blogpost = Blogpost::create($_POST['Blogpost']);
			if(!$blogpost->errors) {
				$this->renderSuccess(array('blogpost_id'=>$blogpost->id));
			} else {
				$this->renderError($this->getErrorMessageFromModelErrors($blogpost));
			}
		} else {
			$this->renderError('Invalid Post Data.');
		}
	}

	public function actionView($id) {
		$blogpost = Blogpost::model()->findbyPK($id);
		if(!$blogpost) {
			echo "FAILURE.";
		}
		else {
		 $this->renderSuccess(array('blogpost_id'=>$blogpost->content,'status'=>'SUCCESS'));
	 }
 }



 public function actionComments($id) {
	$blogpost = Blogpost::model()->findbyPK($id);
	/*$comments = Comment::model()->findAll(
		array("condition"=>"blogpost_id =  $id","order"=>"id")
		);*/
	$comments = $blogpost->comments;
	foreach ($comments as $comment) {
		echo $comment->content;
	  
	}
}
	
public function actionLikes($id) {
	$blogpost = Blogpost::model()->findbyPK($id);
	/*$comments = Comment::model()->findAll(
		array("condition"=>"blogpost_id =  $id","order"=>"id")
		);*/
	$likes = $blogpost->likes;
	foreach ($likes as $like) {
		//echo $like->user_id;
	  $this->renderSuccess(array('user_id'=>$like->user_id,'status'=>'SUCCESS'));
	}
	
		
 }

public function actionSearch($str) {
	
$blogposts = Blogpost::model()->findAll(array('condition'=>"content LIKE :str",'params'=>array('str'=>"%$str%")));
if(!$blogposts)
echo "No matches found.";
else {
foreach ($blogposts as $blogpost) {
	//		echo $blogpost->id;
	$this->renderSuccess(array('post_id'=>$blogpost->id,'status'=>'SUCCESS'));

}
}
} 

}



