<?php
include_once 'Controller.php';
include_once '../model/companyModel.php';

class companyController extends Controller
{
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

    public function index(){
        $model = new companyModel();
        $cmp = $_SESSION['id'];
        $job = $model->getJobView($cmp);
        return $this->render('cmpHome.php',$job);
    }

    public function newJob()
    {
        if(empty($_POST)){
            return $this->render('job-form.php');
        }else{
            $data['JOBNAME'] = @$_POST['jobname'];
            $data['JOBDESC'] = @$_POST['jobdesc'];
            $data['EDUCATION'] = @$_POST['education'];
            $data['SKILLS'] = @$_POST['skills'];
            $data['VACANCY'] = (int)@$_POST['vacancy'];
            $data['DATEOFOPEN'] = @$_POST['dateofopen'];
            $data['DATEOFCLOSE'] = @$_POST['dateofclose'];
            $data['STATUS'] = @$_POST['status'];
            $data['EXPERIENCE'] = (int)@$_POST['experience'];
            $data['CID'] = (int)@$_SESSION['id'];

            if(!empty($data['DATEOFOPEN'])){
                $data['DATEOFOPEN'] = date_create($data['DATEOFOPEN']);
                $data['DATEOFOPEN'] = date_format($data['DATEOFOPEN'],"d-M-y");
            }
            if(!empty($data['DATEOFCLOSE'])){
                $data['DATEOFCLOSE'] = date_create($data['DATEOFCLOSE']);
                $data['DATEOFCLOSE'] = date_format($data['DATEOFCLOSE'],"d-M-y");
            }

            $error = $this->validate($data);

            if(empty($error)){
                $model = new companyModel();
                $res = $model->insertJob($data);
                if($res  == "Success"){
                    return $this->redirect('companyController.php');
                }else{
                    $error['date'] = $res;
                    $data['DATEOFOPEN'] = date_create($data['DATEOFOPEN']);
                    $data['DATEOFCLOSE'] = date_create($data['DATEOFCLOSE']);
                    $data['DATEOFOPEN'] = date_format($data['DATEOFOPEN'],"Y-m-d");
                    $data['DATEOFCLOSE'] = date_format($data['DATEOFCLOSE'],"Y-m-d");
                    return $this->render('job-form.php',$data,$error);
                }
            }else{
                $data['DATEOFOPEN'] = date_create($data['DATEOFOPEN']);
                $data['DATEOFCLOSE'] = date_create($data['DATEOFCLOSE']);
                $data['DATEOFOPEN'] = date_format($data['DATEOFOPEN'],"Y-m-d");
                $data['DATEOFCLOSE'] = date_format($data['DATEOFCLOSE'],"Y-m-d");
                return $this->render('job-form.php',$data,$error);
            }
        }
    }

    public function editJob()
    {
        if(empty($_POST)){
            $id = @$_REQUEST['job'];
            $model = new companyModel();
            $data = $model->getData($id);

            $data['DATEOFOPEN'] = date_create($data['DATEOFOPEN']);
            $data['DATEOFOPEN'] = date_format($data['DATEOFOPEN'],"Y-m-d");
            $data['DATEOFCLOSE'] = date_create($data['DATEOFCLOSE']);
            $data['DATEOFCLOSE'] = date_format($data['DATEOFCLOSE'],"Y-m-d");

            return $this->render('job-form.php',$data);
        }else{
            $data['JID'] = @$_REQUEST['job'];
            $data['JOBNAME'] = @$_POST['jobname'];
            $data['JOBDESC'] = @$_POST['jobdesc'];
            $data['EDUCATION'] = @$_POST['education'];
            $data['SKILLS'] = @$_POST['skills'];
            $data['VACANCY'] = (int)@$_POST['vacancy'];
            $data['DATEOFOPEN'] = @$_POST['dateofopen'];
            $data['DATEOFCLOSE'] = @$_POST['dateofclose'];
            $data['STATUS'] = @$_POST['status'];
            $data['EXPERIENCE'] = (int)@$_POST['experience'];
            $data['CID'] = (int)@$_SESSION['id'];

            if(!empty($data['DATEOFOPEN'])){
                $data['DATEOFOPEN'] = date_create($data['DATEOFOPEN']);
                $data['DATEOFOPEN'] = date_format($data['DATEOFOPEN'],"d-M-y");
            }
            if(!empty($data['DATEOFCLOSE'])){
                $data['DATEOFCLOSE'] = date_create($data['DATEOFCLOSE']);
                $data['DATEOFCLOSE'] = date_format($data['DATEOFCLOSE'],"d-M-y");
            }

            $error = $this->validate($data);

            if(empty($error)){
                $model = new companyModel();
                $res = $model->updateJob($data);
                if($res  == "Success"){
                    return $this->redirect('companyController.php');
                }else{
                    $error['date'] = $res;
                    $data['DATEOFOPEN'] = date_create($data['DATEOFOPEN']);
                    $data['DATEOFCLOSE'] = date_create($data['DATEOFCLOSE']);
                    $data['DATEOFOPEN'] = date_format($data['DATEOFOPEN'],"Y-m-d");
                    $data['DATEOFCLOSE'] = date_format($data['DATEOFCLOSE'],"Y-m-d");
                    return $this->render('job-form.php',$data,$error);
                }
            }else{
                $data['DATEOFOPEN'] = date_create($data['DATEOFOPEN']);
                $data['DATEOFCLOSE'] = date_create($data['DATEOFCLOSE']);
                $data['DATEOFOPEN'] = date_format($data['DATEOFOPEN'],"Y-m-d");
                $data['DATEOFCLOSE'] = date_format($data['DATEOFCLOSE'],"Y-m-d");
                return $this->render('job-form.php',$data,$error);
            }

        }
    }

    public function validate($data)
    {
        if(empty($data['JOBNAME'])){
            $error['jobname'] = "Job Name is required";
        }
        if(empty($data['JOBDESC'])){
            $error['jobdesc'] = "Job Description is required";
        }
        if(empty($data['EDUCATION'])){
            $error['education'] = "Education field is required";
        }
        if(empty($data['SKILLS'])){
            $error['skills'] = "Skills field is required";
        }
        if(empty($data['VACANCY'])){
            $error['vacancy'] = "Vacancy field is required";
        }
        if(empty($data['DATEOFOPEN'])){
            $error['dateofopen'] = "Date of open is required";
        }
        if(empty($data['EXPERIENCE'])){
            $error['experience'] = "Experience field is required";
        }
        if(empty($data['STATUS'])){
            $error['status'] = "Status field is required";
        }

        $currdate = date("d-M-y");

        /*if($data['DATEOFOPEN'] >= $data['DATEOFCLOSE'] && !empty($data['DATEOFOPEN']) && !empty($data['DATEOFOPEN'])){
            $error['date'] = "Date of open should not be greater than date of close";
        }else if($currdate < $data['DATEOFOPEN'] && $data['STATUS'] == 'active'){
            $error['date'] = "Status[active] is invalid(Date of open is far from today)";
        }else if($currdate > $data['DATEOFCLOSE'] && $data['STATUS'] == 'active'){
            $error['date'] = "Status[active] is invalid(Date of close is past)";
        }else if($currdate >= $data['DATEOFOPEN'] && $currdate <= $data['DATEOFCLOSE'] && $data['STATUS'] == 'inactive'){
            $error['date'] = "Status[inactive] is invalid(Current date is between open and close date) Choose 'Active' or 'Disable'";
        }*/

        return @$error;
    }

    public function profile()
    {
        $model = new companyModel();
        if(empty($_POST)){
            $data = $model->getCmp($_SESSION['id']);
            return $this->render('cmp-profile.php',$data);
        }else{
            $data['cmpname'] = @$_POST['cmpname'];
            $data['country'] = @$_POST['country'];
            $data['state'] = @$_POST['state'];
            $data['city'] = @$_POST['city'];
            $data['pincode'] = @$_POST['pincode'];
            $data['phone'] = @$_POST['phone'];
            $data['id'] = $_SESSION['id'];

            $res = $model->editProfile($data);

            if($res == 0){
                return $this->redirect("companyController.php");
            }else{
                $error['message'] = "Unable to update company profile";
                return $this->render("cmp-profile.php",$data,$error);
            }
        }
    }
    public function updateCandidate()
    {
        $model = new companyModel();
        if(empty(@$_REQUEST['aid'])){
            $data = $model->getappliedJobs($_SESSION['id']);
            return $this->render('cmpResponses.php',$data);
        }else{
            $data['aid'] = @$_REQUEST['aid'];
            $data['status'] = @$_REQUEST['s'];
            $model->updateJobStatus($data);
            return $this->redirect('companyController.php?r=updateCandidate');
        }
    }
    public function getUserDetails()
    {
        $model = new companyModel();
        $data = $model->getusers(@$_REQUEST['uid']);
        $model->updateProfileView(@$_REQUEST['aid']);

        if (!empty($data)) {
            $template = '<div class="popup">'.
                          '<div class="row">' .
                            '<div class="label">Name </div>' .
                            '<div class="data">:' . $data['FNAME'] . '</div>' .
                          '</div>'  .
                          '<div class="row">' .
                            '<div class="label">Gender: </div>' .
                            '<div class="data">:' . $data['GENDER'] . '</div>' .
                          '</div>'  .
                          '<div class="row">' .
                              '<div class="label">Age </div>' .
                              '<div class="data">:' . $data['AGE'] . '</div>' .
                          '</div>'  .
                          '<div class="row">' .
                              '<div class="label">Email ID </div>' .
                              '<div class="data">:' . $data['EMAILID'] . '</div>' .
                          '</div>'  .
                          '<div class="row">' .
                              '<div class="label">Education </div>' .
                              '<div class="data">:' . $data['EDUCATION'] . '</div>' .
                          '</div>'.
                          '<div class="row">' .
                              '<div class="label">Experience </div>' .
                              '<div class="data">:' . $data['EXPERIENCE'] . '</div>' .
                          '</div>'.
                          '<div class="row">' .
                              '<div class="label">Skills </div>' .
                              '<div class="data">:' . $data['SKILLS'] . '</div>' .
                          '</div>'.
                          '</div>';

                echo json_encode([
                    'status' => true,
                    'template' => $template
                ]);
                return;


        } else {
            echo json_encode([
                'status' => false,
                'message' => 'User details not found, please try after some time'
            ]);
            return;
        }


    }
}

$obj = new companyController();
?>