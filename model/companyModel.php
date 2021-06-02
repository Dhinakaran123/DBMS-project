<?php
include_once 'Model.php';

class companyModel extends Model
{
    public function getJobView($cid){
        $conn = $this->connect();
        $sql = 'BEGIN company_job_view(:c_id); END;';
        $sql = oci_parse($conn, $sql);
        oci_bind_by_name($sql, ':c_id', $cid);

        oci_execute($sql,OCI_COMMIT_ON_SUCCESS);

        $sql = 'Select * from cmp_job_view';
        $sql = oci_parse($conn, $sql);
        oci_execute($sql,OCI_COMMIT_ON_SUCCESS);
        oci_fetch_all($sql, $job,NULL,NULL,OCI_FETCHSTATEMENT_BY_ROW);
        return $job;
    }
    public function insertJob($data)
    {
        $conn = $this->connect();
        $sql = "BEGIN insert_job(:c_id,:jname,:jdesc,:jeducation,:jskills,:jvacancy,:dopen,:dclose,:jstatus,:jexp,:res); END;";
        $sql = oci_parse($conn, $sql);

        oci_bind_by_name($sql, ':c_id', $data['CID']);
        oci_bind_by_name($sql, ':jname', $data['JOBNAME']);
        oci_bind_by_name($sql, ':jdesc', $data['JOBDESC']);
        oci_bind_by_name($sql, ':jeducation', $data['EDUCATION']);
        oci_bind_by_name($sql, ':jskills', $data['SKILLS']);
        oci_bind_by_name($sql, ':jvacancy', $data['VACANCY']);
        oci_bind_by_name($sql, ':dopen', $data['DATEOFOPEN']);
        oci_bind_by_name($sql, ':dclose', $data['DATEOFCLOSE']);
        oci_bind_by_name($sql, ':jstatus', $data['STATUS']);
        oci_bind_by_name($sql, ':jexp', $data['EXPERIENCE']);
        oci_bind_by_name($sql, ':res', $res , 110);

        oci_execute($sql,OCI_COMMIT_ON_SUCCESS);

        return $res;
    }

    public function updateJob($data)
    {
        $conn = $this->connect();
        $sql = "BEGIN update_job(:j_id,:jname,:jdesc,:jeducation,:jskills,:jvacancy,:dopen,:dclose,:jstatus,:jexp,:res); END;";
        $sql = oci_parse($conn, $sql);

        oci_bind_by_name($sql, ':j_id', $data['JID']);
        oci_bind_by_name($sql, ':jname', $data['JOBNAME']);
        oci_bind_by_name($sql, ':jdesc', $data['JOBDESC']);
        oci_bind_by_name($sql, ':jeducation', $data['EDUCATION']);
        oci_bind_by_name($sql, ':jskills', $data['SKILLS']);
        oci_bind_by_name($sql, ':jvacancy', $data['VACANCY']);
        oci_bind_by_name($sql, ':dopen', $data['DATEOFOPEN']);
        oci_bind_by_name($sql, ':dclose', $data['DATEOFCLOSE']);
        oci_bind_by_name($sql, ':jstatus', $data['STATUS']);
        oci_bind_by_name($sql, ':jexp', $data['EXPERIENCE']);
        oci_bind_by_name($sql, ':res', $res , 110);

        oci_execute($sql,OCI_COMMIT_ON_SUCCESS);

        return $res;

    }

    public function getData($id)
    {
        $conn = $this->connect();
        $sql = "SELECT * FROM jobs WHERE jid =".$id."";
        $sql = oci_parse($conn, $sql);
        oci_execute($sql,OCI_COMMIT_ON_SUCCESS);
        $data = oci_fetch_assoc($sql);

        return $data;
    }

    public function getCmp($id)
    {
        $conn = $this->connect();
        $sql = "SELECT * FROM company WHERE cid = ".$id."";
        $sql = oci_parse($conn,$sql);
        oci_execute($sql);
        $data = oci_fetch_assoc($sql);
        return $data;
    }

   public function editProfile($data)
   {
       $conn = $this->connect();

       $sql = sprintf("UPDATE company SET cmpname='%s', country='%s', state='%s', city='%s', pincode='%s', phone='%s' WHERE cid='%s'",
           $data['cmpname'],$data['country'],$data['state'],$data['city'],$data['pincode'],$data['phone'],$data['id']);
       $sql = oci_parse($conn,$sql);
       $r = oci_execute($sql,OCI_COMMIT_ON_SUCCESS);
       if(!$r){
           return -1;
       }else{
           return 0;
       }
   }
   public function getappliedJobs($cid)
   {
       $conn = $this->connect();
       $sql = "BEGIN cmp_applied_jobs(:cid); END;";
       $sql = oci_parse($conn,$sql);
       oci_bind_by_name($sql, ':cid', $cid);
       oci_execute($sql);

       $sql = "SELECT * FROM cmpappliedJobs";
       $sql = oci_parse($conn,$sql);
       oci_execute($sql);
       oci_fetch_all($sql, $data,NULL,NULL,OCI_FETCHSTATEMENT_BY_ROW);
       return $data;
   }
   public function getusers($id)
   {
        $conn = $this->connect();
        $sql = "SELECT * FROM users WHERE id = ".$id."";
        $sql = oci_parse($conn,$sql);
        oci_execute($sql);
        $data = oci_fetch_assoc($sql);
        return $data;
   }
   public function updateProfileView($aid)
   {
       $conn = $this->connect();
       $sql = "UPDATE jobapply SET viewed = 1,modifiedon=SYSDATE WHERE aid = ".$aid."" ;
       $sql = oci_parse($conn,$sql);
       oci_execute($sql,OCI_COMMIT_ON_SUCCESS);
       return;
   }
   public function updateJobStatus($data)
   {
       $conn = $this->connect();
       $sql = "UPDATE jobapply SET selection_status = ".$data['status'].",modifiedon=SYSDATE WHERE aid = ".$data['aid']."";
       $sql = oci_parse($conn, $sql);
       oci_execute($sql);
       return;
   }
}
?>