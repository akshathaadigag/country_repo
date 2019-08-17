<?php //echo '<pre>';print_r($country_master);exit;
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Country Data</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" type="text/css" />
</head>
<body>

<div id="container">
	<h1>Country Details</h1>

	<div id="body">
        
        <div class="container">
            
            <p style="text-align:right">To view countries:<a href="<?php echo base_url(); ?>Country/manage_country"><span class="blink_me">Click Here</span></a></p><br>
		 <form action="<?php echo base_url();?>Country/index" class="form-horizontal form-label-left" method="post">
                        <div class="form-group">
                          <label >Country Name:</label>
                          
                           <select id="" name="Name" class="form-control">
                                    <option value="0">Choose Country</option>
                                    <?php foreach ($country_master as $value) { ?>
                                    <option value="<?php echo $value->name;?>" <?php echo set_select('Name',$value->name); ?>><?php echo $value->name;?></option>
                                    <?php }?>
                            </select>
                            <?php if(form_error('Name')) {?>
                                <span class="form-error-message"><?php echo form_error('Name');?></span>
                                <?php } ?>
                        </div>
             
                  
                       
             
                        <div class="form-group">
                          <label >Country Code:</label>
                            <div class="form-inline">
                                   <input type="text" value="<?php echo set_value('Code1');?>" name="Code1" placeholder="alpha2code" class="form-control">
                                
                                    
                                
                                   <input type="text" value="<?php echo set_value('Code2');?>" name="Code2" placeholder="alpha3code" class="form-control">
                                
                                <?php if(form_error('Code1')) {?>
                                    <span class="form-error-message"><?php echo form_error('Code1');?></span>
                                    <?php } ?>

                                    <?php if(form_error('Code2')) {?>
                                    <span class="form-error-message"><?php echo form_error('Code2');?></span>
                                    <?php } ?>
                            </div>
                            
                            
                        </div>
             
                            
             
                        <div class="form-group">
                          <label >Capital City:</label>
                          <input type="text" value="<?php echo set_value('Capital');?>" class="form-control" id="Capital" name="Capital">
                            <?php if(form_error('Capital')) {?>
                                <span class="form-error-message"><?php echo form_error('Capital');?></span>
                                <?php } ?>
                        </div>
             
                        <div class="form-group">
                          <label >Currency Code:</label>
                          <input type="text" value="<?php echo set_value('Currency');?>" class="form-control" id="Currency" name="Currency">
                            <?php if(form_error('Currency')) {?>
                                <span class="form-error-message"><?php echo form_error('Currency');?></span>
                                <?php } ?>
                        </div>
                        
                      
                        <div class="form-group">
                          <label >Language:</label>
                          <input type="text"  value="<?php echo set_value('Language');?>" class="form-control" id="Language" name="Language">
                            <?php if(form_error('Language')) {?>
                                <span class="form-error-message"><?php echo form_error('Language');?></span>
                                <?php } ?>
                        </div>
                        
                      
                         <input type="submit" name="button" class="btn btn-primary" value="  Save  " style=" border-radius: 25px;"> <br><br>

        </form>
            
        </div>
	</div>

	<p class="footer"></p>
</div>

</body>
<script>
(function blink() { 
    $('.blink_me').fadeOut(500).fadeIn(500, blink); 
})();
</script>
</html>