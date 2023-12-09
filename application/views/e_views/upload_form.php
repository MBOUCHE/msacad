<html>

   <head>
      <title>Upload Form</title>
   </head>

   <body>
      <?php echo form_open_multipart('e_controllers/upload/do_upload');?>
      <form action = "" method = "post">
         <input type = "file" name = "userfile" size = "20" /><br/>
         <input type="text" name="name">
         <br/>
         <input type = "submit" value = "upload" />
      </form>
      <?php echo $error;?>
   </body>
</html>
