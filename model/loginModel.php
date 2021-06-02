<?php
include_once 'Model.php';

class loginModel extends Model
{
    public function login($user){

        $conn = $this->connect();

        if (empty($conn)) die('Unable to connect DB');

        $sql = "BEGIN login_check(:username,:password,:typeof,:result,:id); END;";
        $sql = oci_parse($conn, $sql);

        oci_bind_by_name($sql,':username', $user['uname']);
        oci_bind_by_name($sql,':password', $user['pass']);
        oci_bind_by_name($sql,':typeof', $user['type']);
        oci_bind_by_name($sql,':result', $res['message'],10);
        oci_bind_by_name($sql, ':id', $res['id']);

        oci_execute($sql);

        return $res;
    }

    public function register($user){
        $conn = $this->connect();

        if($user['type'] == 'employee'){

            $sql = "SELECT * FROM users WHERE emailid = :email";
            $sql = oci_parse($conn, $sql);
            oci_bind_by_name($sql, ':email', $user['emailid']);
            oci_execute($sql);
            oci_fetch_all($sql, $output ,NULL,NULL,OCI_FETCHSTATEMENT_BY_ROW);

            if(count($output) == 0){
                $sql = "INSERT INTO  users (id,fname,lname,gender,age,country,state,city,pincode,phone,uname,pass,emailid)VALUES(user_seq.nextval,:fname,:lname,:gender,:age,:country,:state,:city,:pincode,:phone,:uname,:pass,:email)";
                $sql = oci_parse($conn,$sql);
                oci_bind_by_name($sql, ':fname', $user['efname']);
                oci_bind_by_name($sql, ':lname', $user['elname']);
                oci_bind_by_name($sql, ':gender', $user['egender']);
                oci_bind_by_name($sql, ':age', $user['eage']);
                oci_bind_by_name($sql, ':country', $user['ecountry']);
                oci_bind_by_name($sql, ':state', $user['estate']);
                oci_bind_by_name($sql, ':city', $user['ecity']);
                oci_bind_by_name($sql, ':pincode', $user['epincode']);
                oci_bind_by_name($sql, ':phone', $user['ephone']);
                oci_bind_by_name($sql, ':uname', $user['euname']);
                oci_bind_by_name($sql, ':pass', $user['epass']);
                oci_bind_by_name($sql, ':email', $user['eemailid']);

                $res2 = oci_execute($sql,OCI_COMMIT_ON_SUCCESS);
                if(!$res2){
                    $message = "Unable to Register Employee";
                }else{
                    $message = "Employee Registered successfully";
                }
            }else{
                $message = "Employee already exists";
            }
        }else if($user['type'] == 'company'){
            $sql = "SELECT * FROM company WHERE cmpname = :cmpname OR uname = :uname";
            $sql = oci_parse($conn, $sql);
            oci_bind_by_name($sql, ':cmpname', $user['ccmpname']);
            oci_bind_by_name($sql, ':uname', $user['cuname']);
            oci_execute($sql);
            oci_fetch_all($sql, $output ,NULL,NULL,OCI_FETCHSTATEMENT_BY_ROW);

            if(count($output) == 0){
                die('Inserting');
                $sql = "INSERT INTO  company VALUES(company_seq.nextval,:cmpname,:phone,:country,:state,:city,:pincode,:uname,:pass)";
                $sql = oci_parse($conn,$sql);
                oci_bind_by_name($sql, ':cmpname', $user['ccmpname']);
                oci_bind_by_name($sql, ':phone', $user['cphone']);
                oci_bind_by_name($sql, ':country', $user['ccountry']);
                oci_bind_by_name($sql, ':state', $user['cstate']);
                oci_bind_by_name($sql, ':city', $user['ccity']);
                oci_bind_by_name($sql, ':pincode', $user['cpincode']);
                oci_bind_by_name($sql, ':uname', $user['cuname']);
                oci_bind_by_name($sql, ':pass', $user['cpass']);
                $res2 = oci_execute($sql,OCI_COMMIT_ON_SUCCESS);
                if(!$res2){
                    $message = "Unable to Register Company";
                }else{
                    $message = "Company Registered successfully";
                }
            }else{
                $message = "Company Name/Username already exists";
            }
        }

        return $message;
    }
}
?>