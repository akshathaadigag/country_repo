<?php

class Country extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $CI = & get_instance();
        $this->load->model('Country_model', 'country_m');
        date_default_timezone_set('Asia/Calcutta');
        
    }

    public function index() {
        
        $this->form_validation->set_rules('Name', 'Name', 'required|trim|callback_validate_dropdown|is_unique[country.Name]');
        $this->form_validation->set_rules('Code1', 'alpha2Code', 'trim|alpha|exact_length[2]');
        $this->form_validation->set_rules('Code2', 'alpha3Code', 'trim|alpha|exact_length[3]');
        $this->form_validation->set_rules('Capital', 'Capital', 'trim|alpha');
        $this->form_validation->set_rules('Currency', 'Currency', 'trim|alpha');
        $this->form_validation->set_rules('Language', 'Language', 'trim|alpha');
      
        if ($this->form_validation->run() == FALSE) {
            $outdata['country_master']=$this->country_master();
            //echo '<pre>';print_r($outdata);exit;
            $this->load->view('create_country',$outdata);
        } else {
            
            $Name = $this->input->post('Name');
            $Code1 = $this->input->post('Code1');
            $Code2 = $this->input->post('Code2');
            
            $Capital = $this->input->post('Capital');
            $Currency = $this->input->post('Currency');
            $Language = $this->input->post('Language');
            
            $data['Name'] = $Name;
            $data['Code1'] = $Code1;
            $data['Code2'] = $Code2;
            $data['Capital'] = $Capital;
            $data['Currency'] = $Currency;
            $data['Language'] = $Language;
            
            $insert_id = $this->country_m->insertData($data);
            
            if($insert_id)
                redirect('country/manage_country');
            else
                redirect('country');
        }
    }
    
    
     public function manage_country() {
         
        $this->form_validation->set_rules('Name', 'Name', 'required|trim|callback_validate_dropdown');
        $output['country_master']=$this->country_master();
           
             
         
        if ($this->form_validation->run() == FALSE) {
           
            $this->load->view('manage_country',$output);
        } else { 
            $Name = $this->input->post('Name');
        
            $array = array('Name' => $Name);
            if($Name)
                $output['country_list'] = $this->search($Name);
            
            $this->load->view('manage_country', $output);
        }
    }
    
    public function curl_call($Name)
    {
        $url="https://restcountries.eu/rest/v2/name/".$Name;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
        $res = curl_exec($ch);
        curl_close($ch);
        
        return $res;
    }
    
    public function country_master()
    {
        $url="https://restcountries.eu/rest/v2/all";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
        $res = curl_exec($ch);
        curl_close($ch);
        $list_of_country=json_decode($res);
      
        return $list_of_country;
    }
    public function search($Name)
    {
        $array = array('Name' => $Name);
        $db_list = $this->country_m->selectData_By_Name($array);
        
        
        
        if($db_list)
        {    
                    for($w=0;$w<count($db_list);$w++)
                    {    
                        if($db_list[$w]['Status']=='0' || ($db_list[$w]['Calling_Code']=='' || 
                                                           $db_list[$w]['Region']=='' ||
                                                           $db_list[$w]['Capital']=='' ||
                                                           $db_list[$w]['Timezone']=='' ||
                                                           $db_list[$w]['Currency']=='' ||
                                                           $db_list[$w]['Flag']==''
                                                          ))
                        {                                                

                            $res=$this->curl_call($Name);
            
                            $list=json_decode($res);
                      
                            $country_list=array();

                            if(isset($list->status) && $list->status=='404')
                            {
                                return $country_list;
                            }
                            else
                            {    

                                $j=0;
                                for($i=0;$i<count($list);$i++)
                                {
                                    
                                    
                                       

                                        if(strcasecmp($db_list[$w]['Name'],$list[$j]->name)==0)
                                        {   
                                             $country_list[$i]['Name']=$list[$j]->name;


                                            if($db_list[$w]['Calling_Code']=='')
                                                $country_list[$i]['Calling_Code']=$list[$j]->callingCodes[0];
                                            else
                                                $country_list[$i]['Calling_Code']=$db_list[$w]['Calling_Code'];

                                            if($db_list[$w]['Region']=='')
                                                $country_list[$i]['Region']=$list[$j]->region; 
                                            else
                                                $country_list[$i]['Region']=$db_list[$w]['Region'];


                                            if($db_list[$w]['Capital']=='')
                                                $country_list[$i]['Capital']=$list[$j]->capital;    
                                            else
                                                $country_list[$i]['Capital']=$db_list[$w]['Capital'];

                                            if($db_list[$w]['Timezone']=='')
                                                $country_list[$i]['Timezone']=$list[$j]->timezones[0];
                                            else
                                                $country_list[$i]['Timezone']=$db_list[$w]['Timezone'];

                                            if($db_list[$w]['Currency']=='')
                                                $country_list[$i]['Currency']=$list[$j]->currencies[0]->code;    
                                            else
                                                $country_list[$i]['Currency']=$db_list[$w]['Currency'];
                                            
                                              if($db_list[$w]['Flag']=='')
                                                $country_list[$i]['Flag']=$list[$j]->flag; 

                                                $country_list[$i]['Status']='1';




                                                $where = array('Name' => $list[$j]->name);

                                                $this->country_m->updateData($where, $country_list[$i]);
                                        }

                                        $j++;
                            }

                                return $country_list;
                            }
                        }
                        else
                        {
                            return $db_list;

                        }

                    }
        }
        else
        {
            
                            $url="https://restcountries.eu/rest/v2/name/".$Name;

                            $res=$this->curl_call($Name);
                            
                            $list=json_decode($res);
                           
            
                            $country_list=array();

                            if(isset($list->status) && $list->status=='404')
                            {
                                return $country_list;
                            }
                            else
                            {    
                                $j=0;
                                for($i=0;$i<count($list);$i++)
                                {
                                    $country_list[$i]['Name']=$list[$j]->name;    
                                    $country_list[$i]['Calling_Code']=$list[$j]->callingCodes[0];
                                    $country_list[$i]['Region']=$list[$j]->region;  
                                    $country_list[$i]['Capital']=$list[$j]->capital;    
                                    $country_list[$i]['Timezone']=$list[$j]->timezones[0];    
                                    $country_list[$i]['Currency']=$list[$j]->currencies[0]->code;    
                                    $country_list[$i]['Flag']=$list[$j]->flag; 
                                    $country_list[$i]['Status']='1';

                                    $j++;

                                }
                                 return $country_list;

                            }
        }
    }
    
    public function validate_dropdown($str) {
        if ($str == '0') {
            $this->form_validation->set_message('validate_dropdown', 'Please choose your Option.');
            return FALSE;
        } else {
            return TRUE;
        }
    }
    
    
   

    
   
   
}
