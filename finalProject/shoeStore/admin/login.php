<?php 
include("../api/db/Database.php");
// start session to access session data
session_start();
$user = null;
if(isset($_SESSION["id"])){
    // find user by ID and check if they're admin
    // if they are, then redirect them to the index page 
    $user = Database::getUserDao()->findById($_SESSION["id"]);
    if($user != null && $user->isAdmin()){
        header("Location: ./");
    }
}
// if we reach here, user is an admin and is logged in
include("../shell/top.php");
?>
<script>
/* global $ */
$(function(){
    $(".login-form").submit(function(event){
        event.preventDefault();
        // POST to server to check if username and password is correct
        $.ajax({
            type: "POST",
            url: "/api/user/auth.php",
            data: { username: $("#username").val(), password: $("#password").val() },
            success: function(data, status){
                if(data["success"] === true){
                    // we have good credentials; take them to the admin page
                    window.location = "./";
                } else {
                    $("#login-error")
                        .html("Invalid username or password.")
                        .css("display", "inline-block");
                }
            }
        });
        return false;
    })
});
</script>
<form class="login-form">
    <fieldset class="login-set">
        <legend>Login Now</legend>
        <div id="login-error"></div>
        <div class="input-div">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="admin"/> <br/>
        </div>
        <div class="input-div">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="admin"/><br/>
        </div>
        <input type="submit" value="Login!"/>
    </fieldset>
</form>
<?php include("../shell/bottom.php") ?>