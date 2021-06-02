<?php
include_once 'Controller.php';
include_once '../model/loginModel.php';
include_once '../model/employeeModel.php';
class loginController extends Controller
{
    public function __construct()
    {

        parent::__construct();

        try {
        $request = @$_REQUEST['r'];


        if (empty($request)) {
            return $this->index();
        }


        $methods = get_class_methods(get_class($this));
        if (!in_Array($request, $methods)) {
            // @TODO Invalid request parameter

        }

        $this->{$request}();
        } catch(Exception $e) {
            echo 'There is an exception occurs. ' . $e->getMessage() . ' @ ' . $e->getFile() . ' [' . $e->getLine() . '] ';
        }
    }

    public function index()
    {
        if($this->hasUserSession() && $_SESSION['type'] == 'employee'){
            return $this->redirect('employeeController.php');
        }else if($this->hasUserSession() && $_SESSION['type'] == 'company'){
            return $this->redirect('companyController.php');
        }else{

            return $this->redirect('loginController.php?r=login');
            //return $this->render('login-form.php');
        }

    }



    public function login() {

        if(isset($_POST['uname'])){
            $model = new loginModel();
            $user['type'] = @$_POST['type'];

            if($user['type'] == 'employee'){
                $user['uname'] = @$_POST['uname'];
                $pass = @$_POST['pass'];
                $user['pass'] = md5($pass);

                if(empty($user['uname'])){ $error['eluname'] = "UserName is empty";}


                if(empty($user['pass'])){ $error['elpass'] = "Password is empty";}

                if(empty($error)){
                    $res = $model->login($user);

                    if($res['message'] == "True"){
                        session_regenerate_id(true);
                        $userModel = new employeeModel();
                        $data = $userModel->getUser($res['id']);

                        if(empty($data['FNAME']) || empty($data['GENDER']) || empty($data['AGE']) || empty($data['COUNTRY']) ||
                        empty($data['STATE']) || empty($data['CITY']) || empty($data['PINCODE']) || empty($data['PHONE']) || empty($data['EMAILID']) ||
                        empty($data['EDUCATION']) || empty($data['EXPERIENCE']) || empty($data['SKILLS']) || empty($data['CV_NAME']) || empty($data['CV_PATHNAME'])){
                            $_SESSION['pro_comp'] = 0;
                        }else{
                            $_SESSION['pro_comp'] = 1;
                        }
                        $data = [];

                        $_SESSION['id'] = $res['id'];
                        $_SESSION['uname'] = $user['uname'];
                        $_SESSION['type'] = $user['type'];

                        return $this->redirect('employeeController.php');
                    }else{
                        $error['einvalid'] = $res['message'];
                        $error['type'] ="LoginEmployee";
                        $data['eluname'] = $user['uname'];
                        $data['elpass'] = $pass;
                        return $this->render('login-form.php',$data,$error);
                    }
                }else{
                    $error['type'] ="LoginEmployee";
                    $data['eluname'] = $user['uname'];
                    $data['elpass'] = $pass;
                    return $this->render('login-form.php',$user,$error);
                }
            }else if($user['type'] == 'company'){
                $user['uname'] = @$_POST['uname'];
                $pass = @$_POST['pass'];
                $user['pass'] = md5($pass);

                if(empty($user['uname'])){ $error['eluname'] = "UserName is empty";}


                if(empty($user['pass'])){ $error['elpass'] = "Password is empty";}

                if(empty($error)){
                    $res = $model->login($user);

                    if($res['message'] == "True"){
                        session_regenerate_id(true);

                        $_SESSION['id'] = $res['id'];
                        $_SESSION['uname'] = $user['uname'];
                        $_SESSION['type'] = $user['type'];

                        return $this->redirect('companyController.php');
                    }else{
                        $error['cinvalid'] = $res['message'];
                        $error['type'] ="LoginCompany";
                        $data['cluname'] = $user['uname'];
                        $data['clpass'] = $pass;
                        return $this->render('login-form.php',$data,$error);
                    }
                }else{
                    $error['type'] ="LoginCompany";
                    $data['cluname'] = $user['uname'];
                    $data['clpass'] = $pass;
                    return $this->render('login-form.php',$data,$error);
                }
            }
        }else{
            return $this->render('login-form.php');
        }
    }



    public function register(){
        if(isset($_POST['uname'])){
            $model = new loginModel();

            $user['type'] = @$_POST['type'];


            if($user['type'] == 'employee'){
                $user['efname'] = @$_POST['fname'];
                $user['elname'] = @$_POST['lname'];
                $user['eemailid'] = @$_POST['emailid'];
                $user['euname'] = @$_POST['uname'];
                $user['epass'] = @$_POST['pass'];
                $user['egender'] = @$_POST['gender'];
                $user['eage'] = @$_POST['age'];
                $user['ecountry'] = @$_POST['country'];
                $user['estate'] = @$_POST['state'];
                $user['ecity'] = @$_POST['city'];
                $user['epincode'] = @$_POST['pincode'];
                $user['ephone'] = @$_POST['phone'];

                if(empty($user['efname'])){ $error['efname'] = "FirstName is empty";}
                if(strlen($user['efname']) > 50){ $error['efname'] = "Size of FirstName is large";}

                if(strlen($user['elname']) > 50){ $error['elname'] = "Size of LastName is large";}

                if(empty($user['eemailid'])){ $error['eemailid'] = "Email  is empty";}

                if(empty($user['euname'])){ $error['euname'] = "UserName is empty";}

                if(empty($user['epass'])){ $error['epass'] = "Password is empty";}

                if(empty($user['egender'])){ $error['egender'] = "Gender is empty";}
                if($user['egender'] != 'M' && $user['egender'] != 'F' && $user['egender'] != 'O'){
                    $error['egender'] = "Invalid gender";
                }

                if(empty($user['eage'])){ $error['eage'] = "Age is empty";}

                if(empty($user['ecountry'])){ $error['ecountry'] = "Country is empty";}
                if(empty($user['estate'])){ $error['estate'] = "State is empty";}
                if(empty($user['ecity'])){ $error['ecity'] = "City is empty";}
                if(empty($user['pincode'])){ $error['epincode'] = "Pincode is empty";}
                if(strlen($user['epincode']) !=6 ){ $error['epincode'] = "Invaid pincode";}

                if(empty($user['ephone'])){ $error['ephone'] = "PhoneNumber is empty";}
                if(strlen($user['ephone']) > 10){ $error['ephone'] = "Invalid Phone Number";}

                if(empty($error)){
                    $user['epass'] = md5($user['epass']);
                    $res = $model->register($user);
                    $data['result'] = $res;
                    $this->render('login-form.php',$data);
                }else{
                    $error['type'] ="RegisterEmployee";
                    return $this->render('login-form.php',$user,$error);
                }

            }else if($user['type'] == 'company'){
                $cmp['ccmpname'] = @$_POST['cmpname'];
                $cmp['cuname'] = @$_POST['uname'];
                $cmp['cpass'] = @$_POST['pass'];
                $cmp['ccountry'] = @$_POST['country'];
                $cmp['cstate'] = @$_POST['state'];
                $cmp['ccity'] = @$_POST['city'];
                $cmp['cpincode'] = @$_POST['pincode'];
                $cmp['cphone'] = @$_POST['phone'];
                $cmp['ctype'] = $user['type'];

                if(empty($cmp['ccmpname'])){ $error['cmpname'] = "CompanyName is empty";}
                if(strlen($cmp['ccmpname']) > 100){ $error['cmpname'] = "Size of Company Name is large";}

                if(empty($cmp['cuname'])){ $error['cuname'] = "UserName is empty";}

                if(empty($cmp['cpass'])){ $error['cpass'] = "Password is empty";}


                if(empty($cmp['ccountry'])){ $error['ccountry'] = "Country is empty";}
                if(empty($cmp['cstate'])){ $error['cstate'] = "State is empty";}
                if(empty($cmp['ccity'])){ $error['ccity'] = "City is empty";}
                if(empty($cmp['cpincode'])){ $error['cpincode'] = "Pincode is empty";}
                if(strlen($cmp['cpincode']) !=6 ){ $error['cpincode'] = "Invaid pincode";}

                if(empty($cmp['cphone'])){ $error['cphone'] = "PhoneNumber is empty";}
                if(strlen($cmp['cphone']) != 10){ $error['cphone'] = "Invalid Phone Number";}

                if(empty($error)){
                    $cmp['cpass'] = md5($cmp['cpass']);
                    $res = $model->register($cmp);
                    $data['result'] = $res;
                    $this->render('login-form.php',$data);
                }else{
                    $error['type'] ="RegisterCompany";
                    return $this->render('login-form.php',$cmp,$error);
                }
            }
        }else{
            return $this->render('login-form.php');
        }
    }

    public function logout(){
        session_unset();
        session_destroy();

        return $this->redirect('loginController.php');
    }
}

$obj = new loginController();