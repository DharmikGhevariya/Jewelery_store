<div class="col-sm-6">
                            <div class="well">
                                <h2>Admin Login</h2>
                                <p><strong>I am an admin</strong></p>
                                <form class="set_color" method="post">
                                    <div class="form-group">
                                        <label for="input-email" class="control-label"></label>
                                        <input type="text" class="form-control" id="input-email" placeholder="E-Mail Address" value="" name="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-password" class="control-label"></label>
                                        <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password" required>
                                        <a>Forgot Password</a></div>
                                    <input type="submit" name= "s2" class="margin-top btn btn-primary btn-block" value="Login">
                                </form>
								<?php								
								if(isset($_POST["s2"]))
								{
									$email=$_POST["email"];
									$password=$_POST["password"];
									if($email=="dharmik@gmail.com" && $password=="2005")		
									{
										$_SESSION["user"]=$email;
										$_SESSION["step"]="step_2";
										echo "<script>alert('Login Successful as Admin.')</script>";
										echo "<script>window.location.href='home.php'</script>";
									}
									else
										echo "<script>alert('error: Incorrect email ID or password!')</script>";
								}
							?>
                            </div>
                        </div>