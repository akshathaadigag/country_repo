<?php
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
	<h1>Retrieve Countries</h1>

	<div id="body">
        
        <div class="container">
		 <p style="text-align:right">If you want to add new country:<a href="<?php echo base_url(); ?>/Country/index"><span class="blink_me">Click Here</span></a></p><br>
            
            <form action="<?php echo base_url();?>index.php/Country/manage_country" method="post">
                                <?php if(form_error('Name')) {?>
                                <span class="form-error-message"><?php echo form_error('Name');?></span>
                                <?php } ?>
                        
                          <div class="input-group">
                                   
                      
                                <select id="" name="Name" class="form-control">
                                    <option value="0">Choose Country</option>
                                    <?php foreach ($country_master as $value) { ?>
                                    <option value="<?php echo $value->name;?>" <?php echo set_select('Name',$value->name); ?>><?php echo $value->name;?></option>
                                    <?php }?>
                                </select>
                               <span class="input-group-btn">
                                    <button class="btn btn-primary" type="submit">Search</button>
                               </span>
                          </div>
                      
                         

           </form>
            
            <br>
         

  
            
<?php   if(isset($country_list))
        { ?>  
<table class="table" border="0" width="100%" >
    
    <tr>
        <th>Sl No.</th>
        <th>Country Name</th>
        <th>International Dialing Code</th>
        <th>Region</th>
        <th>Capital</th>
        <th>Timezone</th>
        <th>List of currencies used</th>
        <th>Image of flag</th>
    </tr>

        <?php
                    
            if($country_list)
            {    
                    $i=1;
                    foreach($country_list as $val)
                    {	
                    ?>

                <tr>
                    <td><?php echo $i++;?></td>
                    <td><?php echo $val['Name'];?></td>

                    <td><?php echo $val['Calling_Code'];?></td>
                    <td><?php echo $val['Region'];?></td>
                    <td><?php echo $val['Capital'];?></td>
                    <td><?php echo $val['Timezone'];?></td>
                    <td><?php echo $val['Currency'];?></td>
                    <td><img src="<?php echo $val['Flag'];?>"  width="100px" height="100px"/></td>

                </tr>

    <?php           }
            }
            else
            {?>
                <tr><td colspan="8"><b>No Records Found</b></td></tr>
        <?php    } ?>
        
    
</table>
<?php } ?>
            
<br><br><br>
            
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