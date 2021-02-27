<?php
    
    class MainModel extends CI_Model 
    {

        function __construct()
        {
            parent::__construct();
            //initialise the autoload things for this class
        }

        public function edit_($tbl, $cond) 
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->where($cond);
            $query = $this->db->get();
            return $query->result_array(); 
        }

        public function update_data($cond, $data, $tbl)
        {
            $this->db->where($cond);
            $this->db->update($tbl, $data);
            return 1;
        }

        public function detail($tbl, $order_by) 
        {
            $this->db->select('*');
            $this->db->from($tbl);
            $this->db->order_by($order_by);
            $query = $this->db->get();
            return $query->result_array(); 
        }

        public function manegetabs_byid($id) {

            $this->db->select('*');
            $this->db->from('subtabs');
            $this->db->where('id', $id);
            $this->db->order_by('name', 'asc');
          
            $query = $this->db->get();
            return $query->result_array(); 
        }

    public function delete($tbl, $id) {
        return $this->db->delete($tbl, array('id' => $id));
    }

    

    public function manegetabs() {

        $this->db->select('*');
        $this->db->from('tabs');
        $this->db->order_by('name', 'asc');
      
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function report_detail_above80() {

        //SELECT `id`, `student_id`, `lesson_id`, `score`, `created_at`, `updated_at`, `score_out_of`, `persentage`, `timing` FROM `report` WHERE 1

        $this->db->select('s.name as sname, l.name as rname, r. *');
        $this->db->from('report as r');
        $this->db->join('student as s','s.id=r.student_id','left');
        $this->db->join('lesson as l','l.id=r.lesson_id','left');
        $this->db->where('r. persentage >', '79');
        $query = $this->db->get();
        return $query->result_array(); 

    }

    public function report_detail_belove80() {

        //SELECT `id`, `student_id`, `lesson_id`, `score`, `created_at`, `updated_at`, `score_out_of`, `persentage`, `timing` FROM `report` WHERE 1

        $this->db->select('s.name as sname, l.name as rname, r. *');
        $this->db->from('report as r');
        $this->db->join('student as s','s.id=r.student_id','left');
        $this->db->join('lesson as l','l.id=r.lesson_id','left');
        $this->db->where('r. persentage <', '80');
        $query = $this->db->get();
        return $query->result_array(); 

        //print_r($this->db->last_query());

    }

/*    SELECT `id`, `quetions_id`, `student_id`, `lesson_id`, `answer`, `created_at` FROM `answers_` WHERE 1*/
/*
SELECT `id`, `name`, `lesson_id`, `created_at`, `updated_at` FROM `quetions_` WHERE 1*/

    public function verify($id) {

        $this->db->select('q2.name, a.*');
        $this->db->from('answers_ as a');
        $this->db->join('quetions_ as q2','q2.id = a.quetions_id','left');
        $this->db->where('a.student_id', $id);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function edit_quetion($id) {

        $this->db->select('l.name as lname, q. *');
        $this->db->from('quetions_ as q');
        $this->db->join('lesson as l','l.id=q.lesson_id','left');
         $this->db->where('q.id', $id);
        $query = $this->db->get();
        return $query->result_array(); 

    }

    public function edit_save($table_name, $array_data, $condition) {
        $this->db->where( $condition);
        $this->db->update($table_name, $array_data);

        //print_r($this->db->last_query());
        //die;
        return 1;
    }

    public function add($table_name, $array_data) {
        return $this->db->insert($table_name, $array_data);
    }

    public function quetions() {

        $this->db->select('l.name as lname, q. *');
        $this->db->from('quetions_ as q');
        $this->db->join('lesson as l','l.id=q.lesson_id','left');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function payment_detail() {
        //SELECT `id`, `student_id`, `amount`, `payment_status`, `created_at`, `updated_at` FROM `payment` WHERE 1

         $this->db->select('s.name as sname, r. *');
        $this->db->from('payment as r');
        $this->db->join('student as s','s.id=r.student_id','left');
    //    $this->db->join('lesson as l','l.id=r.lesson_id','left');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function report_detail() {

        $this->db->select('s.name as sname, l.name as rname, r. *');
        $this->db->from('report as r');
        $this->db->join('student as s','s.id=r.student_id','left');
        $this->db->join('lesson as l','l.id=r.lesson_id','left');
        $query = $this->db->get();
        return $query->result_array(); 

    }

    public function edit_quiz($id) {

         /*       $this->db->select('l.name as lname, q. *');
        $this->db->from('quetions_ as q');
        $this->db->join('lesson as l','l.id=q.lesson_id','left');
         $this->db->where('q.id', $id);
        $query = $this->db->get();
        return $query->result_array(); */


        $this->db->select('l.name as lname,  c.*');
        $this->db->from('quiz as c');
        $this->db->join('lesson as l','l.id=c.lesson_id','left');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
       // print_r($this->db->last_query());
        return $query->result_array();

    }

    public function add_quiz($data) {
           return $this->db->insert('quiz', $data);
    }

    public function delete_report($id) {
        $this->db->delete('report', array('id' => $id));
        return 1;
    }

    public function delete_payment($id) {
        $this->db->delete('payment', array('id' => $id ));
        return 1;
    }

    public function delete_quiz($id) {
        $this->db->delete('quiz', array('id' => $id));
        return 1;
    }



    public function quiz_detail() {

        $this->db->select('*');
        $this->db->from('quiz');
        $query = $this->db->get();
        return $query->result_array(); 

    }

    public function edit_quiz_save($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('quiz', $data);
        return 1;
    }



    public function edit_course_save($id, $data){
        $this->db->where('id', $id);
        $this->db->update('course', $data);
        return 1;

    }

    public function add_course($data) {

         return $this->db->insert('course', $data);

    }

     public function course_detail(){

        $this->db->select('*');
        $this->db->from('course');
     
        $query = $this->db->get();
        return $query->result_array();          
    }

    public function add_leason($data){

        return $this->db->insert('lesson', $data);


    }

    public function edit_lesson_save($id, $data){

        $this->db->where('id', $id);
        $this->db->update('lesson', $data);
        return 1;

    }

    public function leason_detail(){

        $this->db->select('*');
        $this->db->from('lesson');
       // $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();          
    }

    

    public function edit_leason($id) {

        $this->db->select('*');
        $this->db->from('lesson as c');
        //$this->db->join('category_ as c2','c.id=c2.parent_id','left');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function register_detail(){

        $this->db->select('*');
        $this->db->from('student');
       // $this->db->where('status',1);
        $query = $this->db->get();
        return $query->result_array();          
    }



    public function delete_course($id){
        $this->db->delete('course', array('id' => $id));
        return 1;
    }

    public function delete_user($id){
        
        $this->db->delete('student', array('id' => $id));
        return 1;
    }

    //SELECT `id`, `name`, `author`, `suscriber`, `subject`, `level`, `type`, `course`, `description` FROM `lesson` WHERE 1

    public function delete_leason($id){
        
        $this->db->delete('lesson', array('id' => $id));
        return 1;
    }

    public function edit_course($id){
        $this->db->select('*');
        $this->db->from('course as c');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit_user($id) {

        $this->db->select('*');
        $this->db->from('student as c');
        //$this->db->join('category_ as c2','c.id=c2.parent_id','left');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function edit_user_save($id, $data){

        $this->db->where('id', $id);
        $this->db->update('student', $data);
        return 1;

    }

    public function get_edit_upload_featured($id) {

        $this->db->select(' `uf`.`id`, `uf`.`name`, `uf`.`description`, `uf`.`video_file`, `uf`.`featured_id`, `f`.`name` fname');
        $this->db->from('upload_featured as uf');
        $this->db->join('featured_ as f','f.id=uf.featured_id','left');
        $this->db->where('uf.id', $id);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function edit_upload_featured($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('upload_featured', $data);
        return 1;

    }

    //SELECT `id`, `name`, `description`, `video_file`, `featured_id`, `created_at`, `updated_at` FROM `upload_featured` WHERE 1

    public function add_upload_featured($data) {

        return $this->db->insert('upload_featured',$data);

    }

    public function upload_featured() {

        $query = $this->db->get('upload_featured');
        return $query->result_array();
    }

    public function update_featured($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('featured_', $data);
        return 1;
    }

    public function edit_featured($id) {

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`');
        $this->db->from('featured_ as c');
        //$this->db->join('category_ as c2','c.id=c2.parent_id','left');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function update_category($id, $data) {

        $this->db->where('id', $id);
        $this->db->update('category_', $data);
        return 1;
    }

    public function edit_category($id) {

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`');
        $this->db->from('category_ as c');
        //$this->db->join('category_ as c2','c.id=c2.parent_id','left');
        $this->db->where('c.id', $id);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function sub_featured() {
   
        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`,  `c2`.`name` as `c2name`');
        $this->db->from('featured_ as c');
        $this->db->join('featured_ as c2','c2.id=c.parent_id','left');
        $this->db->where('c.parent_id !=',0);
        $this->db->group_by('`c`.`id`');
        $query = $this->db->get();


        return $query->result_array();
    }

    public function add_featured_data($data){
        return $this->db->insert('featured_',$data);
    }

    

    public function add_category_data($data){
        return $this->db->insert('category_',$data);
    }

    public function featured() {

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`');
        $this->db->from('featured_ as c');
        //$this->db->join('category_ as c2','c.id=c2.parent_id','left');
        $this->db->where('c.parent_id',0);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function add_featured() {

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`, c2.name as c2name');
        $this->db->from('category_ as c');
        $this->db->join('category_ as c2','c2.id=c.parent_id','left');
        $this->db->where('c.parent_id !=',0);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function add_category() {

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`, c2.name as c2name');
        $this->db->from('category_ as c');
        $this->db->join('category_ as c2','c2.id=c.parent_id','left');
        $this->db->where('c.parent_id !=',0);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function category() {

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`');
        $this->db->from('category_ as c');
        //$this->db->join('category_ as c2','c.id=c2.parent_id','left');
        $this->db->where('c.parent_id',0);
        $query = $this->db->get();
        return $query->result_array();

    }

    

    public function delete_featured($id){
        $this->db->delete('featured_', array('id' => $id));
        return 1;
    }

    public function delete_upload_featured($id){
        $this->db->delete('upload_featured', array('id' => $id));
        return 1;
    }

    public function delete_category($id){
        $this->db->delete('category_', array('id' => $id));
        return 1;
    }

    public function news(){

        $this->db->select(' `id`, `name`, `description_`, `image`, `created_at`, `updated_at`');
        $this->db->from('`news_`');
      
        $query = $this->db->get();
        return $query->result_array();

    }

    

    public function add_featured_uniue() {

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`');
        $this->db->from('featured_ as c');
        $query = $this->db->get();
        return $query->result_array();

    }
    
    

    public function add_category_uniue(){

        $this->db->select('`c`.`id`, `c`.`name`, `c`.`parent_id`, `c`.`created_at`, `c`.`image`, `c`.`description`');
       $this->db->from('category_ as c');
        $query = $this->db->get();
        return $query->result_array();

    }

    

    
    //9. Booking 

    public function booking() {
   
        $this->db->select('`b`.`id`, `b`.`register_id`, `b`.`services_id`, `b`.`amount`, `b`.`distance`, `b`.`time`, `b`.`created_at`, `r`.`full_name`, `s`.`name` as `s_name`');
        $this->db->from('`booking` `b`');
        $this->db->join('`register` `r`', '`r`.`id`=`b`.`register_id`', 'left');
        $this->db->join('`services` `s`', '`s`.`id`=`b`.`services_id`', 'left');
       
        $query =  $this->db->get(); 
        return $query->result_array();   
        //print_r($this->db->last_query()); 
    }
    
     //8. View Profile
    
    public function fetch_password($email){

        $this->db->select('email,password');
        $this->db->from('register');
        $this->db->where('email',$email);
        $query = $this->db->get();
        return $query->row();          
    }
    //7. Admin Login
    public function admin_login($data){

        $query = $this->db->get_where('users', $data);
        
        return $query->result_array();
    }

     //6. View Profile
    public function services($id){

        $this->db->select('*');
        $this->db->from('services');
        if($id){
             $this->db->where('id',$id);
        }
       
      
        $query=$this->db->get();

        /*$this->db->select("*");
        $this->db->from("services");
        
            $this->db->where('id', $id);
       
    
        $query = $this->db->get();*/
        //print_r($this->db->last_query()); 
        return $query->result_array();          
        //return $q->result();

        //$query = $this->db->get_where('services', $data);
        
        //return $query->result_array();
    }

     //5. Update Profile
    public function update_profile($data, $id) {

        $this->db->where('id', $id);
        return $this->db->update('register', $data);  
        //return 1;
        //print_r($id);
        //print_r($this->db->last_query());           
        //return $this->db->update('register',$data);
    }
    
    //4. View Profile
    public function view_profile($data){

        $query = $this->db->get_where('register', $data);
        
        return $query->result_array();
    }

    //3. Login Model
    public function login($data){

        $query = $this->db->get_where('register', $data);
        
        return $query->result_array();
    }

     //2. Register email exist Model
    public function email_exist_register($email){

        $query = $this->db->get_where('register', array('email' => $email));
        
        return $query->result_array();
    }

    //1. Register Model
    public function register($data) {
            
        return $this->db->insert('register',$data);
    }
}