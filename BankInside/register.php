<?php
/**
 * Copyright (C) 2013 peredur.net
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once 'includes/register.inc.php';
include_once 'includes/functions.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bankinside Corporation</title>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>
    
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/style.default.css" rel="stylesheet">
</head>

<body class="signin">

        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        
        <?php
        if (!empty($error_msg)) {
            echo $error_msg;
        }
        ?>
     
    <section>
        <div class="signuppanel">
            <div class="row">
                <div class="col-md-6 col-md-offset-6">
                    

                    <form method="post" name="registration_form" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>">
                            <h3 class="nomargin">Registre-se</h3>
                            <p class="mt5 mb20">Já é um membro? <a href="index.php"><strong>Login</strong></a></p>
                            <div class="mb10">
                                <label class="control-label">Usário</label>
                                <input type='text' class="form-control" name='username' id='username' /><br>
                            </div>


                            <div class="mb10">
                                <label class="control-label">Email</label>
                                <input type="text" class="form-control" name="email" id="email" /><br>
                            </div>

                            <div class="mb10">
                                <label class="control-label">Senha</label>
                                <input type="password" class="form-control" name="password" id="password" /><br>
                            </div>

                            <div class="mb10">
                                <label class="control-label">Confirme a Senha</label>
                                <input type="password" class="form-control" name="confirmpwd" id="confirmpwd" /><br>
                            </div>
                                             
                            <input type="button" 
                                   value="Registrar" 
                                   class="btn btn-success btn-block"
                                   onclick="return regformhash(this.form,
                                                   this.form.username,
                                                   this.form.email,
                                                   this.form.password,
                                                   this.form.confirmpwd);" /> 

                </form>
                <p>Retornar para a <a href="index.php">página de login</a>.</p>
                </div>
        </div>

            <div class="signup-footer">
                <div class="pull-left">
                    &copy; 2015. All Rights Reserved. Bankinside Corporation
                </div>
                <div class="pull-right">
                    Created By: <a href="#" target="_self">New Idea Software</a>
                </div>
            </div>
        </div>
    </section>

    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/modernizr.min.js"></script>
    <script src="js/jquery.sparkline.min.js"></script>
    <script src="js/jquery.cookies.js"></script>
    <script src="js/toggles.min.js"></script>
    <script src="js/retina.min.js"></script>
    <script src="js/select2.min.js"></script>s
    <script src="js/custom.js"></script>
    <script>
        jQuery(document).ready(function(){

            jQuery(".select2").select2({
                width: '100%',
                minimumResultsForSearch: -1
            });

            jQuery(".select2-2").select2({
                width: '100%'
            });
        });
    </script>
</body>
</html>
