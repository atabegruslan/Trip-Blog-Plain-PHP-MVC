<?php 

class Entry extends Controller 
{
	public function __construct() 
	{
		parent::__construct();

		session_start();
        if ( !isset($_SESSION['user_id']) ) {
            header("Location: ".BASE_URL."user/login/");
        } 
	}

	public function index($args) 
	{
		$this->view->data = $this->model->readAll();
		$this->view->render('entry/index');
	}

	public function read($args) 
	{
		$this->view->data = $this->model->read('id', $args[0]);
		$this->view->render('entry/read');
	}
    
    public function create() 
    {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			$path = UPLOADS_DIR;

		    $file_tmp_name    = $_FILES['image']['tmp_name'];
		    $file_name        = $_FILES['image']['name'];
		    $file_type        = $_FILES['image']['type'];
		    $file_error       = $_FILES['image']['error'];

			if ($file_error > 0) {
				new Errors('Upload error or No files uploaded');
				return false;    
			}

			$file_name = rand(10000,99999).time().'.'.$file_name;
            $file_name = strtolower($file_name);

		    $extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
		    $path = $path.strtolower($file_name); 
		    move_uploaded_file($file_tmp_name, $path);
		    $this->editImage(IMG_RAD, $path, $path);

	        $data = array(
	            'place' => $_POST['place'],
	            'comments' => $_POST['comments'],
	            'img' => IMAGES_URL.$file_name,
	            'user_id' => $_SESSION['user_id']	            
	        );

	        $this->model->create($data);

	        header('location: ' . BASE_URL . 'entry');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->view->render('entry/create');
		}
    }
        
    public function update($args)
    {
    	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

			//parse_str(file_get_contents("php://input"),$put_vars);

	        $data = array(
	        	'id' => $args[0],
	            'place' => $_POST['place'], //$put_vars['place'],
	            'comments' => $_POST['comments'], //$put_vars['comments'],
	            'img' => 'gjg',// $put_vars['img'],
	            'user_id' => $_SESSION['user_id']	
	        );
	        	        
	        $this->model->update($data);

		    header('location: ' . BASE_URL . 'entry');
		} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
			$this->view->data = $this->model->read('id', $args[0]);
			$this->view->render('entry/update');
		}
    }
        
    public function delete($args)
    {
    	$data = array(
    		'id' =>$args[0]
    	);

        $entry = $this->model->read('id', $args[0]);
        $imgPathParts = explode('/', $entry['img']);
        $imageName = $imgPathParts[count($imgPathParts)-1];
        unlink(UPLOADS_DIR.$imageName);

        $this->model->delete($data);

        header('location: ' . BASE_URL . 'entry');
    }

    function editImage($size, $src, $dest, $quality = 80){
        $imgsize = getimagesize($src);
        $width = $imgsize[0];
        $height = $imgsize[1];
        $mime = $imgsize['mime'];
     
        switch($mime){
            case 'image/gif':
                $image_create = "imagecreatefromgif";
                $image = "imagegif";
                break;
     
            case 'image/png':
                $image_create = "imagecreatefrompng";
                $image = "imagepng";
                $quality = 7;
                break;
     
            case 'image/jpeg':
                $image_create = "imagecreatefromjpeg";
                $image = "imagejpeg";
                $quality = 80;
                break;
     
            default:
                return false;
                break;
        }

        $this->makeSquare($size, $src, $dest, $image, $image_create, $width, $height, $quality);
        $this->makeCircle($size, $src, $dest, $image, $image_create, $quality);
    }

    function makeSquare($size, $src, $dest, $image, $image_create, $width, $height, $quality){
         
        $dst_img = imagecreatetruecolor($size, $size);
        $src_img = $image_create($src);
         
        $width_new = $height;
        $height_new = $width;
        //if the new width is greater than the actual width of the image, then the height is too large and the rest cut off, or vice versa
        if($width_new > $width){
            //cut point by height
            $h_point = (($height - $height_new) / 2);
            //copy image
            imagecopyresampled($dst_img, $src_img, 0, 0, 0, $h_point, $size, $size, $width, $height_new);
        }else{
            //cut point by width
            $w_point = (($width - $width_new) / 2);
            imagecopyresampled($dst_img, $src_img, 0, 0, $w_point, 0, $size, $size, $width_new, $height);
        }
        
        $image($dst_img, $dest, $quality);

        if($src_img)imagedestroy($src_img);
        if($dst_img)imagedestroy($dst_img);
    }

    function makeCircle($size, $src, $dest, $image, $image_create, $quality){
        
        $mask = imagecreatetruecolor($size, $size);        
        $dst_img = $image_create($src);

        $maskTransparent = imagecolorallocate($mask, 255, 0, 255);
        imagecolortransparent($mask, $maskTransparent);
        imagefilledellipse($mask, $size / 2, $size / 2, $size, $size, $maskTransparent);
        
        imagecopymerge($dst_img, $mask, 0, 0, 0, 0, $size, $size, 100);
        $dstTransparent = imagecolorallocate($dst_img, 255, 0, 255);
        imagefill($dst_img, 0, 0, $dstTransparent);
        imagefill($dst_img, $size - 1, 0, $dstTransparent);
        imagefill($dst_img, 0, $size - 1, $dstTransparent);
        imagefill($dst_img, $size - 1, $size - 1, $dstTransparent);
        imagecolortransparent($dst_img, $dstTransparent);
        
        $image($dst_img, $dest, $quality); 

        if($mask)imagedestroy($mask);
        if($dst_img)imagedestroy($dst_img);       
    }
}

?>