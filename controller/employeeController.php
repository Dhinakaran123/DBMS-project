<?php
include_once 'Controller.php';
include_once '../model/employeeModel.php';
class employeeController extends Controller
{

    const resume_dir = "..\\\\eresume\\";




    public function __construct()
    {

        parent::__construct();

        $request = @$_REQUEST['r'];
        if (empty($request)) {
            return $this->index();
        }

        $methods = get_class_methods(get_class($this));
        if (!in_Array($request, $methods)) {
            // @TODO Invalid request parameter
        }
        $this->{$request}();

    }

    public function index()
    {
        $model = new employeeModel();
        $data = $model->getRecords($_SESSION['id']);

        return $this->render('empHome.php',$data);
    }

    public function profile()
    {
        if(empty($_POST)){
            $model = new employeeModel();
            $id = $_SESSION['id'];
            $data = $model->getUser($id);

            return $this->render('emp-profile.php',$data);
        }else{


            $user['id'] = @$_SESSION['id'];
            $user['fname'] = @$_POST['fname'];
            $user['lname'] = @$_POST['lname'];
            $user['gender'] = @$_POST['gender'];
            $user['age'] = @$_POST['age'];
            $user['country'] = @$_POST['country'];
            $user['state'] = @$_POST['state'];
            $user['city'] = @$_POST['city'];
            $user['pincode'] = @$_POST['pincode'];
            $user['phone'] = @$_POST['phone'];
            $user['emailid'] = @$_POST['emailid'];
            $user['education'] = @$_POST['education'];
            $user['skills'] = @$_POST['skills'];
            $user['experience'] = @$_POST['experience'];

            if(!empty($_FILES)){

                if (!file_exists(self::resume_dir)) {
                    mkdir(self::resume_dir, 0775, true);
                }
                $targetFilename = "";
                $file = $_FILES['resume'];

                if (empty($file['error']) || $file['error']==0) {

                    $info = pathinfo($file['name']);
                    $targetFilename =  self::resume_dir .  'res_' . time() . '.' .  $info['extension'];
                    move_uploaded_file($file['tmp_name'], $targetFilename);
                    $user['cv_name'] = $file['name'];
                    $user['cv_pathname'] = basename($targetFilename);
                } else {
                    $user['cv_name'] = @$_POST['cv_name'];
                    $user['cv_pathname'] = @$_POST['cv_pathname'];

                }
            }

            $model = new employeeModel();
            $res = $model->updateUser($user);

            $data = $model->getUser($user['id']);

            if(empty($data['FNAME']) || empty($data['LNAME']) || empty($data['GENDER']) || empty($data['AGE']) || empty($data['COUNTRY']) ||
            empty($data['STATE']) || empty($data['CITY']) || empty($data['PINCODE']) || empty($data['PHONE']) || empty($data['EMAILID']) ||
            empty($data['EDUCATION']) || empty($data['EXPERIENCE']) || empty($data['SKILLS']) || empty($data['CV_NAME']) || empty($data['CV_PATHNAME'])){
                $_SESSION['pro_comp'] = 0;
            }else{
                $_SESSION['pro_comp'] = 1;
            }

            if($res == 0){
                return $this->redirect('employeeController.php');
            }else{
                $error['message'] = "Unable to update user profile";
                return $this->render('emp-profile.php',$user,$error);
            }
        }
    }


    public function profileddownload()
    {
        $uid = $_REQUEST['uid'];

        $model = new employeeModel();
        $user = $model->getUser($uid);
        if (empty($user['CV_PATHNAME'])) {
            die;
        } else {
            // Now read and server the file for download
            $sourceFilename = self::resume_dir . $user['CV_PATHNAME'];
            $orgname = $user['CV_NAME'];

            if (file_exists($sourceFilename)) {

                $size = filesize($sourceFilename);

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . $orgname);
                header('Content-Transfer-Encoding: binary');
                header('Connection: Keep-Alive');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                header('Content-Length: ' . $size);

                readfile($sourceFilename);
                exit;
            }
        }

    }

    public function apply()
    {
        $model = new employeeModel();
        $details['uid'] = $_SESSION['id'];
        $details['jid'] = @$_REQUEST['jid'];

        $res = $model->applyJob($details);
        return $this->redirect("employeeController.php");

    }

    public function cancel()
    {
        if(empty(@$_REQUEST['aid'])){
            $model = new employeeModel();
            $data = $model->getAppliedJobs($_SESSION['id']);

            return $this->render('appliedJobsform.php',$data);
        }else{
            $model = new employeeModel();
            $details['aid'] = @$_REQUEST['aid'];

            $model->cancelJob($details);
            return $this->redirect('employeeController.php?r=cancel');

        }
    }

}

$obj = new employeeController();
?>