<?php
include_once 'Model.php';

class employeeModel extends Model
{
    public function getRecords($id)
    {
        $conn = $this->connect();
        $sql = "BEGIN user_job_view(:uid); END;";
        $sql = oci_parse($conn,$sql);
        oci_bind_by_name($sql, ':uid', $id);
        oci_execute($sql);

        $sql = "SELECT * FROM users_job_view";
        $sql = oci_parse($conn,$sql);
        oci_execute($sql);
        oci_fetch_all($sql, $output,NULL,NULL,OCI_FETCHSTATEMENT_BY_ROW);

        return $output;
    }
    public function getUser($id)
    {
        $conn = $this->connect();
        $sql = "SELECT * FROM users WHERE id = ".$id."";
        $sql = oci_parse($conn,$sql);
        oci_execute($sql);
        $data = oci_fetch_assoc($sql);

        return $data;

    }
    public function updateUser($data)
    {
        $conn = $this->connect();

        $sql = sprintf("UPDATE users SET fname='%s', lname='%s', gender='%s', age=%s, country='%s', state='%s', city='%s', pincode='%s', phone='%s', emailid='%s', " .
                       "education='%s', skills='%s', experience='%s', cv_name='%s', cv_pathname='%s' WHERE id='%s'",
            $data['fname'],$data['lname'],$data['gender'],$data['age'],
            $data['country'],$data['state'],$data['city'],$data['pincode'],$data['phone'],$data['emailid'],$data['education'],$data['skills'],$data['experience'],
            $data['cv_name'],$data['cv_pathname'],$data['id']);

        /*$sql = "UPDATE users SET fname = '".$data['fname']."',lname = '".$data['lname']."',gender = ".$data['gender'].",age = ".$data['age'].",country = '".$data['country']."',
        state = '".$data['state']."',city = '".$data['city']."',pincode = ".$data['pincode'].",phone = ".$data['phone'].",emailid = '".$data['emailid']."',
        education = '".$data['education']."',skills = '".$data['skills']."',experience = ".$data['experience'].",cv_name = '".$data['cv_name']."',
        cv_pathname = '".$data['cv_pathname']."' WHERE id = ".$data['id']."";*/
        $sql = oci_parse($conn, $sql);
        //var_dump($sql);
        //die;
        $r = oci_execute($sql, OCI_COMMIT_ON_SUCCESS);
        if(!$r){
            return -1;
        }else{
            return 0;
        }

    }

    public function applyJob($details)
    {
        $conn = $this->connect();
        $sql = "INSERT INTO jobApply (AID,ID,JID,APPLIEDON) VALUES(jobapply_seq.nextval,".$details['uid'].",".$details['jid'].",SYSDATE)";

        $sql = oci_parse($conn, $sql);
        $r = oci_execute($sql, OCI_COMMIT_ON_SUCCESS);
        if(!$r){
            return -1;
        }else{
            return 0;
        }

    }

    public function cancelJob($details)
    {
        $conn = $this->connect();
        $sql = "UPDATE jobApply SET userstatus = -1 WHERE aid = ".$details['aid']."";
        $sql = oci_parse($conn, $sql);
        oci_execute($sql,OCI_COMMIT_ON_SUCCESS);
        return;
    }

    public function getAppliedJobs($id)
    {
        $conn = $this->connect();
        $sql =  "BEGIN getAppliedJobs(:id); END;";
        $sql = oci_parse($conn, $sql);
        oci_bind_by_name($sql, ':id', $id);
        oci_execute($sql);

        $sql =  "SELECT * FROM appliedjobs";
        $sql = oci_parse($conn, $sql);
        oci_execute($sql);

        oci_fetch_all($sql, $data,NULL,NULL,OCI_FETCHSTATEMENT_BY_ROW);

        return $data;
    }
}
?>