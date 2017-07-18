<?php

class SearchController extends Controller
{
	public function actionIndex()
	{
	    $model=new SearchForm;
	    if(isset($_POST['SearchForm']))
	    {
	        // collects user input data
	        $model->attributes=$_POST['SearchForm'];
			$model->doSearch();
	    }
	    // displays the view form
	    $this->render('index',array('model'=>$model));
	}
}

?>
